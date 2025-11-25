<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>
<!-- links -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Projects Dashboad</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Go Back</a></li>
                    <li class="breadcrumb-item active"> Projects Dashboard</li>
                    <li class="breadcrumb-item active"> <button onclick="generatePDF()" class="btn btn-default btn-flat btn-sm float-right"> <i class="fa fa-download" aria-hidden="true"></i> PDF</button></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid mt-1" id="printpdf">

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark ">
                <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                <div class="card-header p-1">
                    <a href="<?= base_url() ?>dashboard" class=" btn btn-light text-dark"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Go Back</a>
                    <span class=" float-right btn btn-dark">Projects Report Dashboard</span>
                </div>
                <div class="card-footer p-1  ">
                    <div class="row">
                        <div class=" col-md-3">
                            <a class="btn btn-block btn-light text-left" href="<?= base_url(); ?>report_projects_status/active">
                                <span class="badge bg-dark float-right"><?= count($pro_active) ?></span>
                                <i class="fas fa-lightbulb"></i> ACTIVE PROJECTS
                            </a>
                        </div>
                        <div class=" col-md-3">
                            <a class="btn btn-light btn-block text-left" href="<?= base_url(); ?>report_projects_status/completed">
                                <span class="badge bg-dark float-right"><?= count($pro_completed) ?></span>
                                <i class="fas fa-check-circle"></i> COMPLETED PROJECTS
                            </a>
                        </div>
                        <div class=" col-md-3">
                            <a class="btn btn-light btn-block text-left" href="<?= base_url(); ?>report_projects_status/hold">
                                <span class="badge bg-dark float-right"><?= count($pro_hold) ?></span>
                                <i class="fas fa-hand"></i> PROJECTS ON-HOLD
                            </a>
                        </div>
                        <div class=" col-md-3">
                            <a class="btn btn-light btn-block text-left" href="<?= base_url(); ?>report_projects_status/all">
                                <span class="badge bg-dark float-right"><?= count($projects) ?></span>
                                <i class="fas fa-circle-notch"></i> ALL PROJECTS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5 class="float-left">Summary Report</h5>
            <div class="float-right"><?= session('orgname') ?></div>
        </div>
    </div>

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
                        <button onclick="paymentPDF()" class="btn btn-default btn-sm float-right"> <i class="fa fa-download" aria-hidden="true"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <?php
                    $outstanding = $pro_total_budget - $pro_total_paid;
                    // Data values 
                    $data_payments = [($pro_total_paid), (($outstanding))];

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

                    <script>
                        function paymentPDF() {

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
                            const list = document.querySelector('#paymentPDF');

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
                                    <?= COUNTRY_CURRENCY ?><?=  number_format($pro_total_outstanding,2) ?></span>
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

    <script>
        function generatePDF() {

            // Options
            var opt = {
                margin: 0.5,
                filename: '<?= $title ?>.pdf',
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
            const list = document.querySelector('#printpdf');

            // Generate PDF from <ul> only  
            html2pdf().from(list).save();

        }
    </script>


</div>




<?= $this->endSection(); ?>