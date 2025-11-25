<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<section class="container-fluid d-print-none ">
    <div class="row p-1">
        <div class="col-12 d-flex justify-content-between">

            <h4><?= $pro['procode'] . ": " . $pro['name'] ?></h4>

            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="<?= base_url() ?>po_open_project/<?= $pro['ucode'] ?>"> <i class="bi bi-chevron-left"></i> Go Back</a>
                <!-- <a class="breadcrumb-item" href="#"></a> -->
                <span class="breadcrumb-item active"><?= $pro['procode'] ?></span>
                <button class="breadcrumb-item active btn btn-flat btn-sm" onclick="printPDF()"><i class="fas fa-download" aria-hidden="true"></i> PDF</button>
            </nav>

        </div>

    </div>

</section>

<section class=" container-fluid content" id="printPDF">
    <div class="row">
        <div class="col-md-12 text-center">
            <h2 class="">Project Report</h2>
        </div>
    </div>
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Project Charts
                    <span class=" float-right"><b><?= $pro['name'] ?> /<?= $pro['procode'] ?> </b></span>
                </div>
                <div class="card-body p-0">
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <?php
                                    $outstanding = $pro['budget'] - $pro['payment_total'];
                                    // Data values 
                                    if ($outstanding <= 0) {
                                        $outstanding = 0;
                                    }
                                    $data_payments = [($pro['payment_total']), (($outstanding))];
                                    // Data labels
                                    $labels_payments = ["Paid", "Outstanding"];
                                    ?>
                                    <figure class="figure border-2 border-secondary " style="border: 2px solid black;">

                                        <canvas id="pieChart_payments" style="width:300px"></canvas>
                                        <figcaption class="figure-caption text-dark bg-secondary">Payments
                                        </figcaption>
                                        <script>
                                            // Setup block
                                            const data_payments = <?php echo json_encode($data_payments); ?>;
                                            const labels_payments = <?php echo json_encode($labels_payments); ?>;
                                            const config_pieChart_payments = {
                                                type: 'pie',
                                                data: {
                                                    datasets: [{
                                                        data: data_payments,
                                                        backgroundColor: [
                                                            "#28a745",
                                                            "#ffc107",
                                                        ]
                                                    }],
                                                    labels: labels_payments
                                                },
                                                options: {
                                                    responsive: true
                                                }
                                            };

                                            // Render block
                                            const pieChart_payments = new Chart(
                                                document.getElementById('pieChart_payments'),
                                                config_pieChart_payments
                                            );
                                        </script>

                                    </figure>
                                </div>

                                <div class="col-md-6 pl-1 text-center">
                                    <figure class="figure border-2 border-secondary " style="border: 2px solid black;">

                                        <canvas id="doughnutChart_milestone" style="max-width:100%" class=" figure-img img-fluid"></canvas>
                                        <figcaption class="figure-caption text-center text-dark bg-secondary">Milestones by %</figcaption>
                                        <?php
                                        // Data values 
                                        $data_milestone = [($pro_ms_pending), ($pro_ms_completed), ($pro_ms_hold), ($pro_ms_canceled)];

                                        // Data labels
                                        $labels_milestone = ['Pending', 'Completed', 'Hold', 'Canceled'];
                                        ?>
                                        <script>
                                            const data_milestone = <?php echo json_encode($data_milestone); ?>;
                                            const labels_milestone = <?php echo json_encode($labels_milestone); ?>;

                                            const config_doughnutChart_milestone = {
                                                type: 'doughnut',
                                                data: {
                                                    datasets: [{
                                                        data: data_milestone,
                                                        backgroundColor: [
                                                            "#007bff",
                                                            "#28a745",
                                                            "#ffc107",
                                                            "#FF3D00",

                                                        ],
                                                        hoverBackgroundColor: [
                                                            "#007bff",
                                                            "#28a745",
                                                            "#ffc107",
                                                            "#FF3D00"

                                                        ]
                                                    }],
                                                    labels: labels_milestone
                                                },
                                                options: {
                                                    responsive: true,
                                                    plugins: {
                                                        legend: {
                                                            position: 'top',
                                                        },
                                                        title: {
                                                            display: false,
                                                            text: 'Doughnut Chart'
                                                        }
                                                    },
                                                    animation: {
                                                        animateScale: true,
                                                        animateRotate: true
                                                    }
                                                }
                                            };

                                            const doughnutChart_doughnutChart_milestone = new Chart(
                                                document.getElementById('doughnutChart_milestone'),
                                                config_doughnutChart_milestone
                                            );
                                        </script>

                                    </figure>
                                </div>
                                
                            </div>
                        </div>

                        <div class="col-md-6 text-center">
                            <figure class="figure border-2 border-secondary text-center" style="border: 2px solid black;">
                                <div style="position: relative; height: 300px; width: 100%;">
                                    <canvas id="barChart_milephase" class="figure-img img-fluid"></canvas>
                                </div>
                                <figcaption class="figure-caption text-center text-dark bg-secondary">Phases & Milestones % (Completion by Phase)</figcaption>


                                <?php
                                // Data labels and arrays for phase milestone percentages
                                $labels_milephase = "";
                                $data_milephase_pending = $data_milephase_completed = $data_milephase_hold = $data_milephase_canceled = "";
                                $data_milestone_pending = $data_milestone_completed = $data_milestone_hold = $data_milestone_canceled = array();

                                // Calculate milestone percentages for each phase
                                foreach ($phases as $ph) {
                                    $milephase_pending = $milephase_completed = $milephase_hold = $milephase_canceled = 0;
                                    $milephase_total = 0;

                                    $labels_milephase .= "'" . $ph['phases'] . "',";

                                    // Count milestones by status for this phase
                                    foreach ($milestones as $ms) {
                                        if ($ms['phase_id'] == $ph['id']) {
                                            $milephase_total++;
                                            $status = strtolower(trim($ms['checked'] ?? 'pending'));

                                            switch ($status) {
                                                case 'completed':
                                                    $milephase_completed++;
                                                    break;
                                                case 'pending':
                                                    $milephase_pending++;
                                                    break;
                                                case 'hold':
                                                    $milephase_hold++;
                                                    break;
                                                case 'canceled':
                                                    $milephase_canceled++;
                                                    break;
                                                default:
                                                    $milephase_pending++;
                                                    break;
                                            }
                                        }
                                    }

                                    // Calculate percentages (avoid division by zero)
                                    if ($milephase_total > 0) {
                                        $percent_pending = round(($milephase_pending / $milephase_total) * 100, 1);
                                        $percent_completed = round(($milephase_completed / $milephase_total) * 100, 1);
                                        $percent_hold = round(($milephase_hold / $milephase_total) * 100, 1);
                                        $percent_canceled = round(($milephase_canceled / $milephase_total) * 100, 1);
                                    } else {
                                        $percent_pending = $percent_completed = $percent_hold = $percent_canceled = 0;
                                    }

                                    // Store percentages
                                    $data_milestone_pending[] = $percent_pending;
                                    $data_milestone_completed[] = $percent_completed;
                                    $data_milestone_hold[] = $percent_hold;
                                    $data_milestone_canceled[] = $percent_canceled;

                                    $data_milephase_pending .= $percent_pending . ',';
                                    $data_milephase_completed .= $percent_completed . ',';
                                    $data_milephase_hold .= $percent_hold . ',';
                                    $data_milephase_canceled .= $percent_canceled . ',';
                                }
                                ?>

                                <script>
                                    var stackedBar = document.getElementById('barChart_milephase').getContext('2d');

                                    var myStackedBar = new Chart(stackedBar, {
                                        type: 'bar',
                                        data: {
                                            labels: [<?= $labels_milephase ?>],
                                            datasets: [
                                                {
                                                    label: 'Pending',
                                                    data: [<?= $data_milephase_pending ?>],
                                                    backgroundColor: '#007bff',
                                                },
                                                {
                                                    label: 'Completed',
                                                    data: [<?= $data_milephase_completed ?>],
                                                    backgroundColor: '#28a745'
                                                },
                                                {
                                                    label: 'Hold',
                                                    data: [<?= $data_milephase_hold ?>],
                                                    backgroundColor: '#ffc107'
                                                },
                                                {
                                                    label: 'Canceled',
                                                    data: [<?= $data_milephase_canceled ?>],
                                                    backgroundColor: '#dc3545'
                                                }
                                            ]
                                        },
                                        options: {
                                            plugins: {
                                                title: {
                                                    display: false,
                                                    text: 'Phase Milestone Completion %'
                                                },
                                                tooltip: {
                                                    mode: 'index',
                                                    intersect: false,
                                                    callbacks: {
                                                        label: function(context) {
                                                            let label = context.dataset.label || '';
                                                            if (label) {
                                                                label += ': ';
                                                            }
                                                            label += context.parsed.y.toFixed(1) + '%';
                                                            return label;
                                                        }
                                                    }
                                                },
                                                legend: {
                                                    display: true,
                                                    position: 'top'
                                                }
                                            },
                                            responsive: true,
                                            maintainAspectRatio: false,
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
                                                    max: 100,
                                                    ticks: {
                                                        callback: function(value) {
                                                            return value + '%';
                                                        }
                                                    },
                                                    title: {
                                                        display: true,
                                                        text: 'Completion Percentage'
                                                    }
                                                }
                                            }
                                        }
                                    });
                                </script>

                            </figure>
                        </div>
                    </div>


                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <b>Budget: <span class=" float-right"><?= COUNTRY_CURRENCY . " " . number_format($pro['budget'], 2) ?></span> </b>
                            <div class=" d-flex justify-content-between">
                                <span>Outstanding: <?= COUNTRY_CURRENCY . " " . number_format(($pro['budget'] - $pro['payment_total']), 2) ?> </span>
                                <span>Paid: <?= COUNTRY_CURRENCY . " " . number_format($pro['payment_total'], 2) ?> </span>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <b>Milestones by %:</b>
                            <div class=" d-flex justify-content-between">
                                <span>Pending: <?= $mspend = round($ms_pending_percent, 2) ?>%</span>
                                <span>Completed:
                                    <?= $mscomp = round($ms_completed_percent, 2) ?>%
                                </span>


                                <span>Hold: <?= $mshold = round($ms_hold_percent, 2) ?>% </span>
                                <span>Canceled: <?= $mshold = round($ms_canceled_percent, 2) ?>% </span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-2 mb-2">
        <div class="col-md-6 mb-1">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Information
                </div>
                <div class="card-body p-0">
                    <ul class="list-group border-0">
                        <!--tips: add .list-group-flush to the .list-group to remove some borders and rounded corners-->

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Code:</b>
                            <span class=""><?= $pro['procode'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Name:</b>
                            <span class=""><?= $pro['name'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Description:</b>
                            <span class=""><?= $pro['description'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Project Site:</b>
                            <span class=""><?= $pro['pro_site'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Loc.Address:</b>
                            <span class=""><?= $country['name'] ?>, <?= $province['name'] ?>, <?= $dist['name'] ?>
                                <?php if (!empty($llg['name'])) : ?>
                                    ,<?= $llg['name'] ?>
                                <?php endif; ?>
                            </span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Loc.GPS:</b>
                            <span class=""><b>Lat:</b> <?= $pro['lat'] ?> <b>Lon:</b> <?= $pro['lon'] ?></span>
                        </li>

                    </ul>
                </div>
                <div class="card-footer">
                    <em>Created:

                        <span class=" float-right"> <?= datetimeforms($pro['create_at']) ?> / <?= $pro['create_by'] ?></span>
                    </em>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Details
                </div>
                <div class="card-body p-0">
                    <ul class="list-group border-0">
                        <!--tips: add .list-group-flush to the .list-group to remove some borders and rounded corners-->

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Budget:</b>
                            <span class=""><?= COUNTRY_CURRENCY ?> <?= number_format($pro['budget'], 2) ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Fund.Source:</b>
                            <span class=""><?= strtoupper($pro['fund']) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Officer:</b>
                            <span class=""><?= $pro['pro_officer_name'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Contractor:</b>
                            <span class=""><?= $pro['contractor_name'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Status:</b>
                            <span class=""><?= $pro['status'] ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Status Notes:</b>
                            <span class=""><?= $pro['statusnotes'] ?></span>
                        </li>

                    </ul>
                </div>
                <div class="card-footer">
                    <em>Last Update:

                        <span class=" float-right"> <?= datetimeforms($pro['update_at']) ?> / <?= $pro['update_by'] ?></span>
                    </em>
                </div>
            </div>
            <!-- /. card -->
        </div>
        <!-- ./col -->
    </div>
    <!-- ./row -->

    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Map: <em><?= $pro['procode'] ?></em>
                </div>
                <div class="card-body p-0">
                    <!-- 
                  s  extracting kml file into map
                 -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css" type="text/css">

                    <div id="map" style="max-width:100%; height: 500px;"></div>

                    <!-- Add this line -->
                    <script>
                        var vectorSources = [
                            new ol.source.Vector({
                                url: "<?= base_url() . $pro['kmlfile'] ?>",
                                format: new ol.format.KML({
                                    extractStyles: false,
                                    extractAttributes: true,
                                }),
                                strategy: ol.loadingstrategy.bbox, // Only load visible features
                            }),
                            // add more VectorSource objects as needed
                        ];
                        var vectorLayers = [];
                        for (var i = 0; i < vectorSources.length; i++) {
                            var layer = new ol.layer.Vector({
                                source: vectorSources[i],
                                style: function(feature) {
                                    var geometryType = feature.getGeometry().getType();

                                    // Style for LineString (tracks/roads)
                                    if (geometryType === "LineString") {
                                        return new ol.style.Style({
                                            stroke: new ol.style.Stroke({
                                                color: "red",
                                                width: 2,
                                            }),
                                        });
                                    }

                                    // Style for Polygon and MultiPolygon (areas)
                                    if (geometryType === "Polygon" || geometryType === "MultiPolygon") {
                                        return new ol.style.Style({
                                            stroke: new ol.style.Stroke({
                                                color: "#007bff",
                                                width: 2,
                                            }),
                                            fill: new ol.style.Fill({
                                                color: "rgba(0, 123, 255, 0.2)", // Semi-transparent blue fill
                                            }),
                                        });
                                    }
                                },
                            });
                            vectorLayers.push(layer);
                        }
                        var marker1 = new ol.Feature({
                            geometry: new ol.geom.Point(
                                ol.proj.fromLonLat([<?= $pro['lon'] ?>, <?= $pro['lat'] ?>])
                            ),
                            name: "Marker 1",
                            description: "This is the first marker",
                            url: "https://govhrm.wanspeen.com",
                            link: "View",
                        });

                        var vectorPoints = new ol.source.Vector({
                            features: [marker1],
                        });
                        var vectorPointsLayer = new ol.layer.Vector({
                            source: vectorPoints,
                            style: new ol.style.Style({
                                image: new ol.style.Icon({
                                    src: "<?= base_url() ?>public/assets/system_img/marker-map22.png",
                                    // size:[20,20]
                                }),
                            }),
                        });
                        var map = new ol.Map({
                            layers: [
                                new ol.layer.Tile({
                                    source: new ol.source.OSM(),
                                }),
                                // add all VectorLayer objects to the layers array
                                ...vectorLayers,
                                vectorPointsLayer,
                            ],
                            target: "map",
                            view: new ol.View({
                                center: ol.proj.fromLonLat([<?= $pro['lon'] ?>, <?= $pro['lat'] ?>]),
                                zoom: 14,
                            }),
                        });

                        // Auto-zoom to fit all features (marker + KML polygons)
                        setTimeout(function() {
                            var extent = ol.extent.createEmpty();
                            var hasFeatures = false;

                            // Include marker extent
                            if (vectorPoints.getFeatures().length > 0) {
                                ol.extent.extend(extent, vectorPoints.getExtent());
                                hasFeatures = true;
                                console.log('Marker extent added');
                            }

                            // Include all KML layer extents
                            vectorLayers.forEach(function(layer, index) {
                                var source = layer.getSource();
                                var features = source.getFeatures();
                                if (features.length > 0) {
                                    ol.extent.extend(extent, source.getExtent());
                                    hasFeatures = true;
                                    console.log('KML layer ' + index + ' extent added, features: ' + features.length);
                                }
                            });

                            // Fit map to combined extent with padding
                            if (hasFeatures && !ol.extent.isEmpty(extent)) {
                                map.getView().fit(extent, {
                                    padding: [50, 50, 50, 50], // Add 50px padding on all sides
                                    duration: 1000, // Smooth animation (1 second)
                                    maxZoom: 16 // Don't zoom in too close
                                });
                                console.log('Map auto-zoomed to fit all features');
                            } else {
                                console.warn('No features found for auto-zoom');
                            }
                        }, 1500); // Wait 1.5 seconds for KML files to load
                    </script>

                    <!-- 
                        End extract kml files to Map
                     -->
                </div>

            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Phases and Milestones: <em><?= $pro['procode'] ?></em>
                    <span class="float-right">
                        <small class="text-muted">
                            Total: <?= count($milestones) ?> milestones |
                            Phases: <?= count($phases) ?> |
                            Completed: <?= $pro_ms_completed ?> |
                            Pending: <?= $pro_ms_pending ?> |
                            Hold: <?= $pro_ms_hold ?> |
                            Canceled: <?= $pro_ms_canceled ?>
                        </small>
                    </span>
                </div>

                <!-- Debug Section (Remove after testing) -->
                <?php if (ENVIRONMENT === 'development'): ?>
                <div class="card-body bg-light border-bottom">
                    <details>
                        <summary class="text-primary" style="cursor: pointer;">
                            <i class="fas fa-bug"></i> Debug Info (Click to expand)
                        </summary>
                        <div class="mt-2">
                            <h6>Milestone Data:</h6>
                            <pre class="bg-white p-2 border" style="max-height: 300px; overflow-y: auto; font-size: 11px;"><?php
                                foreach ($milestones as $ms) {
                                    echo "ID: {$ms['id']} | Milestone: {$ms['milestones']} | Status: {$ms['checked']} | Phase ID: {$ms['phase_id']}\n";
                                }
                            ?></pre>
                            <h6>Phase Data:</h6>
                            <pre class="bg-white p-2 border" style="max-height: 200px; overflow-y: auto; font-size: 11px;"><?php
                                foreach ($phases as $ph) {
                                    echo "ID: {$ph['id']} | Phase: {$ph['phases']}\n";
                                }
                            ?></pre>
                        </div>
                    </details>
                </div>
                <?php endif; ?>

                <div class="card-body p-0 table-responsive-md">
                    <table class="table table-bordered table-hover text-nowrap mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 35%;">Milestone</th>
                                <th style="width: 12%;">Status</th>
                                <th style="width: 15%;">Scheduled Period</th>
                                <th style="width: 12%;">Checked Date</th>
                                <th style="width: 21%;">Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Track which milestones have been displayed
                            $displayedMilestones = [];
                            $pplus = 1;

                            // First, display milestones grouped by phases
                            if (!empty($phases)):
                                foreach ($phases as $ph) :
                                    $phaseMilestones = array_filter($milestones, function($ms) use ($ph) {
                                        return $ms['phase_id'] == $ph['id'];
                                    });

                                    // Only show phase header if it has milestones
                                    if (!empty($phaseMilestones)):
                            ?>
                                <tr class="table-secondary">
                                    <td colspan="6" class="font-weight-bold">
                                        <i class="fas fa-layer-group"></i> <?= $pplus; ?>. <?= $ph['phases']; ?>
                                    </td>
                                </tr>
                                <?php
                                    $msplus = 1;
                                    foreach ($phaseMilestones as $ms) :
                                        $displayedMilestones[] = $ms['id'];
                                        // Determine status badge
                                        $statusBadge = '';
                                        $statusText = ucfirst($ms['checked']);
                                        switch(strtolower($ms['checked'])) {
                                            case 'completed':
                                                $statusBadge = 'badge-success';
                                                break;
                                            case 'pending':
                                                $statusBadge = 'badge-warning';
                                                break;
                                            case 'hold':
                                                $statusBadge = 'badge-info';
                                                break;
                                            case 'canceled':
                                                $statusBadge = 'badge-danger';
                                                break;
                                            default:
                                                $statusBadge = 'badge-secondary';
                                        }
                                ?>
                                        <tr>
                                            <td class="text-center"><?= $pplus ?>.<?= $msplus++ ?></td>
                                            <td><?= $ms['milestones'] ?></td>
                                            <td class="text-center">
                                                <span class="badge <?= $statusBadge ?>"><?= $statusText ?></span>
                                            </td>
                                            <td class="text-center">
                                                <?php if (!empty($ms['datefrom']) && !empty($ms['dateto'])): ?>
                                                    <small>
                                                        <?= dateforms($ms['datefrom']) ?><br>
                                                        <i class="fas fa-arrow-down"></i><br>
                                                        <?= dateforms($ms['dateto']) ?>
                                                    </small>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= !empty($ms['checked_date']) ? dateforms($ms['checked_date']) : '<span class="text-muted">-</span>' ?>
                                            </td>
                                            <td>
                                                <small><?= !empty($ms['notes']) ? $ms['notes'] : '<span class="text-muted">No remarks</span>' ?></small>
                                            </td>
                                        </tr>
                                <?php
                                    endforeach; // End phaseMilestones loop
                                    $pplus++;
                                    endif; // End if phaseMilestones not empty
                                endforeach; // End phases loop
                            endif; // End if phases not empty

                            // Now display any milestones that don't have a phase_id or don't match any phase
                            $orphanMilestones = array_filter($milestones, function($ms) use ($displayedMilestones) {
                                return !in_array($ms['id'], $displayedMilestones);
                            });

                            if (!empty($orphanMilestones)):
                            ?>
                                <tr class="table-secondary">
                                    <td colspan="6" class="font-weight-bold">
                                        <i class="fas fa-tasks"></i> Other Milestones (No Phase Assigned)
                                    </td>
                                </tr>
                                <?php
                                $msplus = 1;
                                foreach ($orphanMilestones as $ms) :
                                    // Determine status badge
                                    $statusBadge = '';
                                    $statusText = ucfirst($ms['checked']);
                                    switch(strtolower($ms['checked'])) {
                                        case 'completed':
                                            $statusBadge = 'badge-success';
                                            break;
                                        case 'pending':
                                            $statusBadge = 'badge-warning';
                                            break;
                                        case 'hold':
                                            $statusBadge = 'badge-info';
                                            break;
                                        case 'canceled':
                                            $statusBadge = 'badge-danger';
                                            break;
                                        default:
                                            $statusBadge = 'badge-secondary';
                                    }
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $msplus++ ?></td>
                                        <td><?= $ms['milestones'] ?></td>
                                        <td class="text-center">
                                            <span class="badge <?= $statusBadge ?>"><?= $statusText ?></span>
                                        </td>
                                        <td class="text-center">
                                            <?php if (!empty($ms['datefrom']) && !empty($ms['dateto'])): ?>
                                                <small>
                                                    <?= dateforms($ms['datefrom']) ?><br>
                                                    <i class="fas fa-arrow-down"></i><br>
                                                    <?= dateforms($ms['dateto']) ?>
                                                </small>
                                            <?php else: ?>
                                                <span class="text-muted">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= !empty($ms['checked_date']) ? dateforms($ms['checked_date']) : '<span class="text-muted">-</span>' ?>
                                        </td>
                                        <td>
                                            <small><?= !empty($ms['notes']) ? $ms['notes'] : '<span class="text-muted">No remarks</span>' ?></small>
                                        </td>
                                    </tr>
                                <?php
                                endforeach; // End orphanMilestones loop
                            endif; // End if orphanMilestones not empty
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Payments: <em><?= $pro['procode'] ?></em>
                    <span class=" float-right"><b><?= COUNTRY_CURRENCY ?> <?= number_format($pro['budget'], 2) ?> </b></span>
                </div>
                <div class="card-body p-0 table-responsive-md">
                    <table class="table table-bordered text-nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Amount(PGK)</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $pplus = 1;
                            $pay = array();
                            foreach ($payments as $py) : ?>
                                <tr>
                                    <td><?= $pplus++ ?></td>
                                    <td><?= dateforms($py['paymentdate']) ?></td>
                                    <td><?php
                                        echo  number_format($py['amount'], 2);
                                        $pay[] = ($py['amount']);
                                        ?></td>
                                    <td><?= $py['description'] ?></td>
                                </tr>
                            <?php
                            endforeach; ?>
                        <tfoot class=" font-weight-bold">
                            <tr>
                                <td colspan="2">Total Payment</td>
                                <td><?= number_format(array_sum($pay), 2) ?></td>
                                <td>Total Outstanding: (<?= number_format($pro['budget'], 2) ?> - <?= number_format(array_sum($pay), 2) ?>) = <span class=" font-weight-bold float-right"> <?= COUNTRY_CURRENCY ?>
                                        <?= $outstanding = $pro['budget'] - array_sum($pay) ?>
                                        <?php if ($outstanding < 0) {
                                            echo '(Overpayment)';
                                        } ?>

                                    </span></td>
                            </tr>
                        </tfoot>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <hr>
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Events: <em><?= $pro['procode'] ?></em>
                </div>
                <div class="card-body p-0 table-responsive-md">
                    <table class="table table-bordered text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Date</th>
                                <th>Event</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $pplus = 1;
                            foreach ($events as $ev) : ?>
                                <tr>
                                    <td><?= $pplus++ ?></td>
                                    <td><?= dateforms($ev['eventdate']) ?></td>
                                    <td><?= $ev['event'] ?></td>
                                </tr>
                            <?php
                            endforeach; ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>




    <script>
        function printPDF() {

            // Options
            var opt = {
                margin: 0.5,
                filename: 'report.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1.98
                },
                html2canvas: {
                    dpi: 200,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A3',
                    orientation: 'landscape'
                }
            };

            // New Promise-based usage:
            // html2pdf().set(opt).from('document.body').save();

            // Get the <ul> element
            const list = document.querySelector('#printPDF');

            // Generate PDF from <ul> only  
            html2pdf().from(list).save();

        }
    </script>


</section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

<?= $this->endSection() ?>