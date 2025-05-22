<template>
  <div
    v-if="show"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    @click.self="$emit('close')"
  >
    <div
      class="w-full max-w-lg p-6 bg-white rounded shadow-xl"
    >
      <div class="flex items-center justify-between mb-4">
        <h3 class="text-lg font-semibold text-gray-700">Upload Documents</h3>
        <button @click="$emit('close')" class="text-gray-500 hover:text-gray-700">
          ✕
        </button>
      </div>

      <div class="space-y-4">
        <div>
          <label class="block mb-1 text-sm font-medium text-gray-700">Upload Files</label>
          <input type="file" class="w-full border rounded" multiple />
          <p class="mt-1 text-xs text-gray-500">(PDF, DOCX, PNG, etc...)</p>
        </div>
      </div>

      <div class="flex justify-end mt-6 space-x-3">
        <button @click="$emit('close')" class="px-4 py-2 text-gray-600 border rounded hover:bg-gray-100">
          Cancel
        </button>
        <button class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
          Upload
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  show: Boolean,
});
defineEmits(["close"]);
</script>
