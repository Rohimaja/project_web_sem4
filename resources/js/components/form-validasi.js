// // Tambahkan method custom untuk validasi file size (max 2MB)
// $.validator.addMethod(
//     "filesize",
//     function (value, element, param) {
//         return this.optional(element) || element.files[0].size <= param;
//     },
//     "File terlalu besar. Maksimal 2MB"
// );

// $("#form-admin").validate({
//     rules: {
//         nama: {
//             required: true,
//             maxlength: 100,
//         },
//         tempat_lahir: {
//             required: true,
//             maxlength: 100,
//         },
//         email: {
//             required: true,
//             email: true,
//             maxlength: 100,
//         },
//         no_telp: {
//             required: true,
//             maxlength: 20,
//             digits: true,
//         },
//         alamat: {
//             required: true,
//             maxlength: 255,
//         },
//         foto: {
//             extension: "jpg|jpeg|png",
//             filesize: 2048000, // dalam byte (2MB)
//         },
//         provinsi_id: {
//             required: true,
//         },
//         kota_id: {
//             required: true,
//         },
//         kecamatan_id: {
//             required: true,
//         },
//         kelurahan_id: {
//             required: true,
//         },
//     },
//     messages: {
//         nama: {
//             required: "Nama tidak boleh kosong",
//             maxlength: "Nama maksimal 100 karakter",
//         },
//         tempat_lahir: {
//             required: "Tempat Lahir tidak boleh kosong",
//             maxlength: "Tempat lahir maksimal 100 karakter",
//         },
//         email: {
//             required: "Email tidak boleh kosong",
//             email: "Format email salah",
//             maxlength: "Email maksimal 100 karakter",
//         },
//         no_telp: {
//             required: "No Telpon tidak boleh kosong",
//             digits: "Hanya boleh angka",
//             maxlength: "Maksimal 20 karakter",
//         },
//         alamat: {
//             required: "Alamat tidak boleh kosong",
//             maxlength: "Alamat maksimal 255 karakter",
//         },
//         foto: {
//             extension: "Foto harus berupa JPG, JPEG, atau PNG",
//             filesize: "Ukuran foto maksimal 2MB",
//         },
//         provinsi_id: "Provinsi wajib dipilih",
//         kota_id: "Kota wajib dipilih",
//         kecamatan_id: "Kecamatan wajib dipilih",
//         kelurahan_id: "Kelurahan wajib dipilih",
//     },
//     errorElement: "div",
//     errorPlacement: function (error, element) {
//         error.addClass("text-danger");
//         error.insertAfter(element);
//     },
// });

// // import $ from "jquery";
// // import "jquery-validation";

// // $.validator.addMethod(
// //     "filesize",
// //     function (value, element, maxSize) {
// //         return (
// //             this.optional(element) ||
// //             (element.files[0] && element.files[0].size <= maxSize)
// //         );
// //     },
// //     "File terlalu besar."
// // );

// // $(document).ready(function () {
// //     $("#form-admin").validate({
// //         rules: {
// //             nim: { required: true, maxlength: 20 },
// //             nama: { required: true, maxlength: 100 },
// //             tempat_lahir: { required: true, maxlength: 100 },
// //             email: { required: true, email: true, maxlength: 100 },
// //             no_telp: { required: true, maxlength: 20, digits: true },
// //             alamat: { required: true, maxlength: 255 },
// //             tahun_masuk: { required: true, digits: true },
// //             foto: { extension: "jpg|jpeg|png", filesize: 2048000 },
// //             provinsi_id: { required: true },
// //             kota_id: { required: true },
// //             kecamatan_id: { required: true },
// //             kelurahan_id: { required: true },
// //         },
// //         messages: {
// //             nim: "NIM wajib diisi",
// //             nama: "Nama wajib diisi",
// //             tempat_lahir: "Tempat Lahir wajib diisi",
// //             email: {
// //                 required: "Email wajib diisi",
// //                 email: "Format email salah",
// //             },
// //             no_telp: {
// //                 required: "No. Telp wajib diisi",
// //                 digits: "Harus berupa angka",
// //             },
// //             alamat: "Alamat wajib diisi",
// //             tahun_masuk: "Tahun Masuk wajib diisi",
// //             foto: {
// //                 extension: "Hanya file JPG, JPEG, atau PNG yang diizinkan",
// //                 filesize: "Ukuran maksimal 2MB",
// //             },
// //             provinsi_id: "Provinsi wajib dipilih",
// //             kota_id: "Kota wajib dipilih",
// //             kecamatan_id: "Kecamatan wajib dipilih",
// //             kelurahan_id: "Kelurahan wajib dipilih",
// //         },
// //         errorClass: "text-red-500 text-sm",
// //         errorElement: "div",
// //         highlight: function (element) {
// //             $(element).addClass("border-red-500");
// //         },
// //         unhighlight: function (element) {
// //             $(element).removeClass("border-red-500");
// //         },
// //     });
// // });

