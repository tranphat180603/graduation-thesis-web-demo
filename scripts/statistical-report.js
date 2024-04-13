// Update the time every second (1000 milliseconds)
setInterval(function () {
  var days = [
    "Chủ nhật",
    "Thứ hai",
    "Thứ ba",
    "Thứ tư",
    "Thứ năm",
    "Thứ sáu",
    "Thứ bảy",
  ];
  var months = [
    "01",
    "02",
    "03",
    "04",
    "05",
    "06",
    "07",
    "08",
    "09",
    "10",
    "11",
    "12",
  ];

  var currentTime = new Date();
  var dayOfWeek = days[currentTime.getDay()];
  var dayOfMonth = currentTime.getDate();
  var month = months[currentTime.getMonth()];
  var year = currentTime.getFullYear();

  var formattedTime = dayOfWeek + ", " + dayOfMonth + "/" + month + "/" + year;
  document.getElementById("currentTime").textContent = formattedTime;
}, 1000);

//tao mau cho chart
function generateColors(labels) {
  const specificColors = [
    "rgba(255, 0, 0, 0.8)", // Red
    "rgba(255, 255, 0, 0.8)", // Yellow
    "rgba(0, 128, 0, 0.8)", // Green
    "rgba(0, 0, 255, 0.8)", // Blue
    "rgba(128, 0, 128, 0.8)", // Purple
    "rgba(255, 20, 147, 0.8)", // Pink
    "rgba(255, 140, 0, 0.8)", // Dark Orange
    "rgba(0, 255, 255, 0.8)", // Cyan
    "rgba(255, 0, 255, 0.8)", // Magenta
    "rgba(255, 165, 0, 0.8)", // Orange
  ];

  const numLabels = labels.length;

  const numColors = Math.min(numLabels, specificColors.length);

  return specificColors.slice(0, numColors);
}
function DoubleLineChart(ctx, labels, data1, data2) {
  return new Chart(ctx, {
    data: {
      labels: [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
      ],
      datasets: [
        {
          label: "Khách hàng",
          type: "line",
          data: data1.map((entry) => ({ x: entry.month, y: entry.count })),
          borderColor: "rgba(255, 99, 132, 1)", // You can customize the line color
          backgroundColor: "rgba(255, 99, 132, 0.2)", // You can customize the fill color
        },
        {
          label: "Khách",
          type: "line",
          data: data2.map((entry) => ({ x: entry.month, y: entry.count })),
          borderColor: "rgba(54, 162, 235, 1)", // You can customize the line color
          backgroundColor: "rgba(54, 162, 235, 0.2)", // You can customize the fill color
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
          position: "top",
        },
      },
      interaction: {
        mode: "index",
      },
    },
  });
}
function HorizontalBarChart(ctx, labels, data) {
  // Generate colors for the labels
  const backgroundColors = generateColors(labels);

  // Create datasets
  const datasets = labels.map((label, index) => ({
    label: label,
    data: [data[index]],
    backgroundColor: backgroundColors[index],
    hoverBackgroundColor: backgroundColors[index].replace(", 0.8)", ", 0.4)"),
    hoverBorderColor: "rgba(0, 0, 0, 0.8)",
    hoverBorderWidth: 2,
    hoverBorderRadius: 5,
  }));

  // Return the chart instance
  return new Chart(ctx, {
    type: "bar",
    data: {
      labels: [""],
      datasets: datasets,
    },
    options: {
      indexAxis: "y",
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
          position: "right",
        },
      },
      interaction: {
        mode: "index",
      },
    },
  });
}

