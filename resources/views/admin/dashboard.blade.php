<x-layout>
  <div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Selamat Datang, <b>{{Auth::user()->name}}</b></p>
      <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4 mb-5">
          <a href="{{route('admin.master-mahasiswa.index')}}">
            <div class="w-[310px] md:w-full group bg-gradient-to-br from-cyan-100 to-cyan-300 rounded-xl shadow-md p-4 border-b-4 border-blue-800 
            transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer"> 
                  <h2 class="text-base font-semibold text-gray-700">Total Mahasiswa</h2>
                  <div class="mt-3 flex items-center justify-between">
                      <i class="bi bi-person-circle text-4xl text-blue-800"></i>
                      <h1 class="text-3xl font-bold text-blue-800">{{$mahasiswa}}</h1>
                  </div>
              </div>
          </a>

          <a href="{{route('admin.master-dosen.index')}}">
            <div class="w-[310px] md:w-full group bg-gradient-to-br from-purple-100 to-purple-300 rounded-xl shadow-md p-4 border-b-4 border-purple-800 
            transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
              <h2 class="text-base font-semibold text-gray-700">Total Dosen</h2>
                  <div class="mt-3 flex items-center justify-between">
                      <i class="bi bi-person-workspace text-4xl text-purple-800"></i>
                      <h1 class="text-3xl font-bold text-purple-800">{{$dosen}}</h1>
                  </div>
              </div>
          </a>

          <a href="{{route('admin.master-matkul.index')}}">
              <div class="w-[310px] md:w-full group bg-gradient-to-br from-green-100 to-green-300 rounded-xl shadow-md p-4 border-b-4 border-green-800 
              transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
              <h2 class="text-base font-semibold text-gray-700">Total Mata Kuliah</h2>
                  <div class="mt-3 flex items-center justify-between">
                      <i class="bi bi-journal-bookmark-fill text-4xl text-green-800"></i>
                      <h1 class="text-3xl font-bold text-green-800">{{$matkul}}</h1>
                  </div>
              </div>
          </a>

          <a href="{{route('admin.master-prodi.index')}}">
            <div class="w-[310px] md:w-full group bg-gradient-to-br from-red-100 to-red-300 rounded-xl shadow-md p-4 border-b-4 border-red-800 
            transition-all duration-300 ease-in-out hover:scale-95 hover:border-b-0 cursor-pointer">
              <h2 class="text-base font-semibold text-gray-700">Total Program Studi</h2>
                  <div class="mt-3 flex items-center justify-between">
                      <i class="bi bi-book-half text-4xl text-red-800"></i>
                      <h1 class="text-3xl font-bold text-red-800">{{$prodi}}</h1>
                  </div>
              </div>
          </a>
      </div>

      <!-- Grafik Absensi -->
    <div class="flex flex-col md:flex-row gap-5 mb-5">
      <!-- Grafik Bulanan -->
      <div class="w-[310px] md:w-3/4 bg-white rounded-sm shadow-xl">
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Absensi Mahasiswa Perbulan</h1>
        </div>
        <div class="p-6 overflow-x-auto">
          <div id="chart" class="w-full h-64 min-w-[300px]"></div>
        </div>
      </div>

      <!-- Grafik Tahunan -->
      <div class="w-[310px] md:w-1/4 bg-white rounded-sm shadow-xl">
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Absensi Mahasiswa Pertahun</h1>
        </div>
        <div class="p-6 overflow-x-auto">
          <div id="chart-doghout" class="w-full h-64 min-w-[300px]"></div>
        </div>
      </div>
    </div>

    <!-- Tabel & Grafik Absensi Dosen -->
    <div class="flex flex-col md:flex-row gap-5">
      <!-- Tabel Dosen -->
      <div class="w-[310px] md:w-1/2 bg-white rounded-sm shadow-xl">
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Daftar Dosen Mengajar</h1>
          <span class="text-sm text-gray-400">
            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
          </span>
        </div>
        <div class="overflow-auto h-[350px] px-4 pb-4 mt-5">
          <div class="overflow-x-auto w-68 sm:w-150 md:w-full mt-3 pb-3">
            <table id="tbl-pres" class="text-sm text-left w-full pt-2">
              <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                <tr>
                  <th class="border border-gray-300 px-4 py-2">No</th>
                  <th class="border border-gray-300 px-4 py-2">Dosen</th>
                  <th class="border border-gray-300 px-4 py-2">Program Studi</th>
                  <th class="border border-gray-300 px-4 py-2">Semester</th>
                  <th class="border border-gray-300 px-4 py-2">Mata Kuliah</th>
                  <th class="border border-gray-300 px-4 py-2">Ruangan</th>
                  <th class="border border-gray-300 px-4 py-2">Jam Mulai</th>
                  <th class="border border-gray-300 px-4 py-2">Jam Akhir</th>
                </tr>
              </thead>
              <tbody class="text-center">
                <tr class="hover:bg-gray-50">
                  <td class="border border-gray-300 px-4 py-2">1</td>
                  <td class="border border-gray-300 px-4 py-2">P budiyanto</td>
                  <td class="border border-gray-300 px-4 py-2">MIK</td>
                  <td class="border border-gray-300 px-4 py-2">2</td>
                  <td class="border border-gray-300 px-4 py-2">English</td>
                  <td class="border border-gray-300 px-4 py-2">3.2</td>
                  <td class="border border-gray-300 px-4 py-2">08.00</td>
                  <td class="border border-gray-300 px-4 py-2">10.00</td>
                </tr>
                <tr class="hover:bg-gray-50">
                  <td class="border border-gray-300 px-4 py-2">1</td>
                  <td class="border border-gray-300 px-4 py-2">P budiyanto</td>
                  <td class="border border-gray-300 px-4 py-2">MIK</td>
                  <td class="border border-gray-300 px-4 py-2">2</td>
                  <td class="border border-gray-300 px-4 py-2">English</td>
                  <td class="border border-gray-300 px-4 py-2">3.2</td>
                  <td class="border border-gray-300 px-4 py-2">08.00</td>
                  <td class="border border-gray-300 px-4 py-2">10.00</td>
                </tr>
                <tr class="hover:bg-gray-50">
                  <td class="border border-gray-300 px-4 py-2">1</td>
                  <td class="border border-gray-300 px-4 py-2">P budiyanto</td>
                  <td class="border border-gray-300 px-4 py-2">MIK</td>
                  <td class="border border-gray-300 px-4 py-2">2</td>
                  <td class="border border-gray-300 px-4 py-2">English</td>
                  <td class="border border-gray-300 px-4 py-2">3.2</td>
                  <td class="border border-gray-300 px-4 py-2">08.00</td>
                  <td class="border border-gray-300 px-4 py-2">10.00</td>
                </tr>
                <tr class="hover:bg-gray-50">
                  <td class="border border-gray-300 px-4 py-2">1</td>
                  <td class="border border-gray-300 px-4 py-2">P budiyanto</td>
                  <td class="border border-gray-300 px-4 py-2">MIK</td>
                  <td class="border border-gray-300 px-4 py-2">2</td>
                  <td class="border border-gray-300 px-4 py-2">English</td>
                  <td class="border border-gray-300 px-4 py-2">3.2</td>
                  <td class="border border-gray-300 px-4 py-2">08.00</td>
                  <td class="border border-gray-300 px-4 py-2">10.00</td>
                </tr>
                <tr class="hover:bg-gray-50">
                  <td class="border border-gray-300 px-4 py-2">1</td>
                  <td class="border border-gray-300 px-4 py-2">P budiyanto</td>
                  <td class="border border-gray-300 px-4 py-2">MIK</td>
                  <td class="border border-gray-300 px-4 py-2">2</td>
                  <td class="border border-gray-300 px-4 py-2">English</td>
                  <td class="border border-gray-300 px-4 py-2">3.2</td>
                  <td class="border border-gray-300 px-4 py-2">08.00</td>
                  <td class="border border-gray-300 px-4 py-2">10.00</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- Grafik Absensi Dosen -->
      <div class="w-[310px] md:w-1/2 bg-white rounded-sm shadow-xl">
        <div class="p-4 rounded-t-xl border-b-2 border-gray-500 flex justify-between items-center">
          <h1 class="text-gray-500 text-lg font-semibold">Absensi Dosen Perbulan</h1>
        </div>
        <div class="p-6 overflow-x-auto">
          <div id="chart-dosen" class="w-full h-64 min-w-[300px]"></div>
        </div>
      </div>
    </div>
  </div>
</x-layout>
