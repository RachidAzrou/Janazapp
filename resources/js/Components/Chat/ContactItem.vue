<template>
  <div
    class="flex items-center px-4 py-3 cursor-pointer hover:bg-gray-100"
  >
    <div class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full">
      <img src="https://via.placeholder.com/40" alt="Avatar" class="rounded-full" />
    </div>
    <div class="flex-1 ml-3">
      <p class="text-sm font-semibold">{{ name }}</p>
      <p class="w-40 text-xs text-gray-500 truncate">
        {{ message }}
      </p>
    </div>
    <div class="flex items-center gap-2">
      <span v-if="time" class="text-xs text-gray-400">{{ time }}</span>
      <span v-if="unread" class="w-2.5 h-2.5 rounded-full bg-green-500"></span>
    </div>
  </div>
</template>

<script setup>
defineProps({
  name: String,
  message: String,
  time: String,
  unread: Boolean
})
</script>