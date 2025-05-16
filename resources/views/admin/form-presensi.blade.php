<x-layout>
<<<<<<< HEAD
    @vite(['resources/js/pages/admin/data-presensi.js'])
    <div class="h-full">
        <x-slot:title>{{ $title }}</x-slot:title>
        <p>Silahkan tambahkan data Admin</p>
        <div class="w-full h-max max-w-full mt-5 p-8 bg-gray-150 rounded-sm shadow-xl">

            <form action="{{route('admin.presensi.store')}}" method="POST" class="form-presensi">
            @csrf

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label class="mb-1 font-semibold">Pilih Dosen:</label>
                        <select id="dosen" name="dosen_id" required>
                            <option value="" hidden selected>Pilih Dosen</option>
                            @foreach ($dosen as $d)
                                <option value="{{ $d->id }}" {{ old('dosen_id') == $d->id ? 'selected' : '' }}>
                                    {{ $d->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('dosen_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label class="mb-1 font-semibold">Pilih Program Studi:</label>
                        <select id="prodi" name="prodi_id" class="w-full" required>
                            <option value="" hidden selected>Pilih Program Studi</option>
                            @foreach ($prodi as $p)
                                <option value="{{ $p->id }}" {{ old('prodi_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->jenjang.' '.$p->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-red-600 text-sm" id="prodi_id_error">
                            @error('prodi_id'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label class="mb-1 font-semibold">Pilih Matkul:</label>
                        <select id="matkul" name="matkul_id"  class="w-full" required>
                            <option value="" hidden selected>Pilih Matkul</option>
                        </select>
                        <span class="text-red-600 text-sm" id="matkul_id_error">
                            @error('matkul_id'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0">
                        <label class="mb-1 font-semibold">Pilih Semester:</label>
                        <select id="semester" name="semester" class="w-full" required >
                            <option value="" hidden selected>Pilih Senester</option>
                                @for($i = 1; $i <= 14; $i++)
                                    {{-- <option value="{{ $i }}"> --}}
                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>
                                        Semester {{$i}}
                                    </option>
                                @endfor
                        </select>
                        <span class="text-red-600 text-sm" id="semester_error">
                            @error('semester'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label class="mb-1 font-semibold">Pilih Ruangan:</label>
                        <select id="ruangan" name="ruangan_id" class="w-full" required>
                            <option value="" hidden selected>Pilih Ruangan</option>
                            @foreach ($ruangan as $r)
                                <option value="{{ $r->id }}" {{ old('ruangan_id') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ruangan }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-red-600 text-sm" id="ruangan_id_error">
                            @error('ruangan_id'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Pilih Tanggal:</label>
                        <input type="date" name="tgl_presensi" class="p-2 border-2 mt-1 border-gray-400 rounded-sm" value="{{old('tgl_presensi')}}" placeholder="Masukkan tanggal presensi" required>
                    </div>
                    <span class="text-red-600 text-sm" id="tgl_presensi_error">
                        @error('tgl_presensi'){{ $message }}@enderror
                    </span>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Jam Awal:</label>
                        <input type="time" name="jam_awal" value="{{old('jam_awal')}}" class="p-2 w-full border-2 border-gray-400 rounded-sm" placeholder="Masukkan Jam Awal" required>
                        <span class="text-red-600 text-sm" id="jam_awal_error">
                            @error('jam_awal'){{ $message }}@enderror
                        </span>
                    </div>
                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Jam Akhir:</label>
                        <input type="time" name="jam_akhir" value="{{old('jam_akhir')}}" class="p-2 w-full border-2 border-gray-400 rounded-sm" placeholder="Masukkan Jam Akhir" required>
                        <span class="text-red-600 text-sm" id="jam_akhir_error">
                            @error('jam_akhir'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="w-full flex justify-end">
                    <button type="submit" class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
                    <a href="{{route('admin.presensi.index')}}" class="px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
=======
    <div class="h-full">
        <x-slot:title>{{ $title }}</x-slot:title>
        <p>Masukkan Data Kehadiran Untuk Sesi Kuliah ini</p>
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
                  class="p-2 py-[8px] w-full border-2 border-gray-400 rounded-sm font-normal focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
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
                  class="p-2 py-[8px] w-full border-2 border-gray-400 rounded-sm font-normal focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
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
                  class="p-2 py-[8px] w-full border-2 border-gray-400 rounded-sm font-normal focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
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
                  class="p-2 py-[8px] w-full border-2 border-gray-400 rounded-sm font-normal focus:outline-none focus:ring-2 focus:ring-blue-400 pr-10"
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
            <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                <label class="mb-1 font-semibold">Pilih Dosen:</label>
                <select id="dosen" name="dosen_id" class="w-full" required>
                    <option value="" hidden selected>Pilih Dosen</option>
                    <option value="">Pilih Dosen</option>
                    <option value="">Pilih Dosen</option>
                </select>
            </div>
            <div class="flex flex-col w-full mb-4 md:w-1/2">
              <label for="" class="mb-1 font-semibold">Pilih Tanggal:</label>
              <input type="date" class="p-2 border-2 border-gray-400 rounded-sm" placeholder="Masukkan tanggal presensi">
            </div>
          </div>

          <div class="flex flex-col md:flex-row">
            <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
              <label for="" class="mb-1 font-semibold">Jam Awal:</label>
              <input type="time" class="p-2 w-full flex border-2 font-normal border-gray-400 rounded-sm" placeholder="Masukkan Jam Awal">
            </div>
            <div class="flex flex-col w-full mb-4 md:w-1/2">
              <label for="" class="mb-1 font-semibold">Jam Akhir:</label>
              <input type="time" class="p-2 border-2 border-gray-400 rounded-sm" placeholder="Masukkan Jam Akhir">
            </div>
          </div>

        </form>

        <div class="w-full flex justify-end mt-7">
          <a href="/admin/presensi">
            <button class="px-5 py-2 mr-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</button>
          </a>
          <button class="px-5 py-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
        </div>
      </div>
    </div>
  </x-layout>
>>>>>>> 8934609 (fixed responsive & view  admin)
