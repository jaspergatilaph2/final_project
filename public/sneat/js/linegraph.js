let myChartInstance = null;

const fetchAppointmentData = async () => {
  try {
    const response = await fetch("/appointments/data");
    if (!response.ok) {
      throw new Error("Failed to fetch appointment data");
    }
    return await response.json();
  } catch (error) {
    console.error(error);
    return {
      labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      data: [10,20,15,25,30,22,18,27,35,40,50,60], // Default data in case of error
    };
  }
};

const initChart = async () => {
  const canvas = document.getElementById("myChart");
  if (!canvas) {
    console.error("Canvas element with id 'myChart' not found.");
    return;
  }
  const ctx = canvas.getContext("2d");
  const appointmentData = await fetchAppointmentData();

  // Destroy previous chart instance if it exists
  if (myChartInstance) {
    myChartInstance.destroy();
  }

  myChartInstance = new Chart(ctx, {
    type: "bar",
    data: {
      labels: appointmentData.labels,
      datasets: [
        {
          label: "Number of Appointments",
          data: appointmentData.data,
          backgroundColor: "rgba(75, 192, 192, 0.2)",
          borderColor: "rgba(75, 192, 192, 1)",
          borderWidth: 5,
        },
      ],
    },
    options: {
      responsive: true,
      plugins: {
        legend: { position: "top" },
        title: {
          display: true,
          text: "Appointments Per Month - 2025",
        },
      },
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
};

document.addEventListener("DOMContentLoaded", initChart);