function getChartColorsArray(id) {
  const element = document.getElementById(id);
  if (element !== null) {
    const colorsAttribute = element.getAttribute("data-colors");
    if (colorsAttribute !== null) {
      return JSON.parse(colorsAttribute).map((color) => color.replace(" ", ""));
    }
  }
  return null;
}

function createDonutChart(id, series, labels, height) {
  const chartColors = getChartColorsArray(id);
  if (chartColors !== null) {
    const options = {
      series: series,
      chart: { height: height, type: "donut" },
      labels: labels,
      legend: { position: "bottom" },
      dataLabels: { dropShadow: { enabled: false } },
      colors: chartColors,
    };
    const chart = new ApexCharts(document.querySelector(`#${id}`), options);
    chart.render();
  }
}

function createLineChart(id, series, categories, height) {
  const chartColors = getChartColorsArray(id);
  if (chartColors !== null) {
    const options = {
      series: series,
      chart: { height: height, type: "line" },
      xaxis: { categories: categories },
      legend: { position: "top" },
      dataLabels: { enabled: false },
      markers: { size: 0 },
      colors: chartColors,
    };
    const chart = new ApexCharts(document.querySelector(`#${id}`), options);
    chart.render();
  }
}

// Creating simple donut chart
// createDonutChart(
//   "simple_dount_chart",
//   [44, 55, 13],
//   ["Expenses", "Payments", "Cashout"],
//   412
// );
//
// // Creating line chart with data labels
// createLineChart(
//   "line_chart_datalabel",
//   [
//     {
//       name: "Current Year",
//       data: [14, 11, 16, 12, 17, 13, 12, 14, 18, 16, 12, 20],
//     },
//     {
//       name: "Previous Year",
//       data: [26, 24, 32, 36, 33, 31, 33, 34, 31, 36, 32, 37],
//     },
//   ],
//   [
//     "Jan",
//     "Feb",
//     "Mar",
//     "Apr",
//     "May",
//     "Jun",
//     "Jul",
//     "Aug",
//     "Sep",
//     "Oct",
//     "Nov",
//     "Dec",
//   ],
//   380
// );
