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
import TaskStat from "@/Components/Dashboard/TaskStat.vue";
import TaskRow from "@/Components/Dashboard/TaskRow.vue";
import CircularProgress from "@/Components/Dashboard/CircularProgress.vue";
import BarChart from "@/Components/Dashboard/BarChart.vue";
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
          <SidebarLink
            href="/dashboardic"
            :icon="Squares2X2Icon"
            text="Dashboard"
            :active="true"
          />
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
          <div class="text-sm text-gray-400">Wednesday, Feb 2024</div>
          <h2 class="mt-1 text-2xl font-semibold">Welcome John</h2>
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

      <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
        <!-- Tasks Overview -->
        <div class="p-6 bg-white border rounded-lg shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-medium">Tasks Overview</h3>
            <div class="flex items-center text-xs text-gray-500">
              <span>01 Nov - 30 Nov</span>
              <button class="ml-2">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="w-4 h-4"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"
                  />
                </svg>
              </button>
            </div>
          </div>
          <div class="flex items-center justify-between">
            <div class="space-y-3">
              <TaskStat
                number="28"
                label="General Basket"
                color="bg-blue-200 text-blue-700"
              />
              <TaskStat
                number="20"
                label="Personal Basket"
                color="bg-indigo-200 text-indigo-500"
              />
              <TaskStat
                number="08"
                label="Completed Tasks"
                color="bg-green-200 text-green-500"
              />
            </div>
            <div class="relative">
              <div class="w-80 h-80">
                <CircularProgress :total="56" :segments="[28, 20, 8]" />
              </div>
              <div class="absolute inset-0 flex flex-col items-center justify-center">
                <div class="text-sm text-gray-500">Total Files:</div>
                <div class="text-2xl font-semibold">56</div>
              </div>
            </div>
          </div>
        </div>

        <!-- Completed Dossiers -->
        <div class="p-6 bg-white border rounded-lg shadow-sm">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-medium">Completed Dossiers</h3>
            <div class="flex items-center text-xs text-gray-500">
              <span>01 Nov - 30 Nov</span>
              <button class="ml-2">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="w-4 h-4"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"
                  />
                </svg>
              </button>
            </div>
          </div>
          <div class="flex items-center mb-2 space-x-6">
            <button class="text-gray-400 hover:text-black">This month</button>
            <button class="font-semibold text-green-600 underline">This week</button>
            <button class="text-gray-400 hover:text-black">Today</button>
          </div>
          <BarChart />
        </div>
      </div>

      <!-- Recent Tasks -->
      <div class="mt-8">
        <div class="flex items-center justify-between mb-2">
          <h4 class="text-lg font-medium">My Recent Open tasks:</h4>
          <button
            class="px-3 py-1 text-sm text-white bg-green-600 rounded hover:bg-green-700"
          >
            Manage All Tasks
          </button>
        </div>

        <div class="bg-white border divide-y rounded-lg shadow-sm">
          <TaskRow v-for="n in 5" :key="n" />
        </div>
      </div>
    </main>
  </div>
</template>
