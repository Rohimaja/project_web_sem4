<x-layout>
  @vite(['resources/js/pages/dosen/data-presensi.js'])
  <div class="h-full dark:bg-gray-700 dark:text-gray-100 transition">
    <x-slot:title>{{ $title }}</x-slot:title>

    <p class="text-gray-800 dark:text-gray-200">Lihat jadwal hari ini</p>

    <div class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white dark:bg-gray-800 rounded-sm shadow-xl">
      <div class="flex flex-col md:flex-row">
        <div class="flex flex-col w-full mb-4">
          <label for="" class="mb-1 font-semibold dark:text-gray-300">Tahun Ajaran:</label>
          <select class="p-2 mt-1 py-[10.5px] w-full border-2 border-gray-400 dark:border-gray-600 rounded-sm bg-white dark:bg-gray-600 text-gray-900 dark:text-gray-100">
            <option value="" hidden selected>Pilih Tahun Ajaran</option>
            <option value="2024/2025 Genap">2024/2025 Genap</option>
            <option value="2024/2025 Ganjil">2024/2025 Ganjil</option>
            <option value="2023/2024 Genap">2023/2024 Genap</option>
            <option value="2023/2024 Ganjil">2023/2024 Ganjil</option>
          </select>
        </div>
      </div>
    </div>

    <div class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white dark:bg-gray-800 rounded-sm shadow-xl">
      <div class="overflow-x-auto w-[270px] sm:w-150 md:w-full mt-3 pb-3">
        <table id="myTable" class="min-w-full divide-y divide-gray-200 dark:divide-gray-600 text-sm text-gray-700 dark:text-gray-200">
          <thead class="bg-gray-100 dark:bg-gray-700 sticky top-0 z-10">
            <tr>
              <th class="px-6 py-3 text-left font-medium">Hari</th>
              <th class="px-6 py-3 text-left font-medium">Jam</th>
              <th class="px-6 py-3 text-left font-medium">Durasi</th>
              <th class="px-6 py-3 text-left font-medium">Mata Kuliah</th>
              <th class="px-6 py-3 text-left font-medium">Ruangan</th>
              <th class="px-6 py-3 text-left font-medium">Dosen Koordinator</th>
            </tr>
          </thead>
          <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
              <td class="px-6 py-4">Senin</td>
              <td class="px-6 py-4">08.00 - 10.00</td>
              <td class="px-6 py-4">2 jam</td>
              <td class="px-6 py-4">Workshop Sistem Informasi Web Framework</td>
              <td class="px-6 py-4">GEDUNG TEKNOLOGI INFORMASI - KELAS TI 3.6</td>
              <td class="px-6 py-4">Hermawan Arief P S.T., M.T.</td>
            </tr>
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
              <td class="px-6 py-4">Senin</td>
              <td class="px-6 py-4">08.00 - 10.00</td>
              <td class="px-6 py-4">2 jam</td>
              <td class="px-6 py-4">Workshop Sistem Informasi Web Framework</td>
              <td class="px-6 py-4">GEDUNG TEKNOLOGI INFORMASI - KELAS TI 3.6</td>
              <td class="px-6 py-4">Hermawan Arief P S.T., M.T.</td>
            </tr>
            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
              <td class="px-6 py-4">Senin</td>
              <td class="px-6 py-4">08.00 - 10.00</td>
              <td class="px-6 py-4">2 jam</td>
              <td class="px-6 py-4">Workshop Sistem Informasi Web Framework</td>
              <td class="px-6 py-4">GEDUNG TEKNOLOGI INFORMASI - KELAS TI 3.6</td>
              <td class="px-6 py-4">Hermawan Arief P S.T., M.T.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-layout>
