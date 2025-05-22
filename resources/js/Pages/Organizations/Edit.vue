<script setup>
import { defineProps, onMounted } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

// Log the organization data when the component is mounted
onMounted(() => {
  console.log(props.organization);
});

const props = defineProps({
  organization: Object,
});
</script>

<template>
  <Head :title="'Edit ' + organization.name" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
          Edit Details of {{ organization.name }}
        </h2>
        <!-- <button @click="deleteOrganization" class="px-6 py-1 text-sm text-white duration-300 bg-red-700 rounded-md shadow-sm hover:bg-red-300 focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2">
          Delete {{ organization.name }}
        </button> -->
      </div>
    </template>

    <div class="max-w-4xl mx-auto mt-8">
      <div class="p-6 bg-white rounded-lg shadow-md">
        <form @submit.prevent="submitForm" class="space-y-6">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input
              type="text"
              id="name"
              name="name"
              v-model="organization.name"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700"
              >Email</label
            >
            <input
              type="email"
              id="email"
              name="email"
              v-model="organization.email"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >Phone</label
            >
            <input
              type="text"
              id="phone"
              name="phone"
              v-model="organization.phone"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >Type</label
            >
            <input
              type="text"
              id="type"
              name="type"
              v-model="organization.type"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >Registration Number</label
            >
            <input
              type="text"
              id="registration_number"
              name="registration_number"
              v-model="organization.registration_number"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >Tax Number</label
            >
            <input
              type="text"
              id="tax_number"
              name="tax_number"
              v-model="organization.tax_number"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >Website</label
            >
            <input
              type="text"
              id="website"
              name="website"
              v-model="organization.website"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >Address Line 1</label
            >
            <input
              type="text"
              id="address_line1"
              name="address_line1"
              v-model="organization.address_line1"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >Address Line 2</label
            >
            <input
              type="text"
              id="address_line2"
              name="address_line2"
              v-model="organization.address_line2"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >City</label
            >
            <input
              type="text"
              id="city"
              name="city"
              v-model="organization.city"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >State</label
            >
            <input
              type="text"
              id="state"
              name="state"
              v-model="organization.state"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >Postal Code</label
            >
            <input
              type="text"
              id="postal_code"
              name="postal_code"
              v-model="organization.postal_code"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="phone" class="block text-sm font-medium text-gray-700"
              >Country</label
            >
            <input
              type="text"
              id="country"
              name="country"
              v-model="organization.country"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div class="flex items-center justify-between">
            <Link
              :href="'/organizations/' + organization.id + '/details'"
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
    </div>
  </AuthenticatedLayout>
</template>

<script>
export default {
  methods: {
    submitForm() {
      Inertia.post("/organizations/" + this.organization.id + "/details", {
        data: this.organization,
      });
    },

    deleteOrganization() {
      Inertia.delete("/organizations/" + this.organization.id, {});
    },
  },
};
</script>
