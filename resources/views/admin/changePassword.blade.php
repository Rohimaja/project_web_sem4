<x-layout>
  <div>
      <x-slot:title>{{ $title }}</x-slot:title>
      <p class="dark:text-white">Ubah Profil dan Password Admin Di Sini</p>

      <div class="mt-5">
          <div class="bg-white shadow-md w-full 
                      dark:bg-gray-800 dark:text-white
                      dark:border dark:border-gray-700
                      rounded-md">

              <form action="{{ route('admin.password.update') }}" method="post">
                  @csrf
                  @method('put')

                  <div class="flex items-center p-4 border-b-2 border-gray-200 dark:border-gray-700">
                      <i class="bi bi-person-lock mr-3"></i>
                      <h2 class="font-bold">Ubah Password</h2>
                  </div>

                  <div class="p-4 border-b-2 border-gray-200 dark:border-gray-700">
                      <div class="mb-4">
                          <div class="flex flex-col">
                              <label class="mb-1 font-bold dark:text-gray-300">Password Sekarang</label>
                              <input 
                                  type="password" 
                                  name="current_password" 
                                  class="p-2 border-2 rounded-sm 
                                         border-gray-400 text-gray-800 
                                         dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600 
                                         focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400"
                                  value="">
                          </div>
                          <span class="text-red-600 text-sm" id="current_password_error">
                              @error('current_password'){{ $message }}@enderror
                          </span>
                      </div>
                  </div>

                  <div class="p-4 border-b-2 border-gray-200 dark:border-gray-700">
                      <div class="mb-4">
                          <div class="flex flex-col">
                              <label class="mb-1 font-bold dark:text-gray-300">Password Baru</label>
                              <input 
                                  type="password" 
                                  name="password" 
                                  class="p-2 border-2 rounded-sm 
                                         border-gray-400 text-gray-800 
                                         dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600
                                         focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400" 
                                  value="">
                          </div>
                          <span class="text-red-600 text-sm" id="password_error">
                              @error('password'){{ $message }}@enderror
                          </span>
                      </div>

                      <div>
                          <div class="flex flex-col">
                              <label class="mb-1 font-bold dark:text-gray-300">Konfirmasi Password</label>
                              <input 
                                  type="password" 
                                  name="password_confirmation" 
                                  class="p-2 border-2 rounded-sm 
                                         border-gray-400 text-gray-800 
                                         dark:bg-gray-700 dark:text-gray-200 dark:border-gray-600
                                         focus:outline-none focus:ring-2 focus:ring-blue-500 dark:focus:ring-blue-400" 
                                  value="">
                          </div>
                          <span class="text-red-600 text-sm" id="password_confirmation_error">
                              @error('password_confirmation'){{ $message }}@enderror
                          </span>
                      </div>
                  </div>

                  <div class="p-4">
                      <button 
                          type="submit"
                          class="flex items-center px-5 py-2.5 text-white 
                                 bg-green-500 hover:bg-green-600 active:bg-green-700 
                                 rounded-sm font-semibold cursor-pointer">
                          Submit
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</x-layout>
