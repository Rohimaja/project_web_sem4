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
    let table = $("#data-rekap-dosen").DataTable({
        dom: "Bfrtip",
        buttons: [
            {
                extend: "pdfHtml5",
                title: "REKAP KEHADIRAN DOSEN",
                text: "Export ke PDF",
                className: "dt-btn-pdf", // Tambahkan className
                orientation: "landscape",
                pageSize: "A4",
                customize: function (doc) {
                    // Menambahkan informasi mahasiswa dan informasi pencetakan
                    doc.content.unshift({
                        columns: [
                            {
                                text: [
                                    {
                                        text: "NIP Dosen  : " + nipDosen + "\n",
                                        lineHeight: 1,
                                    },
                                    {
                                        text:
                                            "Nama Dosen  : " + namaDosen + "\n",
                                        lineHeight: 1,
                                    },
                                ],
                                fontSize: 10, // Ukuran font lebih kecil
                                alignment: "left",
                                margin: [0, 0],
                            },
                        ],
                        margin: [0, 0, 0, 15], // Margin yang lebih kecil
                    });

                    doc.footer = function (currentPage, pageCount) {
                        return {
                            columns: [
                                {
                                    text: "M = Mengajar\n - = Tidak terselenggara perkuliahan", // Keterangan status kehadiran
                                    alignment: "left",
                                    fontSize: 10,
                                    margin: [45, 10],
                                },
                                {
                                    text:
                                        "Page " +
                                        currentPage +
                                        " of " +
                                        pageCount +
                                        " | Exported on: " +
                                        new Date().toLocaleString(),
                                    alignment: "right",
                                    fontSize: 10,
                                    margin: [45, 10],
                                },
                            ],
                        };
                    };

                    // Tambahkan gaya untuk tabel
                    var table = doc.content[2].table; // Mengakses tabel yang diekspor
                    table.widths = Array(table.body[0].length).fill("auto"); // Mengatur lebar kolom agar otomatis
                    table.body.forEach(function (row, rowIndex) {
                        row.forEach(function (cell) {
                            cell.border = [true, true, true, true]; // Menambahkan border ke setiap sel
                            // cell.fillColor =
                            //     rowIndex % 2 === 0 ? "#f2f2f2" : null; // Menambahkan warna latar belakang untuk baris genap
                            if (rowIndex === 0) {
                                cell.fillColor = "#dce6f1"; // Biru muda untuk header
                                cell.color = "#000"; // Pastikan teks hitam agar terlihat
                                cell.bold = true; // Tebalkan teks header
                                cell.alignment = "center";
                            } else {
                                cell.fillColor =
                                    rowIndex % 2 === 0 ? "#f2f2f2" : null; // Warna latar baris data
                            }
                            cell.margin = [1, 1, 1, 1]; // Mengatur margin sel ke 0
                            cell.padding = [1, 1, 1, 1]; // Mengatur padding sel untuk mengurangi jarak di dalam sel
                            cell.fontSize = 9; // Ukuran font lebih kecil untuk sel
                        });
                    });

                    // Menambahkan border untuk tabel secara keseluruhan
                    doc.content[2].layout = {
                        hLineWidth: function (i) {
                            return 0.5;
                        },
                        vLineWidth: function (i) {
                            return 0.5;
                        },
                        hLineColor: function (i) {
                            return "#000";
                        },
                        vLineColor: function (i) {
                            return "#000";
                        },
                        paddingLeft: function (i) {
                            return 1;
                        },
                        paddingRight: function (i) {
                            return 1;
                        },
                        paddingTop: function (i) {
                            return 1;
                        },
                        paddingBottom: function (i) {
                            return 1;
                        },
                    };
                },
            },
        ],
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
    $("div.dt-buttons").hide();

    document.querySelector("#btn-pdf").addEventListener("click", function () {
        table.button(".dt-btn-pdf").trigger();
    });
});
