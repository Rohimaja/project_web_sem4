<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  @endif
  <!-- Bootstrap Icons CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<<<<<<< HEAD
</head>
<body>
=======
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

  <style>[x-cloak] { display: none !important; }</style>

</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- @if (session('status') && session('message'))
    <script>
        Swal.fire({
            icon: '{{ session('status') }}',
            title: '{{ ucfirst(session('status')) }}',
            text: '{{ session('message') }}',
            timer: 2500,
            showConfirmButton: false
        });
    </script>
    @endif --}}

>>>>>>> c0e2562 (first commit)
  <div x-data="{isSideMenuOpen: false}" @resize.window="if (window.innerWidth >= 1280) isSideMenuOpen = false" class="flex h-screen">
    <x-sidebar></x-sidebar>

    <div class="xl:ml-64 ease-in-out duration-200 flex flex-col flex-1">
        <x-navbar></x-navbar>

        <main class="relative flex-1 mt-16 xl:mt-0 p-6 bg-gray-100">
          <div x-bind:class="isSideMenuOpen ? 'opacity-70' : 'opacity-0'" class="absolute top-0 left-0 w-full h-full bg-gray-600 pointer-events-none"></div>
          <div>
<<<<<<< HEAD
            <h1 class="font-bold text-gray-600 text-2xl">{{ $title }}</h1>
=======
            <h1 class="font-bold text-gray-800 text-2xl">{{ $title }}</h1>
>>>>>>> c0e2562 (first commit)
            {{ $slot }}
          </div>
        </main>
    </div>
</div>
<<<<<<< HEAD
{{-- <script src="{{ asset('js/init-alpine.js') }}"></script> --}}
</body>
</html>
=======

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('.form-hapus');

        forms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault(); // Jangan langsung submit

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit(); // Baru submit form kalau user tekan "Ya"
                    }
                });
            });
        });

        @if (session('status') && session('message'))
            Swal.fire({
                icon: '{{ session('status') }}',
                title: '{{ ucfirst(session('status')) }}',
                text: '{{ session('message') }}',
                timer: 2000,
                timerProgressBar: true,
                showConfirmButton: false,
                // willClose: () => {
                //     @if (session('redirect'))
                //         window.location.href = '{{ session('redirect') }}';
                //     @endif
                // }
            });
        @endif
    });

    // alamat.js
//     document.addEventListener("DOMContentLoaded", function () {
//     const provinsiSelect = document.getElementById("provinsi");
//     const kotaSelect = document.getElementById("kota");
//     const kecamatanSelect = document.getElementById("kecamatan");
//     const kelurahanSelect = document.getElementById("kelurahan");
//     const alamatHidden = document.getElementById("alamat_final");

//     // Fungsi getWilayah harus didefinisikan terlebih dahulu
//     async function getWilayah(url, selectElement, placeholder = "Pilih...") {
//         const response = await fetch(url);
//         const data = await response.json();
//         selectElement.innerHTML = `<option hidden selected>${placeholder}</option>`;
//         data.forEach((item) => {
//             selectElement.innerHTML += `<option value="${item.id}">${item.name}</option>`;
//         });
//     }

//     // Panggil getWilayah untuk pertama kalinya
//     getWilayah("/api-wilayah/provinces", provinsiSelect, "Pilih Provinsi");

//     // Event listener untuk provinsi
//     provinsiSelect?.addEventListener("change", () => {
//         const idProv = provinsiSelect.value;
//         getWilayah(`/api-wilayah/regencies/${idProv}`, kotaSelect, "Pilih Kota");
//         kecamatanSelect.innerHTML = "";
//         kelurahanSelect.innerHTML = "";
//     });

//     // Event listener untuk kota
//     kotaSelect?.addEventListener("change", () => {
//         const idKota = kotaSelect.value;
//         getWilayah(`/api-wilayah/districts/${idKota}`, kecamatanSelect, "Pilih Kecamatan");
//         kelurahanSelect.innerHTML = "";
//     });

//     // Event listener untuk kecamatan
//     kecamatanSelect?.addEventListener("change", () => {
//         const idKec = kecamatanSelect.value;
//         getWilayah(`/api-wilayah/villages/${idKec}`, kelurahanSelect, "Pilih Kelurahan");
//     });

//     // Event listener untuk kelurahan
//     kelurahanSelect?.addEventListener("change", () => {
//         const prov = provinsiSelect.selectedOptions[0]?.text;
//         const kota = kotaSelect.selectedOptions[0]?.text;
//         const kec = kecamatanSelect.selectedOptions[0]?.text;
//         const kel = kelurahanSelect.selectedOptions[0]?.text;

//         const alamat = `${kel}, ${kec}, ${kota}, ${prov}`;
//         if (alamatHidden) alamatHidden.value = alamat;
//     });
// });


    </script>
{{-- <script src="{{ asset('js/init-alpine.js') }}"></script> --}}
</body>
</html>
>>>>>>> c0e2562 (first commit)
