$("#prodi").select2({
    placeholder: "Cari Program Studi",
    width: "100%", // agar lebar mengikuti class seperti w-full
    allowClear: true,
});

$("#dosen").select2({
    placeholder: "Cari Dosen",
    width: "100%", // agar lebar mengikuti class seperti w-full
    allowClear: true,
});

$("#matkul").select2({
    placeholder: "Cari Matkul",
    width: "100%", // agar lebar mengikuti class seperti w-full
    allowClear: true,
});

$("#ruangan").select2({
    placeholder: "Cari Ruangan",
    width: "100%", // agar lebar mengikuti class seperti w-full
    allowClear: true,
});

$("#semester").select2({
    placeholder: "Cari Semester",
    width: "100%", // agar lebar mengikuti class seperti w-full
    allowClear: true,
});

let table;

$(document).ready(function () {
    table = $("#data-presensi").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
        // order: [[0, "desc"]], // Urutkan berdasarkan kolom tanggal (index 0), descending
    });

    // Default filter state
    let defaultFilter = "today";
    $("#filter-presensi").val(defaultFilter).trigger("change");

    // Validasi Sampai Tanggal Tidak Boleh Kurang dari Dari Tanggal
    $("#start-date").on("input", function () {
        let startDate = $(this).val();
        $("#end-date").attr("min", startDate);
    });

    $("#end-date").on("input", function () {
        let startDate = $("#start-date").val();
        let endDate = $(this).val();

        if (startDate && endDate < startDate) {
            $(this).val(""); // Reset nilai end-date
            alert("Sampai Tanggal tidak boleh lebih kecil dari Dari Tanggal.");
        }
    });

    // Filter kustom untuk DataTables
    $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
        let filter = $("#filter-presensi").val();
        let startDate = $("#start-date").val()
            ? new Date($("#start-date").val())
            : null;
        let endDate = $("#end-date").val()
            ? new Date($("#end-date").val())
            : null;
        let date = new Date(data[0]); // Sesuaikan kolom tanggal pada tabel Anda

        // Filter berdasarkan "Hari Ini"
        if (filter === "today") {
            let today = new Date();
            today.setHours(0, 0, 0, 0);
            if (date.toDateString() !== today.toDateString()) {
                return false;
            }
        }

        // Filter Minggu Ini
        if (filter === "week") {
            let today = new Date();
            let firstDay = new Date(
                today.setDate(today.getDate() - today.getDay())
            );
            let lastDay = new Date(firstDay);
            lastDay.setDate(firstDay.getDate() + 6);

            firstDay.setHours(0, 0, 0, 0);
            lastDay.setHours(23, 59, 59, 999);

            if (date < firstDay || date > lastDay) {
                return false;
            }
        }

        // Filter Bulan Ini
        if (filter === "month") {
            let today = new Date();
            let firstDay = new Date(today.getFullYear(), today.getMonth(), 1);
            let lastDay = new Date(
                today.getFullYear(),
                today.getMonth() + 1,
                0
            );

            firstDay.setHours(0, 0, 0, 0);
            lastDay.setHours(23, 59, 59, 999);

            if (date < firstDay || date > lastDay) {
                return false;
            }
        }

        // Filter berdasarkan range tanggal
        if (filter === "all") {
            if (startDate && date < startDate) {
                return false;
            }
            if (endDate && date > endDate) {
                return false;
            }
        }

        return true; // Data lolos filter
    });

    // Event Listener untuk Dropdown dan Input Tanggal
    $("#filter-presensi").on("change", function () {
        let filter = $(this).val();

        if (filter === "today") {
            $("#filter-date").hide(); // Sembunyikan input tanggal
        } else if (filter === "all") {
            $("#filter-date").show(); // Tampilkan input tanggal
        }

        table.draw(); // Refresh tabel sesuai filter
    });

    $("#start-date, #end-date").on("input", function () {
        table.draw(); // Refresh tabel sesuai tanggal yang dipilih
    });
    table.draw(); // Refresh tabel sesuai tanggal yang dipilih
});

