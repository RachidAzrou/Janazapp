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
import { ref, computed } from "vue";

const search = ref("");
const currentPage = ref(1);
const perPage = 7;

const items = ref([
  {
    jzId: "001234",
    nameOfDeceased: "Name of Deceased",
    missingCount: 2,
    responsible: "Name of Responsible",
  },
  {
    jzId: "001234",
    nameOfDeceased: "Name of Deceased",
    missingCount: 2,
    responsible: "Name of Responsible",
  },
  {
    jzId: "001234",
    nameOfDeceased: "Name of Deceased",
    missingCount: 2,
    responsible: "Name of Responsible",
  },
  {
    jzId: "001234",
    nameOfDeceased: "Name of Deceased",
    missingCount: 2,
    responsible: "Name of Responsible",
  },
  {
    jzId: "001234",
    nameOfDeceased: "Name of Deceased",
    missingCount: 2,
    responsible: "Name of Responsible",
  },
  {
    jzId: "001234",
    nameOfDeceased: "Name of Deceased",
    missingCount: 2,
    responsible: "Name of Responsible",
  },
  {
    jzId: "001234",
    nameOfDeceased: "Name of Deceased",
    missingCount: 2,
    responsible: "Name of Responsible",
  },
  {
    jzId: "001234",
    nameOfDeceased: "Name of Deceased",
    missingCount: 2,
    responsible: "Name of Responsible",
  },
  {
    jzId: "001234",
    nameOfDeceased: "Name of Deceased",
    missingCount: 2,
    responsible: "Name of Responsible",
  },
]);

const totalPages = computed(() => Math.ceil(items.value.length / perPage));

const filteredItems = computed(() => {
  const start = (currentPage.value - 1) * perPage;
  return items.value
    .filter(
      (item) =>
        item.jzId.includes(search.value) ||
        item.nameOfDeceased.toLowerCase().includes(search.value.toLowerCase()) ||
        item.responsible.toLowerCase().includes(search.value.toLowerCase())
    )
    .slice(start, start + perPage);
});
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
              class="font-semibold"
            />
            <SidebarLink href="/costreportic" :icon="FolderIcon" text="Cost Report" />
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
          <h2 class="mt-1 text-2xl font-semibold">
            Reports > Document Management Report
          </h2>
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

      <!-- Report Container -->
      <div class="p-6 shadow-sm bg-indigo-50 rounded-2xl">
        <!-- Section Title -->
        <div class="mb-4 text-lg font-semibold text-gray-800">Missing documents:</div>

        <!-- Filter -->
        <div class="w-full max-w-xs mb-6">
            JZ ID
          <input
            v-model="search"
            type="text"
            placeholder="search"
            class="w-full px-3 py-2 text-sm border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <!-- List -->
        <div
          v-for="(item, index) in filteredItems"
          :key="index"
          class="flex items-center justify-between px-4 py-3 mb-3 bg-white border border-gray-200 rounded-lg shadow-sm"
        >
          <div class="text-sm text-gray-600">
            <div class="font-semibold text-gray-800">JZ ID: {{ item.jzId }}</div>
            <div>{{ item.nameOfDeceased }}</div>
          </div>
          <div class="text-sm font-medium text-red-600">
            <span>Missing documents:</span>
            <span class="ml-1 font-semibold"
              >🔴 {{ item.missingCount }} Missing documents</span
            >
          </div>
          <div class="text-sm text-gray-600">
            <span>Responsible:</span>
            <div class="font-semibold text-gray-800">{{ item.responsible }}</div>
          </div>
          <button
            class="text-sm px-4 py-1.5 rounded-md border border-gray-300 hover:bg-gray-100 text-gray-700"
          >
            View
          </button>
        </div>

        <!-- Pagination -->
        <div
          class="flex items-center justify-center mt-6 space-x-1 text-sm text-gray-600"
        >
          <button class="px-2 py-1 rounded hover:bg-gray-200">&larr;</button>
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
          <button class="px-2 py-1 rounded hover:bg-gray-200">&rarr;</button>
        </div>
      </div>
    </main>
  </div>
</template>
