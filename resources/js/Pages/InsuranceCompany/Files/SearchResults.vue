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

const results = [
  {
    id: "00185",
    name: "Random name",
    city: "city name",
    date: "02/1970",
    status: "In progress",
  },
  { id: "00185", name: "Random name", city: "city name", date: "02/1970", status: "New" },
  { id: "00185", name: "Random name", city: "city name", date: "02/1970", status: "New" },
  {
    id: "00185",
    name: "Random name",
    city: "city name",
    date: "02/1970",
    status: "Completed",
  },
  {
    id: "00185",
    name: "Random name",
    city: "city name",
    date: "02/1970",
    status: "In progress",
  },
];
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
            <SidebarLink
              href="/searchfileic"
              :icon="FolderIcon"
              text="Search"
              class="font-semibold"
            />
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
          <h2 class="mt-1 text-2xl font-semibold">File Management > Search</h2>
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
      <!-- Search Overview -->
      <div
        class="p-6 mb-6 text-sm text-gray-700 border border-blue-100 rounded-md bg-blue-50"
      >
        <div class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4">
          <p>First name : RANDOM NAME</p>
          <p>Last name : RANDOM NAME</p>
          <p>JA ID : XXXXXX</p>
          <p>NIS/RRN : XXXXXXXXXXXX</p>
          <p>Date created : XXXX/XX/XX - XXXX/XX/XX</p>
          <p>Birthdate : XXXX/XX/XX</p>
          <p>Country : XXXXX</p>
          <p>City : XXXXX</p>
          <p>Funeral Service : XXXXXXXXXXXXXX</p>
          <p>Repatriation : XXXXX</p>
        </div>
        <div class="mt-4">
          <button
            class="px-4 py-2 text-green-600 border border-green-500 rounded hover:bg-green-50"
          >
            Edit search
          </button>
        </div>
      </div>

      <!-- Search Results Table -->
      <div class="overflow-hidden bg-white border border-gray-200 rounded-lg">
        <table class="w-full text-sm text-left text-gray-700">
          <thead class="text-xs text-gray-500 uppercase bg-gray-50">
            <tr>
              <th class="px-6 py-3">JA ID</th>
              <th class="px-6 py-3">Name of Deceased</th>
              <th class="px-6 py-3">City</th>
              <th class="px-6 py-3">Date Created</th>
              <th class="px-6 py-3">Status</th>
              <th class="px-6 py-3"></th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in results" :key="index" class="border-t">
              <td class="px-6 py-4">{{ row.id }}</td>
              <td class="px-6 py-4">{{ row.name }}</td>
              <td class="px-6 py-4">{{ row.city }}</td>
              <td class="px-6 py-4">{{ row.date }}</td>
              <td class="px-6 py-4">
                <span
                  :class="[
                    'px-2 py-1 text-xs rounded-full font-medium',
                    row.status === 'In progress' ? 'bg-blue-100 text-blue-600' : '',
                    row.status === 'New' ? 'bg-yellow-100 text-yellow-600' : '',
                    row.status === 'Completed' ? 'bg-green-100 text-green-600' : '',
                  ]"
                >
                  {{ row.status }}
                </span>
              </td>
              <td class="px-6 py-4 text-right">
                <Link
    href="/fileic"
    class="px-4 py-1 text-sm border border-gray-300 rounded hover:bg-gray-50"
  >
    View
  </Link>
              </td>
            </tr>
          </tbody>
        </table>

        <!-- Pagination -->
        <div
          class="flex items-center justify-center gap-2 p-4 text-sm text-gray-600 border-t"
        >
          <button class="px-2 py-1 hover:text-gray-800">&larr;</button>
          <button class="px-2 py-1 font-semibold text-blue-600">1</button>
          <button class="px-2 py-1 hover:text-gray-800">2</button>
          <button class="px-2 py-1 hover:text-gray-800">3</button>
          <span class="px-1">...</span>
          <button class="px-2 py-1 hover:text-gray-800">10</button>
          <button class="px-2 py-1 hover:text-gray-800">11</button>
          <button class="px-2 py-1 hover:text-gray-800">&rarr;</button>
        </div>
      </div>
    </main>
  </div>
</template>
