// // alamat.js
// document.addEventListener("DOMContentLoaded", function () {
//     const provinsiSelect = document.getElementById("provinsi");
//     const kotaSelect = document.getElementById("kota");
//     const kecamatanSelect = document.getElementById("kecamatan");
//     const kelurahanSelect = document.getElementById("kelurahan");
//     const alamatHidden = document.getElementById("alamat_final");

//     async function getWilayah(url, selectElement, placeholder = "Pilih...") {
//         const response = await fetch(url);
//         const data = await response.json();
//         selectElement.innerHTML = `<option hidden selected>${placeholder}</option>`;
//         data.forEach((item) => {
//             selectElement.innerHTML += `<option value="${item.id}">${item.nama}</option>`;
//         });
//     }

//     provinsiSelect &&
//         getWilayah(
//             `https://emsifa.github.io/api-wilayah-indonesia/api/provinces.json`,
//             provinsiSelect,
//             "Pilih Provinsi"
//         );

//     provinsiSelect?.addEventListener("change", () => {
//         const idProv = provinsiSelect.value;
//         getWilayah(
//             `https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$idProv}.json`,
//             kotaSelect,
//             "Pilih Kota"
//         );
//         kecamatanSelect.innerHTML = "";
//         kelurahanSelect.innerHTML = "";
//     });

//     kotaSelect?.addEventListener("change", () => {
//         const idKota = kotaSelect.value;
//         getWilayah(
//             `https://emsifa.github.io/api-wilayah-indonesia/api/districts/{$idKota}.json`,
//             kecamatanSelect,
//             "Pilih Kecamatan"
//         );
//         kelurahanSelect.innerHTML = "";
//     });

//     kecamatanSelect?.addEventListener("change", () => {
//         const idKec = kecamatanSelect.value;
//         getWilayah(
//             `https://emsifa.github.io/api-wilayah-indonesia/api/villages/{$idKec}.json`,
//             kelurahanSelect,
//             "Pilih Kelurahan"
//         );
//     });

//     kelurahanSelect?.addEventListener("change", () => {
//         const prov = provinsiSelect.selectedOptions[0]?.text;
//         const kota = kotaSelect.selectedOptions[0]?.text;
//         const kec = kecamatanSelect.selectedOptions[0]?.text;
//         const kel = kelurahanSelect.selectedOptions[0]?.text;

//         const alamat = `${kel}, ${kec}, ${kota}, ${prov}`;
//         alamatHidden.value = alamat;
//     });
// });

// document.addEventListener("DOMContentLoaded", async function () {
//     const provinsiSelect = document.getElementById("provinsi");
//     const kotaSelect = document.getElementById("kota");
//     const kecamatanSelect = document.getElementById("kecamatan");
//     const kelurahanSelect = document.getElementById("kelurahan");
//     const alamatLengkapTextarea = document.getElementById("alamat_lengkap");
//     const alamatHidden = document.getElementById("alamat_final");

//     // Data yang dikirim dari blade
//     const selectedProvinsi = provinsiSelect.dataset.selected;
//     const selectedKota = kotaSelect.dataset.selected;
//     const selectedKecamatan = kecamatanSelect.dataset.selected;
//     const selectedKelurahan = kelurahanSelect.dataset.selected;

//     // Fungsi getWilayah harus didefinisikan terlebih dahulu
//     async function getWilayah(url, selectElement, placeholder = "Pilih...") {
//         const response = await fetch(url);
//         const data = await response.json();
//         selectElement.innerHTML = `<option hidden selected>${placeholder}</option>`;
//         data.forEach((item) => {
//             selectElement.innerHTML += `<option value="${item.id}">${item.name}</option>`;
//         });
//     }

//     // Load bertingkat
//     await getWilayah(
//         "/api-wilayah/provinces",
//         provinsiSelect,
//         selectedProvinsi
//     );
//     if (selectedProvinsi) {
//         await getWilayah(
//             `/api-wilayah/regencies/${selectedProvinsi}`,
//             kotaSelect,
//             selectedKota
//         );
//     }
//     if (selectedKota) {
//         await getWilayah(
//             `/api-wilayah/districts/${selectedKota}`,
//             kecamatanSelect,
//             selectedKecamatan
//         );
//     }
//     if (selectedKecamatan) {
//         await getWilayah(
//             `/api-wilayah/villages/${selectedKecamatan}`,
//             kelurahanSelect,
//             selectedKelurahan
//         );
//     }

