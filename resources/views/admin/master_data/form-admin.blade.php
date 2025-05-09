<x-layout>
    <div class="h-full">
    {{-- @vite(['resources/js/pages/master-admin.js','resources/js/components/image-preview.js','resources/js/components/form-validasi.js']) --}}
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Silahkan tambahkan data Admin</p>
        <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">

            <form id="form-admin" action="{{ isset($admin) ? route('admin.master-admin.update', $admin->id) : route('admin.master-admin.store') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @if (isset($admin))
                    @method('PUT')
                    <input type="hidden" id="edit_id" value="{{ $admin->id }}">
                @endif

                @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        {{-- @php
            $defaultFoto = asset('images/profil-kosong.png');
            $previewFoto = isset($admin) && $admin->foto ? asset('storage/' . $admin->foto) : $defaultFoto;
        @endphp --}}


                <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Informasi Umum</h1>
                <hr class="my-2 text-gray-600 mb-6">

                <div class="flex flex-col items-center mb-6 gap-4 md:flex-row">
                    <div  class="w-25 h-25 bg-red-200 rounded-full overflow-hidden cursor-pointer">
                        {{-- <img src="{{ $previewFoto }}" id="previewImage" class="w-40 h-40 object-cover" alt="Preview Foto"> --}}

                        <img src="{{ isset($admin) && $admin->foto ? asset('storage/' . $admin->foto) : asset('images/profil-kosong.png') }}" id="previewImage" class="w-40 h-40 object-cover" alt="Preview Foto">
                    </div>

                    <div class="flex flex-col gap-4 items-center text-center md:items-start md:ml-3">
                        <p class="text-gray-500">Format tersedia hanya file JPEG, JPG, atau PNG</p>
                        <div>
                            <input type="file" name="foto" id="foto" accept="image/*" class="hidden">
                            <label for="foto" class="px-3 py-2 mr-2 bg-blue-100 hover:bg-blue-200 active:bg-blue-300 text-blue-400 rounded-md cursor-pointer">Unggah Foto</label>
                            <button type="button" id="resetFoto" class="px-3 py-1.5 bg-red-100 hover:bg-red-200 active:bg-red-300 text-red-400  rounded-md cursor-pointer">Hapus Foto</button>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Nama Lengkap:</label>
                        <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="nama" id="nama" value="{{old('nama', $admin->nama ?? '')}}" required data-validate="admin" placeholder="Masukkan nama lengkap">
                        <span class="text-red-600 text-sm" id="nama_error">
                            @error('nama'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Nomor Telepon:</label>
                        <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="no_telp" id="no_telp" value="{{old('no_telp', $admin->no_telp ?? '')}}" data-validate="admin" required placeholder="Masukkan no telp">
                        <span class="text-red-600 text-sm" id="no_telp_error">
                            @error('no_telp'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Jenis Kelamin:</lab>
                        <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="jenis_kelamin" id="jenis_kelamin" required>
                            <option value="" hidden selected>Pilih jenis kelamin</option>
                            <option value="Laki-laki" {{ old('jenis_kelamin', $admin->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin', $admin->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Agama:</label>
                        <select type="text" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="agama" id="agama" required>
                            <option value="" hidden selected>Pilih Agama</option>
                            <option value="Islam" {{old('agama', $admin->agama ?? '') == 'Islam' ? 'selected' : ''}}>Islam</option>
                            <option value="Hindu" {{old('agama', $admin->agama ?? '') == 'Hindu' ? 'selected' : ''}}>Hindu</option>
                            <option value="Buddha" {{old('agama', $admin->agama ?? '') == 'Buddha' ? 'selected' : ''}}>Buddha</option>
                            <option value="Kristen" {{old('agama', $admin->agama ?? '') == 'Kristen' ? 'selected' : ''}}>Kristen</option>
                            <option value="Konghuchu" {{old('agama', $admin->agama ?? '') == 'Konghuchu' ? 'selected' : ''}}>Konghuchu</option>
                        </select>
                        @error('agama')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Tempat Lahir:</label>
                        <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="tempat_lahir" id="tempat_lahir" value="{{old('tempat_lahir', $admin->tempat_lahir ?? '')}}" required data-validate="admin" placeholder="Masukkan Tempat Lahir">
                        <span class="text-red-600 text-sm" id="tempat_lahir_error">
                            @error('tempat_lahir'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Tanggal Lahir:</label>
                        <input type="date" class="p-2 border-2 border-gray-700 rounded-sm" name="tgl_lahir" id="tgl_lahir" value="{{old('tgl_lahir', $admin->tgl_lahir ?? '')}}" required data-validate="admin" placeholder="Masukkan tanggal lahir">
                        <span class="text-red-600 text-sm" id="tgl_lahir_error">
                            @error('tgl_lahir'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Email:</label>
                        <input type="email" class="p-2 border-2 border-gray-700 rounded-sm" name="email" id="email" value="{{old('email', $admin->email ?? '')}}" required data-validate="admin" placeholder="Masukkan Email">
                        <span class="text-red-600 text-sm" id="email_error">
                            @error('email'){{ $message }}@enderror
                        </span>
                    </div>

                    @if (isset($admin))
                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Password Baru:</label>
                        <input type="hidden" class="p-2 border-2 border-gray-700 rounded-sm" name="old_password" id="old_password" value="{{($admin->password ?? '')}}">
                        <input type="password" class="p-2 border-2 border-gray-700 rounded-sm" name="new_password" id="new_password" placeholder="Masukkan Password Baru">
                    </div>
                    @endif
                </div>

                <h1 class="font-bold text-gray-800 text-2xl my-2 text-center xl:text-left">Alamat</h1>
                <hr class="my-2 text-gray-600 mb-6">

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Provinsi:</lab>
                        <select id="provinsi" name="province_id" data-selected="{{$admin->province_id ?? ''}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" required>
                            <option value="" hidden selected>Pilih Provinsi</option>
                        </select>
                        @error('province_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Kota / Kabupaten:</label>
                        <select name="regency_id" id="kota" data-selected="{{$admin->regency_id ?? ''}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" required>
                            <option value="" hidden selected>Pilih Kota / Kabupaten</option>
                        </select>
                        @error('regency_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Kelurahan:</lab>
                        <select id="kecamatan" name="district_id" data-selected="{{$admin->district_id ?? ''}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" required>
                            <option value="" hidden selected>Pilih Kelurahan</option>
                        </select>
                        @error('district_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Kelurahan:</label>
                        <select id="kelurahan" name="village_id" data-selected="{{$admin->village_id ?? ''}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" required>
                            <option value="" hidden selected>Pilih Kode pos</option>
                        </select>
                        @error('village_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Alamat lengkap:</lab>
                        <textarea type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="alamat" id="alamat" required data-validate="admin" placeholder="Masukkan Alamat Lengkap">{{$admin->alamat ?? ''}}</textarea>
                        <span class="text-red-600 text-sm" id="alamat_error">
                            @error('alamat'){{ $message }}@enderror
                        </span>
                    </div>
                    <div class="flex flex-col w-full mb-4 md:w-1/2"></div>
                </div>
                <div>
                    <button type="submit" class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
                        <a href="{{route('admin.master-admin.index')}}" class="px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</a>
                </div>
            </form>
        </div>
    </div>
    {{-- <script type="module">
            import { setupRealtimeValidation } from '/resources/js/components/form-validasi.js';
            setupRealtimeValidation(); // default selector: [data-validate="admin"]

    </script> --}}

</x-layout>
