<x-layout>
    <div class="h-full">
    {{-- @vite(['resources/js/pages/master-admin.js','resources/js/components/image-preview.js']) --}}
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Silahkan tambahkan data Mahasiswa</p>
        <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">

            <form action="{{ isset($mahasiswa) ? route('admin.master-mahasiswa.update', $mahasiswa->id) : route('admin.master-mahasiswa.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @if (isset($mahasiswa))
                    @method('PUT')
                    <input type="hidden" id="edit_id" value="{{ $mahasiswa->id }}">
                @endif

                <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Informasi Umum</h1>
                <hr class="my-2 text-gray-600 mb-6">

<<<<<<< HEAD
                <div class="flex flex-col items-center mb-6 gap-4 md:flex-row">
                    <div  class="w-25 h-25 bg-red-200 rounded-full overflow-hidden cursor-pointer">
                        <img src="/images/profil-kosong.png" class="w-40 h-40 object-cover" alt="">
                    </div>

                    <div class="flex flex-col gap-4 items-center text-center md:items-start md:ml-3">
                        <p class="text-gray-500">Format tersedia hanya file JPEG, JPG, atau PNG</p>
                        <div>
                            <input type="file" name="foto" id="foto" accept="image/*" class="hidden" onchange="loadPreview(event)">
                            <label for="foto" class="px-3 py-2 mr-2 bg-blue-100 hover:bg-blue-200 active:bg-blue-300 text-blue-400 rounded-md cursor-pointer">Unggah Foto</label>
                            <button class="px-3 py-1.5 bg-red-100 hover:bg-red-200 active:bg-red-300 text-red-400  rounded-md cursor-pointer">Hapus Foto</button>
=======
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
>>>>>>> 8934609 (fixed responsive & view  admin)
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
<<<<<<< HEAD
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Nama Lengkap:</label>
                        <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="nama" id="nama" value="{{old('nama', $mahasiswa->nama ?? '')}}" required data-validate="mahasiswa" placeholder="Masukkan nama lengkap">
=======
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Nama Lengkap:</label>
                        <input type="text" class="p-2 border-2 border-gray-400 rounded-sm" name="nama" id="nama" value="{{old('nama', $mahasiswa->nama ?? '')}}" required data-validate="mahasiswa" placeholder="Masukkan nama lengkap">
