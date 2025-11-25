<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">
                    <i class="fas fa-user-tie text-primary me-2"></i>
                    Edit Project Officer
                </h1>
                <p class="text-muted mb-0"><?= $pro['name'] ?></p>
                <small class="badge bg-primary"><?= $pro['procode'] ?></small>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url() ?>open_projects/<?= $pro['ucode'] ?>">
                            <i class="fa fa-arrow-circle-left me-1"></i> View Project
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Edit Officer</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Edit Form Column -->
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-edit me-2"></i>Update Officer Assignment
                        </h5>
                    </div>
                    
                    <?= form_open_multipart("update_projects_officers", ['id' => 'officerForm']) ?>
                    <div class="card-body p-4">
                        <!-- Project Officer Selection -->
                        <div class="mb-4">
                            <label for="project_officers" class="form-label fw-bold">
                                <i class="fas fa-user-shield text-primary me-2"></i>Select Project Officer
                            </label>
                            <select class="form-select form-select-lg" name="project_officers" id="project_officers" required>
                                <option selected value="<?= $pro['pro_officer_id'] ?>">
                                    <?= $pro['pro_officer_name'] ?> (Current Officer)
                                </option>
                                <?php foreach ($pro_officers as $po) : ?>
                                    <option value="<?= $po['id'] ?>"><?= $po['name'] ?> | <?= $po['username'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i> Select the project officer responsible for this project
                            </div>
                        </div>

                        <!-- Work Scope -->
                        <div class="mb-4">
                            <label for="work_scope" class="form-label fw-bold">
                                <i class="fas fa-tasks text-primary me-2"></i>Work Scope & Responsibilities
                            </label>
                            <textarea 
                                name="work_scope" 
                                class="form-control" 
                                id="work_scope" 
                                rows="7" 
                                placeholder="Describe the project officer's work scope, responsibilities, and key deliverables..."
                                required
                            ><?= $pro['pro_officer_scope'] ?></textarea>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i> Provide a detailed description of the officer's responsibilities
                            </div>
                        </div>

                        <input type="hidden" name="pro_ucode" value="<?= $pro['ucode'] ?>">
                        <input type="hidden" name="pro_id" value="<?= $pro['id'] ?>">
                    </div>

                    <div class="card-footer bg-light d-flex justify-content-between align-items-center">
                        <a href="<?= base_url() ?>open_projects/<?= $pro['ucode'] ?>" class="btn btn-secondary">
                            <i class="fa fa-arrow-left me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                    </form>
                </div>
            </div>

            <!-- Current Officer Info Column -->
            <div class="col-lg-4">
                <!-- Current Assignment Card -->
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-user-check me-2"></i>Current Assignment
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <p class="text-muted small mb-1 text-uppercase fw-bold">
                                <i class="fas fa-user me-1"></i> Assigned Officer
                            </p>
                            <h6 class="mb-0">
                                <?= !empty($pro['pro_officer_name']) ? $pro['pro_officer_name'] : '<span class="text-muted">Not Assigned</span>' ?>
                            </h6>
                        </div>

                        <?php if (!empty($pro['pro_officer_at'])) : ?>
                        <div class="mb-3">
                            <p class="text-muted small mb-1 text-uppercase fw-bold">
                                <i class="fas fa-calendar-alt me-1"></i> Assigned Date
                            </p>
                            <h6 class="mb-0"><?= date('M d, Y', strtotime($pro['pro_officer_at'])) ?></h6>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($pro['pro_officer_by'])) : ?>
                        <div class="mb-3">
                            <p class="text-muted small mb-1 text-uppercase fw-bold">
                                <i class="fas fa-user-cog me-1"></i> Assigned By
                            </p>
                            <h6 class="mb-0"><?= $pro['pro_officer_by'] ?></h6>
                        </div>
                        <?php endif; ?>

                        <hr>

                        <div>
                            <p class="text-muted small mb-2 text-uppercase fw-bold">
                                <i class="fas fa-clipboard-list me-1"></i> Current Scope
                            </p>
                            <div class="alert alert-light mb-0">
                                <?php if (!empty($pro['pro_officer_scope'])) : ?>
                                    <p class="mb-0 small"><?= nl2br(htmlspecialchars($pro['pro_officer_scope'])) ?></p>
                                <?php else : ?>
                                    <p class="mb-0 text-muted fst-italic small">
                                        <i class="fas fa-info-circle me-1"></i> No work scope defined yet
                                    </p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="mb-0 fw-bold">
                            <i class="fas fa-bolt me-2"></i>Quick Actions
                        </h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-grid gap-2">
                            <a href="<?= base_url() ?>open_projects/<?= $pro['ucode'] ?>" class="btn btn-outline-primary">
                                <i class="fas fa-eye me-2"></i>View Project Details
                            </a>
                            <a href="<?= base_url() ?>project_phases/<?= $pro['procode'] ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-tasks me-2"></i>View Project Phases
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Scripts -->
<script>
$(document).ready(function() {
    // Show success/error messages
    <?php if (session()->getFlashdata('success')) : ?>
        toastr.success('<?= session()->getFlashdata('success') ?>');
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')) : ?>
        toastr.error('<?= session()->getFlashdata('error') ?>');
    <?php endif; ?>

    // Form validation
    $('#officerForm').submit(function(e) {
        var officerId = $('#project_officers').val();
        var workScope = $('#work_scope').val().trim();
        
        if (!officerId) {
            e.preventDefault();
            toastr.error('Please select a project officer');
            return false;
        }
        
        if (!workScope) {
            e.preventDefault();
            toastr.error('Please enter the work scope');
            $('#work_scope').focus();
            return false;
        }
        
        // Show loading state
        var submitBtn = $(this).find('button[type="submit"]');
        submitBtn.prop('disabled', true);
        submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');
    });
});
</script>

<?= $this->endSection() ?>
