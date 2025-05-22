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

import { Link, useForm } from "@inertiajs/vue3";
import SidebarLink from "@/Components/SidebarLink.vue";
import SidebarGroup from "@/Components/SidebarGroup.vue";

const form = useForm({
  first_name: "",
  last_name: "",
  ja_id: "",
  nis_rrn: "",
  date_from: "",
  date_until: "",
  birthdate: "",
  country: "",
  city: "",
  funeral_service: "",
  burial_type: "",
  destination: "",
});

const submit = () => {
  form.get("/searchresultsic");
};
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
      <!-- Centered Search Container -->
      <div class="w-full mx-auto">
        <div class="p-6 rounded-lg shadow-sm bg-indigo-50">
          <h2 class="mb-4 text-base font-semibold text-gray-700">Search</h2>

          <form @submit.prevent="submit" class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <input
              type="text"
              v-model="form.first_name"
              placeholder="first name"
              class="input"
            />
            <input
              type="text"
              v-model="form.last_name"
              placeholder="last name"
              class="input"
            />
            <input type="text" v-model="form.ja_id" placeholder="EXM123" class="input" />

            <input
              type="text"
              v-model="form.nis_rrn"
              placeholder="NIS/RRN"
              class="input"
            />

            <div class="flex items-center space-x-2">
              <input
                type="text"
                v-model="form.date_from"
                placeholder="DD/MM/YYYY"
                class="w-full input"
              />
              <span class="text-gray-400">-</span>
              <input
                type="text"
                v-model="form.date_until"
                placeholder="DD/MM/YYYY"
                class="w-full input"
              />
            </div>

            <input
              type="text"
              v-model="form.birthdate"
              placeholder="DD/MM/YYYY"
              class="input"
            />

            <select v-model="form.country" class="input">
              <option disabled selected value="">Country</option>
              <option value="Belgium">Belgium</option>
            </select>

            <select v-model="form.city" class="input">
              <option disabled selected value="">select city</option>
            </select>

            <select v-model="form.funeral_service" class="input">
              <option disabled selected value="">search</option>
            </select>

            <div class="flex items-center col-span-2 space-x-6">
              <label class="inline-flex items-center space-x-2">
                <input
                  type="radio"
                  v-model="form.burial_type"
                  value="local"
                  class="form-radio text-primary"
                />
                <span class="text-sm text-gray-600">Local burial</span>
              </label>
              <label class="inline-flex items-center space-x-2">
                <input
                  type="radio"
                  v-model="form.burial_type"
                  value="repatriation"
                  class="form-radio text-primary"
                />
                <span class="text-sm text-gray-600">Repatriation</span>
              </label>

              <select v-model="form.destination" class="w-40 input">
                <option disabled selected value="">Morocco</option>
              </select>
            </div>

            <div class="flex items-end justify-end">
              <button
                type="submit"
                class="px-6 py-2 text-white transition bg-green-600 rounded hover:bg-green-700"
              >
                Search
              </button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</template>
