<template>
  <div class="flex flex-col h-full gap-4 p-4 bg-white rounded-lg shadow-sm">
    <div class="flex items-center justify-between h-full">
      <div class="space-y-2">
        <div class="flex items-center gap-2 p-2 text-green-600 rounded bg-green-50">
          <span class="text-2xl font-bold">04</span>
          <span>Completed Files</span>
        </div>
        <div class="flex items-center gap-2 p-2 text-blue-600 rounded bg-blue-50">
          <span class="text-2xl font-bold">09</span>
          <span>Active Files</span>
        </div>
        <div class="flex items-center gap-2 p-2 text-orange-600 rounded bg-orange-50">
          <span class="text-2xl font-bold">07</span>
          <span>Canceled Files</span>
        </div>
      </div>

      <!-- Donut chart placeholder -->
      <div class="w-32 h-32">
        <canvas id="donutChart" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue'
import Chart from 'chart.js/auto'

onMounted(() => {
  const ctx = document.getElementById('donutChart')
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: ['Completed', 'Active', 'Canceled'],
      datasets: [{
        data: [4, 9, 7],
        backgroundColor: ['#A7F3D0', '#BFDBFE', '#FCD34D'],
        borderWidth: 0,
      }]
    },
    options: {
      cutout: '70%',
      plugins: { legend: { display: false } },
    }
  })
})
</script>
