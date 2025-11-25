<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid">
        <div class="row  p-2">
            <div class="col-12 d-flex justify-content-between">

                <h4>Dashboard</h4>

                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="#"></a>
                    
                    <span class="breadcrumb-item active">Dashboard</span>
                    <a class="breadcrumb-item text-danger text-bold" href="<?= base_url() ?>"> Logout </a>
                </nav>

            </div>

        </div>

        <div class="row pt-2 pb-2">

            <!-- Notifications Section -->
            <?php if (!empty($notifications)): ?>
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-bell mr-2"></i>NOTIFICATIONS</span>
                        <div>
                            <span class="badge badge-dark mr-2"><?= count($notifications) ?></span>
                            <a href="<?= base_url() ?>notifications_archive" class="btn btn-sm btn-dark">
                                <i class="fas fa-archive mr-1"></i>View Archive
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group">
                            <?php foreach ($notifications as $notification): ?>
                                <div class="list-group-item">
                                    <div class="d-flex w-100 justify-content-between align-items-start">
                                        <h6 class="mb-1 font-weight-bold">
                                            <?php
                                            $priorityClass = 'secondary';
                                            $priorityIcon = 'info-circle';
                                            if ($notification['priority'] == 'high') {
                                                $priorityClass = 'warning';
                                                $priorityIcon = 'exclamation-triangle';
                                            }
                                            if ($notification['priority'] == 'urgent') {
                                                $priorityClass = 'danger';
                                                $priorityIcon = 'exclamation-circle';
                                            }
                                            ?>
                                            <i class="fas fa-<?= $priorityIcon ?> text-<?= $priorityClass ?> mr-2"></i>
                                            <?= esc($notification['title']) ?>
                                        </h6>
                                        <small class="text-muted"><?= date('M d, Y', strtotime($notification['create_at'])) ?></small>
                                    </div>
                                    <p class="mb-1"><?= esc($notification['message']) ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-user mr-1"></i>From: <?= esc($notification['create_by']) ?>
                                        </small>
                                        <a href="<?= base_url() ?>mark_notification_read/<?= $notification['id'] ?>" class="btn btn-sm btn-success">
                                            <i class="fas fa-check mr-1"></i>Mark as Read
                                        </a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Projects Section -->
            <div class="col-md-12">


                <div class="card">
                    <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                    <div class="card-header bg-primary text-light">
                        MY PROJECTS
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group">
                            <?php foreach ($projects as $pro) : ?>
                                <a href="<?= base_url() ?>po_open_project/<?= $pro['ucode'] ?>" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center lead">
                                    <span class=""><?= $pro['name'] ?></span>

                                    <?= get_status_icon($pro['status']) ?>
                                    <span class="btn btn-primary">OPEN</span>
                                </a>
                            <?php endforeach; ?>
                        </div>
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