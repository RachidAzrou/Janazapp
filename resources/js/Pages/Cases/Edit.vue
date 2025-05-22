<script setup>
import { defineProps, onMounted, ref } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

// Props for the page
const props = defineProps({
  cases: Object,
  statuses: Array,
  burialTypes: Array,
  deathTypes: Array,
});

// Reactive form data
const form = ref({
  id: props.cases.id || "",
  status: props.cases.status || "",
  burial_type: props.cases.burial_type || "",
  death_type: props.cases.death_type || "",
  estimated_completion_date: props.cases.estimated_completion_date || "",
  completed_at: props.cases.completed_at || "",
  cancelled_at: props.cases.cancelled_at || "",
  cancellation_reason: props.cases.cancellation_reason || "",
  deceased_details: {
    name: props.cases.deceased_details?.name || "",
    age: props.cases.deceased_details?.age || "",
    gender: props.cases.deceased_details?.gender || "",
  },
  death_details: {
    cause: props.cases.death_details?.cause || "",
    date: props.cases.death_details?.date || "",
  },
  location_details: {
    city: props.cases.location_details?.city || "",
    country: props.cases.location_details?.country || "",
  },
  insurance_details: {
    policy_number: props.cases.insurance_details?.policy_number || "",
    provider: props.cases.insurance_details?.provider || "",
  },
  repatriation_details: {
    destination: props.cases.repatriation_details?.destination || "",
    expected_date: props.cases.repatriation_details?.expected_date || "",
  },
  assigned_insurance: {
    id: props.cases.assigned_insurance?.id || "",
    name: props.cases.assigned_insurance?.name || "",
  },
  assigned_dispatcher: {
    id: props.cases.assigned_dispatcher?.id || "",
    name: props.cases.assigned_dispatcher?.name || "",
  },
  assigned_funeral_service: {
    id: props.cases.assigned_funeral_service?.id || "",
    name: props.cases.assigned_funeral_service?.name || "",
  },
  assigned_expeditor: {
    id: props.cases.assigned_expeditor?.id || "",
    name: props.cases.assigned_expeditor?.name || "",
  },
  assigned_hospital: {
    id: props.cases.assigned_hospital?.id || "",
    name: props.cases.assigned_hospital?.name || "",
  },
  assigned_mosque: {
    id: props.cases.assigned_mosque?.id || "",
    name: props.cases.assigned_mosque?.name || "",
  },
  assigned_mortuary: {
    id: props.cases.assigned_mortuary?.id || "",
    name: props.cases.assigned_mortuary?.name || "",
  },
});

const submitForm = () => {
  Inertia.post(`/cases/${form.value.id}/details`, form.value);
};

// Log cases data when the component is mounted
onMounted(() => {
  console.log(props.cases);
});

console.log(form.value);
</script>

