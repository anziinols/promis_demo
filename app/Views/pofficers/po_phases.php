<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12 d-flex justify-content-between">

                <h4><?= $pro['procode'] . "-" . $pro['name'] ?></h4>

                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="<?= base_url() ?>po_open_project/<?= $pro['ucode'] ?>"> Go Back</a>
                    <!-- <a class="breadcrumb-item" href="#"></a> -->
                    <span class="breadcrumb-item active"><?= $pro['procode'] ?></span>
                </nav>

            </div>

        </div>

        <div class="row pb-2">
            <div class="col-md-12">
                <h5 class="text-center">PHASES</h5>
            </div>
        </div>
        <div class="row pb-2">
            <div class="col-md-12">
                <?php foreach ($phases as $ph) : ?>
                    <h5><?= $ph['phases'] ?>
                        <?php
                        $all = $comp = 0;
                        foreach ($milestones as $ms) :
                            if ($ms['phase_id'] == $ph['id']) :
                                $all++;
                                // Check both status and checked fields
                                $currentStatus = !empty($ms['status']) ? strtolower($ms['status']) : strtolower($ms['checked']);
                                if ($currentStatus == "completed") {
                                    $comp++;
                                }
                            endif;
                        endforeach;
                        ?>
                        <?= $comp . "/" . $all ?>
                    </h5>
                    <div class="list-group">
                        <!--tips: add .list-group-flush to the .list-group to remove some borders and rounded corners-->
                        <?php
                        foreach ($milestones as $ms) :
                            if ($ms['phase_id'] == $ph['id']) :
                                $bg = "";
                                $icon = "";

                                // Get status from either 'status' or 'checked' field
                                $currentStatus = !empty($ms['status']) ? strtolower($ms['status']) : strtolower($ms['checked']);

                                if ($currentStatus == "completed") {
                                    $bg = "bg-success text-light ";
                                    $icon = "<i class='fa fa-check-circle'></i>";
                                }
                                if ($currentStatus == "halted" || $currentStatus == "hold") {
                                    $bg = "bg-warning text-dark ";
                                    $icon = "<i class='fas fa-exclamation-triangle'></i>";
                                }
                                if ($currentStatus == "pending") {
                                    $bg = "bg-secondary text-light ";
                                    $icon = "<i class='fas fa-clock'></i>";
                                }
                                if ($currentStatus == "canceled") {
                                    $bg = "bg-danger text-light ";
                                    $icon = "<i class='fas fa-times-circle'></i>";
                                }
                        ?>
                                <a href="<?= base_url() ?>/po_milestones/<?= $ms['ucode'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center <?= $bg ?> ">
                                    <?= $icon ?> <?= $ms['milestones'] ?>
                                    <span class="badge badge-primary badge-pill"><?= $ms['checked'] ?></span>
                                </a>

                        <?php
                            endif;
                        endforeach; ?>
                    </div>
                    <hr>
                <?php endforeach; ?>
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