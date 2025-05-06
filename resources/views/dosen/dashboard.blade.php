<x-layoutDosen>
  <div class="">
    <h1 class="font-bold text-gray-800 text-xl sm:text-2xl">{{ $title }}</h1>
    <p class="mt-1">Selamat Datang, <b>Syalia Ayu!!!</b></p>
    
    <!-- Card Statistik -->
    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4 mb-5">
      <!-- Total Mahasiswa -->
      <div class="w-[310px] md:w-full group bg-gradient-to-br from-cyan-100 to-cyan-300 rounded-xl shadow-md p-4 border-b-4 border-blue-800 
                  transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
        <h2 class="text-base font-semibold text-gray-700">Total Mahasiswa</h2>
        <div class="mt-3 flex items-center justify-between">
          <i class="bi bi-person-circle text-4xl text-blue-800"></i>
          <h1 class="text-2xl sm:text-3xl font-bold text-blue-800">2201</h1>
        </div>
      </div>

      <!-- Total Dosen -->
      <div class="w-[310px] md:w-full group bg-gradient-to-br from-purple-100 to-purple-300 rounded-xl shadow-md p-4 border-b-4 border-purple-800 
                  transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
        <h2 class="text-base font-semibold text-gray-700">Total Dosen</h2>
        <div class="mt-3 flex items-center justify-between">
          <i class="bi bi-person-workspace text-4xl text-purple-800"></i>
          <h1 class="text-2xl sm:text-3xl font-bold text-purple-800">112</h1>
        </div>
      </div>

      <!-- Total Mata Kuliah -->
      <div class="w-[310px] md:w-full group bg-gradient-to-br from-green-100 to-green-300 rounded-xl shadow-md p-4 border-b-4 border-green-800 
                  transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
        <h2 class="text-base font-semibold text-gray-700">Total Mata Kuliah</h2>
        <div class="mt-3 flex items-center justify-between">
          <i class="bi bi-journal-bookmark-fill text-4xl text-green-800"></i>
          <h1 class="text-2xl sm:text-3xl font-bold text-green-800">170</h1>
        </div>
      </div>

      <!-- Total Prodi -->
      <div class="w-[310px] md:w-full group bg-gradient-to-br from-red-100 to-red-300 rounded-xl shadow-md p-4 border-b-4 border-red-800 
                  transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
        <h2 class="text-base font-semibold text-gray-700">Total Program Studi</h2>
        <div class="mt-3 flex items-center justify-between">
          <i class="bi bi-book-half text-4xl text-red-800"></i>
          <h1 class="text-2xl sm:text-3xl font-bold text-red-800">2201</h1>
        </div>
      </div>
    </div>

    <!-- Grafik Absensi -->
    <div class="flex flex-col md:flex-row gap-5 mb-5">
      <!-- Grafik Bulanan -->
      <div class="w-[310px] md:w-3/4 bg-white rounded-sm shadow-xl">
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Absensi Mahasiswa Perbulan</h1>
        </div>
        <div class="p-6 overflow-x-auto">
          <div id="chart" class="w-full h-64 min-w-[300px]"></div>
        </div>
      </div>

      <!-- Grafik Tahunan -->
      <div class="w-[310px] md:w-1/4 bg-white rounded-sm shadow-xl">
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Absensi Mahasiswa Pertahun</h1>
        </div>
        <div class="p-6 overflow-x-auto">
          <div id="chart-doghout" class="w-full h-64 min-w-[300px]"></div>
        </div>
      </div>
    </div>

    <!-- Tabel & Grafik Absensi Dosen -->
    <div class="flex flex-col md:flex-row gap-5">
      <!-- Tabel Dosen -->
      <div class="w-[310px] md:w-1/2 bg-white rounded-sm shadow-xl">
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Daftar Dosen Mengajar</h1>
          <span class="text-sm text-gray-400">
            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
          </span>
        </div>
        <div class="overflow-x-auto px-4 pb-4 mt-5">
        </div>
      </div>

      <!-- Grafik Absensi Dosen -->
      <div class="w-[310px] md:w-1/2 bg-white rounded-sm shadow-xl">
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Absensi Dosen Perbulan</h1>
        </div>
        <div class="p-6 overflow-x-auto">
          <div id="chart-dosen" class="w-full h-64 min-w-[300px]"></div>
        </div>
      </div>
    </div>
  </div>
</x-layoutDosen>
