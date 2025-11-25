<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-tasks text-primary"></i> <?= $pro['name'] ?></h1>
                <p class="text-muted mb-0"><i class="fas fa-code-branch"></i> Phases & Milestones Management</p>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>open_projects/<?= $pro['ucode'] ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Open Projects</a></li>
                    <li class="breadcrumb-item active">Phases & Milestones</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">

        <!-- Project Info Card -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="mb-1"><i class="fas fa-project-diagram text-primary"></i> <?= $pro['name'] ?></h4>
                        <p class="text-muted mb-0">
                            <span class="badge bg-primary me-2"><?= $pro['procode'] ?></span>
                            <span class="text-muted">Manage project phases and track milestones</span>
                        </p>
                    </div>
                    <div class="col-md-4 text-end mt-3 mt-md-0">
                        <a class="btn btn-outline-primary me-2" href="<?= base_url() ?>open_projects/<?= $pro['ucode'] ?>">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back
                        </a>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addphases">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Create Phase
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Phases and Milestones Card -->
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-stream"></i> Project Phases and Milestones
                        </h5>
                    </div>

                    <!-- Add Phase Modal -->
                    <div class="modal fade" id="addphases" tabindex="-1" aria-labelledby="addphasesLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="addphasesLabel">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Create New Phase
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <?= form_open('add_phases', ['id' => 'add_phasesForm']) ?>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="phases" class="form-label"><i class="fas fa-layer-group"></i> Phase Title <span class="text-danger">*</span></label>
                                        <?= form_input('phases', set_value('phases'), ['class' => 'form-control', 'id' => 'phases', 'placeholder' => 'Enter phase title (e.g., Planning, Execution, Completion)', 'required' => 'required']) ?>
                                        <div class="form-text">Enter a descriptive name for this project phase</div>
                                    </div>
                                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="fas fa-times"></i> Cancel
                                    </button>
                                    <button type="button" id="btnAddPhases" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Phase
                                    </button>
                                </div>
                                <?= form_close() ?>

                                <script>
                                    $(document).ready(function() {
                                        // Add keypress event listener to the form input fields
                                        $('#add_phasesForm input').keypress(function(e) {
                                            if (e.which == 13) {
                                                e.preventDefault();
                                                $('#btnAddPhases').click();
                                            }
                                        });

                                        $('#btnAddPhases').on('click', function() {
                                            var formData = new FormData($('#add_phasesForm')[0]);

                                            $.ajax({
                                                url: "<?= base_url('add_phases'); ?>",
                                                type: 'POST',
                                                data: formData,
                                                contentType: false,
                                                processData: false,
                                                beforeSend: function() {
                                                    $('#btnAddPhases').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Adding...');
                                                },
                                                success: function(response) {
                                                    console.log(response);
                                                    
                                                    // Refresh CSRF token
                                                    $.get("<?= base_url('get_csrf_token') ?>", function(data) {
                                                        $('input[name="<?= csrf_token() ?>"]').val(data.token);
                                                    });

                                                    if (response.status === 'success') {
                                                        toastr.success(response.message);
                                                        setTimeout(function() {
                                                            location.reload();
                                                        }, 1000);
                                                    } else {
                                                        toastr.error(response.message);
                                                        setTimeout(function() {
                                                            location.reload();
                                                        }, 2000);
                                                    }
                                                },
                                                error: function(error) {
                                                    console.log(error.responseText);
                                                    toastr.error('An error occurred. Please try again.');
                                                    $('#btnAddPhases').prop('disabled', false).html('<i class="fas fa-plus"></i> Add Phase');
                                                }
                                            });
                                        });
                                    });
                                </script>

                            </div>
                        </div>
                    </div>
                    <!-- ./ Add Phase modal -->

                    <div class="card-body p-0">
                        <?php if (empty($phases)): ?>
                            <div class="p-5 text-center">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No phases created yet. Click "Create Phase" to get started.</p>
                            </div>
                        <?php else: ?>
                            <div class="accordion" id="phasesAccordion">
                                <?php foreach ($phases as $index => $ph) : ?>
                                    <div class="accordion-item mb-2">
                                        <h2 class="accordion-header" id="heading<?= $ph['id'] ?>">
                                            <div class="d-flex align-items-center p-3">
                                                <button class="accordion-button collapsed flex-grow-1 text-start bg-transparent border-0 shadow-none p-0" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= $ph['id'] ?>" aria-expanded="false" aria-controls="collapse<?= $ph['id'] ?>">
                                                    <div>
                                                        <h5 class="mb-0">
                                                            <i class="fas fa-layer-group text-primary"></i>
                                                            <strong><?= $ph['phases'] ?></strong>
                                                        </h5>
                                                        <small class="text-muted">
                                                            <?php 
                                                            $milestone_count = 0;
                                                            foreach ($milestones as $ms) {
                                                                if ($ms['phase_id'] == $ph['id']) {
                                                                    $milestone_count++;
                                                                }
                                                            }
                                                            ?>
                                                            <i class="fas fa-tasks"></i> <?= $milestone_count ?> Milestone<?= $milestone_count != 1 ? 's' : '' ?>
                                                        </small>
                                                    </div>
                                                </button>
                                                <div class="btn-group ms-3" role="group">
                                                    <button type="button" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i> Actions
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="<?= base_url() ?>open_prophases/<?= $ph['ucode'] ?>">
                                                            <i class="fas fa-eye text-primary"></i> View Details
                                                        </a></li>
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit<?= $ph['id'] ?>">
                                                            <i class="fas fa-edit text-warning"></i> Edit Phase
                                                        </a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delete<?= $ph['id'] ?>">
                                                            <i class="fas fa-trash-alt"></i> Delete Phase
                                                        </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </h2>
                                        <div id="collapse<?= $ph['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $ph['id'] ?>" data-bs-parent="#phasesAccordion">
                                            <div class="accordion-body bg-light">
                                                <?php 
                                                $has_milestones = false;
                                                foreach ($milestones as $ms) {
                                                    if ($ms['phase_id'] == $ph['id']) {
                                                        $has_milestones = true;
                                                        break;
                                                    }
                                                }
                                                if (!$has_milestones): ?>
                                                    <div class="text-center py-3">
                                                        <i class="fas fa-clipboard-list fa-2x text-muted mb-2"></i>
                                                        <p class="text-muted mb-0">No milestones for this phase yet</p>
                                                    </div>
                                                <?php else: ?>
                                                    <ul class="list-group list-group-flush">
                                                        <?php foreach ($milestones as $ms) :
                                                            if ($ms['phase_id'] == $ph['id']) : ?>
                                                                <li class="list-group-item d-flex justify-content-between align-items-center bg-white mb-1">
                                                                    <span>
                                                                        <i class="fas fa-check-circle <?= $ms['checked'] == 1 ? 'text-success' : 'text-muted' ?>"></i>
                                                                        <?= $ms['milestones'] ?>
                                                                    </span>
                                                                    <span><?= get_status_icon($ms['checked']) ?></span>
                                                                </li>
                                                            <?php endif;
                                                        endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Phase Modal -->
                                    <div class="modal fade" id="edit<?= $ph['id'] ?>" tabindex="-1" aria-labelledby="edit<?= $ph['id'] ?>Label" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning text-dark">
                                                    <h5 class="modal-title" id="edit<?= $ph['id'] ?>Label">
                                                        <i class="fas fa-edit"></i> Edit Phase
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <?= form_open('edit_phases', ['id' => 'edit_phasesForm' . $ph['id']]) ?>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="phases<?= $ph['id'] ?>" class="form-label">
                                                            <i class="fas fa-layer-group"></i> Phase Title <span class="text-danger">*</span>
                                                        </label>
                                                        <?= form_input('phases', $ph['phases'], ['class' => 'form-control', 'id' => 'phases' . $ph['id'], 'placeholder' => 'Enter Phase Title', 'required' => 'required']) ?>
                                                        <input type="hidden" name="phid" value="<?= $ph['id'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times"></i> Cancel
                                                    </button>
                                                    <button type="button" id="edit_phasesBtn<?= $ph['id'] ?>" class="btn btn-warning">
                                                        <i class="fas fa-save"></i> Save Changes
                                                    </button>
                                                </div>
                                                <?= form_close() ?>

                                                <script>
                                                    $(document).ready(function() {
                                                        $('#edit_phasesForm<?= $ph['id'] ?>').keypress(function(e) {
                                                            if (e.which == 13) {
                                                                e.preventDefault();
                                                                $('#edit_phasesBtn<?= $ph['id'] ?>').click();
                                                            }
                                                        });

                                                        $('#edit_phasesBtn<?= $ph['id'] ?>').on('click', function() {
                                                            var formData = new FormData($('#edit_phasesForm<?= $ph['id'] ?>')[0]);

                                                            $.ajax({
                                                                url: "<?= base_url('edit_phases'); ?>",
                                                                type: 'POST',
                                                                data: formData,
                                                                contentType: false,
                                                                processData: false,
                                                                beforeSend: function() {
                                                                    $('#edit_phasesBtn<?= $ph['id'] ?>').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                    
                                                                    // Refresh CSRF token
                                                                    $.get("<?= base_url('get_csrf_token') ?>", function(data) {
                                                                        $('input[name="<?= csrf_token() ?>"]').val(data.token);
                                                                    });

                                                                    toastr.success(response.message);
                                                                    setTimeout(function() {
                                                                        location.reload();
                                                                    }, 1000);
                                                                },
                                                                error: function(error) {
                                                                    console.log(error.responseText);
                                                                    toastr.error('An error occurred. Please try again.');
                                                                    $('#edit_phasesBtn<?= $ph['id'] ?>').prop('disabled', false).html('<i class="fas fa-save"></i> Save Changes');
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Phase Modal -->
                                    <div class="modal fade" id="delete<?= $ph['id'] ?>" tabindex="-1" aria-labelledby="delete<?= $ph['id'] ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="delete<?= $ph['id'] ?>Label">
                                                        <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <?= form_open('delete_phases', ['id' => 'delete_phasesForm' . $ph['id']]) ?>
                                                <div class="modal-body">
                                                    <div class="alert alert-warning" role="alert">
                                                        <i class="fas fa-exclamation-circle"></i> <strong>Warning!</strong> This action cannot be undone.
                                                    </div>
                                                    <p>Are you sure you want to delete this phase?</p>
                                                    <div class="card bg-light">
                                                        <div class="card-body">
                                                            <strong><?= $ph['phases'] ?></strong>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="phid" value="<?= $ph['id'] ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times"></i> Cancel
                                                    </button>
                                                    <button type="button" id="delete_phasesBtn<?= $ph['id'] ?>" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i> Delete Phase
                                                    </button>
                                                </div>
                                                <?= form_close() ?>

                                                <script>
                                                    $(document).ready(function() {
                                                        $('#delete_phasesForm<?= $ph['id'] ?> input').keypress(function(e) {
                                                            if (e.which == 13) {
                                                                e.preventDefault();
                                                                $('#delete_phasesBtn<?= $ph['id'] ?>').click();
                                                            }
                                                        });

                                                        $('#delete_phasesBtn<?= $ph['id'] ?>').on('click', function() {
                                                            var formData = new FormData($('#delete_phasesForm<?= $ph['id'] ?>')[0]);

                                                            $.ajax({
                                                                url: "<?= base_url('delete_phases'); ?>",
                                                                type: 'POST',
                                                                data: formData,
                                                                contentType: false,
                                                                processData: false,
                                                                beforeSend: function() {
                                                                    $('#delete_phasesBtn<?= $ph['id'] ?>').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');
                                                                },
                                                                success: function(response) {
                                                                    console.log(response);
                                                                    
                                                                    // Refresh CSRF token
                                                                    $.get("<?= base_url('get_csrf_token') ?>", function(data) {
                                                                        $('input[name="<?= csrf_token() ?>"]').val(data.token);
                                                                    });

                                                                    if (response.status === 'success') {
                                                                        toastr.success(response.message);
                                                                        setTimeout(function() {
                                                                            location.reload();
                                                                        }, 1000);
                                                                    } else {
                                                                        toastr.error(response.message);
                                                                        setTimeout(function() {
                                                                            location.reload();
                                                                        }, 2000);
                                                                    }
                                                                },
                                                                error: function(error) {
                                                                    console.log(error.responseText);
                                                                    toastr.error('An error occurred. Please try again.');
                                                                    $('#delete_phasesBtn<?= $ph['id'] ?>').prop('disabled', false).html('<i class="fas fa-trash-alt"></i> Delete Phase');
                                                                }
                                                            });
                                                        });
                                                    });
                                                </script>
                                            </div>
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
</section>

<?= $this->endSection() ?>