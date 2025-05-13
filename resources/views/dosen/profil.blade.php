<x-layoutDosen>
  <div>
    <h1 class="font-bold text-gray-800 text-2xl">{{ $title }}</h1>
    <p>Ubah Profil Admin Di Sini</p>

    <div class="w-full flex flex-col md:flex-row gap-5 mt-5">
      <!-- Foto Profil -->
      <div class="bg-white shadow-md w-full h-full pb-5 md:basis-1/2">
        <div class="flex items-center p-4 border-b-2 border-gray-200">
          <i class="bi bi-person-circle mr-3"></i>
          <h2 class="font-bold">Foto Profile</h2>
        </div>
        <div class="flex flex-col justify-center items-center p-4">
          <img src="/images/profil.jpg" class="w-40 h-40 mb-4 hover:border-2 border-white border-2 hover:border-gray-300 active:border-gray-400 rounded-full object-cover" alt="User">
          <p class="mb-3 text-gray-500">Format tersedia hanya file JPEG, JPG, atau PNG</p>
          <button class="flex items-center px-5 py-2.5 text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-sm font-semibold cursor-pointer">
            Upload New Image
          </button>
        </div>
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
              <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="Vannih Jannah Munaroh">
            </div>
          </div>
          <div class="flex flex-col md:flex-row">
            <div class="flex flex-col w-full mb-4 mr-0 md:mr-4">
              <label for="" class="mb-1 font-semibold text-gray-600">NIP:</label>
              <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="209393472384709">
            </div>
            <div class="flex flex-col w-full mb-4">
              <label for="" class="mb-1 font-semibold text-gray-600">Agama:</label>
              <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="Islam">
            </div>
          </div>
          <div class="flex flex-col md:flex-row">
            <div class="flex flex-col w-full mb-4 mr-0 md:mr-4">
              <label for="" class="mb-1 font-semibold text-gray-600">Tempat Tanggal Lahir:</label>
              <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="Jember, 29-02-2004">
            </div>
            <div class="flex flex-col w-full mb-4">
              <label for="" class="mb-1 font-semibold text-gray-600">Jenis Kelamin:</label>
              <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="Laki-laki">
            </div>
          </div>
          <div class="flex flex-col md:flex-row mb-4">
            <div class="flex flex-col w-full">
              <label for="" class="mb-1 font-semibold text-gray-600">Email:</label>
              <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="vannih@gmail.com">
            </div>
          </div>
          <div class="flex flex-col md:flex-row">
            <div class="flex flex-col w-full mb-4 mr-0 md:mr-4">
              <label for="" class="mb-1 font-semibold text-gray-600">No Telp:</label>
              <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="+6281515173887">
            </div>
            <div class="flex flex-col w-full mb-4">
              <label for="" class="mb-1 font-semibold text-gray-600">Alamat:</label>
              <input type="text" disabled class="p-2 border-2 border-gray-700 bg-gray-100 text-gray-700 rounded-sm" value="Jember, Jl Kaca Piring 9 No. 6">
            </div>
          </div>
        </div>
      </div>
    </div>
    
  
  </div>
  

</x-layoutDosen>