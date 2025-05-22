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
import { ref } from "vue";
import ExportPdfModal from "@/Components/Files/ExportPdfModal.vue";

const showExportModal = ref(false);
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
        <h2 class="mt-1 text-2xl font-semibold">File</h2>
        <div class="flex items-center space-x-4">
          <button class="relative p-2 rounded-full hover:bg-gray-200">
            <BellIcon class="w-6 h-6 text-gray-600" />
          </button>
          <button class="p-2 rounded-full hover:bg-gray-200">
            <GlobeAltIcon class="w-6 h-6 text-gray-600" />
          </button>
        </div>
      </div>

      <div class="min-h-screen space-y-6 bg-gray-50">
        <!-- Header Section -->
        <div class="flex items-center justify-between p-4 bg-white rounded shadow">
          <div>
            <p class="text-sm text-gray-500">
              JA-ID: <span class="font-medium text-blue-600">JA123456</span>
            </p>
            <p class="text-sm text-gray-500">
              Name: <span class="font-medium">Ahmad Khan</span>
            </p>
            <p class="text-sm text-gray-500">
              Created Date: <span class="font-medium">2025-05-14</span>
            </p>
            <p class="text-sm text-gray-500">
              Assigned to: <span class="font-medium">Sarah Malik</span>
            </p>
          </div>
          <button
            @click="showExportModal = true"
            class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700"
          >
            Export PDF
          </button>

          <ExportPdfModal :show="showExportModal" @close="showExportModal = false" />
        </div>

        <!-- Info Grid -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
          <!-- General Info -->
          <div class="col-span-2 p-4 bg-white rounded shadow">
            <h3 class="mb-2 font-semibold text-gray-700">General Information</h3>
            <dl class="grid grid-cols-2 gap-2 text-sm text-gray-700">
              <div>
                <dt class="font-semibold">First name:</dt>
                <dd>Ahmad</dd>
              </div>
              <div>
                <dt class="font-semibold">Last name:</dt>
                <dd>Khan</dd>
              </div>
              <div>
                <dt class="font-semibold">JA-ID:</dt>
                <dd>JA123456</dd>
              </div>
              <div>
                <dt class="font-semibold">NIS/RRN:</dt>
                <dd>987654321</dd>
              </div>
              <div>
                <dt class="font-semibold">Date of Birth:</dt>
                <dd>1952-07-19</dd>
              </div>
              <div>
                <dt class="font-semibold">Date of Death:</dt>
                <dd>2025-05-10</dd>
              </div>
              <div>
                <dt class="font-semibold">Age:</dt>
                <dd>72</dd>
              </div>
              <div>
                <dt class="font-semibold">Gender:</dt>
                <dd>Male</dd>
              </div>
              <div>
                <dt class="font-semibold">Place of Death:</dt>
                <dd>Antwerp, Belgium</dd>
              </div>
              <div>
                <dt class="font-semibold">Cause of Death:</dt>
                <dd>Natural causes</dd>
              </div>
              <div>
                <dt class="font-semibold">Nationality:</dt>
                <dd>Belgian</dd>
              </div>
              <div>
                <dt class="font-semibold">Preferred Funeral Service:</dt>
                <dd>Islamic Burial</dd>
              </div>
              <div>
                <dt class="font-semibold">Type of Service:</dt>
                <dd>Burial</dd>
              </div>
            </dl>
          </div>

          <!-- Relatives Info -->
          <div class="p-4 bg-white rounded shadow">
            <h3 class="mb-2 font-semibold text-gray-700">Relatives Information</h3>
            <div>
              <h4 class="text-sm font-bold text-gray-600">Primary Contact</h4>
              <p><strong>Fatima</strong> Khan</p>
              <p>Daughter</p>
              <p>+32 485 123 456</p>
              <p>fatima.khan@example.com</p>
              <p>Rue des Fleurs 12, 1000 Brussels</p>
            </div>
            <div class="mt-4">
              <h4 class="text-sm font-bold text-gray-600">Secondary Contact</h4>
              <p><strong>Ali</strong> Khan</p>
              <p>+32 495 789 321</p>
              <p>ali.khan@example.com</p>
            </div>
          </div>
        </div>

        <!-- Task Log + Comments -->
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
          <div class="p-4 bg-white rounded shadow">
            <h3 class="mb-2 font-semibold text-gray-700">Task Log</h3>
            <ul class="space-y-1 text-sm text-gray-700">
              <li><strong>2025-05-11</strong> - Initial intake completed</li>
              <li><strong>2025-05-12</strong> - Document verification started</li>
              <li><strong>2025-05-13</strong> - Awaiting death certificate</li>
            </ul>
          </div>

          <div class="p-4 bg-white rounded shadow">
            <h3 class="mb-2 font-semibold text-gray-700">Comments</h3>
            <ul class="space-y-2 text-sm text-gray-700">
              <li>
                <p><strong>Sarah Malik</strong>: Please upload death certificate soon.</p>
              </li>
              <li>
                <p>
                  <strong>Omar Yilmaz</strong>: Contacted primary relative for
                  confirmation.
                </p>
              </li>
            </ul>
          </div>
        </div>

        <!-- Documents Section -->
        <div class="p-4 bg-white rounded shadow">
          <h3 class="mb-4 font-semibold text-gray-700">Documents</h3>
          <ul class="space-y-3 text-sm">
            <li>
              <strong>Passport:</strong> <span class="text-green-600">Uploaded</span>
            </li>
            <li>
              <strong>Death Certificate:</strong>
              <span class="text-yellow-600">Pending</span>
            </li>
            <li>
              <strong>Additional Files:</strong>
              <span class="text-gray-500">No file uploaded</span>
            </li>
          </ul>

          <div class="p-6 mt-4 text-center border rounded bg-indigo-50">
            <p class="mb-2 text-sm text-gray-600">Documents Upload</p>
            <p class="text-xs text-gray-500">(Passport, death certificate, etc...)</p>
          </div>
        </div>

        <!-- Footer Buttons -->
        <div class="flex justify-between mt-6">
          <button
            class="px-6 py-2 text-red-600 border border-red-500 rounded hover:bg-red-50"
          >
            Cancel
          </button>
          <div class="space-x-4">
            <button
              class="px-6 py-2 text-green-600 border border-green-600 rounded hover:bg-green-50"
            >
              Edit info
            </button>
            <button class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">
              Save
            </button>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
