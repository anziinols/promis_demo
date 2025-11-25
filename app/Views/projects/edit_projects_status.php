<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <!-- Page Title Section -->
        <div class="card shadow-sm border-0 rounded-3 mb-4">
            <div class="card-body p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-project-diagram text-primary me-3 fs-1"></i>
                            <div>
                                <h1 class="h2 mb-2 fw-bold text-dark"><?= $pro['name'] ?></h1>
                                <span class="badge bg-primary rounded-pill px-3 py-2">
                                    <i class="fas fa-hashtag me-1"></i><?= $pro['procode'] ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <?php
                        $statusClass = match($pro['status']) {
                            'active' => 'bg-success',
                            'hold' => 'bg-warning',
                            'completed' => 'bg-primary',
                            'canceled' => 'bg-secondary',
                            default => 'bg-secondary'
                        };
                        ?>
                        <div>
                            <small class="text-muted d-block mb-2">Current Status</small>
                            <span class="badge <?= $statusClass ?> rounded-pill px-3 py-2 fs-6">
                                <i class="fas fa-circle me-1" style="font-size: 0.6rem;"></i>
                                <?= ucfirst($pro['status']) ?>
                            </span>
                        </div>
                    </div>
                </div>
                
                <hr class="my-3">
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url() ?>open_projects/<?= $pro['ucode'] ?>" class="text-decoration-none">
                                <i class="fas fa-arrow-left me-1"></i> Back to Project
                            </a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Status</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Section -->
<section class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            
            <!-- Status Edit Form Card -->
            <div class="card shadow-sm border-0 rounded-3 mb-4">
                <div class="card-header bg-primary text-white p-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1 fw-bold">
                                <i class="fas fa-edit me-2"></i>Edit Project Status
                            </h4>
                            <p class="mb-0 opacity-75 small">Update the current status and add relevant notes</p>
                        </div>
                    </div>
                </div>

                <?= form_open('update_projects_status', ['class' => 'needs-validation', 'novalidate' => true]) ?>
                <div class="card-body p-4">
                    
                    <!-- Status Selection -->
                    <div class="mb-4">
                        <label for="status" class="form-label fw-semibold text-dark d-flex align-items-center">
                            <i class="fas fa-flag text-primary me-2"></i>
                            Select New Status
                        </label>
                        <select class="form-select form-select-lg" name="status" id="status" required>
                            <option value="" disabled>Choose a status...</option>
                            <option value="active" <?= $pro['status'] == 'active' ? 'selected' : '' ?>>
                                🟢 Active - Project is currently in progress
                            </option>
                            <option value="hold" <?= $pro['status'] == 'hold' ? 'selected' : '' ?>>
                                🟡 Hold - Project is temporarily paused
                            </option>
                            <option value="completed" <?= $pro['status'] == 'completed' ? 'selected' : '' ?>>
                                🔵 Completed - Project has been finished
                            </option>
                            <option value="canceled" <?= $pro['status'] == 'canceled' ? 'selected' : '' ?>>
                                🔴 Canceled - Project has been terminated
                            </option>
                        </select>
                        <div class="invalid-feedback">
                            Please select a status for this project.
                        </div>
                    </div>

                    <!-- Status Notes -->
                    <div class="mb-4">
                        <label for="statusnotes" class="form-label fw-semibold text-dark d-flex align-items-center">
                            <i class="fas fa-sticky-note text-primary me-2"></i>
                            Status Notes
                        </label>
                        <textarea 
                            id="statusnotes" 
                            class="form-control" 
                            name="statusnotes" 
                            rows="5" 
                            placeholder="Enter detailed notes about this status change..."
                            required><?= $pro['statusnotes'] ?></textarea>
                        <div class="invalid-feedback">
                            Please provide notes for this status change.
                        </div>
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Be specific about why this status change is being made
                        </div>
                    </div>

                    <!-- Information Box -->
                    <div class="alert alert-info border-start border-primary border-5" role="alert">
                        <div class="d-flex align-items-start">
                            <i class="fas fa-history text-primary fs-4 me-3 mt-1"></i>
                            <div class="flex-grow-1">
                                <h6 class="alert-heading fw-bold mb-3">Previous Status Information</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-1">Last Updated</small>
                                        <strong class="text-dark"><?= !empty($pro['status_at']) ? datetimeforms($pro['status_at']) : 'N/A' ?></strong>
                                    </div>
                                    <div class="col-md-6">
                                        <small class="text-muted d-block mb-1">Updated By</small>
                                        <strong class="text-dark"><?= !empty($pro['status_by']) ? $pro['status_by'] : 'N/A' ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Card Footer with Actions -->
                <div class="card-footer bg-light p-4">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <a href="<?= base_url() ?>open_projects/<?= $pro['ucode'] ?>" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left me-2"></i>Cancel
                        </a>
                        
                        <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                        <input type="hidden" name="proid" value="<?= $pro['id'] ?>">
                        
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>

            <!-- Help Information Card -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4">
                        <i class="fas fa-question-circle text-info me-2"></i>Status Guidelines
                    </h5>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-success rounded-pill me-2 px-3 py-2">Active</span>
                                <small class="text-muted mt-1">Project work is ongoing</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-warning rounded-pill me-2 px-3 py-2">Hold</span>
                                <small class="text-muted mt-1">Project is paused temporarily</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-info rounded-pill me-2 px-3 py-2">Completed</span>
                                <small class="text-muted mt-1">All work has been finished</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-start">
                                <span class="badge bg-danger rounded-pill me-2 px-3 py-2">Canceled</span>
                                <small class="text-muted mt-1">Project has been terminated</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<script>
    // Bootstrap 5 Form validation
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();

    // Character counter for notes
    const notesTextarea = document.getElementById('statusnotes');
    if (notesTextarea) {
        notesTextarea.addEventListener('input', function() {
            const length = this.value.length;
            const parent = this.parentElement;
            let counter = parent.querySelector('.char-counter');
            
            if (!counter) {
                counter = document.createElement('small');
                counter.className = 'char-counter text-muted mt-1 d-block';
                parent.querySelector('.form-text').insertAdjacentElement('afterend', counter);
            }
            
            counter.textContent = `${length} characters written`;
        });
    }
</script>

<?= $this->endSection() ?>