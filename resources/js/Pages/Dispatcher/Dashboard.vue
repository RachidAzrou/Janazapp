<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { Head } from "@inertiajs/vue3";
import SidebarLink from "@/Components/SidebarLink.vue";

const username = "Ian Weiremans";

// Time and Date
const time = ref("");
const currentDate = new Date().toLocaleDateString(undefined, {
  weekday: "long",
  year: "numeric",
  month: "long",
  day: "numeric",
});

// Time of day greeting
const hours = new Date().getHours();
const timeOfDay = hours < 12 ? "morning" : hours < 18 ? "afternoon" : "evening";

// Weather data
const weather = ref(""); // Dynamically updated weather

// Fetch the weather from OpenWeatherMap API
async function fetchWeather() {
  const apiKey = "0d5500905a058f0dc18f64ec996ab3d3";
  const city = "Brussels";
  const unit = "metric";

  try {
    const response = await fetch(
      `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=${unit}`
    );
    const data = await response.json();
    const roundedTemp = Math.round(data.main.temp);
    const description = data.weather[0].description;

    const emoji = getWeatherEmoji(description);
    weather.value = `${emoji} ${description}, ${roundedTemp}°C`;
  } catch (error) {
    console.error("Failed to fetch weather:", error);
    weather.value = "Unable to fetch weather";
  }
}

// Match description to emoji
function getWeatherEmoji(description) {
  const lower = description.toLowerCase();
  if (lower.includes("clear")) return "☀️";
  if (lower.includes("clouds")) return "☁️";
  if (lower.includes("rain")) return "🌧️";
  if (lower.includes("drizzle")) return "🌦️";
  if (lower.includes("thunderstorm")) return "⛈️";
  if (lower.includes("snow")) return "❄️";
  if (lower.includes("mist") || lower.includes("fog") || lower.includes("haze"))
    return "🌫️";
  return "🌡️"; // default emoji
}

// Function to update time
function updateTime() {
  const now = new Date();
  const hrs = now.getHours().toString().padStart(2, "0");
  const mins = now.getMinutes().toString().padStart(2, "0");
  time.value = `${hrs}:${mins}`;
}

// Start clock and weather updates on mount
let intervalId;
onMounted(() => {
  updateTime(); // initial time
  intervalId = setInterval(updateTime, 1000); // update time every second
  fetchWeather(); // initial weather fetch
  setInterval(fetchWeather, 30000); // update weather every 30 seconds
});

// Clear interval when component is destroyed
onUnmounted(() => {
  clearInterval(intervalId);
});
</script>

<template>
  <Head title="Dashboard" />
  <div class="flex h-screen text-gray-800 bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white border-r border-gray-200 shadow-sm">
      <div class="p-6 text-2xl font-semibold text-mint">My Dashboard</div>
      <nav class="flex flex-col gap-2 px-4 mt-6">
        <SidebarLink icon="📊" label="Dashboard" to="/dashboarddispatcher" />
        <SidebarLink icon="📋" label="Tasks" to="/tasksdispatcher" />
        <SidebarLink icon="📁" label="Files" to="/filesdispatcher" />
        <SidebarLink icon="📈" label="Reports" to="/reportsdispatcher" />
        <SidebarLink icon="💬" label="Chat" to="/chatdispatcher" />
        <SidebarLink icon="⚙️" label="Settings" to="/settingsdispatcher" />
      </nav>
    </aside>

    <!-- Main content centered -->
    <main class="flex-1 overflow-auto">
      <div class="flex justify-center min-h-full p-8">
        <div class="self-center w-full max-w-4xl space-y-8">
          <!-- Welcome Message -->
          <div class="p-6 bg-white shadow-md rounded-xl">
            <h1 class="text-2xl font-semibold text-mint">
              Good {{ timeOfDay }}, {{ username }}!
            </h1>
            <p class="mt-2 text-gray-600">
              Today is {{ currentDate }} and it is currently <strong>{{ time }}</strong
              >. The weather is looking like {{ weather }}.
            </p>
          </div>

          <!-- Assignments Overview -->
          <div class="p-6 bg-white shadow-md rounded-xl">
            <h2 class="mb-4 text-xl font-semibold text-mint">Assignments Overview</h2>
            <div
              class="flex items-center justify-center h-64 text-gray-500 bg-gray-200 rounded-lg"
            >
              [ Chart goes here ]
            </div>
          </div>

          <!-- Completed Assignments Chart -->
          <div class="p-6 bg-white shadow-md rounded-xl">
            <h2 class="mb-4 text-xl font-semibold text-mint">Completed Assignments</h2>
            <div
              class="flex items-center justify-center h-64 text-gray-500 bg-gray-200 rounded-lg"
            >
              [ Chart goes here ]
            </div>
          </div>

          <!-- Assignment List -->
          <div class="p-6 bg-white shadow-md rounded-xl">
            <h2 class="mb-4 text-xl font-semibold text-mint">Completed Assignments</h2>
            <div class="space-y-4">
              <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg">
                <span class="text-gray-800">Assignment 1: Dashboard Redesign</span>
                <button
                  class="px-4 py-2 text-sm font-semibold text-white transition border border-transparent rounded-lg bg-mint hover:bg-gray-100 hover:border-mint hover:text-mint"
                >
                  View
                </button>
              </div>
              <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg">
                <span class="text-gray-800">Assignment 2: API Integration</span>
                <button
                  class="px-4 py-2 text-sm font-semibold text-white transition border border-transparent rounded-lg bg-mint hover:bg-gray-100 hover:border-mint hover:text-mint"
                >
                  View
                </button>
              </div>
              <div class="flex items-center justify-between p-4 bg-gray-100 rounded-lg">
                <span class="text-gray-800">Assignment 3: UX Improvements</span>
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
