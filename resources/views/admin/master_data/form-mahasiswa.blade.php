<x-layout>
    <div class="h-full">
    {{-- @vite(['resources/js/pages/master-admin.js','resources/js/components/image-preview.js']) --}}
    <x-slot:title>{{ $title }}</x-slot:title>
    <p class="dark:text-white">Silahkan tambahkan data Mahasiswa</p>
        <div class="w-full h-max max-w-full mt-5 p-8 bg-white dark:bg-gray-800 dark:text-white rounded-sm shadow-xl">

            <form action="{{ isset($mahasiswa) ? route('admin.master-mahasiswa.update', $mahasiswa->id) : route('admin.master-mahasiswa.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @if (isset($mahasiswa))
                    @method('PUT')
                    <input type="hidden" id="edit_id" value="{{ $mahasiswa->id }}">
                @endif

                <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left dark:text-white">Informasi Umum</h1>
                <hr class="my-2 text-gray-600 mb-6">

                <div class="flex flex-col md:flex-row items-center gap-6 mb-6">
                    <!-- Preview Foto -->
                    <div class="w-32 h-32 md:w-40 md:h-40 rounded-full overflow-hidden border-2 border-gray-300 shadow-sm">
                        <img 
                            src="{{ isset($admin) && $admin->foto ? asset('storage/' . $admin->foto) : asset('images/profil-kosong.png') }}" 
                            id="previewImage" 
                            class="w-full h-full object-cover" 
                            alt="Preview Foto"
                        >
                    </div>
                
                    <!-- Info & Tombol -->
                    <div class="flex flex-col gap-3 text-center md:text-left md:ml-4">
                        <p class="text-gray-600 text-sm">Format file yang didukung: <span class="font-medium">JPEG, JPG, PNG</span></p>
                
                        <div class="flex flex-wrap justify-center md:justify-start gap-3">
                            <input type="file" name="foto" id="foto" accept="image/*" class="hidden">
                            
                            <label for="foto" class="px-2 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md shadow cursor-pointer transition">
                                Unggah Foto
                            </label>
                            
                            <button type="button" id="resetFoto" class="px-2 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md shadow transition">
                                Hapus Foto
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Nama Lengkap:</label>
                        <input type="text" class="p-2 border-2 border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" name="nama" id="nama" value="{{old('nama', $mahasiswa->nama ?? '')}}" required data-validate="mahasiswa" placeholder="contoh: Firmansyah dega">
                        <span class="text-red-600 text-sm" id="nama_error">
                            @error('nama'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">NIM:</label>
                        <input type="text" class="p-2 border-2 border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" name="nim" id="nim" value="{{old('nim', $mahasiswa->nim ?? '')}}" required data-validate="mahasiswa" placeholder="contoh: E41231275">
                        <span class="text-red-600 text-sm" id="nim_error">
                            @error('nim'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Jenis Kelamin:</lab>
                        <select class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" name="jenis_kelamin" id="jenis_kelamin" required>
                            <option value="" hidden selected>Pilih jenis kelamin</option>
                            <option value="Laki-laki" {{old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : ''}} >Laki-laki</option>
                            <option value="Perempuan" {{old('jenis_kelamin', $mahasiswa->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : ''}} >Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Agama:</label>
                        <select class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" name="agama" id="agama" required>
                            <option value="" hidden selected>Pilih Agama</option>
                            <option value="Islam" {{old('agama', $mahasiswa->agama ?? '') == 'Islam' ? 'selected' : ''}}>Islam</option>
                            <option value="Hindu" {{old('agama', $mahasiswa->agama ?? '') == 'Hindu' ? 'selected' : ''}}>Hindu</option>
                            <option value="Buddha" {{old('agama', $mahasiswa->agama ?? '') == 'Buddha' ? 'selected' : ''}}>Buddha</option>
                            <option value="Kristen" {{old('agama', $mahasiswa->agama ?? '') == 'Kristen' ? 'selected' : ''}}>Kristen</option>
                            <option value="Konghuchu" {{old('agama', $mahasiswa->agama ?? '') == 'Konghuchu' ? 'selected' : ''}}>Konghuchu</option>
                        </select>
                        @error('agama')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Tempat Lahir:</label>
                        <input type="text" class="p-2 border-2 border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" name="tempat_lahir" id="tempat_lahir" value="{{old('tempat_lahir', $mahasiswa->tempat_lahir ?? '')}}" required data-validate="mahasiswa" placeholder="contoh: Banyuwangi">
                        <span class="text-red-600 text-sm" id="tempat_lahir_error">
                            @error('tempat_lahir'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Tanggal Lahir:</label>
                        <input type="date" class="p-2 border-2 border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" name="tgl_lahir" id="tgl_lahir" value="{{old('tgl_lahir', $mahasiswa->tgl_lahir ?? '')}}" required data-validate="mahasiswa" placeholder="">
                        <span class="text-red-600 text-sm" id="tgl_lahir_error">
                            @error('tgl_lahir'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Email:</label>
                        <input type="email" class="p-2 border-2 border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" name="email" id="email" value="{{old('email', $mahasiswa->email ?? '')}}" placeholder="contoh: mahasiswa@gmail.com" required data-validate="mahasiswa">
                        <span class="text-red-600 text-sm" id="email_error">
                            @error('email'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Nomor Telepon:</label>
                        <input type="text" class="p-2 border-2 border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" name="no_telp" id="no_telp" value="{{old('no_telp', $mahasiswa->no_telp ?? '')}}" placeholder="Masukkan no telp" required data-validate="mahasiswa">
                        <span class="text-red-600 text-sm" id="no_telp_error">
                            @error('no_telp'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                @if (isset($mahasiswa))
                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">RFID:</label>
                        <input type="text" class="p-2 border-2 border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" name="rfid" id="rfid" value="{{$mahasiswa->rfid ?? ''}}" placeholder="Masukkan Kode Rfid">
                        {{-- @error('rfid')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror --}}
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Password:</label>
                        <input type="hidden" name="old_password" id="old_password" value="{{$mahasiswa->password ?? ''}}">
                        <input type="password" class="p-2 border-2 border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" name="new_password" id="new_password" placeholder="Masukkan Password Baru">
                        {{-- @error('password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror --}}
                    </div>
                </div>
                @endif

                <h1 class="font-bold text-gray-800 text-2xl my-2 text-center xl:text-left dark:text-white">Alamat</h1>
                <hr class="my-2 text-gray-600 mb-6">

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Provinsi:</lab>
                        <select name="province_id" id="provinsi" data-selected="{{$mahasiswa->province_id ?? ''}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" required>
                            <option value="" hidden selected>Pilih Provinsi</option>
                        </select>
                        @error('province_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Kota / Kabupaten:</label>
                        <select name="regency_id" id="kota" data-selected="{{$mahasiswa->regency_id ?? ''}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" required>
                            <option value="" hidden selected>Pilih Kota / Kabupaten</option>
                        </select>
                        @error('regency_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Kecamatan:</lab>
                        <select name="district_id" id="kecamatan" data-selected="{{$mahasiswa->district_id ?? ''}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" required>
                            <option value="" hidden selected>Pilih Kecamatan</option>
                        </select>
                        @error('district_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Kelurahan:</label>
                        <select name="village_id" id="kelurahan" data-selected="{{$mahasiswa->village_id ?? ''}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" required>
                            <option value="" hidden selected>Pilih Kode pos</option>
                        </select>
                        @error('village_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Alamat lengkap:</lab>
                        <textarea class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" name="alamat" id="alamat" required data-validate="mahasiswa" placeholder="Masukkan Alamat Lengkap">{{old('alamat', $mahasiswa->alamat ?? '')}}</textarea>
                        <span class="text-red-600 text-sm" id="alamat_error">
                            @error('alamat'){{ $message }}@enderror
                        </span>
                    </div>
                    <div class="flex flex-col w-full mb-4 md:w-1/2"></div>
                </div>

                <h1 class="font-bold text-gray-800 text-2xl my-2 text-center xl:text-left dark:text-white">Informasi Akademik</h1>
                <hr class="my-2 text-gray-600 mb-6">

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Jenjang Studi:</lab>
                        <select name="prodi_id" id="prodi_id" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" required>
                            <option value="" hidden selected>Pilih jenjang studi</option>
                        @foreach ($prodi as $p)
                            <option value="{{ $p->id }}" @if (old('prodi_id', $mahasiswa->prodi_id ?? '') == $p->id) selected @endif>
                                {{ $p->jenjang.' '.$p->nama_prodi }}
                            </option>
                        @endforeach
                        </select>
                        @error('prodi_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Tahun Masuk:</label>
                        <input list="tahun-list" name="tahun_masuk" class="p-2 border-2 border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" id="tahun_akhir" value="{{old('tahun_masuk', $mahasiswa->tahun_masuk ?? '')}}" placeholder="Masukkan Tahun Akhir" required data-validate="mahasiswa" >
                        <datalist id="tahun-list">
                            @for($i = date('Y'); $i >= 2000; $i--)
                                <option value="{{ $i }}">
                            @endfor
                        </datalist>
                        <span class="text-red-600 text-sm" id="tahun_masuk_error">
                            @error('tahun_masuk'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Semester Tempuh:</label>
                        <select name="semester" id="semester" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-400 dark:border-gray-600 bg-white dark:bg-gray-700 text-black dark:text-white rounded-sm" required>
                            <option value="" hidden selected>Pilih Semester tempuh</option>
                        @for($i = 1; $i<=14; $i++)
                            <option value="{{ $i }}" @if (old('semester', $mahasiswa->semester ?? '') == $i) selected @endif>
                            Semester {{$i}}
                        @endfor
                        </select>
                        @error('semester')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex flex-col w-full mb-4 md:w-1/2"></div>
                </div>

                <div class="w-full flex justify-end mt-7">
                    <a href="{{route('admin.master-mahasiswa.index')}}" class="px-5 py-2 mr-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</a>
                    <button class="px-5 py-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
