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
    $("div.dt-search").hide();
    // });

    $("#prodi").select2({
        placeholder: "Cari Program Studi",
        width: "100%", // agar lebar mengikuti class seperti w-full
        allowClear: true,
    });
    $("#semester").select2({
        placeholder: "Cari Semester",
        width: "100%", // agar lebar mengikuti class seperti w-full
        allowClear: true,
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
                        table.row.add([
                            `<div style="text-align:center;">${
                                index + 1
                            }</div>`, // Semester ditengah
                            `<div class="w-10 h-10 bg-red-200 rounded-full overflow-hidden">
                                <img src="/storage/${item.foto}" alt="Photo" class="w-full h-full object-cover">
                            </div>`,
                            `<div style="text-align:left;">${item.nim}</div>`, // Semester ditengah
                            `<div style="text-align:left;">${item.nama}</div>`, // Semester ditengah
                            // `<div style="text-align:left;">${
                            //     item.rfid ? item.rfid : "-"
                            // }</div>`, // Semester ditengah
                            item.jenis_kelamin,
                            item.email,
                            `${item.prodi?.jenjang ?? ""} ${
                                item.prodi?.nama_prodi ?? ""
                            }` || "-",

                            // item.prodi?.jenjang & item.prodi?.nama_prodi ?? "-",
                            // `<div style="text-align:center;">${item.semester}</div>`, // Semester ditengah
                            `<div class="flex gap-2 justify-center">
                                <button class="btn-detail px-2 py-1 bg-gray-600 hover:bg-gray-700 text-white rounded-md" data-id="${item.id}">
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

$(document).on("click", ".btn-detail", function () {
    const id = $(this).data("id");
    $.ajax({
        url: `/admin/master-mahasiswa/${id}`, // sesuaikan jika prefix route-nya /admin/...
        type: "GET",
        success: function (data) {
            const html = `
                <div class="flex justify-center mb-4">
                    <div class="w-24 h-24 rounded-full overflow-hidden">
                        <img src="/storage/${
                            data.foto
                        }" class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="space-y-2">
                    <div><strong>Nama:</strong> ${data.nama}</div>
                    <div><strong>NIM:</strong> ${data.nim}</div>
                    <div><strong>Jenis Kelamin:</strong> ${
                        data.jenis_kelamin
                    }</div>
                    <div><strong>Agama:</strong> ${data.agama ?? "-"}</div>
                    <div><strong>TTL:</strong> ${data.tempat_lahir}, ${
                data.tgl_lahir
            }</div>
                    <div><strong>Email:</strong> ${data.email}</div>
                    <div><strong>Telepon:</strong> ${data.no_telp ?? "-"}</div>
                    <div><strong>Alamat:</strong> ${data.alamat}</div>
                    <div><strong>Provinsi:</strong> ${
                        data.province?.name ?? "-"
                    }</div>
                    <div><strong>Kabupaten:</strong> ${
                        data.regency?.name ?? "-"
                    }</div>
                    <div><strong>Kecamatan:</strong> ${
                        data.district?.name ?? "-"
                    }</div>
                    <div><strong>Kelurahan:</strong> ${
                        data.village?.name ?? "-"
                    }</div>
                    <div><strong>Prodi:</strong> ${data.prodi?.jenjang ?? ""} ${
                data.prodi?.nama_prodi ?? ""
            }</div>
                </div>
            `;
            $("#modal-body").html(html);
            document.querySelector("#modal-detail").__x.$data.open = true;
        },
        error: function () {
            alert("Gagal mengambil data mahasiswa.");
        },
    });
});