//     // Panggil getWilayah untuk pertama kalinya
//     getWilayah("/api-wilayah/provinces", provinsiSelect, "Pilih Provinsi");

//     // Event listener untuk provinsi
//     provinsiSelect?.addEventListener("change", () => {
//         const idProv = provinsiSelect.value;
//         getWilayah(
//             `/api-wilayah/regencies/${idProv}`,
//             kotaSelect,
//             "Pilih Kota"
//         );
//         kecamatanSelect.innerHTML = "";
//         kelurahanSelect.innerHTML = "";
//     });

//     // Event listener untuk kota
//     kotaSelect?.addEventListener("change", () => {
//         const idKota = kotaSelect.value;
//         getWilayah(
//             `/api-wilayah/districts/${idKota}`,
//             kecamatanSelect,
//             "Pilih Kecamatan"
//         );
//         kelurahanSelect.innerHTML = "";
//     });

//     // Event listener untuk kecamatan
//     kecamatanSelect?.addEventListener("change", () => {
//         const idKec = kecamatanSelect.value;
//         getWilayah(
//             `/api-wilayah/villages/${idKec}`,
//             kelurahanSelect,
//             "Pilih Kelurahan"
//         );
//     });

//     // Event listener untuk kelurahan
//     kelurahanSelect?.addEventListener("change", () => {
//         updateAlamatFinal();
//         // const prov = provinsiSelect.selectedOptions[0]?.text;
//         // const kota = kotaSelect.selectedOptions[0]?.text;
//         // const kec = kecamatanSelect.selectedOptions[0]?.text;
//         // const kel = kelurahanSelect.selectedOptions[0]?.text;

//         // const alamat = `${kel}, ${kec}, ${kota}, ${prov}`;
//         // if (alamatHidden) alamatHidden.value = alamat;
//     });

//     function updateAlamatFinal() {
//         const prov = provinsiSelect.selectedOptions[0]?.text ?? "";
//         const kota = kotaSelect.selectedOptions[0]?.text ?? "";
//         const kec = kecamatanSelect.selectedOptions[0]?.text ?? "";
//         const kel = kelurahanSelect.selectedOptions[0]?.text ?? "";
//         const detail = alamatLengkapTextarea?.value.trim() ?? "";

//         // Format rapi
//         let alamatGabungan = detail;
//         if (kel) alamatGabungan += `, Kel. ${kel}`;
//         if (kec) alamatGabungan += `, Kec. ${kec}`;
//         if (kota) alamatGabungan += `, Kota ${kota}`;
//         if (prov) alamatGabungan += `, Provinsi ${prov}`;

//         if (alamatHidden) alamatHidden.value = alamatGabungan;
//     }
// });

// document.addEventListener("DOMContentLoaded", async function () {
//     const provinsiSelect = document.getElementById("provinsi");
//     const kotaSelect = document.getElementById("kota");
//     const kecamatanSelect = document.getElementById("kecamatan");
//     const kelurahanSelect = document.getElementById("kelurahan");

//     const selectedProvinsi = provinsiSelect.dataset.selected;
//     const selectedKota = kotaSelect.dataset.selected;
//     const selectedKecamatan = kecamatanSelect.dataset.selected;
//     const selectedKelurahan = kelurahanSelect.dataset.selected;

//     async function getWilayah(
//         url,
//         selectElement,
//         selectedId = null,
//         placeholder = "Pilih..."
//     ) {
//         const response = await fetch(url);
//         const data = await response.json();
//         selectElement.innerHTML = `<option hidden selected>${placeholder}</option>`;
//         data.forEach((item) => {
//             selectElement.innerHTML += `<option value="${item.id}" ${
//                 item.id == selectedId ? "selected" : ""
//             }>${item.name}</option>`;
//         });
//     }

