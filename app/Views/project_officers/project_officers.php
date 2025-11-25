<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Header -->
    <div class="card bg-primary text-white shadow mb-4">
        <div class="card-body px-3 px-md-4 py-3">
            <div class="row align-items-center flex-wrap">
                <div class="col-12 col-md-8 mb-3 mb-md-0">
                    <h2 class="mb-2"><i class="fas fa-user-tie me-2"></i>Project Officers Management</h2>
                    <p class="mb-0">Manage and monitor all project officers in your organization</p>
                </div>
                <div class="col-12 col-md-4 text-md-end">
                    <button type="button" class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#add_project_officers">
                        <i class="fas fa-user-plus me-2"></i> New Officer
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-12 mb-3">
            <h5 class="fw-bold"><i class="fas fa-chart-bar me-2 text-primary"></i>Officers Overview</h5>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="card border-0 shadow h-100">
                <div class="card-body px-3 px-md-4 py-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-primary text-white rounded p-3">
                                <i class="fas fa-users fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-0 fw-bold"><?= $stats['total_officers'] ?></h3>
                            <p class="text-muted mb-0">Total Officers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="card border-0 shadow h-100">
                <div class="card-body px-3 px-md-4 py-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-success text-white rounded p-3">
                                <i class="fas fa-user-check fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-0 fw-bold"><?= $stats['active_count'] ?></h3>
                            <p class="text-muted mb-0">Active Officers</p>
                            <small class="text-success">
                                <i class="fas fa-arrow-up"></i>
                                <?= $stats['total_officers'] > 0 ? number_format(($stats['active_count'] / $stats['total_officers']) * 100, 1) : 0 ?>% active
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="card border-0 shadow h-100">
                <div class="card-body px-3 px-md-4 py-3">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-warning text-dark rounded p-3">
                                <i class="fas fa-user-times fa-2x"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h3 class="mb-0 fw-bold"><?= $stats['inactive_count'] ?></h3>
                            <p class="text-muted mb-0">Inactive Officers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Officers Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-light border-bottom d-flex flex-wrap justify-content-between align-items-center py-3">
                    <h5 class="mb-2 mb-md-0 fw-bold"><i class="fas fa-list me-2"></i>All Project Officers</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= base_url() ?>dashboard" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-body px-3 px-md-4">
                    <div class="table-responsive">
                        <table id="officersTable" class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Officer Code</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Status</th>
                                    <th>Created By</th>
                                    <th>Created Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = 1; foreach ($pro_officers as $po) : ?>
                                    <tr>
                                        <td><?= $x++ ?></td>
                                        <td><strong class="text-primary">PO-<?= str_pad($po['pocode'], 4, '0', STR_PAD_LEFT) ?></strong></td>
                                        <td><?= esc($po['name']) ?></td>
                                        <td><code><?= esc($po['username']) ?></code></td>
                                        <td>
                                            <?php if ($po['status'] == 'active'): ?>
                                                <span class="badge bg-success rounded-pill">
                                                    <i class="fas fa-check-circle"></i> Active
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary rounded-pill">
                                                    <i class="fas fa-times-circle"></i> Inactive
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td><small><?= esc($po['create_by'] ?? 'N/A') ?></small></td>
                                        <td><small><?= !empty($po['create_at']) ? date('M d, Y', strtotime($po['create_at'])) : 'N/A' ?></small></td>
                                        <td>
                                            <button class="btn btn-sm btn-warning text-dark" data-bs-toggle="modal" data-bs-target="#edit<?= $po['id'] ?>">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#pwd<?= $po['id'] ?>">
                                                <i class="fas fa-lock"></i> Password
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Add New Officer Modal -->
<div class="modal fade" id="add_project_officers" tabindex="-1" aria-labelledby="addOfficerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addOfficerModalLabel">
                    <i class="fa fa-user-plus" aria-hidden="true"></i> Add New Project Officer
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= form_open('add_project_officers') ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 col-md-6 mb-3">
                        <label for="name" class="form-label"><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                        <small class="text-muted">Enter the officer's full name</small>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                        <label for="username" class="form-label"><i class="fas fa-at"></i> Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter username" pattern="^\S+$" title="No spaces allowed" required>
                        <small class="text-muted">Username without spaces</small>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                        <small class="text-muted">Choose a secure password</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times"></i> Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Add Officer
                </button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit & Password Modals for Each Officer -->

<!-- Password Change & Edit Modals -->
<?php foreach ($pro_officers as $po) : ?>
    <!-- Password Change Modal -->
    <div class="modal fade" id="pwd<?= $po['id'] ?>" tabindex="-1" aria-labelledby="pwdModalLabel<?= $po['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="pwdModalLabel<?= $po['id'] ?>">
                        <i class="fa fa-lock" aria-hidden="true"></i> Change Password
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('edit_password_project_officers') ?>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> <strong>Officer:</strong> <?= esc($po['name']) ?>
                    </div>
                    <div class="mb-3">
                        <label for="password<?= $po['id'] ?>" class="form-label"><i class="fas fa-key"></i> New Password</label>
                        <input type="password" class="form-control" name="password" id="password<?= $po['id'] ?>" placeholder="Enter new password" required>
                        <small class="form-text text-muted">Enter a strong password for this officer</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?= $po['id'] ?>">
                    <input type="hidden" name="name" value="<?= esc($po['name']) ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-info">
                        <i class="fas fa-save"></i> Change Password
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Officer Modal -->
    <div class="modal fade" id="edit<?= $po['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel<?= $po['id'] ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="editModalLabel<?= $po['id'] ?>">
                        <i class="fas fa-edit"></i> Edit Project Officer
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <?= form_open('edit_project_officers') ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name<?= $po['id'] ?>" class="form-label"><i class="fas fa-user"></i> Full Name</label>
                        <input type="text" class="form-control" name="name" id="name<?= $po['id'] ?>" value="<?= esc($po['name']) ?>" required>
                        <small class="form-text text-muted">Edit officer's full name</small>
                    </div>
                    <div class="mb-3">
                        <label for="status<?= $po['id'] ?>" class="form-label"><i class="fas fa-toggle-on"></i> Status</label>
                        <select class="form-select" name="status" id="status<?= $po['id'] ?>">
                            <option value="active" <?= $po['status'] === 'active' ? 'selected' : '' ?>>
                                Active
                            </option>
                            <option value="deactive" <?= $po['status'] === 'deactive' ? 'selected' : '' ?>>
                                Inactive
                            </option>
                        </select>
                        <small class="form-text text-muted">Set officer account status</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="id" value="<?= $po['id'] ?>">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-warning text-dark">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#officersTable').DataTable({
            responsive: true,
            pageLength: 25,
            order: [[1, 'asc']],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel me-1"></i> Export to Excel',
                    className: 'btn btn-success btn-sm',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the action column
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print me-1"></i> Print',
                    className: 'btn btn-info btn-sm',
                    exportOptions: {
                        columns: ':not(:last-child)' // Exclude the action column
                    }
                }
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search officers...",
                lengthMenu: "Show _MENU_ officers per page",
                info: "Showing _START_ to _END_ of _TOTAL_ officers",
                infoEmpty: "No officers available",
                infoFiltered: "(filtered from _MAX_ total officers)",
                zeroRecords: "No matching officers found"
            }
        });
    });
</script>

<?= $this->endSection() ?>