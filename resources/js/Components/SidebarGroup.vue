<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { ref, watch, onMounted } from 'vue'
import { Link } from '@inertiajs/vue3'  // import Link

const props = defineProps({
  icon: Object,
  text: String,
  active: Boolean,
  href: String, // <-- add href prop for the parent link
})

const isOpen = ref(false)

onMounted(() => {
  if (props.active) isOpen.value = true
})

watch(() => props.active, (newVal) => {
  if (newVal) isOpen.value = true
})
</script>

<template>
  <Disclosure v-model:open="isOpen">
    <div>
      <DisclosureButton
        :class="[
          'flex items-center w-full px-4 py-2 text-left rounded focus:outline-none transition-colors duration-150',
          active ? 'bg-green-100 text-green-600 font-semibold' : 'hover:bg-gray-100 text-gray-800'
        ]"
      >
        <component :is="icon" class="w-5 h-5 mr-3" />

        <!-- Link for navigation inside the button -->
        <Link
          :href="href"
          class="flex-grow font-semibold"
          @click.stop
        >
          {{ text }}
        </Link>

        <svg
          class="w-4 h-4 ml-auto transition-transform duration-200"
          :class="{ 'rotate-90': isOpen }"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
      </DisclosureButton>

      <DisclosurePanel static class="mt-1 ml-8 space-y-1">
        <slot />
      </DisclosurePanel>
    </div>
  </Disclosure>
</template>
