<<<<<<< HEAD
<x-layoutAuth title="Login">
  <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-gray-100 to-gray-100 px-4">
      <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8 space-y-6">
          <div class="w-full flex justify-center">
            <img src="{{ asset('images/stipress.png') }}" alt="Logo Aplikasi" class="h-24">
          </div>

          <form method="POST" class="space-y-5">
              @csrf

              <div>
                  <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                  <input type="text" name="username" id="username" required
                      class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan username...">
              </div>

              <div>
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <input type="password" name="password" id="password" required
                      class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan password...">
              </div>

              <div class="flex items-center justify-between text-sm">
                  <label class="flex items-center">
                      <input type="checkbox" class="mr-2" name="remember">
                      Remember me
                  </label>
                  <a href="/lupa_password" class="text-blue-600 hover:underline">Lupa password?</a>
              </div>

              <button type="submit"
                  class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                  Login
              </button>
          </form>

          <div class="text-center text-sm text-gray-500">
              Tahap registrasi harus
              <a href="/validasi_awal" class="text-blue-600 hover:underline">Validasi Akun!</a>
          </div>
      </div>
  </div>
</x-layoutAuth>
=======
<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div x-data="{ show: false }" class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

        <button type="button"
            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-600"
            @click="show = !show">
            <i :class="show ? 'bi bi-eye-slash' : 'bi bi-eye'"></i>
        </button>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
>>>>>>> c0e2562 (first commit)
