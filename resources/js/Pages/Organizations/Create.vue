<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import axios from "axios";
</script>

<template>
  <Head title="Create Organization" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-2xl font-bold leading-tight text-gray-800">Create Organization</h2>
    </template>

    <div class="max-w-4xl px-6 py-8 mx-auto mt-6 bg-white rounded-lg shadow-lg">
      <h1 class="mb-4 text-3xl font-semibold text-gray-700">New Organization</h1>

      <!-- Success message -->
      <div
        v-if="success === true"
        class="p-4 mb-4 text-green-700 bg-green-100 rounded-md"
      >
        {{ message }}
      </div>

      <!-- Error Message -->
      <div v-if="success === false" class="p-4 mb-4 text-red-700 bg-red-100 rounded-md">
        {{ message }}
      </div>

      <div></div>

      <form @submit.prevent="submitForm" class="space-y-6">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700"
              >Name <span class="font-bold text-red-600">*</span></label
            >
            <input
              v-model="form.name"
              type="text"
              id="name"
              required
              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700"
              >Email <span class="font-bold text-red-600">*</span></label
            >
            <input
              v-model="form.email"
              type="email"
              id="email"
              required
              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >Phone <span class="font-bold text-red-600">*</span></label
            >
            <input
              v-model="form.phone"
              type="text"
              id="phone"
              required
              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="type" class="block text-sm font-medium text-gray-700"
              >Type <span class="font-bold text-red-600">*</span></label
            >
            <input
              v-model="form.type"
              type="text"
              id="type"
              required
              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label
              for="registration_number"
              class="block text-sm font-medium text-gray-700"
            >
              Registration Number <span class="font-bold text-red-600">*</span>
            </label>
            <input
              v-model="form.registration_number"
              type="text"
              id="registration_number"
              required
              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="tax_number" class="block text-sm font-medium text-gray-700"
              >Tax Number <span class="font-bold text-red-600">*</span></label
            >
            <input
              v-model="form.tax_number"
              type="text"
              id="tax_number"
              required
              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>
        </div>

        <div>
          <label for="address_line1" class="block text-sm font-medium text-gray-700">
            Address Line 1 <span class="font-bold text-red-600">*</span>
          </label>
          <input
            v-model="form.address_line1"
            type="text"
            id="address_line1"
            required
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
          />
        </div>

        <div>
          <label for="address_line2" class="block text-sm font-medium text-gray-700">
            Address Line 2
          </label>
          <input
            v-model="form.address_line2"
            type="text"
            id="address_line2"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
          />
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-3">
          <div>
            <label for="city" class="block text-sm font-medium text-gray-700"
              >City <span class="font-bold text-red-600">*</span></label
            >
            <input
              v-model="form.city"
              type="text"
              id="city"
              required
              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="state" class="block text-sm font-medium text-gray-700"
              >State <span class="font-bold text-red-600">*</span></label
            >
            <input
              v-model="form.state"
              type="text"
              id="state"
              required
              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="postal_code" class="block text-sm font-medium text-gray-700"
              >Postal Code <span class="font-bold text-red-600">*</span></label
            >
            <input
              v-model="form.postal_code"
              type="text"
              id="postal_code"
              required
              class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>
        </div>

        <div>
          <label for="country" class="block text-sm font-medium text-gray-700"
            >Country <span class="font-bold text-red-600">*</span></label
          >
          <input
            v-model="form.country"
            type="text"
            id="country"
            required
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
          />
        </div>

        <div>
          <label for="website" class="block text-sm font-medium text-gray-700"
            >Website</label
          >
          <input
            v-model="form.website"
            type="text"
            id="website"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-muted-foreground focus:border-muted-foreground"
          />
        </div>

        <div class="flex items-center justify-between">
          <Link
            :href="'/organizations/'"
            class="text-sm text-gray-900 duration-300 hover:text-muted-foreground"
          >
            Cancel
          </Link>

          <button
            type="submit"
            class="px-6 py-2 text-sm font-medium text-white bg-gray-900 rounded-md hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground ring-offset-2"
          >
            Create Organization
          </button>
        </div>
      </form>
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
        name: "",
        type: "",
        registration_number: "",
        tax_number: "",
        address_line1: "",
        address_line2: "",
        city: "",
        state: "",
        postal_code: "",
        country: "",
        phone: "",
        email: "",
        website: "",
      },
    };
  },
  methods: {
    async submitForm() {
      try {
        const response = await axios.post("/organizations", this.form);
        if (response.data) {
          this.success = response.data.success;
          this.message = response.data.message;
        }
        this.form = {}; // Reset the form after successful submission.
      } catch (error) {
        this.success = false;
        if (error.response.data.message) {
          this.message = error.response.data.message;
        } else {
          this.message = "Unknown error.";
        }
      }
    },
  },
};
</script>
