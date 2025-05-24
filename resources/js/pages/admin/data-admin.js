$(document).ready(function () {
    table = $("#data-admin").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });
    // $("div.dt-search").hide();
});

window.loadAdminDetail = function (id) {
    $.ajax({
        url: "/admin/master-admin/" + id,
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
            $("#jenis_kelamin").val(res.jenis_kelamin);
            $("#agama").val(res.agama);
            $("#tempat_lahir").val(res.tempat_lahir);
            $("#tgl_lahir").val(res.tgl_lahir);
            $("#email").val(res.email);
            $("#no_telp").val(res.no_telp);
            $("#alamat").val(res.alamat);
            $("#no_telp").val(res.no_telp);
            $("#provinsi").val(res.province.name);
            $("#kota").val(res.regency.name);
            $("#kecamatan").val(res.district.name);
            $("#kelurahan").val(res.village.name);
            // Tambah field lainnya sesuai response JSON
        },
        error: function () {
            alert("Gagal mengambil data dosen");
        },
    });
};
