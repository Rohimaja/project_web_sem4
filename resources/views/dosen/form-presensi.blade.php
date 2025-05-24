<x-layout>
    @vite(['resources/js/pages/admin/data-presensi.js'])
    <div class="h-full">
        <x-slot:title>{{ $title }}</x-slot:title>
        <p>Silahkan tambahkan data Admin</p>
        <div class="w-full h-max max-w-full mt-5 p-8 bg-gray-150 rounded-sm shadow-xl">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{route('dosen.presensi.store')}}" method="POST" class="form-presensi">
            @csrf

                <div class="flex flex-col md:flex-row">

                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 md:mr-8">
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

                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-0 ">
                        <label class="mb-1 font-semibold">Pilih Matkul:</label>
                        <select id="matkul" name="matkul_id"  class="w-full" required>
                            <option value="" hidden selected>Pilih Matkul</option>
                        </select>
                        <span class="text-red-600 text-sm" id="matkul_id_error">
                            @error('matkul_id'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row">

                    <div class="flex flex-col w-full mb-4 md:w-1/3 mr-0 md:mr-4">
                        <label for="" class="mb-1 font-semibold">Pilih Tanggal:</label>
                        <input type="date" name="tgl_presensi" class="p-2 border-2 border-gray-400 rounded-sm" value="{{old('tgl_presensi')}}" placeholder="Masukkan tanggal presensi" required>
                    </div>
                    <span class="text-red-600 text-sm" id="tgl_presensi_error">
                        @error('tgl_presensi'){{ $message }}@enderror
                    </span>

                    <div class="flex flex-col w-full mb-4 md:w-1/3 mr-0 md:mr-4">
                        <label for="" class="mb-1 font-semibold">Jam Awal:</label>
                        <input type="time" name="jam_awal" value="{{old('jam_awal')}}" class="p-2 w-full border-2 border-gray-400 rounded-sm" placeholder="Masukkan Jam Awal" required>
                        <span class="text-red-600 text-sm" id="jam_awal_error">
                            @error('jam_awal'){{ $message }}@enderror
                        </span>
                    </div>
                    <div class="flex flex-col w-full mb-4 md:w-1/3">
                        <label for="" class="mb-1 font-semibold">Jam Akhir:</label>
                        <input type="time" name="jam_akhir" value="{{old('jam_akhir')}}" class="p-2 w-full border-2 border-gray-400 rounded-sm" placeholder="Masukkan Jam Akhir" required>
                        <span class="text-red-600 text-sm" id="jam_akhir_error">
                            @error('jam_akhir'){{ $message }}@enderror
                        </span>
                    </div>
                </div>

                <div class="w-full flex justify-end">
                    <a href="{{route('dosen.presensi.index')}}" class="px-5 py-2 mr-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">
                        Batal
                    </a>
                    <button type="submit" class="px-5 py-2  bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
