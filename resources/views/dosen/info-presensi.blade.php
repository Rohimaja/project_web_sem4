<x-layoutDosen>
  <div class="h-full">
    <h1 class="font-bold text-gray-800 text-xl sm:text-2xl">{{ $title }}</h1>
    <p>Informasi Presensi Hari ini</p>

    <div class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white rounded-sm shadow-xl">
      <h1 class="mb-2 text-2xl font-semibold text-gray-700">Dosen Pengajar</h1>
      <div class="overflow-x-auto w-68 sm:w-150 md:w-full mt-3 pb-3">
        <table id="tbl-pres" class="text-sm text-left w-full pt-2">
          <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
            <tr>
              <th class="border border-gray-300 px-4 py-2">No</th>
              <th class="border border-gray-300 px-4 py-2">Tanggal</th>
              <th class="border border-gray-300 px-4 py-2">Dosen</th>
              <th class="border border-gray-300 px-4 py-2">Durasi</th>
              <th class="border border-gray-300 px-4 py-2">Program Studi</th>
              <th class="border border-gray-300 px-4 py-2">Semester</th>
              <th class="border border-gray-300 px-4 py-2">Mata Kuliah</th>
              <th class="border border-gray-300 px-4 py-2">Ruangan</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <tr class="hover:bg-gray-50">
              <td class="border border-gray-300 px-4 py-2">1</td>
              <td class="border border-gray-300 px-4 py-2">29-02-2004</td>
              <td class="border border-gray-300 px-4 py-2">P Kontieul</td>
              <td class="border border-gray-300 px-4 py-2">2 jam</td>
              <td class="border border-gray-300 px-4 py-2">MIK</td>
              <td class="border border-gray-300 px-4 py-2">2</td>
              <td class="border border-gray-300 px-4 py-2">English</td>
              <td class="border border-gray-300 px-4 py-2">3.1</td>
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
              <th class="border border-gray-300 px-4 py-2">waktu Presensi</th>
              <th class="border border-gray-300 px-4 py-2">Presensi</th>
              <th class="border border-gray-300 px-4 py-2">Aksi</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <tr class="hover:bg-gray-50">
              <td class="border border-gray-300 px-4 py-2">1</td>
              <td class="border border-gray-300 px-4 py-2">E41231275</td>
              <td class="border border-gray-300 px-4 py-2">Jumanto</td>
              <td class="border border-gray-300 px-4 py-2">18.00</td>
              <td class="border border-gray-300 px-4 py-2 text-center">
                <span class="inline-block px-3 py-1 text-sm font-semibold text-white bg-green-500 rounded-full">
                  Hadir
                </span>
              </td>              
              <td class="border border-gray-300 px-4 py-2 text-center">
                <div x-data="{openEdit: false}" class="flex justify-center gap-2">
                  <button @click="openEdit = !openEdit" class="cursor-pointer px-2 py-1 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-md">
                    <i class="bi bi-pencil-square text-lg"></i>
                  </button>

                  <div x-show="openEdit" x-cloak x-transition class="fixed inset-0 z-50 flex justify-center items-center">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div @click.outside="openEdit = false" class="relative z-10 bg-white rounded-lg shadow-2xl w-[90%] max-w-md p-6">
                      <div class="flex justify-center mb-4">
                        <div class="bg-blue-100 rounded-full p-4">
                          <i class="bi bi-pencil-square text-4xl text-blue-600"></i>
                        </div>
                      </div>
                      <h2 class="text-xl font-semibold text-gray-800 text-center mb-4">Ubah Presensi Manual</h2>
                      <div class="flex flex-wrap justify-center gap-4 mb-6">
                        <label class="inline-flex items-center">
                          <input type="radio" name="status" value="Hadir" class="form-radio text-blue-600">
                          <span class="ml-2">Hadir</span>
                        </label>
                        <label class="inline-flex items-center">
                          <input type="radio" name="status" value="Sakit" class="form-radio text-yellow-500">
                          <span class="ml-2">Sakit</span>
                        </label>
                        <label class="inline-flex items-center">
                          <input type="radio" name="status" value="Izin" class="form-radio text-green-500">
                          <span class="ml-2">Izin</span>
                        </label>
                        <label class="inline-flex items-center">
                          <input type="radio" name="status" value="Alpha" class="form-radio text-red-600">
                          <span class="ml-2">Alpha</span>
                        </label>
                      </div>
                      <div class="mb-6 w-full">
                        <label for="alasan" class="block text-gray-700 mb-1">Alasan:</label>
                        <textarea id="alasan" name="alasan" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                      </div>
                      <div class="flex justify-end space-x-3">
                        <button @click="openEdit = false" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                          Batal
                        </button>
                        <button class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                          Simpan
                        </button>
                      </div>
                    </div>
                  </div>
                  
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="mt-5">
        <a href="/dosen/presensi">
          <button class="px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</button>
        </a>
      </div>
    </div>
  </div>
</x-layoutDosen>