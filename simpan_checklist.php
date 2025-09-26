<?php
include "config.php"; // pastikan koneksi database

// Cek apakah form dikirim dari asrama atau auditorium
$formType = $_POST['form_type'] ?? '';

if (!$formType) {
    die("Form type tidak ditemukan!");
}

// Ambil data umum
$tanggal       = $_POST['tanggal'] ?? date("Y-m-d");
$nama_petugas  = $_POST['nama_petugas'] ?? '';
$catatan       = $_POST['catatan_kerusakan'] ?? '';
$checklistData = isset($_POST['checklist']) ? json_encode($_POST['checklist']) : '{}';

// =====================
// Fungsi Upload + Kompres
// =====================
function uploadFoto($fieldName)
{
    if (empty($_FILES[$fieldName]['tmp_name'])) {
        return null; // tidak ada file yang diupload
    }

    $tmpFile  = $_FILES[$fieldName]['tmp_name'];
    $sizeFile = $_FILES[$fieldName]['size'];
    $original = $_FILES[$fieldName]['name'];

    // validasi max 2MB
    if ($sizeFile > 2 * 1024 * 1024) {
        return null; // ❌ kalau lebih besar, skip
    }

    // nama file aman
    $ext      = strtolower(pathinfo($original, PATHINFO_EXTENSION));
    $safeName = preg_replace('/[^a-zA-Z0-9]/', '_', pathinfo($original, PATHINFO_FILENAME));
    $filename = time() . "_" . $safeName . "." . $ext;

    $target   = __DIR__ . "/uploads/" . $filename;

    // kompres
    if (compressImage($tmpFile, $target, 70, 1024)) {
        return $filename; // sukses → return nama file
    }

    return null;
}

function compressImage($source, $destination, $quality = 70, $maxWidth = 1024)
{
    if (!function_exists('imagecreatefromjpeg')) {
        // fallback → langsung copy file
        return copy($source, $destination);
    }

    $info = getimagesize($source);
    if (!$info) return false;

    $mime = $info['mime'];
    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source);
            break;
        default:
            return copy($source, $destination);
    }

    $width  = imagesx($image);
    $height = imagesy($image);

    // resize kalau terlalu lebar
    if ($width > $maxWidth) {
        $newWidth  = $maxWidth;
        $newHeight = floor($height * ($newWidth / $width));
        $tmp = imagecreatetruecolor($newWidth, $newHeight);

        // khusus PNG → transparansi
        if ($mime === 'image/png') {
            imagealphablending($tmp, false);
            imagesavealpha($tmp, true);
        }

        imagecopyresampled($tmp, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        imagedestroy($image);
        $image = $tmp;
    }

    // simpan hasil
    if ($mime === 'image/png') {
        $pngQuality = 9 - floor($quality / 10); // konversi ke skala PNG
        $result = imagepng($image, $destination, $pngQuality);
    } elseif ($mime === 'image/gif') {
        $result = imagegif($image, $destination);
    } else {
        $result = imagejpeg($image, $destination, $quality);
    }

    imagedestroy($image);
    return $result;
}

// =====================
// Pemanggilan
// =====================
$foto_pekerjaan = uploadFoto("foto_pekerjaan");
$foto_kerusakan = uploadFoto("foto_kerusakan");
$foto_pelayanan = uploadFoto("foto_pelayanan");

