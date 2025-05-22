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
  faSeedling,
  faTruckFast,
  faFlagCheckered,
  faFolderOpen,
  faHourglassHalf,
  faCircleQuestion,
  faAngleDown,
  faAngleUp,
} from "@fortawesome/free-solid-svg-icons";

// Props passed from backend
const props = defineProps({
  cases: Object,
  filters: Object,
  statusFilter: String,
});

// Search and current page state
const searchQuery = ref(props.filters.search || ""); // Preserve search
const currentPage = ref(props.cases.current_page); // Initial page
const filteredStatus = ref(props.filters.statusFiltered || ""); // Use the filter from props or default to an empty string

// Watch `cases` prop to sync current page
watch(
  () => props.cases.current_page,
  (newPage) => {
    currentPage.value = newPage;
  }
);

// Handle pagination changes
const handlePageChange = (page) => {
  if (page < 1 || page > props.cases.last_page) return;

  Inertia.get(
    route("cases"),
    {
      page,
      search: searchQuery.value,
      statusFiltered: filteredStatus.value,
    },
    {
      preserveState: true,
      preserveScroll: true,
      only: ["cases"], // Only refresh the cases list
    }
  );
};

// Function to handle the Enter key press for search
const handleSearchKeyPress = (event) => {
  // Only trigger the search if the Enter key is pressed
  if (event.key === "Enter") {
    // Always reset to page 1 when a new search is done
    Inertia.get(route("cases", { page: 1, search: searchQuery.value }), {
      preserveState: true,
      preserveScroll: true,
      only: ["cases"],
    });
  }
};

