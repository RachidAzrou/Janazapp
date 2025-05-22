<script setup>
import { defineProps, onMounted, computed } from "vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

// Log the user data when the component is mounted
onMounted(() => {
  console.log(props.user);
});

const props = defineProps({
  user: Object,
  roles: Array,
  organizations: Array,
});

// Computed property for organization name
const organizationName = computed({
  get() {
    return props.user.organization?.name || ""; // Return organization name or empty string if undefined/null
  },
  set(value) {
    // Set the organization name (you can update the user object or handle saving in a different way)
    if (props.user.organization) {
      props.user.organization.name = value;
    } else {
      props.user.organization = { name: value }; // Handle if organization is null or undefined
    }
  },
});
</script>

<template>
  <Head :title="'Edit ' + user.name" />
  <AuthenticatedLayout>
    <template #header>
      <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Edit Details of {{ user.name }}
      </h2>
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
              v-model="user.name"
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
              v-model="user.email"
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
              v-model="user.phone"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="whatsapp_id" class="block text-sm font-medium text-gray-700"
              >WhatsApp ID</label
            >
            <input
              type="text"
              id="whatsapp_id"
              name="whatsapp_id"
              v-model="user.whatsapp_id"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            />
          </div>

          <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
            <select
              id="role"
              name="role"
              v-model="user.role_id"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            >
              <option disabled value="">Select a role</option>
              <!-- Map over the roles array to create options -->
              <option v-for="role in roles" :key="role.id" :value="role.id">
                {{ role.role_name }}
              </option>
            </select>
          </div>

          <div>
            <label for="organization" class="block text-sm font-medium text-gray-700"
              >Organization</label
            >
            <select
              id="organization"
              name="organization"
              v-model="user.organization_id"
              class="block w-full px-4 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:border-muted-foreground"
            >
              <option disabled value="">Select an organization</option>
              <!-- Map over the roles array to create options -->
              <option
                v-for="organization in organizations"
                :key="organization.id"
                :value="organization.id"
              >
                {{ organization.name }}
              </option>
            </select>
          </div>

          <div class="flex items-center justify-between">
            <Link
              :href="'/users/' + user.id + '/details'"
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
      Inertia.post("/users/" + this.user.id + "/details", {
        data: this.user,
      });
    },
  },
};
</script>
