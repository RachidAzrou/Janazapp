<script setup>
import { defineProps, onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";

// Log the organization data when the component is mounted
onMounted(() => {
  console.log(props.cases);
});

const props = defineProps({
  cases: Object,
});
</script>

<template>
  <Head :title="'History of ' + cases.deceased_details.name" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          Case Activity History of {{ cases.deceased_details.name }}
        </h2>
      </div>
    </template>

    <div>
      
    </div>
  </AuthenticatedLayout>
</template>
