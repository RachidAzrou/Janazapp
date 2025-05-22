<template>
  <div class="relative p-4 bg-white rounded-lg shadow-sm">
    <h2 class="mb-2 font-semibold text-gray-700">Cost of repatriation files</h2>
    <canvas id="lineChart" class="h-40"></canvas>
    <div class="absolute p-2 text-sm text-right text-gray-700 rounded top-4 right-4 bg-gray-50">
      <div class="font-semibold">85,396 €</div>
      <div class="text-xs text-red-500">↓13% vs last month</div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import Chart from 'chart.js/auto'

onMounted(() => {
  const ctx = document.getElementById('lineChart')
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
      datasets: [{
        data: [5000, 8000, 9000, 12000, 15000, 17000, 16000, 17500, 18000, 19000, 20000, 21000],
        borderColor: '#34D399',
        tension: 0.4,
        fill: false,
        pointRadius: 0
      }]
    },
    options: {
      plugins: { legend: { display: false } },
      scales: {
        y: { beginAtZero: true }
      }
    }
  })
})
</script>
