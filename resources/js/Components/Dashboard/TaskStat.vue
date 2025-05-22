<template>
    <div class="flex items-center space-x-2">
      <div :class="['w-10 h-10 rounded-full flex items-center justify-center font-bold text-white', color]">
        {{ number }}
      </div>
      <div class="text-sm text-gray-700">{{ label }}</div>
    </div>
  </template>
  
  <script setup>
  defineProps({
    number: String,
    label: String,
    color: String
  });
  </script>