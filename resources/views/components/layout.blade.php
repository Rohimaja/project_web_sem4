<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{asset('images/stipress.png')}}">
    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>

  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>[x-cloak] { display: none !important; }</style>

</head>
<body class="bg-gray-100">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div x-data="{isSideMenuOpen: false}" @resize.window="if (window.innerWidth >= 1280) isSideMenuOpen = false" class="flex h-screen">
        <x-sidebar></x-sidebar>

        <div class="xl:ml-64 ease-in-out duration-200 flex flex-col flex-1">
            <x-navbar></x-navbar>
            <div x-bind:class="isSideMenuOpen ? 'opacity-70 pointer-events-auto' : 'opacity-0 pointer-events-none'"
                class="fixed inset-0 z-20 bg-gray-600 transition-opacity duration-300"></div>

            <main class="relative mt-16 xl:mt-0 p-6 bg-gray-100">
                <div>
                    <h1 class="font-bold text-gray-800 text-2xl">{{ $title }}</h1>
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>
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


    </script>
{{-- <script src="{{ asset('js/init-alpine.js') }}"></script> --}}
</body>
</html>
