<x-layoutDosen>
  <div class="h-full">
    <h1 class="font-bold text-gray-800 text-2xl">{{ $title }}</h1>
    <p>Silahkan tambahkan data Admin</p>
    <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">
      
      <form action="">
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8" 
               x-data="{ 
                  open: false, 
                  search: '', 
                  selected: '', 
                  loading: false, 
                  options: ['Budi', 'Santo', 'sujip', 'Budis', 'Santos', 'sujips', 'Budi2', 'Santo2', 'sujip2'],
                  get filtered() { 
                    return this.options.filter(o => o.toLowerCase().includes(this.search.toLowerCase())); 
                  }
               }">
            <label class="mb-1 font-semibold">Pilih Dosen:</label>
      
            <div class="relative">
              <input 
                type="text"
                x-model="search"
                @click="open = true"
                @input="loading = true; setTimeout(() => loading = false, 300)" 
                placeholder="Pilih Dosen"
                class="p-2 py-[8px] w-full border-2 border-gray-700 rounded-sm font-normal focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
              />
              
              <div class="absolute inset-y-0 right-2 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
  
              <div 
                x-show="open" 
                x-cloak
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
          <div class="flex flex-col w-full mb-4 md:w-1/2 " 
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
            <label class="mb-1 font-semibold">Pilih Program Studi:</label>
      
            <div class="relative">
              <input 
                type="text"
                x-model="search"
                @click="open = true"
                @input="loading = true; setTimeout(() => loading = false, 300)" 
                placeholder="Pilih Program Studi"
                class="p-2 py-[8px] w-full border-2 border-gray-700 rounded-sm font-normal focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
              />
              
              <div class="absolute inset-y-0 right-2 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
  
              <div 
                x-show="open" 
                x-cloak
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
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8" 
               x-data="{ 
                  open: false, 
                  search: '', 
                  selected: '', 
                  loading: false, 
                  options: ['1 (satu)', '2 (dua)', '3 (tiga)'],
                  get filtered() { 
                    return this.options.filter(o => o.toLowerCase().includes(this.search.toLowerCase())); 
                  }
               }">
            <label class="mb-1 font-semibold">Pilih Semester:</label>
      
            <div class="relative">
              <input 
                type="text"
                x-model="search"
                @click="open = true"
                @input="loading = true; setTimeout(() => loading = false, 300)" 
                placeholder="Pilih Semester"
                class="p-2 py-[8px] w-full border-2 border-gray-700 rounded-sm font-normal focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
              />
              
              <div class="absolute inset-y-0 right-2 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
  
              <div 
                x-show="open" 
                x-cloak
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
          <div class="flex flex-col w-full mb-4 md:w-1/2 " 
               x-data="{ 
                  open: false, 
                  search: '', 
                  selected: '', 
                  loading: false, 
                  options: ['english', 'statistika', 'algoritma'],
                  get filtered() { 
                    return this.options.filter(o => o.toLowerCase().includes(this.search.toLowerCase())); 
                  }
               }">
            <label class="mb-1 font-semibold">Pilih Mata Kuliah:</label>
      
            <div class="relative">
              <input 
                type="text"
                x-model="search"
                @click="open = true"
                @input="loading = true; setTimeout(() => loading = false, 300)" 
                placeholder="Pilih Mata Kuliah"
                class="p-2 py-[8px] w-full border-2 border-gray-700 rounded-sm font-normal focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
              />
              
              <div class="absolute inset-y-0 right-2 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
  
              <div 
                x-show="open" 
                x-cloak
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
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8" 
               x-data="{ 
                  open: false, 
                  search: '', 
                  selected: '', 
                  loading: false, 
                  options: ['3.1', '2.3', '3.3'],
                  get filtered() { 
                    return this.options.filter(o => o.toLowerCase().includes(this.search.toLowerCase())); 
                  }
               }">
            <label class="mb-1 font-semibold">Pilih Ruangan:</label>
      
            <div class="relative">
              <input 
                type="text"
                x-model="search"
                @click="open = true"
                @input="loading = true; setTimeout(() => loading = false, 300)" 
                placeholder="Pilih Ruangan"
                class="p-2 py-[8px] w-full border-2 border-gray-700 rounded-sm font-normal focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
              />
              
              <div class="absolute inset-y-0 right-2 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
              </div>
  
              <div 
                x-show="open" 
                x-cloak
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
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Pilih Tanggal:</label>
            <input type="date" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan tanggal presensi">
          </div>
        </div>
        
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Jam Awal:</label>
            <input type="time" class="p-2 w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Jam Awal">
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Jam Akhir:</label>
            <input type="time" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan Jam Akhir">
          </div>
        </div>
        
      </form>

      <div class="w-full">
        <button class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
        <a href="/dosen/presensi">
          <button class="px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</button>
        </a>
      </div>
    </div>
  </div>
</x-layoutDosen>