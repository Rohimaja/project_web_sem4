import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";

document.addEventListener("DOMContentLoaded", function () {
    const calendarEl = document.getElementById("calendar");

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        locale: "id", // opsional
        events: "/admin/kalender-akademik/events", // ambil data dari backend
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "",
        },
        eventClick: function (info) {
            alert(info.event.title + "\n" + info.event.extendedProps.deskripsi);
        },
    });

    calendar.render();
});
