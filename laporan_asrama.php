<?php
include 'config.php';

$id = $_GET['id'] ?? 0;
if ($id == 0) {
    die("❌ ID tidak ditemukan!");
}

$stmt = $conn->prepare("SELECT * FROM checklist_asrama WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

if (!$data) {
    die("❌ Data tidak ditemukan!");
}

// Decode checklist JSON
$checklist = json_decode($data['checklist'], true);

// Hitung progress (berdasarkan item checklist yang diisi)
$total_items = 0;
$checked_items = 0;
if ($checklist) {
    foreach ($checklist as $items) {
        $total_items += count($items);
        foreach ($items as $val) {
            if (!empty($val)) {
                $checked_items++;
            }
        }
    }
}
$progress = $total_items > 0 ? round(($checked_items / $total_items) * 100) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laporan Checklist Asrama</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- AOS Animations -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="max-w-5xl mx-auto p-6">
    
    <!-- Header -->
    <div class="flex items-center justify-center gap-2 text-xl md:text-2xl lg:text-3xl font-extrabold tracking-tight text-gray-800">
      <div>
        <h1 class="flex items-center gap-2 text-xl md:text-2xl font-extrabold tracking-tight text-gray-800">
          <i data-lucide="check-circle" class="w-6 h-6 text-blue-500"></i>
          Checklist Berhasil Disimpan
        </h1>
      </div>

      <!-- Progress Ring -->
      <div class="relative w-16 h-16">
        <?php $circ = 2 * pi() * 28; ?>
        <svg class="w-16 h-16 transform -rotate-90">
          <circle cx="32" cy="32" r="28" stroke-width="6" fill="none" class="text-gray-200" stroke="currentColor"></circle>
          <circle cx="32" cy="32" r="28" stroke-width="6" fill="none"
            stroke-dasharray="<?= $circ ?>"
            stroke-dashoffset="<?= ($circ - ($progress/100)*$circ) ?>"
            class="<?= $progress == 100 ? 'text-green-500' : 'text-blue-500' ?>"
            stroke="currentColor"
            style="transition: stroke-dashoffset 1s ease;"></circle>
        </svg>
        <span class="absolute inset-0 flex items-center justify-center text-sm font-semibold text-gray-700">
          <?= $progress ?>%
        </span>
      </div>
    </div>

    <!-- Info Umum -->
    <div class="bg-white rounded-2xl shadow p-6 mb-6">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700">
        <p class="flex items-center gap-2"><i data-lucide="calendar" class="w-4 h-4 text-blue-500"></i><span class="font-medium">Tanggal:</span> <?= htmlspecialchars($data['tanggal']) ?></p>
        <p class="flex items-center gap-2"><i data-lucide="user" class="w-4 h-4 text-blue-500"></i><span class="font-medium">Petugas:</span> <?= htmlspecialchars($data['nama_petugas']) ?></p>
        <p class="flex items-center gap-2"><i data-lucide="home" class="w-4 h-4 text-blue-500"></i><span class="font-medium">Asrama:</span> <?= htmlspecialchars($data['asrama']) ?></p>
        <p class="flex items-center gap-2"><i data-lucide="layers" class="w-4 h-4 text-blue-500"></i><span class="font-medium">Lantai:</span> <?= htmlspecialchars($data['lantai']) ?></p>
        <p class="flex items-center gap-2"><i data-lucide="door-closed" class="w-4 h-4 text-blue-500"></i><span class="font-medium">Kamar:</span> <?= htmlspecialchars($data['nomor_kamar']) ?></p>
        <p class="flex items-center gap-2"><i data-lucide="sticky-note" class="w-4 h-4 text-blue-500"></i><span class="font-medium">Catatan:</span> <?= htmlspecialchars($data['catatan_kerusakan']) ?></p>
      </div>
    </div>

    <!-- Checklist -->
<!-- Checklist -->
<div class="bg-white rounded-2xl shadow p-6 mb-6">
  <h3 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-800">
    <i data-lucide="list-checks" class="w-5 h-5 text-blue-600"></i>
    Checklist Area
  </h3>

  <div class="grid gap-4">
    <?php if (!empty($checklist)): ?>
      <?php 
        // mapping kategori ke icon lucide
        $icons = [
          'Kamar Tidur' => 'bed',
          'Kamar Mandi' => 'shower-head',
          'Koridor'     => 'move-horizontal',
          'Amenities'   => 'package',
          'Final Check' => 'check-circle'
        ];
      ?>
      <?php foreach ($checklist as $kategori => $items): ?>
        <?php 
          $total = count($items);
          $checked = count(array_filter($items));
        ?>
        <div class="bg-gray-50 border rounded-xl p-4 hover:shadow-md transition">
          <div class="flex items-center justify-between mb-2">
            <p class="flex items-center gap-2 font-medium text-gray-800">
              <i data-lucide="<?= $icons[$kategori] ?? 'square' ?>" class="w-4 h-4 text-blue-500"></i>
              <?= htmlspecialchars($kategori) ?>
            </p>
            <span class="text-xs font-medium px-2 py-0.5 rounded-full 
              <?= $checked == $total && $total > 0 
                  ? 'bg-green-100 text-green-700' 
                  : ($checked > 0 
                      ? 'bg-yellow-100 text-yellow-700' 
                      : 'bg-gray-100 text-gray-500') ?>">
              <?= $total > 0 ? "$checked / $total" : "0 / 0" ?>
            </span>
          </div>
          <div class="flex flex-wrap gap-2 text-sm">
            <?php if (!empty($items)): ?>
              <?php foreach ($items as $item): ?>
                <span class="px-2 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-medium shadow-sm">
                  <?= htmlspecialchars($item) ?>
                </span>
              <?php endforeach; ?>
            <?php else: ?>
              <span class="px-2 py-1 rounded-full bg-gray-100 text-gray-500 text-xs">Tidak ada data</span>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p class="text-gray-500 text-sm">Belum ada checklist.</p>
    <?php endif; ?>
  </div>
</div>



    <!-- Foto -->
<?php if ($data['foto_pekerjaan'] || $data['foto_kerusakan'] || $data['foto_pelayanan']): ?>
  <div class="bg-white rounded-2xl shadow p-6 mb-6">
    <h3 class="text-lg font-semibold mb-3 flex items-center gap-2 text-gray-800">
      <i data-lucide="image" class="w-5 h-5 text-blue-600"></i> Dokumentasi
    </h3>
    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
      <?php if ($data['foto_pekerjaan']): ?>
        <div>
          <img src="<?= $data['foto_pekerjaan'] ?>" class="w-full h-32 object-cover rounded-lg shadow">
          <p class="text-xs text-center mt-1 text-gray-600">Pekerjaan</p>
        </div>
      <?php endif; ?>
      <?php if ($data['foto_kerusakan']): ?>
        <div>
          <img src="<?= $data['foto_kerusakan'] ?>" class="w-full h-32 object-cover rounded-lg shadow">
          <p class="text-xs text-center mt-1 text-gray-600">Kerusakan</p>
        </div>
      <?php endif; ?>
      <?php if ($data['foto_pelayanan']): ?>
        <div>
          <img src="<?= $data['foto_pelayanan'] ?>" class="w-full h-32 object-cover rounded-lg shadow">
          <p class="text-xs text-center mt-1 text-gray-600">Pelayanan</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
<?php endif; ?>


    <!-- Buttons -->
<div class="bg-white rounded-2xl shadow p-6 mb-6 mt-6">
  <div class="flex justify-between items-center">
    <!-- Button Kembali -->
    <a href="checklist_asrama.php" 
      class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium text-gray-700 transition">
      <i data-lucide="arrow-left" class="w-4 h-4"></i>
      <span>Kembali</span>
    </a>

    <!-- Button Edit -->
    <a href="edit_checklist.php?id=<?= $id ?>" 
      class="flex items-center gap-2 px-4 py-2 bg-blue-500 text-white rounded-lg font-medium hover:bg-blue-600 active:scale-95 transition-transform duration-200">
      <i data-lucide="edit-3" class="w-4 h-4"></i>
      <span>Edit Data</span>
    </a>
  </div>

  <!-- Footer -->
  <p class="mt-6 text-xs text-center text-gray-400">
    © <?= date("Y") ?> Dibuat dengan ❤️ oleh WARGA RT BSDK
  </p>
</div>

  </div>

  <script>lucide.createIcons();</script>
</body>
</html>
