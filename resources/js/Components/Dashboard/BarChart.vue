<script setup>
import { Bar } from 'vue-chartjs'
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LinearScale
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const chartData = {
  labels: ['01 Nov', '02 Nov', '03 Nov', '04 Nov', '05 Nov', '06 Nov', '07 Nov', '08 Nov'],
  datasets: [
    {
      label: 'Completed',
      backgroundColor: '#34D399',
      data: [4, 8, 8, 6, 9, 7, 8, 7]
    }
  ]
}

const chartOptions = {
  responsive: true,
  plugins: {
    legend: { display: false }
  },
  scales: {
    y: { beginAtZero: true }
  }
}
</script>

<template>
  <Bar :data="chartData" :options="chartOptions" />
</template>