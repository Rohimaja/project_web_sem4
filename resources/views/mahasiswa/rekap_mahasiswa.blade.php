<x-layout>
         @vite(['resources/js/pages/admin/rekap-mahasiswa.js'])
  <div class="h-full">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Lihat Rekap Presensi Mahasiswa </p>
    <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">
        <form action="{{route('admin.rekap-mahasiswa.filter')}}" method="post">
            @csrf
    <div class="flex flex-col xl:flex-row">
        <!-- Program Studi -->
        <div class="flex flex-col w-full mb-4 xl:w-1/3 mr-0 md:mr-4"
            <label class="mb-1 font-semibold">Pilih Program Studi:</label>
            <select id="prodi" name="prodi">
                <option value="" hidden selected>Pilih Program Studi</option>
                {{-- @foreach ($prodi as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->jenjang .' '. $p->nama_prodi }}
                    </option>
                @endforeach --}}
            </select>
        </div>

        <!-- Semester (copy template atas, ganti datanya) -->
        <div class="flex flex-col w-full mb-4 xl:w-1/3 mr-0 md:mr-4"
            <label class="mb-1 font-semibold">Pilih Semester:</label>
            <select id="semester" name="semester">
                <option value="" hidden selected>Pilih Semester</option>
                {{-- @for ($i = 1; $i <= 14; $i++)
                <option value="{{$i}}"> Semester {{$i}} </option>
                @endfor --}}
            </select>
        </div>

        <!-- Agama (copy template atas, ganti datanya) -->
        <div class="flex flex-col w-full mb-4 xl:w-1/3"
            <label class="mb-1 font-semibold">Pilih Mata Kuliah:</label>
            <select id="matkul" name="matkul">

            </select>
        </div>
    </div>

        <div class="w-full flex justify-end">
            <a href="{{route('admin.rekap-mahasiswa.index')}}" class="px-5 py-2 mr-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Reset</a>
            <button type="submit" class="px-5 py-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
        </div>
    </form>

      <div class="mt-4 flex gap-4">
        <a href="">
          <button class="flex items-center px-4 py-2.5 text-white bg-green-700 hover:bg-green-800 active:bg-green-900 rounded-sm font-semibold cursor-pointer">
            <i class="bi bi-file-earmark-excel mr-2"></i>
            <span>Export Excel</span>
          </button>
        </a>

        <button @click="openImport = !openImport" class="flex items-center px-4 py-2.5 text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-sm font-semibold cursor-pointer">
          <i class="bi bi-filetype-pdf mr-2"></i>
          <span>Export Pdf</span>
        </button>
      </div>

      <div x-data="{ hovering: false }" class="overflow-x-auto w-60 sm:w-150 md:w-240 xl:min-w-full pb-3">
        <table id="data-rekap-mahasiswa" class="text-sm text-left w-full pt-4">
            <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                <tr>
                    <th class="border border-gray-300 px-4 py-2">No</th>
                    <th @mouseenter="hovering = true" @mouseleave="hovering = false"
                    :class="hovering ? 'bg-blue-500 text-white' : 'bg-gray-200'" class="border border-gray-300 px-4 py-2">Nim</th>
                    <th class="border border-gray-300 px-4 py-2">Nama</th>
                    @for ($i = 1; $i <= 16; $i++)
                        <th class="border border-gray-300 px-4 py-2 text-center">{{ $i }}</th>
                    @endfor
                    <th class="border border-gray-300 px-4 py-2">%Hadir</th>
                    <th class="border border-gray-300 px-4 py-2">%Izin</th>
                    <th class="border border-gray-300 px-4 py-2">%Sakit</th>
                    <th class="border border-gray-300 px-4 py-2">%Alpha</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @if (count($rekap))
                    @foreach ($rekap as $index => $item)

                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">{{$loop->iteration}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$item['nim'] ?? ''}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$item['nama_mahasiswa'] ?? ''}}</td>
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
                            <td class="border px-4 py-2 font-semibold {{ $bg }}" title="{{$tanggal .' '. $dosen}}">{{ $status }}</td>
                    @endfor
                    <td class="border border-gray-300 px-4 py-2">{{$item['kehadiran']}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$item['izin_persentase']}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$item['sakit_persentase']}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$item['alpha_persentase']}}</td>
                </tr>
                @endforeach
            </tbody>
            @endif

        </table>
      </div>
      <div class="mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-5">Keterangan:</h2>
        <p class="mt-2"><span class="text-white font-bold p-1 bg-green-500">H</span> = Hadir Kuliah</p>
        <p class="mt-2"><span class="text-white font-bold py-1 px-2 bg-yellow-500">I</span> = Izin Kuliah</p>
        <p class="mt-2"><span class="text-white font-bold p-1 bg-red-500">A</span> = Alpha Kuliah</p>
      </div>
    </div>
  </div>
</x-layout>
