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



<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Projects Report</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>report_projects_status/<?= $pro['status'] ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Go Back</a></li>
                    <li class="breadcrumb-item active">Projects Report</li>
                    <li class="breadcrumb-item active"><button onclick="reportPDF()" class="btn btn-default btn-sm"> <i class="fa fa-download" aria-hidden="true"></i> PDF</button></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid" id="reportPDF">


    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark ">
                <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                <div class="card-header p-1">
                    <a href="<?= base_url() ?>report_projects_status/<?= $pro['status'] ?>" class=" btn btn-light text-dark"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Go Back</a>
                    <span class=" float-right btn btn-dark">Project Report as at <?= date('d M Y H:ia') ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5 class="float-left">Report</h5>
            <div class="float-right"><?= session('orgname') ?></div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-info">
                <span class=" text-left"><b>Create:</b> <?= datetimeforms($pro['create_at']) ?>/<?= $pro['create_by'] ?></span>
                <span class=" float-right"><b>Update:</b> <?= datetimeforms($pro['update_at']) ?>/<?= $pro['update_by'] ?></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                    Project Information
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <label for="my-input">Pro.Code: </label>
                            <span class=" float-right"><?= $pro['procode'] ?></span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Pro.Date: </label>
                            <span class=" float-right"><?= dateforms($pro['pro_date']) ?></span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Name: </label>
                            <span class=" float-right"><?= $pro['name'] ?></span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Description: </label>
                            <span class=" float-right"><?= $pro['description'] ?></span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Pro.Site: </label>
                            <span class=" float-right">
                                <?= $pro['pro_site'] ?></span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Loc. Address: </label>
                            <span class=" float-right"><?php if (!empty($get_llg)) {
                                                            echo $get_llg['name'] . ', ';
                                                        } ?>
                                <?= $get_district['name'] ?>,<?= $get_province['name'] ?>, <?= $get_country['name'] ?>,</span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Loc. GPS: </label>
                            <span class=" float-right">
                                <small><em>Lat: </em></small><?= $pro['lat'] ?> <small><em>Lon: </em></small><?= $pro['lon'] ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-info">
                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                    Project Details
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 ">
                            <label for="my-input">Pro.Budget: </label>
                            <span class=" float-right"><?= COUNTRY_CURRENCY ?><?= number_format($pro['budget'], 2) ?></span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Funding Source: </label>
                            <span class=" float-right"><?= strtoupper($pro['fund']) ?></span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Pro.Officer: </label>
                            <span class=" float-right"><?= ($pro['pro_officer_name']) ?></span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Pro.Officer Scope: </label>
                            <span class=" float-right"><?= ($pro['pro_officer_scope']) ?></span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Contractor: </label>
                            <span class=" float-right"><?= $pro['contractor_name'] ?></span>
                            <span class=" float-right">
                                <a class=" p-2" href="<?= base_url() ?><?= $pro['contract_file'] ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                            </span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Status: </label>
                            <span class=" float-right"><?= strtoupper($pro['status']) ?></span>
                        </div>
                        <div class="col-md-12 ">
                            <label for="my-input">Status Notes: </label>
                            <span class=" float-right"><?= ($pro['statusnotes']) ?></span>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <!-- ./row -->

    <div class="row">
        <div class="col-md-4">
            <div class="card" id='paymentPDF'>
                <div class="card-header bg-info">
                    <h3 class="card-title"> <i class="fas fa-dollar-sign    "></i> Projects Payments</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <?php
                    $outstanding = $pro['budget'] - $pro_total_paid;
                    // Data values 
                    if ($outstanding <= 0) {
                        $outstanding = 0;
                    }
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

                </div>
                <!-- /.card-body -->
                <div class="card-footer p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Total Budgeted
                                <span class="float-right text-primary">
                                    <?= COUNTRY_CURRENCY ?><?= number_format($pro['budget'], 2) ?></span>
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
                                    <?= COUNTRY_CURRENCY ?><?= number_format($outstanding, 2) ?></span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Total OverPaid
                                <span class="float-right text-danger">
                                    <?= COUNTRY_CURRENCY ?>
                                    <?php
                                    $overpaid = $pro['budget'] - $pro_total_paid;
                                    if ($overpaid <= 0) {
                                        echo number_format(-$overpaid, 2);
                                    } else {
                                        echo 0;
                                    }
                                    ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <em>Procode:
                                    <span class="float-right text-dark">
                                        <?= $pro['procode'] ?>
                                    </span></em>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- /.footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
            <div class="card" id="msPDF">
                <div class="card-header bg-info">
                    <h3 class="card-title"> <i class="fas fa-clipboard-check    "></i> Projects Milestones</h3>

                    <div class="card-tools">

                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <?php
                    // Data values 
                    $data_milestone = [count($pro_ms_pending), count($pro_ms_completed), count($pro_ms_hold)];

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

                </div>
                <!-- /.card-body -->
                <div class="card-footer p-0">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Pending
                                <span class="float-right text-primary">
                                    <?= count($pro_ms_pending) ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Completed
                                <span class="float-right text-success">
                                    <?= count($pro_ms_completed) ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                Hold
                                <span class="float-right text-warning">
                                    <?= count($pro_ms_hold) ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link text-bold">
                                Total
                                <span class="float-right ">
                                    <?= $total_ms = count($milestones) ?></span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <em>Procode:
                                    <span class="float-right text-dark">
                                        <?= $pro['procode'] ?>
                                    </span></em>
                            </a>
                        </li>

                    </ul>
                </div>
                <!-- /.footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
            <div class="card" id="msPDF">
                <div class="card-header bg-info">
                    <h3 class="card-title"> <i class="fas fa-flag-checkered"></i> Projects Phases</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <?php
                    // Data labels
                    $labels_milephase = "";

                    $data_milephase_pending = $data_milephase_completed = $data_milephase_hold = "";

                    //echo "--- ECHOO::". count($phases);
                    foreach ($phases as $ph) {
                        $milephase_pending = $milephase_completed = $milephase_hold = 0;
                        $labels_milephase .= "'" . $ph['phases'] . "',";
                        foreach ($milestones as $ms) {
                            if ($ms['phase_id'] == $ph['id']) {
                                if ($ms['checked'] == 'completed') {
                                    $milephase_completed++;
                                }
                                if ($ms['checked'] == 'pending') {
                                    $milephase_pending++;
                                }
                                if ($ms['checked'] == 'hold') {
                                    $milephase_hold++;
                                }
                            }
                        }
                        $data_milephase_pending .= ($milephase_pending) . ',';
                        $data_milephase_completed .= ($milephase_completed) . ',';
                        $data_milephase_hold .= ($milephase_hold) . ',';
                    }
                    //echo $labels_milephase;
                    // echo $data_milephase_pending;
                    ?>

                    <canvas id="barChart_milephase" style="max-width:100%; height:300px"></canvas>

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
                                    }, {
                                        label: 'Completed',
                                        data: [<?= $data_milephase_completed ?>],
                                        backgroundColor: '#28a745'
                                    },
                                    {
                                        label: 'Hold',
                                        data: [<?= $data_milephase_hold ?>],
                                        backgroundColor: '#ffc107'
                                    }
                                ]
                            },
                            options: {
                                title: {
                                    display: false,
                                    text: 'Stacked Bar Chart'
                                },
                                tooltips: {
                                    mode: 'index',
                                    intersect: false
                                },
                                responsive: true,
                                scales: {
                                    xAxes: [{
                                        stacked: true,
                                    }],
                                    yAxes: [{
                                        stacked: true
                                    }]
                                }
                            }
                        });
                    </script>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <?php if (!empty($milestones_last['update_at'])) : ?>
                        <b class=" text-muted">Last Update:</b>
                        <span class=" float-right"><?= datetimeforms($milestones_last['update_at']) ?>/<?= $milestones_last['update_by'] ?></span>
                    <?php endif; ?>
                    <br>
                    <em class="text-muted">Procode:
                        <span class="float-right text-dark">
                            <?= $pro['procode'] ?>
                        </span></em>


                </div>
                <!-- /.footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

    </div>
    <!-- /.row -->


    <div class="row">
        <div class="col-md-12">
            <!-- Info boxes -->
            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                    <tr class="">
                                        <th scope="row">T.Budgeted</th>
                                        <th>T.Paid</th>
                                        <th>T.Outstanding</th>
                                        <th>T.OverPaid</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td scope="row"><b><?= COUNTRY_CURRENCY . number_format($pro['budget'], 2) ?></b></td>
                                        <td scope="row"><b><?= COUNTRY_CURRENCY . number_format($pro_total_paid, 2) ?></b></td>
                                        <td scope="row">
                                            <b><?php $outstanding = (($pro['budget']) - ($pro_total_paid));
                                                echo COUNTRY_CURRENCY . number_format($outstanding, 2)
                                                ?></b>
                                        </td>
                                        <td scope="row"><b>
                                                <?php
                                                if ($outstanding < 0) {
                                                    echo COUNTRY_CURRENCY . number_format(-$outstanding, 2);
                                                } else {
                                                    echo 0;
                                                }
                                                ?></b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <em class="text-muted">Procode:
                                <span class="float-right text-dark">
                                    <?= $pro['procode'] ?>
                                </span>
                            </em>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.row -->
        </div>
    </div>
    <!-- ./row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <i class="fas fa-file-alt"></i>
                    Project Files
                </div>
                <div class="card-body p-0 table-responsive-md">
                    <table class="table table-bordered text-nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>File Name</th>
                                <th>Create</th>
                                <th>Update</th>
                                <th>Files</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $pplus = 1;
                            $pay = array();
                            foreach ($pro_files as $pf) : ?>
                                <tr>
                                    <td><?= $pplus++ ?></td>
                                    <td><?= ($pf['name']) ?></td>
                                    <td><?= datetimeforms($pf['create_at']) ?>/ <?= ($pf['create_by']) ?></td>
                                    <td><?= datetimeforms($pf['update_at']) ?>/ <?= ($pf['update_by']) ?></td>
                                    <td><a href="<?= base_url() ?><?= ($pf['filepath']) ?>"> <i class="fa fa-download" aria-hidden="true"></i> (.<?= getfileExtension($pf['filepath']) ?>) </a></td>

                                </tr>
                            <?php
                            endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <em class="text-muted">Procode:
                        <span class="float-right text-dark">
                            <?= $pro['procode'] ?>
                        </span>
                    </em>
                </div>
            </div>
        </div>
    </div>
    <!-- ./row -->


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <i class="fas fa-dollar-sign    "></i>
                    Payment History
                    <span class=" float-right"><b>Budget: </b><?= COUNTRY_CURRENCY ?> <?= number_format($pro['budget']) ?></span>
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
                                        echo number_format($py['amount'], 2);
                                        $pay[] = ($py['amount']);
                                        ?></td>
                                    <td><?= $py['description'] ?>
                                        <a href="#" class=" float-right btn-default btn-sm"> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>
                        <tfoot class=" font-weight-bold">
                            <tr>
                                <td colspan="2">Total Payment</td>
                                <td><?= number_format(array_sum($pay), 2) ?></td>
                                <td>Total Outstanding: (<?= number_format($pro['budget'], 2) ?> - <?= number_format(array_sum($pay), 2) ?>) = <span class=" font-weight-bold float-right">
                                        <?= COUNTRY_CURRENCY ?> <?= $outstanding =  number_format($pro['budget'] - array_sum($pay)) ?>
                                        <?php
                                        if ($outstanding < 0) {
                                            echo "(Overpaid)";
                                        }
                                        ?>
                                    </span></td>
                            </tr>
                        </tfoot>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <em class="text-muted">Procode:
                        <span class="float-right text-dark">
                            <?= $pro['procode'] ?>
                        </span>
                    </em>
                </div>
            </div>
        </div>
    </div>
    <!-- ./row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <i class="fas fa-clipboard-check    "></i>
                    Phases and Milestones
                </div>
                <div class="card-body p-0 table-responsive-md">
                    <table class="table table-bordered text-nowrap ">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Milestones</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Remarks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $pplus = 1;
                            foreach ($phases as $ph) : ?>
                                <tr>
                                    <td colspan="5"><?= $pplus; ?>. <?= $ph['phases']; ?></td>
                                </tr>
                                <?php $msplus = 1;
                                foreach ($milestones as $ms) :
                                    if ($ms['phase_id'] == $ph['id']) :
                                ?>
                                        <tr>
                                            <td><?= $pplus ?>.<?= $msplus++ ?> </td>
                                            <td><?= $ms['milestones'] ?></td>
                                            <td><?= $ms['checked'] ?></td>
                                            <td><?= dateforms($ms['update_at']) ?></td>
                                            <td><?= $ms['notes'] ?>
                                                <a href="#" class=" float-right btn-default btn-sm"> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                    endif;
                                endforeach; ?>
                            <?php $pplus++;
                            endforeach; ?>


                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <em class="text-muted">Procode:
                        <span class="float-right text-dark">
                            <?= $pro['procode'] ?>
                        </span>
                    </em>
                </div>
            </div>
        </div>
    </div>
    <!-- ./row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <i class="fas fa-calendar-check   "></i>
                    Events
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
                                    <td><?= $ev['event'] ?>
                                        <a href="#" class=" float-right btn-default btn-sm"> <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            <?php
                            endforeach; ?>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <em class="text-muted">Procode:
                        <span class="float-right text-dark">
                            <?= $pro['procode'] ?>
                        </span>
                    </em>
                </div>
            </div>
        </div>
    </div>
    <!-- ./row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header ">
                    <i class="fa fa-map-marker-alt" aria-hidden="true"></i>
                    Site GPS Location
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
                                    // Only display tracks
                                    if (feature.getGeometry().getType() === "LineString") {
                                        return new ol.style.Style({
                                            stroke: new ol.style.Stroke({
                                                color: "red",
                                                width: 2,
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
                                    src: "<?= base_url() ?>public/assets/system_img/marker-map.png",
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
                                zoom: 15,
                            }),
                        });
                    </script>

                    <!-- 
                        End extract kml files to Map
                     -->
                </div>
                <div class="card-footer">
                    <em class="text-muted">Procode:
                        <span class="float-right text-dark">
                            <?= $pro['procode'] ?>
                        </span>
                    </em>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <script>
        function reportPDF() {

            // Options
            var opt = {
                margin: 0.5,
                filename: '<?= $pro['procode'] ?>_report.pdf',
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
            const list = document.querySelector('#reportPDF');

            // Generate PDF from <ul> only  
            html2pdf().from(list).save();

        }
    </script>


</div>




<?= $this->endSection(); ?>