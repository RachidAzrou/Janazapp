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
import ContactItem from "@/Components/Chat/ContactItem.vue";
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
          <SidebarLink href="/reportsic" :icon="DocumentTextIcon" text="Reports" />
          <SidebarLink
            href="/chatic"
            :icon="ChatBubbleLeftRightIcon"
            text="Chat"
            :active="true"
          />
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
          <h2 class="mt-1 text-2xl font-semibold">Chat</h2>
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
      <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="flex flex-col bg-white border-r w-80">
          <div class="p-4 border-b">
            <input
              type="text"
              placeholder="search"
              class="w-full px-3 py-2 text-sm border rounded focus:outline-none"
            />
          </div>
          <div class="flex justify-between px-4 pt-2 text-sm font-medium">
            <button class="pb-1 border-b-2 border-black">All</button>
            <button class="text-gray-500">Unread</button>
          </div>
          <div class="flex-1 overflow-y-auto divide-y">
            <!-- Contact List -->
            <ContactItem
              name="Peter Jones"
              message="you sent an attachment"
              time="15:12"
              :unread="true"
            />
            <ContactItem
              name="Maria Stevens"
              message="Lorem ipsum dolor"
              :unread="true"
            />
            <ContactItem name="Joan Smith" message="Lorem ipsum dolor" time="01:08 pm" />
            <ContactItem
              name="James Ruskin"
              message="Lorem ipsum dolor"
              time="02:30 pm"
            />
            <ContactItem
              name="Mary Richards"
              message="Lorem ipsum dolor"
              time="07:13 pm"
            />
            <ContactItem name="Sam Thomas" message="Lorem ipsum dolor" time="5m" />
            <ContactItem name="Samantha Evans" message="Lorem ipsum dolor" time="11m" />
            <ContactItem name="David Kemp" message="Lorem ipsum dolor" time="5d" />
            <ContactItem name="Bob Simons" message="Lorem ipsum dolor" />
            <ContactItem name="John Smith" message="Lorem ipsum dolor" />
            <ContactItem name="Samantha Evans" message="Lorem ipsum dolor" time="11m" />
          </div>
        </div>

        <!-- Chat Panel -->
        <div class="flex flex-col flex-1 bg-white">
          <!-- Header -->
          <div class="flex items-center justify-between px-6 py-4 border-b shrink-0">
            <div class="flex items-center space-x-3">
              <div
                class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full"
              >
                <img
                  src="https://via.placeholder.com/40"
                  alt="Avatar"
                  class="rounded-full"
                />
              </div>
              <div>
                <p class="font-semibold">Peter Jones</p>
                <p class="text-xs text-green-500">online</p>
              </div>
            </div>
            <div class="flex space-x-2">
              <button
                class="flex items-center justify-center w-8 h-8 rounded hover:bg-gray-100"
              >
                <i class="text-gray-500 fas fa-search"></i>
              </button>
              <button
                class="flex items-center justify-center w-8 h-8 rounded hover:bg-gray-100"
              >
                <i class="text-gray-500 fas fa-cog"></i>
              </button>
            </div>
          </div>

          <!-- Chat Messages -->
          <div class="flex-1 px-6 py-4 space-y-4 overflow-y-auto">
            <!-- Received -->
            <div>
              <div class="inline-block max-w-xl px-4 py-2 text-sm bg-gray-100 rounded-md">
                Lorem ipsum dolor sit amet. Vel sint obcaecati ut enim eligendi et labore
                fugiat sit ratione eius est nesciunt quisquam. Qui magnam possimus aut
                voluptate exercitationem a dolore quisquam aut natus enim aut reiciendis
                tempora rem totam minima.
              </div>
              <div class="mt-1 text-xs text-gray-400">Peter Jones • 15:12</div>
            </div>

            <!-- Sent -->
            <div class="text-right">
              <div
                class="inline-block max-w-xl px-4 py-2 text-sm text-gray-800 bg-green-100 rounded-md"
              >
                Lorem ipsum dolor sit amet. Vel sint obcaecati ut enim eligendi et labore
                fugiat sit ratione eius est nesciunt quisquam. Qui magnam possimus aut
                voluptate exercitationem a dolore quisquam aut natus enim aut reiciendis
                tempora rem totam minima.
              </div>
              <div class="mt-1 text-xs text-gray-400">Adam Ali • 15:12</div>
            </div>
          </div>

          <!-- Message Input (fixed at bottom of chat panel) -->
          <div class="sticky bottom-0 px-6 py-3 bg-white border-t shrink-0">
            <div class="flex items-center gap-2">
              <input
                type="text"
                placeholder="Message to Peter Jones"
                class="flex-1 px-3 py-2 text-sm border rounded-md focus:outline-none"
              />
              <button class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-paperclip"></i>
              </button>
              <button class="text-green-500 hover:text-green-700">
                <i class="fas fa-paper-plane"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>
