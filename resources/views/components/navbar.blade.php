<<<<<<< HEAD
<nav  x-data="{ open: false, darkMode: false }" class="fixed xl:sticky top-0 w-full border-b border-gray-500 bg-gray-900 p-4 px-4 z-10">
  <div class="flex justify-between items-center">
    <div class="text-white">
      <button @click="isSideMenuOpen = !isSideMenuOpen" class="cursor-pointer block xl:hidden px-2 py-1 border-2 hover:bg-slate-800 border:bg-slate-400 rounded-sm"><i class="bi bi-list font-bold text-2xl"></i></button>
      {{-- <h1 class="text-lg font-semibold text-white hidden xl:block">{{Auth::user()->role}}</h1> --}}
=======
<nav class="fixed z-50 xl:sticky top-0 w-full border-b border-gray-200 bg-white  py-3 px-4 z-10">
  <div class="flex justify-between items-center">
    <div class="text-gray-600">
      <button @click="isSideMenuOpen = !isSideMenuOpen" class="cursor-pointer block xl:hidden px-2 py-1 active:bg-gray-200 rounded-sm"><i class="bi bi-list font-bold text-2xl"></i></button>
      <h1 class="text-lg px-2 font-semibold text-gray-600 hidden xl:block">{{Auth::user()->role}} -> Dashboard</h1>
>>>>>>> 8934609 (fixed responsive & view  admin)
    </div>

    @php
        $user = Auth::user();
        $user->load($user->role); // 'admin', 'dosen', atau 'mahasiswa'
        $profile = $user->{$user->role}; // Ambil model relasinya
    @endphp

    <div x-data="{open: false}" class="flex items-center gap-3">
<<<<<<< HEAD
      {{-- <button id="toggle-dark-mode" class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white">
        <i class="bi bi-moon-stars-fill"></i>
      </button> --}}
        <button @click="darkMode = !darkMode; document.documentElement.classList.toggle('dark', darkMode)"
                :aria-pressed="darkMode.toString()"
                class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none">
            <i class="bi bi-moon-stars-fill"></i>
        </button>

      {{-- <div class="flex gap-3 items-center">
        <h3 class="text-white hidden md:block">{{ Auth::user()->name }}</h3>
        <img @click="open = !open" @click.away="open = false" src="/images/profil.jpg" class="w-10 hover:border-2 cursor-pointer border-white border-2 hover:border-gray-300 active:border-gray-400 h-10 rounded-full object-cover" alt="User">
        <div x-show="open" x-transition.top.duration.300ms class="absolute top-18 right-7 p-2 rounded-md bg-gray-800 text-white font-semibold">
            <ul class="">
                <li>
                    <a class="p-3 hover:bg-slate-600 active:bg-slate-700 rounded-sm w-full block" href="/admin/profil"><i class="bi bi-person-circle mr-3"></i>Profile</a>
                </li>
                <li>
                    <a class="p-3 hover:bg-slate-600 active:bg-slate-700 rounded-sm w-full block" href="/admin/ubahPassword"><i class="bi bi-gear-fill mr-3"></i>Ubah Password</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-3 hover:bg-slate-600 active:bg-slate-700 rounded-sm w-full block text-left">
                            <i class="bi bi-box-arrow-left mr-3"></i> Log Out
                        </button>
                    </form>
                </li>

            </div>
        </ul>
      </div> --}}

      @if (Auth::user()->role === 'admin')
      <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 focus:outline-none">
            <img src="{{ $profile?->foto ? asset('storage/' . $profile->foto) : asset('images/profil-kosong.png') }}" class="w-10 h-10 rounded-full object-cover border-2 border-white hover:border-gray-300" alt="User">
            <span class="text-white hidden md:inline">{{ Auth::user()->name }}</span>
            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
        </button>

        <div x-show="open" x-transition class="absolute right-0 mt-2 w-50 bg-gray-800 text-white rounded-md shadow-lg py-1 z-20">
            <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-700"><i class="bi bi-person-circle mr-2"></i> Profile</a>
            <a href="{{route('admin.change-password')}}" class="block px-4 py-2 text-sm hover:bg-gray-700"><i class="bi bi-gear-fill mr-2"></i> Ubah Password</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-700">
                    <i class="bi bi-box-arrow-left mr-2"></i> Log Out
                </button>
            </form>
        </div>
