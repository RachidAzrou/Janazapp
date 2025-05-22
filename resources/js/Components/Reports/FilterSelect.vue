<template>
  <div class="relative w-full max-w-xs">
    <input
      v-model="search"
      type="text"
      placeholder="search"
      class="w-full px-3 py-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
    />
    <!-- Dropdown logic can go here if options are to be shown -->
  </div>
</template>

<script setup>
import { ref } from 'vue'
const search = ref('')
</script>