//     await getWilayah(
//         "/api-wilayah/provinces",
//         provinsiSelect,
//         selectedProvinsi,
//         "Pilih Provinsi"
//     );

//     if (selectedProvinsi) {
//         await getWilayah(
//             `/api-wilayah/regencies/${selectedProvinsi}`,
//             kotaSelect,
//             selectedKota,
//             "Pilih Kota"
//         );
//     }
//     if (selectedKota) {
//         await getWilayah(
//             `/api-wilayah/districts/${selectedKota}`,
//             kecamatanSelect,
//             selectedKecamatan,
//             "Pilih Kecamatan"
//         );
//     }
//     if (selectedKecamatan) {
//         await getWilayah(
//             `/api-wilayah/villages/${selectedKecamatan}`,
//             kelurahanSelect,
//             selectedKelurahan,
//             "Pilih Kelurahan"
//         );
//     }

//     // Event listeners (tanpa updateAlamatFinal)
//     provinsiSelect?.addEventListener("change", async () => {
//         const idProv = provinsiSelect.value;
//         await getWilayah(
//             `/api-wilayah/regencies/${idProv}`,
//             kotaSelect,
//             null,
//             "Pilih Kota"
//         );
//         kecamatanSelect.innerHTML = "";
//         kelurahanSelect.innerHTML = "";
//     });

//     kotaSelect?.addEventListener("change", async () => {
//         const idKota = kotaSelect.value;
//         await getWilayah(
//             `/api-wilayah/districts/${idKota}`,
//             kecamatanSelect,
//             null,
//             "Pilih Kecamatan"
//         );
//         kelurahanSelect.innerHTML = "";
//     });

//     kecamatanSelect?.addEventListener("change", async () => {
//         const idKec = kecamatanSelect.value;
//         await getWilayah(
//             `/api-wilayah/villages/${idKec}`,
//             kelurahanSelect,
//             null,
//             "Pilih Kelurahan"
//         );
//     });

// async function getWilayahName(url, id) {
//     const res = await fetch(url);
//     const data = await res.json();
//     const item = data.find((i) => i.id == id);
//     return item ? item.name : "-";
// }

// const provinsiName = await getWilayahName(
//     "/api-wilayah/provinces",
//     provinsi_id
// );
// const kotaName = await getWilayahName(
//     `/api-wilayah/regencies/${provinsi_id}`,
//     kota_id
// );
// const kecamatanName = await getWilayahName(
//     `/api-wilayah/districts/${kota_id}`,
//     kecamatan_id
// );
// const kelurahanName = await getWilayahName(
//     `/api-wilayah/villages/${kecamatan_id}`,
//     kelurahan_id
// );

// Ambil nama wilayah berdasarkan ID yang disimpan di database
//     async function getNamaWilayahById(jenis, id, elementId) {
//         if (!id) return;
//         let url = "";
//         switch (jenis) {
//             case "provinces":
//                 url = "/api-wilayah/provinces";
//                 break;
//             case "regencies":
//                 url = `/api-wilayah/regencies/${id.substring(0, 2)}`; // ID provinsi
//                 break;
//             case "districts":
//                 url = `/api-wilayah/districts/${id.substring(0, 4)}`; // ID kota
//                 break;
//             case "villages":
//                 url = `/api-wilayah/villages/${id.substring(0, 6)}`; // ID kecamatan
//                 break;
//         }

//         const response = await fetch(url);
//         const data = await response.json();
//         const item = data.find((i) => i.id == id);
//         if (item) {
//             document.getElementById(elementId).value = item.name;
//         }
//     }

//     // Panggil untuk masing-masing
//     getNamaWilayahById(
//         "provinces",
//         provinsiSelect.dataset.selected,
//         "provinsi"
//     );
//     getNamaWilayahById("regencies", kotaSelect.dataset.selected, "kota");
//     getNamaWilayahById(
//         "districts",
//         kecamatanSelect.dataset.selected,
//         "kecamatan"
//     );
//     getNamaWilayahById(
//         "villages",
//         kelurahanSelect.dataset.selected,
//         "kelurahan"
//     );
// });

