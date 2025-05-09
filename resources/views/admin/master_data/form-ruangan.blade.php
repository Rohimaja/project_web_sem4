<x-layout>
    <div class="h-full">
    <x-slot:title>{{ $title }}</x-slot:title>
    <p>Silahkan tambahkan data Program Studi</p>
        <div class="w-full h-max max-w-full mt-5 p-8 bg-white rounded-sm shadow-xl">

            <form action="{{ isset($ruangan) ? route('admin.master-ruangan.update', $ruangan->id) : route('admin.master-ruangan.store') }}" method="POST">
            @csrf
            @if (isset($ruangan))
                @method('PUT')
                <input type="hidden" id="edit_id" value="{{ $ruangan->id }}">
            @endif

            <h1 class="font-bold text-gray-800 text-2xl mb-2 text-center xl:text-left">Informasi Umum</h1>
            <hr class="my-2 text-gray-600 mb-6">

                <div class="flex flex-col md:flex-row">
                    <div class="flex flex-col w-full mb-4 md:w-1/2 mr-8">
                        <label for="" class="mb-1 font-semibold">Nama Ruangan:</lab>
                        <input type="text" class="p-2 mt-1 w-full flex border-2 font-normal border-gray-700 rounded-sm" name="nama_ruangan" id="nama_ruangan" value="{{old('nama_ruangan', $ruangan->nama_ruangan ?? '')}}" required data-validate="ruangan" >
                        <span class="text-red-600 text-sm" id="nama_ruangan_error">
                            @error('nama_ruangan'){{ $message }}@enderror
                        </span>
                    </div>
                    <div class="flex flex-col w-full mb-4 md:w-1/2"></div>
                </div>
                <div>
                    <button class="px-5 py-2 mr-2 bg-green-600 hover:bg-green-700 active:bg-green-800 text-white rounded-md font-semibold cursor-pointer">Submit</button>
                    <a href="{{ route('admin.master-ruangan.index') }}" class="inline-block px-5 py-2 bg-red-500 hover:bg-red-600 active:bg-red-700 text-white font-semibold rounded-md cursor-pointer">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
