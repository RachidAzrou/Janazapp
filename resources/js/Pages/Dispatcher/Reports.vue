<template>
  <Head title="Reports" />
  <div class="flex h-screen text-gray-800 bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 shadow-sm">
      <div class="p-6 text-2xl font-semibold text-mint">Reports</div>
      <nav class="flex flex-col gap-2 px-4 mt-6">
        <SidebarLink icon="📊" label="Dashboard" to="/dashboarddispatcher" />
        <SidebarLink icon="📋" label="Tasks" to="/tasksdispatcher" />
        <SidebarLink icon="📁" label="Files" to="/filesdispatcher" />
        <SidebarLink icon="📈" label="Reports" to="/reportsdispatcher" />
        <SidebarLink icon="💬" label="Chat" to="/chatdispatcher" />
        <SidebarLink icon="⚙️" label="Settings" to="/settingsdispatcher" />
      </nav>
    </aside>

    <!-- Main content -->
    <main class="flex-1 p-8 overflow-auto">
      <div class="max-w-4xl mx-auto">
        <!-- Files distribution chart -->
        <div class="p-6 mb-8 bg-white shadow-md rounded-2xl">
          <h2 class="mb-4 text-xl font-semibold text-mint">
            Files distribution overview
          </h2>
          <!-- Placeholder for chart -->
          <div
            class="flex items-center justify-center h-64 mb-6 text-gray-500 bg-gray-200 rounded-lg"
          >
            [ Chart goes here ]
          </div>

          <!-- Status Rows -->
          <div class="space-y-4">
            <div
              class="flex items-center justify-between p-4 rounded-lg"
              style="background-color: #e6f7f4"
            >
              <div class="flex items-center gap-4">
                <div class="text-2xl font-bold text-mint">04</div>
                <div class="text-gray-700">Assigned Files</div>
              </div>
              <div class="text-2xl text-mint">✔️</div>
            </div>

            <div
              class="flex items-center justify-between p-4 rounded-lg"
              style="background-color: #e6e9ff"
            >
              <div class="flex items-center gap-4">
                <div class="text-2xl font-bold text-blue-600">09</div>
                <div class="text-gray-700">Pending Files</div>
              </div>
              <div class="text-2xl text-blue-600">🕒</div>
            </div>

            <div
              class="flex items-center justify-between p-4 rounded-lg"
              style="background-color: #fff2e5"
            >
              <div class="flex items-center gap-4">
                <div class="text-2xl font-bold text-orange-500">07</div>
                <div class="text-gray-700">Completed Files</div>
              </div>
              <div class="text-2xl text-orange-500">⚠️</div>
            </div>
          </div>

          <!-- Report Buttons -->
          <div class="flex justify-between mt-6">
            <button
              class="px-4 py-2 text-sm font-semibold text-white transition border border-transparent rounded-lg bg-mint hover:bg-gray-100 hover:border-mint hover:text-mint"
            >
              Communication Report
            </button>
            <button
              class="px-4 py-2 text-sm font-semibold text-white transition border border-transparent rounded-lg bg-mint hover:bg-gray-100 hover:border-mint hover:text-mint"
            >
              Performance Report
            </button>
          </div>
        </div>

        <!-- Assignments Overview Chart -->
        <div class="p-6 mb-8 bg-white shadow-md rounded-xl">
          <h2 class="mb-4 text-xl font-semibold text-mint">Assignments Overview</h2>
          <div
            class="flex items-center justify-center h-64 mb-6 text-gray-500 bg-gray-200 rounded-lg"
          >
            [ Chart goes here ]
          </div>

          <div class="grid grid-cols-2 gap-6">
            <div class="p-4 bg-gray-100 rounded-lg shadow">
              <p class="text-gray-700">Card Content A</p>
            </div>
            <div class="p-4 bg-gray-100 rounded-lg shadow">
              <p class="text-gray-700">Card Content B</p>
            </div>
          </div>
        </div>

        <!-- Completed Assignments -->
        <div class="p-6 mt-8 bg-white shadow-md rounded-xl">
          <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-semibold text-mint">Completed Assignments</h2>
            <button
              class="px-4 py-2 text-sm font-semibold text-white transition border border-transparent rounded-lg bg-mint hover:bg-gray-100 hover:border-mint hover:text-mint"
            >
              Manage all tasks
            </button>
          </div>

          <div class="mt-4 space-y-4">
            <div class="p-4 bg-gray-100 rounded-lg">
              <!-- Details grid -->
              <div class="grid grid-cols-2 text-sm text-gray-700 gap-y-2">
                <div><strong>JA ID:</strong> #12345</div>
                <div>
                  <strong>Deceased Name:</strong> Johnathan Alexander Doe the Third
                </div>
                <div><strong>Date:</strong> April 25, 2025</div>
                <div><strong>Assigned by:</strong> Admin</div>
              </div>

              <!-- Status + Button row -->
              <div class="flex items-center justify-between mt-4">
                <div
                  class="px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded w-fit"
                >
                  Not accepted by funeral service
                </div>
                <button
                  class="px-4 py-2 text-sm font-semibold text-white transition border border-transparent rounded-lg bg-mint hover:bg-gray-100 hover:border-mint hover:text-mint"
                >
                  View
                </button>
              </div>
            </div>
          </div>
          <div class="mt-4 space-y-4">
            <div class="p-4 bg-gray-100 rounded-lg">
              <!-- Details grid -->
              <div class="grid grid-cols-2 text-sm text-gray-700 gap-y-2">
                <div><strong>JA ID:</strong> #12345</div>
                <div>
                  <strong>Deceased Name:</strong> Johnathan Alexander Doe the Third
                </div>
                <div><strong>Date:</strong> April 25, 2025</div>
                <div><strong>Assigned by:</strong> Admin</div>
              </div>

              <!-- Status + Button row -->
              <div class="flex items-center justify-between mt-4">
                <div
                  class="px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded w-fit"
                >
                  Not accepted by funeral service
                </div>
                <button
                  class="px-4 py-2 text-sm font-semibold text-white transition border border-transparent rounded-lg bg-mint hover:bg-gray-100 hover:border-mint hover:text-mint"
                >
                  View
                </button>
              </div>
            </div>
          </div>
          <div class="mt-4 space-y-4">
            <div class="p-4 bg-gray-100 rounded-lg">
              <!-- Details grid -->
              <div class="grid grid-cols-2 text-sm text-gray-700 gap-y-2">
                <div><strong>JA ID:</strong> #12345</div>
                <div>
                  <strong>Deceased Name:</strong> Johnathan Alexander Doe the Third
                </div>
                <div><strong>Date:</strong> April 25, 2025</div>
                <div><strong>Assigned by:</strong> Admin</div>
              </div>

              <!-- Status + Button row -->
              <div class="flex items-center justify-between mt-4">
                <div
                  class="px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded w-fit"
                >
                  Not accepted by funeral service
                </div>
                <button
                  class="px-4 py-2 text-sm font-semibold text-white transition border border-transparent rounded-lg bg-mint hover:bg-gray-100 hover:border-mint hover:text-mint"
                >
                  View
                </button>
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
</script>
