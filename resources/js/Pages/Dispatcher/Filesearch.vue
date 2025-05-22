<template>
    <Head title="Settings" />
    <div class="flex min-h-screen text-gray-800 bg-gray-100">
      <!-- Sidebar -->
      <aside class="w-64 bg-white border-r border-gray-200 shadow-sm">
        <div class="p-6 text-2xl font-semibold text-mint">Search Results</div>
        <nav class="flex flex-col gap-2 px-4 mt-6">
          <SidebarLink icon="📊" label="Dashboard" to="/dashboarddispatcher" />
          <SidebarLink icon="📋" label="Tasks" to="/tasksdispatcher" />
          <SidebarLink icon="📁" label="Files" to="/filesdispatcher" />
          <SidebarLink icon="📈" label="Reports" to="/reportsdispatcher" />
          <SidebarLink icon="💬" label="Chat" to="/chatdispatcher" />
          <SidebarLink icon="⚙️" label="Settings" to="/settingsdispatcher" />
        </nav>
      </aside>
  
      <main class="flex justify-center flex-1 p-8 overflow-auto">
        <div class="w-full max-w-4xl"></div>
      </main>
    </div>
  </template>
  
  <script setup>
  import { Head } from "@inertiajs/vue3";
  import SidebarLink from "@/Components/SidebarLink.vue";
  </script>
  