<x-layout>
    <div class="h-full">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Silahkan tambahkan data Tahun Ajaran</p>
        <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">

            <form action="{{ isset($tahun) ? route('admin.master-tahun.update', $tahun->id) : route('admin.master-tahun.store') }}" method="POST">
                @csrf
                @if (isset($tahun))
                    @method('PUT')
                @endif

                <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Informasi Umum</h1>
                <hr class="my-2 text-gray-600 mb-6">

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Tahun Mulai:</label>
                        <input list="tahun-list" name="tahun_awal" class="p-2 border-2 border-gray-400 rounded-sm" id="tahun_awal" placeholder="Masukkan Tahun Awal" value="{{old('tahun_awal', $tahun->tahun_awal ?? '')}}" required data-validate="tahun">
                        <datalist id="tahun-list">
                            @for($i = date('Y'); $i >= 2000; $i--)
                                <option value="{{ $i }}">
                            @endfor
                        </datalist>
                        <span class="text-red-600 text-sm" id="tahun_awal_error">
                            @error('tahun_awal'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Tahun Selesai:</label>
                        <input list="tahun-list" name="tahun_akhir" class="p-2 border-2 border-gray-400 rounded-sm" id="tahun_akhir" value="{{old('tahun_akhir', $tahun->tahun_akhir ?? '')}}" required data-validate="tahun" placeholder="Masukkan Tahun Akhir">
                        <datalist id="tahun-list">
                            @for($i = date('Y'); $i >= 2000; $i--)
                                <option value="{{ $i }}">
                            @endfor
                        </datalist>
                        <span class="text-red-600 text-sm" id="tahun_akhir_error">
                            @error('tahun_akhir'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Keterangan:</lab>
                        <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 rounded-sm" name="keterangan" id="keterangan" required>
                            <option value="" hidden selected>Pilih Keterangan</option>
                            <option value="Ganjil" {{ old('keterangan', $tahun->keterangan ?? '') == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                            <option value="Genap" {{ old('keterangan', $tahun->keterangan ?? '') == 'Genap' ? 'selected' : '' }}>Genap</option>
                        </select>
                        @error('keterangan')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8"></div>

                    @if (isset($tahun))
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                    <label for="" class="mb-1 font-semibold">Tahun Ajaran Aktif:</lab>
                        <div class="flex items-center mt-2">
                            <input id="aktif" name="status" type="radio" class="mr-2 w-5 h-5" value="1" {{ old('status', $tahun->status ?? '') == 1 ? 'checked' : '' }}>
                            <label for="aktif" class="mr-9 text-gray-600">Aktif</label>
                            <input id="tidakAktif" name="status" type="radio" class="mr-2 w-5 h-5" value="0" {{ old('status', $tahun->status ?? '') == 0 ? 'checked' : '' }}>
                            <label for="tidakAktif" class="text-gray-600">Tidak Aktif</label>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="w-full flex justify-end mt-7">
                    <a href="{{ route('admin.master-tahun.index') }}" class="inline-block px-5 py-2 mr-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">
                        Batal
                    </a>
                    <button class="px-5 py-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
