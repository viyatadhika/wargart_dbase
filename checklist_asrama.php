<?php
$title = "Asrama";
include 'header.php';
?>

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
    <label class="flex items-center text-sm font-medium text-gray-700 tracking-wide mb-1">
      <i data-lucide="calendar" class="w-4 h-4 text-blue-500 mr-1"></i> Tanggal
    </label>
    <input type="date" name="tanggal" id="tanggalInput"
      class="w-full border border-gray-300 rounded-xl p-3 text-gray-700 focus:border-blue-400 focus:ring-2 focus:ring-blue-300 transition"
      required />
  </div>

  <!-- Nama Petugas -->
  <div>
    <label class="flex items-center text-sm font-medium text-gray-700 tracking-wide mb-1">
      <i data-lucide="user" class="w-4 h-4 text-blue-500 mr-1"></i> Nama Petugas
    </label>
    <input type="text" name="nama_petugas" id="namaPetugas" placeholder="Masukkan nama petugas"
      class="w-full border border-gray-300 rounded-xl p-3 text-gray-700 focus:border-blue-400 focus:ring-2 focus:ring-blue-300 transition"
      required />
  </div>

  <!-- Blok Asrama -->
  <div>
    <label class="flex items-center text-sm font-medium text-gray-700 tracking-wide mb-1">
      <i data-lucide="building-2" class="w-4 h-4 text-blue-500 mr-1"></i> Blok Asrama
    </label>
    <select name="asrama" id="asramaSelect"
      class="w-full border border-gray-300 rounded-xl p-3 text-gray-700 focus:border-blue-400 focus:ring-2 focus:ring-blue-300 transition"
      required>
      <option value="" disabled selected>Pilih Asrama</option>
      <option>Candra 1</option>
      <option>Candra 2</option>
      <option>Sari</option>
      <option>Tirta</option>
      <option>Cakra 1</option>
      <option>Cakra 2</option>
      <option>Cakra 3</option>
      <option>Cakra 4</option>
      <option>Cakra 5</option>
      <option>Kartika</option>
    </select>
  </div>

  <!-- Lantai -->
  <div>
    <label class="flex items-center text-sm font-medium text-gray-700 tracking-wide mb-1">
      <i data-lucide="layers" class="w-4 h-4 text-blue-500 mr-1"></i> Lantai
    </label>
    <select name="lantai" id="lantaiSelect"
      class="w-full border border-gray-300 rounded-xl p-3 text-gray-700 focus:border-blue-400 focus:ring-2 focus:ring-blue-300 transition"
      required>
      <option value="" disabled selected>Pilih Lantai</option>
      <option value="Lantai">Lantai 1</option>
      <option value="Lantai">Lantai 2</option>
      <option value="Lantai">Lantai 3</option>
      <option value="Lantai">Lantai 4</option>
      <option value="Koridor">Koridor Lantai 1</option>
      <option value="Koridor">Koridor Lantai 2</option>
      <option value="Koridor">Koridor Lantai 3</option>
      <option value="Koridor">Koridor Lantai 4</option>
    </select>
  </div>

    <!-- Nomor Kamar (default hidden) -->
  <div id="nomorKamarField" class="hidden">
    <label class="flex items-center text-sm font-medium text-gray-700 tracking-wide mb-1">
      <i data-lucide="door-closed" class="w-4 h-4 text-blue-500 mr-1"></i> Nomor Kamar
    </label>
    <input type="text" id="nomorKamar" name="nomor_kamar" placeholder="Masukkan nomor kamar"
      class="w-full border border-gray-300 rounded-xl p-3 text-gray-700 focus:border-blue-400 focus:ring-2 focus:ring-blue-300 transition">
  </div>

  </div>
</div>


<!-- Area Kamar -->
<div id="areaKamar" class="bg-white rounded-2xl shadow p-6 mb-6 hidden" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="bed" class="w-5 h-5 text-blue-500"></i> Area Kamar Tidur
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3 checklist">
    <label class="flex justify-between items-center border-b pb-1"><span class ="check-label">Merapikan tempat tidur</span><input type="checkbox" name="kamar_tidur[]" value="Merapikan tempat tidur" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span class ="check-label">Menyapu & mengepel kamar</span><input type="checkbox" name="kamar_tidur[]" value="Menyapu & mengepel kamar" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span class ="check-label">Membersihkan meja & kursi</span><input type="checkbox" name="kamar_tidur[]" value="Membersihkan meja & kursi" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span class ="check-label">Membuka & Membersihkan jendela kamar</span><input type="checkbox" name="kamar_tidur[]" value="Membersihkan jendela kamar" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center"><span class ="check-label">Membuang sampah & mengganti plastik</span><input type="checkbox" name="kamar_tidur[]" value="Membuang sampah & mengganti plastik" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
  </div>
