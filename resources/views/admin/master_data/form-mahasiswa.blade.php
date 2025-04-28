<x-layout>
  <div class="h-full">
    <h1 class="font-bold text-gray-800 text-2xl">{{ $title }}</h1>
    <p>Silahkan tambahkan data Mahasiswa</p>
    <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">
      
      <form action="">

        <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Informasi Umum</h1>
        <hr class="my-2 text-gray-600 mb-6">

        <div class="flex flex-col items-center mb-6 gap-4 md:flex-row">
          <div  class="w-25 h-25 bg-red-200 rounded-full overflow-hidden cursor-pointer">
            <img src="/images/profil.jpg" class="w-full h-full object-cover" alt="">
          </div>
          <div class="flex flex-col gap-4 items-center text-center md:items-start md:ml-3">
            <p class="text-gray-500">Format tersedia hanya file JPEG, JPG, atau PNG</p>
            <input type="file" name="foto" id="foto" accept="image/*" class="hidden" onchange="loadPreview(event)" required>
            <div>
              <label for="foto" class="px-3 py-2 mr-2 bg-blue-100 hover:bg-blue-200 active:bg-blue-300 text-blue-400 rounded-md cursor-pointer">Unggah Foto</label>
              <button class="px-3 py-1.5 bg-red-100 hover:bg-red-200 active:bg-red-300 text-red-400  rounded-md cursor-pointer">Hapus Foto</button>
            </div>
          </div>
        </div>
        
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Nama Lengkap:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan nama lengkap">
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">NIM:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan NIM">
          </div>
        </div>
        
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Jenis Kelamin:</lab>
            <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
              <option value="" hidden selected>Pilih jenis kelamin</option>
              <option value="laki-laki">Laki-laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Agama:</label>
            <select type="text" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Nip">
              <option value="" hidden selected>Pilih Agama</option>
              <option value="Islam">Islam</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
              <option value="Kristen">Kristen</option>
              <option value="Konghucu">Konghucu</option>
            </select>
          </div>
        </div>
        
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Tempat Lahir:</label>
            <select type="text" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Nip">
              <option value="" hidden selected>Pilih Tempat Lahir</option>
              <option value="Islam">Islam</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
              <option value="Kristen">Kristen</option>
              <option value="Konghucu">Konghucu</option>
            </select>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Tanggal Lahir:</label>
            <input type="date" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan tanggal lahir">
          </div>
        </div>
        
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Email:</label>
            <input type="email" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan Email">
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Nomor Telepon:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan no telp">
          </div>
        </div>

        <h1 class="font-bold text-gray-800 text-2xl my-2 text-center xl:text-left">Alamat</h1>
        <hr class="my-2 text-gray-600 mb-6">

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Provinsi:</lab>
            <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
              <option value="" hidden selected>Pilih Provinsi</option>
              <option value="laki-laki">Laki-laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Kota / Kabupaten:</label>
            <select type="text" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Nip">
              <option value="" hidden selected>Pilih Kota / Kabupaten</option>
              <option value="Islam">Islam</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
              <option value="Kristen">Kristen</option>
              <option value="Konghucu">Konghucu</option>
            </select>
          </div>
        </div>
        
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Kelurahan:</lab>
            <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
              <option value="" hidden selected>Pilih Kelurahan</option>
              <option value="laki-laki">Laki-laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Kode Pos:</label>
            <select type="text" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Nip">
              <option value="" hidden selected>Pilih Kode pos</option>
              <option value="Islam">Islam</option>
              <option value="Hindu">Hindu</option>
              <option value="Buddha">Buddha</option>
              <option value="Kristen">Kristen</option>
              <option value="Konghucu">Konghucu</option>
            </select>
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Alamat lengkap:</lab>
            <textarea type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Alamat Lengkap"></textarea>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            
          </div>
        </div>

        <h1 class="font-bold text-gray-800 text-2xl my-2 text-center xl:text-left">Informasi Akademik</h1>
        <hr class="my-2 text-gray-600 mb-6">

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Jenjang Studi:</lab>
            <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
              <option value="" hidden selected>Pilih jenjang studi</option>
              <option value="s1">S1</option>
              <option value="d4">D4</option>
            </select>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Program Studi:</label>
            <select type="text" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Nip">
              <option value="" hidden selected>Pilih Program Studi</option>
              <option value="MIK">MIK</option>
              <option value="IKP">IKP</option>
              <option value="FRM">FRM</option>
              <option value="KPW">KPW</option>
            </select>
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Status Akademik:</lab>
            <div class="flex items-center mt-2">
              <input id="aktif" name="status-akademik" type="radio" class="mr-2 w-5 h-5">
              <label for="aktif" class="mr-9 text-gray-600">Aktif</label>
              <input id="tidakAktif" name="status-akademik" type="radio" class="mr-2 w-5 h-5">
              <label for="tidakAktif" class="text-gray-600">Tidak Aktif</label>
            </div>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Semester Tempuh:</label>
            <select type="text" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Nip">
              <option value="" hidden selected>Pilih Semester tempuh</option>
              <option value="8">8 semester</option>
              <option value="6">6 semester</option>
              <option value="14">14 semester</option>
              <option value="4">4 semester</option>
              <option value="2">2 semester</option>
            </select>
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Angkatan:</lab>
              <input type="number" name="angkatan"
              min="2010" max="{{ date('Y') }}"
              class="p-2 mt-1 py-[9px] w-full border-2 font-normal border-gray-700 rounded-sm"
              placeholder="Masukkan Tahun (e.g. 2023)">
       
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Dosen Wali:</label>
            <select type="text" class="p-2 py-[11px] w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Nip">
              <option value="" hidden selected>Pilih Dosen Wali</option>
              <option value="andreas">Drs. Andreas</option>
              <option value="mulyono">Drs. mulyono</option>
            </select>
          </div>
        </div>

      </form>
      <div>
        <button class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
        <a href="/admin/masterdata/mahasiswa">
          <button class="px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</button>
        </a>
      </div>
    </div>
  </div>
</x-layout>