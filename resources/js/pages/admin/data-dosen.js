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

// function openModal(id) {
//     fetch(`admin/master/${id}`)
//         .then((response) => response.json())
//         .then((result) => {
//             document.querySelector("[x-data]").__x.$data.data = result;
//             document.querySelector("[x-data]").__x.$data.showModal = true;
//         })
//         .catch((err) => alert("Gagal mengambil data."));
// }

// function loadDosenDetail(button) {
//     const id = $(button).data("id");
//     $.ajax({
//         url: "/admin/master/" + id,
//         method: "GET",
//         success: function (res) {
//             $("#dosen-nama").text(res.nama);
//             $("#dosen-nip").text(res.nip);
//             $("#dosen-email").text(res.email);
//             $("#dosen-prodi").text(res.prodi.nama_prodi);
//             // Tambah field lainnya sesuai kebutuhan
//         },
//         error: function () {
//             alert("Gagal memuat data dosen.");
//         },
//     });
// }

window.loadDosenDetail = function (id) {
    $.ajax({
        url: "/admin/master-dosen/" + id,
        method: "GET",
        success: function (res) {
            console.log(res);

            // Isi konten modal
            if (res.foto) {
                $("#foto").attr("src", "/storage/" + res.foto);
            } else {
                $("#foto").attr("src", "/images/profil-kosong.png");
            }
            $("#nama").val(res.nama);
            $("#nip").val(res.nip);
            $("#jenis_kelamin").val(res.jenis_kelamin);
            $("#agama").val(res.agama);
            $("#tempat_lahir").val(res.tempat_lahir);
            $("#tgl_lahir").val(res.tgl_lahir);
            $("#email").val(res.email);
            $("#no_telp").val(res.no_telp);
            $("#alamat").val(res.alamat);
            $("#prodi").val(res.prodi.jenjang + " " + res.prodi.nama_prodi);
            $("#no_telp").val(res.no_telp);
            $("#provinsi").val(res.provinsi.name);
            $("#kota").val(res.kota.name);
            $("#kecamatan").val(res.kecamatan.name);
            $("#kelurahan").val(res.kelurahan.name);
            // Tambah field lainnya sesuai response JSON
        },
        error: function () {
            alert("Gagal mengambil data dosen");
        },
    });
};
