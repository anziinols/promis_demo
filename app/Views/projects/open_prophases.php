<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-layer-group text-primary"></i> <?= $phases['phases'] ?></h1>
                <p class="text-muted mb-0"><i class="fas fa-project-diagram"></i> <?= $pro['name'] ?> <span class="badge bg-primary"><?= $pro['procode'] ?></span></p>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>project_phases/<?= $pro['procode'] ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Phases</a></li>
                    <li class="breadcrumb-item active">Milestones</li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">

        <!-- Phase Info Card -->
        <div class="card mb-3">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="mb-1"><i class="fas fa-layer-group text-primary"></i> <?= $phases['phases'] ?></h4>
                        <p class="text-muted mb-0">
                            <span class="badge bg-secondary me-2"><?= $pro['procode'] ?></span>
                            <span class="text-muted">Manage milestones for this phase</span>
                        </p>
                    </div>
                    <div class="col-md-4 text-end mt-3 mt-md-0">
                        <a class="btn btn-outline-primary" href="<?= base_url() ?>project_phases/<?= $pro['procode'] ?>">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back to Phases
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Create Milestone Form -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Create Milestone
                        </h5>
                    </div>
                    <?= form_open('add_milestones', ['id' => 'add_milestonesForm']) ?>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="milestones" class="form-label"><i class="fas fa-tasks"></i> Milestone Title <span class="text-danger">*</span></label>
                            <?= form_input('milestones', set_value('milestones'), ['class' => 'form-control', 'id' => 'milestones', 'placeholder' => 'Enter milestone description', 'required' => 'required']) ?>
                            <div class="form-text">Provide a clear description of the milestone</div>
                        </div>
                        <div class="mb-3">
                            <label for="datefrom" class="form-label"><i class="far fa-calendar-alt"></i> Start Date</label>
                            <input type="date" name="datefrom" id="datefrom" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="dateto" class="form-label"><i class="far fa-calendar-check"></i> End Date</label>
                            <input type="date" name="dateto" id="dateto" class="form-control">
                        </div>
                        <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                        <input type="hidden" name="phid" value="<?= $phases['id'] ?>">
                    </div>
                    <div class="card-footer bg-light">
                        <button type="button" id="add_milestonesBtn" class="btn btn-primary w-100">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Milestone
                        </button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>

            <!-- Milestones List -->
            <div class="col-lg-8 col-md-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-list-check"></i> Milestones List
                            <span class="badge bg-light text-primary float-end"><?= count($milestones) ?> Total</span>
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <?php if (empty($milestones)): ?>
                            <div class="text-center py-5">
                                <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No milestones created yet. Use the form to add your first milestone.</p>
                            </div>
                        <?php else: ?>
                            <div class="list-group list-group-flush">
                                <?php foreach ($milestones as $ml) : ?>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col-lg-5 col-md-12 mb-2 mb-lg-0">
                                                <div class="d-flex align-items-start">
                                                    <i class="fas fa-check-circle text-<?= $ml['checked'] == 'completed' ? 'success' : 'muted' ?> me-2 mt-1"></i>
                                                    <div>
                                                        <h6 class="mb-1"><?= $ml['milestones'] ?></h6>
                                                        <small class="text-muted">
                                                            <?php if ($ml['checked'] == 'completed'): ?>
                                                                <span class="badge bg-success"><i class="fas fa-check"></i> Completed</span>
                                                            <?php elseif ($ml['checked'] == 'in_progress'): ?>
                                                                <span class="badge bg-warning"><i class="fas fa-spinner"></i> In Progress</span>
                                                            <?php else: ?>
                                                                <span class="badge bg-secondary"><i class="fas fa-clock"></i> Pending</span>
                                                            <?php endif; ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 mb-2 mb-lg-0">
                                                <small class="text-muted">
                                                    <i class="far fa-calendar text-primary"></i> <strong>Start:</strong> <?= dateforms($ml['datefrom']) ?><br>
                                                    <i class="far fa-calendar-check text-success"></i> <strong>End:</strong> <?= dateforms($ml['dateto']) ?>
                                                </small>
                                            </div>
                                            <div class="col-lg-3 col-md-6 text-end">
                                                <div class="btn-group" role="group">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i> Actions
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#edit<?= $ml['id'] ?>">
                                                            <i class="fas fa-edit text-warning"></i> Edit
                                                        </a></li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#del<?= $ml['id'] ?>">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="edit<?= $ml['id'] ?>" tabindex="-1" aria-labelledby="edit<?= $ml['id'] ?>Label" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning text-dark">
                                                    <h5 class="modal-title" id="edit<?= $ml['id'] ?>Label">
                                                        <i class="fas fa-edit"></i> Edit Milestone
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <?= form_open('edit_milestones', ['id' => 'edit_milestonesForm' . $ml['id']]) ?>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="edit_milestones<?= $ml['id'] ?>" class="form-label">
                                                            <i class="fas fa-tasks"></i> Milestone Title <span class="text-danger">*</span>
                                                        </label>
                                                        <?= form_input('milestones', $ml['milestones'], ['class' => 'form-control', 'id' => 'edit_milestones' . $ml['id'], 'placeholder' => 'Enter Milestone', 'required' => 'required']) ?>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 mb-3">
                                                            <label for="edit_datefrom<?= $ml['id'] ?>" class="form-label">
                                                                <i class="far fa-calendar-alt"></i> Start Date
                                                            </label>
                                                            <input type="date" name="datefrom" id="edit_datefrom<?= $ml['id'] ?>" class="form-control" value="<?= $ml['datefrom'] ?>">
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <label for="edit_dateto<?= $ml['id'] ?>" class="form-label">
                                                                <i class="far fa-calendar-check"></i> End Date
                                                            </label>
                                                            <input type="date" name="dateto" id="edit_dateto<?= $ml['id'] ?>" class="form-control" value="<?= $ml['dateto'] ?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="alert alert-info mt-3">
                                                        <small>
                                                            <strong><i class="fas fa-info-circle"></i> Record Info:</strong><br>
                                                            <i class="fas fa-user-plus"></i> Created: <?= datetimeforms($ml['create_at']) ?> by <?= $ml['create_by'] ?><br>
                                                            <i class="fas fa-user-edit"></i> Updated: <?= datetimeforms($ml['update_at']) ?> by <?= $ml['update_by'] ?>
                                                        </small>
                                                    </div>

                                                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                                    <input type="hidden" name="mlid" value="<?= $ml['id'] ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times"></i> Cancel
                                                    </button>
                                                    <button type="button" id="edit_milestonesBtn<?= $ml['id'] ?>" class="btn btn-warning">
                                                        <i class="fas fa-save"></i> Save Changes
                                                    </button>
                                                </div>
                                                <?= form_close() ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="del<?= $ml['id'] ?>" tabindex="-1" aria-labelledby="del<?= $ml['id'] ?>Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="del<?= $ml['id'] ?>Label">
                                                        <i class="fas fa-exclamation-triangle"></i> Confirm Deletion
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <?= form_open('delete_milestones', ['id' => 'delete_milestonesForm' . $ml['id']]) ?>
                                                <div class="modal-body">
                                                    <div class="alert alert-warning" role="alert">
                                                        <i class="fas fa-exclamation-circle"></i> <strong>Warning!</strong> This action cannot be undone.
                                                    </div>
                                                    <p>Are you sure you want to delete this milestone?</p>
                                                    <div class="card bg-light">
                                                        <div class="card-body">
                                                            <strong><?= $ml['milestones'] ?></strong>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                                    <input type="hidden" name="mlid" value="<?= $ml['id'] ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                        <i class="fas fa-times"></i> Cancel
                                                    </button>
                                                    <button type="button" id="delete_milestonesBtn<?= $ml['id'] ?>" class="btn btn-danger">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </div>
                                                <?= form_close() ?>
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

