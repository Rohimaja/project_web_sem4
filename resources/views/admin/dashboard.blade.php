<x-layout>
  <div>
    <h1 class="font-bold text-gray-800 text-2xl">{{ $title }}</h1>
    <p>Selamat Datang, <b>Syalia Ayu!!!</b></p>
    
    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4 mb-5">
      <!-- Card Template -->
      <div class="group bg-gradient-to-br from-cyan-100 to-cyan-300 rounded-xl shadow-md p-4 border-b-4 border-blue-800 
                  transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
        <h2 class="text-base font-semibold text-gray-700">Total Mahasiswa</h2>
        <div class="mt-3 flex items-center justify-between">
          <i class="bi bi-person-circle text-4xl text-blue-800"></i>
          <h1 class="text-3xl font-bold text-blue-800">2201</h1>
        </div>
      </div>
    
      <div class="group bg-gradient-to-br from-purple-100 to-purple-300 rounded-xl shadow-md p-4 border-b-4 border-purple-800 
                  transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
        <h2 class="text-base font-semibold text-gray-700">Total Dosen</h2>
        <div class="mt-3 flex items-center justify-between">
          <i class="bi bi-person-workspace text-4xl text-purple-800"></i>
          <h1 class="text-3xl font-bold text-purple-800">112</h1>
        </div>
      </div>
    
      <div class="group bg-gradient-to-br from-green-100 to-green-300 rounded-xl shadow-md p-4 border-b-4 border-green-800 
                  transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
        <h2 class="text-base font-semibold text-gray-700">Total Mata Kuliah</h2>
        <div class="mt-3 flex items-center justify-between">
          <i class="bi bi-journal-bookmark-fill text-4xl text-green-800"></i>
          <h1 class="text-3xl font-bold text-green-800">170</h1>
        </div>
      </div>
    
      <div class="group bg-gradient-to-br from-red-100 to-red-300 rounded-xl shadow-md p-4 border-b-4 border-red-800 
                  transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
        <h2 class="text-base font-semibold text-gray-700">Total Program Studi</h2>
        <div class="mt-3 flex items-center justify-between">
          <i class="bi bi-book-half text-4xl text-red-800"></i>
          <h1 class="text-3xl font-bold text-red-800">2201</h1>
        </div>
      </div>
    </div>

    <div class="flex flex-col md:flex-row gap-5 mb-5">
      <!-- Absensi Mahasiswa Perbulan (Chart Utama) -->
      <div class="w-full md:w-3/4 bg-white rounded-sm shadow-xl">
        <!-- Header -->
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Absensi Mahasiswa Perbulan</h1>
        </div>
        
        <!-- Chart -->
        <div class="p-6">
          <div id="chart" class="w-full h-64"></div>
        </div>
      </div>
    
      <!-- Absensi Mahasiswa Perbulan (Chart Kedua) -->
      <div class="w-full md:w-1/4 bg-white rounded-sm shadow-xl">
        <!-- Header -->
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Absensi Mahasiswa Pertahun</h1>
        </div>
        
        <!-- Chart -->
        <div class="p-6">
          <div id="chart-doghout" class="w-full h-64"></div>
        </div>
      </div>
    </div>

    <div class="flex flex-col md:flex-row gap-5">
      <div class="w-full md:w-1/2 bg-white rounded-sm shadow-xl">
        <!-- Header -->
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Daftar Dosen Mengajar </h1>
          <span class="text-sm text-gray-400">
            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
          </span>
        </div>
        
        <div class="overflow-x-auto px-4 pb-4 mt-5">
          <table class="w-full text-left border border-gray-200">
            <thead class="bg-gray-100 text-gray-700">
              <tr>
                <th class="px-4 py-2 border-b">No</th>
                <th class="px-4 py-2 border-b">Nama Dosen</th>
                <th class="px-4 py-2 border-b">Mata Kuliah</th>
                <th class="px-4 py-2 border-b">Hari</th>
              </tr>
            </thead>
            <tbody class="text-gray-700">
              <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border-b">1</td>
                <td class="px-4 py-2 border-b">Dr. Ahmad Yani</td>
                <td class="px-4 py-2 border-b">Pemrograman Web</td>
                <td class="px-4 py-2 border-b">Senin</td>
              </tr>
              <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border-b">2</td>
                <td class="px-4 py-2 border-b">Prof. Lina Marlina</td>
                <td class="px-4 py-2 border-b">Basis Data</td>
                <td class="px-4 py-2 border-b">Selasa</td>
              </tr>
              <tr class="hover:bg-gray-50">
                <td class="px-4 py-2 border-b">3</td>
                <td class="px-4 py-2 border-b">Ir. Budi Santoso</td>
                <td class="px-4 py-2 border-b">Jaringan Komputer</td>
                <td class="px-4 py-2 border-b">Rabu</td>
              </tr>
              <!-- Tambahkan baris lain jika perlu -->
            </tbody>
          </table>
        </div>
        
      </div>

      <div class="w-full md:w-1/2 bg-white rounded-sm shadow-xl">
        <!-- Header -->
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Absensi Dosen perbulan</h1>
        </div>
        
        <!-- Chart -->
        <div class="p-6">
          <div id="chart-dosen" class="w-full h-64"></div>
        </div>
      </div>
    </div>
  </div>
</div>
</x-layout>