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
import SummaryCard from "@/Components/Reports/SummaryCard.vue";
import FilterSelect from "@/Components/Reports/FilterSelect.vue";
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
              class="font-semibold"
            />
            <SidebarLink
              href="/managementreportic"
              :icon="FolderIcon"
              text="Document Report"
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
          <h2 class="mt-1 text-2xl font-semibold">Reports > Files Overview Report</h2>
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

      <div class="grid grid-cols-4 gap-4 mb-6">
        <SummaryCard icon="file" title="Total Files" value="253" color="gray" />
        <SummaryCard icon="check" title="Completed Files" value="180" color="green" />
        <SummaryCard icon="hourglass" title="Active Files" value="23" color="blue" />
        <SummaryCard icon="x" title="Canceled Files" value="50" color="red" />
      </div>

      <!-- Filters & Export -->
      <div class="flex items-end justify-between mb-4">
        <div class="flex items-center gap-4">
          <span class="min-w-[90px] text-gray-700">Time Period</span>
          <FilterSelect label="Time period" />
          <span class="min-w-[90px] text-gray-700">Region</span>
          <FilterSelect label="Region" />
          <span class="min-w-[120px] text-gray-700">Funeral Service</span>
          <FilterSelect label="Funeral Service" />
        </div>
        <button
          class="px-4 py-2 text-sm font-medium text-white bg-green-500 rounded hover:bg-green-600"
        >
          Export Report
        </button>
      </div>

      <!-- Table -->
      <div class="overflow-auto">
        <table class="w-full text-sm bg-white rounded shadow">
          <thead class="text-left text-gray-600 bg-gray-100">
            <tr>
              <th class="px-4 py-2">JA ID</th>
              <th class="px-4 py-2">Name of Deceased</th>
              <th class="px-4 py-2">Region</th>
              <th class="px-4 py-2">Status</th>
              <th class="px-4 py-2">Processing time</th>
              <th class="px-4 py-2"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="i in 10" :key="i" class="border-t">
              <td class="px-4 py-2">00185</td>
              <td class="px-4 py-2">Random name</td>
              <td class="px-4 py-2">Region name</td>
              <td class="px-4 py-2">
                <span
                  :class="[
                    'px-2 py-1 text-xs rounded-full font-semibold',
                    i % 3 === 0
                      ? 'bg-green-100 text-green-700'
                      : i % 3 === 1
                      ? 'bg-blue-100 text-blue-700'
                      : 'bg-yellow-100 text-yellow-700',
                  ]"
                >
                  {{ i % 3 === 0 ? "Completed" : i % 3 === 1 ? "Active" : "Canceled" }}
                </span>
              </td>
              <td class="px-4 py-2">XXh</td>
              <td class="px-4 py-2">
                <button class="text-sm text-blue-600 hover:underline">View</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="flex justify-center mt-4 space-x-1 text-sm text-gray-600">
        <button>&larr;</button>
        <button class="font-semibold text-black">1</button>
        <button>2</button>
        <button>3</button>
        <span>...</span>
        <button>10</button>
        <button>11</button>
        <button>&rarr;</button>
      </div>
    </main>
  </div>
</template>
