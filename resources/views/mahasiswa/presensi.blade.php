<x-layout>
    @vite(['resources/js/pages/admin/data-presensi.js'])

    <x-slot:title>Presensi Mahasiswa</x-slot:title>

    <div class="h-[680px]">
        <p class=" text-gray-800 dark:text-gray-200 mb-4">Presensi Hari Ini : <span class="text-md text-gray-800 dark:text-white">
            {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
          </span></p>

        <div class="w-full overflow-x-auto max-w-full mt-5 p-5 bg-white dark:bg-gray-800 rounded-sm shadow-xl h-full">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 h-full">
                
                <!-- Kolom Kiri: Status Presensi -->
                <div class="bg-gray-200 dark:bg-[#1e293b] rounded-md p-6 shadow-md flex flex-col items-center justify-center text-center h-full">
                    
                    {{-- sudah presensi --}}
                    <div class="flex flex-col items-center">
                        <div class="p-6 rounded-full bg-blue-300 dark:bg-blue-900 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8h2a2 2 0 012 2v9a2 2 0 01-2 2h-2m-6 0H7a2 2 0 01-2-2v-9a2 2 0 012-2h4m0-4h4a2 2 0 012 2v4H9V6a2 2 0 012-2z" />
                            </svg>
                        </div>
                        <p class="text-lg font-semibold text-green-600 dark:text-green-400">✅ Presensi Tercatat</p>
                        <p class="mt-2 text-gray-800 dark:text-gray-200 font-medium">Workshop Web Framework</p>
                        <p class="text-gray-600 dark:text-gray-400">Ruangan: TI 3.6</p>
                        <p class="text-gray-600 dark:text-gray-400">Jam Kuliah: 08.00 - 10.00</p>
                        <p class="text-gray-600 dark:text-gray-400 font-semibold">Waktu Presensi: 08.03 WIB</p>
                    </div>

                    {{-- belum presensi --}}
                    {{-- <div class="text-center text-gray-600 dark:text-gray-400">
                        <p class="text-4xl mb-2">🕓</p>
                        <p class="text-lg font-semibold">Belum Melakukan Presensi</p>
                        <p class="text-sm">Silakan tap kartu RFID Anda</p>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Jadwal Anda hari ini: Workshop Web Framework (08.00 - 10.00)</p>
                    </div>
                    --}}

                    {{-- tidak ada jadwal --}}
                    {{-- <div class="text-center text-gray-600 dark:text-gray-400">
                        <p class="text-4xl mb-2">📭</p>
                        <p class="text-lg font-semibold">Tidak Ada Jadwal Hari Ini</p>
                        <p class="text-sm">Selamat beristirahat, tidak ada kelas terjadwal untuk Anda.</p>
                    </div> --}}
                   
                </div>

                <div class="bg-gray-200 dark:bg-[#1e293b] rounded-md p-6 shadow-md h-full flex flex-col">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Riwayat Presensi</h2>

                    <div class="flex-1 space-y-4 max-h-[400px] overflow-y-auto pr-2">

                        <div class="bg-gradient-to-r from-white to-gray-100 dark:from-gray-800 dark:to-gray-700 p-4 rounded-lg shadow-lg border border-gray-200 dark:border-gray-600 transition hover:shadow-xl">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-bold text-gray-800 dark:text-gray-100">21 Mei 2025</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Workshop Web Framework</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Jam Kuliah: 08.00 - 10.00</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-300">Presensi Masuk: 08.03 WIB</p>
                                </div>
                                <div class="text-green-600 dark:text-green-400 font-semibold text-sm">✅ Hadir</div>
                            </div>
                        </div>
                        


                        <!-- tidak ada riwayat -->
                        {{--
                        <div class="text-center text-gray-600 dark:text-gray-400 mt-10">
                            <p class="text-3xl mb-2">📭</p>
                            <p class="text-lg font-semibold">Belum Ada Riwayat Presensi</p>
                            <p class="text-sm">Riwayat presensi akan muncul setelah Anda melakukan presensi.</p>
                        </div>
                        --}}
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-layout>
