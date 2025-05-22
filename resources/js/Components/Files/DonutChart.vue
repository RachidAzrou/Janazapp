<script setup>
import { Doughnut } from "vue-chartjs";
import { Chart as ChartJS, Title, Tooltip, ArcElement } from "chart.js";

// Register default chart features
ChartJS.register(Title, Tooltip, ArcElement);

// Define props
const props = defineProps({
  completed: Number,
  inProgress: Number,
  pending: Number,
});

// Compute total count
const total = props.completed + props.inProgress + props.pending;

// Custom plugin to show total in center
const centerTextPlugin = {
  id: "centerText",
  beforeDraw(chart) {
    const { width } = chart;
    const { height } = chart;
    const ctx = chart.ctx;
    ctx.restore();
    const fontSize = (height / 114).toFixed(2);
    ctx.font = `${fontSize}em sans-serif`;
    ctx.textBaseline = "middle";

    const text = `${total}`;
    const textX = Math.round((width - ctx.measureText(text).width) / 2);
    const textY = height / 2;

    ctx.fillStyle = "#111827"; // dark gray text
    ctx.fillText(text, textX, textY);
    ctx.save();
  },
};

// Chart data
const data = {
  labels: ["Completed", "In Progress", "Pending"],
  datasets: [
    {
      label: "Files",
      data: [props.completed, props.inProgress, props.pending],
      backgroundColor: ["#34D399", "#3B82F6", "#FBBF24"],
      borderWidth: 1,
    },
  ],
};

// Chart options
const options = {
  responsive: true,
  maintainAspectRatio: false,
  plugins: {
    title: { display: false },
    centerText: {}, // activate plugin
  },
};

// Register custom plugin
ChartJS.register(centerTextPlugin);
</script>

<template>
  <div class="h-28 w-28">
    <Doughnut :data="data" :options="options" />
  </div>
</template>
