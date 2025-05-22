<template>
  <Head title="Tasks" />
  <div class="flex h-screen text-gray-800 bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 shadow-sm">
      <div class="p-6 text-2xl font-semibold text-mint">Task Management</div>
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
    <main class="flex justify-center flex-1 p-8 overflow-auto">
      <div class="w-full max-w-4xl">
        <div class="p-6 mb-6 bg-white shadow-md rounded-xl">
          <!-- Search and Filter -->
          <div class="flex flex-wrap items-center gap-4 mb-6">
            <input
              type="text"
              v-model="searchQuery"
              placeholder="Search tasks..."
              class="flex-1 p-2 border border-gray-300 rounded-md"
            />
            <select
              v-model="selectedFilter"
              class="p-2 border border-gray-300 rounded-md"
            >
              <option value="All">All</option>
              <option value="Completed">Completed</option>
              <option value="Pending">Pending</option>
              <option value="In Progress">In Progress</option>
            </select>
          </div>

          <!-- Task Rows -->
          <div class="space-y-4">
            <div
              v-for="task in filteredTasks"
              :key="task.id"
              class="flex items-center justify-between p-4 bg-gray-100 rounded-lg"
            >
              <div>
                <h3 class="text-lg font-medium">{{ task.title }}</h3>
                <p class="text-sm text-gray-600">{{ task.description }}</p>
              </div>
              <button
                @click="viewTask(task.id)"
                class="px-4 py-2 text-sm font-semibold text-white transition border-2 border-transparent rounded-lg bg-mint hover:bg-white hover:text-mint hover:border-mint"
              >
                View
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import SidebarLink from "@/Components/SidebarLink.vue";

const searchQuery = ref("");
const selectedFilter = ref("All");

const tasks = ref([
  { id: 1, title: "Task 1", description: "Description for Task 1", status: "Completed" },
  { id: 2, title: "Task 2", description: "Description for Task 2", status: "Pending" },
  {
    id: 3,
    title: "Task 3",
    description: "Description for Task 3",
    status: "In Progress",
  },
  { id: 4, title: "Task 4", description: "Description for Task 4", status: "Completed" },
]);

const filteredTasks = computed(() => {
  return tasks.value.filter((task) => {
    const matchesFilter =
      selectedFilter.value === "All" || task.status === selectedFilter.value;
    const matchesSearch = task.title
      .toLowerCase()
      .includes(searchQuery.value.toLowerCase());
    return matchesFilter && matchesSearch;
  });
});

function viewTask(taskId) {
  console.log("View task", taskId); // Replace with actual routing or modal
}
</script>
