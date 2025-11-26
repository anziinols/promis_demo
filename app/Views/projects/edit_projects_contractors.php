<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 fw-bold">
                    <i class="fas fa-hard-hat me-2 text-primary"></i><?= $pro['name'] ?>
                </h1>
                <div class="mt-2">
                    <span class="badge bg-primary">
                        <i class="fas fa-code-branch me-1"></i><?= $pro['procode'] ?>
                    </span>
                </div>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item">
                        <a href="<?= base_url() ?>open_projects/<?= $pro['ucode'] ?>">
                            <i class="fas fa-arrow-left me-1"></i> View Project
                        </a>
                    </li>
                    <li class="breadcrumb-item active">Edit Contractor</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Section -->
<section class="container-fluid py-4">
    <div class="row g-4">
        <div class="col-12">
            
            <!-- Main Edit Card with Modern Design -->
            <div class="card shadow border-0">
                
                <!-- Card Header -->
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-user-tie me-2"></i>Update Project Contractor
                            </h5>
                            <small>Select contractor and upload contract documents</small>
                        </div>
                        <a href="<?= base_url() ?>open_projects/<?= $pro['ucode'] ?>" 
                           class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Back to Project
                        </a>
                    </div>
                </div>

                <?= form_open_multipart("update_projects_contractors", ['id' => 'contractorForm']) ?>
                
                <!-- Card Body with Improved Layout -->
                <div class="card-body p-4">
                    
                    <!-- Info Alert -->
                    <div class="alert alert-info d-flex align-items-center mb-4" role="alert">
                        <i class="fas fa-info-circle fs-4 me-3"></i>
                        <div class="flex-grow-1">
                            <strong>Important:</strong> Ensure you have the contractor's authorization and all required documentation before proceeding.
                        </div>
                    </div>

                    <div class="row g-4">
                        
                        <!-- Contractor Selection -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contractorSelect" class="form-label fw-bold">
                                    <i class="fas fa-building me-2 text-primary"></i>Select Contractor
                                    <span class="text-danger">*</span>
                                </label>
                                <select class="form-select"
                                        name="contractor"
                                        id="contractorSelect"
                                        required
                                        style="width: 100%;">
                                    <option value="">-- Select a Contractor --</option>
                                    <option selected value="<?= $pro['contractor_id'] ?>">
                                        <?= $pro['contractor_name'] ?> (Current)
                                    </option>
                                    <?php if (!empty($contractors)) : ?>
                                        <?php foreach ($contractors as $ct) : ?>
                                            <option value="<?= $ct['id'] ?>">
                                                <?= $ct['concode'] ?> | <?= $ct['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <option disabled>No contractors available</option>
                                    <?php endif; ?>
                                </select>
                                <div class="form-text">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    Choose from available contractors in your province
                                    <?php if (!empty($contractors)) : ?>
                                        <span class="badge bg-success ms-2"><?= count($contractors) ?> available</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Contract Document Upload -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contractFile" class="form-label fw-bold">
                                    <i class="fas fa-file-contract me-2 text-primary"></i>Contract Documents
                                    <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <input type="file" 
                                           class="form-control" 
                                           name="contract_file" 
                                           id="contractFile" 
                                           accept=".pdf" 
                                           required>
                                    <label class="input-group-text bg-primary text-white" for="contractFile">
                                        <i class="fas fa-upload me-2"></i>Browse
                                    </label>
                                </div>
                                <div class="form-text">
                                    <i class="fas fa-file-pdf me-1 text-danger"></i>
                                    PDF format only. Include: Contract Approval, Authorization Letter, etc.
                                </div>
                                <div class="mt-2">
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-exclamation-triangle me-1"></i>
                                        All documents must be scanned into a single PDF file
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                
                <!-- Card Footer -->
                <div class="card-footer bg-light py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            <i class="fas fa-shield-alt me-2"></i>
                            <small>All changes are logged and tracked</small>
                        </div>
                        <div>
                            <input type="hidden" name="pro_ucode" value="<?= $pro['ucode'] ?>">
                            <input type="hidden" name="pro_id" value="<?= $pro['id'] ?>">
                            <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                            
                            <button type="reset" class="btn btn-outline-secondary me-2">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Save Changes
                            </button>
                        </div>
                    </div>
                </div>

                </form>

            </div>
            <!-- End Main Card -->

            <!-- Current Contractor Information Card -->
            <?php if (!empty($pro['contractor_name'])) : ?>
            <div class="card shadow border-0 mt-4">
                <div class="card-header bg-success text-white py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-info-circle me-2"></i>Current Contractor Information
                    </h5>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4 align-items-center">
                        
                        <!-- Contractor Details -->
                        <div class="col-md-8">
                            <div class="d-flex align-items-start">
                                <div class="flex-shrink-0 me-3">
                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                                         style="width: 50px; height: 50px;">
                                        <i class="fas fa-building"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h5 class="mb-1 fw-bold"><?= $pro['contractor_name'] ?></h5>
                                    <p class="mb-2 text-muted">
                                        <i class="fas fa-hashtag me-1"></i>
                                        <strong>Code:</strong> <?= $pro['contractor_code'] ?>
                                    </p>
                                    <?php if (!empty($pro['contractor_at'])) : ?>
                                    <p class="mb-0 text-muted small">
                                        <i class="far fa-clock me-1"></i>
                                        <strong>Assigned:</strong> <?= date('d M Y, h:i A', strtotime($pro['contractor_at'])) ?>
                                        <?php if (!empty($pro['contractor_by'])) : ?>
                                            by <strong><?= $pro['contractor_by'] ?></strong>
                                        <?php endif; ?>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Contract File -->
                        <div class="col-md-4 text-center text-md-end">
                            <div class="mb-2">
                                <strong>
                                    <i class="fas fa-file-contract me-2"></i>Contract Document
                                </strong>
                            </div>
                            <?php if (!empty($pro['contract_file'])) : ?>
                                <a href="<?= base_url() ?><?= $pro['contract_file'] ?>" 
                                   class="btn btn-success" 
                                   target="_blank">
                                    <i class="fas fa-download me-2"></i>Download PDF
                                </a>
                                <div class="mt-2">
                                    <small class="text-success">
                                        <i class="fas fa-check-circle me-1"></i>Document Available
                                    </small>
                                </div>
                            <?php else : ?>
                                <div class="alert alert-warning mb-0" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    No contract file uploaded
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
            <?php endif; ?>

        </div>
    </div>
</section>


<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 for contractor dropdown with error handling
        try {
            if (typeof $.fn.select2 !== 'undefined') {
                $('#contractorSelect').select2({
                    theme: 'bootstrap-5',
                    placeholder: '-- Select a Contractor --',
                    allowClear: false,
                    width: '100%',
                    dropdownAutoWidth: true,
                    minimumResultsForSearch: 5 // Show search box if more than 5 items
                });
                console.log('Select2 initialized successfully');
            } else {
                console.warn('Select2 library not loaded, using native dropdown');
            }
        } catch (error) {
            console.error('Error initializing Select2:', error);
            console.log('Falling back to native dropdown');
        }

        // Display selected filename
        $('#contractFile').on('change', function() {
            const fileName = $(this).val().split('\\').pop();
            if (fileName) {
                $(this).next('.input-group-text').html('<i class="fas fa-check me-2"></i>' + fileName);
            }
        });

        // Form validation
        $('#contractorForm').on('submit', function(e) {
            const contractor = $('#contractorSelect').val();
            const file = $('#contractFile').val();

            if (!contractor || contractor === '') {
                e.preventDefault();
                if (typeof toastr !== 'undefined') {
                    toastr.error('Please select a contractor');
                } else {
                    alert('Please select a contractor');
                }
                return false;
            }

            if (!file) {
                e.preventDefault();
                if (typeof toastr !== 'undefined') {
                    toastr.error('Please upload a contract document');
                } else {
                    alert('Please upload a contract document');
                }
                return false;
            }

            // Show loading state
            const submitBtn = $(this).find('button[type="submit"]');
            submitBtn.prop('disabled', true);
            submitBtn.html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');
        });

        // Debug: Log contractors count
        const contractorCount = $('#contractorSelect option').length;
        console.log('Total contractor options:', contractorCount);
    });
</script>

<?= $this->endSection() ?>