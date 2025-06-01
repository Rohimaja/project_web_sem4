$(document).ready(function () {
    table = $("#data-prodi").DataTable({
        searching: true,
        paging: true,
        info: true,
        scrollX: true,
        autoWidth: false,
    });
    $("div.dt-search").hide();
});
