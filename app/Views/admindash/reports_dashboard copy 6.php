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

<!-- export to excel -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

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
                    <button class="btn btn-light btn-sm float-right" onclick="exportToExcel('projectTable')">Export to Excel <i class="fa fa-arrow-circle-right" aria-hidden="true"></i> </button>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table id="projectTable" class="table table-responsive text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ProCode</th>
                                <th>Project Name</th>
                                <th>Fund.Source</th>
                                <th>Budget</th>
                                <th id="payments">Payment</th>
                                <th>Ots</th>
                                <th>Ovp</th>
                                <th>Status</th>
                                <th>GPS</th>
                                <th>MS.Pend.</th>
                                <th>MS.Hold.</th>
                                <th>MS.Comp.</th>
                                <th>MS.Cancl.</th>
                                <th>MS.T</th>
                                <th>Ph.Active.</th>
                                <th>Ph.Comp.</th>
                                <th>Ph.Cancl.</th>
                                <th>Ph.T.</th>
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
                                $ph_completed = $ph_active = $ph_cancelled = $ph_total = 0;
                                foreach ($phases as $p) {
                                    if ($p['procode'] == $pro['procode']) {
                                        $ph_total++;
                                        if ($p['status'] == 'completed') {
                                            $ph_completed++;
                                        }
                                        if ($p['status'] == 'active') {
                                            $ph_active++;
                                        }

                                        if ($p['status'] == 'cancelled') {
                                            $ph_cancelled++;
                                        }
                                    }
                                }

                                //milestones
                                $ms_completed = $ms_pending = $ms_hold = $ms_cancelled = $ms_total = 0;
                                foreach ($milestones as $m) {
                                    if ($m['procode'] == $pro['procode']) {
                                        $ms_total++;
                                        if ($m['checked'] == 'completed') {
                                            $ms_completed++;
                                        }
                                        if ($m['checked'] == 'pending') {
                                            $ms_pending++;
                                        }
                                        if ($m['checked'] == 'hold') {
                                            $ms_hold++;
                                        }
                                        if ($m['checked'] == 'canceled') {
                                            $ms_cancelled++;
                                        }
                                    }
                                }

                            ?>
                                <tr>
                                    <td><?= $x++ ?></td>
                                    <td id="procode<?= $x ?>"><?= $pro['procode'] ?></td>
                                    <td id="name<?= $x ?>"><?= $pro['name'] ?></td>
                                    <td id="fund<?= $x ?>"><?= strtoupper($pro['fund']) ?></td>
                                    <td id='budget<?= $x ?>'><?= (checkZero($pro['budget'])) ?></td>
                                    <td id='payments<?= $x ?>'><?= (checkZero($pro['payment_total'])) ?></td>
                                    <td id='outstanding<?= $x ?>'>
                                        <?php
                                        $outstand = (checkZero($pro['budget']) - checkZero($pro['payment_total']));
                                        if ($outstand <= 0) {
                                            echo 0;
                                        } else {
                                            echo ($outstand);
                                        }
                                        ?>
                                    </td>
                                    <td id='overpayments<?= $x ?>'>
                                        <?php
                                        $overpay = (checkZero($pro['payment_total']) - checkZero($pro['budget']));
                                        if ($overpay <= 0) {
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
                                    <td id='ms_pending<?= $x ?>'><?= $ms_pending ?></td>
                                    <td id='ms_completed<?= $x ?>'><?= $ms_completed ?></td>
                                    <td id='ms_hold<?= $x ?>'><?= $ms_hold ?></td>
                                    <td id='ms_canceled<?= $x ?>'><?= $ms_cancelled ?></td>
                                    <td id='ms_total<?= $x ?>'><?= ($ms_total) ?></td>
                                    <td id='ph_active<?= $x ?>'><?= $ph_active ?></td>
                                    <td id='ph_completed<?= $x ?>'><?= $ph_completed ?></td>
                                    <td id='ph_canceled<?= $x ?>'><?= $ph_cancelled ?></td>
                                    <td id='ph_total<?= $x ?>'><?= $ph_total ?></td>
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

                        <div class=" col-4 col-md-4">
                            <!-- Pie Chart Status -->
                            <canvas id="statusPieChart" width="50" height="50"></canvas>
                        </div>
                        <div class=" col-4 col-md-4">
                            <!-- Pie Chart Funding Source -->
                            <canvas id="fundingSourcePieChart" width="400" height="400"></canvas>
                        </div>
                        <div class=" col-4 col-md-4">
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
            }
        });
    </script>

    <!-- Barchart Budget and Payments -->
    <script>
        $(document).ready(function() {
            // Initial Chart.js setup for Combined Chart
            var ctx = document.getElementById("projectBarChart").getContext("2d");
            var combinedChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: [], // Will be dynamically updated
                    datasets: [{
                            label: "Budgets",
                            data: [],
                            type: "line", // Display as a line chart
                            borderColor: "rgba(255, 99, 132, 0.5)", // budget color
                            //backgroundColor: "rgba(255, 99, 132, 0.5)", // Transparent background
                            yAxisID: "combined-axis", // Assign to the y-axis
                            borderWidth: 3, // Adjust the thickness of the line
                        },
                        {
                            label: "Payments",
                            data: [],
                            backgroundColor: "rgba(75, 192, 192, 1)", // payments color
                            yAxisID: "combined-axis", // Assign to the y-axis
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            id: "combined-axis", // Set the same y-axis ID for both datasets
                            ticks: {
                                display: false, // Hide the ticks on the y-axis
                            },
                        },
                    },
                    // Add your Chart.js options
                },
            });

            // Function to update Combined Chart data based on table data
            function updateChartAndTotals() {
                // Get data from the table
                var combinedChartData = {
                    labels: [], // Will be dynamically updated
                    datasets: [{
                            label: "Budget",
                            data: [],
                            type: "line", // Display as a line chart
                            borderColor: "rgba(255, 99, 132, 0.5)", // budget color
                            backgroundColor: "rgba(0, 0, 0, 0)", // Transparent background
                            yAxisID: "combined-axis", // Assign to the y-axis
                        },
                        {
                            label: "Payments",
                            data: [],
                            backgroundColor: "rgba(75, 192, 192, 1)", // payments color
                            yAxisID: "combined-axis", // Assign to the y-axis
                        },
                    ],
                };

                // Reset total variables
                var totalBudget = 0;
                var totalPayments = 0;
                var totalOutstanding = 0;
                var totalOverpayments = 0;

                // Iterate over table rows to get data
                $("#projectTable tbody tr").each(function(index) {
                    var projectName = $(this).find("td:eq(3)").text().trim();
                    var budget = parseFloat($(this).find("td:eq(4)").text().replace("$", "").trim()) || null;
                    var payment = parseFloat($(this).find("td:eq(5)").text().replace("$", "").trim()) || null;
                    var outstanding = parseFloat($(this).find("td:eq(6)").text().replace("$", "").trim()) || null;
                    var overpaid = parseFloat($(this).find("td:eq(7)").text().replace("$", "").trim()) || null;

                    // Add data only if it's not empty or zero
                    if (budget !== null && payment !== null) {
                        // Add data for each project
                        combinedChartData.labels.push(projectName);
                        combinedChartData.datasets[0].data.push(budget);
                        combinedChartData.datasets[1].data.push(payment);

                        // Calculate outstanding and overpayments from the table
                        var diff = budget - payment;
                        var outstandingPayment = Math.max(0, diff); // Calculate outstanding payment
                        var overpayment = Math.max(0, -diff); // Calculate overpayment

                        // Add to total outstanding and overpayments
                        totalOutstanding += outstandingPayment;
                        totalOverpayments += overpayment;

                        // Update total variables
                        totalBudget += budget;
                        totalPayments += payment;
                    }
                });

                // Update Combined Chart data
                combinedChart.data = combinedChartData;

                // Update the Combined Chart
                combinedChart.update();

                // Update total amounts in the div elements
                $("#totalBudget").text(
                    "<?= COUNTRY_CURRENCY ?> " +
                    totalBudget.toLocaleString(undefined, {
                        maximumFractionDigits: 2,
                    })
                );
                $("#totalPayments").text(
                    "<?= COUNTRY_CURRENCY ?> " +
                    totalPayments.toLocaleString(undefined, {
                        maximumFractionDigits: 2,
                    })
                );

                // Update outstanding and overpayment in the table
                $("#outstandingPayments").text(
                    "<?= COUNTRY_CURRENCY ?> " +
                    totalOutstanding.toLocaleString(undefined, {
                        maximumFractionDigits: 2,
                    })
                );
                $("#overPayments").text(
                    "<?= COUNTRY_CURRENCY ?> " +
                    totalOverpayments.toLocaleString(undefined, {
                        maximumFractionDigits: 2,
                    })
                );
            }

            // Call the updateChartAndTotals function initially
            updateChartAndTotals();

            // Redraw the chart and update totals whenever the table is drawn (e.g., after filtering)
            $(document).on("draw.dt", "#projectTable", function() {
                updateChartAndTotals();
            });
        });
    </script>



    <!-- pieChart Status -->
    <script>
        $(document).ready(function() {
            // Initial Chart.js setup for Pie Chart
            var pieCtx = document.getElementById("statusPieChart").getContext("2d");
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
                            "rgba(0, 128, 0, 0.8)",
                            // Add more colors as needed
                        ],
                    }],
                },
                options: {
                    // Add your Chart.js options
                },
            });

            // Function to update Pie Chart data based on table data
            function updatePieChart() {
                // Initialize status count object
                var statusCount = {};

                // Iterate over table rows to count project statuses
                $("#projectTable tbody tr").each(function(index) {
                    var status = $(this).find("td:eq(8)").text().trim(); // Assuming Status is in the eighth column (index 7)
                    statusCount[status] = (statusCount[status] || 0) + 1;
                });

                // Update Pie Chart data
                pieChart.data.labels = Object.keys(statusCount);
                pieChart.data.datasets[0].data = Object.values(statusCount);

                // Update the Pie Chart
                pieChart.update();
            }

            // Call the updatePieChart function initially
            updatePieChart();

            // Redraw the chart whenever the table is drawn (e.g., after filtering)
            $(document).on("draw.dt", "#projectTable", function() {
                updatePieChart();
            });
        });
    </script>
    
    <!-- pieChart Funding Source -->
    <script>
        $(document).ready(function() {
            // Initial Chart.js setup for Pie Chart
            var pieCtx = document.getElementById("fundingSourcePieChart").getContext("2d");
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
                            "rgba(0, 128, 0, 0.8)",
                            // Add more colors as needed
                        ],
                    }],
                },
                options: {
                    // Add your Chart.js options
                },
            });

            // Function to update Pie Chart data based on table data
            function updatePieChart() {
                // Initialize status count object
                var statusCount = {};

                // Iterate over table rows to count project statuses
                $("#projectTable tbody tr").each(function(index) {
                    var status = $(this).find("td:eq(3)").text().trim(); // Assuming Status is in the eighth column (index 7)
                    statusCount[status] = (statusCount[status] || 0) + 1;
                });

                // Update Pie Chart data
                pieChart.data.labels = Object.keys(statusCount);
                pieChart.data.datasets[0].data = Object.values(statusCount);

                // Update the Pie Chart
                pieChart.update();
            }

            // Call the updatePieChart function initially
            updatePieChart();

            // Redraw the chart whenever the table is drawn (e.g., after filtering)
            $(document).on("draw.dt", "#projectTable", function() {
                updatePieChart();
            });
        });
    </script>



    <!-- maps coordinates -->
    <script>
        // Initialize Leaflet map
        var map = L.map("map").setView([<?= $org['center_gps_latitude'] ?>, <?= $org['center_gps_longitude'] ?>], <?= $org['center_gps_zoom'] ?>); // Set the initial map view

        // Add OpenStreetMap tile layer to the map
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "© OpenStreetMap contributors",
        }).addTo(map);

        // Function to update the map based on table data
        function updateMap() {
            // Clear previous markers
            map.eachLayer(function(layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            // Iterate over table rows to add markers
            $("#projectTable tbody tr").each(function(index) {
                var coordinates = $(this).find("td:eq(9)").text().trim().split(", "); // Extract coordinates using id="gps"
                var projectName = $(this).find("td:eq(3)").text().trim();
                var budget = $(this).find("td:eq(4)").text().trim();

                // Check if coordinates are available and non-zero
                if (coordinates.length === 2) {
                    var lat = parseFloat(coordinates[0]);
                    var lng = parseFloat(coordinates[1]);

                    if (!isNaN(lat) && !isNaN(lng) && lat !== 0 && lng !== 0) {
                        // Create a marker and add it to the map
                        L.marker([lat, lng])
                            .addTo(map)
                            .bindPopup("Project: " + projectName + "<br>Budget: " + budget);
                    }
                }
            });
        }

        // Call the updateMap function initially
        updateMap();

        // Redraw the map whenever the table is drawn (e.g., after filtering)
        $(document).on("draw.dt", "#projectTable", function() {
            updateMap();
        });
    </script>

    <!-- Export to Excel -->
    <script>
        function exportToExcel(tableId, filename = '<?= $title ?>.xlsx') {
            const table = document.getElementById(tableId);
            const wb = XLSX.utils.table_to_book(table, {
                sheet: "Sheet1"
            });
            return XLSX.writeFile(wb, filename);
        }
    </script>

</div>




<?= $this->endSection(); ?>