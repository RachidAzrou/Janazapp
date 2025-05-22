<script setup>
import { defineProps, onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
  faPhone,
  faUsers,
  faFileLines,
  faCircleDollarToSlot,
  faBuildingCircleExclamation,
  faGlobe,
  faMapLocation,
  faLocationPin,
  faLocationCrosshairs,
  faMapPin,
} from "@fortawesome/free-solid-svg-icons";

onMounted(() => {
  console.log(props.organization);
});

const props = defineProps({
  organization: Object,
});
</script>

<template>
  <Head :title="'Details of ' + organization.name" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Organization Details: {{ organization.name }}
      </h2>
    </template>

    <div class="flex items-center justify-center p-6 bg-gray-100 sm:py-10">
      <div class="w-full max-w-3xl p-6 bg-white shadow-lg sm:rounded-lg">
        <div
          class="flex flex-col items-center pb-6 border-b border-gray-200 sm:flex-row sm:items-start sm:space-x-6"
        >
          <!-- Profile Picture Placeholder -->
          <div class="w-24 h-24 overflow-hidden bg-gray-200 rounded-full sm:w-32 sm:h-32">
            <p class="flex items-center justify-center h-full text-gray-500">(Picture)</p>
          </div>
          <div class="mt-4 text-center sm:mt-0 sm:text-left">
            <h3 class="text-lg font-bold text-gray-800 sm:text-xl">
              {{ organization.name }}
            </h3>
            <p class="text-sm text-gray-600">{{ organization.email }}</p>
            <p class="text-sm text-gray-600">ID: {{ organization.id }}</p>
          </div>
        </div>

        <!-- Organization Details -->
        <div class="grid gap-4 mt-6 sm:grid-cols-2">
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faPhone" class="mr-1" />Phone
            </p>
            <p class="text-lg text-gray-800">{{ organization.phone || "N/A" }}</p>
          </div>

          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faUsers" class="mr-1" />Type
            </p>
            <p class="text-lg text-gray-800">{{ organization.type || "N/A" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faFileLines" class="mr-1" />Registration Number
            </p>
            <p class="text-lg text-gray-800">
              {{ organization.registration_number || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faBuildingCircleExclamation" class="mr-1" />Status
            </p>
            <p
              v-if="organization.status?.status_name === 'active'"
              class="text-lg text-gray-800"
            >
              Active
            </p>
            <p
              v-if="organization.status?.status_name === 'inactive'"
              class="text-lg text-gray-800"
            >
              Inactive
            </p>
            <p
              v-if="organization.status?.status_name === 'suspended'"
              class="text-lg text-gray-800"
            >
              Suspended
            </p>
            <p
              v-if="organization.status?.status_name === 'pending_verification'"
              class="text-lg text-gray-800"
            >
              Pending Verification
            </p>
            <p v-if="!organization.status?.status_name" class="text-lg text-gray-800">
              N/A
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faCircleDollarToSlot" class="mr-1" />Tax Number
            </p>
            <p class="text-lg text-gray-800">{{ organization.tax_number || "Never" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faGlobe" class="mr-1" />Website
            </p>
            <p class="text-lg text-gray-800">{{ organization.website || "N/A" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faMapLocation" class="mr-1" />Address
            </p>
            <p class="text-lg text-gray-800">{{ organization.address_line1 }}</p>
            <p class="text-lg text-gray-800">{{ organization.address_line2 }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faMapPin" class="mr-1" />City
            </p>
            <p class="text-lg text-gray-800">{{ organization.city }}</p>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faLocationCrosshairs" class="mr-1" />State
            </p>
            <p class="text-lg text-gray-800">
              {{ organization.state + ", " + organization.postal_code }}
            </p>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faLocationPin" class="mr-1" />Country
            </p>
            <p class="text-lg text-gray-800">{{ organization.country }}</p>
          </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-between w-full mt-6">
          <!-- Left side: Back to Cases button -->
          <div class="flex">
            <Link
              :href="'/organizations/'"
              class="px-6 py-2 font-medium text-white duration-300 bg-gray-900 rounded hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
            >
              Back to Organizations
            </Link>
          </div>

          <!-- Right side: Other buttons -->
          <div class="flex gap-1">
            <Link
              :href="'/organizations/' + organization.id + '/users'"
              class="px-6 py-2 font-medium text-white duration-300 bg-gray-900 rounded hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
            >
              View Users Associated
            </Link>
            <Link
              :href="'/organizations/' + organization.id + '/edit'"
              class="px-6 py-2 font-medium text-white duration-300 bg-gray-900 rounded hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
            >
              Edit Organization Details
            </Link>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
