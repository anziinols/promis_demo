<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>



<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">Projects List</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard"><i class="fa fa-tachometer-alt" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">Project List</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class=" container-fluid">
    
    <div class="row pt-2">

        <?php $x = 1;
        foreach ($projects as $key) : ?>
            <div class=" col-md-4">
                <div class="card shadow ">
                    <div class="card-header bg-dark card-info card-outline">
                        <?= strtoupper($key['name']) ?>
                    </div>
                    <div class="card-body p-0 bg-dark">
                        <div class="info-box bg-gradient-light">
                            <span class="info-box-icon bg-dark"><?= $key['fund'] ?></span>

                            <div class="info-box-content">
                                <span class="info-box-text"><?= $key['procode'] ?></span>
                                <?php
                                $payment = array();
                                foreach ($fund as $fd) : ?>
                                    <?php
                                    if ($key['procode'] == $fd['procode']) {
                                        $payment[] = $fd['amount'];
                                    }
                                    ?>
                                <?php endforeach; ?>
                                <span class="info-box-number"><span class=" ">Bgt: </span><span class=" float-right"><?= COUNTRY_CURRENCY ?><?= number_format($key['budget'], 2) ?></span></span>
                                <span class="info-box-number"><span class="">Pmt: </span> <span class=" float-right"><?= COUNTRY_CURRENCY ?><?= number_format(array_sum($payment), 2) ?></span></span>
                                <span class="info-box-number text-danger"><span class="  ">Bal: </span><span class=" float-right"><?= COUNTRY_CURRENCY ?><?= number_format(($key['budget']- array_sum($payment)), 2) ?></span></span>

                                <div class="progress">
                                    <div class="progress-bar bg-danger" style="width: 40%"></div>
                                </div>
                                <span class="progress-description">
                                    70% Milestones Completed
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="card-footer text-muted pt-0 mb-1 bg-dark d-flex justify-content-between">
                        <a href="<?= base_url() ?>open_projects/<?= $key['procode'] ?>" class="btn btn-info btn-lg">Open</a>
                        <a href="<?= base_url() ?>milestones/<?= $key['procode'] ?>" class="btn btn-info btn-lg ">Milestones</a>
                        <a href="<?= base_url() ?>open_proevents/<?= $key['procode'] ?>" class="btn btn-info btn-lg float-right">Events</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</section>




</body>


<?= $this->endSection() ?>