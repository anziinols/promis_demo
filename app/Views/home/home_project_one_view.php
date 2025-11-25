<?= $this->extend("templates/nolstemp"); ?>
<?= $this->section('content'); ?>


<!-- Project Header with Enhanced Breadcrumb -->
<section class="container-fluid d-print-none py-3 mb-4" style="background: linear-gradient(to right, rgba(13, 110, 253, 0.1), rgba(13, 110, 253, 0.05)); border-bottom: 1px solid rgba(13, 110, 253, 0.1);">
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
                <h4 class="mb-0 d-flex align-items-center">
                    <span class="bg-primary text-white p-2 rounded-circle me-3 d-inline-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                        <i class="fa-solid fa-project-diagram"></i>
                    </span>
                    <span>
                        <span class="fw-bold text-primary"><?= $pro['procode'] ?>:</span>
                        <span class="text-dark"><?= $pro['name'] ?></span>
                    </span>
                </h4>

                <nav aria-label="breadcrumb" class="bg-white shadow-sm rounded px-3 py-2">
                    <ol class="breadcrumb mb-0 py-1">
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none" href="<?= base_url() ?>">
                                <i class="fa-solid fa-home me-1"></i> Home
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a class="text-decoration-none" href="<?= base_url() ?>">
                                <i class="fa-solid fa-list me-1"></i> Projects
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <span class="fw-medium"><?= $pro['procode'] ?></span>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Main Content Section -->
<section class="container content">
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h2 class="fw-bold" style="background: linear-gradient(90deg, #0d6efd, #0a58ca); -webkit-background-clip: text; background-clip: text; -webkit-text-fill-color: transparent;">
                Project Report
            </h2>
            <p class="lead text-muted">Comprehensive overview of project status and metrics</p>
            <div class="d-flex justify-content-center gap-2 mb-2">
                <button class="btn btn-sm btn-outline-primary" onclick="window.print()">
                    <i class="fa-solid fa-print me-1"></i> Print Report
                </button>
                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="tooltip" title="Export as PDF" disabled>
                    <i class="fa-solid fa-file-pdf me-1"></i> Export PDF
                </button>
            </div>
        </div>
    </div>
    <!-- Project Summary Section with Enhanced Styling -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="border-radius: 0.75rem; overflow: hidden; transition: all 0.3s ease;">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="mb-0"><i class="fa-solid fa-chart-pie me-2"></i>Project Summary</h5>
                    <span class="badge bg-white text-primary fs-6 px-3 py-2" style="border-radius: 20px;"><?= $pro['name'] ?> / <?= $pro['procode'] ?></span>
                </div>
                <div class="card-body p-3">
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <div class="row g-4">
                        <div class="col-12 col-md-4 text-center">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 0.5rem; overflow: hidden; transition: transform 0.3s ease;">
                                <div class="card-header text-white" style="background: linear-gradient(135deg, #0dcaf0, #0aa2c0);">
                                    <h6 class="mb-0"><i class="fa-solid fa-money-bill-wave me-2"></i>Payment Status</h6>
                                </div>
                                <div class="card-body" style="height: 280px; display: flex; flex-direction: column; padding-bottom: 0;">
                                    <div style="flex: 1; position: relative; max-height: 100%; overflow: hidden;">
                                        <canvas id="fundChart"></canvas>
                                    </div>
                                    <?php $outstanding = checkZero($pro['budget']) - checkZero($pro['payment_total']); ?>
                                    <script>
                                        const ctx = document.getElementById('fundChart');

                                        new Chart(ctx, {
                                            type: 'doughnut',
                                            data: {
                                                labels: ['Outstanding', 'Paid'],
                                                datasets: [{
                                                    label: 'Payments',
                                                    data: [<?= checkZero($outstanding) ?>, <?= $pro['payment_total'] ?>],
                                                    backgroundColor: [
                                                        'rgba(220, 53, 69, 0.7)',  // Bootstrap danger color
                                                        'rgba(25, 135, 84, 0.7)'   // Bootstrap success color
                                                    ],
                                                    borderColor: [
                                                        'rgba(220, 53, 69, 1)',
                                                        'rgba(25, 135, 84, 1)'
                                                    ],
                                                    borderWidth: 2,
                                                    hoverOffset: 4
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: true,
                                                cutout: '60%',
                                                layout: {
                                                    padding: {
                                                        top: 5,
                                                        bottom: 5
                                                    }
                                                },
                                                plugins: {
                                                    legend: {
                                                        position: 'bottom',
                                                        labels: {
                                                            padding: 10,
                                                            font: {
                                                                size: 11
                                                            },
                                                            boxWidth: 10,
                                                            usePointStyle: true,
                                                            pointStyle: 'circle'
                                                        },
                                                        display: true,
                                                        align: 'center',
                                                        maxHeight: 40
                                                    },
                                                    tooltip: {
                                                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                                                        padding: 12,
                                                        titleFont: {
                                                            size: 14
                                                        },
                                                        bodyFont: {
                                                            size: 13
                                                        },
                                                        displayColors: false,
                                                        callbacks: {
                                                            label: function(context) {
                                                                let value = context.raw;
                                                                let total = context.dataset.data.reduce((a, b) => a + b, 0);
                                                                let percentage = Math.round((value / total) * 100);
                                                                return `${context.label}: ${COUNTRY_CURRENCY} ${value.toLocaleString()} (${percentage}%)`;
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    </script>
                                </div>
                                <div class="card-footer bg-light">
                                    <small class="text-muted">Payment distribution overview</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-md-8 text-center">
                            <div class="card h-100 border-0 shadow-sm" style="border-radius: 0.5rem; overflow: hidden; transition: transform 0.3s ease;">
                                <div class="card-header text-white" style="background: linear-gradient(135deg, #198754, #157347);">
                                    <h6 class="mb-0"><i class="fa-solid fa-tasks me-2"></i>Phases & Milestones Progress</h6>
                                </div>
                                <div class="card-body" style="height: 280px; display: flex; flex-direction: column; padding-bottom: 0;">
                                    <div style="flex: 1; position: relative; max-height: 100%; overflow: hidden;">
                                        <canvas id="milesChart"></canvas>
                                    </div>

                                <?php

                                $ph_name = $ph_pending = $ph_completed = $ph_hold = $ph_canceled = "";
                                foreach ($phases as $ph) {
                                    $ph_count = $ph_ms_completed = $ph_ms_pending = $ph_ms_hold = $ph_ms_canceled = 0;
                                    foreach ($milestones as $ms) {
                                        if ($ph['id'] == $ms['phase_id']) {
                                            // Use status field if available, otherwise fall back to checked field
                                            $milestoneStatus = $ms['status'] ?? $ms['checked'];

                                            if ($milestoneStatus == 'completed') {
                                                $ph_ms_completed += 1;
                                            }
                                            if ($milestoneStatus == 'pending') {
                                                $ph_ms_pending += 1;
                                            }
                                            if ($milestoneStatus == 'hold') {
                                                $ph_ms_hold += 1;
                                            }
                                            if ($milestoneStatus == 'canceled') {
                                                $ph_ms_canceled += 1;
                                            }
                                        }
                                    }
                                    $ph_completed .= $ph_ms_completed . ",";
                                    $ph_pending .= $ph_ms_pending . ",";
                                    $ph_hold .= $ph_ms_hold . ",";
                                    $ph_canceled .= $ph_ms_canceled . ",";

                                    $ph_name .= "'" . $ph['phases'] . "',";

                                    /* $ph_canceled += $ph_ms_canceled;
                                    $ph_hold += $ph_ms_hold;
                                    $ph_pending += $ph_ms_pending; */
                                }
                                // echo $ph_name;
                                //  echo $ph_completed;
                                ?>

                                <script>
                                    const miles = document.getElementById('milesChart').getContext('2d');
                                    const milesChart = new Chart(miles, {
                                        type: 'bar',
                                        data: {
                                            labels: [<?= $ph_name ?>],
                                            datasets: [{
                                                label: 'Completed',
                                                data: [<?= $ph_completed ?>],
                                                backgroundColor: 'rgba(25, 135, 84, 0.7)',  // Bootstrap success color
                                                borderColor: 'rgba(25, 135, 84, 1)',
                                                borderWidth: 1,
                                                borderRadius: 4
                                            }, {
                                                label: 'On Hold',
                                                data: [<?= $ph_hold ?>],
                                                backgroundColor: 'rgba(255, 193, 7, 0.7)',  // Bootstrap warning color
                                                borderColor: 'rgba(255, 193, 7, 1)',
                                                borderWidth: 1,
                                                borderRadius: 4
                                            }, {
                                                label: 'Pending',
                                                data: [<?= $ph_pending ?>],
                                                backgroundColor: 'rgba(13, 110, 253, 0.7)',  // Bootstrap primary color
                                                borderColor: 'rgba(13, 110, 253, 1)',
                                                borderWidth: 1,
                                                borderRadius: 4
                                            }, {
                                                label: 'Canceled',
                                                data: [<?= $ph_canceled ?>],
                                                backgroundColor: 'rgba(220, 53, 69, 0.7)',  // Bootstrap danger color
                                                borderColor: 'rgba(220, 53, 69, 1)',
                                                borderWidth: 1,
                                                borderRadius: 4
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            maintainAspectRatio: false,
                                            plugins: {
                                                legend: {
                                                    position: 'bottom',
                                                    labels: {
                                                        padding: 20,
                                                        font: {
                                                            size: 12
                                                        },
                                                        usePointStyle: true,
                                                        pointStyle: 'rectRounded'
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
                                            },
                                            scales: {
                                                x: {
                                                    stacked: true,
                                                    grid: {
                                                        display: false
                                                    },
                                                    ticks: {
                                                        font: {
                                                            size: 11
                                                        }
                                                    }
                                                },
                                                y: {
                                                    stacked: true,
                                                    grid: {
                                                        color: 'rgba(0, 0, 0, 0.05)'
                                                    },
                                                    ticks: {
                                                        font: {
                                                            size: 11
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    });
                                </script>

                                </div>
                                <div class="card-footer bg-light">
                                    <small class="text-muted">Project phase completion status</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 0.5rem; overflow: hidden; transition: transform 0.3s ease;">
                                <div class="card-body">
                                    <h6 class="card-title mb-3" style="color: #0d6efd;">
                                        <i class="fa-solid fa-money-bill-alt me-2"></i>Budget Overview
                                    </h6>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="text-muted">Total Budget:</span>
                                        <span class="fw-bold fs-5"><?= COUNTRY_CURRENCY . " " . number_format($pro['budget'], 2) ?></span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <?php if ($outstanding < 0) : ?>
                                            <span class="text-danger">
                                                <i class="fa-solid fa-exclamation-triangle me-1"></i>Overpayment:
                                            </span>
                                            <span class="text-danger fw-bold"><?= COUNTRY_CURRENCY . " " . number_format((-$outstanding), 2) ?></span>
                                        <?php else : ?>
                                            <span class="text-muted">Outstanding:</span>
                                            <span class="fw-bold"><?= COUNTRY_CURRENCY . " " . number_format(($pro['budget'] - $pro['payment_total']), 2) ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Paid Amount:</span>
                                        <span class="fw-bold text-success"><?= COUNTRY_CURRENCY . " " . number_format($pro['payment_total'], 2) ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100" style="border-radius: 0.5rem; overflow: hidden; transition: transform 0.3s ease;">
                                <div class="card-body">
                                    <h6 class="card-title mb-3" style="color: #0d6efd;">
                                        <i class="fa-solid fa-tasks me-2"></i>Milestone Progress
                                    </h6>
                                    <div class="row g-2">
                                        <div class="col-6 col-sm-3">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="progress w-100 mb-1" style="height: 5px;">
                                                    <div class="progress-bar bg-success" style="width: <?= round($ms_completed_percentage, 2) ?>%"></div>
                                                </div>
                                                <span class="badge bg-success"><?= round($ms_completed_percentage, 2) ?>%</span>
                                                <small class="text-muted">Completed</small>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="progress w-100 mb-1" style="height: 5px;">
                                                    <div class="progress-bar bg-primary" style="width: <?= round($ms_pending_percentage, 2) ?>%"></div>
                                                </div>
                                                <span class="badge bg-primary"><?= round($ms_pending_percentage, 2) ?>%</span>
                                                <small class="text-muted">Pending</small>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="progress w-100 mb-1" style="height: 5px;">
                                                    <div class="progress-bar bg-warning" style="width: <?= round($ms_hold_percentage, 2) ?>%"></div>
                                                </div>
                                                <span class="badge bg-warning"><?= round($ms_hold_percentage, 2) ?>%</span>
                                                <small class="text-muted">On Hold</small>
                                            </div>
                                        </div>
                                        <div class="col-6 col-sm-3">
                                            <div class="d-flex flex-column align-items-center">
                                                <div class="progress w-100 mb-1" style="height: 5px;">
                                                    <div class="progress-bar bg-danger" style="width: <?= round($ms_canceled_percentage, 2) ?>%"></div>
                                                </div>
                                                <span class="badge bg-danger"><?= round($ms_canceled_percentage, 2) ?>%</span>
                                                <small class="text-muted">Canceled</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <div class="row mb-4">
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 0.75rem; overflow: hidden; transition: transform 0.3s ease;">
                <div class="card-header text-white" style="background: linear-gradient(135deg, #0dcaf0, #0aa2c0);">
                    <h5 class="mb-0"><i class="fa-solid fa-info-circle me-2"></i>Project Information</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="fa-solid fa-hashtag me-2"></i>Project Code</span>
                            <span class="badge bg-primary rounded-pill px-3 py-2"><?= $pro['procode'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="fa-solid fa-project-diagram me-2"></i>Project Name</span>
                            <span class="fw-bold"><?= $pro['name'] ?></span>
                        </li>
                        <li class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted"><i class="fa-solid fa-align-left me-2"></i>Description</span>
                            </div>
                            <p class="mb-0 text-break"><?= $pro['description'] ?></p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="fa-solid fa-map-marker-alt me-2"></i>Location</span>
                            <span><?= $country['name'] ?>, <?= $province['name'] ?>, <?= $dist['name'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="fa-solid fa-globe me-2"></i>GPS Coordinates</span>
                            <span>
                                <span class="badge bg-secondary me-1">Lat: <?= $pro['lat'] ?></span>
                                <span class="badge bg-secondary">Lon: <?= $pro['lon'] ?></span>
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted"><i class="fa-regular fa-calendar-alt me-1"></i>Created</small>
                        <small class="text-muted"><?= datetimeforms($pro['create_at']) ?> by <?= $pro['create_by'] ?></small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 0.75rem; overflow: hidden; transition: transform 0.3s ease;">
                <div class="card-header text-white" style="background: linear-gradient(135deg, #198754, #157347);">
                    <h5 class="mb-0"><i class="fa-solid fa-clipboard-list me-2"></i>Project Details</h5>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="fa-solid fa-money-bill-wave me-2"></i>Budget</span>
                            <span class="fw-bold text-success"><?= COUNTRY_CURRENCY ?> <?= number_format($pro['budget'], 2) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="fa-solid fa-user-tie me-2"></i>Project Officer</span>
                            <span><?= $pro['pro_officer_name'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="fa-solid fa-hard-hat me-2"></i>Contractor</span>
                            <span><?= $pro['contractor_name'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <span class="text-muted"><i class="fa-solid fa-flag me-2"></i>Status</span>
                            <?php
                            $statusClass = 'bg-secondary';
                            if ($pro['status'] == 'Completed') $statusClass = 'bg-success';
                            if ($pro['status'] == 'In Progress') $statusClass = 'bg-primary';
                            if ($pro['status'] == 'On Hold') $statusClass = 'bg-warning';
                            if ($pro['status'] == 'Canceled') $statusClass = 'bg-danger';
                            ?>
                            <span class="badge <?= $statusClass ?> rounded-pill px-3 py-2"><?= $pro['status'] ?></span>
                        </li>
                        <li class="list-group-item py-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted"><i class="fa-solid fa-comment me-2"></i>Status Notes</span>
                            </div>
                            <p class="mb-0 text-break"><?= $pro['statusnotes'] ?></p>
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted"><i class="fa-solid fa-clock me-1"></i>Last Updated</small>
                        <small class="text-muted"><?= datetimeforms($pro['update_at']) ?> by <?= $pro['update_by'] ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm" style="border-radius: 0.75rem; overflow: hidden; transition: transform 0.3s ease;">
                <div class="card-header text-white" style="background: linear-gradient(135deg, #0d6efd, #0a58ca);">
                    <h5 class="mb-0"><i class="fa-solid fa-map-marked-alt me-2"></i>Project Location Map: <em><?= $pro['procode'] ?></em></h5>
                </div>
                <div class="card-body p-0">
                    <!-- Map integration -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css" type="text/css">

                    <div id="map" style="height: 400px; width: 100%;"></div>

                    <script>
                        // Initialize map with modern styling
                        const vectorSources = [];

                        // Add project's main KML file if exists
                        <?php if (!empty($pro['kmlfile'])): ?>
                        vectorSources.push(new ol.source.Vector({
                            url: "<?= base_url() . $pro['kmlfile'] ?>",
                            format: new ol.format.KML({
                                extractStyles: false,
                                extractAttributes: true,
                            }),
                            strategy: ol.loadingstrategy.bbox,
                        }));
                        <?php endif; ?>

                        // Add additional KML files from kmlfiles table
                        <?php if (!empty($kmlfiles)): ?>
                            <?php foreach ($kmlfiles as $kml): ?>
                                <?php if (!empty($kml['filepath'])): ?>
                                vectorSources.push(new ol.source.Vector({
                                    url: "<?= base_url() . $kml['filepath'] ?>",
                                    format: new ol.format.KML({
                                        extractStyles: false,
                                        extractAttributes: true,
                                    }),
                                    strategy: ol.loadingstrategy.bbox,
                                }));
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        // Function to get color based on project status
                        function getStatusColor(status) {
                            switch(status ? status.toLowerCase() : '') {
                                case 'active':
                                    return '#28a745'; // Green
                                case 'completed':
                                    return '#007bff'; // Blue
                                case 'hold':
                                    return '#ffc107'; // Yellow/Amber
                                case 'canceled':
                                    return '#6c757d'; // Gray
                                default:
                                    return '#6c757d'; // Gray (default)
                            }
                        }

                        // Get project status color
                        const projectStatus = '<?= $pro['status'] ?? '' ?>';
                        const statusColor = getStatusColor(projectStatus);

                        const vectorLayers = [];
                        for (let i = 0; i < vectorSources.length; i++) {
                            const layer = new ol.layer.Vector({
                                source: vectorSources[i],
                                style: function(feature) {
                                    const geomType = feature.getGeometry().getType();

                                    // Style for LineString (roads, paths)
                                    if (geomType === "LineString") {
                                        return new ol.style.Style({
                                            stroke: new ol.style.Stroke({
                                                color: statusColor,
                                                width: 3,
                                                lineDash: [0.5, 5]
                                            }),
                                        });
                                    }

                                    // Style for Polygon (areas, boundaries)
                                    if (geomType === "Polygon" || geomType === "MultiPolygon") {
                                        return new ol.style.Style({
                                            stroke: new ol.style.Stroke({
                                                color: statusColor,
                                                width: 2
                                            }),
                                            fill: new ol.style.Fill({
                                                color: statusColor.replace(')', ', 0.2)').replace('rgb', 'rgba')
                                            })
                                        });
                                    }

                                    // Default style for other geometries
                                    return new ol.style.Style({
                                        stroke: new ol.style.Stroke({
                                            color: statusColor,
                                            width: 2
                                        })
                                    });
                                },
                            });
                            vectorLayers.push(layer);
                        }

                        // Create project location marker as a dot
                        const marker1 = new ol.Feature({
                            geometry: new ol.geom.Point(
                                ol.proj.fromLonLat([<?= $pro['lon'] ?>, <?= $pro['lat'] ?>])
                            ),
                            name: "<?= $pro['name'] ?>",
                            description: "<?= $pro['procode'] ?>: <?= $pro['name'] ?>",
                            location: "<?= $country['name'] ?>, <?= $province['name'] ?>, <?= $dist['name'] ?>",
                        });

                        const vectorPoints = new ol.source.Vector({
                            features: [marker1],
                        });

                        // Custom marker style as a dot with status-based color and label
                        const vectorPointsLayer = new ol.layer.Vector({
                            source: vectorPoints,
                            style: new ol.style.Style({
                                image: new ol.style.Circle({
                                    radius: 8,
                                    fill: new ol.style.Fill({
                                        color: statusColor // Status-based color
                                    }),
                                    stroke: new ol.style.Stroke({
                                        color: '#fff',
                                        width: 3
                                    })
                                }),
                                // Add text label to marker
                                text: new ol.style.Text({
                                    text: "<?= $pro['procode'] ?>",
                                    font: 'bold 12px Arial',
                                    offsetY: -20,
                                    fill: new ol.style.Fill({
                                        color: '#fff'
                                    }),
                                    backgroundFill: new ol.style.Fill({
                                        color: statusColor.replace(')', ', 0.9)').replace('rgb', 'rgba') // Status-based background
                                    }),
                                    padding: [4, 6, 4, 6],
                                    textAlign: 'center'
                                })
                            }),
                            zIndex: 1000 // Ensure marker is on top
                        });

                        // Create map with enhanced controls
                        const map = new ol.Map({
                            layers: [
                                // Base map layer with custom styling
                                new ol.layer.Tile({
                                    source: new ol.source.OSM(),
                                    preload: Infinity,
                                }),
                                ...vectorLayers,
                                vectorPointsLayer,
                            ],
                            target: "map",
                            view: new ol.View({
                                center: ol.proj.fromLonLat([<?= $pro['lon'] ?>, <?= $pro['lat'] ?>]),
                                zoom: 15,
                                maxZoom: 19,
                                minZoom: 5,
                            }),
                            controls: ol.control.defaults().extend([
                                new ol.control.FullScreen(),
                                new ol.control.ScaleLine(),
                                new ol.control.ZoomSlider()
                            ])
                        });

                        // Auto-zoom to fit all features (marker + KML polygons)
                        setTimeout(function() {
                            const extent = ol.extent.createEmpty();
                            let hasFeatures = false;

                            // Include marker extent
                            if (vectorPoints.getFeatures().length > 0) {
                                ol.extent.extend(extent, vectorPoints.getExtent());
                                hasFeatures = true;
                            }

                            // Include all KML layer extents
                            vectorLayers.forEach(function(layer) {
                                const source = layer.getSource();
                                if (source && source.getFeatures().length > 0) {
                                    ol.extent.extend(extent, source.getExtent());
                                    hasFeatures = true;
                                }
                            });

                            // Fit map to combined extent if we have features
                            if (hasFeatures && !ol.extent.isEmpty(extent)) {
                                map.getView().fit(extent, {
                                    padding: [50, 50, 50, 50],
                                    maxZoom: 16,
                                    duration: 1000
                                });
                            }
                        }, 1000); // Wait for KML files to load

                        // Add popup functionality
                        const element = document.getElementById("popup");
                        if (element) {
                            const popup = new ol.Overlay({
                                element: element,
                                positioning: "bottom-center",
                                stopEvent: false,
                                offset: [0, -20],
                            });
                            map.addOverlay(popup);
                        }

                        // Add click interaction to show marker info
                        map.on('click', function(evt) {
                            const feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                                return feature;
                            });

                            if (feature && feature.get('name')) {
                                // You could show a popup with feature information here
                                console.log('Clicked on feature:', feature.get('name'));
                            }
                        });
                    </script>


                    <!-- End of map integration -->
                </div>

            </div>
        </div>
    </div>
    <hr>






</section>



<!-- Custom scripts for this page -->
<script>
    // Update chart styling for better appearance
    document.addEventListener('DOMContentLoaded', function() {
        // Enable all tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // Add hover effects to cards
        const cards = document.querySelectorAll('.card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Fix chart proportions and ensure proper rendering
        function resizeCharts() {
            // Get all chart canvases
            const chartCanvases = document.querySelectorAll('canvas');
            chartCanvases.forEach(canvas => {
                // Force a resize event on each chart
                const chart = Chart.getChart(canvas);
                if (chart) {
                    chart.resize();
                }
            });
        }

        // Call resize on load and window resize
        resizeCharts();
        window.addEventListener('resize', resizeCharts);

        // Update fundChart styling
        var fundChartEl = document.getElementById('fundChart');
        if (fundChartEl) {
            var fundChart = Chart.getChart(fundChartEl);
            if (fundChart) {
                // No need to update colors as they're already set in the chart initialization
                fundChart.options.maintainAspectRatio = true;
                fundChart.options.responsive = true;
                fundChart.options.layout = {
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 10,
                        left: 0
                    }
                };

                // Adjust legend to prevent overflow
                fundChart.options.plugins.legend.labels.padding = 10;
                fundChart.options.plugins.legend.labels.boxWidth = 10;
                fundChart.options.plugins.legend.labels.font.size = 11;
                fundChart.update();
            }
        }

        // Update milesChart styling
        var milesChartEl = document.getElementById('milesChart');
        if (milesChartEl) {
            var milesChart = Chart.getChart(milesChartEl);
            if (milesChart) {
                // Set consistent styling for bar chart
                milesChart.options.maintainAspectRatio = true;
                milesChart.options.responsive = true;
                milesChart.options.layout = {
                    padding: {
                        top: 0,
                        right: 0,
                        bottom: 10,
                        left: 0
                    }
                };

                // Adjust legend to prevent overflow
                milesChart.options.plugins.legend.labels.padding = 10;
                milesChart.options.plugins.legend.labels.font.size = 11;

                // Adjust bar thickness for better appearance
                milesChart.options.barThickness = 20;
                milesChart.options.maxBarThickness = 30;

                // Ensure proper height for the chart
                milesChart.options.aspectRatio = 1.8;

                // Update the chart with new settings
                milesChart.update();

                // Force a resize after a short delay to ensure proper rendering
                setTimeout(() => {
                    milesChart.resize();
                }, 100);
            }
        }
    });
</script>

<!-- Print-specific styles -->
<style media="print">
    @page {
        size: A4;
        margin: 1cm;
    }
    body {
        font-size: 12pt;
    }
    .navbar, .footer, .system-header, .d-print-none, .breadcrumb {
        display: none !important;
    }
    .card {
        break-inside: avoid;
        border: 1px solid #ddd !important;
        box-shadow: none !important;
    }
    .card-header {
        background-color: #f8f9fa !important;
        color: #000 !important;
        border-bottom: 1px solid #ddd !important;
    }
    .text-white {
        color: #000 !important;
    }
    .badge {
        border: 1px solid #ddd !important;
        color: #000 !important;
        background-color: #f8f9fa !important;
    }
    #map {
        height: 300px !important;
    }
    .container {
        max-width: 100% !important;
        width: 100% !important;
    }
</style>

<?= $this->endSection() ?>