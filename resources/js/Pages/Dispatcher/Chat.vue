<template>
  <Head title="Chat" />
  <div class="flex min-h-screen text-gray-800 bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 shadow-sm">
      <div class="p-6 text-2xl font-semibold text-mint">My Chats</div>
      <nav class="flex flex-col gap-2 px-4 mt-6">
        <SidebarLink icon="📊" label="Dashboard" to="/dashboarddispatcher" />
        <SidebarLink icon="📋" label="Tasks" to="/tasksdispatcher" />
        <SidebarLink icon="📁" label="Files" to="/filesdispatcher" />
        <SidebarLink icon="📈" label="Reports" to="/reportsdispatcher" />
        <SidebarLink icon="💬" label="Chat" to="/chatdispatcher" />
        <SidebarLink icon="⚙️" label="Settings" to="/settingsdispatcher" />
      </nav>
    </aside>

    <!-- Chat Page Content -->
    <main class="flex justify-center flex-1 p-8 overflow-auto">
      <div class="w-full max-w-4xl">
        <div class="p-6 mb-6 bg-white shadow-md rounded-xl">
          <!-- Search -->
          <div class="mb-4">
            <input
              type="text"
              v-model="searchQuery"
              placeholder="Search chats..."
              class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-mint focus:border-mint"
            />
          </div>

          <!-- Tabs -->
          <div class="flex gap-4 mb-6">
            <button
              :class="['px-4 py-2 rounded-lg text-sm font-medium', activeTab === 'General' ? 'bg-mint text-white' : 'bg-white border border-gray-300']"
              @click="activeTab = 'General'"
            >
              General
            </button>
            <button
              :class="['px-4 py-2 rounded-lg text-sm font-medium', activeTab === 'Unread' ? 'bg-mint text-white' : 'bg-white border border-gray-300']"
              @click="activeTab = 'Unread'"
            >
              Unread
            </button>
          </div>

          <!-- Chat List -->
          <div class="space-y-4">
            <div
              v-for="chat in filteredChats"
              :key="chat.id"
              class="flex items-center justify-between p-4 transition bg-gray-100 border border-gray-200 rounded-lg cursor-pointer hover:shadow-sm"
            >
              <div class="flex flex-col">
                <h4 :class="['text-base', !chat.read ? 'font-bold text-gray-900' : 'font-medium text-gray-700']">
                  {{ chat.name }}
                </h4>
                <p :class="['text-sm', !chat.read ? 'font-semibold text-gray-800' : 'text-gray-600']">
                  {{ chat.lastMessage }}
                </p>
              </div>

              <!-- Timestamp + Status -->
              <div class="flex flex-col items-end gap-1 min-w-[90px]">
                <span class="text-xs text-gray-500">
                  {{ formatTimestamp(chat.timestamp) }}
                </span>
                <div class="flex items-center gap-1">
                  <template v-if="!chat.read">
                    <div class="w-2.5 h-2.5 bg-mint rounded-full"></div>
                  </template>
                  <template v-else>
                    <span class="text-xs text-gray-400">✔✔</span>
                  </template>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import SidebarLink from "@/Components/SidebarLink.vue";
import dayjs from "dayjs";
</script>

<script>
export default {
  components: {
    SidebarLink,
  },
  data() {
    return {
      searchQuery: "",
      activeTab: "General",
      chats: [
        {
          id: 1,
          name: "Alice",
          lastMessage: "Hey there!",
          read: false,
          timestamp: "2025-05-06T10:30:00Z",
        },
        {
          id: 2,
          name: "Bob",
          lastMessage: "What's up?",
          read: true,
          timestamp: "2025-05-06T09:15:00Z",
        },
        {
          id: 3,
          name: "Charlie",
          lastMessage: "See you soon!",
          read: false,
          timestamp: "2025-05-05T18:00:00Z",
        },
        {
          id: 4,
          name: "Diana",
          lastMessage: "Good morning!",
          read: true,
          timestamp: "2025-05-04T07:20:00Z",
        },
      ],
    };
  },
  computed: {
    filteredChats() {
      let filtered = this.chats.filter((chat) =>
        chat.name.toLowerCase().includes(this.searchQuery.toLowerCase())
      );

      if (this.activeTab === "Unread") {
        filtered = filtered.filter((chat) => !chat.read);
      }

      return filtered.sort((a, b) => {
        // Sort unread first
        if (a.read !== b.read) return a.read ? 1 : -1;
        // Then sort by timestamp (newest first)
        return new Date(b.timestamp) - new Date(a.timestamp);
      });
    },
  },
  methods: {
    formatTimestamp(timestamp) {
      return dayjs(timestamp).format("MMM D, h:mm A");
    },
  },
};
</script>
