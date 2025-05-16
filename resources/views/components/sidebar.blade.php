<aside class="fixed border-r-1 border-gray-300 w-64 bg-blue-900 h-screen overflow-y-auto top-0 left-0 p-4 ease-in-out duration-150 -translate-x-full xl:translate-x-0">
  <div class="text-gray-600">
    <div class="mb-2">
      <div class="flex items-center justify-center">
        {{-- <img class="mb-4" src="{{ asset('images/stikes.png') }}" alt=""> --}}
        <img class="mb-4 w-[35px] mr-2" src="{{ asset('images/stikes(1).png') }}" alt="">
        {{-- <img class="mb-4 w-[180px]" src="{{ asset('images/stikes_black_text(1).png') }}" alt=""> --}}
        <img class="mb-4 w-[180px]" src="{{ asset('images/stikes(2).png') }}" alt="">
      </div>
      <hr class="my-2 text-gray-300">
    </div>

    <div class="font-[sans-serif]">
      <ul class="space-y-2">
        <li>
          <a href="/admin/dashboard">
            <div class="p-2.5 mt-4 flex items-center rounded-md px-4 hover:bg-blue-800 active:bg-blue-700 cursor-pointer duration-300 text-white">
              <i class="bi bi-house-door-fill"></i>
              <span class="text-[15px] ml-4 text-gray-200 font-semibold">Dashboard</span>
            </div>
          </a>
        </li>
        <li>
          <a href="{{route('admin.presensi.index')}}">
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 hover:bg-blue-800 active:bg-blue-700 cursor-pointer duration-300 text-white">
              <i class="bi bi-check-square-fill"></i>
              <span class="text-[15px] ml-4 text-gray-200 font-semibold">Presensi</span>
            </div>
          </a>
        </li>
        <hr class="my-2 text-gray-600">
        <li x-data="{open: false}">
          <div @click="open  = !open" class="p-2.5 mt-3 flex items-center rounded-md px-4 hover:bg-blue-800 active:bg-blue-700 cursor-pointer duration-300 text-white">
            <i class="bi bi-archive-fill"></i>
            <div class="flex justify-between w-full items-center font-semibold">
              <span class="text-[15px] ml-4 text-gray-200">Master Data</span>
              <span x-bind:class="open ? 'rotate-180' : 'rotate-0'" class="text-sm">
                <i class="bi bi-chevron-down font-semibold"></i>
              </span>
            </div>
          </div>

          <div x-show="open" class="text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200">
            <a href="{{route('admin.master-admin.index')}}" class="mt-2 w-4/5">
              <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Admin</h1>
            </a>
            <a href="{{route('admin.master-dosen.index')}}" class="mt-2 w-4/5">
              <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Dosen</h1>
            </a>
            <a href="{{route('admin.master-mahasiswa.index')}}" class="mt-2 w-4/5">
              <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Mahasiswa</h1>
            </a>
            <a href="{{route('admin.master-tahun.index')}}" class="mt-2 w-4/5">
              <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Tahun Ajaran</h1>
            </a>
            <a href="{{route('admin.master-prodi.index')}}" class="mt-2 w-4/5">
              <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Program Studi</h1>
            </a>
            <a href="{{route('admin.master-matkul.index')}}" class="mt-2 w-4/5">
              <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Mata Kuliah</h1>
            </a>
            <a href="{{route('admin.master-ruangan.index')}}" class="mt-2 w-4/5">
              <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Ruangan</h1>
            </a>
            <a href="{{route('admin.kalender-akademik.index')}}" class="mt-2 w-4/5">
              <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Kalender Akademik</h1>
            </a>
          </div>
        </li>
        <li>
          <a href="{{ route('admin.kalender-akademik.view') }}">
              <div class="p-2.5 mt-3 flex items-center rounded-md px-4 hover:bg-blue-800 active:bg-blue-700 cursor-pointer duration-300 text-white">
                  <i class="bi bi-calendar3"></i>
                  <span class="text-[15px] ml-4 text-gray-200 font-semibold">Lihat Kalender Akademik</span>
              </div>
          </a>
      </li>
        <hr class="my-2 text-gray-600">
        <li x-data="{open: false}">
            <div @click="open  = !open" class="p-2.5 mt-3 flex items-center rounded-md px-4 hover:bg-blue-800 active:bg-blue-700 cursor-pointer duration-300 text-white">
              <i class="bi bi-archive-fill"></i>
              <div class="flex justify-between w-full items-center font-semibold">
                <span class="text-[15px] ml-4 text-gray-200">Laporan</span>
                <span x-bind:class="open ? 'rotate-180' : 'rotate-0'" class="text-sm">
                  <i class="bi bi-chevron-down font-semibold"></i>
                </span>
              </div>
            </div>

            <div x-show="open" class="text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200">
              <a href="{{route('admin.laporan.mahasiswa')}}" class="mt-2 w-4/5">
                <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Laporan Mahasiswa</h1>
              </a>
              <a href="{{route('admin.laporan.dosen')}}" class="mt-2 w-4/5">
                <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Laporan Dosen</h1>
              </a>
              {{-- <a href="{{route('admin.laporan.dosen')}}" class="mt-2 w-4/5">
                <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Dosen</h1>
              </a> --}}
            </div>
          </li>

        {{-- <li>
          <a href="/admin/laporan">
            <div class="p-2.5 mt-3 flex items-center rounded-md px-4 hover:bg-blue-600 active:bg-blue-800 cursor-pointer duration-300 text-white">
              <i class="bi bi-file-earmark-text-fill"></i>
              <span class="text-[15px] ml-4 text-gray-200 font-semibold">Laporan</span>
            </div>
          </a>
        </li> --}}
      </ul>
    </div>
  </div>
