<x-layout>
  <div class="h-full">
    @vite(['resources/js/pages/master-admin.js'])
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Silahkan tambahkan data Admin</p>
    <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">

        <form action="{{ isset($dosen) ? route('admin.master-dosen.update', $dosen->id) : route('admin.master-dosen.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            @if (isset($dosen))
                @method('PUT')
            @endif

        <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Informasi Umum</h1>
        <hr class="my-2 text-gray-600 mb-6">

        <div class="flex flex-col items-center mb-6 gap-4 md:flex-row">
          <div  class="w-25 h-25 bg-red-200 rounded-full overflow-hidden cursor-pointer">
            <img src="/images/profil-kosong.png" class="w-40 h-40 object-cover" alt="">
          </div>
          <div class="flex flex-col gap-4 items-center text-center md:items-start md:ml-3">
            <p class="text-gray-500">Format tersedia hanya file JPEG, JPG, atau PNG</p>
            <input type="file" name="foto" id="foto" accept="image/*" class="hidden" onchange="loadPreview(event)">
            <div>
              <label for="foto" class="px-3 py-2 mr-2 bg-blue-100 hover:bg-blue-200 active:bg-blue-300 text-blue-400 rounded-md cursor-pointer">Unggah Foto</label>
              <button class="px-3 py-1.5 bg-red-100 hover:bg-red-200 active:bg-red-300 text-red-400  rounded-md cursor-pointer">Hapus Foto</button>
            </div>
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Nama Lengkap:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="nama" id="nama" value="{{old('nama', $dosen->nama ?? '')}}" placeholder="Masukkan nama lengkap">
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">NIP:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="nip" id="nip" value="{{old('nip', $dosen->nip ?? '')}}" placeholder="Masukkan NIP">
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Jenis Kelamin:</lab>
            <select class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="jenis_kelamin" id="jenis_kelamin">
              <option value="" hidden selected>Pilih jenis kelamin</option>
              <option value="Laki-laki" {{old('jenis_kelamin', $dosen->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Perempuan" {{old('jenis_kelamin', $dosen->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : ''}}>Perempuan</option>
            </select>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Agama:</label>
            <select class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="agama" id="agama" placeholder="Pilih Agama">
              <option value="" hidden selected>Pilih Agama</option>
              <option value="Islam" {{old('agama', $dosen->agama ?? '') == 'Islam' ? 'selected' : ''}}>Islam</option>
              <option value="Hindu" {{old('agama', $dosen->agama ?? '') == 'Hindu' ? 'selected' : ''}}>Hindu</option>
              <option value="Buddha" {{old('agama', $dosen->agama ?? '') == 'Buddha' ? 'selected' : ''}}>Buddha</option>
              <option value="Kristen" {{old('agama', $dosen->agama ?? '') == 'Kristen' ? 'selected' : ''}}>Kristen</option>
              <option value="Konghuchu" {{old('agama', $dosen->agama ?? '') == 'Konghuchu' ? 'selected' : ''}}>Konghuchu</option>
            </select>
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Tempat Lahir:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="tempat_lahir" id="tempat_lahir" value="{{old('tempat_lahir', $dosen->tempat_lahir ?? '')}}" placeholder="Masukkan Tempat Lahir">
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Tanggal Lahir:</label>
            <input type="date" class="p-2 border-2 border-gray-700 rounded-sm" name="tgl_lahir" id="tgl_lahir" value="{{old('tgl_lahir', $dosen->tgl_lahir ?? '')}}" placeholder="Masukkan tanggal lahir">
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Email:</label>
            <input type="email" class="p-2 border-2 border-gray-700 rounded-sm" name="email" id="email" value="{{old('email', $dosen->email ?? '')}}" placeholder="Masukkan Email">
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Nomor Telepon:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="no_telp" id="no_telp" value="{{old('no_telp', $dosen->no_telp ?? '')}}" placeholder="Masukkan no telp">
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
            <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                <label for="" class="mb-1 font-semibold">Pilih Prodi:</label>
                <select class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="prodi_id" id="prodi_id" placeholder="Pilih Prodi">
                  <option value="" hidden selected>Pilih Prodi</option>
                  @foreach ($prodi as $p)
                  <option value="{{ $p->id }}" @if (old('prodi_id', $dosen->prodi_id ?? '') == $p->id) selected @endif>
                    {{ $p->nama_prodi }}
                  </option>
                @endforeach
                </select>
            </div>

            @if (isset($dosen))
            <div class="flex flex-col w-full mb-4 md:w-1/2">
                <label for="" class="mb-1 font-semibold">Password:</label>
                <input type="hidden" name="old_password" id="old_password" value="{{$dosen->password ?? ''}}">
                <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="new_password" id="password" placeholder="Masukkan Password">
            </div>
            @endif
        </div>

        <h1 class="font-bold text-gray-800 text-2xl my-2 text-center xl:text-left">Alamat</h1>
        <hr class="my-2 text-gray-600 mb-6">

        <div class="flex flex-col md:flex-row">
            <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
              <label for="" class="mb-1 font-semibold">Provinsi:</lab>
              <select type="text" id="provinsi" name="provinsi_id" data-selected="{{$dosen->provinsi_id ?? ''}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
                <option value="" hidden selected>Pilih Provinsi</option>
              </select>
            </div>

            <div class="flex flex-col w-full mb-4 md:w-1/2">
              <label for="" class="mb-1 font-semibold">Kota / Kabupaten:</label>
              <select type="text" name="kota_id" id="kota" data-selected="{{$dosen->kota_id ?? ''}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Nip">
                <option value="" hidden selected>Pilih Kota / Kabupaten</option>
              </select>
            </div>
          </div>

          <div class="flex flex-col md:flex-row">
            <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
              <label for="" class="mb-1 font-semibold">Kelurahan:</lab>
              <select type="text" id="kecamatan" name="kecamatan_id" data-selected="{{$dosen->kecamatan_id ?? ''}}" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
                <option value="" hidden selected>Pilih Kelurahan</option>
              </select>
            </div>
            <div class="flex flex-col w-full mb-4 md:w-1/2">
              <label for="" class="mb-1 font-semibold">Kelurahan:</label>
              <select type="text" id="kelurahan" name="kelurahan_id" data-selected="{{$dosen->kelurahan_id ?? ''}}" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Nip">
                <option value="" hidden selected>Pilih Kode pos</option>
              </select>
            </div>
          </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Alamat lengkap:</lab>
            <textarea type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="alamat" id="alamat" placeholder="Masukkan Alamat Lengkap">{{old('alamat', $dosen->alamat ?? '')}}</textarea>
          </div>

          {{-- <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Pilih Prodi:</label>
            <select class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="prodi_id" id="prodi_id" placeholder="Pilih Prodi">
              <option value="" hidden selected>Pilih Prodi</option>
              @foreach ($prodi as $p)
              <option value="{{ $p->id }}" @if (old('prodi_id', $dosen->prodi_id ?? '') == $p->id) selected @endif>
                {{ $p->nama_prodi }}
              </option>
            @endforeach
            </select>
          </div> --}}
        </div>
        <div>
            <button class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
            <a href="{{route('admin.master-dosen.index')}}" class="px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">
                Batal
            </a>
        </div>
    </form>
    </div>
  </div>
</x-layout>
