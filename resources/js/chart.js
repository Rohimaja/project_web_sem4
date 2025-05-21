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
            labels: {
                style: {
                    colors: "#555",
                },
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: "#555",
                },
            },
        },
        dataLabels: {
            enabled: true,
            style: {
                colors: ["#555"],
            },
        },
        colors: ["#2563eb", "#f59e0b", "#ef4444"],
    };

    const chartContainer = document.querySelector("#chart");

    if (chartContainer) {
        const chart = new ApexCharts(chartContainer, options);
        chart.render();
    }
});

// DOSEN DOSEN DOSEN
document.addEventListener("DOMContentLoaded", () => {
    const options = {
        chart: {
            type: "bar",
            height: 250,
            toolbar: { show: false },
        },
        series: [
            {
                name: "Jumlah Presensi",
                data: [5, 4, 6, 3], // Minggu 1 - 4
            },
        ],
        xaxis: {
            categories: ["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4"],
        },
        colors: ["#1E88E5"],
        plotOptions: {
            bar: {
                borderRadius: 6,
                columnWidth: "50%",
            },
        },
        dataLabels: {
            enabled: true,
        },
    };

    const chart = new ApexCharts(
        document.querySelector("#grafik-kehadiran"),
        options
    );
    chart.render();
});
