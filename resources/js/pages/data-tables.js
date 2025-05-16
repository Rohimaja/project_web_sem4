$(document).ready(function () {
    table = $("#data-admin").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });
    $("div.dt-search").hide();
});

$(document).ready(function () {
    table = $("#data-dosen").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });
    $("div.dt-search").hide();
});

$(document).ready(function () {
    table = $("#data-mahasiswa").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });
    $("div.dt-search").hide();
});

$(document).ready(function () {
    table = $("#data-tahun").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });
    $("div.dt-search").hide();
});

$(document).ready(function () {
    table = $("#data-matkul").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });
    $("div.dt-search").hide();
});

$(document).ready(function () {
    table = $("#data-prodi").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });
    //sembunyikan filter input bawaan
    $("div.dt-search").hide();
});

$(document).ready(function () {
    table = $("#data-ruangan").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });
    //sembunyikan filter input bawaan
    $("div.dt-search").hide();
});
