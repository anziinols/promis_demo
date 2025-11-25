<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid px-3 px-md-4 py-3">

        <!-- Page Header Card -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="mb-0 font-weight-bold"><?= $pro['procode'] . "-" . $pro['name'] ?></h4>
                    </div>
                    <div class="col-md-4 text-md-right mt-2 mt-md-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 bg-transparent justify-content-md-end">
                                <li class="breadcrumb-item">
                                    <a href="<?= base_url() ?>/po_phases/<?= $pro['ucode'] ?>">
                                        <i class="bi bi-chevron-left"></i> Go Back
                                    </a>
                                </li>
                                <li class="breadcrumb-item">Phases</li>
                                <li class="breadcrumb-item active">Milestones</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Header with Action Buttons -->
        <div class="row mb-3">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 font-weight-bold text-dark">
                        <i class="fas fa-tasks mr-2"></i>MILESTONES
                    </h5>
                    <div>
                        <button type="button" class="btn btn-primary shadow-sm mr-2" data-toggle="modal" data-target="#check">
                            <i class="fas fa-check mr-1"></i> Set Milestone
                        </button>
                        <button type="button" class="btn btn-success shadow-sm" data-toggle="modal" data-target="#addmilefile">
                            <i class="fa fa-upload mr-1"></i> Upload Milestone Files
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal notes -->
        <div class="modal fade" id="check" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title font-weight-semibold">
                            <i class="fas fa-check mr-2"></i> Set Milestone
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open_multipart('milestone_notes') ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="my-textarea" class="font-weight-semibold">Notes</label>
                            <textarea id="my-textarea" class="form-control" name="milenotes" rows="4" placeholder="Write something here"><?= $milestones['notes'] ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="milestone_status" class="font-weight-semibold">Status</label>
                            <select name="status" id="milestone_status" class="form-control" required>
                                <?php if (!empty($milestones['status'])) : ?>
                                    <option selected="selected" value="<?= $milestones['status'] ?>">
                                        <?= ucfirst($milestones['status']) ?>
                                    </option>
                                <?php else : ?>
                                    <option value="">--Select Milestone Status--</option>
                                <?php endif; ?>
                                <option value="pending">Pending</option>
                                <option value="completed">Completed</option>
                                <option value="hold">Hold</option>
                                <option value="canceled">Canceled</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_date" class="font-weight-semibold">Status Date</label>
                            <input type="date" name="milesdate" id="status_date" class="form-control" value="<?= $milestones['checked_date'] ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <input type="hidden" name="ms_id" value="<?= $milestones['id'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i> Save
                        </button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
        <!-- ./modal -->

        <!-- Modal upload files -->
        <div class="modal fade" id="addmilefile" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content border-0 shadow">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title font-weight-semibold">
                            <i class="fa fa-upload mr-2"></i> Upload Milestone Files
                        </h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <?= form_open_multipart('milestone_files') ?>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="formFileMultiple" class="font-weight-semibold">
                                <i class="fas fa-file-upload mr-1"></i> Select Multiple Files
                            </label>
                            <input class="form-control" name="milefiles[]" type="file" id="formFileMultiple" multiple accept="image/*,.pdf,.doc,.docx">
                            <small class="form-text text-muted">You can select multiple files at once</small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <input type="hidden" name="ms_id" value="<?= $milestones['id'] ?>">
                        <input type="hidden" name="ph_id" value="<?= $phases['id'] ?>">
                        <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            <i class="fas fa-times mr-1"></i> Close
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-upload mr-1"></i> Upload
                        </button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
        <!-- ./modal -->

        <!-- Milestone Details Card -->
        <div class="row mb-4">
            <div class="col-12">
                <?php
                // Default styling
                $bg = "bg-secondary";
                $textColor = "text-white";
                $badgeBg = "bg-light text-dark";
                $icon = "<i class='fa fa-question-circle'></i>";
                $statusText = "Unknown";
                $borderColor = "border-secondary";

                // Get status (use 'status' field, fallback to 'checked' for backward compatibility)
                $currentStatus = !empty($milestones['status']) ? $milestones['status'] :
                                ($milestones['checked'] == 1 ? 'completed' : 'pending');

                // Set styling based on status
                switch(strtolower($currentStatus)) {
                    case 'completed':
                        $bg = "bg-success";
                        $textColor = "text-white";
                        $badgeBg = "bg-light text-success";
                        $icon = "<i class='fa fa-check-circle'></i>";
                        $statusText = "Completed";
                        $borderColor = "border-success";
                        break;
                    case 'pending':
                        $bg = "bg-warning";
                        $textColor = "text-dark";
                        $badgeBg = "bg-light text-warning";
                        $icon = "<i class='fa fa-clock'></i>";
                        $statusText = "Pending";
                        $borderColor = "border-warning";
                        break;
                    case 'hold':
                        $bg = "bg-info";
                        $textColor = "text-white";
                        $badgeBg = "bg-light text-info";
                        $icon = "<i class='fa fa-pause-circle'></i>";
                        $statusText = "On Hold";
                        $borderColor = "border-info";
                        break;
                    case 'canceled':
                        $bg = "bg-danger";
                        $textColor = "text-white";
                        $badgeBg = "bg-light text-danger";
                        $icon = "<i class='fa fa-times-circle'></i>";
                        $statusText = "Canceled";
                        $borderColor = "border-danger";
                        break;
                    default:
                        $bg = "bg-secondary";
                        $textColor = "text-white";
                        $badgeBg = "bg-light text-dark";
                        $icon = "<i class='fa fa-question-circle'></i>";
                        $statusText = ucfirst($currentStatus);
                        $borderColor = "border-secondary";
                }
                ?>
                <div class="card border-0 shadow-sm <?= $borderColor ?> border-left border-4">
                    <div class="card-header <?= $bg ?> <?= $textColor ?>">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="mb-0 font-weight-bold">
                                <?= $icon ?> <?= $milestones['milestones'] ?>
                                <span class="badge <?= $badgeBg ?> ml-2"><?= $statusText ?></span>
                            </h4>
                            <span class="font-weight-semibold">
                                <i class="fas fa-calendar-alt mr-1"></i>
                                <?= dateforms($milestones['checked_date']) ?>
                            </span>
                        </div>
                    </div>
                    <div class="card-body bg-white">
                        <p class="mb-0">
                            <?= !empty($milestones['notes']) ? nl2br(htmlspecialchars($milestones['notes'])) : '<em class="text-muted">The Milestone is completed</em>' ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Files Section -->
        <div class="row mb-4">
            <div class="col-12">
                <h2 class="mb-3 font-weight-bold text-dark">
                    <i class="fas fa-folder-open mr-2"></i>Files
                </h2>
            </div>

            <?php if (!empty($milefiles)): ?>
                <?php foreach ($milefiles as $file) : ?>
                    <div class="col-lg-2 col-md-3 col-sm-4 col-6 mb-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="position-relative">
                                <img class="card-img-top" style="height: 150px; object-fit: cover;" src="<?= imgfilecheck($file['filepath']) ?>" alt="Milestone file">
                                <div class="position-absolute top-0 end-0 p-2">
                                    <span class="badge bg-primary bg-opacity-75">
                                        <i class="fas fa-image"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-white border-top d-flex justify-content-around p-2">
                                <a href="<?= base_url($file['filepath']) ?>" class="btn btn-sm btn-outline-primary" title="Download" download>
                                    <i class="fa fa-download"></i>
                                </a>
                                <a href="<?= base_url($file['filepath']) ?>" class="btn btn-sm btn-outline-info" title="View" target="_blank">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#del<?= $file['id'] ?>" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>

                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="del<?= $file['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <form action="<?= base_url('delete_milestone_file') ?>" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="file_id" value="<?= $file['id'] ?>">
                                        <div class="modal-content border-0 shadow">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title font-weight-semibold">
                                                    <i class="fa fa-exclamation-triangle mr-2"></i> Confirm Delete
                                                </h5>
                                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p class="mb-3">Are you sure you want to delete this file?</p>
                                                <div class="text-center">
                                                    <img class="img-fluid rounded shadow-sm" style="max-height: 300px;" src="<?= imgfilecheck($file['filepath']) ?>" alt="File preview">
                                                </div>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                                                    <i class="fas fa-times mr-1"></i> Cancel
                                                </button>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash-alt mr-1"></i> Delete
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- ./modal -->
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info border-0 shadow-sm" role="alert">
                        <i class="fas fa-info-circle mr-2"></i>
                        No files uploaded yet. Click "Upload Milestone Files" to add files.
                    </div>
                </div>
            <?php endif; ?>
        </div>


    </div>
    <!-- /.container-fluid -->

</body>

<?= $this->endSection() ?>