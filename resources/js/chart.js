const ctx = document.getElementById("myChart").getContext("2d");

const myChart = new Chart(ctx, {
    type: "doughnut",
    data: {
        labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"],
        datasets: [
            {
                label: "Presensi Mahasiswa",
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                    "rgba(255, 99, 132, 0.6)",
                    "rgba(54, 162, 235, 0.6)",
                    "rgba(255, 206, 86, 0.6)",
                    "rgba(75, 192, 192, 0.6)",
                    "rgba(153, 102, 255, 0.6)",
                ],
                borderColor: "#fff",
                borderWidth: 2,
            },
        ],
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: "top",
            },
            title: {
                display: true,
                text: "Kehadiran Mahasiswa per Hari",
            },
        },
    },
});

const ctx1 = document.getElementById("myChart1").getContext("2d");

const myChart1 = new Chart(ctx1, {
    type: "line", // jenis chart: bar, line, pie, etc.
    data: {
        labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"],
        datasets: [
            {
                label: "Mahasiswa",
                data: [12, 19, 3, 5, 2],
                backgroundColor: "rgba(175, 192, 192, 0.4)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 2,
                borderRadius: 8,
            },
            {
                label: "Absensi Dosen",
                data: [10, 30, 13, 15, 21],
                backgroundColor: "rgba(175, 192, 192, 0.4)",
                borderColor: "rgba(100, 102, 192, 1)",
                borderWidth: 2,
                borderRadius: 8,
            },
        ],
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
            },
        },
    },
});
