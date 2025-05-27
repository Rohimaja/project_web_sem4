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
