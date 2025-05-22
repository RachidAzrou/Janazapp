<template>
  <div class="relative p-4 bg-white rounded-lg shadow-sm">
    <h2 class="mb-2 font-semibold text-gray-700">Average file duration</h2>
    <canvas id="barChart" class="h-40"></canvas>
    <div class="absolute p-2 text-sm text-gray-700 rounded top-4 right-4 bg-gray-50">
      <div class="font-semibold">4.2 days</div>
      <div class="text-xs text-green-500">6% faster than target</div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import Chart from 'chart.js/auto'

onMounted(() => {
  const ctx = document.getElementById('barChart')
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['X','X','X','X','X','X','X','X'],
      datasets: [{
        data: [96, 110, 100, 85, 70, 105, 90, 88],
        backgroundColor: '#A5B4FC'
      }]
    },
    options: {
      plugins: { legend: { display: false } },
      scales: {
        y: { beginAtZero: true, ticks: { stepSize: 24 } }
      }
    }
  })
})
</script>
