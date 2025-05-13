<x-layout>
  <div class="h-full">
    <h1 class="font-bold text-gray-800 text-2xl">{{ $title }}</h1>
    <p>Silahkan tambahkan data Jadwal Perkuliahan</p>
    <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">
      
      <form action="">

        <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Informasi Umum</h1>
        <hr class="my-2 text-gray-600 mb-6">
        
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Hari:</lab>
            <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
              <option value="" hidden selected>Pilih Hari</option>
              <option value="senin">Senin</option>
              <option value="selasa">Selesa</option>
              <option value="rabu">Rabu</option>
              <option value="kamis">Kamis</option>
              <option value="jumat">Jumat</option>
            </select>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2 ">
            <label for="" class="mb-1 font-semibold">Program Studi:</lab>
            <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
              <option value="" hidden selected>Pilih Program Studi</option>
              <option value="MIK">MIK</option>
              <option value="TIF">TIF</option>
            </select>
          </div>
        </div>
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Semester:</lab>
              <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
                <option value="" hidden selected>Pilih Semester</option>
                <option value="Semester1">Semester 1</option>
                <option value="Semester2">Semester 2</option>
                <option value="Semester3">Semester 3</option>
                <option value="Semester4">Semester 4</option>
                <option value="Semester5">Semester 5</option>
                <option value="Semester6">Semester 6</option>
              </select>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Mata Kuliah:</lab>
              <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
                <option value="" hidden selected>Pilih Mat Kuliah</option>
                <option value="matkul1">matkul 1</option>
                <option value="matkul2">matkul 2</option>
                <option value="matkul3">matkul 3</option>
                <option value="matkul4">matkul 4</option>
                <option value="matkul5">matkul 5</option>
                <option value="matkul6">matkul 6</option>
              </select>
          </div>
        </div>
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Ruang:</lab>
              <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
                <option value="" hidden selected>Pilih Ruang</option>
                <option value="Lt1">Lt 1</option>
                <option value="Lt2">Lt 2</option>
                <option value="Lt3">Lt 3</option>
                <option value="Lt4">Lt 4</option>
                <option value="Lt5">Lt 5</option>
                <option value="Lt6">Lt 6</option>
              </select>
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Dosen Koordinator:</lab>
              <select type="text" class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm">
                <option value="" hidden selected>Pilih Dosen Koordinator</option>
                <option value="dosen1">dosen 1</option>
                <option value="dosen2">dosen 2</option>
                <option value="dosen3">dosen 3</option>
                <option value="dosen4">dosen 4</option>
                <option value="dosen5">dosen 5</option>
                <option value="dosen6">dosen 6</option>
              </select>
          </div>
        </div>
        <div class="flex flex-col md:flex-row">
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
            <label for="" class="mb-1 font-semibold">Jam Mulai:</label>
            <input type="time" class="p-2 w-full flex border-2 font-normal border-gray-700 rounded-sm" placeholder="Masukkan Jam Awal">
          </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Jam Selesai:</label>
            <input type="time" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan Jam Akhir">
          </div>
        </div>
      </form>
      <div>
        <button class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
        <a href="/admin/masterdata/jadwal">
          <button class="px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">Batal</button>
        </a>
      </div>
    </div>
  </div>
</x-layout>