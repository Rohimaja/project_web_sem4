<x-layout>
    @vite(['resources/js/pages/admin/data-matkul.js'])
    <div class="relative">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Lihat data Mata Kuliah</p>
        <div x-data="{openImport: false}" class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white rounded-sm shadow-xl">
            <div class="flex flex-col md:flex-row">
                <div class="flex flex-col w-full mb-4 md:w-1/3 mr-0 md:mr-8"
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
                  <label class="mb-1 font-semibold">Filter Program Studi:</label>

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
                <div class="flex flex-col w-full mb-4 md:w-1/3 mr-0 md:mr-8"
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
                  <label class="mb-1 font-semibold">Filter Tahun Ajaran:</label>

                  <div class="relative">
                    <input
                      type="text"
                      x-model="search"
                      @click="open = true"
                      @input="loading = true; setTimeout(() => loading = false, 300)"
                      placeholder="Pilih Tahun Ajaran"
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
                <div class="flex flex-col w-full mb-4 md:w-1/3 "
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
                  <label class="mb-1 font-semibold">Filter Semester:</label>

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
              </div>

            <div class="mt-2 mb-5 flex gap-4">
                <a href="{{route('admin.master-matkul.create')}}">
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
                <div x-show="openImport" x-cloak class="fixed inset-0 z-50 flex justify-center items-center">

                    <div class="absolute inset-0 bg-black opacity-50"></div>

                    <div @click.outside="openImport = false" class="relative z-10 bg-white rounded-sm shadow-xl sm:w-[500px] w-[380px] max-w-full p-6" >
                        <div class="flex justify-between items-center mb-4">
                            <h1 class="text-gray-600 text-2xl font-semibold">Import Data Mata Kuliah</h1>
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
                <table id="data-matkul" class="text-sm text-left w-full pt-2">
                    <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">No</th>
                            <th class="border border-gray-300 px-4 py-2">Nama Mata Kuliah</th>
                            <th class="border border-gray-300 px-4 py-2">Program Studi</th>
                            <th class="border border-gray-300 px-4 py-2">SKS</th>
                            <th class="border border-gray-300 px-4 py-2">Tahun Ajaran</th>
                            <th class="border border-gray-300 px-4 py-2">Semester</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matkul as $m )
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{$loop->iteration}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$m->nama_matkul}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$m->prodi->jenjang . ' ' .$m->prodi->nama_prodi ?? ''}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$m->durasi_matkul}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$m->tahun->tahun_awal .'/'. $m->tahun->tahun_akhir .' '.$m->tahun->keterangan ?? ''}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$m->semester}}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{route('admin.master-matkul.edit', $m->id)}}" class="cursor-pointer px-2 py-1 bg-yellow-600 hover:bg-yellow-700 active:bg-yellow-800 text-white rounded-md">
                                            <i class="bi bi-pencil-square text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.master-matkul.destroy', $m->id) }}" method="POST" class="form-hapus inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-md">
                                                <i class="bi bi-trash text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-layout>
