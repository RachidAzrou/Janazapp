<script setup>
import { defineProps, onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
  faUserTag,
  faUserClock,
  faPhone,
  faBuildingUser,
  faKey,
} from "@fortawesome/free-solid-svg-icons";

import { faWhatsapp } from "@fortawesome/free-brands-svg-icons";

onMounted(() => {
  console.log(props.user);
});

const props = defineProps({
  user: Object,
});
</script>

<template>
  <Head :title="'Details of ' + user.name" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-bold leading-tight text-gray-800">
        User Details: {{ user.name }}
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
              {{ user.name }}
            </h3>
            <p class="text-sm text-gray-600">{{ user.email }}</p>
            <p class="text-sm text-gray-600">ID: {{ user.id }}</p>
          </div>
        </div>

        <!-- User Details -->
        <div class="grid gap-4 mt-6 sm:grid-cols-2">
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faPhone" class="mr-1" />Phone
            </p>
            <p class="text-lg text-gray-800">{{ user.phone || "N/A" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faWhatsapp" class="mr-1" />WhatsApp ID
            </p>
            <p class="text-lg text-gray-800">{{ user.whatsapp_id || "N/A" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faUserTag" class="mr-1" />Role
            </p>
            <p v-if="user.role?.role_name === 'admin'" class="text-lg text-gray-800">
              Admin
            </p>
            <p
              v-if="user.role?.role_name === 'insurance_agent'"
              class="text-lg text-gray-800"
            >
              Insurance Agent
            </p>
            <p v-if="user.role?.role_name === 'dispatcher'" class="text-lg text-gray-800">
              Dispatcher
            </p>
            <p
              v-if="user.role?.role_name === 'funeral_service'"
              class="text-lg text-gray-800"
            >
              Funeral Service
            </p>
            <p v-if="user.role?.role_name === 'expeditor'" class="text-lg text-gray-800">
              Expeditor
            </p>
            <p
              v-if="user.role?.role_name === 'hospital_staff'"
              class="text-lg text-gray-800"
            >
              Hospital Staff
            </p>
            <p
              v-if="user.role?.role_name === 'mosque_admin'"
              class="text-lg text-gray-800"
            >
              Mosque Admin
            </p>
            <p
              v-if="user.role?.role_name === 'mortuary_admin'"
              class="text-lg text-gray-800"
            >
              Mortuary Admin
            </p>
            <p v-if="user.role?.role_name === 'user'" class="text-lg text-gray-800">
              User
            </p>
            <p v-if="!user.role?.role_name" class="text-lg text-gray-800">N/A</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faBuildingUser" class="mr-1" />Organization
            </p>
            <p class="text-lg text-gray-800">{{ user.organization?.name || "N/A" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faUserClock" class="mr-1" />Status
            </p>
            <p class="text-lg text-gray-800">{{ user.status?.status_name || "N/A" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faKey" class="mr-1" />Last Login
            </p>
            <p class="text-lg text-gray-800">{{ user.last_login_at || "Never" }}</p>
          </div>
        </div>

        <!-- Actions -->
        <div class="flex justify-between w-full mt-6">
          <!-- Left side: Back to Cases button -->
          <div class="flex">
            <Link
              :href="'/users/'"
              class="px-6 py-2 font-medium text-white duration-300 bg-gray-900 rounded hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
            >
              Back to Users
            </Link>
          </div>

          <!-- Right side: Other buttons -->
          <div class="flex gap-1">
            <Link
              :href="'/users/' + user.id + '/edit'"
              class="px-6 py-2 font-medium text-white duration-300 bg-gray-900 rounded hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
            >
              Edit User
            </Link>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
