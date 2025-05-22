<template>
  <Head title="Files" />
  <div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 shadow-sm">
      <div class="p-6 text-2xl font-semibold text-mint">File Management</div>
      <nav class="flex flex-col gap-2 px-4 mt-6">
        <SidebarLink icon="📊" label="Dashboard" to="/dashboarddispatcher" />
        <SidebarLink icon="📋" label="Tasks" to="/tasksdispatcher" />
        <SidebarLink icon="📁" label="Files" to="/filesdispatcher" />
        <SidebarLink icon="📈" label="Reports" to="/reportsdispatcher" />
        <SidebarLink icon="💬" label="Chat" to="/chatdispatcher" />
        <SidebarLink icon="⚙️" label="Settings" to="/settingsdispatcher" />
      </nav>
    </aside>

    <div class="flex justify-center flex-1 p-8 overflow-y-auto">
      <div class="w-full max-w-4xl">
        <div class="p-8 bg-white shadow-md rounded-xl">
          <form @submit.prevent="submitForm" class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Text Inputs -->
            <div>
              <label class="form-label">First Name</label>
              <input type="text" v-model="form.firstName" class="form-input" />
            </div>

            <div>
              <label class="form-label">Last Name</label>
              <input type="text" v-model="form.lastName" class="form-input" />
            </div>

            <div>
              <label class="form-label">JA ID</label>
              <input type="text" v-model="form.jaId" class="form-input" />
            </div>

            <div>
              <label class="form-label">NIS/RRN</label>
              <input type="text" v-model="form.nis" class="form-input" />
            </div>

            <!-- Date Pickers -->
            <div>
              <label class="form-label">Date Created (From)</label>
              <input type="date" v-model="form.dateFrom" class="form-input" />
            </div>

            <div>
              <label class="form-label">Date Created (Until)</label>
              <input type="date" v-model="form.dateUntil" class="form-input" />
            </div>

            <div>
              <label class="form-label">Birthdate</label>
              <input type="date" v-model="form.birthdate" class="form-input" />
            </div>

            <div>
              <label class="form-label">Country</label>
              <input type="text" v-model="form.country" class="form-input" />
            </div>

            <div>
              <label class="form-label">City</label>
              <input type="text" v-model="form.city" class="form-input" />
            </div>

            <!-- Funeral Service -->
            <div class="md:col-span-2">
              <label class="form-label">Funeral Service</label>
              <input
                type="text"
                v-model="form.serviceSearch"
                placeholder="Search funeral services..."
                class="mb-4 form-input"
              />

              <div class="flex items-center gap-6 mb-4">
                <label class="flex items-center">
                  <input
                    type="radio"
                    value="Local"
                    v-model="form.serviceType"
                    class="mr-2"
                  />
                  Local
                </label>
                <label class="flex items-center">
                  <input
                    type="radio"
                    value="Repatriation"
                    v-model="form.serviceType"
                    class="mr-2"
                  />
                  Repatriation
                </label>
              </div>

              <div v-if="form.serviceType === 'Repatriation'">
                <label class="form-label">Repatriation Country</label>
                <select v-model="form.repatriationCountry" class="form-input">
                  <option value="">Select a country</option>
                  <option v-for="country in countries" :key="country" :value="country">
                    {{ country }}
                  </option>
                </select>
              </div>
            </div>

            <div class="text-right md:col-span-2">
              <button
                type="submit"
                class="px-6 py-2 font-bold text-white shadow bg-mint hover:bg-mint-dark rounded-2xl"
              >
                Search
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { Head, router } from '@inertiajs/vue3';
import { ref } from 'vue';
import SidebarLink from '@/Components/SidebarLink.vue';

const form = ref({
  firstName: "",
  lastName: "",
  jaId: "",
  nis: "",
  dateFrom: "",
  dateUntil: "",
  birthdate: "",
  country: "",
  city: "",
  serviceSearch: "",
  serviceType: "",
  repatriationCountry: "",
});

const countries = [
  "Netherlands",
  "Belgium",
  "Germany",
  "United Kingdom",
  "Suriname",
  "United States",
];

const submitForm = () => {
  router.get('/filesearchdispatcher', form.value);
};
</script>

<style scoped>
.form-label {
  display: block;
  font-weight: 600;
  margin-bottom: 0.5rem;
  color: #333;
}

.form-input {
  width: 100%;
  padding: 0.5rem 0.75rem;
  border: 1px solid #ccc;
  border-radius: 0.75rem;
  font-size: 1rem;
}
</style>
