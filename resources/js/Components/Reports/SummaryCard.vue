<template>
  <div :class="['flex items-center justify-between p-4 rounded-lg border shadow-sm w-full', borderColor]">
    <div class="space-y-1">
      <div class="text-sm text-gray-500">{{ title }}</div>
      <div class="text-2xl font-bold text-gray-800">{{ value }}</div>
    </div>
    <div :class="[iconColor, 'text-2xl']">
      <component :is="icon" />
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  value: [String, Number],
  icon: Object,
  borderColor: String,
  iconColor: String,
})
</script>