<?php
$title = "Asrama";
include 'header.php';
?>

<!-- Form Checklist -->
<form action="simpan_checklist.php" method="POST" enctype="multipart/form-data">

<!-- Informasi Dasar -->
<div class="bg-white rounded-2xl shadow-md p-6 mb-6" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2 text-gray-800">
    <i data-lucide="info" class="w-5 h-5 text-blue-500"></i>
    Informasi Dasar
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    
    <!-- Tanggal -->
    <div>
      <label class="flex items-center text-sm font-medium text-gray-600 mb-1">
        <i data-lucide="calendar" class="w-4 h-4 text-blue-500 mr-1"></i> Tanggal
      </label>
      <input type="date" name="tanggal" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 transition">
    </div>
    
    <!-- Nama Petugas -->
    <div>
      <label class="flex items-center text-sm font-medium text-gray-600 mb-1">
        <i data-lucide="user" class="w-4 h-4 text-blue-500 mr-1"></i> Nama Petugas
      </label>
      <input type="text" name="nama_petugas" placeholder="Masukkan nama petugas" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 transition">
    </div>
    
    <!-- Blok Asrama -->
    <div>
      <label class="flex items-center text-sm font-medium text-gray-600 mb-1">
        <i data-lucide="building-2" class="w-4 h-4 text-blue-500 mr-1"></i> Blok Asrama
      </label>
      <select name="asrama" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 transition">
        <option selected disabled>Pilih Asrama</option>
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
      <label class="flex items-center text-sm font-medium text-gray-600 mb-1">
        <i data-lucide="layers" class="w-4 h-4 text-blue-500 mr-1"></i> Lantai
      </label>
      <select name="lantai" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-400 transition">
        <option selected disabled>Pilih Lantai</option>
        <option>Lantai 1</option>
        <option>Lantai 2</option>
        <option>Lantai 3</option>
        <option>Lantai 4</option>
        <option>Koridor</option>
      </select>
    </div>
    
  </div>
</div>

<!-- Area Kamar -->
<div class="bg-white rounded-2xl shadow p-6 mb-6" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="bed" class="w-5 h-5 text-blue-500"></i> Area Kamar
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3 checklist">
    <label class="flex justify-between items-center border-b pb-1"><span>Merapikan tempat tidur</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span>Menyapu & mengepel kamar</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span>Membersihkan meja & kursi</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center"><span>Membersihkan jendela kamar</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
  </div>
</div>

<!-- Area Kamar Mandi -->
<div class="bg-white rounded-2xl shadow p-6 mb-6" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="shower-head" class="w-5 h-5 text-blue-500"></i> Area Kamar Mandi
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3 checklist">
    <label class="flex justify-between items-center border-b pb-1"><span>Membersihkan lantai kamar mandi</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span>Membersihkan toilet</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span>Membersihkan wastafel</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center"><span>Mengganti handuk/alat mandi</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
  </div>
</div>

<!-- Amenities & Perlengkapan -->
<div class="bg-white rounded-2xl shadow p-6 mb-6" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="package" class="w-5 h-5 text-blue-500"></i> Amenities & Perlengkapan
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3 checklist">
    <label class="flex justify-between items-center border-b pb-1"><span>Cek sabun/shampoo</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span>Cek handuk & keset</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span>Cek perlengkapan tidur</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center"><span>Cek peralatan listrik (lampu, stop kontak)</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
  </div>
</div>

<!-- Area Koridor -->
<div class="bg-white rounded-2xl shadow p-6 mb-6" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="layout" class="w-5 h-5 text-blue-500"></i> Area Koridor
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3 checklist">
    <label class="flex justify-between items-center border-b pb-1">
      <span>Menyapu seluruh area koridor</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110">
    </label>
    <label class="flex justify-between items-center border-b pb-1">
      <span>Mengepel lantai koridor</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110">
    </label>
    <label class="flex justify-between items-center border-b pb-1">
      <span>Membersihkan pagar/railing</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110">
    </label>
    <label class="flex justify-between items-center">
      <span>Membersihkan dinding</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110">
    </label>
  </div>