// =====================
// SIMPAN DATA ASRAMA
// =====================
if ($formType === "asrama") {
    $asrama = $_POST['asrama'] ?? '';
    $lantai = $_POST['lantai'] ?? '';
    $nomor_kamar = $_POST['nomor_kamar'] ?? '';
    // Jika pilih koridor, isi otomatis '-'
    if (stripos($lantai, 'Koridor') !== false) {
        $nomor_kamar = '-';
    }

    $stmt = $conn->prepare("INSERT INTO checklist_asrama 
        (tanggal, nama_petugas, asrama, lantai, nomor_kamar, checklist, foto_pekerjaan, foto_kerusakan, foto_pelayanan, catatan_kerusakan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $tanggal, $nama_petugas, $asrama, $lantai, $nomor_kamar, $checklistData, $foto_pekerjaan, $foto_kerusakan, $foto_pelayanan, $catatan,);

    if ($stmt->execute()) {
        $last_id = $conn->insert_id; // ✅ gunakan $conn bukan $stmt
        $stmt->close();
        header("Location: laporan_sukses.php?type=asrama&id=$last_id");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

// =====================
// SIMPAN DATA AUDITORIUM
// =====================
elseif ($formType === "auditorium") {
    $ruangan = $_POST['ruangan'] ?? '';

    $stmt = $conn->prepare("INSERT INTO checklist_auditorium 
        (tanggal, nama_petugas, ruangan, checklist, foto_pekerjaan, foto_kerusakan, foto_pelayanan, catatan_kerusakan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $tanggal, $nama_petugas, $ruangan, $checklistData, $foto_pekerjaan, $foto_kerusakan, $foto_pelayanan, $catatan);

    if ($stmt->execute()) {
        $last_id = $conn->insert_id; // ✅ gunakan $conn bukan $stmt
        $stmt->close();
        header("Location: laporan_sukses.php?type=auditorium&id=$last_id");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

// =====================
// SIMPAN DATA RUMPIM
// =====================
elseif ($formType === "rumpim") {
    $rumah = $_POST['rumah'] ?? '';
    $nomor_rumah = $_POST['nomor_rumah'] ?? '';
    // Jika pilih Rumah Dinas Eselon I, isi otomatis '-'
    if (stripos($rumah, 'Rumah Dinas Eselon I') !== false) {
        $nomor_rumah = '-';
    }

    $stmt = $conn->prepare("INSERT INTO checklist_rumpim 
        (tanggal, nama_petugas, rumah, nomor_rumah, checklist, foto_pekerjaan, foto_kerusakan, foto_pelayanan, catatan_kerusakan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $tanggal, $nama_petugas, $rumah, $nomor_rumah, $checklistData, $foto_pekerjaan, $foto_kerusakan, $foto_pelayanan, $catatan);

    if ($stmt->execute()) {
        $last_id = $conn->insert_id; // ✅ gunakan $conn bukan $stmt
        $stmt->close();
        header("Location: laporan_sukses.php?type=rumpim&id=$last_id");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

// =====================
// SIMPAN DATA TAMAN
// =====================
elseif ($formType === "taman") {
    $taman = $_POST['taman'] ?? '';

    $stmt = $conn->prepare("INSERT INTO checklist_taman 
        (tanggal, nama_petugas, taman, checklist, foto_pekerjaan, foto_kerusakan, foto_pelayanan, catatan_kerusakan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $tanggal, $nama_petugas, $taman, $checklistData, $foto_pekerjaan, $foto_kerusakan, $foto_pelayanan, $catatan);

    if ($stmt->execute()) {
        $last_id = $conn->insert_id; // ✅ gunakan $conn bukan $stmt
        $stmt->close();
        header("Location: laporan_sukses.php?type=taman&id=$last_id");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

// =====================
// SIMPAN DATA GONDOLA
// =====================
elseif ($formType === "gondola") {
    $gondola = $_POST['gondola'] ?? '';

    $stmt = $conn->prepare("INSERT INTO checklist_gondola 
        (tanggal, nama_petugas, gondola, checklist, foto_pekerjaan, foto_kerusakan, foto_pelayanan, catatan_kerusakan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $tanggal, $nama_petugas, $gondola, $checklistData, $foto_pekerjaan, $foto_kerusakan, $foto_pelayanan, $catatan);

    if ($stmt->execute()) {
        $last_id = $conn->insert_id; // ✅ gunakan $conn bukan $stmt
        $stmt->close();
        header("Location: laporan_sukses.php?type=gondola&id=$last_id");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}

// =====================
// SIMPAN DATA GENERAL CLEANING
// =====================
elseif ($formType === "general_cleaning") {
    $general_cleaning = $_POST['general_cleaning'] ?? '';

    $stmt = $conn->prepare("INSERT INTO checklist_general_cleaning 
        (tanggal, nama_petugas, general_cleaning, checklist, foto_pekerjaan, foto_kerusakan, foto_pelayanan, catatan_kerusakan) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $tanggal, $nama_petugas, $general_cleaning, $checklistData, $foto_pekerjaan, $foto_kerusakan, $foto_pelayanan, $catatan);

    if ($stmt->execute()) {
        $last_id = $conn->insert_id; // ✅ gunakan $conn bukan $stmt
        $stmt->close();
        header("Location: laporan_sukses.php?type=general_cleaning&id=$last_id");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
} else {
    echo "Form type tidak dikenali!";
}
