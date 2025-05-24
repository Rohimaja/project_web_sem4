<x-layout>
    @vite(['resources/js/pages/admin/rekap-mahasiswa.js'])
    <div class="h-full dark:bg-gray-700 dark:text-gray-200">
        <x-slot:title>{{ $title }}</x-slot:title>
        <p>Lihat Rekap Presensi Mahasiswa </p>

        <div class="w-full h-max max-w-full mt-5 p-8 bg-white dark:bg-gray-800 rounded-sm shadow-xl dark:shadow-gray-700">
            <form action="{{route('admin.rekap-mahasiswa.filter')}}" method="post">
                @csrf
                <div class="flex flex-col xl:flex-row">
                    <div class="flex flex-col w-full mb-4 xl:w-1/3 mr-0 md:mr-4">
                        <label class="mb-1 font-semibold dark:text-gray-300">Pilih Program Studi:</label>
                        <select id="prodi" name="prodi" class="border rounded px-2 py-1 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                            <option value="" hidden selected>Pilih Program Studi</option>
                            @foreach ($prodi as $p)
                                <option value="{{ $p->id }}">
                                    {{ $p->jenjang .' '. $p->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex flex-col w-full mb-4 xl:w-1/3 mr-0 md:mr-4">
                        <label class="mb-1 font-semibold dark:text-gray-300">Pilih Semester:</label>
                        <select id="semester" name="semester" class="border rounded px-2 py-1 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                            <option value="" hidden selected>Pilih Semester</option>
                            @for ($i = 1; $i <= 14; $i++)
                                <option value="{{$i}}"> Semester {{$i}} </option>
                            @endfor
                        </select>
                    </div>

                    <div class="flex flex-col w-full mb-4 xl:w-1/3">
                        <label class="mb-1 font-semibold dark:text-gray-300">Pilih Mata Kuliah:</label>
                        <select id="matkul" name="matkul" class="border rounded px-2 py-1 dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600">
                            <!-- Options akan diisi via JS -->
                        </select>
                    </div>
                </div>

                <div class="w-full flex justify-end">
                    <a href="{{route('admin.rekap-mahasiswa.index')}}" class="px-5 py-2 mr-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer dark:bg-red-700 dark:hover:bg-red-800 dark:active:bg-red-900">Reset</a>
                    <button type="submit" class="px-5 py-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer dark:bg-green-700 dark:hover:bg-green-800 dark:active:bg-green-900">Submit</button>
                </div>
            </form>
        </div>

        <div class="w-full h-max max-w-full mt-5 p-8 bg-white dark:bg-gray-800 rounded-sm shadow-xl dark:shadow-gray-700">

            @if ($prodiTerpilih && $matkulTerpilih && $semesterTerpilih)
                <div class="mt-4 flex gap-4">

                    <form action="{{route('admin.export.mahasiswa.excel')}}" method="POST">
                        @csrf
                        <input type="hidden" name="prodi" value="{{ request('prodi') }}">
                        <input type="hidden" name="semester" value="{{ request('semester') }}">
                        <input type="hidden" name="matkul" value="{{ request('matkul') }}">

                        <button class="flex items-center px-4 py-2.5 text-white bg-green-700 hover:bg-green-800 active:bg-green-900 rounded-sm font-semibold cursor-pointer dark:bg-green-600 dark:hover:bg-green-700 dark:active:bg-green-800">
                            <i class="bi bi-file-earmark-excel mr-2"></i>
                            <span>Export Excel</span>
                        </button>
                    </form>

                    <form action="{{ route('admin.export.mahasiswa.pdf') }}" method="POST">
                        @csrf
                        <input type="hidden" name="prodi" value="{{ request('prodi') }}">
                        <input type="hidden" name="semester" value="{{ request('semester') }}">
                        <input type="hidden" name="matkul" value="{{ request('matkul') }}">

                        <button type="submit" class="flex items-center px-4 py-2.5 text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-sm font-semibold cursor-pointer dark:bg-red-500 dark:hover:bg-red-600 dark:active:bg-red-700">
                            <i class="bi bi-filetype-pdf mr-2"></i>
                            <span>Export PDF</span>
                        </button>
                    </form>

                </div>

                <div class="flex flex-col gap-3 my-5">
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-2 w-full">
                            <label for="nip" class="w-40 font-semibold dark:text-gray-300">Program Studi:</label>
                            <span class="border border-gray-300 bg-gray-300 dark:bg-gray-700 dark:border-gray-600 text-black dark:text-white rounded px-3 py-2 w-full">
                                {{$prodiTerpilih->nama_prodi ?? ''}}
                            </span>
                        </div>

                        <div class="flex flex-col md:flex-row items-start md:items-center gap-2 w-full">
                            <label for="semester" class="w-40 font-semibold dark:text-gray-300">Semester:</label>
                            <span class="border border-gray-300 bg-gray-300 dark:bg-gray-700 dark:border-gray-600 text-black dark:text-white rounded px-3 py-2 w-full">
                                {{$semesterTerpilih ?? ''}}
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex flex-col md:flex-row items-start md:items-center gap-2 w-full">
                            <label for="matkul" class="w-40 font-semibold dark:text-gray-300">Mata Kuliah:</label>
                            <span class="border border-gray-300 bg-gray-300 dark:bg-gray-700 dark:border-gray-600 text-black dark:text-white rounded px-3 py-2 w-full">
                                {{$matkulTerpilih->nama_matkul ?? ''}}
                            </span>
                        </div>

                        <div class="flex flex-col md:flex-row items-start md:items-center gap-2 w-full"></div>
                    </div>
                </div>
            @endif

            <div x-data="{ hovering: false }" class="overflow-x-auto w-60 sm:w-150 md:w-240 xl:min-w-full pb-3">
                <table id="data-rekap-mahasiswa" class="text-sm text-left w-full pt-4 border-collapse border border-gray-300 dark:border-gray-600">
                    <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10 dark:bg-gray-700 dark:text-gray-200">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 dark:border-gray-600">No</th>
                            <th @mouseenter="hovering = true" @mouseleave="hovering = false"
                                :class="hovering ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700 dark:text-gray-200'"
                                class="border border-gray-300 px-4 py-2 dark:border-gray-600">Nim</th>
                            <th class="border border-gray-300 px-4 py-2 dark:border-gray-600">Nama</th>
                            @for ($i = 1; $i <= 16; $i++)
                                <th class="border border-gray-300 px-4 py-2 text-center dark:border-gray-600">{{ $i }}</th>
                            @endfor
                            <th class="border border-gray-300 px-4 py-2 dark:border-gray-600">%Hadir</th>
                            <th class="border border-gray-300 px-4 py-2 dark:border-gray-600">%Izin</th>
                            <th class="border border-gray-300 px-4 py-2 dark:border-gray-600">%Sakit</th>
                            <th class="border border-gray-300 px-4 py-2 dark:border-gray-600">%Alpha</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if (count($rekap))
                            @foreach ($rekap as $index => $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">{{ $item['nim'] ?? '' }}</td>
                                    <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">{{ $item['nama_mahasiswa'] ?? '' }}</td>
                                    @for ($i = 1; $i <= $totalPertemuan; $i++)
                                        @php
                                            $tanggal = $item['tanggal_pertemuan'][$i] ?? null;
                                            $status = $item['pertemuan'][$i] ?? '';
                                            $dosen = $item['nama_dosen'][$i] ?? '';
                                            switch ($status) {
                                                case 'H':
                                                    $bg = 'bg-green-500 text-white';
                                                    break;
                                                case 'I':
                                                    $bg = 'bg-yellow-500 text-white';
                                                    break;
                                                case 'S':
                                                    $bg = 'bg-blue-500 text-white';
                                                    break;
                                                case 'A':
                                                    $bg = 'bg-red-600 text-white';
                                                    break;
                                                default:
                                                    $bg = 'bg-gray-400 text-white';
                                                    break;
                                            };
                                        @endphp
                                        <td class="border px-4 py-2 font-semibold {{ $bg }}" title="{{ $tanggal .' '. $dosen }}">{{ $status }}</td>
                                    @endfor
                                    <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">{{ $item['kehadiran'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">{{ $item['izin_persentase'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">{{ $item['sakit_persentase'] }}</td>
                                    <td class="border border-gray-300 px-4 py-2 dark:border-gray-600">{{ $item['alpha_persentase'] }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <h2 class="text-2xl font-semibold text-gray-800 mb-5 dark:text-gray-200">Keterangan:</h2>
                <p class="mt-2"><span class="text-white font-bold p-1 bg-green-500">H</span> = Hadir Kuliah</p>
                <p class="mt-2"><span class="text-white font-bold py-1 px-2 bg-yellow-500">I</span> = Izin Kuliah</p>
                <p class="mt-2"><span class="text-white font-bold p-1 bg-red-500">A</span> = Alpha Kuliah</p>
            </div>
        </div>
    </div>
</x-layout>

<script>
    const namaProdi = @json($prodiTerpilih->nama_prodi ?? '');
    const namaMatkul = @json($matkulTerpilih->nama_matkul ?? '');
    const semester = @json($semesterTerpilih ?? '');
</script>
