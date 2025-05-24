<x-layout>
    @vite(['resources/js/pages/admin/data-tahun-ajaran.js'])

    <div class="relative dark:text-white">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p class="dark:text-white">Lihat data Tahun Ajaran</p>
        <div x-data="{openImport: false}" class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white dark:bg-gray-800 rounded-sm shadow-xl">
            <div class="mt-2 mb-5 flex gap-4">
                <a href="{{route('admin.master-tahun.create')}}">
                    <button class="flex items-center px-4 py-2.5 text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-sm font-semibold cursor-pointer">
                        <i class="bi bi-plus-square-fill mr-2"></i>
                        <span>Tambah</span>
                    </button>
                </a>

                <button @click="openImport = !openImport" x-cloak class="flex items-center px-4 py-2.5 text-white bg-green-600 hover:bg-green-700 active:bg-green-800 rounded-sm font-semibold cursor-pointer">
                    <i class="bi bi-plus-square-fill mr-2"></i>
                    <span>Import</span>
                </button>

                {{-- tampilan import file --}}
                <div x-show="openImport" x-cloak class="fixed inset-0 z-50 flex justify-center items-center">
                    <div class="absolute inset-0 bg-black opacity-50"></div>

                    <div @click.outside="openImport = false" class="relative z-10 bg-white dark:bg-gray-900 rounded-sm shadow-xl sm:w-[500px] w-[380px] max-w-full p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h1 class="text-gray-600 dark:text-gray-100 text-2xl font-semibold">Import Data Tahun Ajaran</h1>
                            <button @click="openImport = false"><i class="bi bi-x-lg text-2xl mb-4 cursor-pointer text-gray-800 dark:text-white"></i></button>
                        </div>
                        <div class="flex flex-col items-center justify-center w-full h-50 border-4 border-gray-400 dark:border-gray-600 border-dashed mb-4">
                            <i class="bi bi-upload text-gray-600 dark:text-gray-300 text-2xl"></i>
                            <p class="text-gray-600 dark:text-gray-300">Jatuhkan dokumen anda disini atau <a href="" class="text-blue-600">pilih berkas</a></p>
                            <p class="text-gray-400 dark:text-gray-400">Didukung: VSC, XLS, XML, JSON</p>
                        </div>
                        <div class="mb-4 flex justify-center">
                            <button class="cursor-pointer px-8 py-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-sm font-semibold text-white">Impor</button>
                        </div>
                        <div class="flex flex-col items-center justify-center w-full h-20 border-4 border-gray-400 dark:border-gray-600 border-dashed mb-4">
                            <p class="text-gray-600 dark:text-gray-300">Unduh template file impor <a href="" class="text-blue-600">di sini</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto w-[270px] sm:w-150 md:w-full mt-3 pb-3">
                <table id="data-tahun" class="text-sm text-left w-full pt-2">
                    <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100 sticky top-0 z-10">
                        <tr>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">No</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Tahun Ajaran</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Keterangan</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2">Status</th>
                            <th class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tahun as $t )
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 dark:text-white">{{$loop->iteration}}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 dark:text-white">{{$t->tahun_awal. '/' .$t->tahun_akhir}}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 dark:text-white">{{$t->keterangan}}</td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                    @if ($t->status == 1)
                                        <span class="text-green-500 px-3 py-1 rounded-full text-3xl font-bold">
                                            <i class="bi bi-check-circle-fill"></i>
                                        </span>
                                    @elseif ($t->status == 0)
                                        <span class="text-red-500 px-3 py-1 rounded-full text-3xl font-semibold">
                                            <i class="bi bi-x-circle-fill"></i>
                                        </span>
                                    @else
                                        <span class="text-gray-800 dark:text-gray-300 px-3 py-1 rounded-full text-xs font-semibold">Unknown</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 dark:border-gray-600 px-4 py-2 text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{route('admin.master-tahun.edit', $t->id)}}">
                                            <button class="cursor-pointer px-2 py-1 bg-yellow-600 hover:bg-yellow-700 active:bg-yellow-800 text-white rounded-md">
                                                <i class="bi bi-pencil-square text-lg"></i>
                                            </button>
                                        </a>
                                        <form action="{{ route('admin.master-tahun.destroy', $t->id) }}" method="POST" class="form-hapus inline-block">
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
