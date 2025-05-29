const csrfToken = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

$(document).ready(function () {
    const table = $("#data-matkul").DataTable({
        searching: true, // Aktifkan pencarian
        paging: true, // Aktifkan pagination
        info: true, // Menampilkan informasi tabel
        scrollX: true, // Aktifkan scroll horizontal
        autoWidth: false, // Hindari ukuran otomatis
    });
    $("div.dt-search").hide();
    // });

    // $(document).ready(function () {
    //     function loadMatkul(prodiId, semester, oldMatkulId = null) {
    //         if (prodiId || semester) {
    //             fetch(
    //                 `/admin/getMatkulByProdi?prodi=${prodiId}&semester=${semester}`
    //             )
    //                 .then((response) => response.json())
    //                 .then((data) => {
    //                     const mataKuliahSelect = $("#matkul");
    //                     mataKuliahSelect.empty();

    //                     mataKuliahSelect.append(
    //                         '<option value="" hidden>Pilih Matkul</option>'
    //                     );
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
    $("#prodi, #semester, #tahun_ajaran").on("change", function () {
        const prodiId = $("#prodi").val();
        const semester = $("#semester").val();
        const tahunAjaran = $("#tahun_ajaran").val();
        // const semester = document.getElementById("semester").value; // Ambil semester yang dipilih
        // const prodiId = document.getElementById("prodi").value; // Ambil prodi yang dipilih

        // Pastikan salah satu filter dipilih untuk menghindari request kosong
        if (semester || prodiId || tahunAjaran) {
            // Buat URL untuk mengirim filter sebagai parameter query
            fetch(
                `/admin/getFilterMatkul?prodi=${prodiId}&semester=${semester}&tahun_ajaran=${tahunAjaran}`
            )
                .then((response) => response.json())
                .then((data) => {
                    // Hapus data sebelumnya dari DataTable
                    table.clear();

                    // Tambahkan data yang baru dari hasil filter
                    data.forEach((item, index) => {
                        console.log(item);
                        table.row.add([
                            `<div style="text-align:left;">${index + 1}</div>`, // Semester ditengah
                            `<div style="text-align:left;">${item.nama_matkul}</div>`, // Semester ditengah
                            `${item.prodi?.jenjang ?? ""} ${
                                item.prodi?.nama_prodi ?? ""
                            }` || "",
                            `<div style="text-align:left;">${
                                item.durasi_matkul + " SKS"
                            }</div>`, // Semester ditengah
                            `${item.tahun_ajaran?.tahun_awal + "/" ?? ""} ${
                                item.tahun_ajaran?.tahun_akhir ?? ""
                            } ${item.tahun_ajaran?.keterangan ?? ""}` || "", // `<div style="text-align:left;">${
                            //     item.rfid ? item.rfid : "-"
                            // }</div>`, // Semester ditengah
                            item.semester,

                            // item.prodi?.jenjang & item.prodi?.nama_prodi ?? "-",
                            // `<div style="text-align:center;">${item.semester}</div>`, // Semester ditengah
                            `<div class="flex gap-2 justify-center">
                                <a href="/admin/master-matkul/${item.id}/edit" class="cursor-pointer px-2 py-1 bg-yellow-600 hover:bg-yellow-700 active:bg-yellow-800 text-white rounded-md">
                                    <i class="bi bi-pencil-square text-lg"></i>
                                </a>
                                <form action="/admin/master-matkul/${item.id}" method="POST" class="form-hapus inline-block">
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
