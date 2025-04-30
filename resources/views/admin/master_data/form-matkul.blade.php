<x-layout>
  <div class="h-full">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Silahkan tambahkan data Mata Kuliah</p>
    <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">

        <form action="{{ isset($matkul) ? route('admin.master-matkul.update', $matkul->id) : route('admin.master-matkul.store') }}" method="POST">
            @csrf
            @if (isset($matkul))
                @method('PUT')
            @endif

        <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Informasi Umum</h1>
        <hr class="my-2 text-gray-600 mb-6">

        <div class="flex flex-col md:flex-row">
          {{-- <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Kode Mata Kuliah:</label>
            <input type="number" min="2000" max="2099" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan kode mata kuliah">
          </div> --}}
          <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">Nama Mata Kuliah:</label>
            <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="nama_matkul" id="nama_matkul" value="{{old('nama_matkul', $matkul->nama_matkul ?? '')}}" placeholder="Masukkan nama mata kuliah">
          </div>

          <div class="flex flex-col w-full mb-4 md:w-1/2">
            <label for="" class="mb-1 font-semibold">Program Studi:</lab>
            <select class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="prodi_id" id="prodi_id">
              <option value="" hidden selected>Pilih Program Studi</option>
              @foreach ($prodi as $p)
              <option value="{{ $p->id }}" @if (old('prodi_id', $matkul->prodi_id ?? '') == $p->id) selected @endif>
                {{ $p->nama_prodi }}
              </option>
            @endforeach
            </select>
          </div>
        </div>

        <div class="flex flex-col md:flex-row">
            <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                <label for="" class="mb-1 font-semibold">Tahun Ajaran:</lab>
                <select class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="tahun_ajaran_id" id="tahun_ajaran_id">
                  <option value="" hidden selected>Pilih Tahun Ajaran</option>
                  @foreach ($tahun as $t)
                  <option value="{{ $t->id }}" @if (old('tahun_ajaran_id', $matkul->tahun_ajaran_id ?? '') == $t->id) selected @endif>
                    {{ $t->tahun_awal. '/'. $t->tahun_akhir. ' '. $t->keterangan }}
                </option>
                @endforeach
                </select>
              </div>

            <div class="flex flex-col w-full mb-4 md:w-1/2">
                <label for="" class="mb-1 font-semibold">Semester:</lab>
                <select class="p-2 mt-1 py-[10.5px] w-full flex border-2 font-normal border-gray-700 rounded-sm" name="semester" id="semester">
                  <option value="" hidden selected>Pilih Semester</option>
                  @for($i = 1; $i <= 8; $i++)
                  <option value="{{ $i }}" @if (old('semester', $matkul->semester ?? '') == $i) selected @endif>
                    Semester {{$i}}
                    </option>
                @endfor
                </select>
              </div>

          {{-- <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
            <label for="" class="mb-1 font-semibold">SKS:</label>
            <input type="number" min="2000" max="2099" class="p-2 border-2 border-gray-700 rounded-sm" placeholder="Masukkan jumlah SKS">
          </div> --}}

        </div>

        <div class="flex flex-col md:flex-row">
            <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                <label for="" class="mb-1 font-semibold">SKS:</label>
                <input type="text" class="p-2 border-2 border-gray-700 rounded-sm" name="durasi_matkul" id="durasi_matkul" value="{{old('durasi_matkul', $matkul->durasi_matkul ?? '')}}" placeholder="Masukkan jumlah SKS">
              </div>
          <div class="flex flex-col w-full mb-4 md:w-1/2">

          </div>
        </div>
        <div class="justify-end">
            <button class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
            <a href="{{route('admin.master-matkul.index')}}" class="px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">
                Batal
            </a>
        </div>
    </form>
    </div>
  </div>
</x-layout>
