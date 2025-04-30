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

document.addEventListener("DOMContentLoaded", async function () {
    const provinsiSelect = document.getElementById("provinsi");
    const kotaSelect = document.getElementById("kota");
    const kecamatanSelect = document.getElementById("kecamatan");
    const kelurahanSelect = document.getElementById("kelurahan");

    const selectedProvinsi = provinsiSelect.dataset.selected;
    const selectedKota = kotaSelect.dataset.selected;
    const selectedKecamatan = kecamatanSelect.dataset.selected;
    const selectedKelurahan = kelurahanSelect.dataset.selected;

    async function getWilayah(
        url,
        selectElement,
        selectedId = null,
        placeholder = "Pilih..."
    ) {
        const response = await fetch(url);
        const data = await response.json();
        selectElement.innerHTML = `<option hidden selected>${placeholder}</option>`;
        data.forEach((item) => {
            selectElement.innerHTML += `<option value="${item.id}" ${
                item.id == selectedId ? "selected" : ""
            }>${item.name}</option>`;
        });
    }

    await getWilayah(
        "/api-wilayah/provinces",
        provinsiSelect,
        selectedProvinsi,
        "Pilih Provinsi"
    );

    if (selectedProvinsi) {
        await getWilayah(
            `/api-wilayah/regencies/${selectedProvinsi}`,
            kotaSelect,
            selectedKota,
            "Pilih Kota"
        );
    }
    if (selectedKota) {
        await getWilayah(
            `/api-wilayah/districts/${selectedKota}`,
            kecamatanSelect,
            selectedKecamatan,
            "Pilih Kecamatan"
        );
    }
    if (selectedKecamatan) {
        await getWilayah(
            `/api-wilayah/villages/${selectedKecamatan}`,
            kelurahanSelect,
            selectedKelurahan,
            "Pilih Kelurahan"
        );
    }

    // Event listeners (tanpa updateAlamatFinal)
    provinsiSelect?.addEventListener("change", async () => {
        const idProv = provinsiSelect.value;
        await getWilayah(
            `/api-wilayah/regencies/${idProv}`,
            kotaSelect,
            null,
            "Pilih Kota"
        );
        kecamatanSelect.innerHTML = "";
        kelurahanSelect.innerHTML = "";
    });

    kotaSelect?.addEventListener("change", async () => {
        const idKota = kotaSelect.value;
        await getWilayah(
            `/api-wilayah/districts/${idKota}`,
            kecamatanSelect,
            null,
            "Pilih Kecamatan"
        );
        kelurahanSelect.innerHTML = "";
    });

    kecamatanSelect?.addEventListener("change", async () => {
        const idKec = kecamatanSelect.value;
        await getWilayah(
            `/api-wilayah/villages/${idKec}`,
            kelurahanSelect,
            null,
            "Pilih Kelurahan"
        );
    });
});
