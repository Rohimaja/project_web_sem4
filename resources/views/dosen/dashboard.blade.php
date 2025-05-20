<x-layout>
  <div class="">
    <x-slot:title>{{ $title }}</x-slot:title>
    <h1 class="font-bold text-gray-800 text-xl sm:text-2xl">{{ $title }}</h1>
    <p class="mb-4">Hari ini: <span class="text-md text-gray-800">
      {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
    </span>
    </p>

    <div class="flex flex-col md:flex-row gap-5 mb-5">
      <!-- Greeting -->
      <div class="p-6 bg-gradient-to-r from-sky-600 to-cyan-500 text-white w-full flex-col md:flex-row md:w-1/2 rounded-xl shadow-lg flex items-center gap-4">
        <!-- Gambar -->
        <img src="/images/img-halo.jpg" alt="Halo" class="w-20 h-20 rounded-full object-cover shadow-md">
      
        <!-- Teks Sapaan -->
        <div>
          <h2 class="text-xl md:text-2xl font-semibold leading-relaxed">
            Selamat datang, Bapak/Ibu <span class="font-bold">Syalia Ayu Ambarwita</span> 👋
          </h2>
          <p class="mt-2">Semoga harimu menyenangkan dan produktif!</p>
        </div>
      </div>
      
    
      <!-- Info box -->
      <div class="p-6 bg-white w-full md:w-1/2 rounded-xl shadow-lg border border-gray-200">
        <h2 class="text-lg md:text-xl font-semibold text-gray-800 mb-3 flex items-center gap-2">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-cyan-500" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          Informasi Hari Ini
        </h2>
    
        <div class="text-sm text-gray-700 space-y-3">
          <p>📅 <span class="font-medium">Tanggal:</span>
            <span class="text-gray-900">
              {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
            </span>
          </p>
          <p>🕘 <span class="font-medium">Jadwal Mengajar Hari Ini:</span> 2 kelas</p>
          <p>✅ <span class="font-medium">Presensi:</span> 1 dari 2 kelas sudah dipresensi</p>
          <p>📢 <span class="font-medium">Pengumuman:</span> Sistem presensi ditutup pukul 23:59 WIB.</p>
        </div>
      </div>
    </div>
    
    
    <div class="flex flex-col md:flex-row gap-5">
      <!-- Tabel Dosen -->
      <div class="w-[310px] md:w-3/4 bg-white rounded-sm shadow-xl">
        <div class="p-4 rounded-t-xl border-b-2 border-gray-300 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Jadwal Mengajar Hari Ini</h1>
          <span class="text-sm text-gray-400">
            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
          </span>
        </div>
        <div class="overflow-auto h-[300px] px-4 pb-4 mt-5">
          <div class="overflow-x-auto min-w-[600px] w-full">
            <table class="w-full text-sm text-left text-gray-700 border border-gray-200">
              <thead class="bg-gray-300 text-gray-800 sticky top-0 z-10">
                <tr>
                  <th class="px-4 py-3 border-b text-center border-gray-300 rounded-tl-lg">Jam</th>
                  <th class="px-4 py-3 border-b text-center border-gray-300">Mata Kuliah</th>
                  <th class="px-4 py-3 border-b text-center border-gray-300">Program Studi</th>
                  <th class="px-4 py-3 border-b text-center border-gray-300">Kelas</th>
                  <th class="px-4 py-3 border-b text-center border-gray-300">Semester</th>
                  <th class="px-4 py-3 border-b text-center border-gray-300 rounded-tr-lg">Ruangan</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr class="even:bg-gray-50 hover:bg-gray-100 transition duration-150">
                  <td class="px-4 py-3 border-t border-gray-200">08.00 - 10.00</td>
                  <td class="px-4 py-3 border-t border-gray-200">Metodologi Ilmu</td>
                  <td class="px-4 py-3 border-t border-gray-200">Manajemen Kesehatan</td>
                  <td class="px-4 py-3 border-t border-gray-200">Inter A</td>
                  <td class="px-4 py-3 border-t border-gray-200">4</td>
                  <td class="px-4 py-3 border-t border-gray-200">Lt4</td>
                </tr>
                <tr class="even:bg-gray-50 hover:bg-gray-100 transition duration-150">
                  <td class="px-4 py-3 border-t border-gray-200">08.00 - 10.00</td>
                  <td class="px-4 py-3 border-t border-gray-200">Metodologi Ilmu</td>
                  <td class="px-4 py-3 border-t border-gray-200">Manajemen Kesehatan</td>
                  <td class="px-4 py-3 border-t border-gray-200">Inter A</td>
                  <td class="px-4 py-3 border-t border-gray-200">4</td>
                  <td class="px-4 py-3 border-t border-gray-200">Lt4</td>
                </tr>
                <tr class="even:bg-gray-50 hover:bg-gray-100 transition duration-150">
                  <td class="px-4 py-3 border-t border-gray-200">08.00 - 10.00</td>
                  <td class="px-4 py-3 border-t border-gray-200">Metodologi Ilmu</td>
                  <td class="px-4 py-3 border-t border-gray-200">Manajemen Kesehatan</td>
                  <td class="px-4 py-3 border-t border-gray-200">Inter A</td>
                  <td class="px-4 py-3 border-t border-gray-200">4</td>
                  <td class="px-4 py-3 border-t border-gray-200">Lt4</td>
                </tr>
                <tr class="even:bg-gray-50 hover:bg-gray-100 transition duration-150">
                  <td class="px-4 py-3 border-t border-gray-200">08.00 - 10.00</td>
                  <td class="px-4 py-3 border-t border-gray-200">Metodologi Ilmu</td>
                  <td class="px-4 py-3 border-t border-gray-200">Manajemen Kesehatan</td>
                  <td class="px-4 py-3 border-t border-gray-200">Inter A</td>
                  <td class="px-4 py-3 border-t border-gray-200">4</td>
                  <td class="px-4 py-3 border-t border-gray-200">Lt4</td>
                </tr>
                <tr class="even:bg-gray-50 hover:bg-gray-100 transition duration-150">
                  <td class="px-4 py-3 border-t border-gray-200">08.00 - 10.00</td>
                  <td class="px-4 py-3 border-t border-gray-200">Metodologi Ilmu</td>
                  <td class="px-4 py-3 border-t border-gray-200">Manajemen Kesehatan</td>
                  <td class="px-4 py-3 border-t border-gray-200">Inter A</td>
                  <td class="px-4 py-3 border-t border-gray-200">4</td>
                  <td class="px-4 py-3 border-t border-gray-200">Lt4</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>        
      </div>

      <div class="w-[310px] md:w-1/2 bg-white rounded-sm shadow-xl">
        <div class="p-4 rounded-t-xl border-b-2 border-gray-300 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Ringkasan Presensi Dosen</h1>
        </div>
        <div class="p-4 overflow-x-auto">
          <p class="text-gray-500 text-sm">Statistik presensi dosen selama 1 semester:</p>
          <div id="chart-doghout-dosen" class="w-full h-64 min-w-[300px]"></div>
        </div>
      </div>
    </div>
  </div>
</x-layout>
