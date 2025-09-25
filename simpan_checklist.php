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

// Upload foto (jika ada)
function uploadFoto($field)
{
    if (isset($_FILES[$field]) && $_FILES[$field]['error'] === UPLOAD_ERR_OK) {
        $targetDir = "uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }
        $fileName = time() . "_" . basename($_FILES[$field]["name"]);
        $targetFile = $targetDir . $fileName;
        if (move_uploaded_file($_FILES[$field]["tmp_name"], $targetFile)) {
            return $targetFile;
        }
    }
    return null;
}

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
} else {
    echo "Form type tidak dikenali!";
}
