<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>
<!-- DataTables -->
<link rel="stylesheet" href="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<!-- links -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cosmo/bootstrap.min.css" crossorigin="anonymous" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Include Leaflet CSS and JavaScript -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js" crossorigin=""></script>




<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Reports Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid" id="printpdf">



    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark ">
                <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                <div class="card-header p-1">
                    <span class="float-left btn btn-dark"><?= session('orgname') ?></span>
                    <span class=" float-right btn btn-dark"> Reports Dashboard</span>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5 class="float-left">Summary Report</h5>


        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col-md-12">
            <!-- Info boxes -->
            <div class="row">

                <div class="col-md-12">
                    <span>Payments</span>
                    <div class="card card-outline card-info">

                        <div class="card-body p-0">
                            <table class="table">
                                <tbody>
                                    <tr class=" text-bold">
                                        <td scope="row">T.Budgeted</td>
                                        <td>T.Paid</td>
                                        <td>T.Outstanding</td>
                                        <td>T.OverPaid</td>
                                    </tr>
                                    <tr>
                                        <td scope="row"><?= COUNTRY_CURRENCY . number_format($pro_total_budget, 2) ?></td>
                                        <td scope="row"><?= COUNTRY_CURRENCY . number_format($pro_total_paid, 2) ?></td>
                                        <td scope="row"><?= COUNTRY_CURRENCY . number_format($pro_total_outstanding, 2) ?></td>
                                        <td scope="row"><?= COUNTRY_CURRENCY . number_format($pro_total_overpaid, 2) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row mb-0">
                <div class="col-md-12">
                    <span>Milestones</span>

                    <div class="row mt-0">
                        <div class="col-md-3">
                            <div class="callout callout-info">
                                <span class="text-left "><i class="fa fa-hourglass-1" aria-hidden="true"></i> T. MS. PENDING</span>
                                <span class=" badge badge-dark float-right"> <?= ($pro_ms_pending) ?> </span>
                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="col-md-3">
                            <div class="callout callout-info">
                                <span class="text-left "><i class="fa fa-check-circle" aria-hidden="true"></i> T. MS. COMPLETED</span>
                                <span class=" badge badge-dark float-right"> <?= ($pro_ms_completed) ?> </span>
                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="col-md-3">
                            <div class="callout callout-info">
                                <span class="text-left "><i class="fa fa-exclamation-circle" aria-hidden="true"></i> T. MS. HOLD</span>
                                <span class=" badge badge-dark float-right"> <?= ($pro_ms_hold) ?> </span>
                            </div>
                        </div>
                        <!-- /.col -->

                        <div class="col-md-3">
                            <div class="callout callout-info">
                                <span class="text-left "><i class="fa fa-clipboard-list" aria-hidden="true"></i> T. MS. Milestones</span>
                                <span class=" badge badge-dark float-right"> <?= count($milestones) ?> </span>
                            </div>
                        </div>
                        <!-- /.col -->

                    </div>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <!-- OTHER DATA -->
        <div class="col-md-12">

            <div class="card card-info" id="projects_list">
                <div class="card-header">
                    <span> Projects List</span>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table text-nowrap " id="projects_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Project</th>
                                <th>P.Date</th>
                                <th>Fund</th>
                                <th>Budget (<?= COUNTRY_CURRENCY ?>)</th>
                                <th>T.Paid (<?= COUNTRY_CURRENCY ?>)</th>
                                <th>Out.P (<?= COUNTRY_CURRENCY ?>)</th>
                                <th>Over.P (<?= COUNTRY_CURRENCY ?>)</th>
                                <th>Contractor</th>
                                <th>P.Officer</th>
                                <th>GPS</th>
                                <th>MS.Pending</th>
                                <th>MS.Completed</th>
                                <th>MS.Hold</th>
                                <th>MS.Canceled</th>
                                <th>MS.Total</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1;
                            foreach ($projects as $pro) : ?>

                                <?php
                                $ms_pending = $ms_hold = $ms_completed = $ms_canceled = $ms_total = 0;
                                foreach ($milestones as $ms) {
                                    if ($ms['procode'] == $pro['procode']) {
                                        if ($ms['checked'] == "pending") {

                                            $ms_pending++;
                                        }
                                        if ($ms['checked'] == 'hold') {
                                            $ms_hold++;
                                        }
                                        if ($ms['checked'] == 'completed') {
                                            $ms_completed++;
                                        }
                                        if ($ms['checked'] == 'canceled') {
                                            $ms_canceled++;
                                        }
                                    }
                                }
                                $ms_total = $ms_pending + $ms_hold + $ms_completed + $ms_canceled;
                                ?>

                                <tr>
                                    <td><?= $x++ ?></td>
                                    <td><?= $pro['procode'] ?></td>
                                    <td><?= $pro['name'] ?></td>
                                    <td><?= dateforms($pro['pro_date']) ?></td>
                                    <td><?= strtoupper($pro['fund']) ?></td>
                                    <td>
                                        <?= number_format(checkZero($pro['budget']), 2) ?></td>
                                    <td><?= number_format(checkZero($pro['payment_total']), 2) ?></td>
                                    <td>
                                        <?php $t_outstanding = checkZero($pro['budget']) - checkZero($pro['payment_total']);
                                        if ($t_outstanding < 0) {
                                            $t_outstanding = 0;
                                        }
                                        ?>
                                        <?= number_format(checkZero($t_outstanding), 2) ?>
                                    </td>
                                    <td>
                                        <?php
                                        $t_overpay = checkZero($pro['payment_total']) - checkZero($pro['budget']);
                                        if ($t_overpay < 0) {
                                            $t_overpay = 0;
                                        }
                                        ?>
                                        <?= number_format(checkZero($t_overpay), 2) ?>
                                    </td>
                                    <td><?= $pro['contractor_name'] ?></td>
                                    <td><?= $pro['pro_officer_name'] ?></td>
                                    <td class="gps-coordinates">
                                        <?php
                                        if (!empty($pro['gps'])) {
                                            echo $pro['lat'] . ", " . $pro['lon'];
                                        }
                                        ?>

                                    </td>
                                    <td>
                                        <?= $ms_pending ?>
                                    </td>
                                    <td>
                                        <?= $ms_completed ?>
                                    </td>
                                    <td>
                                        <?= $ms_hold ?>
                                    </td>
                                    <td>
                                        <?= $ms_canceled ?>
                                    </td>
                                    <td>
                                        <?= $ms_total ?>
                                    </td>
                                    <td><?= ucfirst($pro['status']) ?></td>
                                    <td><a class="btn btn-primary btn-sm float-right" href="<?= base_url() ?>report_projects_view/<?= $pro['ucode'] ?>">View Report</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <small><b>Org: </b><?= session('orgname') ?></small>
                </div>
            </div>
            <!-- /.card -->


        </div>
        <!-- ./ col  -->

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Projects Maps</h5>
                </div>
                <div class="card-footer">
                    <!-- Map Container -->
                    <div id="map" style="height: 400px"></div>
                </div>
            </div>
        </div>
        <!--./ col  -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Bar Chart</h5>
                </div>
                <div class="card-footer">
                    <!-- Bar Chart for Budget and Payments -->
                    <canvas id="projectBarChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <!--./ col  -->

        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pie Chart</h5>
                </div>
                <div class="card-footer">
                    <!-- Bar Chart for Budget and Payments -->
                    <canvas id="projectPieChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <!--./ col  -->

    </div>
    <!-- /.row -->



    <script>
        /* $(function() {
            $("#projects_table").DataTable({
                "responsive": false,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": [{
                        extend: 'excel',
                        text: 'Excel',
                        filename: '<?= $title ?>', // Set custom filename
                        exportOptions: {
                            modifier: {
                                page: 'all'
                            },
                            title: '<?= $title ?>'
                        }
                    },
                    {
                        extend: 'colvis',
                        text: 'View Columns',

                    }
                ],
                "columnDefs": [{
                    "targets": "_all",
                    "className": "text-nowrap"
                }]
                //"buttons": ["copy", "excel", "print", "colvis"]
            }).buttons().container().appendTo('#projects_table_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        }); */
    </script>

    <script>
        /*    $(document).ready(function() {

            // DataTable
            var table = $('#datatble').DataTable({
                // data
            });

            // PDF button
            $('#datatble').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'pdf'
                ]
            });

        }); */
    </script>

    <!-- barchart payment budget -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $("#projects_table").DataTable();

            // Function to update Chart.js data based on filtered table data
            function updateChart(table) {
                // Get filtered data from the table
                var filteredData = table.rows({
                    search: "applied"
                }).data().toArray();

                // Update Chart.js data
                myChart.data.labels = filteredData.map((row) => row[1]); // Assuming Project Name is in the second column
                myChart.data.datasets = [{
                    label: "Budget vs Payment",
                    data: filteredData.map((row) => row[5] - row[6]), // Subtract Payment from Budget for each project
                    backgroundColor: "rgba(75, 192, 192, 0.2)", // Add your preferred color
                    borderColor: "rgba(75, 192, 192, 1)", // Add your preferred color
                    borderWidth: 1,
                }, ];

                // Update the chart
                myChart.update();
            }

            //=================================== PROJECT BAR CHART =====================================================

            // Initial Chart.js setup for Bar Chart
            var barCtx = document
                .getElementById("projectBarChart")
                .getContext("2d");
            var barChart = new Chart(barCtx, {
                type: "bar",
                data: {
                    labels: [], // Will be dynamically updated
                    datasets: [],
                },
                options: {
                    scales: {
                        x: {
                            stacked: true,
                        },
                        y: {
                            stacked: true,
                        },
                    },
                    // Add your Chart.js options
                },
            });

            // Function to update Bar Chart data based on filtered table data
            function updateBarChart(table) {
                // Get filtered data from the table
                var filteredData = table.rows({
                    search: "applied"
                }).data().toArray();

                // Initialize data structure for bar chart
                var barChartData = {
                    labels: [], // Will be dynamically updated
                    datasets: [{
                            label: "Budget",
                            data: [],
                            backgroundColor: "rgba(75, 192, 192, 0.5)", // Budget color
                        },
                        {
                            label: "Payments",
                            data: [],
                            backgroundColor: "rgba(255, 99, 132, 0.5)", // Payments color
                        },
                    ],
                };

                // Prepare datasets for each project
                filteredData.forEach(function(row) {
                    var projectName = row[2]; // Assuming Project Name is in the second column
                    var budget = row[5];
                    var payment = row[6];

                    // Add data for each project
                    barChartData.labels.push(projectName);
                    barChartData.datasets[0].data.push(budget);
                    barChartData.datasets[1].data.push(payment);
                });

                // Update Bar Chart data
                barChart.data = barChartData;

                // Update the Bar Chart
                barChart.update();
            }

            // Call the updateBarChart function initially
            updateBarChart(table);
        });
    </script>


    <!-- pieChart -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $("#projects_table").DataTable();

            // Initial Chart.js setup for Pie Chart
            var pieCtx = document
                .getElementById("projectPieChart")
                .getContext("2d");
            var pieChart = new Chart(pieCtx, {
                type: "pie",
                data: {
                    labels: [], // Will be dynamically updated
                    datasets: [{
                        data: [],
                        backgroundColor: [
                            "rgba(255, 99, 132, 0.8)", // Add your preferred color for each status
                            "rgba(54, 162, 235, 0.8)",
                            "rgba(255, 206, 86, 0.8)",
                            "gba(0, 128, 0, 0.8)",
                            // Add more colors as needed
                        ],
                    }, ],
                },
                options: {
                    // Add your Chart.js options
                },
            });

            // Function to update Pie Chart data based on filtered table data
            function updatePieChart(table) {
                // Get filtered data from the table
                var filteredData = table.rows({
                    search: "applied"
                }).data().toArray();

                // Count project statuses for Pie Chart
                var statusCount = {};
                filteredData.forEach(function(row) {
                    var status = row[17]; // Assuming Status is in the fifth column
                    statusCount[status] = (statusCount[status] || 0) + 1;
                });

                // Update Pie Chart data
                pieChart.data.labels = Object.keys(statusCount);
                pieChart.data.datasets[0].data = Object.values(statusCount);

                // Update the Pie Chart
                pieChart.update();
            }

            // Call the updatePieChart function initially
            updatePieChart(table);

            // Redraw the chart whenever the table is drawn (e.g., after filtering)
            table.on("draw", function() {
                updatePieChart(table);
            });
        });
    </script>

    <!-- maps coordinates -->
    <!-- Initialize DataTable -->
    
    <!-- Include Leaflet CSS and JS files -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<!-- Initialize Leaflet map -->
<script>
  var map = L.map("map").setView([-6.31499, 143.95555], 6); // Set the initial map view

  // Add OpenStreetMap tile layer to the map
  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap contributors",
  }).addTo(map);

  // Function to update the map based on filtered table data
  function updateMap() {
    // Clear previous markers
    map.eachLayer(function (layer) {
      if (layer instanceof L.Marker) {
        map.removeLayer(layer);
      }
    });

    // Get filtered data from the table
    var filteredData = $("#projects_table").DataTable().rows({ search: "applied" }).data().toArray();

    // Add markers for each project's GPS coordinates
    filteredData.forEach(function (row) {
      var coordinates = row[11].split(", "); // Assuming coordinates are in the twelfth column
      var lat = parseFloat(coordinates[0]);
      var lng = parseFloat(coordinates[1]);

      // Create a marker and add it to the map
      L.marker([lat, lng])
        .addTo(map)
        .bindPopup("Project: " + row[2] + "<br>Budget: " + row[5]);
    });
  }

  // Call the updateMap function initially
  updateMap();

  // Redraw the map whenever the table is drawn (e.g., after filtering)
  $("#projects_table").on("draw.dt", function () {
    updateMap();
  });
</script>
</div>




<?= $this->endSection(); ?>