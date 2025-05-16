<x-layout>
    @vite(['resources/js/pages/admin/data-dosen.js'])
    <div class="relative">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Lihat data Dosen hari ini</p>
        <div x-data="{openImport: false}" class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white rounded-sm shadow-xl">
<<<<<<< HEAD
            <div class="flex flex-col md:flex-row">
                <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8"
                    x-data="{
                        open: false,
                        search: '',
                        selected: '',
                        loading: false,
                        options: [],
                        get filtered() {
                          return this.options.filter(o => o.toLowerCase().includes(this.search.toLowerCase()));
                        },
                            async fetchOptions() {
                            this.loading = true;
                            const res = await fetch('/admin/api/prodi');
                            this.options = await revites.json();
                            this.loading = false;
                        }
                    }"
                    x-init="fetchOptions()">
                  <label class="mb-1 font-semibold">Filter Pilih Dosen:</label>

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
              </div>
=======
            <div class="flex flex-col w-full mb-4">
                <label for="" class="mb-1 font-semibold">Program Studi:</lab>
                <select class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 rounded-sm" name="prodi_id" id="prodi_id" required>
                    <option value="" hidden selected>Pilih Program Studi</option>
                    <option value="">a</option>
                    <option value="">a</option>
                </select>
                @error('prodi_id')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror
            </div>

>>>>>>> 8934609 (fixed responsive & view  admin)

            <div class="mt-2 mb-5 flex gap-4">
                <a href="{{route('admin.master-dosen.create')}}">
                    <button class="flex items-center px-4 py-2.5 text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-sm font-semibold cursor-pointer">
                        <i class="bi bi-plus-square-fill mr-2"></i>
                        <span>Tambah</span>
                    </button>
                </a>

                <button @click="openImport = !openImport" class="flex items-center px-4 py-2.5 text-white bg-green-600 hover:bg-green-700 active:bg-green-800 rounded-sm font-semibold cursor-pointer">
                    <i class="bi bi-plus-square-fill mr-2"></i>
                    <span>Import</span>
                </button>

                {{-- tampilan import file --}}
                <div x-show="openImport" x-cloak class="fixed inset-0 z-50 flex justify-center items-center">

                    <div class="absolute inset-0 bg-black opacity-50"></div>

                    <div @click.outside="openImport = false" class="relative z-10 bg-white rounded-sm shadow-xl sm:w-[500px] w-[380px] max-w-full p-6" >
                        <div class="flex justify-between items-center mb-4">
                            <h1 class="text-gray-600 text-2xl font-semibold">Import Data Dosen</h1>
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

<<<<<<< HEAD
            <div class="overflow-x-auto w-68 sm:w-150 md:w-full mt-3 pb-3">
                <table id="data-dosen" class="text-sm text-left w-full pt-2">
                    <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2">No</th>
                            <th class="border border-gray-300 px-4 py-2">Foto</th>
                            <th class="border border-gray-300 px-4 py-2">NIP</th>
                            <th class="border border-gray-300 px-4 py-2">Nama</th>
                            <th class="border border-gray-300 px-4 py-2">Email</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Aksi</th>
=======
            <div class="overflow-x-auto w-[270px] sm:w-150 md:w-full mt-3 pb-3">
                <table id="myTable" class="text-sm text-left w-full pt-2">
                    <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                        <tr>
                            <th class="border border-gray-300 px-4">No</th>
                            <th class="border border-gray-300 px-4">Foto</th>
                            <th class="border border-gray-300 px-4">NIP</th>
                            <th class="border border-gray-300 px-4">Nama</th>
                            <th class="border border-gray-300 px-4">Email</th>
                            <th class="border border-gray-300 px-4 text-center">Aksi</th>
>>>>>>> 8934609 (fixed responsive & view  admin)
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($dosen as $d)
                            <tr class="hover:bg-gray-50">
<<<<<<< HEAD
                                <td class="border border-gray-300 px-4 py-2">{{$loop->iteration}}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div  class="w-10 h-10 bg-red-200 rounded-full overflow-hidden">
                                        <img src="{{ $d->foto ? asset('storage/' . $d->foto) : asset('images/profil-kosong.png') }}" alt="Photo">
                                    </div>
                                </td>
                                <td class="border border-gray-300 px-4 py-2">{{$d->nip}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$d->nama}}</td>
                                <td class="border border-gray-300 px-4 py-2">{{$d->email}}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
=======
                                <td class="border border-gray-300 px-4">{{$loop->iteration}}</td>
                                <td class="border border-gray-300 px-4">
                                    <div  class="w-10 h-10 bg-red-200 rounded-full overflow-hidden">
                                        <img src="{{ asset('storage/' . $d->foto) }}" alt="Photo">
                                    </div>
                                </td>
                                <td class="border border-gray-300 px-4">{{$d->nip}}</td>
                                <td class="border border-gray-300 px-4">{{$d->nama}}</td>
                                <td class="border border-gray-300 px-4">{{$d->email}}</td>
                                <td class="border border-gray-300 px-4 text-center">
>>>>>>> 8934609 (fixed responsive & view  admin)
                                    <div class="flex justify-center gap-2">

                                <div x-data="{openView: false}">
                                    <button @click="openView = !openView" class="cursor-pointer px-2 py-1 bg-gray-600 hover:bg-gray-700 active:bg-gray-800 text-white rounded-md">
                                        <i class="bi bi-eye text-lg"></i>
                                    </button>
                                    <div x-show="openView" x-cloak x-transition class="shadow-xl fixed inset-0 z-50 flex justify-center items-center">
                                        <div class="absolute inset-0 bg-black opacity-50"></div>
                                        <div @click.outside="openView = false" class="relative z-10 bg-white rounded-sm shadow-xl sm:w-[500px] w-[305px] h-[600px] max-w-full p-6 overflow-y-scroll">
