<?php
$title = "Asrama";
include 'config.php';

$id = $_GET['id'] ?? 0;
if ($id == 0) die("❌ ID tidak ditemukan!");

// Ambil data
$stmt = $conn->prepare("SELECT * FROM checklist_asrama WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data   = $result->fetch_assoc();
$stmt->close();

if (!$data) die("❌ Data tidak ditemukan!");

$checklist = json_decode($data['checklist'], true);
$selected  = $data['lantai'] ?? 'Lantai'; // area dari DB

$template = [
  'Kamar Tidur' => [
    "Merapikan tempat tidur",
    "Menyapu & mengepel kamar",
    "Membersihkan meja & kursi",
    "Membuka & Membersihkan jendela kamar",
    "Membuang sampah & mengganti plastik",
  ],
  'Kamar Mandi' => [
    "Membersihkan lantai kamar mandi",
    "Membersihkan toilet",
    "Membersihkan wastafel & keran",
    "Memastikan saluran air lancar",
    "Mengganti handuk"
  ],
  'Koridor' => [
    "Menyapu seluruh area koridor",
    "Mengepel lantai koridor",
    "Membersihkan pagar/railing",
    "Membersihkan dinding"
  ],
  'Amenities' => [
    "Mengganti air mineral",
    "Memastikan peralatan listrik (lampu, stop kontak, AC)"
  ],
    'Final Check' => [
    "Pastikan semua area bersih & rapi",
    "Mengecek perlengkapan sesuai standar"
  ]
];

$group_rules = [
  'Lantai'  => ['Kamar Tidur', 'Kamar Mandi', 'Amenities', 'Final Check'],
  'Koridor' => ['Koridor', 'Final Check']
];

$total_items   = 0;
$checked_items = 0;

if (isset($group_rules[$selected])) {
  foreach ($group_rules[$selected] as $kategori) {
    $items = $template[$kategori] ?? [];
    $total_items += count($items);

    if (isset($checklist[$kategori])) {
      $checked_items += count(array_intersect($checklist[$kategori], $items));
    }
  }
}

$progress = $total_items > 0 ? round(($checked_items / $total_items) * 100) : 0;

// Tentukan status
if ($progress >= 80) {
  $progress_color = "text-green-500";
  $status_bg      = "bg-green-100 text-green-700";
  $status_text    = "Baik";
} elseif ($progress >= 50) {
  $progress_color = "text-yellow-500";
  $status_bg      = "bg-yellow-100 text-yellow-700";
  $status_text    = "Cukup";
} else {
  $progress_color = "text-red-500";
  $status_bg      = "bg-red-100 text-red-700";
  $status_text    = "Kurang";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laporan Checklist Asrama</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <style>
    body {
      font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "SF Pro Text",
        "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue",
        sans-serif;
      background: #f9fafb;
    }
    /* Animasi halus */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(10px) scale(0.98); }
      to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .animate-fadeInUp {
      animation: fadeInUp 0.6s ease-out forwards;
    }
  </style>
</head>
<body class="text-gray-800">
<div class="max-w-5xl mx-auto p-6">
    <!-- Card -->
    <div class="bg-white/80 backdrop-blur-md border border-gray-200 rounded-3xl shadow-lg p-6 md:p-8 animate-fadeInUp">

      <!-- Judul -->
      <div class="text-center mb-6">
        <h1 class="flex items-center justify-center gap-2 text-2xl md:text-3xl font-semibold text-gray-900">
          <i data-lucide="check-circle" class="w-7 h-7 text-blue-500"></i>
          Checklist Tersimpan
        </h1>
        <p class="text-sm text-gray-500 mt-1">
          Form Pemeriksaan & Dokumentasi 
          <?= !empty($title) ? htmlspecialchars($title) : "Umum" ?>
        </p>
      </div>

      <!-- Progress Ring -->
      <div class="flex flex-col items-center mb-6">
        <?php $circ = 2 * pi() * 34; ?>
        <div class="relative w-20 h-20">
          <svg class="w-20 h-20 transform -rotate-90">
            <circle cx="40" cy="40" r="34" stroke-width="6" fill="none" class="text-gray-200" stroke="currentColor"></circle>
            <circle cx="40" cy="40" r="34" stroke-width="6" fill="none"
              stroke-dasharray="<?= $circ ?>"
              stroke-dashoffset="<?= ($circ - ($progress/100)*$circ) ?>"
              class="<?= $progress_color ?>"
              stroke="currentColor"
              style="transition: stroke-dashoffset 1s ease;"></circle>
          </svg>
          <span class="absolute inset-0 flex items-center justify-center text-base font-semibold text-gray-800">
            <?= $progress ?>%
          </span>
        </div>
        <span class="mt-2 px-3 py-1 text-xs font-medium rounded-full <?= $status_bg ?>">
          <?= $status_text ?>
        </span>
        <div class="text-xs text-gray-500 mt-1">
          <?= intval($checked_items) ?> dari <?= intval($total_items) ?> item
        </div>
      </div>

      <!-- Ucapan -->
      <p class="text-sm md:text-base text-gray-700 leading-relaxed text-justify mb-6">
        Terima kasih banyak telah meluangkan waktu untuk mengisi form checklist ini.  
        Data yang Anda berikan sangat membantu dalam 
        <span class="font-semibold text-gray-900">Wujud Asri Rapi Giat Aman Rumah Tangga</span>  
        Badan Strajak Diklat Kumdil Mahkamah Agung RI.
      </p>

      <!-- Tombol -->
      <div class="flex justify-between items-center mt-4">
        <a href="index.php"
          class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium shadow-sm transition active:scale-95">
          <i data-lucide="arrow-left" class="w-4 h-4"></i>
          <span>Kembali</span>
        </a>
        <a href="checklist_asrama.php"
          class="flex items-center gap-2 px-5 py-2.5 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium shadow-md hover:shadow-lg transition active:scale-95">
          <i data-lucide="edit-3" class="w-4 h-4"></i>
          <span>Isi Data Baru</span>
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