$(document).ready(function () {
    function loadMatkul(prodiId, semester, oldMatkulId = null) {
        if (prodiId || semester) {
            fetch(`/getMatkulByProdi?prodi=${prodiId}&semester=${semester}`)
                .then((response) => response.json())
                .then((data) => {
                    const mataKuliahSelect = $("#matkul");
                    mataKuliahSelect.empty();

                    mataKuliahSelect.append(
                        '<option value="" hidden>Pilih Matkul</option>'
                    );
                    data.forEach((item) => {
                        mataKuliahSelect.append(
                            `<option value="${item.id}" ${
                                item.id == oldMatkulId ? "selected" : ""
                            }>${item.nama_matkul}</option>`
                        );
                    });
                })
                .catch((error) => {
                    console.error("Error fetching mata kuliah:", error);
                });
        }
    }

    // Trigger saat user ganti
    $("#prodi, #semester").on("change", function () {
        const prodiId = $("#prodi").val();
        const semester = $("#semester").val();
        loadMatkul(prodiId, semester);
    });

    // Trigger otomatis saat halaman reload karena error validasi
    const oldProdi = $("#prodi").val();
    const oldSemester = $("#semester").val();
    const oldMatkul = $("#matkul").data("old");

    if (oldProdi && oldSemester) {
        loadMatkul(oldProdi, oldSemester, oldMatkul);
    }
});

// $(document).ready(function () {
//     // Default filter state
//     let defaultFilter = "today";
//     $("#filter-presensi").val(defaultFilter).trigger("change");

//     // Validasi Sampai Tanggal Tidak Boleh Kurang dari Dari Tanggal
//     $("#start-date").on("input", function () {
//         let startDate = $(this).val();
//         $("#end-date").attr("min", startDate);
//     });

//     $("#end-date").on("input", function () {
//         let startDate = $("#start-date").val();
//         let endDate = $(this).val();

//         if (startDate && endDate < startDate) {
//             $(this).val(""); // Reset nilai end-date
//             alert("Sampai Tanggal tidak boleh lebih kecil dari Dari Tanggal.");
//         }
//     });

//     // Filter kustom untuk DataTables
//     $.fn.dataTable.ext.search.push(function (settings, data, dataIndex) {
//         let filter = $("#filter-presensi").val();
//         let startDate = $("#start-date").val()
//             ? new Date($("#start-date").val())
//             : null;
//         let endDate = $("#end-date").val()
//             ? new Date($("#end-date").val())
//             : null;
//         let date = new Date(data[1]); // Sesuaikan kolom tanggal pada tabel Anda

//         // Filter berdasarkan "Hari Ini"
//         if (filter === "today") {
//             let today = new Date();
//             today.setHours(0, 0, 0, 0);
//             if (date.toDateString() !== today.toDateString()) {
//                 return false;
//             }
//         }

//         // Filter berdasarkan range tanggal
//         if (filter === "all") {
//             if (startDate && date < startDate) {
//                 return false;
//             }
//             if (endDate && date > endDate) {
//                 return false;
//             }
//         }

//         return true; // Data lolos filter
//     });

//     // Event Listener untuk Dropdown dan Input Tanggal
//     $("#filter-presensi").on("change", function () {
//         let filter = $(this).val();

//         if (filter === "today") {
//             $("#filter-date").hide(); // Sembunyikan input tanggal
//         } else if (filter === "all") {
//             $("#filter-date").show(); // Tampilkan input tanggal
//         }

//         table.draw(); // Refresh tabel sesuai filter
//     });

//     $("#start-date, #end-date").on("input", function () {
//         table.draw(); // Refresh tabel sesuai tanggal yang dipilih
//     });
//     table.draw(); // Refresh tabel sesuai tanggal yang dipilih
// });

// $(document).ready(function () {
//     $("#prodi, #semester").on("change", function () {
//         const prodiId = $("#prodi").val();
//         const semester = $("#semester").val();