<script>
$(document).ready(function() {
    // Add Milestone Form
    $('#add_milestonesForm input').keypress(function(e) {
        if (e.which == 13) {
            e.preventDefault();
            $('#add_milestonesBtn').click();
        }
    });

    $('#add_milestonesBtn').on('click', function() {
        var formData = new FormData($('#add_milestonesForm')[0]);

        $.ajax({
            url: "<?= base_url('add_milestones'); ?>",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#add_milestonesBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Adding...');
            },
            success: function(response) {
                console.log(response);
                
                // Refresh CSRF token
                $.get("<?= base_url('get_csrf_token') ?>", function(data) {
                    $('input[name="<?= csrf_token() ?>"]').val(data.hash);
                });

                if (response.status === 'success') {
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                } else {
                    toastr.error(response.message);
                    $('#add_milestonesBtn').prop('disabled', false).html('<i class="fa fa-plus-circle"></i> Add Milestone');
                }
            },
            error: function(error) {
                console.log(error);
                toastr.error('An error occurred. Please try again.');
                $('#add_milestonesBtn').prop('disabled', false).html('<i class="fa fa-plus-circle"></i> Add Milestone');
            }
        });
    });

    // Edit Milestone Forms
    <?php foreach ($milestones as $ml) : ?>
        $('#edit_milestonesForm<?= $ml['id'] ?> input').keypress(function(e) {
            if (e.which == 13) {
                e.preventDefault();
                $('#edit_milestonesBtn<?= $ml['id'] ?>').click();
            }
        });

        $('#edit_milestonesBtn<?= $ml['id'] ?>').on('click', function() {
            var formData = new FormData($('#edit_milestonesForm<?= $ml['id'] ?>')[0]);

            $.ajax({
                url: "<?= base_url('edit_milestones'); ?>",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#edit_milestonesBtn<?= $ml['id'] ?>').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
                },
                success: function(response) {
                    console.log(response);
                    
                    // Refresh CSRF token
                    $.get("<?= base_url('get_csrf_token') ?>", function(data) {
                        $('input[name="<?= csrf_token() ?>"]').val(data.hash);
                    });

                    if (response.status === 'success') {
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(response.message);
                        $('#edit_milestonesBtn<?= $ml['id'] ?>').prop('disabled', false).html('<i class="fas fa-save"></i> Save Changes');
                    }
                },
                error: function(error) {
                    console.log(error);
                    toastr.error('An error occurred. Please try again.');
                    $('#edit_milestonesBtn<?= $ml['id'] ?>').prop('disabled', false).html('<i class="fas fa-save"></i> Save Changes');
                }
            });
        });

        // Delete Milestone
        $('#delete_milestonesBtn<?= $ml['id'] ?>').on('click', function() {
            var formData = new FormData($('#delete_milestonesForm<?= $ml['id'] ?>')[0]);

            $.ajax({
                url: "<?= base_url('delete_milestones'); ?>",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#delete_milestonesBtn<?= $ml['id'] ?>').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');
                },
                success: function(response) {
                    console.log(response);
                    
                    // Refresh CSRF token
                    $.get("<?= base_url('get_csrf_token') ?>", function(data) {
                        $('input[name="<?= csrf_token() ?>"]').val(data.hash);
                    });

                    if (response.status === 'success') {
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    } else {
                        toastr.error(response.message);
                        $('#delete_milestonesBtn<?= $ml['id'] ?>').prop('disabled', false).html('<i class="fas fa-trash-alt"></i> Delete');
                    }
                },
                error: function(error) {
                    console.log(error);
                    toastr.error('An error occurred. Please try again.');
                    $('#delete_milestonesBtn<?= $ml['id'] ?>').prop('disabled', false).html('<i class="fas fa-trash-alt"></i> Delete');
                }
            });
        });
    <?php endforeach; ?>
});
</script>

<?= $this->endSection() ?>
