<script setup>
import { defineProps, onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
  faPlus,
  faAsterisk,
  faClock,
  faMonument,
  faCalendarDays,
  faCalendarCheck,
  faCalendarXmark,
  faFileCircleQuestion,
  faSignature,
  faRotateRight,
  faVenusMars,
  faClipboardQuestion,
  faLocationPin,
  faCalendarDay,
  faBuildingShield,
  faPlane,
  faFingerprint,
  faHashtag,
  faLocationCrosshairs,
} from "@fortawesome/free-solid-svg-icons";
import { format } from "date-fns";

function formatDate(date) {
  return format(new Date(date), "yyyy-MM-dd HH:mm");
}

function formatMetadata(metadata) {
  const parsedMetadata = JSON.parse(JSON.parse(JSON.stringify(metadata)));
  console.log(parsedMetadata);
  const oldData = parsedMetadata.old;
  const newData = parsedMetadata.new;
  let changes = [];

  for (let key in oldData) {
    if (key !== "updated_at" && oldData[key] !== newData[key]) {
      changes.push(`${key}: ${oldData[key]} -> ${newData[key]}`);
    }
  }
  console.log(changes);
  return changes.join("\n");
}

function userName(user_id) {
  const user = props.users.find((user) => user.id === user_id);
  return user.name;
}

onMounted(() => {
  console.log(props.users);
});

const props = defineProps({
  cases: Object,
  caseActivities: Array,
  users: Array,
});
</script>