function PieChart(ctx, labels, data) {
  return new Chart(ctx, {
    type: "pie",
    data: {
      labels: labels,
      datasets: [
        {
          data: data,
          backgroundColor: generateColors(labels),
          hoverBackgroundColor: generateColors(labels).map((color) =>
            color.replace(", 0.8)", ", 0.4)")
          ),
          hoverBorderColor: "rgba(0, 0, 0, 0.8)",
          hoverBorderWidth: 2,
          hoverBorderRadius: 5,
          barPercentage: 0.6,
          categoryPercentage: 0.8,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
          position: "top",
        },
      },
      interaction: {
        mode: "index",
      },
      scales: {
        x: {
          grid: {
            display: false,
          },
          display: false,
        },
      },
    },
  });
}

function BarLineChart(ctx, labels, data1, data2) {
  return new Chart(ctx, {
    data: {
      labels: labels,
      datasets: [
        {
          type: "line",
          label: "Đơn đặt sân",
          data: data2,
          borderColor: "rgba(255,69,0, 0.8)",
          backgroundColor: "rgba(255,69,0, 0.8)",
          hoverBackgroundColor: generateColors(labels).map((color) =>
            color.replace(", 0.8)", ", 0.4)")
          ),
          hoverBorderColor: "rgba(0, 0, 0, 0.8)",
          hoverBorderWidth: 2,
          hoverBorderRadius: 5,
          yAxisID: "y",
        },
        {
          type: "bar",
          label: "Doanh thu",
          data: data1,
          backgroundColor: "rgba(0,139,139, 0.8)",
          hoverBackgroundColor: generateColors(labels).map((color) =>
            color.replace(", 0.8)", ", 0.4)")
          ),
          hoverBorderColor: "rgba(0, 0, 0, 0.8)",
          hoverBorderWidth: 2,
          hoverBorderRadius: 5,
          yAxisID: "y1",
          barPercentage: 0.6,
          categoryPercentage: 0.8,
        },
      ],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
          position: "top",
        },
      },
      interaction: {
        mode: "index",
      },
      scales: {
        y: {
          type: "linear",
          grid: {
            display: false,
          },
        },
        y1: {
          type: "linear",
          position: "right",
        },
        x: {
          grid: {
            display: false,
          },
        },
      },
    },
  });
}

function groupedBarChart(ctx, data) {
  //tao. mau` cho unique court type
  const uniqueCourtTypes = Array.from(new Set(data.map((entry) => entry.name)));

  const backgroundColors = generateColors(uniqueCourtTypes);

  var datasets = [];

  uniqueCourtTypes.forEach((courtType) => {
    // dung de lay du~ lieu, tim` theo court type
    const filteredData = data.filter((entry) => entry.name === courtType);

    const dataset = {
      label: courtType,
      data: filteredData.map((entry) => ({
        x: entry.month,
        y: entry.total_revenue,
      })),
      backgroundColor: backgroundColors[uniqueCourtTypes.indexOf(courtType)],
      hoverBackgroundColor: backgroundColors[
        uniqueCourtTypes.indexOf(courtType)
      ].replace(", 0.8)", ", 0.4)"),
      hoverBorderColor: "rgba(0, 0, 0, 0.8)",
      hoverBorderWidth: 2,
      hoverBorderRadius: 5,
    };

    datasets.push(dataset);
  });

  var groupedBarChart = new Chart(ctx, {
    type: "bar",
    data: {
      datasets: datasets,
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: true,
          position: "top",
        },
      },
    },
  });

  return groupedBarChart;
}
document.addEventListener("DOMContentLoaded", function () {
  const pickerText = document.getElementById("picker-text");
  const icon = document.getElementById("picker-img");

  icon.addEventListener("click", function () {
    flatpickr(pickerText, {
      dateFormat: "Y",
      minDate: "2000",
      maxDate: "today",
      onChange: function (selectedDates, dateStr, instance) {
        // Update href attribute of the page with the selected year
        const selectedYear = dateStr;
        const currentURL = window.location.href.split("?")[0]; // Get current URL without query parameters
        const newURL = currentURL + "?year=" + selectedYear; // Append selected year as a query parameter
        window.location.href = newURL; // Redirect to the new URL
        pickerText.textContent = dateStr;
      },
    });
    pickerText.click();
  });
});
