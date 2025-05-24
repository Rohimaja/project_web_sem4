<x-layout>
  <x-slot:title>{{ $title }}</x-slot:title>
  <p class="mb-3 text-gray-600 dark:text-gray-300">Hari Ini: <span class="text-md text-gray-800 dark:text-white">
    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
  </span></p>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="lg:col-span-2 flex flex-col gap-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 space-y-6 border border-gray-200 dark:border-gray-700">
                <div class="bg-gradient-to-br from-sky-500 via-cyan-500 to-teal-400
                    dark:bg-gradient-to-br dark:from-indigo-900 dark:via-blue-800 dark:to-teal-900
                text-white rounded-2xl p-6 sm:p-10 py-10 flex flex-col sm:flex-row items-center sm:items-start gap-6 shadow-md">
                    <img src="{{ asset('images/halo.png') }}" alt="Halo Image" class="w-24 h-24 sm:w-28 sm:h-28 object-cover rounded-full border-4 border-white shadow-md">
                    <div class="text-center sm:text-left">
                        <h2 class="text-2xl sm:text-3xl font-bold leading-snug">
                            Selamat datang, <br>
                            <span class="font-extrabold text-white drop-shadow-md">{{Auth::user()->name ?? ''}}</span> 👋
                        </h2>
                        <p class="text-sm sm:text-base mt-2 text-white/90">Semoga harimu menyenangkan dan produktif!</p>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 flex flex-col">
                <h2 class="text-xl font-semibold text-gray-400 dark:text-gray-200 mb-4">Grafik Kehadiran</h2>
                <div id="grafik-kehadiran-mhs" class="w-full h-64 bg-gray-100 dark:bg-gray-700 rounded-md"></div>
            </div>
        </div>

        <div class="flex flex-col gap-6">

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-2 border border-gray-100 dark:border-gray-700 flex flex-col">
            <div class="bg-green-50 dark:bg-green-900 rounded-md p-5 border border-green-200 dark:border-green-700 hover:shadow-lg transition duration-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-green-700 dark:text-green-200">Sudah Presensi Hari Ini</h3>
                        <p class="text-4xl font-bold text-green-600 dark:text-green-400 mt-2">1 Kelas</p>
                    </div>
                    <div class="text-green-500 dark:text-green-300 text-3xl">
                        <i class="bi bi-check2-circle"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-200 dark:border-gray-700 h-full">
            <h2 class="text-lg font-semibold text-gray-600 dark:text-gray-100 mb-6 border-b border-gray-200 dark:border-gray-600 pb-3">Biodata Mahasiswa</h2>

            <div class="flex flex-col items-center text-sm text-gray-700 dark:text-gray-300 space-y-4">
            <!-- Foto -->
                <img src="{{ asset('images/profil.jpg') }}" alt="Foto Mahasiswa"
                class="w-28 h-28 rounded-full object-cover border-4 border-sky-500 shadow-md">

            <!-- Data Mahasiswa -->
            {{-- @foreach ($biodata as $b ) --}}

            <div class="w-full space-y-3">
                <div class="flex justify-between"><span class="font-medium text-gray-500 dark:text-gray-400">Nama:</span><span class="text-right">{{$biodata->nama}}</span></div>
                <div class="flex justify-between"><span class="font-medium text-gray-500 dark:text-gray-400">NIM:</span><span class="text-right">{{$biodata->nim}}</span></div>
                <div class="flex justify-between"><span class="font-medium text-gray-500 dark:text-gray-400">Program Studi:</span><span class="text-right">{{$biodata->prodi->jenjang .' '. $biodata->prodi->nama_prodi}}</span></div>
                <div class="flex justify-between"><span class="font-medium text-gray-500 dark:text-gray-400">Semester:</span><span class="text-right">{{$biodata->semester}}</span></div>
                <div class="flex justify-between"><span class="font-medium text-gray-500 dark:text-gray-400">Email:</span><span class="text-right">{{$biodata->email}}</span></div>
                <div class="flex justify-between"><span class="font-medium text-gray-500 dark:text-gray-400">No. Telepon:</span><span class="text-right">{{$biodata->no_telp}}</span></div>
                <div class="flex justify-between"><span class="font-medium text-gray-500 dark:text-gray-400">Jenis Kelamin:</span><span class="text-right">{{$biodata->jenis_kelamin}}</span></div>
                <div class="flex justify-between"><span class="font-medium text-gray-500 dark:text-gray-400">Tempat Tanggal Lahir:</span><span class="text-right">{{$biodata->tempat_lahir .' '. $biodata->tgl_lahir}}</span></div>
                <div class="flex justify-between"><span class="font-medium text-gray-500 dark:text-gray-400">Alamat:</span><span class="text-right">{{$biodata->province->name .', '. $biodata->regency->name .', '. $biodata->district->name .', '. $biodata->village->name .', '. $biodata->alamat}}</span></div>
            </div>
            {{-- @endforeach --}}

            </div>
        </div>

        </div>
    </div>
</x-layout>