<template>
  <Head :title="'Edit ' + cases.deceased_details.name" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Edit Details of {{ cases.deceased_details.name }}
      </h2>
    </template>

    <div class="container p-6 mx-auto">
      <form @submit.prevent="submitForm" class="space-y-8">
        <!-- Case Details Section -->
        <section class="p-6 bg-white rounded-lg shadow-md">
          <h2 class="pb-2 mb-4 text-xl font-semibold border-b">Case Details</h2>
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
              <label for="status" class="block font-medium">Status</label>
              <select
                id="status"
                v-model="form.status"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              >
                <option value="new">New</option>
                <option value="pending_verification">Pending Verification</option>
                <option value="in_progress">In Progress</option>
                <option value="pending_documents">Pending Documents</option>
                <option value="pending_approval">Pending Approval</option>
                <option value="approved">Approved</option>
                <option value="in_transit">In Transit</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
                <option value="on_hold">On Hold</option>
              </select>
            </div>
            <div>
              <label class="block font-medium">Burial Type</label>
              <div class="pt-2 mt-1">
                <label class="inline-flex items-center">
                  <input
                    type="radio"
                    name="burialType"
                    value="repatriation"
                    v-model="form.burial_type"
                    required
                    class="form-radio"
                  />
                  <span class="ml-2">Repatriation</span>
                </label>
                <label class="inline-flex items-center ml-4">
                  <input
                    type="radio"
                    name="burialType"
                    value="local"
                    v-model="form.burial_type"
                    class="form-radio"
                  />
                  <span class="ml-2">Local</span>
                </label>
              </div>
            </div>
            <div>
              <label for="estimatedCompletionDate" class="block font-medium"
                >Estimated Completion Date</label
              >
              <input
                id="estimatedCompletionDate"
                v-model="form.estimated_completion_date"
                type="date"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="completedAt" class="block font-medium">Completed At</label>
              <input
                id="completedAt"
                v-model="form.completed_at"
                type="datetime-local"
                min="1800-01-01T00:00"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="cancelledAt" class="block font-medium">Cancelled At</label>
              <input
                id="cancelledAt"
                v-model="form.cancelled_at"
                type="datetime-local"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="cancellationReason" class="block font-medium"
                >Cancellation Reason</label
              >
              <input
                id="cancellationReason"
                v-model="form.cancellation_reason"
                type="text"
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
          </div>
        </section>

        <!-- Deceased Information Section -->
        <section class="p-6 bg-white rounded-lg shadow-md">
          <h2 class="pb-2 mb-4 text-xl font-semibold border-b">Deceased Information</h2>
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
              <label for="name" class="block font-medium">Name</label>
              <input
                id="name"
                v-model="form.deceased_details.name"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="age" class="block font-medium">Age</label>
              <input
                id="age"
                v-model="form.deceased_details.age"
                type="number"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label class="block font-medium">Gender</label>
              <div class="pt-2 mt-1">
                <label class="inline-flex items-center">
                  <input
                    type="radio"
                    name="gender"
                    id="gender_male"
                    value="male"
                    v-model="form.deceased_details.gender"
                    class="form-radio"
                  />
                  <span class="ml-2">Male</span>
                </label>
                <label class="inline-flex items-center ml-4">
                  <input
                    type="radio"
                    name="gender"
                    id="gender_female"
                    value="female"
                    v-model="form.deceased_details.gender"
                    class="form-radio"
                  />
                  <span class="ml-2">Female</span>
                </label>
              </div>
            </div>
            <div>
              <label for="deathType" class="block font-medium">Death Type</label>
              <select
                id="deathType"
                v-model="form.death_type"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              >
                <option v-for="type in deathTypes" :key="type" :value="type">
                  <span v-if="type === 'natural'">Natural</span>
                  <span v-if="type === 'accident'">Accident</span>
                  <span v-if="type === 'hospital'">Hospital</span>
                  <span v-if="type === 'other'">Other</span>
                </option>
              </select>
            </div>
            <div>
              <label for="deathCause" class="block font-medium">Death Cause</label>
              <input
                id="deathCause"
                v-model="form.death_details.cause"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="timeOfDeath" class="block font-medium">Time of Death</label>
              <input
                id="timeOfDeath"
                v-model="form.death_details.date"
                type="date"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="city" class="block font-medium">City</label>
              <input
                id="city"
                v-model="form.location_details.city"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="country" class="block font-medium">Country</label>
              <input
                id="country"
                v-model="form.location_details.country"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="insuranceNumber" class="block font-medium"
                >Insurance Policy Number</label
              >
              <input
                id="insuranceNumber"
                v-model="form.insurance_details.policy_number"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="insuranceProvider" class="block font-medium"
                >Insurance Provider</label
              >
              <input
                id="insuranceProvider"
                v-model="form.insurance_details.provider"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="destination" class="block font-medium">Destination</label>
              <input
                id="destination"
                v-model="form.repatriation_details.destination"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="expectedDate" class="block font-medium">Expected Date</label>
              <input
                id="expectedDate"
                v-model="form.repatriation_details.expected_date"
                type="date"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
          </div>
        </section>

        <!-- Case Team Section -->
        <section class="p-6 bg-white rounded-lg shadow-md">
          <h2 class="pb-2 mb-4 text-xl font-semibold border-b">Case Team</h2>
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
              <label for="insuranceAgent" class="block font-medium"
                >Insurance Agent</label
              >
              <input
                id="insuranceAgent"
                v-model="form.assigned_insurance.name"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="dispatcher" class="block font-medium">Dispatcher</label>
              <input
                id="dispatcher"
                v-model="form.assigned_dispatcher.name"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="funeralService" class="block font-medium"
                >Funeral Service</label
              >
              <input
                id="funeralService"
                v-model="form.assigned_funeral_service.name"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="expeditor" class="block font-medium">Expeditor</label>
              <input
                id="expeditor"
                v-model="form.assigned_expeditor.name"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="hospitalStaff" class="block font-medium">Hospital Staff</label>
              <input
                id="hospitalStaff"
                v-model="form.assigned_hospital.name"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="mosqueAdmin" class="block font-medium">Mosque Admin</label>
              <input
                id="mosqueAdmin"
                v-model="form.assigned_mosque.name"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
            <div>
              <label for="mortuaryAdmin" class="block font-medium">Mortuary Admin</label>
              <input
                id="mortuaryAdmin"
                v-model="form.assigned_mortuary.name"
                type="text"
                required
                class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"
              />
            </div>
          </div>
        </section>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
          <Link
            :href="'/cases/' + cases.id + '/details'"
            class="text-sm text-gray-900 duration-300 hover:text-muted-foreground"
          >
            Cancel
          </Link>
          <button
            type="submit"
            class="px-6 py-2 text-white duration-300 bg-gray-900 rounded-md shadow-sm hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
          >
            Save Changes
          </button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script>
export default {
  // methods: {
  //   getStatusLabel(status) {
  //     switch (status) {
  //       case "new":
  //         return "New";
  //       case "pending_verification":
  //         return "Pending Verification";
  //       case "in_progress":
  //         return "In Progress";
  //       case "pending_documents":
  //         return "Pending Documents";
  //       case "pending_approval":
  //         return "Pending Approval";
  //       case "approved":
  //         return "Approved";
  //       case "in_transit":
  //         return "In Transit";
  //       case "completed":
  //         return "Completed";
  //       case "cancelled":
  //         return "Cancelled";
  //       case "on_hold":
  //         return "On Hold";
  //       default:
  //         return status; // Fallback to status value if no match
  //     }
  //   },
  // },
};
</script>
