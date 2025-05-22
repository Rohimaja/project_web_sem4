// document.addEventListener("DOMContentLoaded", function () {
//     const options = {
//         chart: {
//             type: "bar",
//             height: 300,
//         },
//         plotOptions: {
//             bar: {
//                 columnWidth: "80%",
//             },
//         },
//         series: [
//             {
//                 name: "Hadir",
//                 data: [25, 30, 28, 32],
//             },
//             {
//                 name: "Izin",
//                 data: [5, 4, 6, 3],
//             },
//             {
//                 name: "Alpha",
//                 data: [2, 1, 1, 0],
//             },
//         ],
//         xaxis: {
//             categories: ["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4"],
//             labels: {
//                 style: {
//                     colors: "#555",
//                 },
//             },
//         },
//         yaxis: {
//             labels: {
//                 style: {
//                     colors: "#555",
//                 },
//             },
//         },
//         dataLabels: {
//             enabled: true,
//             style: {
//                 colors: ["#555"],
//             },
//         },
//         colors: ["#2563eb", "#f59e0b", "#ef4444"],
//     };

//     const chartContainer = document.querySelector("#chart");

//     if (chartContainer) {
//         const chart = new ApexCharts(chartContainer, options);
//         chart.render();
//     }
// });

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
        series: chartData,
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
                    colors: ["#555"],
                },
            },
        },
        dataLabels: {
            enabled: true,
            style: {
                colors: ["#555"],
            },
        },
        colors: ["#2563eb", "#f59e0b", "#555", "#ef4444"],
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

// MAHASEWA MAHASEWA MAHASEWA
let chartInstance = null;

function renderChart() {
    // Hapus chart sebelumnya jika ada
    if (chartInstance) {
        chartInstance.destroy();
    }

    const isDark = document.documentElement.classList.contains("dark");

    const options = {
        chart: {
            type: "bar",
            height: 300,
            toolbar: { show: false },
            foreColor: isDark ? "#e5e7eb" : "#374151", // gray-200 or gray-700
            background: "transparent",
        },
        series: [
            {
                name: "Hadir",
                data: [5, 6],
            },
            {
                name: "Izin",
                data: [1, 0],
            },
            {
                name: "Alpha",
                data: [1, 1],
            },
        ],
        xaxis: {
            categories: ["Minggu 1 (1–7 Mei)", "Minggu 2 (8–14 Mei)"],
            title: { text: "Minggu" },
            labels: { style: { colors: isDark ? "#d1d5db" : "#4b5563" } },
        },
        yaxis: {
            title: { text: "Jumlah Kehadiran" },
            min: 0,
            forceNiceScale: true,
            labels: { style: { colors: isDark ? "#d1d5db" : "#4b5563" } },
        },
        colors: ["#10B981", "#F59E0B", "#EF4444"],
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: "55%",
                endingShape: "rounded",
            },
        },
        dataLabels: {
            enabled: false,
        },
        legend: {
            position: "top",
            labels: { colors: isDark ? "#d1d5db" : "#4b5563" },
        },
    };

    chartInstance = new ApexCharts(
        document.querySelector("#grafik-kehadiran-mhs"),
        options
    );
    chartInstance.render();
}

document.addEventListener("DOMContentLoaded", function () {
    renderChart();
});

// Buat renderChart bisa dipanggil dari Alpine
window.renderChart = renderChart;

// document.addEventListener("DOMContentLoaded", () => {
//     const options = {
//         chart: {
//             type: "bar",
//             height: 300,
//         },
//         series: chartData,
//         xaxis: {
//             categories: ["Minggu 1", "Minggu 2", "Minggu 3", "Minggu 4"],
//         },
//         colors: ["#2563eb", "#f59e0b", "#ef4444"],
//         plotOptions: {
//             bar: {
//                 borderRadius: 6,
//                 columnWidth: "60%",
//             },
//         },
//         dataLabels: {
//             enabled: true,
//         },
//     };

//     const chart = new ApexCharts(
//         document.querySelector("#grafik-kehadiran"),
//         options
//     );
//     chart.render();
// });
