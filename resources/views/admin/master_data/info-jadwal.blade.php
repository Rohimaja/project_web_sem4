<x-layout>
    <div class="h-full">
        <x-slot:title>{{ $title }}</x-slot:title>
        <p>Informasi Jadwal</p>

        <div class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white rounded-sm shadow-xl">
        <h1 class="mb-2 text-2xl font-semibold text-gray-700">Dosen Pengajar</h1>
            <div class="overflow-x-auto w-68 sm:w-150 md:w-full mt-3 pb-3">
                <table id="tbl-pres" class="text-sm text-left w-full pt-2">
                    <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                        <tr>
                            {{-- <th class="border border-gray-300 px-4 py-2">No</th> --}}
                            <th class="border border-gray-300 px-4 py-2">Hari</th>
                            <th class="border border-gray-300 px-4 py-2">Jam Perkuliahan</th>
                            <th class="border border-gray-300 px-4 py-2">Durasi</th>
                            <th class="border border-gray-300 px-4 py-2">Mata Kuliah</th>
                            <th class="border border-gray-300 px-4 py-2">Dosen</th>
                            <th class="border border-gray-300 px-4 py-2">Program Studi</th>
                            <th class="border border-gray-300 px-4 py-2">Semester</th>
                            <th class="border border-gray-300 px-4 py-2">Ruangan</th>
                            <th class="border border-gray-300 px-4 py-2">Tahun Ajaran</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{$jadwal->hari ?? '-'}}</td>
                            <td class="border border-gray-300 px-4 py-2">{{$jadwal->jam}}</td>
                            <td class="border border-gray-300 px-4 py-2">{{$jadwal->durasi . ' SKS'}}</td>
                            <td class="border border-gray-300 px-4 py-2">{{$jadwal->matkul->nama_matkul ?? '-'}}</td>
                            <td class="border border-gray-300 px-4 py-2">{{$jadwal->dosen->nama ?? '-'}}</td>
                            <td class="border border-gray-300 px-4 py-2">{{$jadwal->prodi->jenjang .' '.$jadwal->prodi->nama_prodi ?? '-'}}</td>
                            <td class="border border-gray-300 px-4 py-2">{{$jadwal->semester ?? '-'}}</td>
                            <td class="border border-gray-300 px-4 py-2">{{$jadwal->ruangan->nama_ruangan ?? '-'}}</td>
                            <td class="border border-gray-300 px-4 py-2">{{$jadwal->tahun->tahun_awal .'/'. $jadwal->tahun->tahun_akhir .' '. $jadwal->tahun->keterangan ?? '-'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <h1 class="mb-2 mt-6 text-2xl font-semibold text-gray-700">Mahasiswa</h1>
            <div class="overflow-x-auto w-68 sm:w-150 md:w-full mt-3 pb-3">
                <table id="tbl-pres" class="text-sm text-left w-full pt-2">
                    <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">No</th>
                            <th class="border border-gray-300 px-4 py-2">Nim</th>
                            <th class="border border-gray-300 px-4 py-2">Nama</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($detail as $dp )
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{$loop->iteration}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$dp->mahasiswa->nim}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$dp->mahasiswa->nama}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
