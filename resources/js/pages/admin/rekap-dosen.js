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
    const table = $("#data-rekap-dosen").DataTable({
        scrollX: true,

        searching: false, // Aktifkan pencarian
        paging: false, // Aktifkan pagination
        info: false, // Menampilkan informasi tabel
        language: {
            emptyTable: "Belum ada data presensi ditampilkan.",
        },
        scrollX: false, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });

    $("#tahun-ajaran").on("change", function () {
        const tahunId = $(this).val();

        if (tahunId) {
            fetch(`/dosen/getFilterRekap?tahun_ajaran=${tahunId}`)
                .then((response) => response.json())
                .then((data) => {
                    table.clear(); // Kosongkan isi DataTable

                    data.rekap.forEach((item, index) => {
                        const row = [
                            index + 1,
                            item.nama_prodi,
                            item.semester,
                            item.nama_matkul,
                        ];

                        for (let i = 0; i < data.totalPertemuan; i++) {
                            const tanggal = item.tanggal_pertemuan[i] ?? null;
                            const status = tanggal ? "M" : "-";

                            const bgClass =
                                status === "M"
                                    ? "bg-green-500 text-white"
                                    : "bg-gray-500 text-white";

                            const cell = `<div class="border border-gray-300 px-4 py-2 font-semibold ${bgClass}" title="${
                                tanggal ?? ""
                            }">${status}</div>`;
                            row.push(cell);
                        }

                        row.push(item.total_pertemuan);
                        table.row.add(row);
                    });

                    table.draw(); // Refresh tampilan
                })
                .catch((error) => console.error("Gagal ambil data:", error));
        }
    });

    $("div.dt-buttons").hide();

    document.querySelector("#btn-pdf").addEventListener("click", function () {
        table.button(".dt-btn-pdf").trigger();
    });
});

// $("#tahun-ajaran").on("change", function () {
//     const tahunId = $("#tahun-ajaran").val();
//     // const semester = document.getElementById("semester").value; // Ambil semester yang dipilih
//     // const prodiId = document.getElementById("prodi").value; // Ambil prodi yang dipilih

//     // Pastikan salah satu filter dipilih untuk menghindari request kosong
//     if (tahunId) {
//         // Buat URL untuk mengirim filter sebagai parameter query
//         fetch(`/dosen/getFilterRekap?tahun_ajaran=${tahunId}`)
//             .then((response) => response.json())
//             .then((data) => {
//                 // Hapus data sebelumnya dari DataTable
//                 table.clear();

//                 // Tambahkan data yang baru dari hasil filter
//                 data.forEach((item, index) => {
//                     table.row.add([
//                         `<div style="text-align:center;">${index + 1}</div>`, // Semester ditengah
//                         item.nama_prodi,
//                         item.semester,
//                         item.nama_matkul,
//                         `${item.prodi?.jenjang ?? ""} ${
//                             item.prodi?.nama_prodi ?? ""
//                         }` || "-",

//                         // item.prodi?.jenjang & item.prodi?.nama_prodi ?? "-",
//                         // `<div style="text-align:center;">${item.semester}</div>`, // Semester ditengah
//                     ]);
//                 });

//                 // Perbarui tampilan tabel setelah menambahkan data
//                 table.draw();
//             })
//             .catch((error) => console.error("Error fetching data:", error));
//     }
// });

// $("#tahun-ajaran").on("change", function () {
//     const tahunId = $(this).val();

//     if (tahunId) {
//         fetch(`/dosen/getFilterRekap?tahun_ajaran=${tahunId}`)
//             .then((response) => response.json())
//             .then((data) => {
//                 table.clear(); // Kosongkan isi DataTable

//                 data.rekap.forEach((item, index) => {
//                     // Buat array kolom awal
//                     console.log(data.rekap);
//                     const row = [
//                         index + 1,
//                         item.nama_prodi,
//                         item.semester,
//                         item.nama_matkul,
//                     ];

//                     // Loop total pertemuan dan isi 'M' atau '-'
//                     for (let i = 0; i < data.totalPertemuan; i++) {
//                         const tanggal = item.tanggal_pertemuan[i] ?? null;
//                         const status = tanggal ? "M" : "-";
//                         const cell = `<span title="${
//                             tanggal ?? ""
//                         }">${status}</span>`;
//                         row.push(cell);
//                     }

//                     row.push(item.total_pertemuan);

//                     table.row.add(row);
//                 });

//                 table.draw(); // Refresh tampilan
//             })
//             .catch((error) => console.error("Gagal ambil data:", error));
//     }
// });
