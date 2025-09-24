<?php
$title = "Auditorium";
include 'header.php';
?>

<input type="hidden" name="tipe" value="auditorium">
<!-- Form Checklist -->
<form id="checklistForm" action="simpan_checklist.php" method="POST" enctype="multipart/form-data">

  <!-- Informasi Dasar -->
  <div class="bg-white rounded-2xl shadow-md p-6 mb-6" data-aos="fade-up">
    <h2 class="text-lg font-semibold mb-4 flex items-center gap-2 text-gray-800">
      <i data-lucide="info" class="w-5 h-5 text-blue-500"></i>
      Informasi Dasar
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Tanggal -->
      <div>
        <label class="flex items-center text-sm font-medium text-gray-700 mb-1">
          <i data-lucide="calendar" class="w-4 h-4 text-blue-500 mr-1"></i> Tanggal
        </label>
        <input type="date" name="tanggal" class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-blue-300" required>
      </div>

      <!-- Nama Petugas -->
      <div>
        <label class="flex items-center text-sm font-medium text-gray-700 mb-1">
          <i data-lucide="user" class="w-4 h-4 text-blue-500 mr-1"></i> Nama Petugas
        </label>
        <input type="text" name="nama_petugas" placeholder="Masukkan nama petugas"
          class="w-full border rounded-xl p-3 focus:ring-2 focus:ring-blue-300" required>
      </div>
      <!-- Ruangan -->
      <div>
        <label class="flex items-center text-sm font-medium text-gray-700 tracking-wide mb-1">
          <i data-lucide="building-2" class="w-4 h-4 text-blue-500 mr-1"></i> Nama Ruangan
        </label>
        <select name="ruangan" id="ruanganSelect"
          class="w-full border border-gray-300 rounded-xl p-3 text-gray-700 focus:border-blue-400 focus:ring-2 focus:ring-blue-300 transition"
          required>
          <option value="" disabled selected>Pilih Ruangan</option>
          <option value="Kelas">Auditorium</option>
          <option value="Kelas">Kelas 1</option>
          <option value="Kelas">Kelas 2</option>
          <option value="Kelas">Kelas 3</option>
          <option value="Kelas">Kelas 4</option>
          <option value="Kelas">Kelas 5</option>
          <option value="Kelas">Kelas 6</option>
          <option value="Kelas">Kelas 7</option>
          <option value="Kelas">Kelas 8</option>
          <option value="Kelas">Kelas 9</option>
          <option value="Kelas">Kelas 10</option>
          <option value="Kelas">Kelas 11</option>
          <option value="Kelas">Kelas 12</option>
          <option value="Kelas">Kelas 13</option>
          <option value="Kelas">Kelas 14</option>
          <option value="Kelas">Kelas 15</option>
          <option value="Kelas">Kelas 16</option>
          <option value="Kelas">Kelas 17</option>
          <option value="Kelas">Kelas 18</option>
          <option value="Kelas">Kelas 19</option>
          <option value="Koridor">Koridor Lantai Basement</option>
          <option value="Koridor">Koridor Auditorium</option>
          <option value="Koridor">Koridor Lantai 2</option>
          <option value="Toilet">Toilet Lantai Basement</option>
          <option value="Toilet">Toilet Auditorium</option>
          <option value="Toilet">Toilet Lantai 2</option>
        </select>
      </div>
    </div>
  </div>

  <?php
  $areas = [
    "Area Ruangan" => ["Menyapu & mengepel lantai", "Membersihkan meja & kursi", "Menata kursi & meja sesuai layout", "Membersihkan panggung/podium"],
    "Koridor" => ["Menyapu seluruh area koridor", "Mengepel lantai koridor", "Membersihkan pagar/railing", "Membersihkan dinding"],
    "Toilet" => ["Membersihkan lantai toilet", "Membersihkan toilet", "Membersihkan wastafel & keran", "Memastikan saluran air lancar", "Mengisi ulang sabun & tisu"],
    "Final Check" => ["Pastikan semua area bersih & rapi", "Mengecek perlengkapan sesuai standar"]
  ];

  // Mapping icon untuk tiap area
  $icons = [
    "Area Ruangan" => "door-open",
    "Koridor"      => "route",
    "Toilet"       => "toilet",
    "Final Check"  => "check-circle"
  ];
  ?>

  <?php foreach ($areas as $area => $items): ?>
    <div class="bg-white rounded-2xl shadow p-6 mb-6" data-aos="fade-up">
      <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
        <i class="<?= $icons[$area] ?? 'fa-solid fa-check-square text-blue-500' ?> w-5 h-5"></i> <?= $area ?>
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3 checklist">
        <?php foreach ($items as $index => $item): ?>
          <label class="flex justify-between items-center <?= $index < count($items) - 1 ? 'border-b pb-1' : '' ?>">
            <span class="check-label"><?= $item ?></span>
            <input type="checkbox" name="checklist[<?= $area ?>][]" value="<?= $item ?>"
              class="check-item w-4 h-4 accent-blue-500 transform transition-transform hover:scale-110">
          </label>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endforeach; ?>


  <!-- Upload Foto -->
  <div id="uploadFoto" class="bg-white rounded-2xl shadow p-6 mb-6" data-aos="fade-up">
    <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
      <i data-lucide="image" class="w-5 h-5 text-blue-500"></i> Upload Foto Dokumentasi
    </h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

      <!-- Foto Pekerjaan -->
      <div class="relative border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center p-6 cursor-pointer hover:border-blue-400 transition">
        <i data-lucide="upload" class="w-6 h-6 text-gray-400 mb-2"></i>
        <span class="text-sm font-medium text-gray-700">Foto Pekerjaan</span>
        <input type="file" name="foto_pekerjaan" id="foto_pekerjaan" accept="image/*" class="hidden" onchange="previewImage(event, 'previewPekerjaan', 'removePekerjaan')">
        <img id="previewPekerjaan" class="mt-3 w-24 h-24 object-cover rounded-lg hidden" />
        <button type="button" id="removePekerjaan" class="hidden absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">X</button>
      </div>

      <!-- Foto Kerusakan -->
      <div class="relative border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center p-6 cursor-pointer hover:border-blue-400 transition">
        <i data-lucide="upload" class="w-6 h-6 text-gray-400 mb-2"></i>
        <span class="text-sm font-medium text-gray-700">Foto Kerusakan</span>
        <input type="file" name="foto_kerusakan" id="foto_kerusakan" accept="image/*" class="hidden" onchange="previewImage(event, 'previewKerusakan', 'removeKerusakan')">
        <img id="previewKerusakan" class="mt-3 w-24 h-24 object-cover rounded-lg hidden" />
        <button type="button" id="removeKerusakan" class="hidden absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">X</button>
      </div>

      <!-- Foto Pelayanan -->
      <div class="relative border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center p-6 cursor-pointer hover:border-blue-400 transition">
        <i data-lucide="upload" class="w-6 h-6 text-gray-400 mb-2"></i>
        <span class="text-sm font-medium text-gray-700">Foto Pelayanan</span>
        <input type="file" name="foto_pelayanan" id="foto_pelayanan" accept="image/*" class="hidden" onchange="previewImage(event, 'previewPelayanan', 'removePelayanan')">
        <img id="previewPelayanan" class="mt-3 w-24 h-24 object-cover rounded-lg hidden" />
        <button type="button" id="removePelayanan" class="hidden absolute top-2 right-2 bg-red-500 text-white text-xs px-2 py-1 rounded">X</button>
      </div>

    </div>
  </div>

  <!-- Catatan Khusus / Kendala -->
  <div id="catatanKhusus" class="bg-white rounded-2xl shadow p-6 mb-6" data-aos="fade-up">
    <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
      <i data-lucide="alert-circle" class="w-5 h-5 text-blue-500"></i>
      Catatan Khusus / Kendala yang Ditemui
    </h2>
    <textarea name="catatan_kerusakan" rows="4" placeholder="Tuliskan kendala atau catatan khusus di sini..."
      class="border rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-400"></textarea>
  </div>

  <!-- Progress Bar + Tombol -->
  <div class="bg-white rounded-2xl shadow p-6 mb-6 text-center" data-aos="fade-up">
    <div class="relative w-full bg-gray-200 rounded-full h-3 overflow-hidden mb-4">
      <div id="progress-bar" class="absolute left-0 top-0 h-3 bg-blue-500 transition-all duration-500 ease-out"
        style="width: 0%;"></div>
      <span id="progress-text"
        class="absolute inset-0 flex items-center justify-center text-xs font-medium text-gray-700">0%
        Complete</span>
    </div>

    <!-- Tombol -->
    <div class="flex justify-between mt-6 mb-4">
      <button type="button" id="resetFormBtn"
        class="px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium shadow-sm transition active:scale-95">
        Reset Form
      </button>
      <button type="submit"
        class="px-5 py-2 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium shadow-md hover:shadow-lg transition active:scale-95">
        Simpan Checklist
      </button>
    </div>
    <!-- Footer -->
    <p class="mt-4 text-xs text-gray-400">© <?php echo date("Y"); ?> Dibuat dengan ❤️ oleh WARGA RT BSDK</p>
  </div>

  <?php include 'footer.php'; ?>
</form>