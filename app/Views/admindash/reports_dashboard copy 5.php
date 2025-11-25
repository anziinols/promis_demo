<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css" />
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/cosmo/bootstrap.min.css" crossorigin="anonymous" /> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Include Leaflet CSS and JavaScript -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js" crossorigin=""></script>

<!-- Include jQuery and DataTables for table manipulation -->
<!-- Include DataTables Buttons CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>




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

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">T.Budgeted</span>
                            <span class="info-box-number">
                                <div id="totalBudget"></div>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->


                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-money-bill-alt"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">T.Payments</span>
                            <span class="info-box-number">
                                <div id="totalPayments"></div>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->


                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-hourglass-3"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">T.Outstanding</span>
                            <span class="info-box-number">
                                <div id="outstandingPayments"></div>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->


                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-circle-notch"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">T.Overpayment</span>
                            <span class="info-box-number">
                                <div id="overPayments"></div>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

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
                    <table id="projectTable" class="table table-responsive text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ProCode</th>
                                <th>Project Name</th>
                                <th>Budget</th>
                                <th id="payments">Payment</th>
                                <th>Ots</th>
                                <th>Ovp</th>
                                <th>Status</th>
                                <th>GPS</th>
                                <th>C.MS</th>
                                <th>T.MS</th>
                                <th>C.Ph</th>
                                <th>T.Ph</th>
                                <th>Country</th>
                                <th>Province</th>
                                <th>District</th>
                                <th>LLG</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1;
                            foreach ($projects as $pro) :

                                //phases
                                $ph_comp = $ph = 0;
                                foreach ($phases as $p) {
                                    if ($p['procode'] == $pro['procode']) {
                                        $ph++;
                                        if ($p['status'] == 'completed') {
                                            $ph_comp++;
                                        }
                                    }
                                }

                                //milestones
                                $ms_comp = $ms = 0;
                                foreach ($milestones as $m) {
                                    if ($m['procode'] == $pro['procode']) {
                                        $ms++;
                                        if ($m['checked'] == 'completed') {
                                            $ms_comp++;
                                        }
                                    }
                                }

                            ?>
                                <tr>
                                    <td><?= $x++ ?></td>
                                    <td id="procode<?= $x ?>"><?= $pro['procode'] ?></td>
                                    <td id="name<?= $x ?>"><?= $pro['name'] ?></td>
                                    <td id='budget<?= $x ?>'><?= (checkZero($pro['budget'])) ?></td>
                                    <td id='payments<?= $x ?>'><?= (checkZero($pro['payment_total'])) ?></td>
                                    <td id='outstanding<?= $x ?>'>
                                        <?php
                                        $outstand = (checkZero($pro['budget']) - checkZero($pro['payment_total']));
                                        if ($outstand < 0) {
                                            $outstand = 0;
                                        } else {
                                            echo ($outstand);
                                        }
                                        ?>
                                    </td>
                                    <td id='overpayents<?= $x ?>'>
                                        <?php
                                        $overpay = (checkZero($pro['payment_total']) - checkZero($pro['budget']));
                                        if ($overpay < 0) {
                                            echo 0;
                                        } else {
                                            echo ($overpay);
                                        }
                                        ?>
                                    </td>
                                    <td id='status<?= $x ?>'><?= $pro['status'] ?></td>
                                    <td class="gps-coordinates" id='gps<?= $x ?>'>
                                        <?php
                                        if (!empty($pro['gps'])) {
                                            echo $pro['lat'] . ", " . $pro['lon'];
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </td>
                                    <td id='ms_comp<?= $x ?>'><?= $ms_comp ?></td>
                                    <td id='ms<?= $x ?>'><?= ($ms - $ms_comp) ?></td>
                                    <td id='ph_comp<?= $x ?>'><?= $ph_comp ?></td>
                                    <td id='ph<?= $x ?>'><?= ($ph - $ph_comp) ?></td>
                                    <td id='country<?= $x ?>'>
                                        <?php foreach ($country as $c) :
                                            if ($c['code'] == $pro['country']) {
                                                echo $c['name'];
                                            }
                                        ?>
                                        <?php endforeach ?>
                                    </td>
                                    <td id="province<?= $x ?>">
                                        <?php foreach ($province as $p) :
                                            if ($p['provincecode'] == $pro['province']) {
                                                echo $p['name'];
                                            }
                                        ?>
                                        <?php endforeach ?>
                                    </td>
                                    <td id="district<?= $x ?>">
                                        <?php foreach ($district as $d) :
                                            if ($d['districtcode'] == $pro['district']) {
                                                echo $d['name'];
                                            }
                                        ?>
                                        <?php endforeach ?>
                                    </td>
                                    <td id="llg<?= $x ?>">
                                        <?php foreach ($llg as $l) :
                                            if ($l['llgcode'] == $pro['llg']) {
                                                echo $l['name'];
                                            }
                                        ?>
                                        <?php endforeach ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>



                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <div class="row">

                        <div class="col-md-4">
                            <!-- Pie Chart -->
                            <canvas id="projectPieChart" width="50" height="50"></canvas>
                        </div>
                        <div class="col-md-4">
                            <!-- Pie Chart -->
                            <canvas id="projectBarChartMS" width="400" height="400"></canvas>
                        </div>
                        <div class="col-md-4">
                            <!-- Pie Chart -->
                            <canvas id="projectBarChartPh" width="400" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card -->


        </div>
        <!-- ./ col  -->

    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Budget and Payments
                </div>
                <div class="card-body">
                    <div class="">
                        <!-- Bar Chart for Budget and Payments -->
                        <canvas id="projectBarChart" height="100px"></canvas>
                    </div>
                </div>
                <div class="card-footer text-muted">

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                <div class="card-header">
                    Projects Maping
                </div>
                <div class="card-body p-0">
                    <div class="">
                        <!-- Map Container -->
                        <div id="map" style="height: 700px"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- initialize datatable -->
    <script>
        // Initialize DataTable once
        var table = null;
        $(document).ready(function() {
            // Check if DataTable is already initialized
            if (!$.fn.DataTable.isDataTable('#projectTable')) {
                // Initialize DataTable with Excel export button
                table = $("#projectTable").DataTable({
                    buttons: [{
                        extend: 'excelHtml5',
                        text: 'Export to Excel'
                    }]
                });
            } else {
                table = $("#projectTable").DataTable();
            }

            // Redraw the map, charts, and update totals whenever the table is drawn (e.g., after filtering)
            table.on("draw", function() {
                updateMap(table);
                updateChartAndTotals();
                updatePieChart(table);
                updateBarChart(table);
                updateBarChartPhases(table);
            });
        });
    </script>

    <!-- Barchart Budget and Payments -->
    <script>
        $(document).ready(function() {
            // Initial Chart.js setup for Combined Chart
            var ctx = document.getElementById("projectBarChart").getContext("2d");
            var combinedChart = new Chart(ctx, {

            });



            // Function to update Combined Chart data based on table data
            function updateChartAndTotals() {
                // Your function to update the combined chart
            }

            // Call the updateChartAndTotals function initially
            updateChartAndTotals();
        });
    </script>

    <!-- pieChart Status -->
    <script>
        $(document).ready(function() {
            // Initial Chart.js setup for Pie Chart
            var pieCtx = document.getElementById("projectPieChart").getContext("2d");
            var pieChart = new Chart(pieCtx, {
                // Your chart configuration
            });

            // Function to update Pie Chart data based on filtered table data
            function updatePieChart(table) {
                // Your function to update the pie chart
            }

            // Call the updatePieChart function initially
            updatePieChart(table);
        });
    </script>

    <!-- barchart Milestones -->
    <script>
        $(document).ready(function() {
            // Initial Chart.js setup for Bar Chart
            var barCtx = document.getElementById("projectBarChartMS").getContext("2d");
            var barChart = new Chart(barCtx, {
                // Your chart configuration
            });

            // Function to update Bar Chart data based on filtered table data
            function updateBarChart(table) {
                // Your function to update the bar chart
            }

            // Call the updateBarChart function initially
            updateBarChart(table);
        });
    </script>

    <!-- barchart Phases -->
    <script>
        $(document).ready(function() {
            // Initial Chart.js setup for Bar Chart
            var barCtx = document.getElementById("projectBarChartPh").getContext("2d");
            var barChart = new Chart(barCtx, {
                // Your chart configuration
            });

            // Function to update Bar Chart data based on filtered table data
            function updateBarChartPhases(table) {
                // Your function to update the bar chart for phases
            }

            // Call the updateBarChartPhases function initially
            updateBarChartPhases(table);
        });
    </script>

    <!-- maps coordinates -->
    <script>
        $(document).ready(function() {
            // Initialize Leaflet map
            var map = L.map("map").setView([<?= $org['center_gps_latitude'] ?>, <?= $org['center_gps_longitude'] ?>], <?= $org['center_gps_zoom'] ?>); // Set the initial map view

            // Add OpenStreetMap tile layer to the map
            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution: "© OpenStreetMap contributors",
            }).addTo(map);

            // Function to update the map based on filtered table data
            function updateMap(table) {
                // Your function to update the map
            }

            // Call the updateMap function initially
            updateMap(table);

            // Redraw the map whenever the table is drawn (e.g., after filtering)
            table.on("draw", function() {
                updateMap(table);
            });
        });
    </script>


</div>




<?= $this->endSection(); ?>