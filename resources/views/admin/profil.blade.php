<x-layout>
  <div>
    <h1 class="font-bold text-gray-800 text-2xl">{{ $title }}</h1>
    <p>Ubah Profil Admin Di Sini</p>

    <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-5 mt-5">
      <div class="bg-white shadow-md">
        <div class="flex items-center p-4 border-b-2 border-gray-200">
          <i class="bi bi-person-circle mr-3"></i>
          <h2 class="font-bold">Edit Profile</h2>
        </div>
        <div class="p-4 border-b-2 border-gray-200">
          <h2 class="mb-3 font-bold">Avatar</h2>
          <button class="flex items-center px-5 py-2.5 text-white bg-blue-500 hover:bg-blue-600 active:bg-blue-700 rounded-sm font-semibold cursor-pointer">
            Upload
          </button>
        </div>
        <div class="p-4 border-b-2 border-gray-200">
          <div class="mb-4">
            <div class="flex flex-col">
              <label class="mb-1 font-bold">Nama</label>
              <input type="text" class="p-2 border-2 border-gray-400 rounded-sm text-gray-800" value="Aisyah Jiltomob">
            </div>
            <p class="text-[12px] p-1 text-gray-500">Diperlukan. Nama Kamu</p>
          </div>
          <div>
            <div class="flex flex-col">
              <label class="mb-1 font-bold">Email</label>
              <input type="email" class="p-2 border-2 border-gray-400 rounded-sm text-gray-800" value="Aisya@gmail.com">
            </div>
            <p class="text-[12px] p-1 text-gray-500">Diperlukan. Email kamu</p>
          </div>
        </div>
        <div class="p-4">
          <button class="flex items-center px-5 py-2.5 text-white bg-green-500 hover:bg-green-600 active:bg-green-700 rounded-sm font-semibold cursor-pointer">
            Submit
          </button>
        </div>
      </div>
    
      <div class="bg-white shadow-md">
        <div class="flex items-center p-4 border-b-2 border-gray-200">
          <i class="bi bi-person-fill mr-3"></i>
          <h2 class="font-bold">Profile</h2>
        </div>
        <div class="p-4 border-b-2 border-gray-200">
          <h2 class="p-7 mb-20 text-center font-bold">Foto Profil Avatar</h2>
        </div>
        <div class="p-4 border-b-2 border-gray-200">
          <div class="mb-4">
            <div class="flex flex-col">
              <label class="mb-1 font-bold">Nama</label>
              <input type="text" class="p-2 border-2 border-gray-400 rounded-sm text-gray-800" value="Aisyah Jiltomob">
            </div>
          </div>
          <div>
            <div class="flex flex-col">
              <label class="mb-1 font-bold">Email</label>
              <input type="email" class="p-2 border-2 border-gray-400 rounded-sm text-gray-800" value="Aisya@gmail.com">
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-5">
      <div class="bg-white shadow-md w-full">
        <div class="flex items-center p-4 border-b-2 border-gray-200">
          <i class="bi bi-person-lock mr-3"></i>
          <h2 class="font-bold">Ubah Password</h2>
        </div>
        <div class="p-4 border-b-2 border-gray-200">
          <div class="mb-4">
            <div class="flex flex-col">
              <label class="mb-1 font-bold">Password Sekarang</label>
              <input type="text" class="p-2 border-2 border-gray-400 rounded-sm text-gray-800" value="Aisyah Jiltomob">
            </div>
            <p class="text-[12px] p-1 text-gray-500">Diperlukan. Password Anda Saat Ini</p>
          </div>
        </div>
        <div class="p-4 border-b-2 border-gray-200">
          <div class="mb-4">
            <div class="flex flex-col">
              <label class="mb-1 font-bold">Password Baru</label>
              <input type="text" class="p-2 border-2 border-gray-400 rounded-sm text-gray-800" value="Aisyah Jiltomob">
            </div>
            <p class="text-[12px] p-1 text-gray-500">Diperlukan. Password Baru Saat Ini</p>
          </div>
          <div>
            <div class="flex flex-col">
              <label class="mb-1 font-bold">Konfirmasi Password</label>
              <input type="email" class="p-2 border-2 border-gray-400 rounded-sm text-gray-800" value="Aisya@gmail.com">
            </div>
            <p class="text-[12px] p-1 text-gray-500">Diperlukan. Konfirmasi Password Saat ini</p>
          </div>
        </div>
        <div class="p-4">
          <button class="flex items-center px-5 py-2.5 text-white bg-green-500 hover:bg-green-600 active:bg-green-700 rounded-sm font-semibold cursor-pointer">
            Submit
          </button>
        </div>
      </div>
    </div>
  </div>

</x-layout>