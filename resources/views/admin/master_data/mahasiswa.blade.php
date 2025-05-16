<x-layout>
    @vite(['resources/js/pages/admin/data-mahasiswa.js'])

    <div class="relative">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Lihat data Mahasiswa hari ini</p>
    <div x-data="{openImport: false}" class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white rounded-sm shadow-xl">
        <div class="w-full">
            <div class="flex flex-col w-full mb-4">
                <label for="" class="mb-1 font-semibold">Tahun Ajaran:</lab>
                <select class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-300 rounded-sm" name="jenis_kelamin" id="jenis_kelamin" required>
                    <option value="" hidden selected>Pilih Tahun Ajaran</option>
                    <option value="">2023/2024 genap</option>
                    <option value="">2023/2024 genap</option>
                    <option value="">2023/2024 genap</option>
                </select>
            </div>
        </div>


        {{-- <div x-data="{openImport: false}" class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white rounded-sm shadow-xl"> --}}
            <div class="mt-2 mb-5 flex gap-4">
                <a href="{{route('admin.master-mahasiswa.create')}}">
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
                            <h1 class="text-gray-600 text-2xl font-semibold">Import Data Mahasiswa</h1>
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

            <div class="overflow-x-auto w-[270px] sm:w-150 md:w-full mt-3 pb-3">
                <table id="myTable" class="text-sm text-left w-full pt-2">
                    <thead class="bg-gray-200 text-gray-700 sticky top-0 z-10">
                        <tr>
                            <th class="border border-gray-300 px-4">No</th>
                            <th class="border border-gray-300 px-4">Foto</th>
                            <th class="border border-gray-300 px-4">NIM</th>
                            <th class="border border-gray-300 px-4">Nama</th>
                            <th class="border border-gray-300 px-4">Jenis Kelamin</th>
                            <th class="border border-gray-300 px-4">Email</th>
                            <th class="border border-gray-300 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($mahasiswa as $m)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4">{{$loop->iteration}}</td>
                                <td class="border border-gray-300 px-4">
                                    <div  class="w-10 h-10 bg-red-200 rounded-full overflow-hidden">
                                        <img src="{{ asset('storage/' . $m->foto) }}" alt="Photo">
                                    </div>
                                </td>
                                <td class="border border-gray-300 px-4">{{$m->nim}}</td>
                                <td class="border border-gray-300 px-4">{{$m->nama}}</td>
                                <td class="border border-gray-300 px-4">{{$m->jenis_kelamin}}</td>
                                <td class="border border-gray-300 px-4">{{$m->email}}</td>
                                <td class="border border-gray-300 px-4 text-center">
                                    <div class="flex justify-center gap-2">

                                    <div x-data="{openView: false}">
                                        <button @click="openView = !openView" class="cursor-pointer px-2 py-1 bg-gray-600 hover:bg-gray-700 active:bg-gray-800 text-white rounded-md">
                                            <i class="bi bi-eye text-lg"></i>
                                        </button>
                                        <div x-show="openView" x-cloak x-transition class="shadow-xl fixed inset-0 z-50 flex justify-center items-center">
                                            <div class="absolute inset-0 bg-black opacity-50"></div>
                                            <div @click.outside="openView = false" class="relative z-10 bg-white rounded-sm shadow-xl sm:w-[500px] w-[305px] h-[600px] max-w-full p-6 overflow-y-scroll">
                                            <div class="flex justify-between items-center mb-6 border-b pb-3">
                                                <h2 class="text-2xl font-semibold text-gray-700">View Data Admin</h2>
                                                <button @click="openView = false" class="text-gray-500 hover:text-gray-900 transition">
                                                    <i class="bi bi-x-lg text-3xl"></i>
                                                </button>
                                            </div>

                                            <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-4 border-indigo-500 shadow-lg mb-6 cursor-pointer">
                                                <img src="{{asset('storage/'. $m->foto)}}" class="w-full h-full object-cover" alt="Photo">
                                            </div>

                                            <div class="flex flex-col md:flex-row">
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                                    <label for="" class="mb-1 font-semibold">Nama Lengkap:</label>
                                                    <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->nama}}">
                                                </div>
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                                    <label for="" class="mb-1 font-semibold">NIM:</label>
                                                    <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->nim}}">
                                                </div>
                                            </div>
                                            <div class="flex flex-col md:flex-row">
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                                    <label for="" class="mb-1 font-semibold">Jenis Kelamin:</label>
                                                    <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->jenis_kelamin}}">
                                                </div>
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                                    <label for="" class="mb-1 font-semibold">Agama:</label>
                                                    <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->agama}}">
                                                </div>
                                            </div>
                                            <div class="flex flex-col md:flex-row">
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                                    <label for="" class="mb-1 font-semibold">Tempat Lahir:</label>
                                                    <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->tempat_lahir}}">
                                                </div>
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                                    <label for="" class="mb-1 font-semibold">Tanggal Lahir:</label>
                                                    <input type="date" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->tgl_lahir}}">
                                                </div>
                                            </div>
                                            <div class="flex flex-col md:flex-row">
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                                    <label for="" class="mb-1 font-semibold">Email:</label>
                                                    <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->email}}">
                                                </div>
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                                    <label for="" class="mb-1 font-semibold">Nomor Telepon:</label>
                                                    <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->no_telp}}">
                                                </div>
                                            </div>
                                            <div class="flex flex-col md:flex-row">
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                                    <label for="" class="mb-1 font-semibold">Provinsi:</label>
                                                    <input type="text" readonly id="provinsi" name="provinsi_id" class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->province->name}}">
                                                </div>
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                                    <label for="" class="mb-1 font-semibold">Kota / Kabupaten:</label>
                                                    <input type="text" readonly id="kota" class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->regency->name}}">
                                                </div>
                                            </div>

                                            <div class="flex flex-col md:flex-row">
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                                    <label for="" class="mb-1 font-semibold">Kecamatan:</label>
                                                    <input type="text" readonly id="kecamatan" class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->district->name}}">
                                                </div>
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                                    <label for="" class="mb-1 font-semibold">Kelurahan:</label>
                                                    <input type="text" readonly id="kelurahan"  class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->village->name}}">
                                                </div>
                                            </div>

                                            <div class="flex flex-col md:flex-row">
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                                                    <label for="" class="mb-1 font-semibold">Jenjang Studi:</label>
                                                    <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->prodi->jenjang.' '.$m->prodi->nama_prodi}}">
                                                </div>
                                                <div class="flex flex-col items-start w-full mb-4 md:w-1/2">
                                                    <label for="" class="mb-1 font-semibold">Alamat:</label>
                                                    <input type="text" readonly class="bg-gray-100 w-full p-2 border-2 border-gray-300 rounded-sm" value="{{$m->alamat}}">
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        </div>

                                        <a href="{{route('admin.master-mahasiswa.edit', $m->id)}}" class="cursor-pointer px-2 py-1 bg-yellow-600 hover:bg-yellow-700 active:bg-yellow-800 text-white rounded-md">
                                            <i class="bi bi-pencil-square text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.master-mahasiswa.destroy', $m->id) }}" method="POST" class="form-hapus inline-block">
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
