<script>
    // Fungsi utama untuk inisialisasi semua chart
    function initCharts() {
        console.log('initCharts function called');

        // Periksa apakah Chart.js sudah dimuat dengan benar
        if (typeof Chart === 'undefined') {
            console.error('Chart.js tidak tersedia. Tidak dapat membuat chart.');
            return;
        }

        // Data dummy untuk chart - nantinya diganti dengan data dari backend
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        const ticketVolumeData = [65, 59, 80, 81, 56, 55, 40, 50, 60, 70, 85, 90];
        const resolutionRateData = [70, 65, 75, 80, 60, 85, 75, 88, 92, 85, 90, 95];
        const categoryData = [35, 25, 20, 15, 5];
        const categoryLabels = ['Network', 'Hardware', 'Software', 'User Access', 'Other'];
        const statusData = [45, 30, 15, 10];
        const statusLabels = ['Open', 'In Progress', 'Resolved', 'Closed'];

        // Periksa semua elemen canvas dan buat chart
        const chartConfigs = [{
                id: 'ticketVolumeChart',
                name: 'Ticket Volume Chart',
                createChart: (ctx) => new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Ticket Volume',
                            data: ticketVolumeData,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 2,
                            tension: 0.1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                })
            },
            {
                id: 'resolutionRateChart',
                name: 'Resolution Rate Chart',
                createChart: (ctx) => new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Resolution Rate (%)',
                            data: resolutionRateData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                max: 100
                            }
                        }
                    }
                })
            },
            {
                id: 'categoryPieChart',
                name: 'Category Pie Chart',
                createChart: (ctx) => new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: categoryLabels,
                        datasets: [{
                            data: categoryData,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(54, 162, 235, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                })
            },
            {
                id: 'statusDoughnutChart',
                name: 'Status Doughnut Chart',
                createChart: (ctx) => new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: statusLabels,
                        datasets: [{
                            data: statusData,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.7)',
                                'rgba(255, 206, 86, 0.7)',
                                'rgba(75, 192, 192, 0.7)',
                                'rgba(153, 102, 255, 0.7)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                })
            }
        ];

        // Membuat semua chart
        for (const config of chartConfigs) {
            try {
                const canvas = document.getElementById(config.id);
                if (canvas) {
                    console.log(`Creating ${config.name}`);
                    config.createChart(canvas);
                } else {
                    console.error(`Canvas element for ${config.name} not found with ID: ${config.id}`);
                }
            } catch (e) {
                console.error(`Error creating ${config.name}:`, e);
            }
        }
    }

    // Panggil initCharts hanya sekali (initCharts sudah dipanggil di index.php)
    // Jangan panggil di sini untuk menghindari duplikasi
</script>