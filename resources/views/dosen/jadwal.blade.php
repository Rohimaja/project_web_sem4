<x-layout>
  @vite(['resources/js/pages/dosen/data-presensi.js'])
  <div class="h-full">
  <x-slot:title>{{ $title }}</x-slot:title>
  <p>lihat jadwal mengajar hari ini</p>
    <div class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white rounded-sm shadow-xl">
      <div class="flex flex-col md:flex-row">
        <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
          <label for="" class="mb-1 font-semibold">Tahun Ajaran:</lab>
          <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 rounded-sm">
            <option value="" hidden selected>Pilih Tahun Ajaran</option>
            <option value="2024/2025 Genap">2024/2025 Genap</option>
            <option value="2024/2025 Ganjil">2024/2025 Ganjil</option>
            <option value="2024/2025 Genap">2023/2024 Genap</option>
            <option value="2024/2025 Ganjil">2023/2024 Ganjil</option>
          </select>
        </div>
        <div class="flex flex-col w-full mb-4 md:w-1/2">
          <label for="" class="mb-1 font-semibold">Semester:</label>
          <select type="text" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-400 rounded-sm" placeholder="Masukkan Nip">
            <option value="" hidden selected>Pilih Semester</option>
            <option value="Seemster 1">Semester 1</option>
            <option value="Semester 2">Semester 2</option>
            <option value="Semester 3">Semester 3</option>
            <option value="Semester 4">Semester 4</option>
            <option value="Semester 5">Semester 5</option>
          </select>
        </div>
      </div>

      <div class="overflow-x-auto w-68 sm:w-150 md:w-full mt-3 pb-3">
        <table id="myTable" class="text-sm text-left w-full pt-2">
          <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
            <tr class="text-center">
              <th class="border border-gray-300 px-4 py-2">Hari</th>
              <th class="border border-gray-300 px-4 py-2">Jam</th>
              <th class="border border-gray-300 px-4 py-2">Mata Kuliah</th>
              <th class="border border-gray-300 px-4 py-2">Prodi</th>
              <th class="border border-gray-300 px-4 py-2">Tahun Ajaran</th>
              <th class="border border-gray-300 px-4 py-2">Semester</th>
              <th class="border border-gray-300 px-4 py-2">Ruangan</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @foreach ($jadwal as $j)

                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">{{$j->hari}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{substr($j->jam,0,5)}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$j->matkul->nama_matkul}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$j->prodi->nama_prodi}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$j->tahunAjaran->tahun_awal .'/'. $j->tahunAjaran->tahun_akhir .' '.$j->tahunAjaran->keterangan}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$j->semester}}</td>
                    <td class="border border-gray-300 px-4 py-2">{{$j->ruangan->nama_ruangan}}</td>
                </tr>
            @endforeach

          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-layout>
