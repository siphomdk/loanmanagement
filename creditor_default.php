<?php
// Placeholder for graph data or other backend logic
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creditor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            margin-top: 20px;
        }
        .chart-item {
            margin-bottom: 30px;
        }
        /* Reducing graph size by 50% */
        canvas {
            max-width: 50% !important; /* Adjusted to 50% */
            height: auto !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="my-4">Creditor Dashboard</h2>
        <div class="row">
            <div class="col-md-12">
                <div class="chart-item">
                    <h4>Capital vs. Invested vs. Paid Interest</h4>
                    <canvas id="capitalChart"></canvas>
                </div>
                <div class="chart-item">
                    <h4>Top 10 Debtors by Payment</h4>
                    <canvas id="topDebtorsChart"></canvas>
                </div>
                <div class="chart-item">
                    <h4>Yearly Payment Returns</h4>
                    <canvas id="yearlyReturnsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Capital vs. Invested vs. Paid Interest Pie Chart
        var ctx1 = document.getElementById('capitalChart').getContext('2d');
        var capitalChart = new Chart(ctx1, {
            type: 'pie',
            data: {
                labels: ['Capital', 'Invested', 'Paid Interest'],
                datasets: [{
                    data: [300, 150, 100], // Sample data
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': $' + tooltipItem.raw;
                            }
                        }
                    }
                }
            }
        });

        // Top 10 Debtors Bar Chart
        var ctx2 = document.getElementById('topDebtorsChart').getContext('2d');
        var topDebtorsChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Debtor 1', 'Debtor 2', 'Debtor 3', 'Debtor 4', 'Debtor 5', 'Debtor 6', 'Debtor 7', 'Debtor 8', 'Debtor 9', 'Debtor 10'],
                datasets: [{
                    label: 'Amount Paid',
                    data: [200, 150, 300, 250, 180, 220, 170, 190, 210, 260], // Sample data
                    backgroundColor: '#36A2EB'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': $' + tooltipItem.raw;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Yearly Payment Returns Line Chart
        var ctx3 = document.getElementById('yearlyReturnsChart').getContext('2d');
        var yearlyReturnsChart = new Chart(ctx3, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Yearly Returns',
                    data: [3000, 2800, 3200, 3100, 3300, 3400, 3000, 3500, 3600, 3700, 3800, 3900], // Sample data
                    borderColor: '#FF6384',
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': $' + tooltipItem.raw;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