>>>>>>> 8934609 (fixed responsive & view  admin)
                        <span class="text-red-600 text-sm" id="nama_error">
                            @error('nama'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">NIM:</label>
<<<<<<< HEAD
                        <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="nim" id="nim" value="{{old('nim', $mahasiswa->nim ?? '')}}" required data-validate="mahasiswa" placeholder="Masukkan NIM">
=======
                        <input type="text" class="p-2 border-2 border-gray-400 rounded-sm" name="nim" id="nim" value="{{old('nim', $mahasiswa->nim ?? '')}}" required data-validate="mahasiswa" placeholder="Masukkan NIM">
>>>>>>> 8934609 (fixed responsive & view  admin)
                        <span class="text-red-600 text-sm" id="nim_error">
                            @error('nim'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
<<<<<<< HEAD
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Jenis Kelamin:</lab>
                        <select class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="jenis_kelamin" id="jenis_kelamin" required>
=======
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Jenis Kelamin:</lab>
                        <select class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 rounded-sm" name="jenis_kelamin" id="jenis_kelamin" required>
>>>>>>> 8934609 (fixed responsive & view  admin)
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
<<<<<<< HEAD
                        <select class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="agama" id="agama" required>
=======
                        <select class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-400 rounded-sm" name="agama" id="agama" required>
>>>>>>> 8934609 (fixed responsive & view  admin)
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
<<<<<<< HEAD
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Tempat Lahir:</label>
                        <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="tempat_lahir" id="tempat_lahir" value="{{old('tempat_lahir', $mahasiswa->tempat_lahir ?? '')}}" required data-validate="mahasiswa" placeholder="Masukkan Tempat Lahir">
=======
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Tempat Lahir:</label>
                        <input type="text" class="p-2 border-2 border-gray-400 rounded-sm" name="tempat_lahir" id="tempat_lahir" value="{{old('tempat_lahir', $mahasiswa->tempat_lahir ?? '')}}" required data-validate="mahasiswa" placeholder="Masukkan Tempat Lahir">
>>>>>>> 8934609 (fixed responsive & view  admin)
                        <span class="text-red-600 text-sm" id="tempat_lahir_error">
                            @error('tempat_lahir'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Tanggal Lahir:</label>
<<<<<<< HEAD
                        <input type="date" class="p-2 border-2 border-gray-700 rounded-sm" name="tgl_lahir" id="tgl_lahir" value="{{old('tgl_lahir', $mahasiswa->tgl_lahir ?? '')}}" required data-validate="mahasiswa" placeholder="Masukkan tanggal lahir">
=======
                        <input type="date" class="p-2 border-2 border-gray-400 rounded-sm" name="tgl_lahir" id="tgl_lahir" value="{{old('tgl_lahir', $mahasiswa->tgl_lahir ?? '')}}" required data-validate="mahasiswa" placeholder="Masukkan tanggal lahir">
>>>>>>> 8934609 (fixed responsive & view  admin)
                        <span class="text-red-600 text-sm" id="tgl_lahir_error">
                            @error('tgl_lahir'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
<<<<<<< HEAD
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Email:</label>
                        <input type="email" class="p-2 border-2 border-gray-700 rounded-sm" name="email" id="email" value="{{old('email', $mahasiswa->email ?? '')}}" placeholder="Masukkan Email" required data-validate="mahasiswa">
=======
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Email:</label>
                        <input type="email" class="p-2 border-2 border-gray-400 rounded-sm" name="email" id="email" value="{{old('email', $mahasiswa->email ?? '')}}" placeholder="Masukkan Email" required data-validate="mahasiswa">
>>>>>>> 8934609 (fixed responsive & view  admin)
                        <span class="text-red-600 text-sm" id="email_error">
                            @error('email'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Nomor Telepon:</label>
<<<<<<< HEAD
                        <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="no_telp" id="no_telp" value="{{old('no_telp', $mahasiswa->no_telp ?? '')}}" placeholder="Masukkan no telp" required data-validate="mahasiswa">
=======
                        <input type="text" class="p-2 border-2 border-gray-400 rounded-sm" name="no_telp" id="no_telp" value="{{old('no_telp', $mahasiswa->no_telp ?? '')}}" placeholder="Masukkan no telp" required data-validate="mahasiswa">
>>>>>>> 8934609 (fixed responsive & view  admin)
                        <span class="text-red-600 text-sm" id="no_telp_error">
                            @error('no_telp'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                @if (isset($mahasiswa))
                <div class="flex flex-col md:flex-row">
<<<<<<< HEAD
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">RFID:</label>
                        <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="rfid" id="rfid" value="{{$mahasiswa->rfid ?? ''}}" placeholder="Masukkan Kode Rfid">
=======
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">RFID:</label>
                        <input type="text" class="p-2 border-2 border-gray-400 rounded-sm" name="rfid" id="rfid" value="{{$mahasiswa->rfid ?? ''}}" placeholder="Masukkan Kode Rfid">
>>>>>>> 8934609 (fixed responsive & view  admin)
                        {{-- @error('rfid')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror --}}
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Password:</label>
                        <input type="hidden" name="old_password" id="old_password" value="{{$mahasiswa->password ?? ''}}">
<<<<<<< HEAD
                        <input type="password" class="p-2 border-2 border-gray-700 rounded-sm" name="new_password" id="new_password" placeholder="Masukkan Password Baru">
=======
                        <input type="password" class="p-2 border-2 border-gray-400 rounded-sm" name="new_password" id="new_password" placeholder="Masukkan Password Baru">
>>>>>>> 8934609 (fixed responsive & view  admin)
                        {{-- @error('password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror --}}
                    </div>
                </div>
                @endif

                <h1 class="font-bold text-gray-800 text-2xl my-2 text-center xl:text-left">Alamat</h1>
                <hr class="my-2 text-gray-600 mb-6">

                <div class="flex flex-col md:flex-row">
<<<<<<< HEAD
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Provinsi:</lab>
                        <select name="province_id" id="provinsi" data-selected="{{old('province_id',$mahasiswa->province_id ?? '')}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" required>
=======
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Provinsi:</lab>
                        <select name="province_id" id="provinsi" data-selected="{{$mahasiswa->province_id ?? ''}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 rounded-sm" required>
>>>>>>> 8934609 (fixed responsive & view  admin)
                            <option value="" hidden selected>Pilih Provinsi</option>
                        </select>
                        @error('province_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Kota / Kabupaten:</label>
<<<<<<< HEAD
                        <select name="regency_id" id="kota" data-selected="{{old('regency_id',$mahasiswa->regency_id ?? '')}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" required>
=======
                        <select name="regency_id" id="kota" data-selected="{{$mahasiswa->regency_id ?? ''}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-400 rounded-sm" required>
>>>>>>> 8934609 (fixed responsive & view  admin)
                            <option value="" hidden selected>Pilih Kota / Kabupaten</option>
                        </select>
                        @error('regency_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
<<<<<<< HEAD
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Kecamatan:</lab>
                        <select name="district_id" id="kecamatan" data-selected="{{old('district_id',$mahasiswa->district_id ?? '')}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" required>
=======
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Kecamatan:</lab>
                        <select name="district_id" id="kecamatan" data-selected="{{$mahasiswa->district_id ?? ''}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 rounded-sm" required>
>>>>>>> 8934609 (fixed responsive & view  admin)
                            <option value="" hidden selected>Pilih Kecamatan</option>
                        </select>
                        @error('district_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Kelurahan:</label>
<<<<<<< HEAD
                        <select name="village_id" id="kelurahan" data-selected="{{old('village_id',$mahasiswa->village_id ?? '')}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" required>
=======
                        <select name="village_id" id="kelurahan" data-selected="{{$mahasiswa->village_id ?? ''}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-400 rounded-sm" required>
>>>>>>> 8934609 (fixed responsive & view  admin)
                            <option value="" hidden selected>Pilih Kode pos</option>
                        </select>
                        @error('village_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
<<<<<<< HEAD
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Alamat lengkap:</lab>
                        <textarea class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="alamat" id="alamat" required data-validate="mahasiswa" placeholder="Masukkan Alamat Lengkap">{{old('alamat', $mahasiswa->alamat ?? '')}}</textarea>
=======
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Alamat lengkap:</lab>
                        <textarea class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 rounded-sm" name="alamat" id="alamat" required data-validate="mahasiswa" placeholder="Masukkan Alamat Lengkap">{{old('alamat', $mahasiswa->alamat ?? '')}}</textarea>
>>>>>>> 8934609 (fixed responsive & view  admin)
                        <span class="text-red-600 text-sm" id="alamat_error">
                            @error('alamat'){{ $message }}@enderror
                        </span>
                    </div>
                    <div class="flex flex-col w-full mb-4 md:w-1/2"></div>
                </div>

                <h1 class="font-bold text-gray-800 text-2xl my-2 text-center xl:text-left">Informasi Akademik</h1>
                <hr class="my-2 text-gray-600 mb-6">

                <div class="flex flex-col md:flex-row">
<<<<<<< HEAD
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Jenjang Studi:</lab>
                        <select name="prodi_id" id="prodi_id" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" required>
=======
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Jenjang Studi:</lab>
                        <select name="prodi_id" id="prodi_id" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-400 rounded-sm" required>
>>>>>>> 8934609 (fixed responsive & view  admin)
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
<<<<<<< HEAD
                        <input list="tahun-list" name="tahun_masuk" class="p-2 border-2 border-gray-700 rounded-sm" id="tahun_akhir" value="{{old('tahun_masuk', $mahasiswa->tahun_masuk ?? '')}}" placeholder="Masukkan Tahun Akhir" required data-validate="mahasiswa" >
=======
                        <input list="tahun-list" name="tahun_masuk" class="p-2 border-2 border-gray-400 rounded-sm" id="tahun_akhir" value="{{old('tahun_masuk', $mahasiswa->tahun_masuk ?? '')}}" placeholder="Masukkan Tahun Akhir" required data-validate="mahasiswa" >
>>>>>>> 8934609 (fixed responsive & view  admin)
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
<<<<<<< HEAD
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Semester Tempuh:</label>
                        <select name="semester" id="semester" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" required>
=======
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Semester Tempuh:</label>
                        <select name="semester" id="semester" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-400 rounded-sm" required>
>>>>>>> 8934609 (fixed responsive & view  admin)
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

<<<<<<< HEAD
                <div>
                    <button class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
                    <a href="{{route('admin.master-mahasiswa.index')}}" class="px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</a>
=======
                <div class="w-full flex justify-end mt-7">
                    <a href="{{route('admin.master-mahasiswa.index')}}" class="px-5 py-2 mr-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</a>
                    <button class="px-5 py-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
>>>>>>> 8934609 (fixed responsive & view  admin)
                </div>
            </form>
        </div>
    </div>
</x-layout>
