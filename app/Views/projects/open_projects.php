<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><i class="fas fa-project-diagram text-primary"></i> <?= $pro['name'] ?></h1>
                <p class="text-muted mb-0"><i class="fas fa-cog"></i> Project Settings & Management</p>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>projects"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Projects</a></li>
                    <li class="breadcrumb-item active"><?= $pro['name'] ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
    <div class="container-fluid">

        <!-- Welcome Card -->
        <div class="card mb-3" style="border-left: 4px solid #007bff;">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h4 class="mb-1"><i class="fas fa-folder-open text-primary"></i> <?= $pro['name'] ?></h4>
                        <p class="text-muted mb-0">
                            <span class="badge bg-primary me-2"><?= $pro['procode'] ?></span>
                            <span class="text-muted">Status: <strong><?= strtoupper($pro['status']) ?></strong></span>
                        </p>
                    </div>
                    <div class="col-md-4 text-end mt-3 mt-md-0">
                        <a href="<?= base_url() ?>projects" class="btn btn-outline-primary">
                            <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back to Projects
                        </a>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Project Information Card -->
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fa fa-info-circle"></i> Project Information
                        </h5>
                        <a href="<?= base_url() ?>edit_projects/<?= $pro['procode'] ?>" class="btn btn-light btn-sm">
                            <i class="fa fa-pen"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-barcode text-primary"></i> Project Code</label>
                            <p class="fw-bold mb-0"><?= $pro['procode'] ?></p>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-tag text-success"></i> Project Name</label>
                            <p class="fw-bold mb-0"><?= $pro['name'] ?></p>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-calendar text-info"></i> Project Date</label>
                            <p class="fw-bold mb-0"><?= dateforms($pro['pro_date']) ?></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-map-marker-alt text-danger"></i> Project Site</label>
                            <p class="mb-0"><?= $pro['pro_site'] ?></p>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="text-muted small mb-1"><i class="fas fa-globe text-warning"></i> Location</label>
                            <p class="mb-0">
                                <?= $set_country['name'] ?? 'N/A' ?>,
                                <?= $get_provinces['name'] ?? 'N/A' ?>,
                                <?= $get_districts['name'] ?? 'N/A' ?>
                                <?php if (!empty($get_llgs['name'])): ?>
                                    , <?= $get_llgs['name'] ?>
                                <?php endif; ?>
                            </p>
                        </div>
                        <div class="col-md-12">
                            <label class="text-muted small mb-1"><i class="fas fa-file-alt text-secondary"></i> Project Description</label>
                            <p class="mb-0"><?= $pro['description'] ?></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <small class="text-muted">
                        <i class="fas fa-clock"></i> <strong>Last Update:</strong>
                        <?= datetimeforms($pro['pro_update_at']) ?> by <?= $pro['pro_update_by'] ?>
                    </small>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-lg-4">
            <div class="row">
                <div class="col-12 mb-3">
                    <!-- Status Card -->
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <i class="fas fa-business-time"></i> Project Status
                                </h6>
                                <a href="<?= base_url() ?>edit_projects_status/<?= $pro['procode'] ?>" class="btn btn-light btn-sm">
                                    <i class="fa fa-pen"></i> Edit
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-3">
                                <?php
                                $statusColor = 'secondary';
                                $statusIcon = 'fa-circle';
                                switch(strtolower($pro['status'])) {
                                    case 'active':
                                        $statusColor = 'success';
                                        $statusIcon = 'fa-check-circle';
                                        break;
                                    case 'completed':
                                        $statusColor = 'primary';
                                        $statusIcon = 'fa-flag-checkered';
                                        break;
                                    case 'hold':
                                        $statusColor = 'warning';
                                        $statusIcon = 'fa-pause-circle';
                                        break;
                                    case 'canceled':
                                        $statusColor = 'secondary';
                                        $statusIcon = 'fa-times-circle';
                                        break;
                                }
                                ?>
                                <div class="mb-3">
                                    <i class="fas <?= $statusIcon ?> text-<?= $statusColor ?>" style="font-size: 3rem;"></i>
                                </div>
                                <h4 class="mb-2">
                                    <span class="badge bg-<?= $statusColor ?>"><?= strtoupper($pro['status']) ?></span>
                                </h4>
                            </div>
                            <?php if (!empty($pro['statusnotes'])): ?>
                                <div class="alert alert-light border mb-0">
                                    <small class="text-muted"><?= $pro['statusnotes'] ?></small>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-footer bg-light">
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> <strong>Updated:</strong>
                                <?= datetimeforms($pro['status_at']) ?> by <?= $pro['status_by'] ?>
                            </small>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>

                <div class="col-12">
                    <!-- Budget Card -->
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">
                                    <i class="fas fa-dollar-sign"></i> Project Budget
                                </h6>
                                <button class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#edit_project_budget">
                                    <i class="fas fa-pen"></i> Edit
                                </button>
                            </div>
                        </div>

                            <!-- Modal -->
                            <div class="modal fade" id="edit_project_budget" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title">Update Budget</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <?= form_open("edit_project_budget", ['id' => 'editProjectBudgetForm']) ?>
                                        <div class="modal-body text-dark">
                                            <div class="mb-3">
                                                <label for="" class="form-label">Budget Amount</label>
                                                <input class="form-control" type="number" step=".01" min="0" name="budget" id="" value="<?= $pro['budget'] ?>" placeholder="Amount" required>
                                                <small class="form-text text-muted">Enter budgeted amount</small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="" class="form-label">Funding Source</label>
                                                <select name="fund_source" class="form-select">
                                                    <option value="Donor" <?= ($pro['fund'] == 'Donor') ? 'selected' : '' ?>>Donor</option>
                                                    <option value="PIP" <?= ($pro['fund'] == 'PIP') ? 'selected' : '' ?>>PIP</option>
                                                    <option value="Grants" <?= ($pro['fund'] == 'Grants') ? 'selected' : '' ?>>Grants</option>
                                                </select>
                                                <small class="form-text text-muted">Enter Funding Source</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="pro_id" value="<?= $pro['id'] ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-dark" id="btnSaveBudget">Save Budget</button>
                                        </div>
                                        <?= form_close() ?>

                                        <script>
                                            $(document).ready(function() {

                                                // Add keypress event listener to the form input fields
                                                $('#editProjectBudgetForm input').keypress(function(e) {
                                                    if (e.which == 13) {
                                                        e.preventDefault(); // Prevent the default form submission
                                                        $('#btnSaveBudget').click(); // Trigger the AJAX function
                                                    }
                                                });


                                                $('#btnSaveBudget').on('click', function() {

                                                    // Serialize form data
                                                    var formData = $('#editProjectBudgetForm').serialize();

                                                    $.ajax({
                                                        url: "<?= base_url(); ?>edit_project_budget",
                                                        type: 'POST',
                                                        data: formData,
                                                        beforeSend: function() {
                                                            // Display a loading indicator
                                                            $('#btnSaveBudget').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Uploading...');
                                                        },
                                                        success: function(response) {

                                                            // Optionally, display a success message to the user
                                                            if (response.status === 'success') {
                                                                // Display a success message to the user
                                                                toastr.success(response.message);

                                                                // Reload page after 1 second
                                                                setTimeout(function() {
                                                                    location.reload();
                                                                }, 1000);
                                                            } else {
                                                                // Display an error message to the user
                                                                toastr.error(response.message);

                                                                // Reload page after 1 second
                                                                setTimeout(function() {
                                                                    location.reload();
                                                                }, 2000);
                                                            }


                                                        },
                                                        error: function(error) {
                                                            console.log(error.responseText);
                                                        }
                                                    });

                                                });



                                            });
                                        </script>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded">
                                        <div>
                                            <small class="text-muted d-block mb-1">
                                                <i class="fas fa-wallet text-success"></i> Total Budget
                                            </small>
                                            <h4 class="mb-0 text-success fw-bold">
                                                <?= COUNTRY_CURRENCY ?> <?= number_format($pro['budget'], 2) ?>
                                            </h4>
                                        </div>
                                        <div>
                                            <i class="fas fa-money-bill-wave text-success" style="font-size: 2.5rem;"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="text-muted small mb-1">
                                        <i class="fas fa-hand-holding-usd text-primary"></i> Funding Source
                                    </label>
                                    <p class="mb-0">
                                        <span class="badge bg-primary"><?= strtoupper($pro['fund']) ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer bg-light">
                            <small class="text-muted">
                                <i class="fas fa-clock"></i> <strong>Updated:</strong>
                                <?= datetimeforms($pro['budget_at']) ?> by <?= $pro['budget_by'] ?>
                            </small>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- / .col -->

    </div>
    <!-- /.row -->

    <!-- End Project Details -->

    <div class="row mb-3">
        <!-- Project Officer Card -->
        <div class="col-lg-6 mb-3">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="fas fa-user-tie"></i> Project Officer
                        </h6>
                        <a href="<?= base_url() ?>edit_projects_officers/<?= $pro['ucode'] ?>" class="btn btn-light btn-sm">
                            <i class="fas fa-pen"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <div class="me-3">
                                    <i class="fas fa-user text-info" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <small class="text-muted d-block mb-1">Officer Name</small>
                                    <h6 class="mb-0"><?= $pro['pro_officer_name'] ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small mb-1">
                                <i class="fas fa-tasks text-info"></i> Work Scope
                            </label>
                            <p class="mb-0"><?= $pro['pro_officer_scope'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contractor Card -->
        <div class="col-lg-6 mb-3">
            <div class="card h-100">
                <div class="card-header bg-warning text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">
                            <i class="fa fa-wrench"></i> Contractor
                        </h6>
                        <a href="<?= base_url() ?>edit_projects_contractors/<?= $pro['procode'] ?>" class="btn btn-light btn-sm">
                            <i class="fas fa-pen"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                <div class="me-3">
                                    <i class="fas fa-building text-warning" style="font-size: 2rem;"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <small class="text-muted d-block mb-1">Contractor</small>
                                    <h6 class="mb-0"><?= $pro['contractor_code'] ?> - <?= $pro['contractor_name'] ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="text-muted small mb-1">
                                <i class="fas fa-file-contract text-warning"></i> Contract File
                            </label>
                            <p class="mb-0">
                                <?php if (!empty($pro['contract_file'])) : ?>
                                    <a href="<?= base_url() ?><?= $pro['contract_file'] ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-download"></i> Download Contract
                                    </a>
                                <?php else: ?>
                                    <span class="text-muted">No contract file uploaded</span>
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx -->

    <div class="row p-2">

        <!-- main half split -->
        <div class="col-md-12">
            <div class="row">

                <!-- ======================= PHASES AND MILESTONES -->

                <!-- ================== phases and milestones -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info ">
                            <i class="fas fa-clipboard-check    "></i> Phases and Milestones

                            <a href="<?= base_url() ?>project_phases/<?= $pro['procode'] ?>" class="btn btn-dark btn-sm float-end"> <i class="fas fa-pen"></i> Edit </a>

                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group">
                                <?php foreach ($phases as $ph) : ?>
                                    <li class="list-group-item text-dark">
                                        <div class="float-start fw-bolder">
                                            <a class="" href="<?= base_url() ?>open_prophases/<?= $ph['ucode'] ?>">
                                                <strong class="float-start align-bottom"> <i class="fa fa-angle-down" aria-hidden="true"></i> <?= $ph['phases'] ?></strong>

                                            </a>
                                        </div>

                                    </li>
                                    <li class="list-group-item p-0">

                                        <table class="table">
                                            <tbody>
                                                <?php foreach ($milestones as $ms) :
                                                    if ($ms['phase_id'] == $ph['id']) {
                                                        $milestoneStatus = $ms['status'] ?? $ms['checked'];
                                                ?>
                                                        <tr>
                                                            <td scope="row"><?= $ms['milestones'] ?> </td>
                                                            <td><?= dateforms($ms['datefrom']) ?> - <?= dateforms($ms['dateto']) ?></td>
                                                            <td><?= get_status_icon($milestoneStatus) ?></td>
                                                        </tr>
                                                <?php }
                                                endforeach; ?>
                                            </tbody>
                                        </table>

                                    </li>
                                <?php endforeach; ?>
                            </ul>

                        </div>

                    </div>
                </div>






                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info ">
                            <i class="fa fa-file-pdf" aria-hidden="true"></i> Project Files
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-dark float-end" data-bs-toggle="modal" data-bs-target="#prodocs">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Project Files
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="prodocs" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title"> <i class="fas fa-upload"></i> Upload Project Files</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body text-dark">

                                            <?= form_open_multipart('prodocs_upload', ['id' => 'projectFileForm']) ?>
                                            <div class="mb-3">
                                                <label for="exampleInputFile" class="form-label">File Title</label>
                                                <input type="text" name="name" placeholder="File Title" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleInputFile" class="form-label">Upload Project Files</label>
                                                <input type="file" class="form-control" name="prodocs" id="exampleInputFile" required>
                                            </div>

                                            <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                            <input type="hidden" name="proid" value="<?= $pro['id'] ?>">
                                            <button type="button" class="btn btn-dark float-end" id="btnUploadFiles">
                                                <i class="fa fa-save" aria-hidden="true"></i> Save
                                            </button>
                                            <?= form_close() ?>

                                            <script>
                                                $(document).ready(function() {

                                                    // Add keypress event listener to the form input fields
                                                    $('#projectFileForm input').keypress(function(e) {
                                                        if (e.which == 13) {
                                                            e.preventDefault(); // Prevent the default form submission
                                                            $('#btnUploadFiles').click(); // Trigger the AJAX function
                                                        }
                                                    });


                                                    $('#btnUploadFiles').on('click', function() {
                                                        // Create FormData object to store form data and files
                                                        var formData = new FormData($('#projectFileForm')[0]);

                                                        // Send an AJAX request
                                                        $.ajax({
                                                            url: "<?= base_url('prodocs_upload'); ?>", // Update this with your controller method
                                                            type: 'POST',
                                                            data: formData,
                                                            contentType: false,
                                                            processData: false,
                                                            beforeSend: function() {
                                                                // Display a loading indicator
                                                                $('#btnUploadFiles').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Uploading...');
                                                            },
                                                            success: function(response) {
                                                                // Handle the success response
                                                                console.log(response);

                                                                // Optionally, display a success message to the user
                                                                if (response.status === 'success') {
                                                                    // Display a success message to the user
                                                                    toastr.success(response.message);

                                                                    // Reload page after 1 second
                                                                    setTimeout(function() {
                                                                        location.reload();
                                                                    }, 1000);
                                                                } else {
                                                                    // Display an error message to the user
                                                                    toastr.error(response.message);

                                                                    // Reload page after 1 second
                                                                    setTimeout(function() {
                                                                        location.reload();
                                                                    }, 2000);
                                                                }

                                                            },
                                                            error: function(error) {
                                                                // Handle the error response
                                                                console.log(error.responseText);

                                                                // Optionally, display an error message to the user
                                                                toastr.error('Error uploading files.');
                                                            }
                                                        });
                                                    });
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./modal -->
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group">
                                <?php foreach ($prodocs as $pd) : ?>
                                    <li class="list-group-item">
                                        <?= $pd['name'] ?>(.<?= getfileExtension($pd['filepath']) ?>)
                                        <a href="<?= base_url() ?><?= $pd['filepath'] ?>" class="btn btn-default btn-sm text-bold">
                                            <i class="fa fa-download" aria-hidden="true"></i> Download
                                        </a>

                                        <div class="float-end">
                                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                                Action
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editprodocs<?= $pd['id'] ?>">Edit</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                                <li><a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#delprodocs<?= $pd['id'] ?>">Delete</a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editprodocs<?= $pd['id'] ?>" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header bg-dark text-white">
                                                    <h5 class="modal-title"> <i class="fas fa-edit"></i> Project Files</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body text-dark">

                                                    <?= form_open_multipart('prodocs_edit', ['id' => 'editProDocsForm' . $pd['id']]) ?>

                                                    <div class="mb-3">
                                                        <label for="exampleInputFile" class="form-label">File Title</label>
                                                        <input type="text" name="name" placeholder="File Title" class="form-control" value="<?= $pd['name'] ?>" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="exampleInputFile" class="form-label">Project Files</label>
                                                        <input type="file" class="form-control" name="prodocs" id="exampleInputFile">
                                                    </div>

                                                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                                    <input type="hidden" name="pdid" value="<?= $pd['id'] ?>">
                                                    <button type="button" class="btn btn-dark float-end" id="btnEditProdocs<?= $pd['id'] ?>">
                                                        <i class="fa fa-save" aria-hidden="true"></i> Save
                                                    </button>
                                                    <?= form_close() ?>


                                                    <script>
                                                        $(document).ready(function() {


                                                            // Add keypress event listener to the form input fields
                                                            $('#editProDocsForm<?= $pd['id'] ?> input').keypress(function(e) {
                                                                if (e.which == 13) {
                                                                    e.preventDefault(); // Prevent the default form submission
                                                                    $('#btnEditProdocs<?= $pd['id'] ?>').click(); // Trigger the AJAX function
                                                                }
                                                            });


                                                            $('#btnEditProdocs<?= $pd['id'] ?>').on('click', function() {
                                                                // Create FormData object to store form data and files
                                                                var formData = new FormData($('#editProDocsForm<?= $pd['id'] ?>')[0]);

                                                                // Send an AJAX request
                                                                $.ajax({
                                                                    url: "<?= base_url('prodocs_edit'); ?>", // Update this with your controller method
                                                                    type: 'POST',
                                                                    data: formData,
                                                                    contentType: false,
                                                                    processData: false,
                                                                    beforeSend: function() {
                                                                        // Display a loading indicator
                                                                        $('#btnEditProdocs<?= $pd['id'] ?>').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Uploading...');
                                                                    },
                                                                    success: function(response) {
                                                                        // Handle the success response
                                                                        console.log(response);

                                                                        // Optionally, display a success message to the user
                                                                        toastr.success(response.message);

                                                                        // Reload page after 1 seconds
                                                                        setTimeout(function() {
                                                                            location.reload();
                                                                        }, 1000);
                                                                    },
                                                                    error: function(error) {
                                                                        // Handle the error response
                                                                        console.log(error.responseText);

                                                                        // Optionally, display an error message to the user
                                                                        toastr.error(response.message);
                                                                    }
                                                                });
                                                            });
                                                        });
                                                    </script>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./modal -->

                                    <!-- Modal -->
                                    <div class="modal fade" id="delprodocs<?= $pd['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title"> <i class="fas fa-exclamation-triangle"></i> You're about to Delete! </h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body text-dark">

                                                    <?= form_open_multipart('prodocs_delete', ['id' => 'delProDocsForm' . $pd['id']]) ?>

                                                    <div class="mb-3">
                                                        <label for="exampleInputFile" class="form-label">File Title</label>
                                                        <div>
                                                            <?= $pd['name'] ?>(.<?= getfileExtension($pd['filepath']) ?>)
                                                        </div>
                                                    </div>

                                                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                                    <input type="hidden" name="pdid" value="<?= $pd['id'] ?>">
                                                    <input type="hidden" name="pdname" value="<?= $pd['name'] ?>">
                                                    <button type="button" class="btn btn-danger float-end" id="btnDelProdocs<?= $pd['id'] ?>">
                                                        <i class="fa fa-trash-alt" aria-hidden="true"></i> Delete
                                                    </button>
                                                    <?= form_close() ?>


                                                    <script>
                                                        $(document).ready(function() {

                                                            // Add keypress event listener to the form input fields
                                                            $('#delProDocsForm<?= $pd['id'] ?> input').keypress(function(e) {
                                                                if (e.which == 13) {
                                                                    e.preventDefault(); // Prevent the default form submission
                                                                    $('#btnDelProdocs<?= $pd['id'] ?>').click(); // Trigger the AJAX function
                                                                }
                                                            });


                                                            $('#btnDelProdocs<?= $pd['id'] ?>').on('click', function() {
                                                                // Create FormData object to store form data and files
                                                                var formData = new FormData($('#delProDocsForm<?= $pd['id'] ?>')[0]);

                                                                // Send an AJAX request
                                                                $.ajax({
                                                                    url: "<?= base_url('prodocs_delete'); ?>", // Update this with your controller method
                                                                    type: 'POST',
                                                                    data: formData,
                                                                    contentType: false,
                                                                    processData: false,
                                                                    beforeSend: function() {
                                                                        // Display a loading indicator
                                                                        $('#btnDelProdocs<?= $pd['id'] ?>').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Deleting...');
                                                                    },
                                                                    success: function(response) {
                                                                        // Handle the success response
                                                                        console.log(response);

                                                                        // Optionally, display a success message to the user
                                                                        if (response.status === 'success') {
                                                                            // Display a success message to the user
                                                                            toastr.success(response.message);

                                                                            // Reload page after 1 second
                                                                            setTimeout(function() {
                                                                                location.reload();
                                                                            }, 1000);
                                                                        } else {
                                                                            // Display an error message to the user
                                                                            toastr.error(response.message);

                                                                            // Reload page after 1 second
                                                                            setTimeout(function() {
                                                                                location.reload();
                                                                            }, 2000);
                                                                        }

                                                                    },
                                                                    error: function(error) {
                                                                        // Handle the error response
                                                                        console.log(error.responseText);

                                                                        // Optionally, display an error message to the user
                                                                        toastr.error(response.message);
                                                                    }
                                                                });
                                                            });
                                                        });
                                                    </script>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./modal -->

                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                </div>
                <!-- ./ col -->


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            <i class="fas fa-money-check-alt "></i> Project Payments

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-sm btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addfund">
                                <i class="fas fa-plus-circle"></i> Add Payments
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="addfund" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark text-white">
                                            <h5 class="modal-title"> <i class="fas fa-dollar-sign"></i> Add Payment</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <?= form_open_multipart('addpayments', ['id' => 'addpaymentsForm']) ?>
                                        <div class="modal-body text-dark">
                                            <div class="mb-3">
                                                <label for="inputName" class="form-label">Amount</label>
                                                <input type="number" step=".01" class="form-control" name="amount" id="inputName" placeholder="0000.00" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="inputName" class="form-label">Payment Date</label>
                                                <input type="date" class="form-control" name="paymentdate" id="inputName" placeholder="Date" required>
                                            </div>

                                            <div class="mb-3">
                                                <textarea id="my-textarea" class="form-control" name="description" placeholder="Enter Description" rows="3" required></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleInputFile" class="form-label">Upload Payment Files</label>
                                                <input type="file" class="form-control" name="file_payment" id="file_payment" required accept=".pdf">
                                                <small class="text-muted">
                                                    Upload the files for this payment
                                                </small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-dark" id="btnAddPayments"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Post Payment</button>
                                        </div>
                                        <?= form_close() ?>

                                        <script>
                                            $(document).ready(function() {

                                                // Add keypress event listener to the form input fields
                                                $('#addpaymentsForm input').keypress(function(e) {
                                                    if (e.which == 13) {
                                                        e.preventDefault(); // Prevent the default form submission
                                                        $('#btnAddPayments').click(); // Trigger the AJAX function
                                                    }
                                                });



                                                $('#btnAddPayments').on('click', function() {

                                                    // Check if a file is selected
                                                    var fileInput = $('#file_payment');
                                                    if (fileInput.get(0).files.length === 0) {
                                                        // Display an error message for file selection
                                                        toastr.error('Please select a file.');
                                                        return;
                                                    }

                                                    // Check if the selected file has the correct extension (.pdf)
                                                    var allowedExtensions = /(\.pdf)$/i;
                                                    if (!allowedExtensions.exec(fileInput.val())) {
                                                        // Display an error message for file type
                                                        toastr.error('Please select a PDF file.');
                                                        return;
                                                    }


                                                    // Create FormData object to store form data and files
                                                    var formData = new FormData($('#addpaymentsForm')[0]);

                                                    // Send an AJAX request
                                                    $.ajax({
                                                        url: "<?= base_url('addpayments'); ?>", // Update this with your controller method
                                                        type: 'POST',
                                                        data: formData,
                                                        contentType: false,
                                                        processData: false,
                                                        beforeSend: function() {
                                                            // Display a loading indicator
                                                            $('#btnAddPayments').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Uploading...');
                                                        },
                                                        success: function(response) {
                                                            // Handle the success response
                                                            console.log(response);
                                                            // Optionally, display a success message to the user
                                                            if (response.status === 'success') {
                                                                // Display a success message to the user
                                                                toastr.success(response.message);

                                                                // Reload page after 1 second
                                                                setTimeout(function() {
                                                                    location.reload();
                                                                }, 1000);
                                                            } else {
                                                                // Display an error message to the user
                                                                toastr.error(response.message);

                                                                // Reload page after 1 second
                                                                setTimeout(function() {
                                                                    location.reload();
                                                                }, 2000);
                                                            }

                                                        },
                                                        error: function(error) {
                                                            // Handle the error response
                                                            console.log(error.responseText);

                                                            // Optionally, display an error message to the user
                                                            toastr.error(response.message);
                                                        }
                                                    });
                                                });
                                            });
                                        </script>


                                    </div>
                                </div>
                            </div>
                            <!-- ./ modal -->

                        </div>
                        <div class="card-body p-0">

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-light table-hover">
                                        <thead class="">
                                            <tr>
                                                <th>#</th>
                                                <th>Amount(<?= COUNTRY_CURRENCY ?>)</th>
                                                <th>P.Date</th>
                                                <th>Notes</th>
                                                <th>File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = array();
                                            $x = 1;
                                            foreach ($fund as $fd) : ?>
                                                <tr>
                                                    <td><?= $x++ ?></td>
                                                    <td data-bs-toggle="tooltip" data-bs-placement="top" title="<?= $fd['description'] ?>"><?= $total[] = number_format($fd['amount'], 2) ?></td>
                                                    <td><?= dateforms($fd['paymentdate']) ?></td>
                                                    <td><?= ($fd['description']) ?></td>
                                                    <td>
                                                        <?php if ($fd['filepath'] != "") : ?>
                                                            <a class=" btn btn-flat text-dark" href="<?= filecheck($fd['filepath']) ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td> <span class="btn btn-dark btn-sm float-end" data-bs-toggle="modal" data-bs-target="#editfund<?= $fd['id'] ?>"> <i class="fas fa-pen"></i> Edit</span></td>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editfund<?= $fd['id'] ?>" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-dark text-white">
                                                                    <h5 class="modal-title"> <i class="fas fa-edit"></i> Edit Payment</h5>
                                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <?= form_open_multipart('editpayments', ['id' => 'editpaymentsForm' . $fd['id']]) ?>
                                                                <div class="modal-body">

                                                                    <div class="mb-3">
                                                                        <label for="inputName" class="form-label">Amount</label>
                                                                        <input type="number" step=".01" class="form-control" name="amount" id="inputName" placeholder="0000.00" required value="<?= $fd['amount'] ?>">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="inputName" class="form-label">Payment Date</label>
                                                                        <input type="date" class="form-control" name="paymentdate" id="inputName" placeholder="Date" required value="<?= $fd['paymentdate'] ?>">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <textarea id="my-textarea" class="form-control" name="description" placeholder="Enter Description" rows="3" required><?= $fd['description'] ?></textarea>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="exampleInputFile" class="form-label">Upload Payment Files</label>
                                                                        <input type="file" class="form-control" name="file_payment" id="exampleInputFile">
                                                                        <small class="text-muted">
                                                                            Upload the files for this payment
                                                                        </small>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-between">
                                                                    <span class="float-start">
                                                                        <small class="float-start"><b>Create:</b> <?= datetimeforms($fd['create_at']) ?> | <?= $fd['create_by'] ?></small><br>
                                                                        <small><b>Update:</b> <?= datetimeforms($fd['update_at']) ?> | <?= $fd['update_by'] ?></small>
                                                                    </span>
                                                                    <div>
                                                                        <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                                                        <input type="hidden" name="payid" value="<?= $fd['id'] ?>">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="button" class="btn btn-dark" id="btnsEditPayments<?= $fd['id'] ?>">Update Payment</button>
                                                                    </div>

                                                                </div>
                                                                <?= form_close() ?>

                                                                <script>
                                                                    $(document).ready(function() {

                                                                        // Add keypress event listener to the form input fields
                                                                        $('#editpaymentsForm<?= $fd['id'] ?> input').keypress(function(e) {
                                                                            if (e.which == 13) {
                                                                                e.preventDefault(); // Prevent the default form submission
                                                                                $('#btnsEditPayments<?= $fd['id'] ?>').click(); // Trigger the AJAX function
                                                                            }
                                                                        });


                                                                        $('#btnsEditPayments<?= $fd['id'] ?>').on('click', function() {
                                                                            // Create FormData object to store form data and files
                                                                            var formData = new FormData($('#editpaymentsForm<?= $fd['id'] ?>')[0]);

                                                                            // Send an AJAX request
                                                                            $.ajax({
                                                                                url: "<?= base_url('editpayments'); ?>", // Update this with your controller method
                                                                                type: 'POST',
                                                                                data: formData,
                                                                                contentType: false,
                                                                                processData: false,
                                                                                beforeSend: function() {
                                                                                    // Display a loading indicator
                                                                                    $('#btnsEditPayments<?= $fd['id'] ?>').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
                                                                                },
                                                                                success: function(response) {
                                                                                    // Handle the success response
                                                                                    console.log(response);

                                                                                    // Optionally, display a success message to the user
                                                                                    if (response.status === 'success') {
                                                                                        // Display a success message to the user
                                                                                        toastr.success(response.message);

                                                                                        // Reload page after 1 second
                                                                                        setTimeout(function() {
                                                                                            location.reload();
                                                                                        }, 3000);
                                                                                    } else {
                                                                                        // Display an error message to the user
                                                                                        toastr.error(response.message);

                                                                                        // Reload page after 1 second
                                                                                        setTimeout(function() {
                                                                                            location.reload();
                                                                                        }, 3000);
                                                                                    }

                                                                                },
                                                                                error: function(error) {
                                                                                    // Handle the error response
                                                                                    console.log(error.responseText);

                                                                                    // Optionally, display an error message to the user
                                                                                    toastr.error(response.message);
                                                                                }
                                                                            });
                                                                        });
                                                                    });
                                                                </script>


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- ./ modal -->
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <b>Totals</b>
                            <address>
                                <?php $paid = array();
                                $x = 1;
                                foreach ($fund as $fd) : ?>
                                    <?php (($paid[] = $fd['amount'])) ?>
                                <?php endforeach; ?>
                                Budgeted: <span class="float-end"><?= COUNTRY_CURRENCY ?> <?= number_format($pro['budget'], 2) ?></span> <br>
                                Paid: <span class="float-end"><?= COUNTRY_CURRENCY ?> <?= number_format($yetto = array_sum($paid), 2) ?></span> <br>

                                <b> Outstanding: <span class="float-end"><?= COUNTRY_CURRENCY ?> <?= number_format(($pro['budget'] - $yetto), 2) ?></span></b>

                            </address>
                        </div>
                    </div>
                </div>
                <!-- ./col -->


                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-map-marked-alt"></i> Project Location Map
                                    <?php if (!empty($pro['gps'])): ?>
                                        <small class="badge bg-light text-dark ms-2"><?= $pro['gps'] ?></small>
                                    <?php endif; ?>
                                </h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#setgps">
                                    <i class="fas fa-map-marker-alt"></i> Set Coordinates
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade" id="setgps" tabindex="-1" aria-labelledby="setgpsLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="setgpsLabel">
                                                <i class="fas fa-map-marked-alt"></i> Set GPS Coordinates & Upload KML
                                            </h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <?= form_open_multipart('gps_set', ['id' => 'gps_setForm']) ?>

                                            <div class="alert alert-info">
                                                <i class="fas fa-info-circle"></i> <strong>Tip:</strong> You can upload multiple KML files to display different tracks or routes on the map.
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="gps_lat" class="form-label">
                                                        <i class="fas fa-map-pin"></i> Latitude <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="lat" id="gps_lat" placeholder="-9.290771" value="<?= $pro['lat'] ?>" required>
                                                    <div class="form-text">Example: -9.290771</div>
                                                </div>

                                                <div class="col-md-6 mb-3">
                                                    <label for="gps_lon" class="form-label">
                                                        <i class="fas fa-map-pin"></i> Longitude <span class="text-danger">*</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="lon" id="gps_lon" placeholder="146.995628" value="<?= $pro['lon'] ?>" required>
                                                    <div class="form-text">Example: 146.995628</div>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="kml_file_upload" class="form-label">
                                                    <i class="fas fa-file-upload"></i> Upload KML File
                                                </label>
                                                <input type="file" class="form-control" name="file_basekml" id="kml_file_upload" accept=".kml">
                                                <div class="form-text">
                                                    <i class="fas fa-info-circle"></i> Upload a .KML file to display routes, tracks, or polygons on the map
                                                </div>
                                            </div>

                                            <input type="hidden" name="proucode" value="<?= $pro['ucode'] ?>">
                                            <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                            <input type="hidden" name="proid" value="<?= $pro['id'] ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fas fa-times"></i> Cancel
                                            </button>
                                            <button type="button" class="btn btn-primary" id="btn_savegps">
                                                <i class="fas fa-save"></i> Save GPS Data
                                            </button>
                                        </div>
                                        <?= form_close() ?>
                                    </div>
                                </div>
                            </div>
                            <!-- ./modal -->

                            <script>
                                $(document).ready(function() {
                                    // Add keypress event listener to the form input fields
                                    $('#gps_setForm input').keypress(function(e) {
                                        if (e.which == 13) {
                                            e.preventDefault();
                                            $('#btn_savegps').click();
                                        }
                                    });

                                    $('#btn_savegps').on('click', function() {
                                        var formData = new FormData($('#gps_setForm')[0]);

                                        $.ajax({
                                            url: "<?= base_url('gps_set'); ?>",
                                            type: 'POST',
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            beforeSend: function() {
                                                $('#btn_savegps').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
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
                                                    $('#btn_savegps').prop('disabled', false).html('<i class="fas fa-save"></i> Save GPS Data');
                                                }
                                            },
                                            error: function(error) {
                                                console.log(error.responseText);
                                                toastr.error('An error occurred while saving GPS data');
                                                $('#btn_savegps').prop('disabled', false).html('<i class="fas fa-save"></i> Save GPS Data');
                                            }
                                        });
                                    });
                                });
                            </script>

                            <!-- =============================================================================== -->

                        </div>
                        <div class="card-body p-0">
                            <!-- Map Controls -->
                            <?php if (!empty($kmlfiles)): ?>
                            <div class="p-3 bg-light border-bottom">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h6 class="mb-0"><i class="fas fa-layer-group"></i> KML Layers</h6>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-primary" id="showAllLayers">
                                            <i class="fas fa-eye"></i> Show All
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary" id="hideAllLayers">
                                            <i class="fas fa-eye-slash"></i> Hide All
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-2" id="layerControls">
                                    <!-- Layer controls will be added here dynamically -->
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Map Container -->
                            <div id="map" style="height: 600px; width: 100%;"></div>

                            <!-- OpenLayers CSS and JS -->
                            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@v7.5.2/ol.css" type="text/css">
                            <script src="https://cdn.jsdelivr.net/npm/ol@v7.5.2/dist/ol.js"></script>

                            <style>
                                #map {
                                    position: relative;
                                }
                                .ol-popup {
                                    position: absolute;
                                    background-color: white;
                                    box-shadow: 0 3px 14px rgba(0,0,0,0.4);
                                    padding: 15px;
                                    border-radius: 10px;
                                    border: 1px solid #cccccc;
                                    bottom: 12px;
                                    left: -50px;
                                    min-width: 200px;
                                }
                                .ol-popup:after, .ol-popup:before {
                                    top: 100%;
                                    border: solid transparent;
                                    content: " ";
                                    height: 0;
                                    width: 0;
                                    position: absolute;
                                    pointer-events: none;
                                }
                                .ol-popup:after {
                                    border-top-color: white;
                                    border-width: 10px;
                                    left: 48px;
                                    margin-left: -10px;
                                }
                                .ol-popup:before {
                                    border-top-color: #cccccc;
                                    border-width: 11px;
                                    left: 48px;
                                    margin-left: -11px;
                                }
                                .ol-popup-closer {
                                    text-decoration: none;
                                    position: absolute;
                                    top: 5px;
                                    right: 8px;
                                    color: #666;
                                }
                                .ol-popup-closer:hover {
                                    color: #000;
                                }
                                .layer-control-item {
                                    padding: 0.5rem;
                                    border-radius: 0.25rem;
                                    background: white;
                                    margin-bottom: 0.25rem;
                                }
                                .layer-control-item:hover {
                                    background: #f8f9fa;
                                }
                            </style>

                            <script>
                            $(document).ready(function() {
                                try {
                                    // Function to get color based on project status
                                    function getStatusColor(status) {
                                        switch(status ? status.toLowerCase() : '') {
                                            case 'active':
                                                return '#28a745'; // Green
                                            case 'completed':
                                                return '#007bff'; // Blue
                                            case 'hold':
                                                return '#ffc107'; // Yellow/Amber
                                            case 'canceled':
                                                return '#6c757d'; // Gray
                                            default:
                                                return '#6c757d'; // Gray (default)
                                        }
                                    }

                                    // Get project status color
                                    const projectStatus = '<?= $pro['status'] ?? '' ?>';
                                    const statusColor = getStatusColor(projectStatus);

                                    // Create base map layer
                                    const osmLayer = new ol.layer.Tile({
                                        source: new ol.source.OSM()
                                    });

                                    // Store KML layers
                                    const kmlLayers = [];
                                    const layerInfo = [];

                                    <?php if (!empty($kmlfiles)): ?>
                                        // Create KML layers from database
                                        <?php $colorIndex = 0; ?>
                                        <?php foreach ($kmlfiles as $index => $kml): ?>
                                            <?php if (!empty($kml['filepath'])): ?>
                                                (function() {
                                                    const kmlSource<?= $index ?> = new ol.source.Vector({
                                                        url: '<?= base_url() . $kml['filepath'] ?>',
                                                        format: new ol.format.KML({
                                                            extractStyles: false,
                                                            extractAttributes: true,
                                                        })
                                                    });

                                                    const kmlLayer<?= $index ?> = new ol.layer.Vector({
                                                        source: kmlSource<?= $index ?>,
                                                        style: function(feature) {
                                                            const geometryType = feature.getGeometry().getType();

                                                            if (geometryType === 'LineString' || geometryType === 'MultiLineString') {
                                                                return new ol.style.Style({
                                                                    stroke: new ol.style.Stroke({
                                                                        color: statusColor,
                                                                        width: 3
                                                                    })
                                                                });
                                                            } else if (geometryType === 'Point') {
                                                                return new ol.style.Style({
                                                                    image: new ol.style.Circle({
                                                                        radius: 6,
                                                                        fill: new ol.style.Fill({
                                                                            color: statusColor
                                                                        }),
                                                                        stroke: new ol.style.Stroke({
                                                                            color: '#fff',
                                                                            width: 2
                                                                        })
                                                                    })
                                                                });
                                                            } else if (geometryType === 'Polygon' || geometryType === 'MultiPolygon') {
                                                                return new ol.style.Style({
                                                                    stroke: new ol.style.Stroke({
                                                                        color: statusColor,
                                                                        width: 2
                                                                    }),
                                                                    fill: new ol.style.Fill({
                                                                        color: statusColor + '33'
                                                                    })
                                                                });
                                                            }
                                                        },
                                                        visible: true
                                                    });

                                                    kmlLayers.push(kmlLayer<?= $index ?>);
                                                    layerInfo.push({
                                                        layer: kmlLayer<?= $index ?>,
                                                        name: 'KML <?= $index + 1 ?>',
                                                        date: '<?= datetimeforms($kml['create_at']) ?>',
                                                        by: '<?= $kml['create_by'] ?>',
                                                        color: statusColor,
                                                        url: '<?= base_url() . $kml['filepath'] ?>'
                                                    });
                                                })();
                                                <?php $colorIndex++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    // Create project marker
                                    const projectMarker = new ol.Feature({
                                        geometry: new ol.geom.Point(
                                            ol.proj.fromLonLat([<?= $pro['lon'] ?>, <?= $pro['lat'] ?>])
                                        ),
                                        name: '<?= addslashes($pro['name']) ?>',
                                        code: '<?= $pro['procode'] ?>'
                                    });

                                    const markerLayer = new ol.layer.Vector({
                                        source: new ol.source.Vector({
                                            features: [projectMarker]
                                        }),
                                        style: new ol.style.Style({
                                            image: new ol.style.Circle({
                                                radius: 10,
                                                fill: new ol.style.Fill({
                                                    color: statusColor
                                                }),
                                                stroke: new ol.style.Stroke({
                                                    color: '#fff',
                                                    width: 3
                                                })
                                            })
                                        })
                                    });

                                    // Create map
                                    const map = new ol.Map({
                                        target: 'map',
                                        layers: [osmLayer, ...kmlLayers, markerLayer],
                                        view: new ol.View({
                                            center: ol.proj.fromLonLat([<?= $pro['lon'] ?>, <?= $pro['lat'] ?>]),
                                            zoom: 13
                                        })
                                    });

                                    // Add popup overlay
                                    const popupContainer = document.createElement('div');
                                    popupContainer.className = 'ol-popup';
                                    popupContainer.innerHTML = '<a href="#" class="ol-popup-closer">&times;</a><div id="popup-content"></div>';
                                    document.body.appendChild(popupContainer);

                                    const popup = new ol.Overlay({
                                        element: popupContainer,
                                        positioning: 'bottom-center',
                                        stopEvent: false,
                                        offset: [0, -10]
                                    });
                                    map.addOverlay(popup);

                                    const popupCloser = popupContainer.querySelector('.ol-popup-closer');
                                    popupCloser.onclick = function() {
                                        popup.setPosition(undefined);
                                        popupCloser.blur();
                                        return false;
                                    };

                                    // Handle map clicks
                                    map.on('click', function(evt) {
                                        const feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                                            return feature;
                                        });

                                        if (feature) {
                                            const coordinates = evt.coordinate;
                                            const name = feature.get('name') || 'Feature';
                                            const code = feature.get('code') || '';
                                            const content = document.getElementById('popup-content');
                                            content.innerHTML = '<strong>' + name + '</strong>' + (code ? '<br><span class="badge bg-primary">' + code + '</span>' : '');
                                            popup.setPosition(coordinates);
                                        }
                                    });

                                    // Change cursor on hover
                                    map.on('pointermove', function(e) {
                                        const pixel = map.getEventPixel(e.originalEvent);
                                        const hit = map.hasFeatureAtPixel(pixel);
                                        const target = map.getTarget();
                                        if (target && typeof target === 'string') {
                                            const element = document.getElementById(target);
                                            if (element) {
                                                element.style.cursor = hit ? 'pointer' : '';
                                            }
                                        } else if (target && target.style) {
                                            target.style.cursor = hit ? 'pointer' : '';
                                        }
                                    });

                                    // Create layer controls
                                    <?php if (!empty($kmlfiles)): ?>
                                    const layerControlsDiv = document.getElementById('layerControls');
                                    layerInfo.forEach((info, index) => {
                                        const controlDiv = document.createElement('div');
                                        controlDiv.className = 'layer-control-item d-flex align-items-center justify-content-between';
                                        controlDiv.innerHTML = `
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input" type="checkbox" id="layer${index}" checked>
                                                <label class="form-check-label" for="layer${index}">
                                                    <span style="display: inline-block; width: 20px; height: 3px; background: ${info.color}; vertical-align: middle; margin-right: 5px;"></span>
                                                    <strong>${info.name}</strong> - <small class="text-muted">${info.date} by ${info.by}</small>
                                                </label>
                                            </div>
                                            <a href="${info.url}" class="btn btn-sm btn-outline-primary" download>
                                                <i class="fas fa-download"></i>
                                            </a>
                                        `;
                                        
                                        const checkbox = controlDiv.querySelector('input');
                                        checkbox.addEventListener('change', function() {
                                            info.layer.setVisible(this.checked);
                                        });
                                        
                                        layerControlsDiv.appendChild(controlDiv);
                                    });

                                    // Show/Hide all buttons
                                    document.getElementById('showAllLayers')?.addEventListener('click', function() {
                                        layerInfo.forEach((info, index) => {
                                            info.layer.setVisible(true);
                                            document.getElementById('layer' + index).checked = true;
                                        });
                                    });

                                    document.getElementById('hideAllLayers')?.addEventListener('click', function() {
                                        layerInfo.forEach((info, index) => {
                                            info.layer.setVisible(false);
                                            document.getElementById('layer' + index).checked = false;
                                        });
                                    });
                                    <?php endif; ?>

                                    // Fit map to show all features
                                    setTimeout(function() {
                                        const extent = markerLayer.getSource().getExtent();
                                        kmlLayers.forEach(layer => {
                                            const layerExtent = layer.getSource().getExtent();
                                            if (layerExtent && !ol.extent.isEmpty(layerExtent)) {
                                                ol.extent.extend(extent, layerExtent);
                                            }
                                        });
                                        
                                        if (!ol.extent.isEmpty(extent)) {
                                            map.getView().fit(extent, {
                                                padding: [50, 50, 50, 50],
                                                maxZoom: 15
                                            });
                                        }
                                    }, 1000);

                                    console.log('Map initialized successfully with ' + kmlLayers.length + ' KML layers');
                                } catch (error) {
                                    console.error('Error initializing map:', error);
                                    document.getElementById('map').innerHTML = '<div class="alert alert-danger m-3">Error loading map. Please check console for details.</div>';
                                }
                            });
                            </script>

                        </div>
                        <div class="card-footer bg-light">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <small class="text-muted">
                                        <?php if (!empty($pro['gps_at'])): ?>
                                            <i class="fas fa-clock"></i> <strong>Last Updated:</strong> <?= datetimeforms($pro['gps_at']) ?>
                                            <?php if (!empty($pro['gps_by'])): ?>
                                                by <?= $pro['gps_by'] ?>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <i class="fas fa-info-circle"></i> No GPS data updated yet
                                        <?php endif; ?>
                                    </small>
                                </div>
                                <div>
                                    <small class="text-muted">
                                        <i class="fas fa-layer-group"></i> <?= count($kmlfiles) ?> KML file<?= count($kmlfiles) != 1 ? 's' : '' ?> loaded
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./ col -->

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-info">
                            Events
                        </div>
                        <div class="card-body">
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">

                                    <?php foreach ($events as $ev) : ?>
                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            <span class="bg-secondary">
                                                <?= dateforms($ev['eventdate']) ?>
                                            </span>
                                        </div>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-calendar-check bg-info"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> <?= datetimeforms($ev['create_at']) ?> </span>

                                                <h3 class="timeline-header"><a href="#"><?= $ev['create_by'] ?></a> posted</h3>

                                                <div class="timeline-body">
                                                    <p><?= $ev['event'] ?></p>
                                                    <div class="row">
                                                        <?php $x = 0;
                                                        foreach ($eventfiles as $ef) :
                                                            if ($ef['event_id'] == $ev['id']) :
                                                        ?>

                                                                <?php
                                                                // Get the file extension
                                                                $file_ext = pathinfo($ef['filepath'], PATHINFO_EXTENSION);

                                                                // Check if the file is an image
                                                                if (!in_array(strtolower($file_ext), array('jpg', 'jpeg', 'png', 'gif'))) {


                                                                    // Display the image in an image tag
                                                                ?>

                                                                    <div class="">
                                                                        <a class=" btn btn-app" href="<?= base_url() ?><?= $ef['filepath'] ?>"> <i class="fa fa-download" aria-hidden="true"></i>
                                                                            <?= $ef['id'] . "(." . $file_ext . ")" ?>
                                                                        </a>
                                                                    </div>

                                                        <?php
                                                                }

                                                            endif;
                                                        endforeach; ?>
                                                    </div>
                                                    <div class="row">
                                                        <?php $x = 0;
                                                        foreach ($eventfiles as $ef) :
                                                            if ($ef['event_id'] == $ev['id']) :
                                                        ?>

                                                                <?php
                                                                // Get the file extension
                                                                $file_ext = pathinfo($ef['filepath'], PATHINFO_EXTENSION);

                                                                // Check if the file is an image
                                                                if (in_array(strtolower($file_ext), array('jpg', 'jpeg', 'png', 'gif'))) {
                                                                    // Display the image in an image tag
                                                                ?>

                                                                    <img class="img img-fluid img-bordered" src="<?= base_url() ?><?= $ef['filepath'] ?>" width="25%" alt="ev-pic">

                                                        <?php

                                                                }
                                                            endif;
                                                        endforeach; ?>
                                                    </div>
                                                </div>
                                                <!-- ./ timeline body -->
                                                <div class="timeline-footer d-flex justify-content-between">
                                                    <span class="float-start"><small>
                                                            <b>Updated: </b><?= datetimeforms($ev['update_at']) ?> | <?= $ev['update_by'] ?>
                                                        </small></span>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->

                                    <?php endforeach; ?>


                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <div class="card-footer">
                            <a href="<?= base_url() ?>public/uploads/audit_files/<?= $pro['procode'] ?>.txt" class="float-end"> <i class="fas fa-pencil-square"></i> Audit Trail</a>
                        </div>

                    </div>
                </div>
                <!-- ./col events -->


            </div>
            <!-- /. first half row -->
        </div>
        <!-- ./ 1st main half split col -->



    </div>
</section>


</body>


<script>
    $(document).ready(function() {
        $('#province').change(function() {
            var province_code = $(this).val();

            $.ajax({
                url: '<?= base_url() ?>getaddress',
                type: 'post',
                data: {
                    province_code: province_code
                },
                dataType: 'json',
                success: function(response) {
                    var len = response.district.length;

                    $("#district").empty();
                    $("#district").append("<option value=''>Select a District</option>");

                    for (var i = 0; i < len; i++) {
                        var code = response.district[i]['districtcode'];
                        var name = response.district[i]['name'];
                        //var code = response.subcategories[i]['code'];

                        $("#district").append("<option value='" + code + "'>" + name +
                            "</option>");

                    }
                }
            });
        });
    });
</script>

<?= $this->endSection() ?>