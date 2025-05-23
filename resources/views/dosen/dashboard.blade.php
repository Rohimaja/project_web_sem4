<x-layout>
  <div class="">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p class="mb-4">Hari ini: <span class="text-md text-gray-800">
      {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
    </span>
    </p>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
      <!-- KIRI -->
      <div class="flex flex-col justify-between rounded-xl shadow-lg p-6 border border-gray-200 h-full bg-white">

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

        <!-- Kotak Info -->
        {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Box 1 -->
          <div class="bg-blue-50 rounded-md p-5 border border-blue-200 hover:shadow-lg transition duration-200">
            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-sm font-medium text-blue-700">Jadwal Hari Ini</h3>
                <p class="text-4xl font-bold text-blue-600 mt-2">{{$presensiHariIni}} Kelas</p>
              </div>
              <div class="text-blue-500 text-3xl">
                <i class="bi bi-calendar-event-fill"></i>
              </div>
            </div>
          </div>

          <!-- Box 2 -->
          <div class="bg-green-50 rounded-md p-5 border border-green-200 hover:shadow-lg transition duration-200">
            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-sm font-medium text-green-700">Sudah Presensi</h3>
                <p class="text-4xl font-bold text-green-600 mt-2">1 Kelas</p>
              </div>
              <div class="text-green-500 text-3xl">
                <i class="bi bi-check2-circle"></i>
              </div>
            </div>
          </div>
        </div> --}}
      </div>

      <!-- KANAN: Grafik -->
      <div class="bg-white rounded-xl shadow-lg p-6 border border-gray-100 h-full flex flex-col">
        <h2 class="text-xl font-semibold text-gray-400 mb-4">Grafik Kehadiran Bulanan</h2>
        <div id="grafik-kehadiran" class="w-full h-64 bg-gray-100 rounded-md"></div>
      </div>
    </div>


    <div class="flex flex-col md:flex-row gap-5">
      <div class="w-[310px] md:w-3/4 bg-white rounded-sm shadow-xl">
        <!-- Header -->
        <div class="mb-3 p-4 rounded-t-xl border-b-2 border-gray-300 flex justify-between items-center flex-wrap gap-2">
          <h1 class="text-gray-500 text-lg font-semibold">Daftar Dosen Mengajar Hari Ini</h1>
          <input
            type="text"
            id="searchInput"
            placeholder="Cari..."
            class="w-full md:w-[200px] text-sm border border-gray-300 rounded-md px-3 py-1 focus:outline-none focus:ring-2 focus:ring-blue-400"
          >
        </div>

        <!-- Tabel Scrollable -->
        <div class="px-3 pb-3 overflow-x-auto max-h-[400px] overflow-y-auto">
          <table class="min-w-full divide-y divide-gray-200 text-sm" id="dosenTable">
            <thead class="bg-gray-100 sticky top-0 z-10 text-gray-700">
              <tr>
                <th class="px-4 py-2 text-left">No</th>
                <th class="px-4 py-2 text-left">Program Studi</th>
                <th class="px-4 py-2 text-left">Semester</th>
                <th class="px-4 py-2 text-left">Mata Kuliah</th>
                <th class="px-4 py-2 text-left">Ruangan</th>
                <th class="px-4 py-2 text-left">Jam Perkuliahan</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 text-gray-700">
                @foreach ($presensiHariIni as $p)
                <tr class="hover:bg-gray-50">
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

      <div class="w-[310px] md:w-1/4 bg-white rounded-md shadow-xl">
        <div class="p-4 border-b-2 border-gray-300 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold tracking-wide">Mahasiswa Tidak Hadir Hari Ini</h1>
        </div>
        <div class="p-4 space-y-4 text-sm text-gray-700 max-h-[430px] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
          @foreach (range(1, 10) as $i)
          <div class="item-mahasiswa flex items-start gap-4 p-3 rounded-md border border-red-200 hover:shadow transition-all">
            <img src="https://ui-avatars.com/api/?name=P+Budiyanto&background=EF4444&color=fff"
                 alt="P Budiyanto"
                 class="w-12 h-12 rounded-full object-cover">

            <div class="flex-1">
              <p class="nama font-semibold text-gray-800">P Budiyanto</p>
              <p class="text-xs text-gray-500 mb-1">MIK - Semester 2 • English</p>

              <div class="flex flex-wrap gap-2 text-xs text-gray-600 mb-1">
                <span class="bg-blue-100 text-blue-600 px-2 py-1 rounded-md">Ruangan: 3.2</span>
                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-md">08.00 - 10.00</span>
              </div>

              <!-- Status Alpha -->
              <span class="inline-block text-xs font-medium text-red-700 bg-red-100 px-2 py-0.5 rounded-md">
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
