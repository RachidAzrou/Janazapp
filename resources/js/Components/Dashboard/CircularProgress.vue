<template>
  <svg viewBox="0 0 36 36" class="w-full h-full">
    <circle
      v-for="(val, index) in normalizedSegments"
      :key="index"
      cx="18"
      cy="18"
      r="16"
      fill="none"
      :stroke="colors[index % colors.length]"
      stroke-width="4"
      :stroke-dasharray="val + ', 100'"
      :stroke-dashoffset="offsets[index]"
      stroke-linecap="round"
    />
  </svg>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
  total: Number,
  segments: Array
});

const totalSum = computed(() => props.segments.reduce((a, b) => a + b, 0));

const normalizedSegments = computed(() => {
  const total = totalSum.value;
  const segments = props.segments;
  const result = [];

  let runningTotal = 0;
  for (let i = 0; i < segments.length; i++) {
    if (i === segments.length - 1) {
      result.push(100 - runningTotal); // use raw number
    } else {
      const normalized = (segments[i] / total) * 100;
      result.push(normalized);
      runningTotal += normalized;
    }
  }

  return result;
});

const offsets = computed(() => {
  let offset = 0;
  return normalizedSegments.value.map((val) => {
    const current = offset;
    offset += parseFloat(val); // move forward
    return -current; // SVG expects negative offset for clockwise
  });
});

const colors = ['#1D4ED8', '#6366F1', '#22C55E']; // blue, indigo, green
</script>
