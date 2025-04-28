<x-layout>
  <div class="relative">
    <h1 class="font-bold text-gray-800 text-2xl">{{ $title }}</h1>
    <p>Lihat data Tahun Ajaran</p>
    <div x-data="{openImport: false}" class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white rounded-sm shadow-xl">
      <div class="mt-2 mb-5 flex gap-4">
        <a href="/admin/masterdata/form-tahunAjaran">
          <button class="flex items-center px-4 py-2.5 text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-sm font-semibold cursor-pointer">
            <i class="bi bi-plus-square-fill mr-2"></i>
            <span>Tambah</span>
          </button>
        </a>

        {{-- <a href="/admin/masterdata/form-admin">
          <button class="flex items-center px-4 py-2.5 text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-sm font-semibold cursor-pointer">
            <i class="bi bi-plus-square-fill mr-2"></i>
            <span>Export</span>
          </button>
        </a> --}}

        <button @click="openImport = !openImport" class="flex items-center px-4 py-2.5 text-white bg-green-600 hover:bg-green-700 active:bg-green-800 rounded-sm font-semibold cursor-pointer">
          <i class="bi bi-plus-square-fill mr-2"></i>
          <span>Import</span>
        </button>        

        {{-- tampilan import file --}}
        <div x-show="openImport" x-transition class="fixed inset-0 z-50 flex justify-center items-center">
          
          <div class="absolute inset-0 bg-black opacity-50"></div>
          
          <div @click.outside="openImport = false" class="relative z-10 bg-white rounded-sm shadow-xl sm:w-[500px] w-[380px] max-w-full p-6" >
            <div class="flex justify-between items-center mb-4">
              <h1 class="text-gray-600 text-2xl font-semibold">Import Data Tahun Ajaran</h1>
              <button @click="openImport = false"><i class="bi bi-x-lg text-2xl mb-4 cursor-pointer"></i></button>
            </div>
            <div class="flex flex-col items-center justify-center w-full h-50 border-4 border-gray-400 border-dashed mb-4">
              <i class="bi bi-upload text-gray-600 text-2xl"></i>
              <p class="text-gray-600">Jatuhkan dokumen anda disini atau <a href="" class="text-blue-600">pilih berkas</a></p>
              <p class="text-gray-400">Didukung: VSC, XLS, XML, JSON</p>
            </div>
            <div class="mb-4 flex justify-center">
              <button class="cursor-pointer px-8 py-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-sm font-semibold text-white">Impor</button>
            </div>
            <div class="flex flex-col items-center justify-center w-full h-20 border-4 border-gray-400 border-dashed mb-4">
              <p class="text-gray-600">Unduh template file impor <a href="" class="text-blue-600">di sini</a></p>
            </div>
          </div>
        </div>
      </div>

      <div class="overflow-x-auto w-68 sm:w-150 md:w-full mt-3 pb-3">
        <table id="myTable" class="text-sm text-left w-full pt-2">
          <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
            <tr>
              <th class="border border-gray-300 px-4 py-2">No</th>
              <th class="border border-gray-300 px-4 py-2">Tahun Mulai</th>
              <th class="border border-gray-300 px-4 py-2">Tahun Selesai</th>
              <th class="border border-gray-300 px-4 py-2">Semester</th>
              <th class="border border-gray-300 px-4 py-2">Status</th>
              <th class="border border-gray-300 px-4 py-2">Tahun Ajaran</th>
              <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="text-center">
            <tr class="hover:bg-gray-50">
              <td class="border border-gray-300 px-4 py-2">1</td>
              <td class="border border-gray-300 px-4 py-2">2023</td>
              <td class="border border-gray-300 px-4 py-2">2024</td>
              <td class="border border-gray-300 px-4 py-2">Ganjil</td>
              <td class="border border-gray-300 px-4 py-2">0</td>
              <td class="border border-gray-300 px-4 py-2">2023/2024</td>
              <td class="border border-gray-300 px-4 py-2 text-center">
                <div class="flex justify-center gap-2">
                  <div x-data="{openView: false}">
                    <button @click="openView = !openView" class="cursor-pointer px-2 py-1 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white rounded-md">
                      <i class="bi bi-eye text-lg"></i>
                    </button>
                    <div x-show="openView" x-transition class="fixed inset-0 z-50 flex justify-center items-center">
                      <div class="absolute inset-0 bg-black opacity-50"></div>
                      <div @click.outside="openView = false" class="relative z-10 bg-white rounded-sm shadow-xl sm:w-[500px] w-[305px] h-[600px] max-w-full p-6 overflow-y-scroll">
                        <div class="flex justify-between items-center mb-4">
                          <h1 class="text-gray-600 text-xl font-semibold">View Data Tahun Ajaran</h1>
                          <button @click="openView = false"><i class="bi bi-x-lg text-2xl mb-4 cursor-pointer"></i></button>
                        </div>
  
                        <div class="flex flex-col md:flex-row">
                          <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                            <label for="" class="mb-1 font-semibold">Tahun Mulai:</label>
                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="2023">
                          </div>
                          <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                            <label for="" class="mb-1 font-semibold">Tahun Selesai:</label>
                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="2024">
                          </div>
                        </div>
                        <div class="flex flex-col md:flex-row">
                          <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                            <label for="" class="mb-1 font-semibold">Semester:</label>
                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="3-4">
                          </div>
                          <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                            <label for="" class="mb-1 font-semibold">Tahun Ajaran Aktif:</label>
                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="Aktif">
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a href="/admin/masterdata/form-tahunAjaran">
                    <button class="cursor-pointer px-2 py-1 bg-yellow-600 hover:bg-yellow-700 active:bg-yellow-800 text-white rounded-md">
                      <i class="bi bi-pencil-square text-lg"></i>
                    </button>
                  </a>

                  <div x-data="{confirmDel: false}" class="relative">
                    <button @click="confirmDel = true" class="cursor-pointer px-2 py-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-md">
                      <i class="bi bi-trash text-lg"></i>
                    </button>
                  
                    <div x-show="confirmDel" x-transition class="fixed inset-0 z-50 flex justify-center items-center">
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
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-layout>
