<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

const props = defineProps({
  organization: Object,
  users: Array,
});
</script>

<template>
  <Head :title="'Users of ' + organization.name" />

  <!-- Authenticated Layout -->
  <AuthenticatedLayout>
    <!-- Header Section -->
    <!-- <template #header>
      <div class="p-6 text-white rounded-lg shadow-lg bg-gradient-to-r from-gray-900 to-muted-foreground">
        <h2 class="text-3xl font-semibold">{{ organization.name }}</h2>
      </div>
    </template> -->

    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Organization Users: {{ organization.name }}
      </h2>
    </template>

    <!-- Main Content Section -->
    <div class="container px-6 py-6 mx-auto">
      <div class="p-6 bg-white rounded-lg shadow-lg">
        <!-- <h1 class="mb-6 text-4xl font-bold text-gray-800">Users List</h1> -->

        <!-- Grid Layout for Users -->
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
          <div
            v-for="user in users"
            :key="user.id"
            class="p-4 transition-shadow duration-200 bg-gray-100 rounded-lg shadow-sm hover:shadow-md"
          >
            <div class="text-center">
              <h3 class="text-xl font-semibold text-gray-800">{{ user.name }}</h3>
              <p class="mt-1 text-gray-600">{{ user.email }}</p>
              <Link
                :href="'/users/' + user.id + '/details'"
                class="inline-block px-6 py-2 mt-4 text-sm text-white duration-200 bg-gray-900 rounded hover:bg-muted-foreground focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2 focus:outline-none"
              >
                View Details
              </Link>
            </div>
          </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8">
          <Link
            :href="'/organizations/' + organization.id + '/details'"
            class="px-6 py-2 font-medium text-white duration-300 bg-gray-900 rounded hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
          >
            Back to Organization Details
          </Link>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
