<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

<!-- links -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>


<div class="container-fluid mt-1">

    <div class="row">
        <div class="col-md-12">
            <div class="card card-dark ">
                <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                <div class="card-header p-1">
                    <span class=" btn btn-dark"><?= session('orgname') ?></span>
                    <span class=" float-right btn btn-dark">Org Dashboard</span>
                </div>
                <div class="card-footer p-1 bg-dark">
                    <div class="row">
                        <div class=" col-md-4">
                            <a class="btn btn-block btn-light text-left" href="<?= base_url(); ?>report_projects_dash">
                                <i class="fas fa-list-alt"></i>
                                <span class=" float-right">PROJECTS</span>
                            </a>
                        </div>
                        <div class=" col-md-4">
                            <a class="btn btn-light btn-block text-left" href="<?= base_url(); ?>report_contractors_dash">
                                <i class="fas fa-people-carry"></i>
                                <span class=" float-right">CONTRACTORS</span>
                            </a>
                        </div>
                        <div class=" col-md-4">
                            <a class="btn btn-light btn-block text-left" href="<?= base_url(); ?>report_pro_officers_dash">
                                <i class="fas fa-user-check"></i>
                                <span class=" float-right">PROJECT OFFICERS</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5 class="  float-left">Dashboard Report</h5>
            <span class=" float-right"> Welcome <strong><?= session('name') ?></strong></span>
        </div>
    </div>

    <div class="row">
        <!-- OTHER DATA -->
        <div class="col-md-12">
            <span>Projects</span>
            <div class="row">
                <div class="col-md-3">

                    <div class="info-box">
                        <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-lightbulb"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"> <?= count($pro_active) ?></span>
                            <span class="info-box-number">
                                ACTIVE
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- ./col -->

                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-check-circle"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"> <?= count($pro_completed) ?></span>
                            <span class="info-box-number">
                                COMPLETED
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- ./col -->

                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hand"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"> <?= count($pro_hold) ?></span>
                            <span class="info-box-number">
                                ON HOLD
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- ./col -->

                <div class="col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-circle-notch"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text"> <?= count($projects) ?></span>
                            <span class="info-box-number">
                                TOTAL
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- ./col -->

            </div>
            <!-- /.row -->


            <!-- Info boxes -->
            <div class="row">

                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <span>Payments</span>
                            <div class="card card-primary card-outline ">

                                <div class="card-body p-0">
                                    <table class="table">
                                        <tbody>
                                            <tr class=" text-bold">
                                                <td scope="">T.Budgeted</td>
                                                <td>T.Paid</td>
                                                <td>T.Outstanding</td>
                                                <td>T.OverPaid</td>
                                            </tr>
                                            <tr>
                                                <td scope="row"><?= number_format($pro_total_budget, 2) ?></td>
                                                <td scope="row"><?= number_format($pro_total_paid, 2) ?></td>
                                                <td scope="row">
                                                    <?php
                                                    echo number_format($pro_total_outstanding, 2)
                                                    ?>
                                                </td>
                                                <td scope="row">
                                                    <?= number_format($pro_total_overpaid, 2) ?>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                        
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.col -->

                <div class="col-md-4">
                    <span>Milestones</span>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline card-primary">

                                <div class="card-body p-0">
                                    <ul class="list-group">
                                        <!--tips: add .list-group-flush to the .list-group to remove some borders and rounded corners-->
                                        <li class="list-group-item">
                                            <span class="text-left "><i class="fa fa-hourglass-1" aria-hidden="true"></i> PENDING</span>
                                            <span class=" badge badge-dark float-right"> <?= ($pro_ms_pending) ?> </span>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="text-left "><i class="fa fa-check-circle" aria-hidden="true"></i> COMPLETED</span>
                                            <span class=" badge badge-dark float-right"> <?= ($pro_ms_completed) ?> </span>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="text-left "><i class="fa fa-exclamation-circle" aria-hidden="true"></i> ON HOLD</span>
                                            <span class=" badge badge-dark float-right"> <?= ($pro_ms_hold) ?> </span>
                                        </li>
                                        <li class="list-group-item">
                                            <span class="text-left "><i class="fa fa-clipboard-list " aria-hidden="true"></i> All MILESTONES</span>
                                            <span class=" badge badge-dark float-right"> <?= count($milestones) ?> </span>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->

                    </div>

                </div>
                <!-- /.col -->


            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-4">
                    <div class="card card-primary card-outline " id="statusPDF">
                        <div class="card-header">
                            <h3 class="card-title">Projects Status</h3>

                            <div class="card-tools">
                                <button onclick="statusPDF()" class="btn btn-default btn-sm float-right"> <i class="fa fa-download" aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php
                            // Data values 
                            $data_status = [count($pro_active), count($pro_completed), count($pro_hold)];

                            // Data labels
                            $labels_status = ['Active', 'Completed', 'Hold',];
                            ?>
                            <canvas id="barChart_status" style="max-width:100%;"></canvas>

                            <script>
                                const data_status = <?php echo json_encode($data_status); ?>;
                                const labels_status = <?php echo json_encode($labels_status); ?>;

                                const config_barChart_status = {
                                    type: 'bar',
                                    data: {
                                        labels: labels_status,
                                        datasets: [{
                                            label: 'Bar Chart',
                                            data: data_status,
                                            backgroundColor: [
                                                '#007bff',
                                                '#28a745',
                                                '#ffc107',
                                            ],
                                            borderColor: [
                                                '#007bff',
                                                '#28a745',
                                                '#ffc107',
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero: true
                                                }
                                            }]
                                        },
                                        legend: {
                                            display: false
                                        }
                                    }
                                };

                                // Render bar chart
                                const barChart_status = new Chart(
                                    document.getElementById('barChart_status'),
                                    config_barChart_status
                                );
                            </script>

                            <script>
                                function statusPDF() {

                                    // Options
                                    var opt = {
                                        margin: 0.5,
                                        filename: 'page.pdf',
                                        image: {
                                            type: 'jpeg',
                                            quality: 1
                                        },
                                        compression: false,
                                        html2canvas: {
                                            dpi: 300,
                                            letterRendering: true,
                                            useCORS: true,
                                            canvasWidth: 2000,
                                            scale: 2
                                        },
                                        jsPDF: {
                                            flags: ['a1'],
                                            unit: 'in',
                                            format: 'letter',
                                            orientation: 'landscape'
                                        }
                                    };

                                    // New Promise-based usage:
                                    // html2pdf().set(opt).from('document.body').save();

                                    // Get the <ul> element
                                    const list = document.querySelector('#statusPDF');

                                    // Generate PDF from <ul> only  
                                    html2pdf().from(list).save();

                                }
                            </script>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Active
                                        <span class="float-right text-primary">
                                            <?= count($pro_active) ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Completed
                                        <span class="float-right text-success">
                                            <?= count($pro_completed) ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Hold
                                        <span class="float-right text-warning">
                                            <?= count($pro_hold) ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-bold">
                                        Total
                                        <span class="float-right ">
                                            <?= count($projects) ?></span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.footer -->
                    </div>
                    <!-- /.card -->
                </div>



                <div class="col-md-4">
                    <div class="card card-primary card-outline " id='paymentPDF'>
                        <div class="card-header">
                            <h3 class="card-title">Projects Payments</h3>

                            <div class="card-tools">
                                
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php
                          //  echo $pro_total_paid;
                           // $outstanding = $pro_total_outstanding;
                            // Data values 
                            $data_payments = [($pro_total_paid), ($pro_total_outstanding)];

                            // Data labels
                            $labels_payments = ["Paid", "Outstanding"];
                            ?>

                            <canvas id="pieChart_payments" style="max-width:100%"></canvas>

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

                          

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total Budgeted
                                        <span class="float-right text-primary">
                                            <?= COUNTRY_CURRENCY ?><?= number_format($pro_total_budget, 2) ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total Paid
                                        <span class="float-right text-success">
                                            <?= COUNTRY_CURRENCY ?><?= number_format($pro_total_paid, 2) ?></span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total Outstanding
                                        <span class="float-right text-warning">
                                            <?= COUNTRY_CURRENCY ?><?= number_format($pro_total_outstanding, 2) ?></span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Total OverPaid
                                        <span class="float-right text-danger">
                                            <?= COUNTRY_CURRENCY ?>
                                            <?= number_format($pro_total_overpaid, 2) ?>

                                        </span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.footer -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-4">
                    <div class="card card-primary card-outline" id="msPDF">
                        <div class="card-header">
                            <h3 class="card-title">Projects Milestones</h3>

                            <div class="card-tools">
                                <button onclick="msPDF()" class="btn btn-default btn-sm float-right"> <i class="fa fa-download" aria-hidden="true"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php
                            // Data values 
                            $data_milestone = [($pro_ms_pending), ($pro_ms_completed), ($pro_ms_hold)];

                            // Data labels
                            $labels_milestone = ['Pending', 'Completed', 'Hold',];
                            ?>
                            <canvas id="doughnutChart_milestone" style="max-width:100%;"></canvas>

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

                                            ],
                                            hoverBackgroundColor: [
                                                "#007bff",
                                                "#28a745",
                                                "#ffc107",

                                            ]
                                        }],
                                        labels: labels_milestone
                                    },
                                    options: {
                                        responsive: true,
                                        legend: {
                                            position: 'top',
                                        },
                                        title: {
                                            display: false,
                                            text: 'Doughnut Chart'
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

                            <script>
                                function msPDF() {

                                    // Options
                                    var opt = {
                                        margin: 0.5,
                                        filename: 'page.pdf',
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
                                    const list = document.querySelector('#msPDF');

                                    // Generate PDF from <ul> only  
                                    html2pdf().from(list).save();

                                }
                            </script>



                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Pending
                                        <span class="float-right text-primary">
                                            <?= ($pro_ms_pending) ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Completed
                                        <span class="float-right text-success">
                                            <?= ($pro_ms_completed) ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Hold
                                        <span class="float-right text-warning">
                                            <?= ($pro_ms_hold) ?></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link text-bold">
                                        Total
                                        <span class="float-right ">
                                            <?= $total_ms = count($milestones) ?></span>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <!-- /.footer -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->

            <div class="row">


                <div class="col-md-12">
                    <div class="card card-outline card-primary ">
                        <div class="card-header">
                            Projects Map
                        </div>
                        <div class="card-body">
                            <div class="card-body p-0 ">
                                <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
                                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css" type="text/css">
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script> <!-- Update Bootstrap JS -->
                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> <!-- Update Bootstrap JS -->

                                <style>
                                    #map {
                                        height: 700px;
                                        width: 100%;
                                    }
                                </style>
                                <div id="map"></div>
                                <div id="popup" style="display:none;"></div> <!-- Add this line -->

                                <script>
                                    var vectorSources = [
                                        <?php $file = 1;
                                        foreach ($projects as $kml) :
                                            if ($file == 1) :
                                        ?>,
                                                new ol.source.Vector({
                                                    url: '<?= base_url() ?><?= $kml['kmlfile'] ?>',
                                                    format: new ol.format.KML({
                                                        extractStyles: false,
                                                        extractAttributes: true
                                                    }),
                                                    strategy: ol.loadingstrategy.bbox // Only load visible features
                                                }),
                                        <?php endif;
                                        endforeach; ?>
                                        // add more VectorSource objects as needed
                                    ];
                                    var vectorLayers = [];
                                    for (var i = 0; i < vectorSources.length; i++) {
                                        var layer = new ol.layer.Vector({
                                            source: vectorSources[i],
                                            style: function(feature) {
                                                // Only display tracks
                                                if (feature.getGeometry().getType() === 'LineString') {
                                                    return new ol.style.Style({
                                                        stroke: new ol.style.Stroke({
                                                            color: 'red',
                                                            width: 2
                                                        })
                                                    });
                                                }
                                            }
                                        });
                                        vectorLayers.push(layer);
                                    }
                                    const cars = [];
                                    var vectorPoints;
                                    <?php
                                    $markers = "";
                                    $x = 1;
                                    $pins = "1";
                                    foreach ($projects as $project) :
                                        if (($project['lat'] != "" && $project['lon'] != "") && $pins == "1") :
                                    ?>
                                            var marker<?= $x ?> = new ol.Feature({
                                                geometry: new ol.geom.Point(ol.proj.fromLonLat([<?= $project['lon'] ?>, <?= $project['lat'] ?>])),
                                                name: '<?= $project['name'] ?>',
                                                description: '<?= $project['procode'] ?>',
                                                url: 'https://govhrm.wanspeen.com',
                                                link: 'View'
                                            });
                                            cars.push(marker<?= $x ?>);

                                    <?php
                                            $markers .= "marker" . $x . ",";
                                            $x++;
                                        endif;
                                    endforeach; ?>


                                    var vectorPoints = new ol.source.Vector({
                                        features: [<?= $markers ?>]
                                    });
                                    var vectorPointsLayer = new ol.layer.Vector({
                                        source: vectorPoints,
                                        style: new ol.style.Style({
                                            image: new ol.style.Icon({
                                                src: '<?= base_url() ?>public/assets/system_img/marker-map.png',
                                                // size:[20,20]
                                            })
                                        })
                                    });
                                    var map = new ol.Map({
                                        layers: [
                                            new ol.layer.Tile({
                                                source: new ol.source.OSM()
                                            }),
                                            // add all VectorLayer objects to the layers array
                                            ...vectorLayers,
                                            vectorPointsLayer
                                        ],
                                        target: 'map',
                                        view: new ol.View({
                                            center: ol.proj.fromLonLat([<?= $org['center_gps_longitude'] ?>, <?= $org['center_gps_latitude'] ?>]),
                                            zoom: <?= $org['center_gps_zoom'] ?>
                                        })
                                    });
                                    var element = document.getElementById('popup');
                                    var popup = new ol.Overlay({
                                        element: element,
                                        positioning: 'bottom-center',
                                        stopEvent: false,
                                        offset: [0, -20]
                                    });
                                    map.addOverlay(popup);
                                    // display popup on click
                                    map.on('click', function(evt) {
                                        var feature = map.forEachFeatureAtPixel(evt.pixel,
                                            function(feature) {
                                                return feature;
                                            });
                                        if (feature) {
                                            var coordinates = feature.getGeometry().getCoordinates();
                                            popup.setPosition(coordinates);
                                            $(element).show(); // Move this line up
                                            $(element).popover({
                                                placement: 'top',
                                                html: true,
                                                content: feature.get('name') + '<br>' + feature.get('description') + '<br><a href="' + feature.get('url') + '">' + feature.get('link') + '</a>'
                                            });
                                            $(element).popover('show');
                                        } else {
                                            $(element).popover('dispose');
                                            $(element).hide(); // Add this line
                                        }
                                    });
                                    // change mouse cursor when over marker
                                    map.on('pointermove', function(e) {
                                        if (e.dragging) {
                                            $(element).popover('dispose');
                                            $(element).hide(); // Add this line
                                            return;
                                        }
                                        var pixel = map.getEventPixel(e.originalEvent);
                                        var hit = map.hasFeatureAtPixel(pixel);
                                        document.getElementById('map').style.cursor = hit ? 'pointer' : '';
                                    });
                                </script>



                            </div>
                        </div>
                    </div>
                </div>


            </div>


        </div>
        <!-- ./ col - dashboard -->

    </div>
    <!-- /.row -->
</div>


<?= $this->endSection(); ?>