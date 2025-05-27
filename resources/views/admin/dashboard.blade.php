<x-layout>
    @vite(['resources/js/components/dashboard.js'])
    <x-slot:title>{{ $title }}</x-slot:title>
    <p class="mb-4 dark:text-white">Hari ini: <span class="text-md text-gray-800 dark:text-white">
        {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
        </span>
    </p>

    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4 mb-5">
        <a href="{{route('admin.master-mahasiswa.index')}}">
            <div class="w-[310px] md:w-full group bg-gradient-to-br from-cyan-100 to-cyan-300 dark:from-cyan-800 dark:to-cyan-600 rounded-xl shadow-md p-4 border-b-4 border-blue-800 dark:border-blue-600
                transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
                <h2 class="text-base font-semibold text-gray-700 dark:text-white">Total Mahasiswa</h2>
                <div class="mt-3 flex items-center justify-between">
                    <i class="bi bi-person-circle text-4xl text-blue-800 dark:text-white"></i>
                    <h1 class="text-3xl font-bold text-blue-800 dark:text-white">{{$mahasiswa}}</h1>
                </div>
            </div>
        </a>

        <a href="{{route('admin.master-dosen.index')}}">
            <div class="w-[310px] md:w-full group bg-gradient-to-br from-purple-100 to-purple-300 dark:from-purple-800 dark:to-purple-600 rounded-xl shadow-md p-4 border-b-4 border-purple-800 dark:border-purple-600
                transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
                <h2 class="text-base font-semibold text-gray-700 dark:text-white">Total Dosen</h2>
                <div class="mt-3 flex items-center justify-between">
                    <i class="bi bi-person-workspace text-4xl text-purple-800 dark:text-white"></i>
                    <h1 class="text-3xl font-bold text-purple-800 dark:text-white">{{$dosen}}</h1>
                </div>
            </div>
        </a>

        <a href="{{route('admin.master-matkul.index')}}">
            <div class="w-[310px] md:w-full group bg-gradient-to-br from-green-100 to-green-300 dark:from-green-800 dark:to-green-600 rounded-xl shadow-md p-4 border-b-4 border-green-800 dark:border-green-600
                transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
                <h2 class="text-base font-semibold text-gray-700 dark:text-white">Total Mata Kuliah</h2>
                <div class="mt-3 flex items-center justify-between">
                    <i class="bi bi-journal-bookmark-fill text-4xl text-green-800 dark:text-white"></i>
                    <h1 class="text-3xl font-bold text-green-800 dark:text-white">{{$matkul}}</h1>
                </div>
            </div>
        </a>

        <a href="{{route('admin.master-prodi.index')}}">
            <div class="w-[310px] md:w-full group bg-gradient-to-br from-red-100 to-red-300 dark:from-red-800 dark:to-red-600 rounded-xl shadow-md p-4 border-b-4 border-red-800 dark:border-red-600
                transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
                <h2 class="text-base font-semibold text-gray-700 dark:text-white">Total Program Studi</h2>
                <div class="mt-3 flex items-center justify-between">
                    <i class="bi bi-book-half text-4xl text-red-800 dark:text-white"></i>
                    <h1 class="text-3xl font-bold text-red-800 dark:text-white">{{$prodi}}</h1>
                </div>
            </div>
        </a>
    </div>

    <div class="flex flex-col md:flex-row gap-5 mb-5">
        <div class="flex flex-col gap-5 w-[310px] md:w-3/4">
            <div class="bg-white dark:bg-gray-800 rounded-md shadow p-4 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-semibold text-gray-700 dark:text-white">Halo, <span class="text-blue-600 dark:text-blue-400">{{ Auth::user()->name }}</span> 👋</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-300">Semoga harimu menyenangkan!</p>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-md shadow-xl">
                <div class="p-4 border-b-2 border-gray-300 dark:border-gray-600 flex-col md:flex-row justify-between w-full">
                    <h1 class="text-gray-500 dark:text-white text-lg font-semibold">Absensi Mahasiswa Perbulan</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-300">
                        <span class="text-sm text-gray-400 dark:text-gray-400">
                            {{ \Carbon\Carbon::now()->startOfMonth()->locale('id')->translatedFormat('F, d-m-Y') }} -
                            {{ \Carbon\Carbon::now()->endOfMonth()->locale('id')->translatedFormat('F, d-m-Y') }}
                        </span>
                    </p>
                </div>
                <div class="p-6 overflow-x-autu">
                    <div id="chart" class="w-full h-48 min-w-[300px]"></div>
                </div>
            </div>
        </div>

        <div class="w-[310px] md:w-1/4 bg-white dark:bg-gray-800 rounded-md shadow-xl">
            <div class="p-4 border-b-2 border-gray-300 dark:border-gray-600 flex flex-col justify-between items-start">
                <h1 class="text-gray-500 dark:text-white text-lg font-semibold">Mahasiswa Hadir Hari Ini</h1>
                <span class="text-sm text-gray-400 dark:text-gray-300">
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
                </span>

                <input type="text" id="searchMahasiswa" placeholder="Cari nama..." class="mt-3 w-full px-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div id="listMahasiswa" class="p-4 max-h-[360px] overflow-y-auto space-y-3 text-sm text-gray-700 dark:text-gray-200">
                @foreach (range(1, 10) as $i)
                    <div class="item-mahasiswa flex items-start gap-4 p-3 rounded-md border border-gray-200 dark:border-gray-600 hover:shadow transition-all">
                        <img src="https://ui-avatars.com/api/?name=P+Budiyanto&background=3B82F6&color=fff" alt="P Budiyanto" class="w-12 h-12 rounded-full object-cover">
                        <div class="flex-1">
                            <p class="nama font-semibold text-gray-800 dark:text-white">P Budiyanto</p>
                            <p class="text-xs text-gray-500 dark:text-gray-300 mb-1">MIK - Semester 2 • English</p>
                            <div class="flex flex-wrap gap-2 text-xs text-gray-600 dark:text-gray-300 mb-1">
                                <span class="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 px-2 py-1 rounded-md">Ruangan: 3.2</span>
                                <span class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded-md">Datang: 08.23</span>
                            </div>
                            <span class="inline-block text-xs font-medium text-green-700 bg-green-100 dark:bg-green-800 dark:text-green-300 px-2 py-0.5 rounded-md">Hadir Tepat Waktu</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex flex-col md:flex-row gap-5">
        <div class="w-[310px] md:w-3/4 bg-white dark:bg-gray-800 rounded-sm shadow-xl">
            <div class="mb-3 p-4 rounded-t-xl border-b-2 border-gray-300 dark:border-gray-600 flex justify-between items-center flex-wrap gap-2">
                <h1 class="text-gray-500 dark:text-white text-lg font-semibold">Daftar Perkuliahan Hari Ini</h1>
            </div>
            <div class="px-3 pb-3 overflow-x-auto max-h-[400px] overflow-y-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm" id="data-mengajar">
                    <thead class="bg-gray-100 dark:bg-gray-700 sticky top-0 z-10 text-gray-700 dark:text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Jam Perkuliahan</th>
                            <th class="px-4 py-2 text-left">Mata Kuliah</th>
                            <th class="px-4 py-2 text-left">Dosen</th>
                            <th class="px-4 py-2 text-left">Program Studi</th>
                            <th class="px-4 py-2 text-left">Semester</th>
                            <th class="px-4 py-2 text-left">Ruangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-gray-700 dark:text-gray-200">
                        @foreach ($dosenMengajar as $dm)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2">{{ $loop->iteration }}</td>
                                <td class="px-4 py-2">{{substr($dm->jam_awal,0,5) .' - '. substr($dm->jam_akhir,0,5)}}</td>
                                <td class="px-4 py-2">{{$dm->matkul->nama_matkul}}</td>
                                <td class="px-4 py-2">{{$dm->dosen->nama}}</td>
                                <td class="px-4 py-2">{{$dm->prodi->nama_prodi}}</td>
                                <td class="px-4 py-2">{{$dm->semester}}</td>
                                <td class="px-4 py-2">{{$dm->ruangan->nama_ruangan}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="w-[310px] md:w-1/4 bg-white dark:bg-gray-800 rounded-md shadow-xl">
            <div class="p-4 border-b-2 border-gray-300 dark:border-gray-600 flex justify-between items-center">
                <h1 class="text-gray-500 dark:text-white text-lg font-semibold tracking-wide">Mahasiswa Tidak Hadir Hari Ini</h1>
            </div>
            <div class="p-4 space-y-4 text-sm text-gray-700 dark:text-gray-200 max-h-[430px] overflow-y-auto scrollbar-thin scrollbar-thumb-gray-300 scrollbar-track-gray-100">
                @foreach (range(1, 10) as $i)
                    <div class="item-mahasiswa flex items-start gap-4 p-3 rounded-md border border-red-200 dark:border-gray-600 hover:shadow transition-all">
                        <img src="https://ui-avatars.com/api/?name=P+Budiyanto&background=EF4444&color=fff" alt="P Budiyanto" class="w-12 h-12 rounded-full object-cover">
                        <div class="flex-1">
                        <p class="nama font-semibold text-gray-800 dark:text-white">P Budiyanto</p>
                        <p class="text-xs text-gray-500 dark:text-gray-300 mb-1">MIK - Semester 2 • English</p>
                            <div class="flex flex-wrap gap-2 text-xs text-gray-600 dark:text-gray-300 mb-1">
                                <span class="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 px-2 py-1 rounded-md">Ruangan: 3.2</span>
                                <span class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded-md">08.00 - 10.00</span>
                            </div>
                            <span class="inline-block text-xs font-medium text-red-700 bg-red-100 dark:bg-red-800 dark:text-red-300 px-2 py-0.5 rounded-md">Alpha</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>

<script>
        const chartData = @json($mingguan);
</script>
