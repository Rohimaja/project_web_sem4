<x-layoutAuth title="Login">
  <div class="flex min-h-screen items-center justify-center bg-gradient-to-br from-gray-100 to-gray-100 px-4">
      <div class="w-full max-w-md bg-white shadow-xl rounded-2xl p-8 space-y-6">
          <div class="w-full flex justify-center">
            <img src="{{ asset('images/stipress.png') }}" alt="Logo Aplikasi" class="h-24">
          </div>

          <div class="text-center">
            <h1 class="text-2xl font-bold text-gray-800">Validasi NIM Mahasiswa</h1>
            <p class="text-sm text-gray-500 mt-1">Silahkan masukkan nim & token</p>
          </div>

          <form method="POST" class="space-y-5">
              @csrf

              <div>
                  <label for="nim" class="block text-sm font-medium text-gray-700">User ID (NIM)</label>
                  <input type="text" name="nim" id="nim" required
                      class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan nim...">
              </div>

              <div>
                  <label for="token" class="block text-sm font-medium text-gray-700">Token</label>
                  <input type="password" name="token" id="token" required
                      class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan token...">
              </div>

              <button type="submit"
                  class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-300">
                  <a href="/register">Submit</a>
              </button>
          </form>

          <div class="text-center text-sm text-gray-500">
              Sudah memiliki akun?
              <a href="/login" class="text-blue-600 hover:underline">Login</a>
          </div>
      </div>
  </div>
</x-layoutAuth>
