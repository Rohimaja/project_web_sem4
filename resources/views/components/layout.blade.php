<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Stipres Absensi</title>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" />
  <!-- JS (jQuery + DataTables) -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

</head>
<body class="bg-gray-100">
  <div x-data="{isSideMenuOpen: false}" @resize.window="if (window.innerWidth >= 1280) isSideMenuOpen = false" class="flex h-screen">
    <x-sidebar></x-sidebar>

    <div class="xl:ml-64 ease-in-out duration-200 flex flex-col flex-1">
        <x-navbar></x-navbar>
        <div
          x-bind:class="isSideMenuOpen ? 'opacity-70 pointer-events-auto' : 'opacity-0 pointer-events-none'"
          class="fixed inset-0 z-20 bg-gray-600 transition-opacity duration-300"
        ></div>

        <main class="relative mt-16 xl:mt-0 p-6 bg-gray-100">
          
          <div>
            {{ $slot }}
          </div>
        </main>
    </div>
  </div>
</body>
</html>