// document.addEventListener("DOMContentLoaded", async function () {
//     const provinsi = document.getElementById("provinsi");
//     const kota = document.getElementById("kota");
//     const kecamatan = document.getElementById("kecamatan");
//     const kelurahan = document.getElementById("kelurahan");

//     async function loadWilayah(url, targetSelect, placeholder = "Pilih...") {
//         const res = await fetch(url);
//         const data = await res.json();
//         targetSelect.innerHTML = `<option hidden selected>${placeholder}</option>`;
//         data.forEach((item) => {
//             targetSelect.innerHTML += `<option value="${item.id}">${item.name}</option>`;
//         });
//     }

//     // Initial Load Provinsi
//     await loadWilayah("/wilayah/provinces", provinsi, "Pilih Provinsi");

//     provinsi.addEventListener("change", async () => {
//         const id = provinsi.value;
//         await loadWilayah(`/wilayah/regencies/${id}`, kota, "Pilih Kota");
//         kecamatan.innerHTML = "";
//         kelurahan.innerHTML = "";
//     });

//     kota.addEventListener("change", async () => {
//         const id = kota.value;
//         await loadWilayah(
//             `/wilayah/districts/${id}`,
//             kecamatan,
//             "Pilih Kecamatan"
//         );
//         kelurahan.innerHTML = "";
//     });

//     kecamatan.addEventListener("change", async () => {
//         const id = kecamatan.value;
//         await loadWilayah(
//             `/wilayah/villages/${id}`,
//             kelurahan,
//             "Pilih Kelurahan"
//         );
//     });
// });

document.addEventListener("DOMContentLoaded", async function () {
    const provinsi = document.getElementById("provinsi");
    const kota = document.getElementById("kota");
    const kecamatan = document.getElementById("kecamatan");
    const kelurahan = document.getElementById("kelurahan");

    const selectedProvinsi = provinsi.dataset.selected;
    const selectedKota = kota.dataset.selected;
    const selectedKecamatan = kecamatan.dataset.selected;
    const selectedKelurahan = kelurahan.dataset.selected;

    async function loadWilayah(
        url,
        targetSelect,
        placeholder = "Pilih...",
        selected = null
    ) {
        const res = await fetch(url);
        const data = await res.json();
        targetSelect.innerHTML = `<option hidden selected>${placeholder}</option>`;
        data.forEach((item) => {
            const isSelected = selected == item.id ? "selected" : "";
            targetSelect.innerHTML += `<option value="${item.id}" ${isSelected}>${item.name}</option>`;
        });
    }

    // Load Provinsi
    await loadWilayah(
        "/wilayah/provinces",
        provinsi,
        "Pilih Provinsi",
        selectedProvinsi
    );

    if (selectedProvinsi) {
        await loadWilayah(
            `/wilayah/regencies/${selectedProvinsi}`,
            kota,
            "Pilih Kota",
            selectedKota
        );
    }
    if (selectedKota) {
        await loadWilayah(
            `/wilayah/districts/${selectedKota}`,
            kecamatan,
            "Pilih Kecamatan",
            selectedKecamatan
        );
    }
    if (selectedKecamatan) {
        await loadWilayah(
            `/wilayah/villages/${selectedKecamatan}`,
            kelurahan,
            "Pilih Kelurahan",
            selectedKelurahan
        );
    }

    // Event listeners
    provinsi.addEventListener("change", async () => {
        const id = provinsi.value;
        await loadWilayah(`/wilayah/regencies/${id}`, kota, "Pilih Kota");
        kecamatan.innerHTML = `<option hidden selected>Pilih Kecamatan</option>`;
        kelurahan.innerHTML = `<option hidden selected>Pilih Kelurahan</option>`;
    });

    kota.addEventListener("change", async () => {
        const id = kota.value;
        await loadWilayah(
            `/wilayah/districts/${id}`,
            kecamatan,
            "Pilih Kecamatan"
        );
        kelurahan.innerHTML = `<option hidden selected>Pilih Kelurahan</option>`;
    });

    kecamatan.addEventListener("change", async () => {
        const id = kecamatan.value;
        await loadWilayah(
            `/wilayah/villages/${id}`,
            kelurahan,
            "Pilih Kelurahan"
        );
    });
});