// $("#email").on("input", function () {
//     const field = "email";
//     const value = $(this).val();
//     $.post({
//         url: "/admin/validate-field",
//         data: {
//             field: field,
//             value: value,
//             _token: $('meta[name="csrf-token"]').attr("content"),
//         },
//         success: function (res) {
//             $("#email_error").text("");
//         },
//         error: function (xhr) {
//             if (xhr.status === 422) {
//                 $("#email_error").text(xhr.responseJSON.error);
//             }
//         },
//     });
// });

$("[data-validate]").on("input", function () {
    const field = $(this).attr("name");
    const value = $(this).val();
    const errorSelector = `#${field}_error`;
    const entity = $(this).data("validate"); // misal: "prodi", "admin", dll
    const editId = $("#edit_id").val(); // Example: <input type="hidden" id="edit_id" value="1">

    $.post({
        url: `/admin/validate-field/${entity}`,
        method: "POST",
        data: {
            field: field,
            value: value,
            id: editId,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function () {
            $(errorSelector).text("");
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                $(errorSelector).text(xhr.responseJSON.error);
            }
        },
    });
});

// export function setupRealtimeValidation(selector) {
//     $(document).on("input change", selector, function () {
//         const field = $(this);
//         const name = field.attr("name");
//         const value = field.val();

//         $.post("/admin/validate-field", {
//             [name]: value,
//             _token: $('meta[name="csrf-token"]').attr("content"),
//         }).done((res) => {
//             const errorSpan = $("#" + name + "-error");
//             if (res.valid) {
//                 errorSpan.text("");
//                 field.removeClass("border-red-500");
//             } else {
//                 errorSpan.text(res.message);
//                 field.addClass("border-red-500");
//             }
//         });
//     });
// }
// export function setupRealtimeValidation(selector, url) {
//     $(document).on("input change", selector, function () {
//         const field = $(this);
//         const name = field.attr("name");
//         const value = field.val();

//         $.post(url, {
//             [name]: value,
//             _token: $('meta[name="csrf-token"]').attr("content"),
//         }).done((res) => {
//             const errorSpan = $("#" + name + "-error");
//             if (res.valid) {
//                 errorSpan.text("");
//                 field.removeClass("border-red-500");
//             } else {
//                 errorSpan.text(res.message);
//                 field.addClass("border-red-500");
//             }
//         });
//     });

// export function setupRealtimeValidation(selector = "[data-validate]") {
//     $(document).on("input change", selector, function () {
//         const field = $(this);
//         const name = field.attr("name");
//         const value = field.val();

//         $.post({
//             url: "/admin/validate-field",
//             data: {
//                 [name]: value,
//                 _token: $('meta[name="csrf-token"]').attr("content"),
//             },
//             success: function () {
//                 $("#" + name + "-error").text("");
//                 field.removeClass("border-red-500");
//             },
//             error: function (xhr) {
//                 if (xhr.status === 422) {
//                     const errors = xhr.responseJSON.errors;
//                     const message = errors[name]
//                         ? errors[name][0]
//                         : "Field tidak valid";
//                     $("#" + name + "-error").text(message);
//                     field.addClass("border-red-500");
//                 }
//             },
//         });
//     });
// }
