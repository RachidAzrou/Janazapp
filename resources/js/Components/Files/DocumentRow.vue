<template>
  <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
    <div class="flex items-center space-x-2">
      <div class="flex items-center justify-center w-5 h-5 text-sm font-semibold text-gray-500 bg-gray-100 rounded-full">i</div>
      <span class="text-sm font-medium text-gray-700">{{ name }}</span>
    </div>
    <div class="flex items-center space-x-4 text-sm text-gray-500">
      <span v-if="!uploaded" class="font-medium text-yellow-600">🟡 no file uploaded</span>
      <span v-else class="font-medium text-green-600">🟢 uploaded</span>
      <span class="text-xs text-gray-400">Last update: {{ updatedAt ?? 'xx/xx/xxxx' }}</span>
    </div>
  </div>
</template>

<script setup>
defineProps({
  name: String,
  uploaded: Boolean,
  updatedAt: String
});
</script>