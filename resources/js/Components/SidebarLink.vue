<template>
  <Link
    :href="href"
    :class="[
      'flex items-center px-4 py-2 space-x-3 rounded cursor-pointer',
      active ? 'bg-green-100 text-green-600 font-semibold' : 'text-gray-600 hover:bg-gray-100'
    ]"
  >
    <component :is="icon" class="w-5 h-5" />
    <span>{{ text }}</span>
  </Link>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
defineProps({
  icon: Object,
  text: String,
  active: Boolean,
  href: String
});
</script>