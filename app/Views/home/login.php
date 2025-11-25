<?= $this->extend("templates/nolstemp"); ?>
<?= $this->section('content'); ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="fas fa-lock me-2"></i>Login to PROMIS</h4>
                </div>
                <div class="card-body p-4">
                    <?php if (session()->has('error')) : ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-triangle me-2"></i> <?= session('error') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <div class="d-grid gap-3 mb-3">
                        <button type="button" class="btn btn-primary btn-lg d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#officersModal">
                            <span><i class="fas fa-user-tie me-2"></i>Project Officers Login</span>
                            <i class="fas fa-sign-in-alt"></i>
                        </button>
                        
                        <button type="button" class="btn btn-dark btn-lg d-flex justify-content-between align-items-center" data-bs-toggle="modal" data-bs-target="#adminModal">
                            <span><i class="fas fa-user-shield me-2"></i>Administrators Login</span>
                            <i class="fas fa-sign-in-alt"></i>
                        </button>
                    </div>

                    <div class="text-center text-muted">
                        <small>Select the appropriate login option above</small>
                    </div>
                </div>
            </div>

            <!-- Admin Login Info Card -->
            <div class="card mt-4 border-0 bg-light">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-info-circle fa-2x text-primary"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Need Help?</h6>
                            <p class="mb-0 small">Contact your system administrator for login assistance or visit the <a href="<?= base_url() ?>about">About page</a> for more information.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Administrators Modal -->
<div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="adminModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="adminModalLabel"><i class="fas fa-user-shield me-2"></i>Administrators Login</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <?= form_open('login') ?>
                <div class="mb-3">
                    <label for="adminUsername" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="adminUsername" required name="username" placeholder="Enter your username">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="adminPassword" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" id="adminPassword" required name="password" placeholder="Enter your password">
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-dark btn-lg">Login <i class="fas fa-sign-in-alt ms-2"></i></button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<!-- Project Officers Modal -->
<div class="modal fade" id="officersModal" tabindex="-1" aria-labelledby="officersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="officersModalLabel"><i class="fas fa-user-tie me-2"></i>Project Officers Login</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <?= form_open('login_po') ?>
                <div class="mb-3">
                    <label for="officerUsername" class="form-label">Username</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" id="officerUsername" required name="username" placeholder="Enter your username">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="officerPassword" class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                        <input type="password" class="form-control" id="officerPassword" required name="password" placeholder="Enter your password">
                    </div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg">Login <i class="fas fa-sign-in-alt ms-2"></i></button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>