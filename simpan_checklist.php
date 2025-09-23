<?php
include 'config.php'; // koneksi ke database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal      = $_POST['tanggal'];
    $nama_petugas = $_POST['nama_petugas'];
    $asrama       = $_POST['asrama'];
    $lantai       = $_POST['lantai'];
    $nomor_kamar  = $_POST['nomor_kamar'] ?? '';

    // Jika pilih koridor, isi otomatis '-'
    if (stripos($lantai, 'Koridor') !== false) {
        $nomor_kamar = '-';
    }

    // Checklist → JSON
    $checklist = [
        'Kamar Tidur'  => $_POST['kamar_tidur'] ?? [],
        'Kamar Mandi'  => $_POST['kamar_mandi'] ?? [],
        'Koridor'      => $_POST['koridor'] ?? [],
        'Amenities'    => $_POST['amenities'] ?? [],
        'Final Check'  => $_POST['final_check'] ?? []
    ];
    $checklist_json = json_encode($checklist, JSON_UNESCAPED_UNICODE);

    // fungsi upload file
    function uploadFile($file_input) {
        if (isset($_FILES[$file_input]) && $_FILES[$file_input]['error'] == 0) {
            $allowed_types = ['image/jpeg','image/png','image/jpg'];
            if (!in_array($_FILES[$file_input]['type'], $allowed_types)) return NULL;
            if ($_FILES[$file_input]['size'] > 2*1024*1024) return NULL; // max 2MB

            $ext = pathinfo($_FILES[$file_input]['name'], PATHINFO_EXTENSION);
            $new_name = $file_input . '_' . time() . '.' . $ext;
            $path = 'uploads/' . $new_name;
            if (!is_dir('uploads')) mkdir('uploads', 0777, true);
            move_uploaded_file($_FILES[$file_input]['tmp_name'], $path);
            return $path;
        }
        return NULL;
    }

    $foto_pekerjaan = uploadFile('foto_pekerjaan');
    $foto_kerusakan = uploadFile('foto_kerusakan');
    $foto_pelayanan = uploadFile('foto_pelayanan');
    $catatan_kerusakan = $_POST['catatan_kerusakan'];

    // Simpan ke database
    $stmt = $conn->prepare("INSERT INTO checklist_asrama 
        (tanggal, nama_petugas, asrama, lantai, nomor_kamar, checklist, foto_pekerjaan, foto_kerusakan, foto_pelayanan, catatan_kerusakan)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param(
        "ssssssssss",
        $tanggal,
        $nama_petugas,
        $asrama,
        $lantai,
        $nomor_kamar,
        $checklist_json,
        $foto_pekerjaan,
        $foto_kerusakan,
        $foto_pelayanan,
        $catatan_kerusakan
    );

    if ($stmt->execute()) {
        $last_id = $conn->insert_id; // ✅ gunakan $conn bukan $stmt
        $stmt->close();
        header("Location: laporan_sukses.php?id=$last_id");
        exit;
    } else {
        die("❌ Gagal simpan data: " . $stmt->error);
    }
}
?>