<<<<<<< HEAD
                                        <div class="flex justify-between items-center mb-4">
                                            <h1 class="text-gray-600 text-xl font-semibold">View Data Mahasiswa</h1>
                                            <button @click="openView = false"><i class="bi bi-x-lg text-2xl mb-4 cursor-pointer"></i></button>
                                        </div>

                                        <div class="flex w-full justify-center items-center">
                                            <div  class="w-25 h-25 bg-red-200 rounded-full overflow-hidden cursor-pointer mb-3">
                                                <img src="{{asset('storage/'. $d->foto)}}" class="w-full h-full object-cover" alt="Photo">
                                            </div>
=======
                                        <div class="flex justify-between items-center mb-6 border-b pb-3">
                                            <h2 class="text-2xl font-semibold text-gray-700">View Data Admin</h2>
                                            <button @click="openView = false" class="text-gray-500 hover:text-gray-900 transition">
                                                <i class="bi bi-x-lg text-3xl"></i>
                                            </button>
                                        </div>

                                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-indigo-500 shadow-lg mb-6 cursor-pointer">
                                            <img src="{{asset('storage/'. $d->foto)}}" class="w-full h-full object-cover" alt="Photo">
>>>>>>> 8934609 (fixed responsive & view  admin)
                                        </div>

                                        <div class="flex flex-col md:flex-row">
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                            <label for="" class="mb-1 font-semibold">Nama Lengkap:</label>
<<<<<<< HEAD
                                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->nama}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">NIP:</label>
                                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->nip}}">
=======
                                            <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->nama}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">NIP:</label>
                                            <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->nip}}">
>>>>>>> 8934609 (fixed responsive & view  admin)
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row">
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                            <label for="" class="mb-1 font-semibold">Jenis Kelamin:</label>
<<<<<<< HEAD
                                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->jenis_kelamin}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Agama:</label>
                                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->agama}}">
=======
                                            <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->jenis_kelamin}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Agama:</label>
                                            <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->agama}}">
>>>>>>> 8934609 (fixed responsive & view  admin)
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row">
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                            <label for="" class="mb-1 font-semibold">Tempat Lahir:</label>
<<<<<<< HEAD
                                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->tempat_lahir}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Tanggal Lahir:</label>
                                            <input type="date" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->tgl_lahir}}">
=======
                                            <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->tempat_lahir}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Tanggal Lahir:</label>
                                            <input type="date" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->tgl_lahir}}">
>>>>>>> 8934609 (fixed responsive & view  admin)
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row">
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                            <label for="" class="mb-1 font-semibold">Email:</label>
<<<<<<< HEAD
                                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->email}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Nomor Telepon:</label>
                                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->no_telp}}">
=======
                                            <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->email}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Nomor Telepon:</label>
                                            <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->no_telp}}">
>>>>>>> 8934609 (fixed responsive & view  admin)
                                            </div>
                                        </div>
                                        <div class="flex flex-col md:flex-row">
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                            <label for="" class="mb-1 font-semibold">Provinsi:</label>
<<<<<<< HEAD
                                            <input type="text" disabled id="provinsi" name="provinsi_id" class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->province->name}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Kota / Kabupaten:</label>
                                            <input type="text" disabled id="kota" class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->regency->name}}">
=======
                                            <input type="text" readonly id="provinsi" name="provinsi_id" class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->province->name}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Kota / Kabupaten:</label>
                                            <input type="text" readonly id="kota" class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->regency->name}}">
>>>>>>> 8934609 (fixed responsive & view  admin)
                                            </div>
                                        </div>

                                        <div class="flex flex-col md:flex-row">
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                            <label for="" class="mb-1 font-semibold">Kecamatan:</label>
<<<<<<< HEAD
                                            <input type="text" disabled id="kecamatan"  class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->district->name}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Kelurahan:</label>
                                            <input type="text" disabled id="kelurahan" class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->village->name}}">
=======
                                            <input type="text" readonly id="kecamatan"  class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->district->name}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Kelurahan:</label>
                                            <input type="text" readonly id="kelurahan" class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->village->name}}">
>>>>>>> 8934609 (fixed responsive & view  admin)
                                            </div>
                                        </div>

                                        <div class="flex flex-col md:flex-row">
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                            <label for="" class="mb-1 font-semibold">Jenjang Studi:</label>
<<<<<<< HEAD
                                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->prodi->jenjang.' '.$d->prodi->nama_prodi}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Alamat:</label>
                                            <input type="text" disabled class="bg-gray-100 w-full p-2 border-2 border-gray-700 rounded-sm" value="{{$d->alamat}}">
=======
                                            <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->prodi->jenjang.' '.$d->prodi->nama_prodi}}">
                                            </div>
                                            <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                            <label for="" class="mb-1 font-semibold">Alamat:</label>
                                            <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$d->alamat}}">
>>>>>>> 8934609 (fixed responsive & view  admin)
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    </div>

                                        <a href="{{route('admin.master-dosen.edit', $d->id)}}" class="cursor-pointer px-2 py-1 bg-yellow-600 hover:bg-yellow-700 active:bg-yellow-800 text-white rounded-md">
                                            <i class="bi bi-pencil-square text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.master-dosen.destroy', $d->id) }}" method="POST" class="form-hapus inline-block">
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
