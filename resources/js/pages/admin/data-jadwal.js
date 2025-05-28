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
            fetch(`/dosen/getFilterJadwal?tahun_ajaran=${tahunId}`)
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
                            `${item.prodi?.jenjang ?? ""} ${
                                item.prodi?.nama_prodi ?? ""
                            }` || "-",
                            item.semester,
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

$(document).ready(function () {
    function loadMatkul(prodiId, semester, oldMatkulId = null) {
        if (prodiId || semester) {
            fetch(
                `/admin/getMatkulByProdi?prodi=${prodiId}&semester=${semester}`
            )
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
