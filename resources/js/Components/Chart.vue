<template>
    <Bar
        id="my-chart-id"
        :options="chartOptions"
        :data="chartData"
      />
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue';
import { Bar } from 'vue-chartjs';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)


// Metode untuk menghasilkan warna acak


const getRandomColors = () => {
    const colors = [];
    for (let i = 0; i < 5; i++) {
        const randomColor = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(
            Math.random() * 256
        )}, ${Math.floor(Math.random() * 256)}, 0.8)`;
        colors.push(randomColor);
    }
    return colors;
};
// Data dummy untuk grafik
const chartData = reactive({
    labels: ['Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5'],
    datasets: [
        {
            label: 'Tingkat Penjualan Perbulan',
            data: [12, 19, 3, 5, 2],
            backgroundColor: getRandomColors(),
            borderWidth: 0,
        },
    ],
})

const chartOptions = {
    responsive: true,
    animation: {
        duration: 1000,
    },
    scales: {
        y: {
            beginAtZero: true,
        },
    },
}
</script>