=======
      @if (Auth::user()->role === 'admin')
      <div class="relative flex items-center gap-2" x-data="{ open: false }">
        <div class="relative flex gap-5 items-center mr-2">
            <div x-data="{ isDark: false }">
                <button @click="isDark = !isDark" class="text-gray-600 text-lg hover:text-black">
                    <template x-if="!isDark">
                        <i class="bi bi-sun"></i> <!-- Matahari -->
                    </template>
                    <template x-if="isDark">
                        <i class="bi bi-moon"></i> <!-- Bulan -->
                    </template>
                </button>
            </div>

            <a href="{{ route('admin.kalender-akademik.view') }}" class="relative group">
                <i class="bi bi-calendar3 text-gray-600 text-lg mb-1"></i>
                <span
                  class="absolute left-1/2 top-full mt-1 -translate-x-1/2 bg-gray-700 text-white text-xs rounded px-2 py-1 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none whitespace-nowrap"
                >
                  Kalender Akademik
                </span>
              </a>
              
              
    
            <div class="w-px h-10 bg-gray-400"></div>
        </div>
    
        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 focus:outline-none">
            <img src="{{ $profile?->foto ? asset('storage/' . $profile->foto) : asset('images/profil-kosong.png') }}"
                 class="w-10 h-10 rounded-full object-cover border-2 border-white hover:border-gray-300" alt="User">
            <span class="text-gray-600 hidden md:inline">{{ Auth::user()->name }}</span>
            <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"/>
            </svg>
        </button>
    
        <div x-show="open" x-cloak x-transition.top.duration.300ms class="absolute top-14 right-4 w-56 p-2 rounded-md bg-white shadow-xl text-gray-800 font-semibold z-50">
            <a href="{{ route('admin.profile.edit') }}" class="flex items-center gap-3 p-3 rounded-md hover:bg-gray-100 transition w-full">
                <i class="bi bi-person-circle text-lg"></i>
                <span>Profile</span>
            </a>
            <a href="{{ route('admin.change-password') }}" class="flex items-center gap-3 p-3 rounded-md hover:bg-gray-100 transition w-full">
                <i class="bi bi-gear-fill text-lg"></i>
                <span>Ubah Password</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 p-3 rounded-md hover:bg-gray-100 transition w-full text-left">
                    <i class="bi bi-box-arrow-left text-lg"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
        
>>>>>>> 8934609 (fixed responsive & view  admin)
    </div>
    @endif


    @if (Auth::user()->role === 'dosen')
      <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 focus:outline-none">
            <img src="/images/profil.jpg" class="w-10 h-10 rounded-full object-cover border-2 border-white hover:border-gray-300" alt="User">
            <span class="text-white hidden md:inline">{{ Auth::user()->name }}</span>
            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
        </button>

        <div x-show="open" x-transition class="absolute right-0 mt-2 w-50 bg-gray-800 text-white rounded-md shadow-lg py-1 z-20">
            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-700"><i class="bi bi-person-circle mr-2"></i> Profile</a>
            <a href="/admin/ubahPassword" class="block px-4 py-2 text-sm hover:bg-gray-700"><i class="bi bi-gear-fill mr-2"></i> Ubah Password</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-700">
                    <i class="bi bi-box-arrow-left mr-2"></i> Log Out
                </button>
            </form>
        </div>
    </div>
    @endif


    </div>
  </div>
</nav>

<<<<<<< HEAD
{{-- <nav x-data="{ open: false, darkMode: false }" class="bg-gray-900 border-b border-gray-700 fixed top-0 w-full z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-4">
                <!-- Sidebar toggle -->
                <button @click="isSideMenuOpen = !isSideMenuOpen" class="xl:hidden text-white p-2 hover:bg-slate-800 border border-slate-400 rounded-sm">
                    <i class="bi bi-list text-2xl"></i>
                </button>
                <h1 class="text-white text-lg hidden xl:block font-semibold">Admin → Dashboard</h1>
            </div>

            <!-- Right side -->
            <div class="flex items-center gap-4">
                <!-- Dark mode toggle -->
                <button @click="darkMode = !darkMode; document.documentElement.classList.toggle('dark', darkMode)"
                        :aria-pressed="darkMode.toString()"
                        class="p-2 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-white focus:outline-none">
                    <i class="bi bi-moon-stars-fill"></i>
                </button>

                <!-- Profile Dropdown -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 focus:outline-none">
                        <img src="/images/profil.jpg" class="w-10 h-10 rounded-full object-cover border-2 border-white hover:border-gray-300" alt="User">
                        <span class="text-white hidden md:inline">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                    </button>

                    <div x-show="open" x-transition class="absolute right-0 mt-2 w-48 bg-gray-800 text-white rounded-md shadow-lg py-1 z-20">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm hover:bg-gray-700"><i class="bi bi-person-circle mr-2"></i> Profile</a>
                        <a href="/admin/ubahPassword" class="block px-4 py-2 text-sm hover:bg-gray-700"><i class="bi bi-gear-fill mr-2"></i> Ubah Password</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm hover:bg-gray-700">
                                <i class="bi bi-box-arrow-left mr-2"></i> Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 text-gray-300 hover:bg-gray-700 rounded-md focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden bg-gray-800 px-4 pb-3">
        <div class="pt-4 border-t border-gray-600">
            <div class="text-white font-semibold">{{ Auth::user()->name }}</div>
            <div class="text-gray-400 text-sm">{{ Auth::user()->email }}</div>
            <a href="{{ route('profile.edit') }}" class="block mt-2 text-white hover:bg-gray-700 px-3 py-2 rounded-md">Profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block w-full text-left text-white hover:bg-gray-700 px-3 py-2 rounded-md" type="submit">
                    Log Out
                </button>
            </form>
        </div>
    </div>
</nav> --}}

=======
>>>>>>> 8934609 (fixed responsive & view  admin)
