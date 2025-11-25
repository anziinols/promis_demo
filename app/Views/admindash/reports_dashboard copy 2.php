<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

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

<!-- Include jQuery and DataTables for table manipulation -->


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
                                    <td id='budget<?= $x ?>'><?= $pro['budget'] ?></td>
                                    <td id='payments<?= $x ?>'><?= $pro['payment_total'] ?></td>
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
                    <div id="totalBudget"></div>
                    <div id="totalPayments"></div>
                    <div id="outstandingPayments"></div>
                    <div id="overPayments"></div>
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



    <!-- Barchart Budget and Payments -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $("#projectTable").DataTable();

            // Initial Chart.js setup for Combined Chart
            var ctx = document.getElementById("projectBarChart").getContext("2d");
            var combinedChart = new Chart(ctx, {
                type: "bar",
                data: {
                    labels: [], // Will be dynamically updated
                    datasets: [{
                            label: "Budget",
                            data: [],
                            type: 'line', // Display as a line chart

                            borderColor: "rgba(255, 99, 132, 0.5)", // budget color
                            backgroundColor: "rgba(0, 0, 0, 0)", // Transparent background
                            yAxisID: 'combined-axis', // Assign to the y-axis
                        },
                        {
                            label: "Payments",
                            data: [],
                            backgroundColor: "rgba(75, 192, 192, 1)", // payments color
                            yAxisID: 'combined-axis', // Assign to the y-axis
                        },
                    ],
                },
                options: {
                    scales: {
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            id: 'combined-axis', // Set the same y-axis ID for both datasets
                            ticks: {
                                display: false // Hide the ticks on the y-axis
                            }
                        },
                    },
                    // Add your Chart.js options
                },
            });

            // Function to update Combined Chart data based on filtered table data
            function updateCombinedChart(table) {
                // Get filtered data from the table
                var filteredData = table.rows({
                    search: "applied"
                }).data().toArray();

                // Initialize data structure for combined chart
                var combinedChartData = {
                    labels: [], // Will be dynamically updated
                    datasets: [{
                            label: "Budget",
                            data: [],
                            type: 'line', // Display as a line chart
                            borderColor: "rgba(255, 99, 132, 0.5)", // budget color
                            backgroundColor: "rgba(0, 0, 0, 0)", // Transparent background
                            yAxisID: 'combined-axis', // Assign to the y-axis
                        },
                        {
                            label: "Payments",
                            data: [],
                            backgroundColor: "rgba(75, 192, 192, 1)", // payments color
                            yAxisID: 'combined-axis', // Assign to the y-axis
                        },
                    ],
                };


                // Reset total variables
                totalBudget = 0;
                totalPayments = 0;

                // Prepare datasets for each project
                filteredData.forEach(function(row) {
                    var projectName = row[2]; // Assuming Project Name is in the second column
                    
                    //var projectName = $(this).find("#name").text().trim() + "";
                    var budget = parseFloat(row[3] || 0); // Add 0 if budget is missing
                    var payment = parseFloat(row[4] || 0); // Add 0 if payment is missing

                   /*
                   var projectName = $("#name" + (index + 1)).text().trim();  
                   var budget = parseFloat($("#budget" + (index + 1)).text().trim()) || 0; // Add 0 if budget is missing
                    var payment = parseFloat($("#payments" + (index + 1)).text().trim()) || 0; // Add 0 if payment is missing */


                    // Add data for each project
                    combinedChartData.labels.push(projectName);
                    combinedChartData.datasets[0].data.push(budget);
                    combinedChartData.datasets[1].data.push(payment);

                    // Update total variables
                    totalBudget += parseFloat(budget);
                    totalPayments += parseFloat(payment);

                    //alert(budget)
                });






                // Update Combined Chart data
                combinedChart.data = combinedChartData;

                // Update the Combined Chart
                combinedChart.update();

                // Update total amounts in the div element
                $("#totalBudget").text("Total Budget: <?= COUNTRY_CURRENCY ?> " + totalBudget.toLocaleString(undefined, {
                    maximumFractionDigits: 2
                }));
                $("#totalPayments").text("Total Payments: <?= COUNTRY_CURRENCY ?> " + totalPayments.toLocaleString(undefined, {
                    maximumFractionDigits: 2
                }));

                // Calculate outstanding payments and overpayment
                var outstandingPayments = totalBudget - totalPayments;
                var overPayment = totalPayments - totalBudget;

                // Update the div elements with the calculated values
                $("#outstandingPayments").text("Outstanding Payments: <?= COUNTRY_CURRENCY ?> " + outstandingPayments.toLocaleString(undefined, {
                    maximumFractionDigits: 2
                }));
                $("#overPayment").text("Overpayment: <?= COUNTRY_CURRENCY ?> " + overPayment.toLocaleString(undefined, {
                    maximumFractionDigits: 2
                }));


            }

            // Call the updateCombinedChart function initially
            updateCombinedChart(table);

            // Redraw the chart whenever the table is drawn (e.g., after filtering)
            table.on("draw", function() {
                updateCombinedChart(table);
            });
        });
    </script>

    <!-- pieChart Status -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $("#projectTable").DataTable();

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
                    var status = row[5]; // Assuming Status is in the fifth column
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

    <!-- barchart Milestones -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $("#projectTable").DataTable();

            // Function to update Chart.js data based on filtered table data
            function updateChart(table) {
                // Get filtered data from the table
                var filteredData = table.rows({
                    search: "applied"
                }).data().toArray();

                // Update Chart.js data
                myChart.data.labels = filteredData.map((row) => row[1]); // Assuming Project Name is in the second column
                myChart.data.datasets = [{
                    label: "Milestones",
                    data: filteredData.map((row) => row[2] - row[3]), // Subtract Payment from Budget for each project
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
                .getElementById("projectBarChartMS")
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
                            label: "Completed Milestones",
                            data: [],
                            backgroundColor: "rgba(75, 192, 192, 0.5)", // Budget color
                        },
                        {
                            label: "Not Completed",
                            data: [],
                            backgroundColor: "rgba(255, 99, 132, 0.5)", // Payments color
                        },
                    ],
                };

                // Prepare datasets for each project
                filteredData.forEach(function(row) {
                    var projectName = row[2]; // Assuming Project Name is in the second column
                    var budget = row[7];
                    var payment = row[8];

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

    <!-- barchart Phases -->
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $("#projectTable").DataTable();

            // Function to update Chart.js data based on filtered table data
            function updateChart(table) {
                // Get filtered data from the table
                var filteredData = table.rows({
                    search: "applied"
                }).data().toArray();

                // Update Chart.js data
                myChart.data.labels = filteredData.map((row) => row[1]); // Assuming Project Name is in the second column
                myChart.data.datasets = [{
                    label: "Milestones",
                    data: filteredData.map((row) => row[2] - row[3]), // Subtract Payment from Budget for each project
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
                .getElementById("projectBarChartPh")
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
                            label: "Completed Phases",
                            data: [],
                            backgroundColor: "rgba(75, 192, 192, 0.5)", // Budget color
                        },
                        {
                            label: "Not Completed",
                            data: [],
                            backgroundColor: "rgba(255, 99, 132, 0.5)", // Payments color
                        },
                    ],
                };

                // Prepare datasets for each project
                filteredData.forEach(function(row) {
                    var projectName = row[2]; // Assuming Project Name is in the second column
                    var budget = row[9];
                    var payment = row[10];

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

    <!-- maps coordinates -->
    <script>
        // Initialize DataTable
        var table = $("#projectTable").DataTable();

        // Initialize Leaflet map
        var map = L.map("map").setView([<?= $org['center_gps_latitude'] ?>, <?= $org['center_gps_longitude'] ?>], <?= $org['center_gps_zoom'] ?>); // Set the initial map view

        // Add OpenStreetMap tile layer to the map
        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "© OpenStreetMap contributors",
        }).addTo(map);

        // Function to update the map based on filtered table data
        function updateMap(table) {
            // Clear previous markers
            map.eachLayer(function(layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            // Get filtered data from the table
            var filteredData = table.rows({
                search: "applied"
            }).data().toArray();

            // Add markers for each project's GPS coordinates
            filteredData.forEach(function(row) {
                var coordinates = row[6].split(", "); // Assuming coordinates are in the sixth column
                var lat = parseFloat(coordinates[0]);
                var lng = parseFloat(coordinates[1]);

                // Check if coordinates are available and non-zero
                if (!isNaN(lat) && !isNaN(lng) && lat !== 0 && lng !== 0) {
                    // Create a marker and add it to the map
                    L.marker([lat, lng])
                        .addTo(map)
                        .bindPopup("Project: " + row[2] + "<br>Budget: " + row[5]);
                }
            });
        }

        // Call the updateMap function initially
        updateMap(table);

        // Redraw the map whenever the table is drawn (e.g., after filtering)
        table.on("draw", function() {
            updateMap(table);
        });
    </script>

</div>




<?= $this->endSection(); ?>