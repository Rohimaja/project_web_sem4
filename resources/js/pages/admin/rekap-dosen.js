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

        createdRow: function (row, data, dataIndex) {
            $("td", row).addClass(
                "border border-gray-300 dark:border-gray-800 px-2 py-1"
            );
        },
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
                                    ? "text-green-500"
                                    : "text-gray-500";

                            const cell = `<div class="font-semibold ${bgClass}" title="${
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
});