</div>

<!-- Area Kamar Mandi -->
<div id="areaMandi" class="bg-white rounded-2xl shadow p-6 mb-6 hidden" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="shower-head" class="w-5 h-5 text-blue-500"></i> Area Kamar Mandi
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3 checklist">
    <label class="flex justify-between items-center border-b pb-1"><span class ="check-label">Membersihkan lantai kamar mandi</span><input type="checkbox" name="kamar_mandi[]" value="Membersihkan lantai kamar mandi" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span class ="check-label">Membersihkan toilet</span><input type="checkbox" name="kamar_mandi[]" value="Membersihkan toilet" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span class ="check-label">Membersihkan wastafel & keran</span><input type="checkbox" name="kamar_mandi[]" value="Membersihkan wastafel & keran" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span class ="check-label">Memastikan saluran air lancar</span><input type="checkbox" name="kamar_mandi[]" value="Memastikan saluran air lancar" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center"><span class ="check-label">Mengganti handuk</span><input type="checkbox" name="kamar_mandi[]" value="Mengganti handuk" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
  </div>
</div>

<!-- Amenities & Perlengkapan -->
<div id="amenities" class="bg-white rounded-2xl shadow p-6 mb-6 hidden" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="package" class="w-5 h-5 text-blue-500"></i> Amenities & Perlengkapan
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3 checklist">
    <label class="flex justify-between items-center border-b pb-1"><span class ="check-label">Mengganti air mineral</span><input type="checkbox" name="amenities[]" value="Mengganti air mineral" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center"><span class ="check-label">Memastikan peralatan listrik (lampu, stop kontak, AC)</span><input type="checkbox" name="amenities[]" value="Memastikan peralatan listrik (lampu, stop kontak, AC)" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
  </div>
</div>

<!-- Area Koridor -->
<div id="areaKoridor" class="bg-white rounded-2xl shadow p-6 mb-6 hidden" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="layout" class="w-5 h-5 text-blue-500"></i> Area Koridor
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3 checklist">
    <label class="flex justify-between items-center border-b pb-1">
      <span class ="check-label">Menyapu seluruh area koridor</span><input type="checkbox" name="koridor[]" value="Menyapu seluruh area koridor" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110">
    </label>
    <label class="flex justify-between items-center border-b pb-1">
      <span class ="check-label">Mengepel lantai koridor</span><input type="checkbox" name="koridor[]" value="Mengepel lantai koridor" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110">
    </label>
    <label class="flex justify-between items-center border-b pb-1">
      <span class ="check-label">Membersihkan pagar/railing</span><input type="checkbox" name="koridor[]" value="Membersihkan pagar/railing" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110">
    </label>
    <label class="flex justify-between items-center">
      <span class ="check-label">Membersihkan dinding</span><input type="checkbox" name="koridor[]" value="Membersihkan dinding" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110">
    </label>
  </div>
</div>

<!-- Final Check -->
<div id="finalCheck" class="bg-white rounded-2xl shadow p-6 mb-6 hidden" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="check-circle" class="w-5 h-5 text-blue-500"></i> Final Check
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3 checklist">
    <label class="flex justify-between items-center border-b pb-1"><span class ="check-label">Pastikan semua area bersih & rapi</span><input type="checkbox" name="final_check[]"  value="Pastikan semua area bersih & rapi" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center"><span class ="check-label">Mengecek perlengkapan sesuai standar</span><input type="checkbox" name="final_check[]" value="Mengecek perlengkapan sesuai standar" class="check-item w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
  </div>
</div>

<!-- Upload Foto -->
<div id="uploadFoto" class="bg-white rounded-2xl shadow p-6 mb-6 hidden" data-aos="fade-up">
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
<div id="catatanKhusus" class="bg-white rounded-2xl shadow p-6 mb-6 hidden" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="alert-circle" class="w-5 h-5 text-blue-500"></i>
    Catatan Khusus / Kendala yang Ditemui
  </h2>
  <textarea name="catatan_kerusakan" rows="4" placeholder="Tuliskan kendala atau catatan khusus di sini..." 
    class="border rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-400"></textarea>
</div>

<!-- Progress Bar di Bawah -->
<div class="bg-white/90 backdrop-blur-md rounded-2xl shadow-lg p-6 mb-6 text-center" data-aos="fade-up">
  
  <!-- Progress Bar -->
  <div class="relative w-full bg-gray-200 rounded-full h-3 overflow-hidden">
    <div id="progress-bar" 
         class="absolute left-0 top-0 h-3 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-500 ease-out"
         style="width: 0%;">
    </div>
    <!-- Teks di Tengah Bar -->
    <span id="progress-text"
          class="absolute inset-0 flex items-center justify-center text-[11px] font-medium text-gray-700">
      0% Complete
    </span>
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








