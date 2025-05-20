$("#dosen").select2({
    placeholder: "Cari Dosen",
    width: "100%", // agar lebar mengikuti class seperti w-full
    allowClear: true,
});

$("#tahun-ajaran").select2({
    placeholder: "Cari Tahun Ajaran",
    width: "100%", // agar lebar mengikuti class seperti w-full
    allowClear: true,
});

$(document).ready(function () {
    table = $("#data-rekap-dosen").DataTable({
        searching: false, // Aktifkan pencarian
        paging: false, // Aktifkan pagination
        info: false, // Menampilkan informasi tabel
        language: {
            emptyTable: "Belum ada data presensi ditampilkan.",
        },
        scrollX: false, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });
});
