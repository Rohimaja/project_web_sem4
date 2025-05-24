<x-layout>
    @vite(['resources/js/pages/admin/data-matkul.js'])

    <div class="relative dark:text-white">
        <x-slot:title>{{ $title }}</x-slot:title>
        <p class="text-gray-700 dark:text-gray-300">Lihat data Mata Kuliah</p>

        <div x-data="{openImport: false}" class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white dark:bg-gray-800 rounded-sm shadow-xl">

            <div class="flex flex-col xl:flex-row">
                <!-- Program Studi -->
                <div class="flex flex-col w-full mb-4 xl:w-1/3 mr-0 md:mr-4">
                    <label class="mb-1 font-semibold text-gray-800 dark:text-gray-200">Pilih Program Studi:</label>
                    <select id="prodi" name="prodi" class="dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        <option value="" hidden selected>Pilih Program Studi</option>
                        @foreach ($prodi as $p)
                            <option value="{{ $p->id }}">{{ $p->jenjang .' '. $p->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Semester -->
                <div class="flex flex-col w-full mb-4 xl:w-1/3 mr-0 md:mr-4">
                    <label class="mb-1 font-semibold text-gray-800 dark:text-gray-200">Pilih Semester:</label>
                    <select id="semester" name="semester" class="dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        <option value="" hidden selected>Pilih Semester</option>
                        @for ($i = 1; $i <= 14; $i++)
                            <option value="{{$i}}"> Semester {{$i}} </option>
                        @endfor
                    </select>
                </div>

                <!-- Tahun Ajaran -->
                <div class="flex flex-col w-full mb-4 xl:w-1/3">
                    <label class="mb-1 font-semibold text-gray-800 dark:text-gray-200">Pilih Mata Kuliah:</label>
                    <select id="tahun_ajaran" name="tahun_ajaran" class="dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        <option value="" hidden selected>Pilih Tahun Ajaran</option>
                        @foreach ($tahun as $t)
                            <option value="{{ $t->id }}">
                                {{ $t->tahun_awal .'/'. $t->tahun_akhir .' '. $t->keterangan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>    

        <div class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white dark:bg-gray-800 rounded-sm shadow-xl">
            <div class="mt-2 mb-5 flex gap-4">
                <a href="{{route('admin.master-matkul.create')}}">
                    <button class="flex items-center px-4 py-2.5 text-white bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-sm font-semibold cursor-pointer">
                        <i class="bi bi-plus-square-fill mr-2"></i>
                        <span>Tambah</span>
                    </button>
                </a>

                <button @click="openImport = !openImport" class="flex items-center px-4 py-2.5 text-white bg-green-600 hover:bg-green-700 active:bg-green-800 rounded-sm font-semibold cursor-pointer">
                    <i class="bi bi-plus-square-fill mr-2"></i>
                    <span>Import</span>
                </button>

                <!-- Modal Import -->
                <div x-show="openImport" x-cloak class="fixed inset-0 z-50 flex justify-center items-center">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div @click.outside="openImport = false" class="relative z-10 bg-white dark:bg-gray-900 dark:text-white rounded-sm shadow-xl sm:w-[500px] w-[380px] max-w-full p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h1 class="text-gray-600 dark:text-gray-200 text-2xl font-semibold">Import Data Mata Kuliah</h1>
                            <button @click="openImport = false">
                                <i class="bi bi-x-lg text-2xl mb-4 cursor-pointer dark:text-white"></i>
                            </button>
                        </div>
                        <div class="flex flex-col items-center justify-center w-full h-50 border-4 border-gray-400 dark:border-gray-600 border-dashed mb-4">
                            <i class="bi bi-upload text-gray-600 dark:text-gray-300 text-2xl"></i>
                            <p class="text-gray-600 dark:text-gray-300">Jatuhkan dokumen anda disini atau <a href="#" class="text-blue-600">pilih berkas</a></p>
                            <p class="text-gray-400">Didukung: VSC, XLS, XML, JSON</p>
                        </div>
                        <div class="mb-4 flex justify-center">
                            <button class="cursor-pointer px-8 py-2 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 rounded-sm font-semibold text-white">Impor</button>
                        </div>
                        <div class="flex flex-col items-center justify-center w-full h-20 border-4 border-gray-400 dark:border-gray-600 border-dashed mb-4">
                            <p class="text-gray-600 dark:text-gray-300">Unduh template file impor <a href="#" class="text-blue-600">di sini</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto w-[270px] sm:w-150 md:w-full mt-3 pb-3">
                <table id="data-matkul" class="text-sm text-left w-full pt-2 display nowrap dark:text-white" width="100%">
                    <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 sticky top-0 z-10">
                        <tr>
                            <th class=" dark:border-gray-600 px-4 py-2">No</th>
                            <th class=" dark:border-gray-600 px-4 py-2">Nama Mata Kuliah</th>
                            <th class=" dark:border-gray-600 px-4 py-2">Program Studi</th>
                            <th class=" dark:border-gray-600 px-4 py-2">SKS</th>
                            <th class=" dark:border-gray-600 px-4 py-2">Tahun Ajaran</th>
                            <th class=" dark:border-gray-600 px-4 py-2">Semester</th>
                            <th class=" dark:border-gray-600 px-4 py-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($matkul as $m )
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class=" dark:border-gray-600 px-4 py-2">{{$loop->iteration}}</td>
                                <td class=" dark:border-gray-600 px-4 py-2">{{$m->nama_matkul}}</td>
                                <td class=" dark:border-gray-600 px-4 py-2">{{$m->prodi->jenjang . ' ' .$m->prodi->nama_prodi ?? ''}}</td>
                                <td class=" dark:border-gray-600 px-4 py-2">{{$m->durasi_matkul}}</td>
                                <td class=" dark:border-gray-600 px-4 py-2">{{$m->tahunAjaran->tahun_awal .'/'. $m->tahunAjaran->tahun_akhir .' '.$m->tahunAjaran->keterangan ?? ''}}</td>
                                <td class=" dark:border-gray-600 px-4 py-2">{{$m->semester}}</td>
                                <td class=" dark:border-gray-600 px-4 py-2 text-center">
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
