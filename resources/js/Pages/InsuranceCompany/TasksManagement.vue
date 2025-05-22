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
  ChevronDownIcon,
} from "@heroicons/vue/24/outline";

import { Link } from "@inertiajs/vue3";
import SidebarLink from "@/Components/SidebarLink.vue";
import TaskCard from "@/Components/Tasks/TaskCard.vue";
import { onMounted, onBeforeUnmount, ref } from "vue";

const activeTab = ref("personal");

const newTasks = [
  {
    name: "Tawfeeqa Sadeeqa Salahuddin",
    priority: "Low",
    jaId: "FID123456",
    created: "12/05/25",
    assigned: "15/05/25",
  },
  {
    name: "Hamsa Quman al-Haq",
    priority: "Low",
    jaId: "FID123456",
    created: "12/05/25",
    assigned: "15/05/25",
  },
];

const ongoingTasks = [
  {
    name: "Tawfeeqa Sadeeqa Salahuddin",
    priority: "Urgent",
    jaId: "FID123456",
    created: "12/05/25",
    assigned: "15/05/25",
  },
  {
    name: "Tawfeeqa Sadeeqa Salahuddin",
    priority: "Medium",
    jaId: "FID123456",
    created: "12/05/25",
    assigned: "15/05/25",
  },
  {
    name: "Tawfeeqa Sadeeqa Salahuddin",
    priority: "Medium",
    jaId: "FID123456",
    created: "12/05/25",
    assigned: "15/05/25",
  },
];

const completedTasks = [
  {
    name: "Shafeeqa Naafoora Saad",
    priority: "Completed",
    jaId: "FID123456",
    created: "12/05/25",
    assigned: "15/05/25",
  },
  {
    name: "Fawzi Humaidan Nasir",
    priority: "Completed",
    jaId: "FID123456",
    created: "12/05/25",
    assigned: "15/05/25",
  },
];

const selectedPriority = ref(""); // holds selected filter value

const priorities = [
  { label: "Urgent", class: "bg-red-100 text-red-800" },
  { label: "Medium", class: "bg-yellow-100 text-yellow-800" },
  { label: "Low", class: "bg-gray-200 text-gray-800" },
];

const filterByPriority = (tasks) => {
  if (!selectedPriority.value) return tasks;
  return tasks.filter((t) => t.priority === selectedPriority.value);
};

const dropdownOpen = ref(false);
const dropdownRef = ref(null);

const handleClickOutside = (e) => {
  if (dropdownRef.value && !dropdownRef.value.contains(e.target)) {
    dropdownOpen.value = false;
  }
};

onMounted(() => document.addEventListener("click", handleClickOutside));
onBeforeUnmount(() => document.removeEventListener("click", handleClickOutside));
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
            :active="true"
          />
          <SidebarLink
            href="/filemanagementic"
            :icon="FolderIcon"
            text="File Management"
          />
          <SidebarLink href="/reportsic" :icon="DocumentTextIcon" text="Reports" />
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
      <div class="flex items-center justify-between mb-6">
        <div>
          <h2 class="mt-1 text-2xl font-semibold">Tasks Management</h2>
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

      <!-- Tabs + Search & Filter -->
      <div class="flex items-center justify-between mb-4">
        <!-- Tabs -->
        <div class="flex gap-2">
          <button
            @click="activeTab = 'personal'"
            :class="[
              'px-4 py-2 text-sm font-medium border rounded',
              activeTab === 'personal'
                ? 'bg-gray-100 text-black'
                : 'bg-white text-gray-400',
            ]"
          >
            Personal Basket
          </button>
          <button
            @click="activeTab = 'general'"
            :class="[
              'px-4 py-2 text-sm font-medium border rounded',
              activeTab === 'general'
                ? 'bg-gray-100 text-black'
                : 'bg-white text-gray-400',
            ]"
          >
            General Basket
          </button>
        </div>

        <!-- Search & Filter -->
        <div class="flex items-center gap-2">
          <input
            type="text"
            placeholder="search"
            class="min-w-[350px] flex-grow px-3 py-2 text-sm border rounded"
          />

          <!-- Priority Dropdown (Custom Styled) -->
          <div ref="dropdownRef" class="relative">
            <button
              @click="dropdownOpen = !dropdownOpen"
              class="flex items-center justify-between px-3 py-2 text-sm bg-white border rounded w-[180px]"
            >
              <span
                :class="[
                  'text-sm font-medium px-2 py-1 rounded',
                  selectedPriority
                    ? priorities.find((p) => p.label === selectedPriority)?.class
                    : 'text-gray-500',
                ]"
              >
                {{ selectedPriority || "Filter by priority" }}
              </span>
              <svg
                class="w-4 h-4 ml-2 text-gray-500"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M19 9l-7 7-7-7"
                />
              </svg>
            </button>

            <div
              v-if="dropdownOpen"
              class="absolute right-0 z-10 w-40 mt-1 bg-white border rounded shadow"
            >
              <ul>
                <li
                  v-for="priority in priorities"
                  :key="priority.label"
                  @click="
                    selectedPriority = priority.label;
                    dropdownOpen = false;
                  "
                  :class="`px-3 py-2 cursor-pointer text-sm hover:bg-gray-100 flex items-center gap-2 ${priority.class}`"
                >
                  {{ priority.label }}
                </li>
                <li
                  @click="
                    selectedPriority = '';
                    dropdownOpen = false;
                  "
                  class="px-3 py-2 text-sm text-gray-500 cursor-pointer hover:bg-gray-100"
                >
                  Clear filter
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Task Columns -->
      <div v-if="activeTab === 'personal'" class="grid grid-cols-3 gap-4">
        <div>
          <h2 class="mb-2 font-medium">New tasks</h2>
          <TaskCard
            v-for="(task, i) in filterByPriority(newTasks)"
            :key="i"
            v-bind="task"
          />
        </div>
        <div>
          <h2 class="mb-2 font-medium">Ongoing tasks</h2>
          <TaskCard
            v-for="(task, i) in filterByPriority(ongoingTasks)"
            :key="i"
            v-bind="task"
          />
        </div>
        <div>
          <h2 class="mb-2 font-medium">Completed tasks</h2>
          <TaskCard
            v-for="(task, i) in filterByPriority(completedTasks)"
            :key="i"
            v-bind="task"
          />
        </div>
      </div>
      <div v-else-if="activeTab === 'general'" class="grid grid-cols-3 gap-4">
        <div>
          <!-- Header -->
          <div class="flex items-center justify-between mb-4">
            <h2 class="mb-2 font-medium">Available tasks</h2>
            <ChevronDownIcon class="w-4 h-4 text-gray-400" />
          </div>

          <!-- Task list -->
          <div class="space-y-3">
            <div
              v-for="i in 8"
              :key="i"
              class="flex items-center justify-between p-4 border border-gray-200 rounded-lg bg-gray-50"
            >
              <!-- Left -->
              <div>
                <div class="mb-1 text-xs text-gray-400">JAI ID : EX123</div>
                <div class="text-sm font-semibold text-gray-700">Deceased's name</div>
              </div>

              <!-- Right -->
              <div class="flex items-center space-x-4">
                <div class="text-xs text-gray-400">12/05/25</div>
                <div class="relative">
                  <button
                    class="flex items-center px-3 py-1 text-sm text-white bg-gray-400 rounded-md hover:bg-gray-400"
                  >
                    Assign
                    <ChevronDownIcon class="w-4 h-4 ml-1" />
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
