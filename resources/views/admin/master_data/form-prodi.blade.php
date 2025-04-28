<x-layout>
  <div class="h-full">
    <h1 class="font-bold text-gray-800 text-2xl">{{ $title }}</h1>
    <p>Silahkan tambahkan data Program Studi</p>
    <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">
      
      <form action="">

        <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Informasi Umum</h1>
        <hr class="my-2 text-gray-600 mb-6">
        
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Kode Program Studi:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan nama lengkap">
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Jenjang:</lab>
            <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
              <option value="" hidden selected>Pilih Jenjang</option>
              <option value="s1">S1</option>
              <option value="s2">S2</option>
            </select>
          </div>
        </div>
        
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Nama Program Studi:</lab>
            <input type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Alamat Lengkap"></input>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2"></div>
        </div>
      </form>
      <div>
        <button class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
        <a href="/admin/masterdata/prodi">
          <button class="px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</button>
        </a>
      </div>
    </div>
  </div>
</x-layout>