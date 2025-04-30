<<<<<<< HEAD
<x-layoutAuth title="Login">
  <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-gray-100 to-gray-100 px-4">
      <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8 space-y-6">
          <div class="w-full flex justify-center">
            <img src="{{ asset('images/stipress.png') }}" alt="Logo Aplikasi" class="h-24">
          </div>

          <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800">Registrasi Password</h1>
            <p class="text-sm text-gray-500 mt-1">Silahkan masukkan password</p>
          </div>

          <form method="POST" class="space-y-5">
              @csrf

              <div>
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <input type="password" name="password" id="password" required
                      class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan password...">
              </div>

              <div>
                  <label for="konfirmasi_password" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                  <input type="password" name="konfirmasi_password" id="konfirmasi_password" required
                      class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan konfirmasi password...">
              </div>

              <button type="submit"
                  class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                  <a href="/login">Submit</a>
              </button>
          </form>

          <div class="text-center text-sm text-gray-500">
              Sudah memiliki akun?
              <a href="/validasi_awal" class="text-blue-600 hover:underline">Login</a>
          </div>
      </div>
  </div>
</x-layoutAuth>
=======
<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
>>>>>>> c0e2562 (first commit)
