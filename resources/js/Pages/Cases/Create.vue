<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
</script>

<template>
  <Head title="Create Case" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-2xl font-bold leading-tight text-gray-800">Create Case</h2>
    </template>

    <div class="flex items-center justify-center px-4 py-8 sm:px-6 lg:px-8">
      <div class="w-full max-w-lg p-6 bg-white rounded-lg shadow-md">
        <h1 class="mb-6 text-2xl font-bold text-gray-800">New Case</h1>

        <!-- Success message -->
        <div
          v-if="success === true"
          class="p-4 mb-4 text-green-700 bg-green-100 border border-green-300 rounded-md"
        >
          {{ message }}
        </div>

        <!-- Error message -->
        <div
          v-if="success === false"
          class="p-4 mb-4 text-red-700 bg-red-100 border border-red-300 rounded-md"
        >
          {{ message }}
        </div>

        <form @submit.prevent="submitForm" class="space-y-6">
          <!-- Deceased Name -->
          <div>
            <label
              for="deceased_name"
              class="block text-sm font-medium text-gray-700"
            >
              Deceased Name <span class="font-bold text-red-600">*</span>
            </label>
            <input
              v-model="form.deceased_name"
              type="text"
              id="deceased_name"
              required
              class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
          </div>

          <!-- Age -->
          <div>
            <label for="deceased_age" class="block text-sm font-medium text-gray-700">
              Age <span class="font-bold text-red-600">*</span>
            </label>
            <input
              v-model="form.deceased_age"
              type="number"
              id="deceased_age"
              required
              class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            />
          </div>

          <!-- Gender -->
          <div>
            <label class="block text-sm font-medium text-gray-700">
              Gender <span class="font-bold text-red-600">*</span>
            </label>
            <div class="flex items-center mt-1 space-x-6">
              <label class="flex items-center">
                <input
                  type="radio"
                  name="deceased_gender"
                  value="male"
                  v-model="form.deceased_gender"
                  class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                />
                <span class="ml-2 text-gray-700">Male</span>
              </label>
              <label class="flex items-center">
                <input
                  type="radio"
                  name="deceased_gender"
                  value="female"
                  v-model="form.deceased_gender"
                  class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                />
                <span class="ml-2 text-gray-700">Female</span>
              </label>
            </div>
          </div>

          <!-- Death Type -->
          <div>
            <label
              for="death_type"
              class="block text-sm font-medium text-gray-700"
            >
              Death Type <span class="font-bold text-red-600">*</span>
            </label>
            <select
              v-model="form.death_type"
              id="death_type"
              required
              class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            >
              <option value="" disabled>Select death type</option>
              <option value="natural">Natural</option>
              <option value="accident">Accident</option>
              <option value="hospital">Hospital</option>
              <option value="other">Other</option>
            </select>
          </div>

          <!-- Burial Type -->
          <div>
            <label class="block text-sm font-medium text-gray-700">
              Burial Type <span class="font-bold text-red-600">*</span>
            </label>
            <div class="flex items-center mt-1 space-x-6">
              <label class="flex items-center">
                <input
                  type="radio"
                  name="burial_type"
                  value="local"
                  v-model="form.burial_type"
                  class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                />
                <span class="ml-2 text-gray-700">Local</span>
              </label>
              <label class="flex items-center">
                <input
                  type="radio"
                  name="burial_type"
                  value="repatriation"
                  v-model="form.burial_type"
                  class="text-indigo-600 border-gray-300 focus:ring-indigo-500"
                />
                <span class="ml-2 text-gray-700">Repatriation</span>
              </label>
            </div>
          </div>

          <!-- Repatriation Details -->
          <div v-if="form.burial_type === 'repatriation'">
            <div>
              <label
                for="destination"
                class="block text-sm font-medium text-gray-700"
              >
                Destination Country <span class="font-bold text-red-600">*</span>
              </label>
              <input
                v-model="form.destination"
                type="text"
                id="destination"
                required
                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
            <div class="mt-4">
              <label
                for="expected_date"
                class="block text-sm font-medium text-gray-700"
              >
                Repatriation Date <span class="font-bold text-red-600">*</span>
              </label>
              <input
                v-model="form.expected_date"
                type="date"
                id="expected_date"
                required
                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
          </div>

          <div>
              <label
                for="cause"
                class="block text-sm font-medium text-gray-700"
              >
                Death Cause <span class="font-bold text-red-600">*</span>
              </label>
              <input
                v-model="form.cause"
                type="text"
                id="cause"
                required
                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>
            <div class="mt-4">
              <label
                for="date"
                class="block text-sm font-medium text-gray-700"
              >
                Time of Death <span class="font-bold text-red-600">*</span>
              </label>
              <input
                v-model="form.date"
                type="date"
                id="date"
                required
                class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              />
            </div>

          <!-- Notes -->
          <div>
            <label
              for="notes"
              class="block text-sm font-medium text-gray-700"
            >
              Notes
            </label>
            <textarea
              v-model="form.notes"
              id="notes"
              rows="4"
              class="block w-full mt-1 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            ></textarea>
          </div>

          <div class="flex items-center justify-between">
            <Link
              :href="'/cases'"
              class="text-sm font-medium text-gray-600 hover:text-indigo-500"
            >
              Cancel
            </Link>
            <button
              type="submit"
              class="px-6 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
              Create Case
            </button>
          </div>
        </form>
      </div>
    </div>
  </AuthenticatedLayout>
</template>


<script>
export default {
  data() {
    return {
      success: null,
      message: "",
      form: {
        deceased_name: "",
        deceased_age: "",
        deceased_gender: "",
        death_type: "",
        burial_type: "",
        destination: "",
        expected_date: "",
        cause: "",
        date: "",
        notes: "",
        city: "",
        country: "",
      },
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post("/cases", this.form);
        if (response.data) {
          this.success = response.data.success;
          this.message = response.data.message;
          this.form = {}; // Reset the form after successful submission
        }
      } catch (error) {
        this.success = false;
        this.message =
          error.response?.data?.message || "An unexpected error occurred.";
      }
    },
  },
};
</script>
