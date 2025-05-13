document.addEventListener("DOMContentLoaded", function () {
    const options = {
        chart: {
            type: "bar",
            height: 250,
            toolbar: { show: false },
        },
        series: [
            {
                name: "Presensi",
                data: [100, 70, 20, 10], // Total Jadwal, Hadir, Izin, Absen
            },
        ],
        labels: ["Total Jadwal", "Total Hadir", "Total Izin", "Total Absen"],
        colors: ["#0ea5e9", "#2563eb", "#f59e0b", "#ef4444"],
        xaxis: {
            categories: [
                "Total Jadwal",
                "Total Hadir",
                "Total Izin",
                "Total Absen",
            ],
            labels: {
                style: {
                    colors: ["#0ea5e9", "#2563eb", "#f59e0b", "#ef4444"],
                    fontWeight: 600,
                },
            },
        },
        yaxis: {
            title: {
                text: "Jumlah",
            },
        },
        legend: {
            show: false,
        },
        plotOptions: {
            bar: {
                distributed: true,
                borderRadius: 4,
                dataLabels: {
                    position: "top",
                },
            },
        },
        dataLabels: {
            enabled: true,
            offsetY: -20,
            style: {
                fontSize: "12px",
                colors: ["#333"],
            },
        },
    };

    const chartContainer = document.querySelector("#chart-doghout-dosen");

    if (chartContainer) {
        const chart = new ApexCharts(chartContainer, options);
        chart.render();
    }
});
