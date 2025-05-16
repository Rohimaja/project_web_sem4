<x-layout>
  <div class="h-full">
    <x-slot:title class="font-bold text-gray-800 text-2xl">{{ $title }}</x-slot:title>
    <p>Lihat Laporan Presensi Dosen </p>
    <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">
      <div class="flex flex-col md:flex-row">
        
        <!-- Program Studi -->
        <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8" 
             x-data="{ 
                open: false, 
                search: '', 
                selected: '', 
                loading: false, 
                options: ['Teknik Informatika', 'Sistem Informasi', 'Teknik Elektro', 'Manajemen', 'Akuntansi'],
                get filtered() { 
                  return this.options.filter(o => o.toLowerCase().includes(this.search.toLowerCase())); 
                }
             }">
          <label class="mb-1 font-semibold">Filter Pilih Dosen:</label>
    
          <div class="relative">
            <input 
              type="text"
              x-model="search"
              @click="open = true"
              @input="loading = true; setTimeout(() => loading = false, 300)" 
              placeholder="Pilih Dosen"
              class="p-2 py-[10.5px] w-full border-2 border-gray-700 rounded-sm font-normal focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
            />
            
            <!-- Icon Dropdown -->
            <div class="absolute inset-y-0 right-2 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
    
            <!-- Dropdown -->
            <div 
              x-show="open" 
              @click.outside="open = false" 
              class="absolute mt-1 w-full bg-white border border-gray-300 rounded shadow-lg z-50 max-h-60 overflow-auto"
            >
              <template x-if="loading">
                <div class="p-2 text-gray-500 text-sm text-center">Loading...</div>
              </template>
    
              <template x-if="!loading && filtered.length === 0">
                <div class="p-2 text-gray-500 text-sm text-center">Tidak ditemukan</div>
              </template>
    
              <template x-for="option in filtered" :key="option">
                <div 
                  @click="search = option; selected = option; open = false"
                  class="cursor-pointer p-2 hover:bg-blue-100"
                  x-text="option"
                ></div>
              </template>
            </div>
          </div>
        </div>
      
    
        <div class="flex flex-col w-full mb-4 md:w-1/2" 
             x-data="{ 
                open: false, 
                search: '', 
                selected: '', 
                loading: false, 
                options: ['Semester 1', 'Semester 2', 'Semester 3', 'Semester 4', 'Semester 5', 'Semester 6', 'Semester 7', 'Semester 8'],
                get filtered() { 
                  return this.options.filter(o => o.toLowerCase().includes(this.search.toLowerCase())); 
                }
             }">
          <label class="mb-1 font-semibold">Filter Tahun Ajaran:</label>
    
          <div class="relative">
            <input 
              type="text"
              x-model="search"
              @click="open = true"
              @input="loading = true; setTimeout(() => loading = false, 300)" 
              placeholder="Pilih Tahun Ajaran"
              class="p-2 py-[11px] w-full border-2 border-gray-700 rounded-sm font-normal focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
            />
            
            <div class="absolute inset-y-0 right-2 flex items-center pointer-events-none">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
              </svg>
            </div>
    
            <div 
              x-show="open" 
              @click.outside="open = false" 
              class="absolute mt-1 w-full bg-white border border-gray-300 rounded shadow-lg z-50 max-h-60 overflow-auto"
            >
              <template x-if="loading">
                <div class="p-2 text-gray-500 text-sm text-center">Loading...</div>
              </template>
    
              <template x-if="!loading && filtered.length === 0">
                <div class="p-2 text-gray-500 text-sm text-center">Tidak ditemukan</div>
              </template>
    
              <template x-for="option in filtered" :key="option">
                <div 
                  @click="search = option; selected = option; open = false"
                  class="cursor-pointer p-2 hover:bg-blue-100"
                  x-text="option"
                ></div>
              </template>
            </div>
          </div>
        </div>
      </div>

      <div class="my-2 mb-5 flex  gap-4">
        <a href="">
          <button class="flex items-center px-4 py-2.5 text-white bg-green-700 hover:bg-green-800 active:bg-green-900 rounded-sm font-semibold cursor-pointer">
            <i class="bi bi-file-earmark-excel mr-2"></i>
            <span>Export Excel</span>
          </button>
        </a>

        <button @click="openImport = !openImport" class="flex items-center px-4 py-2.5 text-white bg-red-600 hover:bg-red-700 active:bg-red-800 rounded-sm font-semibold cursor-pointer">
          <i class="bi bi-filetype-pdf mr-2"></i>
          <span>Export Pdf</span>
        </button>
      </div>


      <div class="flex flex-col gap-3 my-3">
        <div class="flex flex-col md:flex-row items-start md:items-center gap-2">
          <label for="nip" class="w-20 font-semibold">NIP:</label>
          <input type="text" id="nip" disabled name="nip" class="border border-gray-300 bg-gray-300 rounded px-3 py-2 w-full md:w-60" value="E09263742784292">
        </div>
        
        <div class="flex flex-col md:flex-row items-start md:items-center gap-2">
          <label for="nama" class="w-20 font-semibold">Nama:</label>
          <input type="text" id="nama" disabled name="nama" class="border border-gray-300 bg-gray-300 rounded px-3 py-2 w-full md:w-60" value="Edwin Kurniawan">
        </div>
      </div>
      

      <div x-data="{ hovering: false }" class="overflow-x-auto w-60 sm:w-150 md:w-240 xl:min-w-full mt-1 pb-3">
        <table id="myTable" class="text-sm text-left w-full pt-4">
            <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                <tr>
                    <th @mouseenter="hovering = true" @mouseleave="hovering = false"
                    :class="hovering ? 'bg-blue-500 text-white' : 'bg-gray-200'" class="border border-gray-300 px-4 py-2">No</th>
                    <th class="border border-gray-300 px-4 py-2">Program Studi</th>
                    <th class="border border-gray-300 px-4 py-2">Semester</th>
                    <th class="border border-gray-300 px-4 py-2">Mata Kuliah</th>
                    @for ($i = 1; $i <= 13; $i++)
                        <th class="border border-gray-300 px-4 py-2 text-center">{{ $i }}</th>
                    @endfor
                    <th class="border border-gray-300 px-4 py-2">%hadir</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2">1</td>
                    <td class="border border-gray-300 px-4 py-2">MIK</td>
                    <td class="border border-gray-300 px-4 py-2">3</td>
                    <td class="border border-gray-300 px-4 py-2">English</td>
                    @for ($i = 1; $i <= 13; $i++)
                        <td class="border border-gray-300 px-4 py-2 bg-green-600 text-white font-bold text-xl">H</td>
                    @endfor
                    <td class="border border-gray-300 px-4 py-2">80%</td>
                </tr>
            </tbody>
        </table>
      </div>
      <div class="mt-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-5">Keterangan:</h2>
        <p class="mt-2"><span class="text-white font-bold p-1 bg-green-500">H</span> = Hadir Kuliah</p>
        <p class="mt-2"><span class="text-white font-bold py-1 px-2 bg-yellow-500">I</span> = Izin Kuliah</p>
        <p class="mt-2"><span class="text-white font-bold p-1 bg-red-500">A</span> = Alpha Kuliah</p>
      </div>
    </div>
</x-layout>