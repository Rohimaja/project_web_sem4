<x-layout>
  <div class="dark:text-white dark:bg-gray-700">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p class="mb-4">Hari ini: 
      <span class="text-md text-gray-800 dark:text-gray-200">
        {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
      </span>
    </p>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
      <!-- KIRI -->
      <div class="flex flex-col justify-between rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 h-full bg-white dark:bg-gray-800">

        <!-- Ucapan Selamat -->
        <div class="bg-gradient-to-br from-sky-500 via-cyan-500 to-teal-400 text-white rounded-2xl p-6 py-12 mb-6 flex items-center gap-4 shadow-md">
          <div>
            <h2 class="text-2xl font-bold">
              Selamat datang, <br>
              <span class="font-extrabold">{{$user->nama}}</span> 👋
            </h2>
            <p class="text-sm mt-1">Semoga harimu menyenangkan dan produktif!</p>
          </div>
        </div>
      </div>

      <!-- KANAN: Grafik -->
      <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 h-full flex flex-col">
        <h2 class="text-xl font-semibold text-gray-400 dark:text-gray-300 mb-4">Grafik Kehadiran Bulanan</h2>
        <div id="grafik-kehadiran" class="w-full h-64 bg-gray-100 dark:bg-gray-700 rounded-md"></div>
      </div>
    </div>

    <div class="flex flex-col md:flex-row gap-5">
      <div class="w-[310px] md:w-3/4 bg-white dark:bg-gray-800 rounded-sm shadow-xl">
        <!-- Header -->
        <div class="mb-3 p-4 rounded-t-xl border-b-2 border-gray-300 dark:border-gray-700 flex justify-between items-center flex-wrap gap-2">
          <h1 class="text-gray-500 dark:text-gray-300 text-lg font-semibold">Daftar Dosen Mengajar Hari Ini</h1>
          <input
            type="text"
            id="searchInput"
            placeholder="Cari..."
            class="w-full md:w-[200px] text-sm border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400"
          >
        </div>

        <!-- Tabel Scrollable -->
        <div class="px-3 pb-3 overflow-x-auto max-h-[400px] overflow-y-auto">
          <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm" id="dosenTable">
            <thead class="bg-gray-100 dark:bg-gray-700 sticky top-0 z-10 text-gray-700 dark:text-gray-200">
              <tr>
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">Program Studi</th>
                <th class="px-4 py-2 text-left">Semester</th>
                <th class="px-4 py-2 text-left">Mata Kuliah</th>
                <th class="px-4 py-2 text-left">Ruangan</th>
                <th class="px-4 py-2 text-left">Jam Perkuliahan</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-700 dark:text-gray-200">
                @foreach ($presensiHariIni as $p)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-4 py-2">{{ $loop->iteration }}</td>
                    <td class="px-4 py-2">{{$p->prodi->nama_prodi}}</td>
                    <td class="px-4 py-2">{{$p->semester}}</td>
                    <td class="px-4 py-2">{{$p->matkul->nama_matkul}}</td>
                    <td class="px-4 py-2">{{$p->ruangan->nama_ruangan}}</td>
                    <td class="px-4 py-2">{{substr($p->jam_awal,0,5) .' - '. substr($p->jam_akhir,0,5)}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Mahasiswa Tidak Hadir -->
      <div class="w-[310px] md:w-1/4 bg-white dark:bg-gray-800 rounded-md shadow-xl">
        <div class="p-4 border-b-2 border-gray-300 dark:border-gray-700 flex justify-between items-center">
          <h1 class="text-gray-500 dark:text-gray-300 text-lg font-semibold tracking-wide">Mahasiswa Tidak Hadir Hari Ini</h1>
        </div>
        <div class="p-4 space-y-4 text-sm text-gray-700 dark:text-gray-200 max-h-[430px] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 dark:scrollbar-thumb-gray-600 scrollbar-track-gray-100 dark:scrollbar-track-gray-800">
          @foreach (range(1, 10) as $i)
          <div class="item-mahasiswa flex items-start gap-4 p-3 rounded-md border border-red-200 dark:border-red-400 hover:shadow transition-all">
            <img src="https://ui-avatars.com/api/?name=P+Budiyanto&background=EF4444&color=fff"
                 alt="P Budiyanto"
                 class="w-12 h-12 rounded-full object-cover">

            <div class="flex-1">
              <p class="nama font-semibold text-gray-800 dark:text-white">P Budiyanto</p>
              <p class="text-xs text-gray-500 dark:text-gray-300 mb-1">MIK - Semester 2 • English</p>

              <div class="flex flex-wrap gap-2 text-xs text-gray-600 dark:text-gray-200 mb-1">
                <span class="bg-blue-100 dark:bg-blue-600 text-blue-600 dark:text-white px-2 py-1 rounded-md">Ruangan: 3.2</span>
                <span class="bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-white px-2 py-1 rounded-md">08.00 - 10.00</span>
              </div>

              <!-- Status Alpha -->
              <span class="inline-block text-xs font-medium text-red-700 bg-red-100 dark:bg-red-600 dark:text-white px-2 py-0.5 rounded-md">
                Alpha
              </span>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</x-layout>
