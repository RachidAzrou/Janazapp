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
import DocumentRow from "@/Components/Files/DocumentRow.vue";
import UploadFilesModal from "@/Components/Files/UploadFilesModal.vue";
import { ref } from "vue";

const showUploadModal = ref(false);
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
            <SidebarLink
              href="/newdossieric"
              :icon="FolderIcon"
              text="Add New Dossier"
              class="font-semibold"
            />
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
          <h2 class="mt-1 text-2xl font-semibold">File Management > Add New Dossier</h2>
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
      <div class="grid grid-cols-1 gap-4 mt-6 lg:grid-cols-3">
        <!-- Data of the Deceased -->
        <div class="p-6 lg:col-span-2 bg-blue-50 rounded-xl">
          <h3 class="mb-4 font-semibold text-gray-700">Data of the Deceased</h3>
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <input type="text" placeholder="first name" class="input" />
            <input type="text" placeholder="last name" class="input" />
            <input type="text" placeholder="EXM123" class="input" />
            <input type="text" placeholder="EXM123" class="input" />
            <input type="text" placeholder="DD/MM/YYYY" class="input" />
            <input type="text" placeholder="DD/MM/YYYY" class="input" />
            <input type="text" placeholder="place of death" class="input" />
            <select class="input">
              <option selected disabled>select cause of death</option>
            </select>
            <select class="input">
              <option selected disabled>select nationality</option>
            </select>
            <select class="input">
              <option selected disabled>select gender</option>
            </select>
          </div>

          <div class="mt-4">
            <label class="block mb-1 text-sm text-gray-600"
              >Preferred Funeral Service (Optional)</label
            >
            <div class="flex gap-4">
              <input type="text" placeholder="search" class="flex-1 input" />
              <select class="input">
                <option selected disabled>Morocco</option>
              </select>
            </div>
            <div class="flex gap-4 mt-2">
              <label class="inline-flex items-center">
                <input type="radio" name="funeral" class="form-radio" />
                <span class="ml-2">Local burial</span>
              </label>
              <label class="inline-flex items-center">
                <input type="radio" name="funeral" class="form-radio" />
                <span class="ml-2">Repatriation</span>
              </label>
            </div>
          </div>
        </div>

        <!-- Data of Relatives -->
        <div class="p-6 bg-blue-50 rounded-xl">
          <h3 class="mb-4 font-semibold text-gray-700">
            Data of Relatives - Primary Contact
          </h3>
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <input type="text" placeholder="first name" class="input" />
            <input type="text" placeholder="last name" class="input" />
            <select class="input md:col-span-2">
              <option selected disabled>select relationship to deceased</option>
            </select>
            <input type="text" placeholder="contact number" class="input" />
            <input type="email" placeholder="email address" class="input" />
          </div>

          <h4 class="mt-6 font-medium text-gray-600">Secondary Contact (Optional)</h4>
          <div class="grid grid-cols-1 gap-4 mt-2 md:grid-cols-2">
            <input type="text" placeholder="first name" class="input" />
            <input type="text" placeholder="last name" class="input" />
            <input type="text" placeholder="contact number" class="input" />
            <input type="email" placeholder="email address" class="input" />
          </div>
        </div>
      </div>

      <!-- Documents -->
      <div class="p-6 mt-6 bg-white border rounded-xl">
        <h3 class="mb-4 font-semibold text-gray-700">Documents</h3>
        <div class="space-y-2">
          <DocumentRow label="Passport" />
          <DocumentRow label="Death certificate" />
          <DocumentRow label="Additional files" />
        </div>

        <div
          class="flex items-center justify-center p-6 mt-6 border border-dashed bg-blue-50 rounded-xl"
        >
          <!-- Trigger the modal -->
          <div
            @click="showUploadModal = true"
            class="flex items-center justify-center p-6 mt-6 transition border border-dashed cursor-pointer bg-blue-50 rounded-xl hover:bg-blue-100"
          >
            <div class="text-center">
              <svg
                class="w-10 h-10 mx-auto text-gray-400"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5-5 5 5M12 15V3"
                />
              </svg>
              <p class="mt-2 text-sm text-gray-600">
                Documents Upload <br />(Passport, death certificate, etc....)
              </p>
            </div>
          </div>

          <!-- Upload Modal -->
          <UploadFilesModal :show="showUploadModal" @close="showUploadModal = false" />
        </div>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-between mt-6">
        <button class="px-6 py-2 text-red-500 border border-red-500 rounded-xl">
          Cancel
        </button>
        <div class="flex gap-4">
          <button class="px-6 py-2 text-green-800 bg-green-100 rounded-xl">
            Save progress
          </button>
          <button class="px-6 py-2 text-white bg-gray-700 rounded-xl">Send</button>
        </div>
      </div>
    </main>
  </div>
</template>
