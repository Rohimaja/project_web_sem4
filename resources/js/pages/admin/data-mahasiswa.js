const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

$(document).ready(function () {
    const table = $("#data-mahasiswa").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });

    // function getMahasiswaFiltered() {
    // $(document).ready(function () {
    $("#prodi, #semester").on("change", function () {
        const prodiId = $("#prodi").val();
        const semester = $("#semester").val();
        // const semester = document.getElementById("semester").value; // Ambil semester yang dipilih
        // const prodiId = document.getElementById("prodi").value; // Ambil prodi yang dipilih

        // Pastikan salah satu filter dipilih untuk menghindari request kosong
        if (semester || prodiId) {
            // Buat URL untuk mengirim filter sebagai parameter query
            fetch(
                `/admin/getFilterMahasiswa?prodi=${prodiId}&semester=${semester}`
            )
                .then((response) => response.json())
                .then((data) => {
                    // Hapus data sebelumnya dari DataTable
                    table.clear();

                    // Tambahkan data yang baru dari hasil filter
                    data.forEach((item, index) => {
                        const fotoUrl = item.foto
                            ? `/storage/${item.foto}`
                            : "/images/profil-kosong.png";

                        table.row.add([
                            `<div style="text-align:left;">${index + 1}</div>`, // Semester ditengah
                            `<div class="w-10 h-10 bg-red-200 rounded-full overflow-hidden">
                                <img src="${fotoUrl}" alt="Photo" class="w-full h-full object-cover">
                            </div>`,
                            // `<div style="text-align:left;">${item.nim}</div>`, // Semester ditengah
                            // `<div style="text-align:left;">${item.nama}</div>`, // Semester ditengah
                            // `<div style="text-align:left;">${
                            //     item.rfid ? item.rfid : "-"
                            // }</div>`, // Semester ditengah
                            item.nim,
                            item.nama,
                            item.jenis_kelamin,
                            item.email,
                            `${item.prodi?.jenjang ?? ""} ${
                                item.prodi?.nama_prodi ?? ""
                            }` || "-",
                            item.semester,
                            `<div class="flex gap-2 justify-center">
                                <button @click="openView = true; $nextTick(() => loadMahasiswaDetail(${item.id}))"
                                        class="cursor-pointer px-2 py-1 bg-gray-600 hover:bg-gray-700 active:bg-gray-800 text-white rounded-md">
                                    <i class="bi bi-eye text-lg"></i>
                                </button>
                                <a href="/admin/master-mahasiswa/${item.id}/edit" class="cursor-pointer px-2 py-1 bg-yellow-600 hover:bg-yellow-700 active:bg-yellow-800 text-white rounded-md">
                                    <i class="bi bi-pencil-square text-lg"></i>
                                </a>
                                <form action="/admin/master-mahasiswa/${item.id}" method="POST" class="form-hapus inline-block">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="px-2 py-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-md">
                                        <i class="bi bi-trash text-lg"></i>
                                    </button>
                                </form>
                              </div>`,
                        ]);
                    });

                    // Perbarui tampilan tabel setelah menambahkan data
                    table.draw();
                })
                .catch((error) => console.error("Error fetching data:", error));
        }
    });
});

// $(document).on("click", ".btn-detail", function () {
//     const id = $(this).data("id");

//     // Tampilkan modal detail (Alpine.js atau manual)
//     if (typeof openView !== "undefined") {
//         openView = true;
//     }

//     // Panggil fungsi untuk ambil detail mahasiswa
//     loadMahasiswaDetail(id);
// });

window.loadMahasiswaDetail = function (id) {
    $.ajax({
        url: "/admin/master-mahasiswa/" + id,
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
            $("#nim").val(res.nim);
            $("#rfid").val(res.rfid);
            $("#jenis_kelamin").val(res.jenis_kelamin);
            $("#agama").val(res.agama);
            $("#tempat_lahir").val(res.tempat_lahir);
            $("#tgl_lahir").val(res.tgl_lahir);
            $("#email").val(res.email);
            $("#no_telp").val(res.no_telp);
            $("#alamat").val(res.alamat);
            $("#prodi-mahasiswa").val(
                res.prodi.jenjang + " " + res.prodi.nama_prodi
            );
            $("#no_telp").val(res.no_telp);
            $("#tahun_masuk").val(res.tahun_masuk);
            $("#semester-mahasiswa").val(res.semester);
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
