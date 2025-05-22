<script setup>
import {
  UserIcon,
  Squares2X2Icon,
  CheckCircleIcon,
  FolderIcon,
  DocumentTextIcon,
  ChatBubbleLeftRightIcon,
  Cog6ToothIcon,
  ArrowLeftStartOnRectangleIcon,
  BellIcon,
  GlobeAltIcon,
} from "@heroicons/vue/24/outline";

import { Link } from "@inertiajs/vue3";
import SidebarLink from "@/Components/SidebarLink.vue";
import SidebarGroup from "@/Components/SidebarGroup.vue";
import CostSummaryCard from "@/Components/Reports/CostSummaryCard.vue";
import { ref, computed } from "vue";

const filters = ref({ jaId: "", location: "" });
const currentPage = ref(1);
const perPage = 8;

const rows = ref(
  Array.from({ length: 20 }, () => ({
    jaId: "000185",
    location: "Country - city",
  }))
);

const filteredItems = computed(() => {
  return rows.value.filter(
    (row) =>
      row.jaId.includes(filters.value.jaId) &&
      row.location.toLowerCase().includes(filters.value.location.toLowerCase())
  );
});

const totalPages = computed(() => Math.ceil(filteredItems.value.length / perPage));

const paginatedItems = computed(() => {
  const start = (currentPage.value - 1) * perPage;
  return filteredItems.value.slice(start, start + perPage);
});

const prevPage = () => {
  if (currentPage.value > 1) currentPage.value--;
};

const nextPage = () => {
  if (currentPage.value < totalPages.value) currentPage.value++;
};
</script>

<template>
  <div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <aside class="flex flex-col justify-between p-6 bg-white border-r w-80">
      <div>
        <h1 class="mb-8 text-xl font-bold text-green-600">JanazApp</h1>

        <div class="flex items-center mb-6 space-x-3">
          <div
            class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full"
          >
            <UserIcon class="w-6 h-6 text-blue-600" />
          </div>
          <div>
            <div class="font-semibold">John Doe</div>
            <div class="text-sm text-gray-500">INC Agency</div>
          </div>
        </div>

        <nav class="space-y-1">
          <SidebarLink href="/dashboardic" :icon="Squares2X2Icon" text="Dashboard" />
          <SidebarLink
            href="/tasksmanagementic"
            :icon="CheckCircleIcon"
            text="Tasks Management"
          />
          <SidebarLink
            href="/filemanagementic"
            :icon="FolderIcon"
            text="File Management"
          />
          <SidebarGroup
            :icon="DocumentTextIcon"
            text="Reports"
            :active="true"
            href="/reportsic"
          >
            <SidebarLink
              href="/overviewreportic"
              :icon="FolderIcon"
              text="Files Report"
            />
            <SidebarLink
              href="/managementreportic"
              :icon="FolderIcon"
              text="Document Report"
            />
            <SidebarLink
              href="/costreportic"
              :icon="FolderIcon"
              text="Cost Report"
              class="font-semibold"
            />
            <SidebarLink
              href="/performancereportic"
              :icon="FolderIcon"
              text="Performance Report"
            />
          </SidebarGroup>

          <SidebarLink href="/chatic" :icon="ChatBubbleLeftRightIcon" text="Chat" />
          <SidebarLink href="/settingsic" :icon="Cog6ToothIcon" text="Settings" />
        </nav>
      </div>

      <Link
        href="/logout"
        class="flex items-center gap-2 text-sm text-left text-gray-500 hover:text-red-600"
      >
        <ArrowLeftStartOnRectangleIcon class="w-5 h-5" /> Logout
      </Link>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8">
      <!-- Page title -->
      <div class="flex items-center justify-between mb-6">
        <div>
          <h2 class="mt-1 text-2xl font-semibold">Reports > Cost Report</h2>
        </div>
        <div class="flex items-center space-x-4">
          <button class="relative p-2 rounded-full hover:bg-gray-200">
            <BellIcon class="w-6 h-6 text-gray-600" />
          </button>
          <button class="p-2 rounded-full hover:bg-gray-200">
            <GlobeAltIcon class="w-6 h-6 text-gray-600" />
          </button>
        </div>
      </div>
      <!-- Summary Cards -->
      <div class="grid grid-cols-1 gap-4 mb-6 sm:grid-cols-2 lg:grid-cols-4">
        <CostSummaryCard title="This month total cost" :amount="'85,396 €'" />
        <CostSummaryCard title="Transportation costs" :amount="'25,250 €'" />
        <CostSummaryCard title="Funeral expenses" :amount="'25,250 €'" />
        <CostSummaryCard title="Administrative fees" :amount="'25,250 €'" />
      </div>

      <!-- Filters + Export -->
      <div
        class="flex flex-wrap items-center justify-between gap-4 p-4 mb-4 bg-blue-50 rounded-xl"
      >
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
          <div class="text-sm font-medium text-gray-600">JA ID</div>
          <input
            v-model="filters.jaId"
            type="text"
            placeholder="search"
            class="w-full px-3 py-2 text-sm border rounded-md sm:w-48"
          />
          <div class="text-sm font-medium text-gray-600">Repatriation location</div>
          <input
            v-model="filters.location"
            type="text"
            placeholder="search"
            class="w-full px-3 py-2 text-sm border rounded-md sm:w-48"
          />
        </div>
        <button
          class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-lg hover:bg-green-700"
        >
          Export Report
        </button>
      </div>

      <!-- Table -->
      <div class="overflow-x-auto bg-white shadow-sm rounded-xl">
        <table class="w-full text-sm text-left text-gray-600">
          <thead class="font-medium text-gray-500 bg-blue-50">
            <tr>
              <th class="px-4 py-3">JA ID</th>
              <th class="px-4 py-3">Repatriation location</th>
              <th class="px-4 py-3">Full Repatriation cost</th>
              <th class="px-4 py-3">Transport</th>
              <th class="px-4 py-3">Funeral expenses</th>
              <th class="px-4 py-3">Administrative fees</th>
              <th class="px-4 py-3"></th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(row, i) in paginatedItems"
              :key="i"
              class="transition border-t hover:bg-gray-50"
            >
              <td class="px-4 py-3">{{ row.jaId }}</td>
              <td class="px-4 py-3">{{ row.location }}</td>
              <td class="px-4 py-3 font-medium text-blue-600 cursor-pointer">XXXXX</td>
              <td class="px-4 py-3 font-medium text-blue-600 cursor-pointer">XXXXX</td>
              <td class="px-4 py-3 font-medium text-blue-600 cursor-pointer">XXXXX</td>
              <td class="px-4 py-3 font-medium text-blue-600 cursor-pointer">XXXXX</td>
              <td class="px-4 py-3">
                <button
                  class="border px-4 py-1.5 rounded-md text-sm text-gray-700 hover:bg-gray-100"
                >
                  View
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="flex justify-end mt-6">
        <nav class="flex items-center space-x-1 text-sm">
          <button class="px-2 py-1 rounded hover:bg-gray-200" @click="prevPage">
            &larr;
          </button>
          <button
            v-for="n in totalPages"
            :key="n"
            @click="currentPage = n"
            :class="[
              'px-3 py-1 rounded',
              currentPage === n ? 'bg-gray-900 text-white' : 'hover:bg-gray-200',
            ]"
          >
            {{ n }}
          </button>
          <button class="px-2 py-1 rounded hover:bg-gray-200" @click="nextPage">
            &rarr;
          </button>
        </nav>
      </div>
    </main>
  </div>
</template>
