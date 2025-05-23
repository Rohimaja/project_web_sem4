<x-layout>
         @vite(['resources/js/pages/admin/rekap-dosen.js'])
  <div class="h-full">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Lihat Rekap Presensi Dosen </p>
    <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">
        <form action="{{route('admin.rekap-dosen.filter')}}" method="POST">
            @csrf
      <div class="flex flex-col md:flex-row">
            {{-- <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                <label class="mb-1 font-semibold">Pilih Dosen:</label>
                <select id="dosen" name="dosen">
                    <option value="" hidden selected>Pilih Program Studi</option>
                    @foreach ($prodi as $p)
                        <option value="{{ $p->id }}">

                            {{ $p->jenjang .' '. $p->nama_prodi}}
                        </option>
                    @endforeach
                </select>
            </div> --}}

            <div class="flex flex-col w-full mb-4 mr-0">
                <label class="mb-1 font-semibold">Pilih Tahun Ajaran:</label>
                <select id="tahun-ajaran" name="tahun_ajaran" class="w-full" >
                    <option value="" hidden selected>Pilih Tahun Ajaran</option>
                        @foreach ($tahun as $t)
                            <option value="{{ $t->id }}">
                                {{ $t->tahun_awal .'/'. $t->tahun_akhir .' '. $t->keterangan}}
                            </option>
                        @endforeach
                </select>
            </div>
        </div>

            {{-- <div class="w-full flex justify-end">
                <a href="{{route('dosen.rekap-dosen.index')}}" class="px-5 py-2 mr-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Reset</a>
                <button type="submit" class="px-5 py-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
            </div> --}}
        </form>

      <div class="mt-2 mb-5 flex gap-4">
        <a href="{{route('dosen.export.dosen.excel')}}">
          <button class="flex items-center px-4 py-2.5 text-white bg-green-700 hover:bg-green-800 active:bg-green-900 rounded-sm font-semibold cursor-pointer">
            <i class="bi bi-file-earmark-excel mr-2"></i>
            <span>Export Excel</span>
          </button>
        </a>

        <a href="{{route('dosen.export.dosen.pdf')}}">
            <button class="flex items-center px-4 py-2.5 text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-sm font-semibold cursor-pointer">
            <i class="bi bi-filetype-pdf mr-2"></i>
            <span>Export Pdf</span>
            </button>
        </a>
      </div>





      <div x-data="{ hovering: false }" class="overflow-x-auto w-60 sm:w-150 md:w-240 xl:min-w-full mt-1 pb-3">
        <table id="data-rekap-dosen" class="text-sm text-left w-full pt-4 display nowrap">
            <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                <tr>
                    <th @mouseenter="hovering = true" @mouseleave="hovering = false"
                    :class="hovering ? 'bg-blue-500 text-white' : 'bg-gray-200'" class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Program Studi</th>
                    <th class="border border-gray-300 px-4 py-2">Semester</th>
                    <th class="border border-gray-300 px-4 py-2">Mata Kuliah</th>
                    @for ($i = 1; $i <= $totalPertemuan; $i++)
                        <th class="border border-gray-300 px-4 py-2 text-center">{{ $i }}</th>
                    @endfor
                    <th class="border border-gray-300 px-4 py-2">%hadir</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @if (count($rekap))
                    @foreach ($rekap as $index => $item)

                    <tr class="hover:bg-gray-50">
                        <td class="border border-gray-300 px-4 py-2">{{$loop->iteration }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['nama_prodi'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['semester'] }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $item['nama_matkul'] }}</td>
                        @for ($i = 0; $i < $totalPertemuan; $i++)
                            @php
                                $tanggal = $item['tanggal_pertemuan'][$i] ?? null;
                                $status = $tanggal ? 'M' : '-';
                                $bg = match($status) {
                                    'M' => 'bg-green-500 text-white',
                                    '-' => 'bg-gray-500 text-white',
                                    // 'A' => 'bg-red-600 text-white',
                                    // default => 'bg-gray-100 text-gray-500'
                                };
                            @endphp
                            <td class="border px-4 py-2 font-semibold {{ $bg }}" title="{{$tanggal}}">{{ $status }}</td>
                            {{-- <td class="border border-gray-300 px-4 py-2 bg-green-600 text-white font-bold text-xl">H</td> --}}
                        @endfor
                        <td class="border border-gray-300 px-4 py-2">{{$item['total_pertemuan']}}</td>
                    </tr>
                    @endforeach
                </tbody>
                {{-- @else
                    <tr>
                        <td colspan="2" class="text-center text-gray-500 py-4">Belum ada data presensi ditampilkan.</td>
                    </tr> --}}
            @endif

        </table>
      </div>
      <div class="mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-5">Keterangan:</h2>
        <p class="mt-2"><span class="text-white font-bold p-1 bg-green-500">M</span> = Mengajar</p>
        <p class="mt-2"><span class="text-white font-bold p-1 bg-gray-500">-</span> = Tidak Terselenggara Perkuliahan</p>
      </div>

    </div>
</x-layout>

<script>
    const namaDosen = @json($dosenTerpilih->nama ?? '');
    const nipDosen = @json($dosenTerpilih->nip ?? '');
</script>
