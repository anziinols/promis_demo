<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

<!-- DataTables CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap4.min.css">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

<!-- OpenLayers for Map -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v10.2.1/ol.css" />
<script src="https://cdn.jsdelivr.net/npm/ol@v10.2.1/dist/ol.js"></script>

<!-- Map Styles -->
<style>
    #map {
        width: 100%;
        height: 700px;
        position: relative;
        z-index: 1;
    }

    .leaflet-container {
        height: 100%;
        width: 100%;
    }
</style>

<div class="container-fluid px-3 px-md-4 py-3" id="printpdf">

    <!-- Page Header -->
    <div class="card bg-primary text-white shadow-sm mb-4 border-0">
        <div class="card-body py-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2 fw-bold"><i class="fas fa-chart-bar me-2"></i>General Reports Dashboard</h2>
                    <p class="mb-0 opacity-75"><?= session('orgname') ?> | Comprehensive Project Analytics</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="d-flex justify-content-md-end align-items-center">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span><?= date('l, F j, Y') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Status Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h5 class="mb-3 fw-bold text-dark"><i class="fas fa-project-diagram me-2"></i>Project Status Overview</h5>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card border-0 shadow-sm h-100 border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h6 class="text-muted text-uppercase mb-2 small fw-semibold">Active Projects</h6>
                            <h2 class="mb-0 fw-bold text-success"><?= $status_counts['active'] ?></h2>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card border-0 shadow-sm h-100 border-start border-primary border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h6 class="text-muted text-uppercase mb-2 small fw-semibold">Completed Projects</h6>
                            <h2 class="mb-0 fw-bold text-primary"><?= $status_counts['completed'] ?></h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-flag-checkered fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card border-0 shadow-sm h-100 border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h6 class="text-muted text-uppercase mb-2 small fw-semibold">On Hold</h6>
                            <h2 class="mb-0 fw-bold text-warning"><?= $status_counts['hold'] ?></h2>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-pause-circle fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card border-0 shadow-sm h-100 border-start border-secondary border-4">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h6 class="text-muted text-uppercase mb-2 small fw-semibold">Canceled Projects</h6>
                            <h2 class="mb-0 fw-bold text-secondary"><?= $status_counts['canceled'] ?></h2>
                        </div>
                        <div class="bg-secondary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-times-circle fa-2x text-secondary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h5 class="mb-3 fw-bold text-dark"><i class="fas fa-dollar-sign me-2"></i>Financial Overview</h5>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h6 class="text-muted text-uppercase mb-2 small fw-semibold">Total Budget</h6>
                            <h4 class="mb-0 fw-bold text-dark"><?= COUNTRY_CURRENCY . number_format($pro_total_budget, 2) ?></h4>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-wallet fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h6 class="text-muted text-uppercase mb-2 small fw-semibold">Total Paid</h6>
                            <h4 class="mb-0 fw-bold text-success"><?= COUNTRY_CURRENCY . number_format($pro_total_paid, 2) ?></h4>
                        </div>
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h6 class="text-muted text-uppercase mb-2 small fw-semibold">Outstanding</h6>
                            <h4 class="mb-0 fw-bold text-warning"><?= COUNTRY_CURRENCY . number_format($pro_total_outstanding, 2) ?></h4>
                        </div>
                        <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="flex-grow-1">
                            <h6 class="text-muted text-uppercase mb-2 small fw-semibold">Overpaid</h6>
                            <h4 class="mb-0 fw-bold text-danger"><?= COUNTRY_CURRENCY . number_format($pro_total_overpaid, 2) ?></h4>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-times-circle fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Milestone and Phase Statistics -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h5 class="mb-3 fw-bold text-dark"><i class="fas fa-tasks me-2"></i>Progress Metrics</h5>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-info bg-opacity-10 rounded-circle p-3 d-inline-block mb-2">
                        <i class="fas fa-list-check fa-2x text-info"></i>
                    </div>
                    <h6 class="text-muted text-uppercase mb-1 small">Total Milestones</h6>
                    <h3 class="mb-0 fw-bold text-dark"><?= $ms_total ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block mb-2">
                        <i class="fas fa-check fa-2x text-primary"></i>
                    </div>
                    <h6 class="text-muted text-uppercase mb-1 small">MS Completed</h6>
                    <h3 class="mb-0 fw-bold text-primary"><?= $ms_completed ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle p-3 d-inline-block mb-2">
                        <i class="fas fa-pause fa-2x text-warning"></i>
                    </div>
                    <h6 class="text-muted text-uppercase mb-1 small">MS On Hold</h6>
                    <h3 class="mb-0 fw-bold text-warning"><?= $ms_hold ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-secondary bg-opacity-10 rounded-circle p-3 d-inline-block mb-2">
                        <i class="fas fa-clock fa-2x text-secondary"></i>
                    </div>
                    <h6 class="text-muted text-uppercase mb-1 small">MS Pending</h6>
                    <h3 class="mb-0 fw-bold text-secondary"><?= $ms_pending ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-danger bg-opacity-10 rounded-circle p-3 d-inline-block mb-2">
                        <i class="fas fa-times-circle fa-2x text-danger"></i>
                    </div>
                    <h6 class="text-muted text-uppercase mb-1 small">MS Canceled</h6>
                    <h3 class="mb-0 fw-bold text-danger"><?= $ms_canceled ?></h3>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-6 col-sm-12">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block mb-2">
                        <i class="fas fa-layer-group fa-2x text-success"></i>
                    </div>
                    <h6 class="text-muted text-uppercase mb-1 small">Phase Completion</h6>
                    <h3 class="mb-0 fw-bold text-dark"><?= number_format($ph_completion_percentage, 1) ?>%</h3>
                    <small class="text-muted"><?= $ph_total ?> total phases</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <h5 class="mb-3 fw-bold text-dark"><i class="fas fa-chart-pie me-2"></i>Visual Analytics</h5>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h6 class="mb-0 fw-semibold"><i class="fas fa-chart-pie me-2 text-primary"></i>Project Status Distribution</h6>
                </div>
                <div class="card-body">
                    <canvas id="projectPieChart" width="50" height="50"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h6 class="mb-0 fw-semibold"><i class="fas fa-tasks me-2 text-success"></i>Milestones Progress</h6>
                </div>
                <div class="card-body">
                    <canvas id="projectBarChartMS" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h6 class="mb-0 fw-semibold"><i class="fas fa-layer-group me-2 text-info"></i>Phases Progress</h6>
                </div>
                <div class="card-body">
                    <canvas id="projectBarChartPh" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Budget and Payments Chart -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-chart-bar me-2 text-primary"></i>Budget vs Payments Analysis</h5>
                </div>
                <div class="card-body">
                    <canvas id="projectBarChart" height="100px"></canvas>
                </div>
                <div class="card-footer bg-light border-top">
                    <div class="row text-center g-3">
                        <div class="col-md-3 col-sm-6">
                            <div id="totalBudget" class="fw-bold text-primary small"></div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div id="totalPayments" class="fw-bold text-success small"></div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div id="outstandingPayments" class="fw-bold text-warning small"></div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div id="overPayments" class="fw-bold text-danger small"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Map -->
    <div class="row g-3 mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-semibold"><i class="fas fa-map-marked-alt me-2 text-primary"></i>Projects Geographic Distribution</h5>
                </div>
                <div class="card-body p-0">
                    <div id="map" class="rounded-bottom"></div>
                </div>
            </div>
        </div>
    </div>



    <!-- Barchart Budget and Payments -->
    <script>
        $(document).ready(function() {
            // Prepare project data from PHP
            const projectData = [
                <?php foreach ($projects as $index => $pro): ?>
                {
                    name: <?= json_encode($pro['name']) ?>,
                    budget: <?= checkZero($pro['budget']) ?>,
                    payments: <?= checkZero($pro['payment_total']) ?>
                }<?= $index < count($projects) - 1 ? ',' : '' ?>
                <?php endforeach; ?>
            ];

            // Limit to top 10 projects by budget for better visualization
            const topProjects = projectData
                .sort((a, b) => b.budget - a.budget)
                .slice(0, 10);

            const labels = topProjects.map(p => p.name.length > 20 ? p.name.substring(0, 20) + '...' : p.name);
            const budgetData = topProjects.map(p => p.budget);
            const paymentsData = topProjects.map(p => p.payments);

            // Create Combined Chart
            var ctx = document.getElementById("projectBarChart").getContext("2d");
            var combinedChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                            label: "Budget",
                            data: budgetData,
                            type: 'line',
                            borderColor: "rgba(0, 123, 255, 1)", // Blue
                            backgroundColor: "rgba(0, 123, 255, 0.1)",
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4,
                            pointRadius: 4,
                            pointBackgroundColor: "rgba(0, 123, 255, 1)"
                        },
                        {
                            label: "Payments",
                            data: paymentsData,
                            backgroundColor: "rgba(40, 167, 69, 0.8)", // Green
                            borderWidth: 0
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return <?= json_encode(COUNTRY_CURRENCY) ?> + value.toLocaleString();
                                }
                            }
                        },
                        x: {
                            ticks: {
                                maxRotation: 45,
                                minRotation: 45
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                padding: 15,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.dataset.label || '';
                                    const value = context.parsed.y || 0;
                                    return label + ': ' + <?= json_encode(COUNTRY_CURRENCY) ?> + value.toLocaleString(undefined, {maximumFractionDigits: 2});
                                }
                            }
                        }
                    }
                }
            });

            // Update footer totals
            const totalBudget = <?= checkZero($pro_total_budget) ?>;
            const totalPayments = <?= checkZero($pro_total_paid) ?>;
            const outstandingPayments = <?= checkZero($pro_total_outstanding) ?>;
            const overPayments = <?= checkZero($pro_total_overpaid) ?>;

            $("#totalBudget").text("Total Budget: " + <?= json_encode(COUNTRY_CURRENCY) ?> + totalBudget.toLocaleString(undefined, {maximumFractionDigits: 2}));
            $("#totalPayments").text("Total Payments: " + <?= json_encode(COUNTRY_CURRENCY) ?> + totalPayments.toLocaleString(undefined, {maximumFractionDigits: 2}));
            $("#outstandingPayments").text("Outstanding: " + <?= json_encode(COUNTRY_CURRENCY) ?> + outstandingPayments.toLocaleString(undefined, {maximumFractionDigits: 2}));
            $("#overPayments").text("Overpayment: " + <?= json_encode(COUNTRY_CURRENCY) ?> + overPayments.toLocaleString(undefined, {maximumFractionDigits: 2}));
        });
    </script>

    <!-- pieChart Status -->
    <script>
        $(document).ready(function() {
            // Standardized status colors
            const statusColors = {
                'active': 'rgba(40, 167, 69, 0.8)',      // Green
                'completed': 'rgba(0, 123, 255, 0.8)',   // Blue
                'hold': 'rgba(255, 193, 7, 0.8)',        // Yellow
                'canceled': 'rgba(108, 117, 125, 0.8)'   // Gray
            };

            // Project status data from PHP
            const statusData = {
                'Active': <?= checkZero($status_counts['active']) ?>,
                'Completed': <?= checkZero($status_counts['completed']) ?>,
                'On Hold': <?= checkZero($status_counts['hold']) ?>,
                'Canceled': <?= checkZero($status_counts['canceled']) ?>
            };

            // Filter out zero values
            const labels = [];
            const data = [];
            const colors = [];

            Object.keys(statusData).forEach(function(label) {
                if (statusData[label] > 0) {
                    labels.push(label);
                    data.push(statusData[label]);
                    const key = label.toLowerCase().replace('on ', '');
                    colors.push(statusColors[key] || 'rgba(108, 117, 125, 0.8)');
                }
            });

            // Create Pie Chart
            var pieCtx = document.getElementById("projectPieChart").getContext("2d");
            var pieChart = new Chart(pieCtx, {
                type: "pie",
                data: {
                    labels: labels,
                    datasets: [{
                        data: data,
                        backgroundColor: colors,
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.label || '';
                                    const value = context.parsed || 0;
                                    const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return label + ': ' + value + ' (' + percentage + '%)';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <!-- barchart Milestones -->
    <script>
        $(document).ready(function() {
            // Milestone Bar Chart
            var msCtx = document.getElementById("projectBarChartMS").getContext("2d");
            var msChart = new Chart(msCtx, {
                type: "bar",
                data: {
                    labels: ['Milestones'],
                    datasets: [{
                            label: "Completed",
                            data: [<?= checkZero($ms_completed) ?>],
                            backgroundColor: "rgba(0, 123, 255, 0.8)", // Blue
                            borderWidth: 0
                        },
                        {
                            label: "On Hold",
                            data: [<?= checkZero($ms_hold) ?>],
                            backgroundColor: "rgba(255, 193, 7, 0.8)", // Yellow
                            borderWidth: 0
                        },
                        {
                            label: "Pending",
                            data: [<?= checkZero($ms_pending) ?>],
                            backgroundColor: "rgba(108, 117, 125, 0.8)", // Gray
                            borderWidth: 0
                        },
                        {
                            label: "Canceled",
                            data: [<?= checkZero($ms_canceled) ?>],
                            backgroundColor: "rgba(220, 53, 69, 0.8)", // Red
                            borderWidth: 0
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        x: {
                            stacked: true,
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: {
                                    size: 12
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const label = context.dataset.label || '';
                                    const value = context.parsed.y || 0;
                                    return label + ': ' + value;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <!-- barchart Phases -->
    <script>
        $(document).ready(function() {
            // Phase Bar Chart - Completion percentage based on milestones
            var phCtx = document.getElementById("projectBarChartPh").getContext("2d");
            var phChart = new Chart(phCtx, {
                type: "bar",
                data: {
                    labels: ['Phase Completion'],
                    datasets: [{
                        label: "Completion %",
                        data: [<?= checkZero($ph_completion_percentage) ?>],
                        backgroundColor: "rgba(40, 167, 69, 0.8)", // Green
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            max: 100,
                            ticks: {
                                callback: function(value) {
                                    return value + '%';
                                }
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.parsed.y || 0;
                                    return 'Completion: ' + value.toFixed(1) + '%' +
                                           ' (<?= $ph_completed_milestones ?>/<?= $ph_total_milestones ?> milestones in <?= $ph_total ?> phases)';
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

    <!-- maps coordinates -->
    <script>
        $(document).ready(function() {
            // Prepare projects data from PHP
            const projectsData = [
                <?php foreach ($projects as $pro): ?>
                {
                    procode: <?= json_encode($pro['procode']) ?>,
                    name: <?= json_encode($pro['name']) ?>,
                    status: <?= json_encode(strtolower($pro['status'] ?? '')) ?>,
                    budget: '<?= COUNTRY_CURRENCY . number_format($pro['budget'], 2) ?>',
                    lat: <?= !empty($pro['lat']) ? $pro['lat'] : 0 ?>,
                    lon: <?= !empty($pro['lon']) ? $pro['lon'] : 0 ?>
                },
                <?php endforeach; ?>
            ];

            console.log('Projects data loaded:', projectsData.length, 'projects');

            // Initialize OpenLayers map with a slight delay to ensure container is ready
            setTimeout(function() {
                try {
                    // Check if map container exists
                    if (!document.getElementById('map')) {
                        console.error('Map container not found');
                        return;
                    }

                    console.log('Initializing map...');

                    // Function to get color based on project status
                    function getStatusColor(status) {
                        switch(status ? status.toLowerCase() : '') {
                            case 'active':
                                return 'rgba(40, 167, 69, 0.8)'; // Green
                            case 'completed':
                                return 'rgba(0, 123, 255, 0.8)'; // Blue
                            case 'hold':
                                return 'rgba(255, 193, 7, 0.8)'; // Yellow/Amber
                            case 'canceled':
                                return 'rgba(108, 117, 125, 0.8)'; // Gray
                            default:
                                return 'rgba(108, 117, 125, 0.8)'; // Gray (default)
                        }
                    }

                    // Create base map layer
                    const osmLayer = new ol.layer.Tile({
                        source: new ol.source.OSM()
                    });

                    // Create KML layers array
                    const kmlLayers = [];
                    const kmlLayersByProcode = {};

                    <?php if (!empty($kmlfiles)): ?>
                        console.log('Loading <?= count($kmlfiles) ?> KML files...');
                        // Group KML files by procode
                        const kmlFilesByProcode = {};
                        <?php foreach ($kmlfiles as $kml): ?>
                            <?php if (!empty($kml['filepath'])): ?>
                                if (!kmlFilesByProcode[<?= json_encode($kml['procode']) ?>]) {
                                    kmlFilesByProcode[<?= json_encode($kml['procode']) ?>] = [];
                                }
                                kmlFilesByProcode[<?= json_encode($kml['procode']) ?>].push({
                                    filepath: '<?= base_url() . $kml['filepath'] ?>',
                                    procode: <?= json_encode($kml['procode']) ?>
                                });
                                console.log('KML file for <?= $kml['procode'] ?>: <?= base_url() . $kml['filepath'] ?>');
                            <?php endif; ?>
                        <?php endforeach; ?>

                        // Create KML layers for each project
                        Object.keys(kmlFilesByProcode).forEach(function(procode) {
                            kmlFilesByProcode[procode].forEach(function(kmlFile, index) {
                                const kmlSource = new ol.source.Vector({
                                    url: kmlFile.filepath,
                                    format: new ol.format.KML({
                                        extractStyles: false,
                                        extractAttributes: true,
                                    })
                                });

                                const kmlLayer = new ol.layer.Vector({
                                    source: kmlSource,
                                    style: null, // Will be set dynamically based on project status
                                    visible: true
                                });

                                kmlLayers.push(kmlLayer);
                                if (!kmlLayersByProcode[procode]) {
                                    kmlLayersByProcode[procode] = [];
                                }
                                kmlLayersByProcode[procode].push(kmlLayer);
                            });
                        });
                    <?php else: ?>
                        console.log('No KML files found');
                    <?php endif; ?>

                    // Create marker layer
                    const markerSource = new ol.source.Vector();
                    const markerLayer = new ol.layer.Vector({
                        source: markerSource
                    });

                    // Create map
                    const map = new ol.Map({
                        target: 'map',
                        layers: [osmLayer, ...kmlLayers, markerLayer],
                        view: new ol.View({
                            center: ol.proj.fromLonLat([<?= $org['center_gps_longitude'] ?>, <?= $org['center_gps_latitude'] ?>]),
                            zoom: <?= $org['center_gps_zoom'] ?>
                        })
                    });

                    console.log('Map created with ' + kmlLayers.length + ' KML layers');

                    // Function to update the map with project data
                    function updateMap() {
                        console.log('Updating map with', projectsData.length, 'projects...');

                        // Clear previous markers
                        markerSource.clear();

                        // Track which procodes are visible
                        const visibleProcodes = new Set();
                        let markerCount = 0;

                        // Add markers for each project's GPS coordinates
                        projectsData.forEach(function(project, index) {
                            // Debug: log first project to see structure
                            if (index === 0) {
                                console.log('First project data:', project);
                            }

                            const procode = project.procode;
                            const lat = project.lat;
                            const lon = project.lon;
                            const status = project.status;
                            const projectName = project.name;
                            const budget = project.budget;

                            visibleProcodes.add(procode);

                            // Check if coordinates are available and non-zero
                            if (lat && lon && lat !== 0 && lon !== 0) {
                                // Get color based on status
                                const statusColor = getStatusColor(status);

                                // Create marker feature
                                const marker = new ol.Feature({
                                    geometry: new ol.geom.Point(ol.proj.fromLonLat([lon, lat])),
                                    name: projectName,
                                    status: status,
                                    budget: budget,
                                    procode: procode
                                });

                                // Set marker style
                                marker.setStyle(new ol.style.Style({
                                    image: new ol.style.Circle({
                                        radius: 8,
                                        fill: new ol.style.Fill({
                                            color: statusColor
                                        }),
                                        stroke: new ol.style.Stroke({
                                            color: '#fff',
                                            width: 2
                                        })
                                    })
                                }));

                                markerSource.addFeature(marker);
                                markerCount++;

                                // Update KML layer styles for this project
                                if (kmlLayersByProcode[procode]) {
                                    kmlLayersByProcode[procode].forEach(function(kmlLayer) {
                                        kmlLayer.setStyle(function(feature) {
                                            const geometryType = feature.getGeometry().getType();

                                            if (geometryType === 'LineString' || geometryType === 'MultiLineString') {
                                                return new ol.style.Style({
                                                    stroke: new ol.style.Stroke({
                                                        color: statusColor,
                                                        width: 3
                                                    })
                                                });
                                            } else if (geometryType === 'Polygon' || geometryType === 'MultiPolygon') {
                                                return new ol.style.Style({
                                                    stroke: new ol.style.Stroke({
                                                        color: statusColor,
                                                        width: 2
                                                    }),
                                                    fill: new ol.style.Fill({
                                                        color: statusColor.replace('0.8', '0.2')
                                                    })
                                                });
                                            }
                                        });
                                    });
                                }
                            }
                        });

                        console.log('Added ' + markerCount + ' markers');

                        // Show all KML layers for visible projects
                        Object.keys(kmlLayersByProcode).forEach(function(procode) {
                            const visible = visibleProcodes.has(procode);
                            kmlLayersByProcode[procode].forEach(function(layer) {
                                layer.setVisible(visible);
                            });
                        });

                        // Auto-zoom to fit all features
                        setTimeout(function() {
                            const extent = ol.extent.createEmpty();
                            let hasFeatures = false;

                            // Include marker extent
                            if (markerSource.getFeatures().length > 0) {
                                ol.extent.extend(extent, markerSource.getExtent());
                                hasFeatures = true;
                            }

                            // Include KML layer extents
                            kmlLayers.forEach(function(layer) {
                                if (layer.getVisible()) {
                                    const source = layer.getSource();
                                    if (source && source.getFeatures().length > 0) {
                                        ol.extent.extend(extent, source.getExtent());
                                        hasFeatures = true;
                                    }
                                }
                            });

                            // Zoom to extent if we have features
                            if (hasFeatures && !ol.extent.isEmpty(extent)) {
                                map.getView().fit(extent, {
                                    padding: [50, 50, 50, 50],
                                    maxZoom: 16,
                                    duration: 500
                                });
                                console.log('Auto-zoomed to fit all features');
                            } else {
                                console.log('No features to zoom to');
                            }
                        }, 1000); // Wait for KML files to load
                    }

                    // Add popup overlay
                    const popup = document.createElement('div');
                    popup.className = 'ol-popup';
                    popup.style.cssText = 'position: absolute; background-color: white; padding: 10px; border-radius: 5px; box-shadow: 0 2px 8px rgba(0,0,0,0.3); display: none;';
                    document.body.appendChild(popup);

                    const overlay = new ol.Overlay({
                        element: popup,
                        positioning: 'bottom-center',
                        stopEvent: false,
                        offset: [0, -10]
                    });
                    map.addOverlay(overlay);

                    // Handle click events for popups
                    map.on('click', function(evt) {
                        const feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                            return feature;
                        });

                        if (feature && feature.get('name')) {
                            const coordinates = feature.getGeometry().getCoordinates();
                            popup.innerHTML = '<strong>Project:</strong> ' + feature.get('name') +
                                            '<br><strong>Status:</strong> ' + feature.get('status') +
                                            '<br><strong>Budget:</strong> ' + feature.get('budget');
                            popup.style.display = 'block';
                            overlay.setPosition(coordinates);
                        } else {
                            popup.style.display = 'none';
                        }
                    });

                    // Change cursor on hover
                    map.on('pointermove', function(evt) {
                        const hit = map.hasFeatureAtPixel(evt.pixel);
                        const target = map.getTarget();
                        const element = typeof target === 'string' ? document.getElementById(target) : target;
                        if (element && element.style) {
                            element.style.cursor = hit ? 'pointer' : '';
                        }
                    });

                    // Call the updateMap function initially
                    updateMap();

                    console.log('Map initialized successfully with ' + kmlLayers.length + ' KML layers');
                } catch (error) {
                    console.error('Error initializing map:', error);
                    document.getElementById('map').innerHTML = '<div class="alert alert-danger m-3">Error loading map. Please check console for details.</div>';
                }
            }, 300);
        });
    </script>

</div>
<!-- /.container-fluid -->

<!-- DataTables Scripts CDN -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap4.min.js"></script>

<?= $this->endSection(); ?>