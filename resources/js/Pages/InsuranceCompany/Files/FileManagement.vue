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
import DonutChart from "@/Components/Files/DonutChart.vue";
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
          <SidebarGroup
            :icon="FolderIcon"
            text="File Management"
            :active="true"
            href="/filemanagementic"
          >
            <SidebarLink href="/allfilesic" :icon="FolderIcon" text="All Files" />
            <SidebarLink href="/newdossieric" :icon="FolderIcon" text="Add New Dossier" />
            <SidebarLink href="/searchfileic" :icon="FolderIcon" text="Search" />
          </SidebarGroup>

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
      <!-- Page title -->
      <div class="flex items-center justify-between mb-6">
        <div>
          <h2 class="mt-1 text-2xl font-semibold">File Management</h2>
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

      <!-- Top Section -->
      <div class="grid grid-cols-3 gap-6 mb-6">
        <!-- Search Card -->
        <div class="col-span-2 p-6 shadow-sm bg-indigo-50 rounded-xl">
          <h2 class="mb-4 text-lg font-semibold text-gray-700">Search</h2>
          <div class="grid grid-cols-3 gap-4">
            <input type="text" placeholder="First name" class="input" />
            <input type="text" placeholder="Last name" class="input" />
            <input type="text" placeholder="EXM123" class="input" />
            <input type="text" placeholder="DD/MM/YYYY" class="input" />
            <input type="text" placeholder="DD/MM/YYYY - DD/MM/YYYY" class="input" />
            <input type="text" placeholder="DD/MM/YYYY" class="input" />

            <div class="col-span-1">
              <select class="input">
                <option>Belgium</option>
                <option>Netherlands</option>
              </select>
            </div>
            <div class="col-span-1">
              <select class="input">
                <option>Select city</option>
              </select>
            </div>
            <div class="col-span-1">
              <input type="text" placeholder="search" class="input" />
            </div>

            <div class="flex items-center col-span-3 gap-4">
              <div class="flex gap-4">
                <label class="flex items-center gap-2">
                  <input type="radio" name="service" class="accent-green-600" />
                  Local burial
                </label>
                <label class="flex items-center gap-2">
                  <input type="radio" name="service" class="accent-green-600" />
                  Repatriation
                </label>
              </div>
              <select class="input">
                <option>Morocco</option>
              </select>
              <button
                class="px-6 py-2 ml-auto font-medium text-green-700 bg-green-100 border border-green-500 rounded-lg"
              >
                Search
              </button>
            </div>
          </div>
        </div>

        <!-- Overview Card -->
        <div class="p-6 bg-white border shadow-sm rounded-xl">
          <div class="flex items-center justify-between mb-4">
            <button
              class="px-4 py-2 font-medium text-green-600 border border-green-500 rounded-lg hover:bg-green-50"
            >
              Manage all files
            </button>
            <button
              class="px-4 py-2 font-medium text-white bg-green-600 rounded-lg hover:bg-green-700"
            >
              Add new file
            </button>
          </div>
          <h2 class="mb-4 text-sm font-semibold text-gray-700">Open tasks Overview</h2>
          <div class="flex items-center justify-between">
            <div class="space-y-4 text-sm">
              <div class="flex items-center gap-2">
                <span
                  class="flex items-center justify-center w-6 h-6 text-xs font-semibold rounded-full bg-emerald-200 text-emerald-700"
                  >04</span
                >
                Completed Files
              </div>
              <div class="flex items-center gap-2">
                <span
                  class="flex items-center justify-center w-6 h-6 text-xs font-semibold text-blue-700 bg-blue-200 rounded-full"
                  >09</span
                >
                In Progress Files
              </div>
              <div class="flex items-center gap-2">
                <span
                  class="flex items-center justify-center w-6 h-6 text-xs font-semibold text-orange-700 bg-orange-200 rounded-full"
                  >07</span
                >
                Pending Files
              </div>
            </div>
            <div>
              <DonutChart :completed="4" :inProgress="9" :pending="7" />
            </div>
          </div>
        </div>
      </div>

      <!-- Recently Added Files -->
      <div class="p-4 bg-white border shadow-sm rounded-xl">
        <h2 class="mb-4 text-sm font-semibold text-gray-700">Recently added files</h2>
        <div class="space-y-2">
          <div
            v-for="i in 4"
            :key="i"
            class="flex items-center justify-between px-4 py-3 border border-indigo-100 rounded-lg bg-indigo-50"
          >
            <div class="text-sm">
              <div class="text-xs text-gray-500">JA ID : EX123</div>
              <div class="font-semibold text-gray-800">Deceased's name</div>
            </div>
            <div class="flex items-center gap-4 text-sm">
              <div class="text-xs text-gray-400">date: 12/05/25</div>
              <div class="text-xs font-medium text-blue-500">In progress</div>
              <div class="text-xs text-gray-600">
                Assigned by: <span class="font-medium">User X</span>
              </div>
              <button
                class="px-3 py-1 text-xs font-medium text-gray-600 border border-gray-300 rounded-md hover:bg-gray-100"
              >
                View
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
