<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Header -->
    <div class="card bg-primary text-white shadow mb-4">
        <div class="card-body px-3 px-md-4 py-3">
            <div class="row align-items-center flex-wrap">
                <div class="col-12 col-md-8 mb-3 mb-md-0">
                    <h2 class="mb-2"><i class="fas fa-user-cog me-2"></i>My Account</h2>
                    <p class="mb-0">Manage your organization profile and settings</p>
                </div>
                <div class="col-12 col-md-4 text-md-end">
                    <a href="<?= base_url() ?>dashboard" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Organization Information Card -->
        <div class="col-12 col-lg-8 mb-4">
            <div class="card border-0 shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-building me-2"></i>Organization Information</h5>
                </div>
                <?= form_open('update_admin_orginfo', ['id' => 'orgInfoForm']) ?>
                <div class="card-body px-3 px-md-4">
                    <div class="row">
                        <div class="col-12 col-md-3 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-barcode me-2"></i>Organization Code
                            </label>
                            <input type="text" class="form-control" value="<?= $myacc ? esc($myacc['orgcode']) : '' ?>" disabled>
                        </div>
                        <div class="col-12 col-md-9 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-building me-2"></i>Organization Name
                            </label>
                            <input type="text" name="name" class="form-control" value="<?= $myacc ? esc($myacc['name']) : '' ?>" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label fw-bold">
                                <i class="fas fa-align-left me-2"></i>Brief Description
                            </label>
                            <textarea name="description" rows="4" class="form-control"><?= $myacc ? esc($myacc['description']) : '' ?></textarea>
                        </div>

                        <!-- Location Details Section -->
                        <div class="col-12">
                            <div class="border-top pt-4 mt-3 mb-3">
                                <h6 class="fw-bold text-muted">
                                    <i class="fas fa-map-marker-alt me-2"></i>Location Details
                                </h6>
                            </div>
                        </div>

                        <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <label class="form-label fw-bold">Country</label>
                            <input type="text" class="form-control" value="<?= $set_country ? esc($set_country['name']) : 'Not set' ?>" disabled>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <label class="form-label fw-bold">Province</label>
                            <input type="text" class="form-control" value="<?= $get_province ? esc($get_province['name']) : 'Not set' ?>" disabled>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <label class="form-label fw-bold">District</label>
                            <input type="text" class="form-control" value="<?= $get_district ? esc($get_district['name']) : 'Not set' ?>" disabled>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mb-3">
                            <label class="form-label fw-bold">LLG</label>
                            <input type="text" class="form-control" value="<?= $get_llg ? esc($get_llg['name']) : 'Not set' ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light border-top text-end">
                    <input type="hidden" name="id" value="<?= $myacc ? $myacc['id'] : '' ?>">
                    <input type="hidden" name="concode" value="<?= $myacc ? $myacc['orgcode'] : '' ?>">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
                <?= form_close() ?>
            </div>
        </div>

        <!-- Logo Card -->
        <div class="col-12 col-lg-4 mb-4">
            <div class="card border-0 shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-image me-2"></i>Organization Logo</h5>
                </div>
                <div class="card-body px-3 px-md-4">
                    <div class="bg-light border border-2 border-dashed rounded p-4 mb-3 d-flex align-items-center justify-content-center" style="min-height: 250px;">
                        <img src="<?= imgcheck($myacc ? $myacc['orglogo'] : '') ?>" alt="Organization Logo" id="logoPreview" class="img-fluid rounded" style="max-height: 220px; object-fit: contain;">
                    </div>
                    <button type="button" class="btn btn-outline-primary w-100" data-bs-toggle="modal" data-bs-target="#edit_logo">
                        <i class="fas fa-pen me-2"></i>Change Logo
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Administrators Card -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-user-shield me-2"></i>System Administrators</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th><i class="fas fa-user me-2"></i>Name</th>
                                    <th><i class="fas fa-at me-2"></i>Username</th>
                                    <th><i class="fas fa-user-tag me-2"></i>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($admins)): ?>
                                    <?php $x = 1; foreach ($admins as $ad): ?>
                                        <tr>
                                            <td class="fw-bold text-muted"><?= $x++ ?></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 40px; height: 40px;">
                                                        <?= strtoupper(substr(esc($ad['name']), 0, 1)) ?>
                                                    </div>
                                                    <span class="fw-medium"><?= esc($ad['name']) ?></span>
                                                </div>
                                            </td>
                                            <td class="text-muted"><?= esc($ad['username']) ?></td>
                                            <td>
                                                <span class="badge bg-primary rounded-pill">
                                                    <?= esc($ad['role']) ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-5">
                                            <i class="fas fa-users-slash fa-3x mb-3 d-block text-muted" style="opacity: 0.3;"></i>
                                            <p class="text-muted mb-0">No administrators found</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Logo Upload Modal -->
<div class="modal fade" id="edit_logo" tabindex="-1" aria-labelledby="editLogoTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-edit me-2"></i>Change Organization Logo
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open_multipart('update_admin_orglogo') ?>
            <div class="modal-body p-4">
                <div class="mb-3">
                    <label for="logoFileInput" class="form-label fw-bold">Select Logo File</label>
                    <input type="file" class="form-control" name="logo_file" id="logoFileInput" accept="image/*" required>
                    <small class="form-text text-muted mt-2">
                        <i class="fas fa-info-circle me-1"></i>Accepted formats: JPG, PNG, GIF (Max 2MB)
                    </small>
                </div>
            </div>
            <div class="modal-footer border-0">
                <input type="hidden" name="id" value="<?= $myacc ? $myacc['id'] : '' ?>">
                <input type="hidden" name="concode" value="<?= $myacc ? $myacc['orgcode'] : '' ?>">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-upload me-1"></i>Upload Logo
                </button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Form validation
    $('#orgInfoForm').on('submit', function(e) {
        var name = $('input[name="name"]').val().trim();
        if (name === '') {
            e.preventDefault();
            toastr.error('Organization name is required');
            $('input[name="name"]').focus();
            return false;
        }
    });
});
</script>

<?= $this->endSection(); ?>
