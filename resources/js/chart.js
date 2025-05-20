document.addEventListener("DOMContentLoaded", function () {
    const options = {
        chart: {
            type: "bar",
            height: 300,
        },
        plotOptions: {
            bar: {
                columnWidth: "80%",
            },
        },
        series: [
            {
                name: "Hadir",
                data: [25, 30, 28, 32],
            },
            {
                name: "Izin",
                data: [5, 4, 6, 3],
            },
            {
                name: "Alpha",
                data: [2, 1, 1, 0],
            },
        ],
        xaxis: {
            categories: ["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4"],
        },
        colors: ["#2563eb", "#f59e0b", "#ef4444"], // Biru, Orange, Merah
    };

    const chartContainer = document.querySelector("#chart");

    if (chartContainer) {
        const chart = new ApexCharts(chartContainer, options);
        chart.render();
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const options = {
        chart: {
            type: "donut",
            height: 300,
            toolbar: { show: false },
        },
        series: [70, 20, 10], // Hadir, Izin, Alpha
        labels: ["Hadir 2025", "Izin 2025", "Alpha 2025"],
        colors: ["#2563eb", "#f59e0b", "#ef4444"],
        legend: {
            position: "bottom",
        },
        plotOptions: {
            pie: {
                donut: {
                    size: "60%",
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: "Total Absensi",
                            formatter: function (w) {
                                return (
                                    w.globals.seriesTotals.reduce(
                                        (a, b) => a + b,
                                        0
                                    ) + "%"
                                );
                            },
                        },
                    },
                },
            },
        },
    };

    const chartContainer = document.querySelector("#chart-doghout");

    if (chartContainer) {
        const chart = new ApexCharts(chartContainer, options);
        chart.render();
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const options = {
        chart: {
            type: "line",
            height: 300,
            toolbar: { show: false },
        },
        series: [
            {
                name: "Hadir 2025",
                data: [30, 40, 45, 50, 49, 60, 70, 65, 55, 48, 52, 60],
            },
        ],
        xaxis: {
            categories: [
                "Jan",
                "Feb",
                "Mar",
                "Apr",
                "Mei",
                "Jun",
                "Jul",
                "Agu",
                "Sep",
                "Okt",
                "Nov",
                "Des",
            ],
        },
        colors: ["#2563eb"], // Warna biru untuk Hadir
        stroke: {
            curve: "smooth", // Garis melengkung
            width: 3,
        },
        markers: {
            size: 5,
            colors: ["#2563eb"],
            strokeWidth: 2,
            hover: {
                size: 7,
            },
        },
        dataLabels: {
            enabled: false,
        },
        yaxis: {
            title: {
                text: "Jumlah Kehadiran",
            },
        },
    };

    const chartContainer = document.querySelector("#chart-dosen");

    if (chartContainer) {
        const chart = new ApexCharts(chartContainer, options);
        chart.render();
    }
});
