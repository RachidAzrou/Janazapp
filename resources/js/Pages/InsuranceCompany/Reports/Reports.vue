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
import FileDistribution from "@/Components/Reports/FileDistribution.vue";
import AverageDuration from "@/Components/Reports/AverageDuration.vue";
import CostGraph from "@/Components/Reports/CostGraph.vue";
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
            <SidebarLink href="/overviewreportic" :icon="FolderIcon" text="Files Report" />
            <SidebarLink href="/managementreportic" :icon="FolderIcon" text="Document Report" />
            <SidebarLink href="/costreportic" :icon="FolderIcon" text="Cost Report" />
            <SidebarLink href="/performancereportic" :icon="FolderIcon" text="Performance Report" />
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
          <h2 class="mt-1 text-2xl font-semibold">Reports</h2>
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
        <!-- Top Row -->
        <div class="grid grid-cols-12 gap-6">
          <div class="col-span-5">
            <FileDistribution />
          </div>
          <div class="col-span-7">
            <AverageDuration />
          </div>
        </div>

        <!-- Bottom Row -->
        <div class="grid grid-cols-1 mt-6">
          <CostGraph />
        </div>
    </main>
  </div>
</template>
