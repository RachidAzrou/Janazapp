<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link } from "@inertiajs/vue3";
import {
  Table,
  TableBody,
  TableCaption,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from "@/Components/ui/table";
import { Button } from "@/Components/ui/button";
import {
  Pagination,
  PaginationEllipsis,
  PaginationFirst,
  PaginationLast,
  PaginationList,
  PaginationListItem,
  PaginationNext,
  PaginationPrev,
} from "@/Components/ui/pagination";

import { ref, watch, onMounted, onUnmounted } from "vue";
import { Inertia } from "@inertiajs/inertia";

import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import {
  faClock,
  faCircleCheck,
  faCircleXmark,
  faLock,
  faAngleDown,
  faAngleUp,
} from "@fortawesome/free-solid-svg-icons";

// Props passed from backend
const props = defineProps({
  organizations: Object,
  filters: Object,
  statuses: Object,
  statusFilter: String,
});

// Search and current page state
const searchQuery = ref(props.filters.search || ""); // Preserve search
const currentPage = ref(props.organizations.current_page); // Initial page
const filteredStatus = ref(props.filters.statusFiltered || ""); // Use the filter from props or default to an empty string

// Watch `organizations` prop to sync current page
watch(
  () => props.organizations.current_page,
  (newPage) => {
    currentPage.value = newPage;
  }
);

// Handle pagination changes
const handlePageChange = (page) => {
  if (page < 1 || page > props.organizations.last_page) return;

  Inertia.get(
    route("organizations"),
    {
      page,
      search: searchQuery.value,
      statusFiltered: filteredStatus.value,
    },
    {
      preserveState: true,
      preserveScroll: true,
      only: ["organizations"], // Only refresh the organizations list
    }
  );
};

// Function to handle the Enter key press for search
const handleSearchKeyPress = (event) => {
  // Only trigger the search if the Enter key is pressed
  if (event.key === "Enter") {
    // Always reset to page 1 when a new search is done
    Inertia.get(route("organizations", { page: 1, search: searchQuery.value }), {
      preserveState: true,
      preserveScroll: true,
      only: ["organizations"],
    });
  }
};

const filterStatus = (status) => {
  filteredStatus.value = status; // Update the reactive `filteredStatus`
  Inertia.get(
    route("organizations", {
      page: 1,
      statusFiltered: filteredStatus.value,
      search: searchQuery.value,
    }),
    {
      preserveState: true,
      preserveScroll: true,
      only: ["organizations"],
    }
  );
};

// Dropdown visibility state
const isDropdownOpen = ref(false);

// Toggle dropdown function
const toggleDropdown = () => {
  isDropdownOpen.value = !isDropdownOpen.value;
};

// Function to close dropdown if clicked outside
const closeDropdownIfClickedOutside = (event) => {
  const dropdownElement = document.querySelector("#dropdown-menu");
  const buttonElement = document.querySelector("#dropdown-trigger");

  if (
    dropdownElement &&
    !dropdownElement.contains(event.target) &&
    buttonElement &&
    !buttonElement.contains(event.target)
  ) {
    isDropdownOpen.value = false;
  }
};

// Attach and detach the event listener
onMounted(() => {
  document.addEventListener("click", closeDropdownIfClickedOutside);
});

onUnmounted(() => {
  document.removeEventListener("click", closeDropdownIfClickedOutside);
});
</script>

<template>
  <Head title="Organizations" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Organizations</h2>
        <Link
          href="/organizations/create"
          class="font-bold text-gray-900 duration-200 hover:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
        >
          Create Organization
        </Link>
      </div>
    </template>
    <div class="py-12">
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900">
            <!-- Legend and Search Bar -->
            <div class="flex items-center justify-between mb-4">
              <div class="relative inline-block">
                <!-- Dropdown Trigger -->
                <button
                  id="dropdown-trigger"
                  @click="toggleDropdown"
                  aria-haspopup="true"
                  :aria-expanded="isDropdownOpen"
                  class="px-4 py-2 font-medium text-white duration-200 bg-gray-900 rounded hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:muted-foreground-700 focus:ring-offset-2 focus:ring-muted-foreground"
                >
                  <FontAwesomeIcon
                    v-if="isDropdownOpen === false"
                    :icon="faAngleDown"
                    class="w-4 h-4 mr-2"
                  />
                  <FontAwesomeIcon
                    v-if="isDropdownOpen === true"
                    :icon="faAngleUp"
                    class="w-4 h-4 mr-2"
                  />
                  Legend / Filter
                </button>

                <!-- Dropdown Menu -->
                <div
                  id="dropdown-menu"
                  v-show="isDropdownOpen"
                  class="absolute left-0 z-10 w-56 mt-2 bg-white border rounded shadow-lg"
                >
                  <div>
                    <div
                      @click="filterStatus('active')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon
                        :icon="faCircleCheck"
                        class="mr-2 text-green-400"
                      />
                      <span>Active</span>
                    </div>
                    <div
                      @click="filterStatus('inactive')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon :icon="faCircleXmark" class="mr-2 text-red-400" />
                      <span>Inactive</span>
                    </div>
                    <div
                      @click="filterStatus('suspended')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon :icon="faLock" class="mr-2 text-orange-400" />
                      <span>Suspended</span>
                    </div>
                    <div
                      @click="filterStatus('pending_verification')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon :icon="faClock" class="mr-2 text-gray-400" />
                      <span>Pending Verification</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Search Bar -->
              <div class="flex items-center">
                <Link
                  href="/organizations"
                  class="inline-block px-4 py-2 mr-2 font-medium text-white duration-200 bg-gray-900 rounded hover:bg-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
                >
                  Reset
                </Link>
                <input
                  type="text"
                  placeholder="Search..."
                  class="w-64 px-3 py-2 border rounded"
                  v-model="searchQuery"
                  @keyup="handleSearchKeyPress"
                />
              </div>
            </div>
            <!-- Table -->
            <Table>
              <TableCaption>
                <div class="flex justify-end">
                  <Pagination
                    :total="props.organizations.total"
                    :itemsPerPage="props.organizations.per_page"
                    :sibling-count="1"
                    :show-edges="true"
                    :default-page="currentPage"
                    @page-changed="handlePageChange"
                  >
                    <PaginationList v-slot="{ items }" class="flex items-center gap-1">
                      <PaginationFirst
                        :variant="currentPage === 1 ? 'outline' : 'default'"
                        @click="handlePageChange(1)"
                        :disabled="currentPage === 1"
                      />
                      <PaginationPrev
                        class="w-10 h-10 p-0"
                        :variant="currentPage === 1 ? 'outline' : 'default'"
                        @click="handlePageChange(currentPage - 1)"
                        :disabled="currentPage === 1"
                      />

                      <template v-for="(item, index) in items" :key="index">
                        <PaginationListItem
                          v-if="item.type === 'page'"
                          :value="item.value"
                          as-child
                        >
                          <Button
                            class="w-10 h-10 p-0"
                            :variant="item.value === currentPage ? 'default' : 'outline'"
                            @click="handlePageChange(item.value)"
                          >
                            {{ item.value }}
                          </Button>
                        </PaginationListItem>
                        <PaginationEllipsis v-else />
                      </template>

                      <PaginationNext
                        :variant="
                          currentPage === props.organizations.last_page
                            ? 'outline'
                            : 'default'
                        "
                        @click="handlePageChange(currentPage + 1)"
                        :disabled="currentPage === props.organizations.last_page"
                      />
                      <PaginationLast
                        :variant="
                          currentPage === props.organizations.last_page
                            ? 'outline'
                            : 'default'
                        "
                        @click="handlePageChange(props.organizations.last_page)"
                        :disabled="currentPage === props.organizations.last_page"
                      />
                    </PaginationList>
                  </Pagination>
                </div>
              </TableCaption>
              <TableHeader>
                <TableRow>
                  <TableHead class="w-[100px]">ID</TableHead>
                  <TableHead>Name</TableHead>
                  <TableHead>E-mail</TableHead>
                  <TableHead>Status</TableHead>
                  <TableHead class="text-right">Details</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                <TableRow
                  v-for="organization in props.organizations.data"
                  :key="organization.id"
                >
                  <TableCell class="font-medium">{{ organization.id }}</TableCell>
                  <TableCell>{{ organization.name }}</TableCell>
                  <TableCell>{{ organization.email }}</TableCell>
                  <TableCell v-if="organization.status?.status_name === 'active'"
                    ><FontAwesomeIcon
                      title="Active"
                      :icon="faCircleCheck"
                      class="mr-1 text-green-400"
                  /></TableCell>
                  <TableCell v-if="organization.status?.status_name === 'inactive'"
                    ><FontAwesomeIcon
                      title="Inactive"
                      :icon="faCircleXmark"
                      class="mr-1 text-red-400"
                  /></TableCell>
                  <TableCell v-if="organization.status?.status_name === 'suspended'"
                    ><FontAwesomeIcon
                      title="Suspended"
                      :icon="faLock"
                      class="mr-1 text-orange-400"
                  /></TableCell>
                  <TableCell
                    v-if="organization.status?.status_name === 'pending_verification'"
                    ><FontAwesomeIcon
                      title="Pending Verification"
                      :icon="faClock"
                      class="mr-1 text-gray-400"
                  /></TableCell>
                  <TableCell v-if="!organization.status?.status_name">Dum dum</TableCell>
                  <TableCell class="text-right">
                    <Link
                      :href="'/organizations/' + organization.id + '/details'"
                      class="duration-300 hover:text-muted-foreground"
                    >
                      Show details
                    </Link>
                  </TableCell>
                </TableRow>
              </TableBody>
            </Table>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
