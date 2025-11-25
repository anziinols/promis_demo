<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid">
        <div class="row p-2">
            <div class="col-12 d-flex justify-content-between">
                <h4>Notifications Archive</h4>
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="<?= base_url() ?>po_dash">Dashboard</a>
                    <span class="breadcrumb-item active">Notifications Archive</span>
                    <a class="breadcrumb-item text-danger text-bold" href="<?= base_url() ?>"> Logout </a>
                </nav>
            </div>
        </div>

        <div class="row pt-2 pb-2">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-secondary text-light d-flex justify-content-between align-items-center">
                        <span><i class="fas fa-archive mr-2"></i>READ NOTIFICATIONS</span>
                        <div>
                            <span class="badge badge-light text-dark"><?= count($notifications) ?></span>
                            <a href="<?= base_url() ?>po_dash" class="btn btn-sm btn-light ml-2">
                                <i class="fas fa-arrow-left mr-1"></i>Back to Dashboard
                            </a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <?php if (empty($notifications)): ?>
                            <div class="p-4 text-center text-muted">
                                <i class="fas fa-inbox fa-3x mb-3"></i>
                                <p>No archived notifications</p>
                            </div>
                        <?php else: ?>
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
                                                <span class="badge badge-success ml-2">Read</span>
                                            </h6>
                                            <small class="text-muted">
                                                Sent: <?= date('M d, Y', strtotime($notification['create_at'])) ?>
                                            </small>
                                        </div>
                                        <p class="mb-1"><?= esc($notification['message']) ?></p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <small class="text-muted">
                                                <i class="fas fa-user mr-1"></i>From: <?= esc($notification['create_by']) ?>
                                            </small>
                                            <small class="text-muted">
                                                <i class="fas fa-check-circle mr-1"></i>Read on: <?= date('M d, Y h:i A', strtotime($notification['update_at'])) ?>
                                            </small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
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