<template>
  <Head :title="'Case Details: ' + cases.deceased_details.name" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          Case Details: {{ cases.deceased_details.name }}
        </h2>
        <Link
          :href="'/cases/' + cases.id + '/history'"
          class="font-bold text-gray-900 duration-200 hover:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
        >
          Case Activity History
        </Link>
      </div>
    </template>

    <div class="flex items-stretch justify-center p-6 bg-gray-100 sm:py-10">
      <!-- Left Panel -->
      <div class="w-1/4 p-4 bg-white shadow-lg sm:rounded-lg">
        <h3 class="text-lg font-bold text-gray-800">Case Team</h3>
        <div class="mt-4 space-y-2">
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faFingerprint" class="mr-1" />Insurance Agent
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.assigned_insurance.name || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faFingerprint" class="mr-1" />Dispatcher
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.assigned_dispatcher.name || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faFingerprint" class="mr-1" />Funeral Service
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.assigned_funeral_service.name || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faFingerprint" class="mr-1" />Expeditor
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.assigned_expeditor.name || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faFingerprint" class="mr-1" />Hospital Staff
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.assigned_hospital.name || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faFingerprint" class="mr-1" />Mosque Admin
            </p>
            <p class="text-lg text-gray-800">{{ cases.assigned_mosque.name || "N/A" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faFingerprint" class="mr-1" />Mortuary Admin
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.assigned_mortuary.name || "N/A" }}
            </p>
          </div>
        </div>
      </div>

      <!-- Middle Panel -->
      <div class="w-1/2 p-6 mx-4 bg-white shadow-lg sm:rounded-lg">
        <h3 class="text-lg font-bold text-gray-800">Case Details</h3>
        <div class="mt-4 space-y-2">
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faPlus" class="mr-1" />Created By
            </p>
            <p class="text-lg text-gray-800">{{ cases.created_by || "N/A" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faAsterisk" class="mr-1" />Reference Number
            </p>
            <p class="text-lg text-gray-800">{{ cases.reference_number || "N/A" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faClock" class="mr-1" />Status
            </p>
            <p class="text-lg text-gray-800" v-if="cases.status === 'new'">New</p>
            <p
              class="text-lg text-gray-800"
              v-if="cases.status === 'pending_verification'"
            >
              Pending Verification
            </p>
            <p class="text-lg text-gray-800" v-if="cases.status === 'in_progress'">
              In Progress
            </p>
            <p class="text-lg text-gray-800" v-if="cases.status === 'pending_documents'">
              Pending Documents
            </p>
            <p class="text-lg text-gray-800" v-if="cases.status === 'pending_approval'">
              Pending Approval
            </p>
            <p class="text-lg text-gray-800" v-if="cases.status === 'approved'">
              Approved
            </p>
            <p class="text-lg text-gray-800" v-if="cases.status === 'in_transit'">
              In Transit
            </p>
            <p class="text-lg text-gray-800" v-if="cases.status === 'completed'">
              Completed
            </p>
            <p class="text-lg text-gray-800" v-if="cases.status === 'cancelled'">
              Cancelled
            </p>
            <p class="text-lg text-gray-800" v-if="cases.status === 'on_hold'">On Hold</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faMonument" class="mr-1" />Burial Type
            </p>
            <p class="text-lg text-gray-800" v-if="cases.burial_type === 'local'">
              Local
            </p>
            <p class="text-lg text-gray-800" v-if="cases.burial_type === 'repatriation'">
              Repatriation
            </p>
            <p class="text-lg text-gray-800" v-if="!cases.burial_type">N/A</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faCalendarDays" class="mr-1" />Estimated Completion
              Date
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.estimated_completion_date || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faCalendarCheck" class="mr-1" />Completed At
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.completed_at ? formatDate(cases.completed_at) : "Never" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faCalendarXmark" class="mr-1" />Cancelled At
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.cancelled_at ? formatDate(cases.cancelled_at) : "Never" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faFileCircleQuestion" class="mr-1" />Cancellation
              Reason
            </p>
            <p class="text-lg text-gray-800">{{ cases.cancellation_reason || "N/A" }}</p>
          </div>
        </div>
        <div class="flex justify-between mt-32">
          <Link
            :href="'/cases/'"
            class="px-6 py-2 font-medium text-white duration-300 bg-gray-900 rounded hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
          >
            Back to Cases
          </Link>
          <div class="flex gap-2">
            <Link
              :href="'/cases/' + cases.id + '/addDocument'"
              class="px-6 py-2 font-medium text-white duration-300 bg-gray-900 rounded hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
            >
              Add Document
            </Link>
            <Link
              :href="'/cases/' + cases.id + '/edit'"
              class="px-6 py-2 font-medium text-white duration-300 bg-gray-900 rounded hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
            >
              Edit Case Details
            </Link>
          </div>
        </div>
      </div>

      <!-- Right Panel -->
      <div class="w-1/4 p-4 bg-white shadow-lg sm:rounded-lg">
        <h3 class="text-lg font-bold text-gray-800">Deceased Information</h3>
        <div class="mt-4 space-y-2">
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faSignature" class="mr-1" />Deceased Name
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.deceased_details.name || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faRotateRight" class="mr-1" />Deceased Age
            </p>
            <p class="text-lg text-gray-800">{{ cases.deceased_details.age || "N/A" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faVenusMars" class="mr-1" />Deceased Gender
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.deceased_details.gender || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faClipboardQuestion" class="mr-1" />Death Cause
            </p>
            <p class="text-lg text-gray-800" v-if="cases.death_type === 'natural'">
              Natural - {{ cases.death_details.cause }}
            </p>
            <p class="text-lg text-gray-800" v-if="cases.death_type === 'accident'">
              Accident - {{ cases.death_details.cause }}
            </p>
            <p class="text-lg text-gray-800" v-if="cases.death_type === 'hospital'">
              Hospital - {{ cases.death_details.cause }}
            </p>
            <p class="text-lg text-gray-800" v-if="cases.death_type === 'other'">
              Other - {{ cases.death_details.cause }}
            </p>
            <p class="text-lg text-gray-800" v-if="!cases.death_type">N/A</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faClock" class="mr-1" />Time of Death
            </p>
            <p class="text-lg text-gray-800">{{ cases.death_details.date || "N/A" }}</p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faLocationCrosshairs" class="mr-1" />City
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.location_details.city || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faLocationPin" class="mr-1" />Country
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.location_details.country || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faHashtag" class="mr-1" />Insurance Policy Number
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.insurance_details.policy_number || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faBuildingShield" class="mr-1" />Insurance Provider
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.insurance_details.provider || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faPlane" class="mr-1" />Destination
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.repatriation_details.destination || "N/A" }}
            </p>
          </div>
          <div>
            <p class="text-sm font-semibold text-gray-500">
              <FontAwesomeIcon :icon="faCalendarDay" class="mr-1" />Expected Date
            </p>
            <p class="text-lg text-gray-800">
              {{ cases.repatriation_details.expected_date || "N/A" }}
            </p>
          </div>
        </div>
      </div>
    </div>
    <div class="max-w-4xl p-6 mx-auto mt-2 bg-white rounded-lg shadow-md case-activities">
  <h3 class="mb-4 text-2xl font-semibold text-gray-800">Case Activity History</h3>
  <ul class="space-y-4">
    <li
      v-for="activity in sortedCaseActivities"
      :key="activity.id"
      class="p-4 rounded-lg shadow-sm bg-gray-50"
    >
      <div class="flex flex-col md:flex-row md:space-x-4">
        <span class="text-sm font-medium text-gray-600">{{
          formatDate(activity.created_at)
        }}</span>
        <span class="text-sm font-medium text-gray-600">{{
          activity.activity_type
        }}</span>
        <span class="text-sm font-medium text-gray-600">{{
          userName(activity.user_id)
        }}</span>
      </div>
      <div class="mt-2">
        <em class="text-gray-700">{{ activity.description }}</em>
      </div>
      <pre class="p-2 mt-2 text-xs text-gray-600 bg-gray-100 rounded-md">{{
        formatMetadata(activity.metadata)
      }}</pre>
    </li>
  </ul>
</div>
  </AuthenticatedLayout>
</template>

<script>
export default {
  computed: {
    sortedCaseActivities() {
      return [...this.caseActivities].sort(
        (a, b) => new Date(b.created_at) - new Date(a.created_at)
      );
    },
  },
};
</script>
