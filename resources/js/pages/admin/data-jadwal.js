const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

$("#prodi").select2({
    placeholder: "Cari Program Studi",
    width: "100%",
    allowClear: true,
});

$("#dosen").select2({
    placeholder: "Cari Dosen",
    width: "100%",
    allowClear: true,
});

$("#matkul").select2({
    placeholder: "Pilih Prodi dan semester dahulu",
    width: "100%",
    allowClear: true,
});

$("#ruangan").select2({
    placeholder: "Cari Ruangan",
    width: "100%",
    allowClear: true,
});

$("#semester").select2({
    placeholder: "Cari Semester",
    width: "100%",
    allowClear: true,
});

$("#tahun-ajaran").select2({
    placeholder: "Cari Tahun Ajaran",
    width: "100%",
    allowClear: true,
});

$(document).ready(function () {
    const table = $("#data-jadwal").DataTable({
        searching: true,
        paging: true,
        info: true,
        scrollX: true,
        autoWidth: false,
    });

    $("#dosen ,#prodi, #tahun-ajaran").on("change", function () {
        const dosenId = $("#dosen").val();
        const prodiId = $("#prodi").val();
        const tahunId = $("#tahun-ajaran").val();

        if (dosenId || prodiId || tahunId) {
            fetch(
                `/admin/getFilterJadwal?dosen=${dosenId}&prodi=${prodiId}&tahun_ajaran=${tahunId}`
            )
                .then((response) => response.json())
                .then((data) => {
                    table.clear();

                    data.forEach((item, index) => {
                        table.row.add([
                            index + 1,
                            item.hari,
                            item.jam,
                            item.durasi + " SKS",
                            item.dosen?.nama ?? "",
                            `${item.prodi?.jenjang ?? ""} ${
                                item.prodi?.nama_prodi ?? ""
                            }` || "-",
                            `${item.tahun?.tahun_awal + " /"} ${
                                item.tahun?.tahun_akhir ?? ""
                            } ${item.tahun?.keterangan ?? ""}` || "-",
                            item.semester,
                            `${item.matkul?.nama_matkul ?? ""}`,
                            `${item.ruangan?.nama_ruangan ?? ""}`,
                            `<div class="flex gap-2 justify-center">
                                <a href="/admin/master-jadwal/${item.id}" class="cursor-pointer px-2 py-1 bg-gray-600 hover:bg-gray-700 active:bg-gray-800 text-white rounded-md">
                                    <i class="bi bi-card-text text-lg"></i>
                                </a>
                                <form action="/admin/master-jadwal/${item.id}" method="POST" class="form-hapus inline-block">
                                    <input type="hidden" name="_token" value="${csrfToken}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="px-2 py-1 bg-red-600 hover:bg-red-700 active:bg-red-800 text-white rounded-md">
                                        <i class="bi bi-trash text-lg"></i>
                                    </button>
                                </form>
                              </div>`,
                        ]);
                    });

                    table.draw();
                })
                .catch((error) => console.error("Error fetching data:", error));
        }
    });
});

$(document).ready(function () {
    function loadMatkul(prodiId, semester, tahunAjaran, oldMatkulId = null) {
        if (prodiId && semester && tahunAjaran) {
            fetch(
                `/admin/getMatkulByTahun?prodi=${prodiId}&semester=${semester}&tahun=${tahunAjaran}`
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
    $("#prodi, #semester, #tahun-ajaran").on("change", function () {
        const prodiId = $("#prodi").val();
        const semester = $("#semester").val();
        const tahunAjaran = $("#tahun-ajaran").val();
        loadMatkul(prodiId, semester, tahunAjaran);
    });

    // Trigger otomatis saat halaman reload karena error validasi
    const oldProdi = $("#prodi").val();
    const oldSemester = $("#semester").val();
    const oldTahunAjaran = $("#tahun-ajaran").val();
    const oldMatkul = $("#matkul").data("old");

    if (oldProdi && oldSemester && oldTahunAjaran) {
        loadMatkul(oldProdi, oldSemester, oldTahunAjaran, oldMatkul);
    }
});

// $(document).ready(function () {
//     function loadMatkul(prodiId, semester, oldMatkulId = null) {
//         if (prodiId && semester) {
//             fetch(`/getMatkulByProdi?prodi=${prodiId}&semester=${semester}`)
//                 .then((response) => response.json())
//                 .then((data) => {
//                     const mataKuliahSelect = $("#matkul");
//                     mataKuliahSelect.empty();

//                     // mataKuliahSelect.append(
//                     //     '<option value="" hidden>Pilih Matkul</option>'
//                     // );
//                     data.forEach((item) => {
//                         mataKuliahSelect.append(
//                             `<option value="${item.id}" ${
//                                 item.id == oldMatkulId ? "selected" : ""
//                             }>${item.nama_matkul}</option>`
//                         );
//                     });
//                 })
//                 .catch((error) => {
//                     console.error("Error fetching mata kuliah:", error);
//                 });
//         }
//     }

//     // Trigger saat user ganti
//     $("#prodi, #semester").on("change", function () {
//         const prodiId = $("#prodi").val();
//         const semester = $("#semester").val();
//         loadMatkul(prodiId, semester);
//     });

//     // Trigger otomatis saat halaman reload karena error validasi
//     const oldProdi = $("#prodi").val();
//     const oldSemester = $("#semester").val();
//     const oldMatkul = $("#matkul").data("old");

//     if (oldProdi && oldSemester) {
//         loadMatkul(oldProdi, oldSemester, oldMatkul);
//     }
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