</aside>


{{-- sidebar mobile --}}
<aside 
x-show="isSideMenuOpen || window.innerWidth >= 1800" 
@click.away="isSideMenuOpen = false" 
x-transition:enter="transition transform duration-300"
x-transition:enter-start="-translate-x-full"
x-transition:enter-end="translate-x-0"
x-transition:leave="transition transform duration-300"
x-transition:leave-start="translate-x-0"
x-transition:leave-end="-translate-x-full" 
class="fixed z-50 w-64 bg-blue-900 h-full overflow-y-auto top-16 left-0 p-4 ease-in-out duration-150 block xl:hidden">
<div class="text-gray-600">
  <div class="mb-2">
    <div class="flex items-center justify-center">
      {{-- <img class="mb-4" src="{{ asset('images/stikes.png') }}" alt=""> --}}
      <img class="mb-4 w-[35px] mr-2" src="{{ asset('images/stikes(1).png') }}" alt="">
      {{-- <img class="mb-4 w-[180px]" src="{{ asset('images/stikes_black_text(1).png') }}" alt=""> --}}
      <img class="mb-4 w-[180px]" src="{{ asset('images/stikes(2).png') }}" alt="">
    </div>
    <hr class="my-2 text-gray-300">
  </div>

  <div class="font-[sans-serif]">
    <ul class="space-y-2">
      <li>
        <a href="/admin/dashboard">
          <div class="p-2.5 mt-4 flex items-center rounded-md px-4 hover:bg-blue-800 active:bg-blue-700 cursor-pointer duration-300 text-white">
            <i class="bi bi-house-door-fill"></i>
            <span class="text-[15px] ml-4 text-gray-200 font-semibold">Dashboard</span>
          </div>
        </a>
      </li>
      <li>
        <a href="{{route('admin.presensi.index')}}">
          <div class="p-2.5 mt-3 flex items-center rounded-md px-4 hover:bg-blue-800 active:bg-blue-700 cursor-pointer duration-300 text-white">
            <i class="bi bi-check-square-fill"></i>
            <span class="text-[15px] ml-4 text-gray-200 font-semibold">Presensi</span>
          </div>
        </a>
      </li>
      <hr class="my-2 text-gray-600">
      <li x-data="{open: false}">
        <div @click="open  = !open" class="p-2.5 mt-3 flex items-center rounded-md px-4 hover:bg-blue-800 active:bg-blue-700 cursor-pointer duration-300 text-white">
          <i class="bi bi-archive-fill"></i>
          <div class="flex justify-between w-full items-center font-semibold">
            <span class="text-[15px] ml-4 text-gray-200">Master Data</span>
            <span x-bind:class="open ? 'rotate-180' : 'rotate-0'" class="text-sm">
              <i class="bi bi-chevron-down font-semibold"></i>
            </span>
          </div>
        </div>

        <div x-show="open" class="text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200">
          <a href="{{route('admin.master-admin.index')}}" class="mt-2 w-4/5">
            <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Admin</h1>
          </a>
          <a href="{{route('admin.master-dosen.index')}}" class="mt-2 w-4/5">
            <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Dosen</h1>
          </a>
          <a href="{{route('admin.master-mahasiswa.index')}}" class="mt-2 w-4/5">
            <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Mahasiswa</h1>
          </a>
          <a href="{{route('admin.master-tahun.index')}}" class="mt-2 w-4/5">
            <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Tahun Ajaran</h1>
          </a>
          <a href="{{route('admin.master-prodi.index')}}" class="mt-2 w-4/5">
            <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Program Studi</h1>
          </a>
          <a href="{{route('admin.master-matkul.index')}}" class="mt-2 w-4/5">
            <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Mata Kuliah</h1>
          </a>
          <a href="{{route('admin.master-ruangan.index')}}" class="mt-2 w-4/5">
            <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Ruangan</h1>
          </a>
        </div>
      </li>
      <hr class="my-2 text-gray-600">
      <li x-data="{open: false}">
          <div @click="open  = !open" class="p-2.5 mt-3 flex items-center rounded-md px-4 hover:bg-blue-800 active:bg-blue-700 cursor-pointer duration-300 text-white">
            <i class="bi bi-archive-fill"></i>
            <div class="flex justify-between w-full items-center font-semibold">
              <span class="text-[15px] ml-4 text-gray-200">Laporan</span>
              <span x-bind:class="open ? 'rotate-180' : 'rotate-0'" class="text-sm">
                <i class="bi bi-chevron-down font-semibold"></i>
              </span>
            </div>
          </div>

          <div x-show="open" class="text-left text-sm font-thin mt-2 w-4/5 mx-auto text-gray-200">
            <a href="{{route('admin.laporan.mahasiswa')}}" class="mt-2 w-4/5">
              <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Laporan Mahasiswa</h1>
            </a>
            <a href="{{route('admin.laporan.dosen')}}" class="mt-2 w-4/5">
              <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Laporan Dosen</h1>
            </a>
            {{-- <a href="{{route('admin.laporan.dosen')}}" class="mt-2 w-4/5">
              <h1 class="cursor-pointer p-2 hover:bg-blue-800 active:bg-blue-700 rounded-md mt-1">Dosen</h1>
            </a> --}}
          </div>
        </li>

      {{-- <li>
        <a href="/admin/laporan">
          <div class="p-2.5 mt-3 flex items-center rounded-md px-4 hover:bg-blue-600 active:bg-blue-800 cursor-pointer duration-300 text-white">
            <i class="bi bi-file-earmark-text-fill"></i>
            <span class="text-[15px] ml-4 text-gray-200 font-semibold">Laporan</span>
          </div>
        </a>
      </li> --}}
    </ul>
  </div>
</div>
</aside>

