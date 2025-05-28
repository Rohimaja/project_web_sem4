$(document).ready(function () {
    const table = $("#data-jadwal").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });

    $("#tahun-ajaran").on("change", function () {
        const tahunId = $("#tahun-ajaran").val();

        if (tahunId) {
            // Buat URL untuk mengirim filter sebagai parameter query
            fetch(`/mahasiswa/getFilterJadwal?tahun_ajaran=${tahunId}`)
                .then((response) => response.json())
                .then((data) => {
                    // Hapus data sebelumnya dari DataTable
                    table.clear();

                    // Tambahkan data yang baru dari hasil filter
                    data.forEach((item, index) => {
                        table.row.add([
                            // `<div style="text-align:left;">${item.nim}</div>`, // Semester ditengah
                            // `<div style="text-align:left;">${item.nama}</div>`, // Semester ditengah
                            // `<div style="text-align:left;">${
                            //     item.rfid ? item.rfid : "-"
                            // }</div>`, // Semester ditengah
                            item.hari,
                            item.jam,
                            item.durasi + " SKS",
                            `${item.matkul?.nama_matkul ?? ""}`,
                            item.dosen?.nama ?? "",
                            `${item.prodi?.jenjang ?? ""} ${
                                item.prodi?.nama_prodi ?? ""
                            }` || "-",
                            `${item.ruangan?.nama_ruangan ?? ""}`,
                        ]);
                    });

                    // Perbarui tampilan tabel setelah menambahkan data
                    table.draw();
                })
                .catch((error) => console.error("Error fetching data:", error));
        }
    });
});
