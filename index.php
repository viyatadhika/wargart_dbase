<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>WARGA RT BSDK</title>
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" crossorigin="anonymous" />
  
  <!-- Google Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      background: #f9f9f9;
    }
    .animate-fade-in {
      animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .pulse-icon {
      animation: pulseIcon 2s infinite ease-in-out;
    }
    @keyframes pulseIcon {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.15); opacity: 0.85; }
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  <div class="max-w-sm w-full bg-white/80 backdrop-blur-md rounded-3xl shadow-lg overflow-hidden animate-fade-in p-6 text-center">
    
    <!-- Foto Profil Bulat -->
    <div class="w-28 h-28 rounded-full overflow-hidden mx-auto shadow-md border-2 border-gray-200 transition-transform duration-300 hover:scale-105">
      <img src="wargart.png" alt="Logo Warga RT BSDK" class="w-full h-full object-cover" />
    </div>

    <!-- Judul -->
    <h1 class="mt-4 text-2xl font-semibold text-gray-800">WARGA RT BSDK</h1>
    <p class="text-gray-500 text-base mb-6 px-2 leading-relaxed">
      Wujud Asri, Rapi, Giat, Aman <br/> Rumah Tangga BSDK
    </p>

    <!-- Tombol Checklist -->
    <div class="space-y-3 text-base font-medium">
      <a href="checklist_asrama.php"
         class="flex items-center justify-center gap-2 w-full py-3 rounded-full 
                bg-gradient-to-r from-pink-400 to-pink-500 text-white 
                shadow-md hover:shadow-lg active:scale-95 transition">
        <i class="fa-solid fa-bed pulse-icon"></i> Checklist Asrama
      </a>
      <a href="checklist_gedung.php"
         class="flex items-center justify-center gap-2 w-full py-3 rounded-full 
                bg-gradient-to-r from-emerald-400 to-emerald-500 text-white 
                shadow-md hover:shadow-lg active:scale-95 transition">
        <i class="fa-solid fa-building pulse-icon"></i> Checklist Gedung
      </a>
      <a href="checklist_auditorium.php"
         class="flex items-center justify-center gap-2 w-full py-3 rounded-full 
                bg-gradient-to-r from-orange-400 to-orange-500 text-white 
                shadow-md hover:shadow-lg active:scale-95 transition">
        <i class="fa-solid fa-landmark pulse-icon"></i> Checklist Auditorium
      </a>
      <a href="checklist_rumah_pimpinan.php"
         class="flex items-center justify-center gap-2 w-full py-3 rounded-full 
                bg-gradient-to-r from-rose-400 to-rose-500 text-white 
                shadow-md hover:shadow-lg active:scale-95 transition">
        <i class="fa-solid fa-house pulse-icon"></i> Checklist Rumah Pimpinan
      </a>
      <a href="checklist_taman.php"
         class="flex items-center justify-center gap-2 w-full py-3 rounded-full 
                bg-gradient-to-r from-green-400 to-green-500 text-white 
                shadow-md hover:shadow-lg active:scale-95 transition">
        <i class="fa-solid fa-tree pulse-icon"></i> Checklist Taman
      </a>
      <a href="checklist_gondola.php"
         class="flex items-center justify-center gap-2 w-full py-3 rounded-full 
                bg-gradient-to-r from-indigo-400 to-indigo-500 text-white 
                shadow-md hover:shadow-lg active:scale-95 transition">
        <i class="fa-solid fa-elevator pulse-icon"></i> Checklist Gondola
      </a>
      <a href="checklist_general_cleaning.php"
         class="flex items-center justify-center gap-2 w-full py-3 rounded-full 
                bg-gradient-to-r from-yellow-400 to-yellow-500 text-white 
                shadow-md hover:shadow-lg active:scale-95 transition">
        <i class="fa-solid fa-road pulse-icon"></i> Checklist General Cleaning
      </a>
    </div>

    <!-- Footer -->
    <p class="mt-6 text-xs text-gray-400">© <?php echo date("Y"); ?> Dibuat dengan ❤️ oleh WARGA RT BSDK</p>
  </div>
</body>
</html>
