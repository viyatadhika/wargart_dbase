<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Checklist Cleaning Service</title>
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
    <div class="bg-white rounded-2xl shadow p-6 text-center mb-6">
      <h1 class="flex items-center justify-center gap-2 text-xl md:text-2xl lg:text-3xl font-extrabold tracking-tight text-gray-800">
        <i data-lucide="check-square" class="w-6 h-6 text-blue-500"></i>
        Checklist Cleaning Service
      </h1>
      <p class="text-xs md:text-sm lg:text-base text-gray-500 mt-1">
        Form Pemeriksaan & Dokumentasi 
        <?php 
          // cek apakah variabel title sudah di-set
          if (isset($title) && !empty($title)) {
            echo htmlspecialchars($title);
          } else {
            echo "Umum"; // default kalau $title tidak diisi
          }
        ?>
      </p>
    </div>
