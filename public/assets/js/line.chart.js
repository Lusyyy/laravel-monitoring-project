// Data untuk Design Project
const data1 = {
    labels: ["W1", "W2", "W3", "W4"], // Contoh data label
    datasets: [
        {
            label: "Design Project Progress",
            data: [30, 50, 70, 44], // Contoh data progress
            borderColor: "rgba(255, 0, 0, 0.8)", // Merah
            backgroundColor: "rgba(255, 0, 0, 0.2)", // Merah transparan
            borderWidth: 2,
            pointStyle: "circle",
            fill: true, // Mengisi area di bawah garis
        },
    ],
};

const config1 = {
    type: "line",
    data: data1,
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false, // Menghilangkan legenda
            },
            title: {
                display: true,
                text: "Design Project Progress",
            },
        },
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 10,
                bottom: 10,
            },
        },
    },
};

new Chart(document.getElementById("lineChart1"), config1);

// Data untuk Mechanical Project
const data2 = {
    labels: ["W1", "W2", "W3", "W4"], // Contoh data label
    datasets: [
        {
            label: "Mechanical Project Progress",
            data: [20, 40, 20, 100], // Contoh data progress
            borderColor: "rgba(0, 0, 255, 0.8)", // Biru
            backgroundColor: "rgba(0, 0, 255, 0.2)", // Biru transparan
            borderWidth: 2,
            pointStyle: "circle",
            fill: true, // Mengisi area di bawah garis
        },
    ],
};

const config2 = {
    type: "line",
    data: data2,
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false, // Menghilangkan legenda
            },
            title: {
                display: true,
                text: "Mechanical Project Progress",
            },
        },
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 10,
                bottom: 10,
            },
        },
    },
};

new Chart(document.getElementById("lineChart2"), config2);

// Data untuk Project Lainnya
const data3 = {
    labels: ["W1", "W2", "W3", "W4"], // Contoh data label
    datasets: [
        {
            label: "Another Project Progress",
            data: [10, 30, 60, 88], // Contoh data progress
            borderColor: "rgba(0, 255, 0, 0.8)", // Hijau
            backgroundColor: "rgba(0, 255, 0, 0.2)", // Hijau transparan
            borderWidth: 2,
            pointStyle: "circle",
            fill: true, // Mengisi area di bawah garis
        },
    ],
};

const config3 = {
    type: "line",
    data: data3,
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false, // Menghilangkan legenda
            },
            title: {
                display: true,
                text: "Another Project Progress",
            },
        },
        layout: {
            padding: {
                left: 10,
                right: 10,
                top: 10,
                bottom: 10,
            },
        },
    },
};

new Chart(document.getElementById("lineChart3"), config3);
