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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: #f9f9f9;
    }
    h1 {
      font-weight: 600;
    }
    .link-animate {
      transition: all 0.3s ease;
      font-weight: 400;
      position: relative;
      overflow: hidden;
    }
    .link-animate:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    }
    .pulse-icon {
      display: inline-block;
      animation: pulseIcon 2s infinite ease-in-out;
    }
    @keyframes pulseIcon {
      0%, 100% { transform: scale(1); opacity: 1; }
      50% { transform: scale(1.15); opacity: 0.85; }
    }
    .animate-fade-in {
      animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .card-hover:hover {
      box-shadow: 0 8px 24px rgba(0,0,0,0.15);
      transition: box-shadow 0.3s ease;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
  <div class="max-w-sm w-full bg-white rounded-2xl shadow-md overflow-hidden animate-fade-in card-hover p-6 text-center">
    
    <!-- Foto Profil Bulat -->
    <div class="w-28 h-28 rounded-full overflow-hidden mx-auto shadow-md border-2 border-gray-200 transition-transform duration-300 hover:scale-105">
      <img src="wargart.png" alt="Logo Warga RT BSDK" class="w-full h-full object-cover" />
    </div>

    <!-- Judul -->
    <h1 class="mt-4 text-2xl text-gray-800">WARGA RT BSDK</h1>
    <p class="text-gray-500 text-base mb-6 px-2 leading-relaxed">
      Wujud Asri, Rapi, Giat, Aman <br/> Rumah Tangga BSDK
    </p>

    <!-- Tombol Checklist -->
    <div class="space-y-3 text-base">
      <a href="checklist_asrama.php"
         class="link-animate flex items-center justify-center gap-2 w-full bg-pink-100 hover:bg-pink-200 text-pink-600 py-3 rounded-xl font-normal">
        <i class="fa-solid fa-bed pulse-icon"></i> Checklist Asrama
      </a>
      <a href="#"
         class="link-animate flex items-center justify-center gap-2 w-full bg-emerald-100 hover:bg-emerald-200 text-emerald-600 py-3 rounded-xl font-normal">
        <i class="fa-solid fa-building pulse-icon"></i> Checklist Gedung
      </a>
      <a href="#" 
         class="link-animate flex items-center justify-center gap-2 w-full bg-orange-100 hover:bg-orange-200 text-orange-600 py-3 rounded-xl font-normal">
        <i class="fa-solid fa-landmark pulse-icon"></i> Checklist Auditorium
      </a>
      <a href="#" 
         class="link-animate flex items-center justify-center gap-2 w-full bg-rose-100 hover:bg-rose-200 text-rose-600 py-3 rounded-xl font-normal">
        <i class="fa-solid fa-house pulse-icon"></i> Checklist Rumah Pimpinan
      </a>
      <a href="#" 
         class="link-animate flex items-center justify-center gap-2 w-full bg-green-100 hover:bg-green-200 text-green-600 py-3 rounded-xl font-normal">
        <i class="fa-solid fa-tree pulse-icon"></i> Checklist Taman
      </a>
      <a href="#" 
         class="link-animate flex items-center justify-center gap-2 w-full bg-indigo-100 hover:bg-indigo-200 text-indigo-600 py-3 rounded-xl font-normal">
        <i class="fa-solid fa-elevator pulse-icon"></i> Checklist Gondola
      </a>
      <a href="#" 
         class="link-animate flex items-center justify-center gap-2 w-full bg-yellow-100 hover:bg-yellow-200 text-yellow-600 py-3 rounded-xl font-normal">
        <i class="fa-solid fa-road pulse-icon"></i> Checklist General Cleaning
      </a>
    </div>

    <!-- Footer -->
    <p class="mt-6 text-xs text-gray-400">© <?php echo date("Y"); ?> Dibuat dengan ❤️ oleh WARGA RT BSDK</p>
  </div>
</body>
</html>