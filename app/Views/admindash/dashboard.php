<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<!-- Leaflet for Map -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js" crossorigin=""></script>
<script src="https://unpkg.com/leaflet-omnivore/leaflet-omnivore.min.js"></script>

<div class="container-fluid px-4 py-3">

    <!-- Welcome Header -->
    <div class="card bg-primary text-white mb-4 shadow">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2"><i class="fas fa-chart-line me-2"></i>Project Management Dashboard</h2>
                    <p class="mb-0">Welcome back, <strong><?= session('name') ?></strong> | <?= session('orgname') ?></p>
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

    <!-- Quick Report Links -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <a href="<?= base_url(); ?>report_projects_status/all" class="text-decoration-none">
                <div class="card border-primary shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-list-alt fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="card-title text-dark fw-bold">Projects Report</h5>
                        <p class="text-muted mb-0"><small>View all project statuses and details</small></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="<?= base_url(); ?>report_contractors_dash" class="text-decoration-none">
                <div class="card border-warning shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-people-carry fa-2x text-warning"></i>
                            </div>
                        </div>
                        <h5 class="card-title text-dark fw-bold">Contractors Report</h5>
                        <p class="text-muted mb-0"><small>Manage and view contractor information</small></p>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="<?= base_url(); ?>report_pro_officers_dash" class="text-decoration-none">
                <div class="card border-info shadow-sm h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 60px; height: 60px;">
                                <i class="fas fa-user-check fa-2x text-info"></i>
                            </div>
                        </div>
                        <h5 class="card-title text-dark fw-bold">Project Officers Report</h5>
                        <p class="text-muted mb-0"><small>View project officer assignments</small></p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="mb-3"><i class="fas fa-bolt me-2 text-primary"></i>Quick Actions</h5>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <a href="<?= base_url(); ?>projects" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                <i class="fas fa-list fa-2x mb-2"></i>
                <span class="fw-semibold">Projects List</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <a href="<?= base_url(); ?>new_projects" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                <i class="fas fa-plus fa-2x mb-2"></i>
                <span class="fw-semibold">New Project</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <a href="<?= base_url(); ?>contractors" class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                <i class="fas fa-people-carry fa-2x mb-2"></i>
                <span class="fw-semibold">Contractors</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <a href="<?= base_url(); ?>contractors_new" class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                <i class="fas fa-user-plus fa-2x mb-2"></i>
                <span class="fw-semibold">New Contractor</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <a href="<?= base_url(); ?>project_officers" class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                <i class="fas fa-user-check fa-2x mb-2"></i>
                <span class="fw-semibold">Project Officers</span>
            </a>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
            <a href="<?= base_url(); ?>my_account" class="btn btn-outline-secondary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-3">
                <i class="fas fa-user-cog fa-2x mb-2"></i>
                <span class="fw-semibold">My Account</span>
            </a>
        </div>
    </div>


    <!-- Financial Overview -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="mb-3"><i class="fas fa-money-bill-wave me-2 text-success"></i>Financial Overview</h5>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary bg-opacity-10 rounded p-3 me-3">
                            <i class="fas fa-wallet fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small text-uppercase">Total Budget</h6>
                            <h3 class="mb-0 fw-bold">K <?= number_format($pro_total_budget, 0) ?></h3>
                        </div>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-success bg-opacity-10 rounded p-3 me-3">
                            <i class="fas fa-check-circle fa-2x text-success"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small text-uppercase">Total Paid</h6>
                            <h3 class="mb-0 fw-bold">K <?= number_format($pro_total_paid, 0) ?></h3>
                        </div>
                    </div>
                    <?php $paidPercentage = $pro_total_budget > 0 ? ($pro_total_paid / $pro_total_budget) * 100 : 0; ?>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: <?= min($paidPercentage, 100) ?>%"></div>
                    </div>
                    <small class="text-success mt-2 d-block">
                        <i class="fas fa-arrow-up"></i> <?= number_format($paidPercentage, 1) ?>% of budget
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-warning bg-opacity-10 rounded p-3 me-3">
                            <i class="fas fa-hourglass-half fa-2x text-warning"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small text-uppercase">Outstanding</h6>
                            <h3 class="mb-0 fw-bold">K <?= number_format($pro_total_outstanding, 0) ?></h3>
                        </div>
                    </div>
                    <?php $outstandingPercentage = $pro_total_budget > 0 ? ($pro_total_outstanding / $pro_total_budget) * 100 : 0; ?>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: <?= min($outstandingPercentage, 100) ?>%"></div>
                    </div>
                    <small class="text-warning mt-2 d-block">
                        <i class="fas fa-minus-circle"></i> <?= number_format($outstandingPercentage, 1) ?>% remaining
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-danger bg-opacity-10 rounded p-3 me-3">
                            <i class="fas fa-exclamation-triangle fa-2x text-danger"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-0 small text-uppercase">Overpaid</h6>
                            <h3 class="mb-0 fw-bold">K <?= number_format($pro_total_overpaid, 0) ?></h3>
                        </div>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: <?= $pro_total_overpaid > 0 ? '100' : '0' ?>%"></div>
                    </div>
                    <?php if ($pro_total_overpaid > 0): ?>
                    <small class="text-danger mt-2 d-block">
                        <i class="fas fa-exclamation-circle"></i> Requires attention
                    </small>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Statistics -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="mb-3"><i class="fas fa-project-diagram me-2 text-info"></i>Project Statistics</h5>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-folder-open fa-2x text-info"></i>
                    </div>
                    <h2 class="fw-bold mb-1"><?= count($projects) ?></h2>
                    <p class="text-muted mb-0 text-uppercase small">Total Projects</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-play-circle fa-2x text-primary"></i>
                    </div>
                    <h2 class="fw-bold mb-1"><?= count($pro_active) ?></h2>
                    <p class="text-muted mb-2 text-uppercase small">Active Projects</p>
                    <small class="text-primary">
                        <i class="fas fa-chart-line"></i> <?= count($projects) > 0 ? number_format((count($pro_active) / count($projects)) * 100, 1) : 0 ?>% of total
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-check-double fa-2x text-success"></i>
                    </div>
                    <h2 class="fw-bold mb-1"><?= count($pro_completed) ?></h2>
                    <p class="text-muted mb-2 text-uppercase small">Completed</p>
                    <small class="text-success">
                        <i class="fas fa-trophy"></i> <?= count($projects) > 0 ? number_format((count($pro_completed) / count($projects)) * 100, 1) : 0 ?>% completion rate
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                        <i class="fas fa-pause-circle fa-2x text-warning"></i>
                    </div>
                    <h2 class="fw-bold mb-1"><?= count($pro_hold) + count($pro_canceled) ?></h2>
                    <p class="text-muted mb-2 text-uppercase small">On Hold / Canceled</p>
                    <small class="text-muted">Hold: <?= count($pro_hold) ?> | Canceled: <?= count($pro_canceled) ?></small>
                </div>
            </div>
        </div>
    </div>

    <!-- Milestones & Charts -->
    <div class="row mb-4">
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Milestone Status</h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-warning bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-hourglass-half text-warning"></i>
                            </div>
                            <span>Pending</span>
                        </div>
                        <span class="badge bg-warning rounded-pill"><?= $pro_ms_pending ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-success bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-check-circle text-success"></i>
                            </div>
                            <span>Completed</span>
                        </div>
                        <span class="badge bg-success rounded-pill"><?= $pro_ms_completed ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-info bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-pause-circle text-info"></i>
                            </div>
                            <span>On Hold</span>
                        </div>
                        <span class="badge bg-info rounded-pill"><?= $pro_ms_hold ?></span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="bg-danger bg-opacity-10 rounded p-2 me-3">
                                <i class="fas fa-times-circle text-danger"></i>
                            </div>
                            <span>Canceled</span>
                        </div>
                        <span class="badge bg-danger rounded-pill"><?= $pro_ms_canceled ?></span>
                    </li>
                </ul>
                <div class="card-footer bg-light text-center">
                    <strong class="text-muted">Total Milestones: <?= count($milestones) ?></strong>
                </div>
            </div>
        </div>
        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" id="statusPDF">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Project Status</h5>
                    <button onclick="statusPDF()" class="btn btn-sm btn-light">
                        <i class="fa fa-download"></i>
                    </button>
                </div>
                <div class="card-body">
                    <?php
                    // Data values
                    $data_status = [count($pro_active), count($pro_completed), count($pro_hold), count($pro_canceled)];
                    // Data labels
                    $labels_status = ['Active', 'Completed', 'Hold', 'Canceled'];
                    ?>
                    <canvas id="barChart_status" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-4 mb-4">
            <div class="card border-0 shadow-sm h-100" id="paymentsPDF">
                <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>Payment Trends</h5>
                    <button onclick="paymentsPDF()" class="btn btn-sm btn-light">
                        <i class="fa fa-download"></i>
                    </button>
                </div>
                <div class="card-body">
                    <?php
                    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    $payment_data = array_fill(0, 12, 0);
                    foreach ($paydates as $month => $count) {
                        $payment_data[(int)$month - 1] = $count;
                    }
                    ?>
                    <canvas id="lineChart_payments" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Project Status Chart
        const data_status = <?php echo json_encode($data_status); ?>;
        const labels_status = <?php echo json_encode($labels_status); ?>;

        const config_barChart_status = {
            type: 'doughnut',
            data: {
                labels: labels_status,
                datasets: [{
                    label: 'Projects',
                    data: data_status,
                    backgroundColor: [
                        'rgba(13, 110, 253, 0.8)',
                        'rgba(25, 135, 84, 0.8)',
                        'rgba(255, 193, 7, 0.8)',
                        'rgba(220, 53, 69, 0.8)',
                    ],
                    borderColor: [
                        'rgba(13, 110, 253, 1)',
                        'rgba(25, 135, 84, 1)',
                        'rgba(255, 193, 7, 1)',
                        'rgba(220, 53, 69, 1)',
                    ],
                    borderWidth: 2
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
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 14
                        },
                        bodyFont: {
                            size: 13
                        }
                    }
                }
            }
        };

        // Render status chart
        const barChart_status = new Chart(
            document.getElementById('barChart_status'),
            config_barChart_status
        );

        // Payment Trends Chart
        const payment_data = <?php echo json_encode($payment_data); ?>;
        const months = <?php echo json_encode($months); ?>;

        const config_lineChart_payments = {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Payments',
                    data: payment_data,
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(13, 110, 253, 1)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        };

        // Render payment chart
        const lineChart_payments = new Chart(
            document.getElementById('lineChart_payments'),
            config_lineChart_payments
        );

        // PDF Export Functions
        function statusPDF() {
            const element = document.querySelector('#statusPDF');
            const opt = {
                margin: 0.5,
                filename: 'project-status.pdf',
                image: { type: 'jpeg', quality: 1 },
                html2canvas: { scale: 2, useCORS: true },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(element).set(opt).save();
        }

        function paymentsPDF() {
            const element = document.querySelector('#paymentsPDF');
            const opt = {
                margin: 0.5,
                filename: 'payment-trends.pdf',
                image: { type: 'jpeg', quality: 1 },
                html2canvas: { scale: 2, useCORS: true },
                jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
            };
            html2pdf().from(element).set(opt).save();
        }
    </script>


    <!-- Projects Map -->
    <div class="row mb-4">
        <div class="col-12">
            <h5 class="mb-3"><i class="fas fa-map-marked-alt me-2 text-danger"></i>Projects Map</h5>
        </div>
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-globe me-2"></i>Project Locations</h5>
                </div>
                <div class="card-body p-0">
                    <style>
                        #dashboardMap {
                            height: 700px;
                        }
                        .project-marker {
                            background-color: #0d6efd;
                            border-radius: 50%;
                            cursor: pointer;
                        }
                        .project-marker:hover {
                            background-color: #0a58ca;
                            opacity: 0.8;
                        }
                    </style>

                    <!-- Map container -->
                    <div id="dashboardMap"></div>

                    <!-- Initialize Leaflet map -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Set default coordinates if org coordinates are not available
                            var defaultLat = <?= !empty($org['center_gps_latitude']) ? $org['center_gps_latitude'] : '-6.314993' ?>;
                            var defaultLng = <?= !empty($org['center_gps_longitude']) ? $org['center_gps_longitude'] : '143.95555' ?>;
                            var defaultZoom = <?= !empty($org['center_gps_zoom']) ? $org['center_gps_zoom'] : '6' ?>;
                            
                            // Initialize Leaflet map
                            const dashMap = L.map('dashboardMap').setView([defaultLat, defaultLng], defaultZoom);

                            // Add OpenStreetMap tile layer
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                                maxZoom: 19
                            }).addTo(dashMap);

                            // Create a feature group to hold all layers for bounds calculation
                            const allLayers = L.featureGroup().addTo(dashMap);
                            let kmlLayersToLoad = 0;
                            let kmlLayersLoaded = 0;

                            // Function to fit map bounds after all layers are loaded
                            function fitMapBounds() {
                                if (allLayers.getLayers().length > 0) {
                                    dashMap.fitBounds(allLayers.getBounds(), {
                                        padding: [50, 50],
                                        maxZoom: 15
                                    });
                                }
                            }

                            // Function to add KML layers with styling and popup
                            function addKMLLayer(kmlURL, project) {
                                if (!kmlURL) return;
                                
                                kmlLayersToLoad++;
                                const kmlLayer = omnivore.kml(kmlURL, null, L.geoJSON(null, {
                                    style: {
                                        color: '#0d6efd',
                                        weight: 3,
                                        opacity: 0.7,
                                        fillOpacity: 0.4
                                    },
                                    onEachFeature: function(feature, layer) {
                                        layer.bindPopup(`
                                            <div style="min-width: 200px;">
                                                <h6 class="mb-2"><strong>${project.name}</strong></h6>
                                                <p class="mb-1"><strong>Code:</strong> ${project.procode}</p>
                                                <p class="mb-1"><small class="text-muted">KML Path/Boundary</small></p>
                                                <a href="<?= base_url() ?>open_projects/${project.procode}" class="btn btn-sm btn-primary mt-2">
                                                    <i class="fas fa-eye"></i> View Details
                                                </a>
                                            </div>
                                        `);
                                        
                                        layer.on('mouseover', function() {
                                            this.setStyle({
                                                weight: 5,
                                                opacity: 1
                                            });
                                        });
                                        
                                        layer.on('mouseout', function() {
                                            this.setStyle({
                                                weight: 3,
                                                opacity: 0.7
                                            });
                                        });
                                    }
                                }))
                                .on('ready', function() {
                                    allLayers.addLayer(kmlLayer);
                                    kmlLayersLoaded++;
                                    if (kmlLayersLoaded === kmlLayersToLoad) {
                                        fitMapBounds();
                                    }
                                })
                                .on('error', function() {
                                    kmlLayersLoaded++;
                                    if (kmlLayersLoaded === kmlLayersToLoad) {
                                        fitMapBounds();
                                    }
                                })
                                .addTo(dashMap);
                            }

                            // Function to add coordinates markers with dot style and popup
                            function addMarkers(projects) {
                                projects.forEach(project => {
                                    if (project.lat && project.lon) {
                                        const marker = L.circleMarker([project.lat, project.lon], {
                                            radius: 8,
                                            fillColor: '#0d6efd',
                                            color: '#0d6efd',
                                            weight: 1,
                                            opacity: 1,
                                            fillOpacity: 1,
                                            className: 'project-marker'
                                        }).addTo(dashMap);

                                        allLayers.addLayer(marker);

                                        marker.bindPopup(`
                                            <div style="min-width: 200px;">
                                                <h6 class="mb-2"><strong>${project.name}</strong></h6>
                                                <p class="mb-1"><strong>Code:</strong> ${project.procode}</p>
                                                <a href="<?= base_url() ?>open_projects/${project.procode}" class="btn btn-sm btn-primary mt-2">
                                                    <i class="fas fa-eye"></i> View Details
                                                </a>
                                            </div>
                                        `);
                                    }
                                });
                            }

                            // Projects data
                            const projects = [
                                <?php foreach ($projects as $p) : ?>
                                {
                                    procode: '<?= $p['procode'] ?>',
                                    name: '<?= addslashes($p['name']) ?>',
                                    lat: <?= !empty($p['lat']) ? $p['lat'] : 'null' ?>,
                                    lon: <?= !empty($p['lon']) ? $p['lon'] : 'null' ?>,
                                    kmlfile: '<?= $p['kmlfile'] ?>'
                                },
                                <?php endforeach ?>
                            ];

                            // Add markers first
                            addMarkers(projects);

                            // Add KML files with project information
                            projects.forEach(project => {
                                if (project.kmlfile) {
                                    addKMLLayer('<?= base_url() ?>' + project.kmlfile, project);
                                }
                            });

                            // If no KML files, fit bounds immediately
                            if (kmlLayersToLoad === 0) {
                                fitMapBounds();
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>
