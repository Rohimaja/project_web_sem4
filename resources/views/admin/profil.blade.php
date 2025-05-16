<x-layout>
    <div>
        <x-slot:title>{{ $title }}</x-slot:title>
        <p>Ubah Profil Admin Di Sini</p>

      <div class="w-full flex flex-col md:flex-row gap-5 mt-5">
          <!-- Foto Profil -->
          <div class="bg-white shadow-md h-full w-full pb-5 md:basis-1/2">
            <form action="{{route('admin.profile.update')}}" enctype="multipart/form-data" method="POST">
                @csrf
                @method('patch')
          <div class="flex items-center p-4 border-b-2 border-gray-200">
            <i class="bi bi-person-circle mr-3"></i>
            <h2 class="font-bold">Foto Profile</h2>
          </div>
          <div class="flex flex-col justify-center items-center p-4">
            <img src="{{ isset($user->admin) && $user->admin->foto ? asset('storage/' . $user->admin->foto) : asset('images/profil-kosong.png') }}" id="previewImage" class="w-40 h-40 mb-4 hover:border-2 border-white border-2 hover:border-gray-300 active:border-gray-400 rounded-full object-cover" alt="Preview Foto">
            {{-- <img src="/images/profil.jpg" class="w-40 h-40 mb-4 hover:border-2 border-white border-2 hover:border-gray-300 active:border-gray-400 rounded-full object-cover" id="previewImage" alt="User"> --}}
            <p class="mb-3 text-gray-500">Format tersedia hanya file JPEG, JPG, atau PNG</p>
            <input type="file" name="foto" id="foto" accept="image/*" class="hidden">
<<<<<<< HEAD
            <label for="foto" class="flex items-center px-5 py-2.5 text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-sm font-semibold cursor-pointer">Upload New Image</label>
=======
            <label for="foto" class="flex items-center px-5 py-2 text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-sm font-semibold cursor-pointer">Upload New Image</label>
>>>>>>> 8934609 (fixed responsive & view  admin)
            {{-- <button class="flex items-center px-5 py-2.5 text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-sm font-semibold cursor-pointer"> --}}
              {{-- Upload New Image --}}
            {{-- </button> --}}
          </div>
          <div class=" px-8 py-4 flex justify-end">
              {{-- <a href="{{route('admin.master-admin.index')}}" class="px-5 py-2 mr-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</a> --}}
<<<<<<< HEAD
              <button type="submit" class="px-5 py-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
=======
              <button type="submit" class="px-5 py-2 bg-green-600 w-full md:w-max hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
>>>>>>> 8934609 (fixed responsive & view  admin)
        </div>
    </form>
        </div>

        <!-- Detail Profil -->
        <div class="bg-white shadow-md w-full md:basis-3/4 pb-5">
          <div class="flex items-center p-4 border-b-2 border-gray-200">
            <i class="bi bi-person-fill mr-3"></i>
            <h2 class="font-bold">Detail Profile</h2>
          </div>
          <div class="px-8 py-4">
            <div class="flex flex-col md:flex-row mb-4">
              <div class="flex flex-col w-full">
                <label for="" class="mb-1 font-semibold text-gray-600">Nama Lengkap:</label>
                <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="{{old('nama', $user->admin->nama ?? '')}}">
              </div>
            </div>
            <div class="flex flex-col md:flex-row">
              <div class="flex flex-col w-full mb-4 mr-0 md:mr-4">
                <label for="" class="mb-1 font-semibold text-gray-600">NIP:</label>
                <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="209393472384709">
              </div>
              <div class="flex flex-col w-full mb-4">
                <label for="" class="mb-1 font-semibold text-gray-600">Agama:</label>
                <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="{{$user->admin->agama ?? ''}}">
              </div>
            </div>
            <div class="flex flex-col md:flex-row">
              <div class="flex flex-col w-full mb-4 mr-0 md:mr-4">
                <label for="" class="mb-1 font-semibold text-gray-600">Tempat Tanggal Lahir:</label>
                <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="{{$user->admin->tempat_lahir .', '. $user->admin->tgl_lahir}}">
              </div>
              <div class="flex flex-col w-full mb-4">
                <label for="" class="mb-1 font-semibold text-gray-600">Jenis Kelamin:</label>
                <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="{{$user->admin->jenis_kelamin}}">
              </div>
            </div>
            <div class="flex flex-col md:flex-row mb-4">
              <div class="flex flex-col w-full">
                <label for="" class="mb-1 font-semibold text-gray-600">Email:</label>
                <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="{{$user->admin->email}}">
              </div>
            </div>
            <div class="flex flex-col md:flex-row">
              <div class="flex flex-col w-full mb-4 mr-0 md:mr-4">
                <label for="" class="mb-1 font-semibold text-gray-600">No Telp:</label>
                <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="{{$user->admin->no_telp}}">
              </div>
              <div class="flex flex-col w-full mb-4">
                <label for="" class="mb-1 font-semibold text-gray-600">Alamat:</label>
                <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="{{$user->admin->province->name .', '. $user->admin->regency->name .', '. $user->admin->district->name .', '. $user->admin->village->nama .', '. $user->admin->alamat  }}">
              </div>
            </div>

          </div>
        </div>
      </div>


    </div>


  </x-layout>
