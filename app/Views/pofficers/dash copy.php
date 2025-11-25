<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid">
        <div class="row  p-2">
            <div class="col-12 d-flex justify-content-between">

                <h4>Dashboard</h4>

                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="#"></a>
                    <!-- <a class="breadcrumb-item" href="#"></a> -->
                    <span class="breadcrumb-item active">Dashboard</span>
                </nav>

            </div>

        </div>

        <div class="row pt-2 pb-2">


            <div class="col-md-6">

                
                <div class="card">
                    <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                    <div class="card-header bg-primary text-light">
                        MY ACTIVE PROJECTS
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group">
                            <?php foreach ($projects as $pro) : ?>
                                <a href="<?= base_url() ?>po_open_project/<?= $pro['ucode'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center lead">
                                    <span class=""><?= $pro['name'] ?></span>
                                    <?php
                                    $allms = $compms = 0;
                                    foreach ($milestones as $ms) {
                                        if ($ms['procode'] == $pro['procode']) {
                                            $allms++;
                                            if ($ms['checked'] == "completed") {
                                                $compms++;
                                            }
                                        }
                                    }
                                    ?>
                                    <span class="badge badge-primary badge-pill">
                                        <?php
                                        echo $pcget = ($compms / $allms) * 100;
                                        ?>%
                                    </span>
                                    <span class="btn btn-primary">OPEN</span>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        Footer
                    </div>
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