const filterStatus = (status) => {
  filteredStatus.value = status; // Update the reactive `filteredStatus`
  Inertia.get(
    route("cases", {
      page: 1,
      statusFiltered: filteredStatus.value,
      search: searchQuery.value,
    }),
    {
      preserveState: true,
      preserveScroll: true,
      only: ["cases"],
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
  <Head title="Cases" />
  <AuthenticatedLayout>
    <template #header>
      <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Cases</h2>
        <Link
          href="/cases/create"
          class="font-bold text-gray-900 duration-200 hover:text-muted-foreground focus:outline-none focus:ring-2 focus:ring-muted-foreground focus:ring-offset-2"
        >
          Create Case
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
                  class="absolute left-0 z-40 w-56 mt-2 bg-white border rounded shadow-lg"
                >
                  <div>
                    <div
                      @click="filterStatus('new')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon
                        :icon="faSeedling"
                        class="flex-shrink-0 w-5 h-5 text-green-700"
                      />
                      <span>New</span>
                    </div>
                    <div
                      @click="filterStatus('approved')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon
                        :icon="faCircleCheck"
                        class="flex-shrink-0 w-5 h-5 text-green-400"
                      />
                      <span>Approved</span>
                    </div>
                    <div
                      @click="filterStatus('pending_verification')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon
                        :icon="faClock"
                        class="flex-shrink-0 w-5 h-5 text-gray-400"
                      />
                      <span>Pending Verification</span>
                    </div>
                    <div
                      @click="filterStatus('pending_approval')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon
                        :icon="faCircleQuestion"
                        class="flex-shrink-0 w-5 h-5 text-orange-400"
                      />
                      <span>Pending Approval</span>
                    </div>
                    <div
                      @click="filterStatus('pending_documents')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon
                        :icon="faFolderOpen"
                        class="flex-shrink-0 w-5 h-5 text-yellow-500"
                      />
                      <span>Pending Documents</span>
                    </div>
                    <div
                      @click="filterStatus('in_progress')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon
                        :icon="faHourglassHalf"
                        class="flex-shrink-0 w-5 h-5 text-yellow-300"
                      />
                      <span>In Progress</span>
                    </div>
                    <div
                      @click="filterStatus('in_transit')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon
                        :icon="faTruckFast"
                        class="flex-shrink-0 w-5 h-5 text-blue-400"
                      />
                      <span>In Transit</span>
                    </div>
                    <div
                      @click="filterStatus('completed')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon
                        :icon="faFlagCheckered"
                        class="flex-shrink-0 w-5 h-5 text-gray-900"
                      />
                      <span>Completed</span>
                    </div>
                    <div
                      @click="filterStatus('cancelled')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon
                        :icon="faCircleXmark"
                        class="flex-shrink-0 w-5 h-5 text-red-400"
                      />
                      <span>Cancelled</span>
                    </div>
                    <div
                      @click="filterStatus('on_hold')"
                      class="flex items-center gap-2 py-2 pl-4 rounded hover:cursor-pointer hover:bg-gray-100"
                    >
                      <FontAwesomeIcon
                        :icon="faLock"
                        class="flex-shrink-0 w-5 h-5 text-orange-400"
                      />
                      <span>On Hold</span>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Search Bar -->
              <div class="flex items-center">
                <Link
                  href="/cases"
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
                    :total="props.cases.total"
                    :itemsPerPage="props.cases.per_page"
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
                          currentPage === props.cases.last_page ? 'outline' : 'default'
                        "
                        @click="handlePageChange(currentPage + 1)"
                        :disabled="currentPage === props.cases.last_page"
                      />
                      <PaginationLast
                        :variant="
                          currentPage === props.cases.last_page ? 'outline' : 'default'
                        "
                        @click="handlePageChange(props.cases.last_page)"
                        :disabled="currentPage === props.cases.last_page"
                      />
                    </PaginationList>
                  </Pagination>
                </div>
              </TableCaption>
              <TableHeader>
                <TableRow>
                  <TableHead class="w-[100px]">ID</TableHead>
                  <TableHead>Created By</TableHead>
                  <TableHead>Reference Number</TableHead>
                  <TableHead>Status</TableHead>
                  <TableHead class="text-right">Details</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                <TableRow v-for="cases in props.cases.data" :key="cases.id">
                  <TableCell class="font-medium">{{ cases.id }}</TableCell>
                  <TableCell>{{ cases.created_by }}</TableCell>
                  <TableCell>{{ cases.reference_number }}</TableCell>
                  <TableCell v-if="cases.status === 'new'"
                    ><FontAwesomeIcon
                      title="New"
                      :icon="faSeedling"
                      class="mr-1 text-green-700"
                  /></TableCell>
                  <TableCell v-if="cases.status === 'approved'"
                    ><FontAwesomeIcon
                      title="Approved"
                      :icon="faCircleCheck"
                      class="mr-1 text-green-400"
                  /></TableCell>
                  <TableCell v-if="cases.status === 'pending_verification'"
                    ><FontAwesomeIcon
                      title="Pending Verification"
                      :icon="faClock"
                      class="mr-1 text-gray-400"
                  /></TableCell>
                  <TableCell v-if="cases.status === 'pending_approval'"
                    ><FontAwesomeIcon
                      title="Pending Approval"
                      :icon="faCircleQuestion"
                      class="mr-1 text-orange-400"
                  /></TableCell>
                  <TableCell v-if="cases.status === 'pending_documents'"
                    ><FontAwesomeIcon
                      title="Pending Documents"
                      :icon="faFolderOpen"
                      class="mr-1 text-yellow-500"
                  /></TableCell>
                  <TableCell v-if="cases.status === 'in_progress'"
                    ><FontAwesomeIcon
                      title="In Progress"
                      :icon="faHourglassHalf"
                      class="mr-1 text-yellow-300"
                  /></TableCell>
                  <TableCell v-if="cases.status === 'in_transit'"
                    ><FontAwesomeIcon
                      title="In Transit"
                      :icon="faTruckFast"
                      class="mr-1 text-blue-400"
                  /></TableCell>
                  <TableCell v-if="cases.status === 'completed'"
                    ><FontAwesomeIcon
                      title="Completed"
                      :icon="faFlagCheckered"
                      class="mr-1 text-gray-900"
                  /></TableCell>
                  <TableCell v-if="cases.status === 'cancelled'"
                    ><FontAwesomeIcon
                      title="Cancelled"
                      :icon="faCircleXmark"
                      class="mr-1 text-red-400"
                  /></TableCell>
                  <TableCell v-if="cases.status === 'on_hold'"
                    ><FontAwesomeIcon
                      title="On Hold"
                      :icon="faLock"
                      class="mr-1 text-orange-400"
                  /></TableCell>
                  <TableCell v-if="!cases.status">N/A</TableCell>
                  <TableCell class="text-right">
                    <Link
                      :href="'/cases/' + cases.id + '/details'"
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
