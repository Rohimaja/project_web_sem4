<x-layout>
    @vite(['resources/js/pages/admin/data-jadwal.js'])
    <div class="h-full">
        <x-slot:title>{{ $title }}</x-slot:title>
        <p>Silahkan tambahkan data Admin</p>
        <div class="w-full h-max max-w-full mt-5 p-8 bg-gray-150 rounded-sm shadow-xl">

            <form action="{{route('admin.master-jadwal.store')}}" method="POST" class="form-presensi">
            @csrf

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label class="mb-1 font-semibold">Pilih Dosen:</label>
                        <select id="dosen" name="dosen_id" required>
                            <option value="" hidden selected>Pilih Dosen</option>
                            @foreach ($dosen as $d)
                                <option value="{{ $d->id }}" {{ old('dosen_id') == $d->id ? 'selected' : '' }}>
                                    {{ $d->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('dosen_id')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label class="mb-1 font-semibold">Pilih Program Studi:</label>
                        <select id="prodi" name="prodi_id" class="w-full" required>
                            <option value="" hidden selected>Pilih Program Studi</option>
                            @foreach ($prodi as $p)
                                <option value="{{ $p->id }}" {{ old('prodi_id') == $p->id ? 'selected' : '' }}>
                                    {{ $p->jenjang.' '.$p->nama_prodi }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-red-600 text-sm" id="prodi_id_error">
                            @error('prodi_id'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label class="mb-1 font-semibold">Pilih Matkul:</label>
                        <select id="matkul" name="matkul_id"  class="w-full" required>
                            <option value="" hidden selected>Pilih Matkul</option>
                        </select>
                        <span class="text-red-600 text-sm" id="matkul_id_error">
                            @error('matkul_id'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0">
                        <label class="mb-1 font-semibold">Pilih Semester:</label>
                        <select id="semester" name="semester" class="w-full" required >
                            <option value="" hidden selected>Pilih Senester</option>
                                @for($i = 1; $i <= 14; $i++)
                                    {{-- <option value="{{ $i }}"> --}}
                                    <option value="{{ $i }}" {{ old('semester') == $i ? 'selected' : '' }}>
                                        Semester {{$i}}
                                    </option>
                                @endfor
                        </select>
                        <span class="text-red-600 text-sm" id="semester_error">
                            @error('semester'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label class="mb-1 font-semibold">Pilih Ruangan:</label>
                        <select id="ruangan" name="ruangan_id" class="w-full" required>
                            <option value="" hidden selected>Pilih Ruangan</option>
                            @foreach ($ruangan as $r)
                                <option value="{{ $r->id }}" {{ old('ruangan_id') == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ruangan }}
                                </option>
                            @endforeach
                        </select>
                        <span class="text-red-600 text-sm" id="ruangan_id_error">
                            @error('ruangan_id'){{ $message }}@enderror
                        </span>
                    </div>

                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label class="mb-1 font-semibold">Pilih Hari:</label>
                        <select id="hari" name="hari" class="w-full" required>
                            <option value="" hidden selected>Pilih Hari</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                        <span class="text-red-600 text-sm" id="hari_error">
                            @error('hari'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
                        <label for="" class="mb-1 font-semibold">Durasi</label>
                        <input type="number" name="durasi" value="{{old('durasi')}}" class="p-2 w-full border-2 border-gray-400 rounded-sm" placeholder="Masukkan Durasi Perkuliahan" required>
                        <span class="text-red-600 text-sm" id="durasi_error">
                            @error('durasi'){{ $message }}@enderror
                        </span>
                    </div>
                    <div class="flex flex-col w-full mb-4 md:w-1/2">
                        <label for="" class="mb-1 font-semibold">Jam Jadwal</label>
                        <input type="time" name="jam" value="{{old('jam')}}" class="p-2 w-full border-2 border-gray-400 rounded-sm" placeholder="Masukkan Jam Awal" required>
                        <span class="text-red-600 text-sm" id="jam_error">
                            @error('jam'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="w-full flex justify-end">
                    <a href="{{route('admin.master-jadwal.index')}}" class="px-5 py-2 mr-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
