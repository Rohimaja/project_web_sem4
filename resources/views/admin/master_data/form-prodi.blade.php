<x-layout>
    <div class="h-full">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Silahkan tambahkan data Program Studi</p>
        <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">

            <form action="{{ isset($prodi) ? route('admin.master-prodi.update', $prodi->id) : route('admin.master-prodi.store') }}" method="POST">
            @csrf
            @if (isset($prodi))
                @method('PUT')
            @endif

                <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Informasi Umum</h1>
                <hr class="my-2 text-gray-600 mb-6">

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Kode Program Studi:</label>
                        <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan nama lengkap" name="kode_prodi" id="kode_prodi" value="{{old('kode_prodi', $prodi->kode_prodi ?? '')}}">
                        @error('kode_prodi')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Jenjang:</lab>
                        <select type="text" class="p-2 mt-1 w-full flex border-2 font-normal border-gray-700 rounded-sm" name="jenjang" id="jenjang">
                        <option value="" hidden selected>Pilih Jenjang</option>
                        <option value="S1" {{ old('jenjang', $prodi->jenjang ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ old('jenjang', $prodi->jenjang ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="D3" {{ old('jenjang', $prodi->jenjang ?? '') == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="D4" {{ old('jenjang', $prodi->jenjang ?? '') == 'D4' ? 'selected' : '' }}>D4</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Nama Program Studi:</lab>
                        <input type="text" class="p-2 mt-1 w-full flex border-2 font-normal border-gray-700 rounded-sm" name="nama_prodi" id="nama_prodi" value="{{old('nama_prodi', $prodi->nama_prodi ?? '')}}" placeholder="Masukkan Alamat Lengkap">
                        @error('nama_prodi')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full mb-4 md:w-1/2"></div>
                </div>
                <div>
                    <button class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
                    <a href="{{ route('admin.master-prodi.index') }}" class="inline-block px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
