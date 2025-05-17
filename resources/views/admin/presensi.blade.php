<x-layout>
    @vite(['resources/js/pages/admin/data-presensi.js'])
    <div class="h-full">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Data Presensi Hari ini</p>

        <div class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white rounded-sm shadow-xl">
            <div class="mb-10 flex">
                <a href="{{route('admin.presensi.create')}}">
                    <button class="flex items-center px-4 py-2.5 text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-sm font-semibold cursor-pointer">
                            <i class="bi bi-plus-square-fill mr-2"></i>
                        <span>Tambah</span>
                    </button>
                </a>
            </div>

            <div class="overflow-x-auto w-68 sm:w-150 md:w-full mt-3 pb-3">
                <table id="data-presensi" class="text-sm text-left w-full display pt-2">
                    <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">No</th>
                            <th class="border border-gray-300 px-4 py-2">Tanggal</th>
                            <th class="border border-gray-300 px-4 py-2">Dosen</th>
                            <th class="border border-gray-300 px-4 py-2">Jam Perkuliahan</th>
                            <th class="border border-gray-300 px-4 py-2">Program Studi</th>
                            <th class="border border-gray-300 px-4 py-2">Semester</th>
                            <th class="border border-gray-300 px-4 py-2">Mata Kuliah</th>
                            <th class="border border-gray-300 px-4 py-2">Ruangan</th>
                            <th class="border border-gray-300 px-4 py-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($presensi as $p)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{$loop->iteration}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$p->tgl_presensi}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$p->dosen->nama}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$p->jam_awal .' - '.$p->jam_akhir}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$p->prodi->jenjang .' '.$p->prodi->nama_prodi}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$p->semester}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$p->matkul->nama_matkul}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$p->ruangan->nama_ruangan}}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{route('admin.presensi.show', $p->id)}}">
                                            <button class="cursor-pointer px-2 py-1 bg-gray-600 hover:bg-gray-700 active:bg-gray-800 text-white rounded-md">
                                                <i class="bi bi-card-text text-lg"></i>
                                            </button>
                                        </a>

                                        <form action="{{ route('admin.presensi.destroy', $p->id) }}" method="POST" class="form-hapus inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-md">
                                                <i class="bi bi-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
