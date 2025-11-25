<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<section class=" container-fluid">
    <div class="row pt-2">
        <div class=" col-12">
            <div class="card ">
                <div class="card-header">
                    Header
                </div>
                <div class="card-body">
                    <table class="table table-dark">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Fund</th>
                                <th>Map</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1;
                            foreach ($projects as $key) : ?>
                                <tr>
                                    <td><?= $x++ ?></td>
                                    <td><?= $key['procode'] ?></td>
                                    <td><?= $key['name'] ?></td>
                                    <td><?= $key['description'] ?></td>
                                    <td><?= $key['fund'] ?></td>
                                    <td><?= $key['mapping'] ?></td>
                                    <td><?= $key['status'] ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>open_projects/<?= $key['procode'] ?>">Open</a> |
                                        <a href="<?= base_url() ?>pro_tasks/<?= $key['procode'] ?>">Milestones</a> |
                                        <a href="<?= base_url() ?>open_proevents/<?= $key['procode'] ?>">Events</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </div>

    <div class="row pt-2">

        <?php $x = 1;
        foreach ($projects as $key) : ?>
            <div class=" col-md-4">
                <div class="card">
                    <div class="card-header bg-dark card-info card-outline">
                        <?= strtoupper($key['name']) ?>
                    </div>
                    <div class="card-body p-0 bg-info">
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
                                <span class="info-box-number"><span class=" font-weight-light">Bgt: </span><span class=" float-right"><?= COUNTRY_CURRENCY ?><?= number_format($key['budget'], 2) ?></span></span>
                                <span class="info-box-number"><span class=" font-weight-light">Pmt: </span> <span class=" float-right"><?= COUNTRY_CURRENCY ?><?= number_format(array_sum($payment), 2) ?></span></span>
                                <span class="info-box-number text-danger"><span class=" font-weight-light ">Bal: </span><span class=" float-right"><?= COUNTRY_CURRENCY ?><?= number_format(($key['budget']- array_sum($payment)), 2) ?></span></span>

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
                    <div class="card-footer text-muted p-1 bg-dark d-flex justify-content-between">
                        <a href="<?= base_url() ?>open_projects/<?= $key['procode'] ?>" class="btn btn-info btn-lg ">Open</a>
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