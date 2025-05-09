// const ctx = document.getElementById("myChart").getContext("2d");

// const myChart = new Chart(ctx, {
//     type: "doughnut",
//     data: {
//         labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"],
//         datasets: [
//             {
//                 label: "Presensi Mahasiswa",
//                 data: [12, 19, 3, 5, 2],
//                 backgroundColor: [
//                     "rgba(255, 99, 132, 0.6)",
//                     "rgba(54, 162, 235, 0.6)",
//                     "rgba(255, 206, 86, 0.6)",
//                     "rgba(75, 192, 192, 0.6)",
//                     "rgba(153, 102, 255, 0.6)",
//                 ],
//                 borderColor: "#fff",
//                 borderWidth: 2,
//             },
//         ],
//     },
//     options: {
//         responsive: true,
//         plugins: {
//             legend: {
//                 position: "top",
//             },
//             title: {
//                 display: true,
//                 text: "Kehadiran Mahasiswa per Hari",
//             },
//         },
//     },
// });

// const ctx1 = document.getElementById("myChart1").getContext("2d");

// const myChart1 = new Chart(ctx1, {
//     type: "line", // jenis chart: bar, line, pie, etc.
//     data: {
//         labels: ["Senin", "Selasa", "Rabu", "Kamis", "Jumat"],
//         datasets: [
//             {
//                 label: "Mahasiswa",
//                 data: [12, 19, 3, 5, 2],
//                 backgroundColor: "rgba(175, 192, 192, 0.4)",
//                 borderColor: "rgba(75, 192, 192, 1)",
//                 borderWidth: 2,
//                 borderRadius: 8,
//             },
//             {
//                 label: "Absensi Dosen",
//                 data: [10, 30, 13, 15, 21],
//                 backgroundColor: "rgba(175, 192, 192, 0.4)",
//                 borderColor: "rgba(100, 102, 192, 1)",
//                 borderWidth: 2,
//                 borderRadius: 8,
//             },
//         ],
//     },
//     options: {
//         responsive: true,
//         scales: {
//             y: {
//                 beginAtZero: true,
//             },
//         },
//     },
// });

// document.addEventListener('DOMContentLoaded', function () {
//     const forms = document.querySelectorAll('.form-hapus');

//     forms.forEach(form => {
//         form.addEventListener('submit', function (e) {
//             e.preventDefault(); // Jangan langsung submit

//             Swal.fire({
//                 title: 'Apakah Anda yakin?',
//                 text: "Data yang dihapus tidak bisa dikembalikan!",
//                 icon: 'warning',
//                 showCancelButton: true,
//                 confirmButtonColor: '#d33',
//                 cancelButtonColor: '#3085d6',
//                 confirmButtonText: 'Ya, hapus!',
//                 cancelButtonText: 'Batal'
//             }).then((result) => {
//                 if (result.isConfirmed) {
//                     form.submit(); // Baru submit form kalau user tekan "Ya"
//                 }
//             });
//         });
//     });

//     @if (session('status') && session('message'))
//         Swal.fire({
//             icon: '{{ session('status') }}',
//             title: '{{ ucfirst(session('status')) }}',
//             text: '{{ session('message') }}',
//             timer: 2000,
//             timerProgressBar: true,
//             showConfirmButton: false,
//             // willClose: () => {
//             //     @if (session('redirect'))
//             //         window.location.href = '{{ session('redirect') }}';
//             //     @endif
//             // }
//         });
//     @endif
// });

document.addEventListener("DOMContentLoaded", function () {
    const options = {
        chart: {
            type: "bar",
            height: 300,
        },
        plotOptions: {
            bar: {
                columnWidth: "80%", // memperkecil lebar bar
            },
        },
        series: [
            {
                name: "Hadir 2025",
                data: [30, 40, 45, 50, 49, 60, 70, 65, 55, 48, 52, 60],
            },
            {
                name: "Izin 2025",
                data: [15, 20, 18, 22, 25, 20, 18, 20, 23, 15, 17, 19],
            },
            {
                name: "Alpha 2025",
                data: [5, 10, 7, 10, 9, 8, 7, 5, 5, 10, 6, 4],
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
