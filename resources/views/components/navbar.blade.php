<nav class="fixed z-50 xl:sticky top-0 w-full border-b border-gray-300 bg-white  py-3 px-4 z-10">
  <div class="flex justify-between items-center">
    <div class="text-white">
      <button @click="isSideMenuOpen = !isSideMenuOpen" class="cursor-pointer block xl:hidden px-2 py-1 active:bg-gray-200 rounded-sm"><i class="bi bi-list font-bold text-2xl text-gray-800"></i></button> 
      {{-- <div class="p-2.5 flex items-center rounded-md px-4 bg-gray-700 cursor-pointer duration-300 text-white hidden xl:flex">
        <i class="bi bi-search text-sm"></i>
        <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none">
      </div> --}}
    </div>
    <div x-data="{open: false}" class="flex items-center gap-3">
      {{-- <button id="toggle-dark-mode" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
        <i class="bi bi-moon-stars-fill"></i>
      </button> --}}
      <div @click="open = !open" @click.away="open = false" class="flex gap-3 items-center cursor-pointer">
        <img src="/images/profil.jpg" class="w-10 hover:border-2 border-white border-2 hover:border-gray-300 active:border-gray-400 h-10 rounded-full object-cover" alt="User">
        <h3 class="text-gray-800 hidden md:block">Syalia Ayu <i class="bi bi-chevron-down"></i></h3>
      </div>
      <div x-show="open" x-cloak x-transition.top.duration.300ms class="absolute top-16 right-15 p-2 rounded-md bg-white shadow-xl text-gray-800 font-semibold">
        <ul class="">
          <li>
            <a class="p-3 hover:bg-gray-200 active:bg-gray-300 rounded-sm w-full block" href="/admin/profil"><i class="bi bi-person-circle mr-3"></i>Profile</a>
          </li>
          <li>
            <a class="p-3 hover:bg-gray-200 active:bg-gray-300 rounded-sm w-full block" href="/admin/ubahPw"><i class="bi bi-gear-fill mr-3"></i>Ubah Password</a>
          </li>
          <li>
            <a class="p-3 hover:bg-gray-200 active:bg-gray-300 rounded-sm w-full block" href="/login"><i class="bi bi-box-arrow-left mr-3"></i>Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</nav>