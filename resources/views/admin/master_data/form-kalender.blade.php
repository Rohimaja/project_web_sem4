<x-layout>
    <div class="h-full">
        <x-slot:title>{{ $title ?? 'Form Kalender Akademik' }}</x-slot:title>
        <p>Silahkan tambahkan data Kalender Akademik</p>

        <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">
            <form action="{{ isset($kalender_akademik) ? route('admin.kalender-akademik.update', $kalender_akademik->id) : route('admin.kalender-akademik.store') }}" method="POST">
                @csrf
                @if (isset($kalender_akademik))
                    @method('PUT')
                    <input type="hidden" id="edit_id" value="{{ $kalender_akademik->id }}">
                @endif

                <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Form Kalender Akademik</h1>
                <hr class="my-2 text-gray-600 mb-6">

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="judul" class="mb-1 font-semibold">Judul:</label>
                        <input type="text" class="p-2 mt-1 w-full flex border-2 font-normal border-gray-400 rounded-sm" name="judul" id="judul" value="{{ old('judul', $kalender_akademik->judul ?? '') }}" required>
                        <span class="text-red-600 text-sm" id="judul_error">
                            @error('judul'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="deskripsi" class="mb-1 font-semibold">Deskripsi:</label>
                        <textarea class="p-2 mt-1 w-full border-2 font-normal border-gray-400 rounded-sm" name="deskripsi" id="deskripsi">{{ old('deskripsi', $kalender_akademik->deskripsi ?? '') }}</textarea>
                        <span class="text-red-600 text-sm" id="deskripsi_error">
                            @error('deskripsi'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="tanggal_mulai" class="mb-1 font-semibold">Tanggal Mulai:</label>
                        <input type="date" class="p-2 mt-1 w-full border-2 font-normal border-gray-400 rounded-sm" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai', $kalender_akademik->tanggal_mulai ?? '') }}" required>
                        <span class="text-red-600 text-sm" id="tanggal_mulai_error">
                            @error('tanggal_mulai'){{ $message }}@enderror
                        </span>
                    </div>

                    <!-- Tanggal Selesai -->
                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="tanggal_selesai" class="mb-1 font-semibold">Tanggal Selesai:</label>
                        <input type="date" class="p-2 mt-1 w-full border-2 font-normal border-gray-400 rounded-sm" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai', $kalender_akademik->tanggal_selesai ?? '') }}">
                        <span class="text-red-600 text-sm" id="tanggal_selesai_error">
                            @error('tanggal_selesai'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="w-full flex justify-end mt-7">
                    <a href="{{ route('admin.kalender-akademik.index') }}" class="inline-block px-5 py-2 mr-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">
                        Batal
                    </a>
                    <button class="px-5 py-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
