<x-layout>
    @vite(['resources/js/pages/admin/data-prodi.js'])

    <div class="relative">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Lihat Data Program Studi</p>

    @if(session('success'))
        <div class="p-4 mb-4 text-green-800 rounded-lg bg-green-100" role="alert">
            {{ session('success') }}
        </div>
    @endif

        <div x-data="{openImport: false}" class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white rounded-sm shadow-xl">
            <div class="mt-2 mb-5 flex gap-4">
                <a href="{{route('admin.master-prodi.create')}}">
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
                            <h1 class="text-gray-600 text-2xl font-semibold">Import Data Program Studi</h1>
                            <button @click="openImport = false"><i class="bi bi-x-lg text-2xl mb-4 cursor-pointer"></i></button>
                        </div>
                        <div class="flex flex-col items-center justify-center w-full h-50 border-4 border-gray-400 border-dashed mb-4">
                            <i class="bi bi-upload text-gray-600 text-2xl"></i>
                            <p class="text-gray-600">Jatuhkan dokumen anda disini atau <label for="importFile" class="text-blue-600 cursor-pointer">pilih berkas</label></p>
                            <input id="importFile" type="file" class="hidden" />
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
                            <th class="border border-gray-300 px-4">Kode Prodi</th>
                            <th class="border border-gray-300 px-4">Jenjang</th>
                            <th class="border border-gray-300 px-4">Nama Program Studi</th>
                            <th class="border border-gray-300 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach ($prodi as $p )
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4">{{$loop->iteration}}</td>
                                <td class="border border-gray-300 px-4">{{$p->kode_prodi}}</td>
                                <td class="border border-gray-300 px-4">{{$p->jenjang}}</td>
                                <td class="border border-gray-300 px-4">{{$p->nama_prodi}}</td>
                                <td class="border border-gray-300 px-4 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{route('admin.master-prodi.edit', $p->id)}}">
                                            <button class="cursor-pointer px-2 py-1 bg-yellow-600 hover:bg-yellow-700 active:bg-yellow-800 text-white rounded-md">
                                                <i class="bi bi-pencil-square text-lg"></i>
                                            </button>
                                        </a>

                                        <form action="{{ route('admin.master-prodi.destroy', $p->id) }}" method="POST" class="form-hapus inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-2 py-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-md">
                                                <i class="bi bi-trash text-lg"></i>
                                            </button>
                                        </form>

                                    {{-- <form action="{{ route('admin.master-prodi.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Yakin mau hapus data ini?');" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-md">
                                            <i class="bi bi-trash text-lg"></i>
                                        </button>
                                    </form> --}}


                                    {{-- <form id="form-delete-{{ $p->id }}" action="{{ route('admin.master-prodi.destroy', $p->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete({{ $p->id }})" class="px-2 py-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-md">
                                            <i class="bi bi-trash text-lg"></i>
                                        </button>
                                    </form> --}}
                                    {{-- <a href="{{route('admin.master-prodi.destroy', $p->id)}}">
                                        <button class="px-2 py-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-md">
                                            <i class="bi bi-trash text-lg"></i>
                                        </button>
                                    </a> --}}
                                    {{-- <button class="px-2 py-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-md">
                                        <i class="bi bi-trash text-lg"></i>
                                    </button> --}}
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
