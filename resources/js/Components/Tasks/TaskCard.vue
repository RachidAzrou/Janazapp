<script setup>
defineProps({
  name: String,
  priority: String,
  jaId: String,
  created: String,
  assigned: String,
  status: String
})

const badgeColor = {
  Low: 'bg-gray-200 text-gray-800',
  Medium: 'bg-yellow-100 text-yellow-800',
  Urgent: 'bg-red-100 text-red-800',
  Completed: 'bg-green-100 text-green-800'
}
</script>

<template>
  <div class="p-3 mb-2 bg-white border rounded-md shadow-sm">
    <div class="flex items-center justify-between mb-1">
      <span :class="`text-xs font-semibold px-2 py-1 rounded ${badgeColor[priority]}`">
        Priority: {{ priority }}
      </span>
    </div>
    <div class="mb-1 text-sm font-semibold">{{ name }}</div>
    <div class="mb-2 text-xs text-gray-500">
      <div>JA ID: {{ jaId }}</div>
      <div>Created on: {{ created }}</div>
      <div>Assigned on: {{ assigned }}</div>
    </div>
    <div class="flex gap-2">
      <button class="px-3 py-1 text-xs text-white bg-blue-600 rounded hover:bg-blue-700">Open file</button>
      <button class="px-3 py-1 text-xs bg-gray-200 rounded hover:bg-gray-300">Release</button>
    </div>
  </div>
</template>