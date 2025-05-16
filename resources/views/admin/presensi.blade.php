<x-layout>
  <div class="h-full">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Lihat seluruh presensi, termasuk data hari ini dan sebelumnya</p>

    <div class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white rounded-sm shadow-xl">
      <div class="mb-10">
        <a href="{{route('admin.presensi.create')}}">
          <button class="flex items-center px-4 py-2.5 text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-sm font-semibold cursor-pointer">
            <i class="bi bi-plus-square-fill mr-2"></i>
            <span>Tambah</span>
          </button>
        </a>
      </div>

      <div class="overflow-x-auto w-[270px] sm:w-150 md:w-full mt-3 pb-3">
        <table id="myTable" class="text-sm text-left w-full pt-2">
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
              <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="text-center">
            {{-- @foreach ($presensi as $p) --}}
            <tr class="hover:bg-gray-50">
              <td class="border border-gray-300 px-4 py-2">1</td>
              <td class="border border-gray-300 px-4 py-2">29-02-2004</td>
              <td class="border border-gray-300 px-4 py-2">P Kontieul</td>
              <td class="border border-gray-300 px-4 py-2">2 jam</td>
              <td class="border border-gray-300 px-4 py-2">MIK</td>
              <td class="border border-gray-300 px-4 py-2">2</td>
              <td class="border border-gray-300 px-4 py-2">English</td>
              <td class="border border-gray-300 px-4 py-2">3.1</td>
              <td class="border border-gray-300 px-4 py-2 text-center">
                <div class="flex justify-center gap-2">
                  <a href="{{route('admin.info-presensi')}}">
                    <button class="cursor-pointer px-2 py-1 bg-gray-600 hover:bg-gray-700 active:bg-gray-800 text-white rounded-md">
                      <i class="bi bi-card-text text-lg"></i>
                    </button>
                  </a>

                  <a href="/admin/form-presensi">
                    <button class="cursor-pointer px-2 py-1 bg-yellow-600 hover:bg-yellow-700 active:bg-yellow-800 text-white rounded-md">
                      <i class="bi bi-pencil-square text-lg"></i>
                    </button>
                  </a>

                  <div x-data="{confirmDel: false}" class="relative">
                    <button @click="confirmDel = true" class="cursor-pointer px-2 py-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-md">
                      <i class="bi bi-trash text-lg"></i>
                    </button>

                    <div x-show="confirmDel" x-cloak x-transition class="fixed inset-0 z-50 flex justify-center items-center">
                      <div class="absolute inset-0 bg-black opacity-50"></div>
                      <div @click.outside="confirmDel = false" class="relative z-10 bg-white rounded-lg shadow-2xl w-[90%] max-w-md p-6 flex flex-col items-center">
                        <div class="bg-red-100 rounded-full p-4 mb-4">
                          <i class="bi bi-exclamation-triangle text-4xl text-red-600"></i>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">Konfirmasi Hapus</h2>
                        <p class="text-center text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                        <div class="flex gap-4">
                          <button @click="confirmDel = false" class="px-4 py-2 rounded-md bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold">
                            Batal
                          </button>
                          <button @click="confirmDel = false" class="px-4 py-2 rounded-md bg-red-600 hover:bg-red-700 text-white font-semibold">
                            Hapus
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
            </tr>
            {{-- @endforeach --}}

          </tbody>
        </table>
      </div>

    </div>
  </div>
</x-layout>