//         if (prodiId || semester) {
//             fetch(
//                 `/admin/getMatkulByProdi?prodi=${prodiId}&semester=${semester}`
//             )
//                 .then((response) => response.json())
//                 .then((data) => {
//                     const mataKuliahSelect = $("#matkul");
//                     // const oldValue = mataKuliahSelect.data("old");
//                     mataKuliahSelect.empty(); // Kosongkan dulu

//                     mataKuliahSelect.append(
//                         '<option value="" hidden selected>Pilih Matkul</option>'
//                     );
//                     data.forEach((item) => {
//                         mataKuliahSelect.append(
//                             `<option value="${item.id}">${item.nama_matkul}</option>`
//                         );
//                     });
//                 })
//                 .catch((error) => {
//                     console.error("Error fetching mata kuliah:", error);
//                 });
//         }
//     });
// });

// Fungsi Filter Dropdown mata kuliah pada menu master Absensi
// $(document).ready(function () {
//     $("#prodi, #semester").on("change", getMatkulByProdi);

//     function getMatkulByProdi() {
//         // const prodiId = document.getElementById("prodi").value;
//         // const semesterId = document.getElementById("semester").value;
//         const prodiId = $("#prodi").val();
//         const semesterId = $("#semester").val();

//         if (prodiId || semesterId) {
//             fetch(
//                 "/admin/getMatkulByProdi?prodi=" +
//                     prodiId +
//                     "&semester=" +
//                     semesterId
//             )
//                 .then((response) => response.json())
//                 .then((data) => {
//                     const mataKuliahSelect = document.getElementById("matkul");
//                     mataKuliahSelect.innerHTML = ""; // Clear previous options

//                     data.forEach((item) => {
//                         const option = document.createElement("option");
//                         option.value = item.kode_matkul;
//                         option.textContent = item.nama_matkul;
//                         mataKuliahSelect.appendChild(option);
//                     });
//                 })
//                 .catch((error) => console.error("Error fetching data:", error));
//         }
//     }
// });

// $(document).ready(function () {
//     $("#prodi, #semester").on("change", function () {
//         const prodiId = $("#prodi").val();
//         const semesterId = $("#semester").val();

//         if (prodiId || semesterId) {
//             $.ajax({
//                 url: `/admin/getMatkulByProdi`,
//                 method: "GET",
//                 data: {
//                     prodi: prodiId,
//                     semester: semesterId,
//                 },
//                 success: function (data) {
//                     const mataKuliahSelect = $("#matkul");
//                     mataKuliahSelect.empty(); // Kosongkan opsi sebelumnya

//                     mataKuliahSelect.append(
//                         `<option disabled selected>Pilih Mata Kuliah</option>`
//                     );
//                     data.forEach((item) => {
//                         mataKuliahSelect.append(
//                             `<option value="${item.kode_matkul}">${item.nama_matkul}</option>`
//                         );
//                     });
//                 },
//                 error: function () {
//                     console.error("Gagal mengambil data mata kuliah");
//                 },
//             });
//         }
//     });
// });

// $(document).ready(function () {
//   $('#prodi').select2({
//     placeholder: 'Pilih Prodi',
//     width: '100%' // agar menyesuaikan dengan Tailwind w-full
//   });
// });

// function dropdownDosen(options) {
//     return {
//         search: "",
//         selected: "",
//         open: false,
//         options: options,
//         filtered: options,

//         filterOptions() {
//             this.filtered = this.options.filter((opt) =>
//                 opt.toLowerCase().includes(this.search.toLowerCase())
//             );
//         },

//         selectOption(option) {
//             this.search = option;
//             this.selected = option;
//             this.open = false;
//         },
//     };
// }

// function dropdownProdi(options) {
//     return {
//         search: "",
//         selected: null,
//         open: false,
//         options: options,
//         filtered: options,

//         filterOptions() {
//             this.filtered = this.options.filter((opt) =>
//                 opt.nama_prodi.toLowerCase().includes(this.search.toLowerCase())
//             );
//         },

//         selectOption(option) {
//             this.search = option.nama_prodi;
//             this.selected = option;
//             this.open = false;
//         },
//     };
// }
