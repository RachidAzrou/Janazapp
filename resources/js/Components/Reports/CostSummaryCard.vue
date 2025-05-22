<template>
  <div class="p-4 bg-white border border-blue-100 shadow-sm rounded-xl">
    <div class="mb-1 text-sm text-gray-500">{{ title }}</div>
    <div class="mb-1 text-xl font-bold text-gray-800">{{ amount }}</div>
    <div class="text-xs font-medium text-red-500">⬆ 3% vs last month</div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  amount: String,
});
</script>