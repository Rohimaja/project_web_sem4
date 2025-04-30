<x-layout>
  <div class="h-full">
    @vite(['resources/js/pages/master-admin.js','resources/js/components/image-preview.js'])

    {{-- <h1 class="font-bold text-gray-800 text-2xl">{{ $title }}</h1> --}}
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Silahkan tambahkan data Admin</p>
    <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">

        <form action="{{ isset($admin) ? route('admin.master-admin.update', $admin->id) : route('admin.master-admin.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @if (isset($admin))
                @method('PUT')
            @endif

        <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Informasi Umum</h1>
        <hr class="my-2 text-gray-600 mb-6">

        <div class="flex flex-col items-center mb-6 gap-4 md:flex-row">
          <div  class="w-25 h-25 bg-red-200 rounded-full overflow-hidden cursor-pointer">
            <img src="{{ asset('storage/' . ($admin->foto ?? 'image/profil-kosong.png')) }}" id="previewImage" class="w-40 h-40 object-cover" alt="Preview Foto">
          </div>
          <div class="flex flex-col gap-4 items-center text-center md:items-start md:ml-3">
            <p class="text-gray-500">Format tersedia hanya file JPEG, JPG, atau PNG</p>
            <input type="file" name="foto" id="foto" accept="image/*" class="hidden">
            <div>
              <label for="foto" class="px-3 py-2 mr-2 bg-blue-100 hover:bg-blue-200 active:bg-blue-300 text-blue-400 rounded-md cursor-pointer">Unggah Foto</label>
              <button type="button" id="resetFoto" class="px-3 py-1.5 bg-red-100 hover:bg-red-200 active:bg-red-300 text-red-400  rounded-md cursor-pointer">Hapus Foto</button>
            </div>
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Nama Lengkap:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="nama" id="nama" value="{{old('nama', $admin->nama ?? '')}}" placeholder="Masukkan nama lengkap">
          </div>

          @if (isset($admin))
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Password Baru:</label>
            <input type="hidden" class="p-2 border-2 border-gray-700 rounded-sm" name="old_password" id="old_password" value="{{($admin->password ?? '')}}">
            <input type="password" class="p-2 border-2 border-gray-700 rounded-sm" name="new_password" id="new_password" placeholder="Masukkan Password Baru">
          </div>
          @endif

        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Jenis Kelamin:</lab>
            <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="jenis_kelamin" id="jenis_kelamin">
              <option value="" hidden selected>Pilih jenis kelamin</option>
              <option value="Laki-laki" {{ old('jenis_kelamin', $admin->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{ old('jenis_kelamin', $admin->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
          </div>

          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Agama:</label>
            <select type="text" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="agama" id="agama" placeholder="Masukkan Nip">
              <option value="" hidden selected>Pilih Agama</option>
              <option value="Islam" {{old('agama', $admin->agama ?? '') == 'Islam' ? 'selected' : ''}}>Islam</option>
              <option value="Hindu" {{old('agama', $admin->agama ?? '') == 'Hindu' ? 'selected' : ''}}>Hindu</option>
              <option value="Buddha" {{old('agama', $admin->agama ?? '') == 'Buddha' ? 'selected' : ''}}>Buddha</option>
              <option value="Kristen" {{old('agama', $admin->agama ?? '') == 'Kristen' ? 'selected' : ''}}>Kristen</option>
              <option value="Konghuchu" {{old('agama', $admin->agama ?? '') == 'Konghuchu' ? 'selected' : ''}}>Konghuchu</option>
            </select>
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Tempat Lahir:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="tempat_lahir" id="tempat_lahir" value="{{old('tempat_lahir', $admin->tempat_lahir ?? '')}}" placeholder="Masukkan Tempat Lahir">
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Tanggal Lahir:</label>
            <input type="date" class="p-2 border-2 border-gray-700 rounded-sm" name="tgl_lahir" id="tgl_lahir" value="{{old('tgl_lahir', $admin->tgl_lahir ?? '')}}" placeholder="Masukkan tanggal lahir">
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Email:</label>
            <input type="email" class="p-2 border-2 border-gray-700 rounded-sm" name="email" id="email" value="{{old('email', $admin->email ?? '')}}" placeholder="Masukkan Email">
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Nomor Telepon:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="no_telp" id="no_telp" value="{{old('no_telp', $admin->no_telp ?? '')}}" placeholder="Masukkan no telp">
          </div>
        </div>
{{--
        <div class="flex flex-col md:flex-row">
            <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
              <label for="" class="mb-1 font-semibold">Alamat lengkap:</lab>
              <textarea type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="alamat" id="alamat" placeholder="Masukkan Alamat Lengkap">{{old('alamat', $admin->alamat ?? '')}}</textarea>
            </div>
          </div> --}}

        <h1 class="font-bold text-gray-800 text-2xl my-2 text-center xl:text-left">Alamat</h1>
        <hr class="my-2 text-gray-600 mb-6">

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Provinsi:</lab>
            <select id="provinsi" name="provinsi_id" data-selected="{{$admin->provinsi_id ?? ''}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
              <option value="" hidden selected>Pilih Provinsi</option>
            </select>
          </div>

          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Kota / Kabupaten:</label>
            <select name="kota_id" id="kota" data-selected="{{$admin->kota_id ?? ''}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Nip">
              <option value="" hidden selected>Pilih Kota / Kabupaten</option>
            </select>
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Kelurahan:</lab>
            <select id="kecamatan" name="kecamatan_id" data-selected="{{$admin->kecamatan_id ?? ''}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
              <option value="" hidden selected>Pilih Kelurahan</option>
            </select>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Kelurahan:</label>
            <select id="kelurahan" name="kelurahan_id" data-selected="{{$admin->kelurahan_id ?? ''}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Nip">
              <option value="" hidden selected>Pilih Kode pos</option>
            </select>
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Alamat lengkap:</lab>
            <textarea type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="alamat" id="alamat" placeholder="Masukkan Alamat Lengkap">{{$admin->alamat ?? ''}}</textarea>
            {{-- <input type="hidden" name="alamat" id="alamat_final"> --}}
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">

          </div>
        </div>
        <div>
            <button type="submit" class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
                <a href="{{route('admin.master-admin.index')}}" class="px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</a>
        </div>
    </form>
    </div>
  </div>
</x-layout>
