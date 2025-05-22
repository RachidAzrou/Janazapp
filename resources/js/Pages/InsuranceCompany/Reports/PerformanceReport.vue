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
import { ref, watch } from "vue";

const currentTab = ref("files"); // default tab
const previousTab = ref(null);
const direction = ref(""); // 'left' or 'right'

function switchTab(tab) {
  if (tab !== activeTab.value) {
    direction.value =
      tab === "files" && activeTab.value === "funeral"
        ? "left"
        : tab === "funeral" && activeTab.value === "files"
        ? "right"
        : "";
    activeTab.value = tab;
  }
}

// Track which tab is active
const activeTab = ref("funeral");
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
            <SidebarLink href="/costreportic" :icon="FolderIcon" text="Cost Report" />
            <SidebarLink
              href="/performancereportic"
              :icon="FolderIcon"
              text="Performance Report"
              class="font-semibold"
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
        <h2 class="mt-1 text-2xl font-semibold">Reports > Performance Report</h2>
        <div class="flex items-center space-x-4">
          <button class="relative p-2 rounded-full hover:bg-gray-200">
            <BellIcon class="w-6 h-6 text-gray-600" />
          </button>
          <button class="p-2 rounded-full hover:bg-gray-200">
            <GlobeAltIcon class="w-6 h-6 text-gray-600" />
          </button>
        </div>
      </div>

      <!-- Tabs + Search Container -->
      <div class="flex items-center justify-between mb-4">
        <!-- Tabs -->
        <div class="flex space-x-2">
          <button
            @click="switchTab('funeral')"
            :class="[
              'px-4 py-2 font-semibold rounded',
              activeTab === 'funeral'
                ? 'text-gray-700 bg-gray-200'
                : 'text-gray-400 bg-gray-100',
            ]"
          >
            Funeral services
          </button>
          <button
            @click="switchTab('files')"
            :class="[
              'px-4 py-2 font-semibold rounded',
              activeTab === 'files'
                ? 'text-gray-700 bg-gray-200'
                : 'text-gray-400 bg-gray-100',
            ]"
          >
            Files
          </button>
        </div>

        <!-- Search & Filter -->
        <div class="flex items-center">
          <div class="relative w-64">
            <input
              type="text"
              placeholder="search"
              class="w-full py-2 pl-10 pr-4 text-sm border rounded-lg focus:outline-none focus:ring"
            />
            <svg
              class="absolute left-3 top-2.5 w-4 h-4 text-gray-400"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
              />
            </svg>
          </div>
          <button class="p-2 ml-2 border border-gray-300 rounded hover:bg-gray-100">
            <svg
              class="w-5 h-5 text-gray-500"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h10a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h4a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"
              />
            </svg>
          </button>
        </div>
      </div>

      <!-- Animated View -->
      <Transition
        :name="direction === 'left' ? 'slide-left' : 'slide-right'"
        mode="out-in"
      >
        <div :key="activeTab">
          <!-- Funeral Services View -->
          <div v-if="activeTab === 'funeral'">
            <!-- Table -->
            <div class="overflow-x-auto border border-gray-200 rounded">
              <table class="min-w-full text-sm text-left text-gray-600">
                <thead class="text-gray-500 uppercase bg-gray-100">
                  <tr>
                    <th class="px-6 py-3 font-medium">Funeral service</th>
                    <th class="px-6 py-3 font-medium">Number of files assigned</th>
                    <th class="px-6 py-3 font-medium">Avg processing time</th>
                    <th class="px-6 py-3 font-medium text-right">Action</th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                  <tr v-for="i in 10" :key="i" class="border-t">
                    <td
                      class="px-6 py-4 font-medium text-blue-600 cursor-pointer hover:underline"
                    >
                      Funeral service X
                    </td>
                    <td class="px-6 py-4">50</td>
                    <td class="px-6 py-4">XXd</td>
                    <td class="px-6 py-4 text-right">
                      <button
                        class="px-3 py-1 text-blue-600 border border-blue-600 rounded hover:bg-blue-50"
                      >
                        View
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- Pagination -->
            <div class="flex items-center justify-center mt-6 space-x-1">
              <button class="px-2 py-1 text-gray-400 hover:text-gray-600">&larr;</button>
              <button class="px-3 py-1 text-white bg-gray-800 rounded">1</button>
              <button class="px-3 py-1 text-gray-600 rounded hover:bg-gray-100">2</button>
              <button class="px-3 py-1 text-gray-600 rounded hover:bg-gray-100">3</button>
              <span class="px-2">...</span>
              <button class="px-3 py-1 text-gray-600 rounded hover:bg-gray-100">
                10
              </button>
              <button class="px-3 py-1 text-gray-600 rounded hover:bg-gray-100">
                11
              </button>
              <button class="px-2 py-1 text-gray-400 hover:text-gray-600">&rarr;</button>
            </div>
          </div>

          <!-- Files View -->
          <div v-else-if="activeTab === 'files'">
            <!-- Files Overview -->
            <div class="space-y-6">
              <!-- Summary Cards -->
              <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-5">
                <div class="flex items-center p-4 bg-gray-100 rounded shadow-sm">
                  <div class="w-2 h-2 mr-2 bg-blue-500 rounded-full"></div>
                  <span class="text-sm text-gray-700">Assigned (24)</span>
                </div>
                <div class="flex items-center p-4 bg-gray-100 rounded shadow-sm">
                  <div class="w-2 h-2 mr-2 bg-yellow-400 rounded-full"></div>
                  <span class="text-sm text-gray-700">In Progress (8)</span>
                </div>
                <div class="flex items-center p-4 bg-gray-100 rounded shadow-sm">
                  <div class="w-2 h-2 mr-2 bg-green-500 rounded-full"></div>
                  <span class="text-sm text-gray-700">Completed (36)</span>
                </div>
                <div class="flex items-center p-4 bg-gray-100 rounded shadow-sm">
                  <div class="w-2 h-2 mr-2 bg-red-500 rounded-full"></div>
                  <span class="text-sm text-gray-700">Rejected (4)</span>
                </div>
                <div class="flex items-center p-4 bg-gray-100 rounded shadow-sm">
                  <div class="w-2 h-2 mr-2 bg-purple-500 rounded-full"></div>
                  <span class="text-sm text-gray-700">Archived (12)</span>
                </div>
              </div>

              <div class="flex items-start gap-6">
                <!-- Files Table -->
                <div class="flex-1 overflow-x-auto border border-gray-200 rounded">
                  <table class="min-w-full text-sm text-left text-gray-600">
                    <thead class="text-gray-500 uppercase bg-gray-100">
                      <tr>
                        <th class="px-6 py-3 font-medium">File number</th>
                        <th class="px-6 py-3 font-medium">Name deceased</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Service</th>
                        <th class="px-6 py-3 font-medium">Created at</th>
                        <th class="px-6 py-3 font-medium text-right">Action</th>
                      </tr>
                    </thead>
                    <tbody class="bg-white">
                      <tr v-for="i in 10" :key="i" class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium text-blue-600">#12345</td>
                        <td class="px-6 py-4">Fatima Ibrahim</td>
                        <td class="px-6 py-4">
                          <span
                            class="inline-block px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded"
                          >
                            Completed
                          </span>
                        </td>
                        <td class="px-6 py-4">Al Jannat Services</td>
                        <td class="px-6 py-4">2024-12-01</td>
                        <td class="px-6 py-4 text-right">
                          <button
                            class="px-3 py-1 text-blue-600 border border-blue-600 rounded hover:bg-blue-50"
                          >
                            Open
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>

                <!-- Deadline Alerts -->
                <div class="bg-white border border-gray-200 rounded shadow w-80">
                  <!-- Header -->
                  <div
                    class="flex items-center justify-between px-4 py-3 border-b border-gray-100 bg-red-50"
                  >
                    <div class="flex items-center space-x-2">
                      <svg
                        class="w-5 h-5 text-red-600"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 9v2m0 4h.01M4.93 4.93l1.41 1.41M1 12h2m4.93 7.07l1.41-1.41M12 1v2m7.07 4.93l-1.41 1.41M21 12h2m-4.93 7.07l-1.41-1.41M12 21v2"
                        />
                      </svg>
                      <h3 class="text-sm font-semibold text-red-700">Deadline Alerts</h3>
                    </div>
                  </div>

                  <!-- Alerts List -->
                  <div class="p-4 space-y-3 text-sm text-gray-700">
                    <!-- Alert item -->
                    <div
                      class="flex items-start justify-between p-3 border border-red-200 rounded bg-red-50"
                    >
                      <div class="flex space-x-2">
                        <svg
                          class="w-4 h-4 mt-0.5 text-red-500"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v2m0 4h.01M4.93 4.93l1.41 1.41M1 12h2m4.93 7.07l1.41-1.41M12 1v2m7.07 4.93l-1.41 1.41M21 12h2m-4.93 7.07l-1.41-1.41M12 21v2"
                          />
                        </svg>
                        <div>
                          <p class="font-medium text-red-700">3 files are due today</p>
                          <p class="text-xs text-gray-500">Immediate action required</p>
                        </div>
                      </div>
                      <button
                        class="px-3 py-1 ml-3 text-xs font-medium text-red-600 border border-red-600 rounded hover:bg-red-100"
                      >
                        View
                      </button>
                    </div>

                    <div
                      class="flex items-start justify-between p-3 border border-yellow-200 rounded bg-yellow-50"
                    >
                      <div class="flex space-x-2">
                        <svg
                          class="w-4 h-4 mt-0.5 text-yellow-500"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v2m0 4h.01M4.93 4.93l1.41 1.41M1 12h2m4.93 7.07l1.41-1.41M12 1v2m7.07 4.93l-1.41 1.41M21 12h2m-4.93 7.07l-1.41-1.41M12 21v2"
                          />
                        </svg>
                        <div>
                          <p class="font-medium text-yellow-700">2 tasks are overdue</p>
                          <p class="text-xs text-gray-500">Check task list for details</p>
                        </div>
                      </div>
                      <button
                        class="px-3 py-1 ml-3 text-xs font-medium text-yellow-700 border border-yellow-500 rounded hover:bg-yellow-100"
                      >
                        View
                      </button>
                    </div>

                    <div
                      class="flex items-start justify-between p-3 border border-orange-200 rounded bg-orange-50"
                    >
                      <div class="flex space-x-2">
                        <svg
                          class="w-4 h-4 mt-0.5 text-orange-500"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          viewBox="0 0 24 24"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 9v2m0 4h.01M4.93 4.93l1.41 1.41M1 12h2m4.93 7.07l1.41-1.41M12 1v2m7.07 4.93l-1.41 1.41M21 12h2m-4.93 7.07l-1.41-1.41M12 21v2"
                          />
                        </svg>
                        <div>
                          <p class="font-medium text-orange-700">1 file is due in 24h</p>
                          <p class="text-xs text-gray-500">Prepare submission soon</p>
                        </div>
                      </div>
                      <button
                        class="px-3 py-1 ml-3 text-xs font-medium text-orange-700 border border-orange-500 rounded hover:bg-orange-100"
                      >
                        View
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Pagination -->
            <div class="flex items-center justify-center mt-6 space-x-1">
              <button class="px-2 py-1 text-gray-400 hover:text-gray-600">&larr;</button>
              <button class="px-3 py-1 text-white bg-gray-800 rounded">1</button>
              <button class="px-3 py-1 text-gray-600 rounded hover:bg-gray-100">2</button>
              <button class="px-3 py-1 text-gray-600 rounded hover:bg-gray-100">3</button>
              <span class="px-2">...</span>
              <button class="px-3 py-1 text-gray-600 rounded hover:bg-gray-100">
                10
              </button>
              <button class="px-3 py-1 text-gray-600 rounded hover:bg-gray-100">
                11
              </button>
              <button class="px-2 py-1 text-gray-400 hover:text-gray-600">&rarr;</button>
            </div>
          </div>
        </div>
      </Transition>
    </main>
  </div>
</template>

<style scoped>
.slide-left-enter-active,
.slide-left-leave-active,
.slide-right-enter-active,
.slide-right-leave-active {
  transition: all 0.3s ease;
  position: absolute;
  width: 100%;
}

.slide-left-enter-from {
  transform: translateX(100%);
  opacity: 0;
}
.slide-left-enter-to {
  transform: translateX(0);
  opacity: 1;
}
.slide-left-leave-from {
  transform: translateX(0);
  opacity: 1;
}
.slide-left-leave-to {
  transform: translateX(-100%);
  opacity: 0;
}

.slide-right-enter-from {
  transform: translateX(-100%);
  opacity: 0;
}
.slide-right-enter-to {
  transform: translateX(0);
  opacity: 1;
}
.slide-right-leave-from {
  transform: translateX(0);
  opacity: 1;
}
.slide-right-leave-to {
  transform: translateX(100%);
  opacity: 0;
}
</style>
