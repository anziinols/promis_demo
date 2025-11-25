<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>


<div class="container-fluid" id="reportPDF">

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark ">
                <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                <div class="card-header p-1">
                    <a href="<?= base_url() ?>report_projects_status/all" class=" btn btn-light text-dark"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Go Back</a>
                    <span class=" float-right btn btn-dark">Payment Record</span>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5 class="float-left"><?= $pro['name'] ?></h5>
            <div class="float-right"><?= session('orgname') ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-body">
                    <h5 class="card-title"><?= COUNTRY_CURRENCY .number_format(checkZero($pay['amount']),2) ?></h5>
                    <p class="card-text"><?= $pay['description'] ?></p>
                    <a href="<?= filecheck($pay['filepath']) ?>" class="btn btn-primary"><i class="fa fa-download" aria-hidden="true"></i></a>
                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            
        </div>
    </div>
    <!-- ./row -->







</div>




<?= $this->endSection(); ?>