<template>
  <div
    v-if="show"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40"
    @click.self="$emit('close')"
  >
    <div class="relative w-full max-w-3xl p-6 bg-white shadow-xl rounded-xl">
      <!-- Close Button -->
      <button
        @click="$emit('close')"
        class="absolute text-gray-400 top-4 right-4 hover:text-gray-600"
      >
        ✕
      </button>

      <h2 class="mb-6 text-xl font-semibold">Upload files</h2>

      <!-- Upload Section -->
      <div class="p-4 mb-6 text-center border rounded-xl bg-blue-50">
        <svg
          class="w-10 h-10 mx-auto text-gray-400"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5 5 5M12 15V3"
          />
        </svg>
        <p class="mt-2 text-sm text-gray-600">
          Documents Upload<br />(Passport, death certificate, etc…)
        </p>
      </div>

      <!-- File Upload Form -->
      <div class="p-4 space-y-4 border rounded-xl">
        <div class="flex items-center justify-between">
          <h3 class="font-semibold">File #1</h3>
          <button class="text-red-500 hover:text-red-700">
            <TrashIcon class="w-5 h-5" />
          </button>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">File name</label>
          <input type="text" class="w-full mt-1 input" value="name-passport-2022.pdf" />
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700">File type</label>
          <select class="w-full mt-1 input">
            <option>Passport</option>
            <option>Death Certificate</option>
            <option>Other</option>
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-700"
            >Description (Optional)</label
          >
          <textarea class="w-full mt-1 input" placeholder="Enter..."></textarea>
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-end gap-4 mt-6">
        <button @click="$emit('close')" class="px-4 py-2 border rounded-lg">
          Cancel
        </button>
        <button class="px-6 py-2 text-white bg-green-600 rounded-lg hover:bg-green-700">
          Upload
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { TrashIcon } from "@heroicons/vue/24/outline";

defineProps(["show"]);
defineEmits(["close"]);
</script>
