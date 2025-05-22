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
            <SidebarLink
              href="/allfilesic"
              :icon="FolderIcon"
              text="All Files"
              class="font-semibold"
            />
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
          <h2 class="mt-1 text-2xl font-semibold">File Management > All Files</h2>
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
      <!-- Search Bar -->
      <div class="relative w-1/3 mb-8">
        <input
          type="text"
          placeholder="search"
          class="w-full px-4 py-2 text-sm border border-gray-300 rounded-lg"
        />
        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-4 h-4 text-gray-400"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1h-1l-2 9H6L4 7H3a1 1 0 01-1-1V4z"
            />
          </svg>
        </div>
      </div>
      <!-- Table Header -->
      <div
        class="grid grid-cols-6 px-4 py-2 text-sm font-semibold text-gray-500 rounded-md bg-indigo-50"
      >
        <div>JA ID</div>
        <div class="col-span-2">Name of Deceased</div>
        <div>City</div>
        <div>Date Created</div>
        <div>Status</div>
      </div>

      <!-- Table Rows -->
      <div
        v-for="i in 8"
        :key="i"
        class="grid items-center grid-cols-6 px-4 py-4 text-sm text-gray-700 border-b"
      >
        <div>00185</div>
        <div class="col-span-2">Random name</div>
        <div>city name</div>
        <div>02/1970</div>
        <div class="flex items-center justify-between">
          <span
            :class="[
              'px-2 py-1 rounded-full text-xs font-medium',
              i % 3 === 0
                ? 'bg-yellow-100 text-yellow-700'
                : i % 3 === 1
                ? 'bg-green-100 text-green-700'
                : 'bg-blue-100 text-blue-700',
            ]"
          >
            {{ i % 3 === 0 ? "New" : i % 3 === 1 ? "Completed" : "In progress" }}
          </span>
          <button
            class="px-3 py-1 ml-4 text-xs text-blue-500 border border-blue-500 rounded-md"
          >
            View
          </button>
        </div>
      </div>

      <!-- Pagination -->
      <div class="flex items-center justify-center gap-2 mt-6 text-sm text-gray-600">
        <button class="px-2 py-1 border rounded">&larr;</button>
        <button class="w-6 h-6 text-white bg-gray-800 rounded-full">1</button>
        <button class="px-2 py-1">2</button>
        <button class="px-2 py-1">3</button>
        <button class="px-2 py-1">4</button>
        <span class="px-2">...</span>
        <button class="px-2 py-1">10</button>
        <button class="px-2 py-1">11</button>
        <button class="px-2 py-1 border rounded">&rarr;</button>
      </div>
    </main>
  </div>
</template>
