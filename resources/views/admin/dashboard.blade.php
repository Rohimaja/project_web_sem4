<x-layout>
<<<<<<< HEAD
  <div class="h-[1000px]">
    <x-slot:title>{{ $title }}</x-slot:title>

    <div x-data="{open: false}" class="p-4 bg-amber-300 text-center">
      
      <button @click="open = !open" x-text="open ? 'tutup' : 'buka'" x-bind:class="open ? 'bg-gray-600' : 'bg-cyan-600'" class="p-8 mb-4 bg-amber-900"></button>
      <div x-show="open" x-transition.origin.top.left.duration.500ms class="h-8 bg-amber-700">
        <h2>halo kawan apa kabar</h2>
      </div>

    </div>
  
  </div>
</x-layout>
=======
  <div>
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Selamat Datang, <b>{{Auth::user()->name}}</b></p>

      <div class="mt-5  flex flex-wrap w-full gap-5 md:gap-14">
        <div class="w-77 bg-white rounded-sm shadow-md py-4 px-10 border-b-8 border-blue-800">
          <h2 class="text-2xl text-gray-600 font-semibold">Total Mahasiswa</h2>
          <div class="mt-4 flex items-center gap-7">
            <i class="bi bi-person-circle text-6xl text-blue-800"></i>
            <h1 class="text-5xl font-bold text-blue-800">2201</h1>
          </div>
        </div>
        <div class="w-77  bg-white rounded-sm shadow-md py-4 px-10 border-b-8 border-purple-800">
          <h2 class="text-2xl text-gray-600 font-semibold">Total Dosen</h2>
          <div class="mt-4 flex items-center gap-7">
            <i class="bi bi-person-workspace text-6xl text-purple-800"></i>
            <h1 class="text-5xl font-bold text-purple-800">112</h1>
          </div>
        </div>
        <div class="w-77  bg-white rounded-sm shadow-md py-4 px-10 border-b-8 border-green-800">
          <h2 class="text-2xl text-gray-600 font-semibold">Total Mata Kuliah</h2>
          <div class="mt-4 flex items-center gap-7">
            <i class="bi bi-journal-bookmark-fill text-6xl text-green-800"></i>
            <h1 class="text-5xl font-bold text-green-800">170</h1>
          </div>
        </div>
        <div class="w-77  bg-white rounded-sm shadow-md py-4 px-10 border-b-8 border-red-800">
          <h2 class="text-2xl text-gray-600 font-semibold">Total Program Studi</h2>
          <div class="mt-4 flex items-center gap-7">
            <i class="bi bi-book-half text-6xl text-red-800"></i>
            <h1 class="text-5xl font-bold text-red-800">2201</h1>
          </div>
        </div>
      </div>
      <div class="">
        <div class="w-77 overflow-x-auto mt-5 bg-white rounded-sm shadow-xl">
          <div>
            <h1>Presentasi Absensi Mahasiswa Perbulan</h1>
            <hr class="text-gray-600">
          </div>
          <canvas id="myChart" width="400" height="200" class=""></canvas>
        </div>

      </div>
  </div>
</x-layout>
>>>>>>> c0e2562 (first commit)
