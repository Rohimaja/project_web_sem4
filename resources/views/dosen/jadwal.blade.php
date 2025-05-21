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
            <option value="Seemster 1">Seemster 1</option>
            <option value="Semester 2">Semester 2</option>
            <option value="Semester 3">Semester 3</option>
            <option value="Semester 4">Semester 4</option>
            <option value="Semester 5">Semester 5</option>
          </select>
        </div>
      </div>

      <div class="mt-2 mb-5 flex  gap-4">
        <a href="">
          <button class="flex items-center px-4 py-2.5 text-white bg-green-700 hover:bg-green-800 active:bg-green-900 rounded-sm font-semibold cursor-pointer">
            <i class="bi bi-file-earmark-excel mr-2"></i>
            <span class="text-[12px] md:text-base">Export Excel</span>
          </button>
        </a>

        <button @click="openImport = !openImport" class="flex items-center px-2 py-1.5 md:px-4 md:py-2.5 text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-sm font-semibold cursor-pointer">
          <i class="bi bi-filetype-pdf mr-2"></i>
          <span class="text-[12px] md:text-base">Export Pdf</span>
        </button>
      </div>

      <div class="overflow-x-auto w-68 sm:w-150 md:w-full mt-3 pb-3">
        <table id="myTable" class="text-sm text-left w-full pt-2">
          <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
            <tr>
              <th class="border border-gray-300 px-4 py-2">No</th>
              <th class="border border-gray-300 px-4 py-2">Hari</th>
              <th class="border border-gray-300 px-4 py-2">Jam</th>
              <th class="border border-gray-300 px-4 py-2">Mata Kuliah</th>
              <th class="border border-gray-300 px-4 py-2">Prodi</th>
              <th class="border border-gray-300 px-4 py-2">Tahun Ajaran</th>
              <th class="border border-gray-300 px-4 py-2">Semester</th>
              <th class="border border-gray-300 px-4 py-2">Ruangan</th>
              <th class="border border-gray-300 px-4 py-2">Jenis Pertemuan</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <tr class="hover:bg-gray-50">
              <td class="border border-gray-300 px-4 py-2">1</td>
              <td class="border border-gray-300 px-4 py-2">Senin</td>
              <td class="border border-gray-300 px-4 py-2">08.00 - 10.00</td>
              <td class="border border-gray-300 px-4 py-2">Pemrograman Web</td>
              <td class="border border-gray-300 px-4 py-2">Teknik Informatika</td>
              <td class="border border-gray-300 px-4 py-2">2024/2025 Genap</td>
              <td class="border border-gray-300 px-4 py-2">3</td>
              <td class="border border-gray-300 px-4 py-2">R.401</td>
              <td class="border border-gray-300 px-4 py-2">Tatap Muka</td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="border border-gray-300 px-4 py-2">2</td>
              <td class="border border-gray-300 px-4 py-2">Rabu</td>
              <td class="border border-gray-300 px-4 py-2">09.00 - 11.00</td>
              <td class="border border-gray-300 px-4 py-2">Basis Data</td>
              <td class="border border-gray-300 px-4 py-2">Manajemen Informatika</td>
              <td class="border border-gray-300 px-4 py-2">2024/2025 Genap</td>
              <td class="border border-gray-300 px-4 py-2">1</td>
              <td class="border border-gray-300 px-4 py-2">Lab DB</td>
              <td class="border border-gray-300 px-4 py-2">Online</td>
            </tr>
            <tr class="hover:bg-gray-50">
              <td class="border border-gray-300 px-4 py-2">3</td>
              <td class="border border-gray-300 px-4 py-2">Jumat</td>
              <td class="border border-gray-300 px-4 py-2">13.00 - 15.00</td>
              <td class="border border-gray-300 px-4 py-2">Jaringan Komputer</td>
              <td class="border border-gray-300 px-4 py-2">Teknik Informatika</td>
              <td class="border border-gray-300 px-4 py-2">2024/2025 Genap</td>
              <td class="border border-gray-300 px-4 py-2">4</td>
              <td class="border border-gray-300 px-4 py-2">R.204</td>
              <td class="border border-gray-300 px-4 py-2">Tatap Muka</td>
            </tr>
          </tbody>          
        </table>
      </div>
    </div>
  </div>
</x-layout>