</div>

<!-- Final Check -->
<div class="bg-white rounded-2xl shadow p-6 mb-6" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="check-circle" class="w-5 h-5 text-blue-500"></i> Final Check
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-3 checklist">
    <label class="flex justify-between items-center border-b pb-1"><span>Pastikan semua area bersih & rapi</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span>Cek ventilasi & sirkulasi udara</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center border-b pb-1"><span>Pastikan akses jalan tidak terhalang</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
    <label class="flex justify-between items-center"><span>Dokumentasi sudah lengkap</span><input type="checkbox" class="w-4 h-4 accent-blue-500 transform transition-transform duration-300 hover:scale-110"></label>
  </div>
</div>

<!-- Upload Foto -->
<div class="bg-white rounded-2xl shadow p-6 mb-6" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="image" class="w-5 h-5 text-blue-500"></i> Upload Foto Dokumentasi
  </h2>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <!-- Foto Pekerjaan -->
    <label class="border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center p-6 cursor-pointer hover:border-blue-400 transition">
      <i data-lucide="upload" class="w-6 h-6 text-gray-400 mb-2"></i>
      <span class="text-sm font-medium text-gray-700">Foto Pekerjaan</span>
      <input type="file" class="hidden">
    </label>
    <!-- Foto Kerusakan -->
    <label class="border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center p-6 cursor-pointer hover:border-blue-400 transition">
      <i data-lucide="upload" class="w-6 h-6 text-gray-400 mb-2"></i>
      <span class="text-sm font-medium text-gray-700">Foto Kerusakan</span>
      <input type="file" class="hidden">
    </label>
    <!-- Foto Pelayanan -->
    <label class="border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center p-6 cursor-pointer hover:border-blue-400 transition">
      <i data-lucide="upload" class="w-6 h-6 text-gray-400 mb-2"></i>
      <span class="text-sm font-medium text-gray-700">Foto Pelayanan</span>
      <input type="file" class="hidden">
    </label>
  </div>
</div>

<!-- Catatan Khusus / Kendala -->
<div class="bg-white rounded-2xl shadow p-6 mb-6" data-aos="fade-up">
  <h2 class="text-lg font-semibold mb-4 flex items-center gap-2">
    <i data-lucide="alert-circle" class="w-5 h-5 text-blue-500"></i>
    Catatan Khusus / Kendala yang Ditemui
  </h2>
  <textarea rows="4" placeholder="Tuliskan kendala atau catatan khusus di sini..." 
    class="border rounded-lg p-3 w-full focus:ring-2 focus:ring-blue-400"></textarea>
</div>

<!-- Progress Bar di Bawah -->
<div class="bg-white rounded-2xl shadow p-6 mb-6 text-center" data-aos="fade-up">
  <!-- Progress Info -->
  <div class="flex justify-between text-xs text-gray-500 mb-1">
    <span>0%</span><span>100%</span>
  </div>

  <div class="w-full bg-gray-200 rounded-full h-2">
    <div id="progress-bar" class="bg-blue-500 h-2 rounded-full transition-all" style="width: 0%;"></div>
  </div>
  <p id="progress-text" class="text-xs text-gray-500 mt-1">0% Complete</p>

  <!-- Tombol -->
  <div class="flex justify-between mt-6 mb-6">
    <button type="button" id="resetBtn" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg font-medium">Reset Form</button>
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 font-medium">Simpan Checklist</button>
  </div>

  <!-- Footer -->
  <p class="mt-6 text-xs text-gray-400">© <?php echo date("Y"); ?> Dibuat dengan ❤️ oleh WARGA RT BSDK</p>
</div>

<?php include 'footer.php'; ?>








