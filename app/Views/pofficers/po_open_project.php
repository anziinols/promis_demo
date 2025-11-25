<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12 d-flex justify-content-between">

                <h4><?= $pro['procode'] . "-" . $pro['name'] ?></h4>

                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="<?= base_url() ?>/po_dash"> <i class="bi bi-chevron-left" ></i>  Dasboard</a>
                    <!-- <a class="breadcrumb-item" href="#"></a> -->
                    <span class="breadcrumb-item active"><?= $pro['procode'] ?></span>
                </nav>

            </div>

        </div>

        <div class="row pb-2">


            <div class="col-md-12">
            
         
            
                <div class="list-group lead">
                    <!--tips: add .list-group-flush to the .list-group to remove some borders and rounded corners-->
                    <a href="<?= base_url() ?>po_details/<?= $pro['ucode'] ?>" class="list-group-item list-group-item-action align-items-center ">
                    <span class=" align-middle"><i class="fas fa-info-circle" aria-hidden="true"></i> <b class="" >Details</b> </span>
                    <span class="btn btn-primary float-right" > <i class="fas fa-angle-double-right" aria-hidden="true"></i> </span>
                    </a>
                    <a href="<?= base_url() ?>po_phases/<?= $pro['ucode'] ?>" class="list-group-item list-group-item-action align-items-center ">
                    <span class=""><i class="fas fa-clipboard-check" aria-hidden="true"></i> <b class="" >Milestones</b>
                        <span class="badge badge-success ml-2"><?= $completedMilestones ?>/<?= $totalMilestones ?></span>
                    </span>
                    <span class="btn btn-primary float-right" > <i class="fas fa-angle-double-right" aria-hidden="true"></i> </span>
                    </a>
                    <a href="<?= base_url(); ?>po_files_open/<?= $pro['ucode'] ?>" class="list-group-item list-group-item-action align-items-center ">
                    <span class=""><i class="fas fa-file-alt" aria-hidden="true"></i> <b class="">Files</b>
                        <span class="badge badge-info ml-2"><?= $totalFiles ?></span>
                    </span>
                    <span class="btn btn-primary float-right" > <i class="fas fa-angle-double-right" aria-hidden="true"></i> </span>
                    </a>
                    <a href="<?= base_url(); ?>po_funding_open/<?= $pro['ucode'] ?>" class="list-group-item list-group-item-action align-items-center">
                    <span class=""><i class="fas fa-dollar-sign" aria-hidden="true"></i> <b class="">Payments</b>
                        <span class="badge badge-success ml-2">Paid: <?= number_format($totalPaid, 2) ?></span>
                        <span class="badge badge-primary ml-1">Budget: <?= number_format($totalBudget, 2) ?></span>
                        <span class="badge badge-<?= $variance >= 0 ? 'warning' : 'danger' ?> ml-1">Balance: <?= number_format($variance, 2) ?></span>
                    </span>
                    <span class="btn btn-primary float-right" > <i class="fas fa-angle-double-right" aria-hidden="true"></i> </span>
                    </a>
                    <a href="<?= base_url(); ?>po_events_open/<?= $pro['ucode'] ?>" class="list-group-item list-group-item-action align-items-center">
                    <span class=""><i class="fas fa-flag-checkered" aria-hidden="true"></i> <b class="">Events</b>
                        <span class="badge badge-info ml-2"><?= $totalEvents ?></span>
                    </span>
                    <span class="btn btn-primary float-right" > <i class="fas fa-angle-double-right" aria-hidden="true"></i> </span>
                    </a>
                    <a href="<?= base_url(); ?>po_reports_open/<?= $pro['ucode'] ?>" class="list-group-item list-group-item-action align-items-center">
                    <span class=""><i class="fas fa-chart-line" aria-hidden="true"></i> <b class="">Report</b> </span>
                    <span class="btn btn-primary float-right" > <i class="fas fa-angle-double-right" aria-hidden="true"></i> </span>
                    </a>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>



</html>
<?= $this->endSection() ?>