<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- DataTables CSS for Bootstrap 5 -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

<div class="container-fluid px-4 py-3">

    <!-- Page Header -->
    <div class="card bg-primary text-white shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2"><i class="fas fa-folder-open me-2"></i>Projects Management</h2>
                    <p class="mb-0"><?= session('orgname') ?> | View and manage all your organization's projects</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="<?= base_url() ?>new_projects" class="btn btn-light btn-lg">
                        <i class="fas fa-plus-circle me-2"></i> New Project
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <i class="fas fa-project-diagram fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Projects</h6>
                            <h4 class="mb-0 fw-bold"><?= $stats['total_projects'] ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info text-white rounded p-3 me-3">
                            <i class="fas fa-play-circle fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Active Projects</h6>
                            <h4 class="mb-0 fw-bold"><?= $stats['active_count'] ?></h4>
                            <small class="text-info">
                                <i class="fas fa-chart-line"></i>
                                <?= $stats['total_projects'] > 0 ? number_format(($stats['active_count'] / $stats['total_projects']) * 100, 1) : 0 ?>% of total
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success text-white rounded p-3 me-3">
                            <i class="fas fa-check-double fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Completed</h6>
                            <h4 class="mb-0 fw-bold"><?= $stats['completed_count'] ?></h4>
                            <small class="text-success">
                                <i class="fas fa-trophy"></i>
                                <?= $stats['total_projects'] > 0 ? number_format(($stats['completed_count'] / $stats['total_projects']) * 100, 1) : 0 ?>% completion rate
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning text-dark rounded p-3 me-3">
                            <i class="fas fa-pause-circle fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">On Hold / Canceled</h6>
                            <h4 class="mb-0 fw-bold"><?= $stats['hold_count'] ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Overview Cards -->
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <i class="fas fa-wallet fa-2x"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Total Budget</h6>
                            <h4 class="mb-0 fw-bold"><?= COUNTRY_CURRENCY ?><?= number_format($stats['total_budget'], 0) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success text-white rounded p-3 me-3">
                            <i class="fas fa-hand-holding-usd fa-2x"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Total Paid</h6>
                            <h4 class="mb-0 fw-bold"><?= COUNTRY_CURRENCY ?><?= number_format($stats['total_paid'], 0) ?></h4>
                            <?php $paidPercentage = $stats['total_budget'] > 0 ? ($stats['total_paid'] / $stats['total_budget']) * 100 : 0; ?>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar bg-success" role="progressbar"
                                     style="width: <?= min($paidPercentage, 100) ?>%"
                                     aria-valuenow="<?= min($paidPercentage, 100) ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-success">
                                <i class="fas fa-arrow-up"></i>
                                <?= number_format($paidPercentage, 1) ?>% disbursed
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning text-dark rounded p-3 me-3">
                            <i class="fas fa-hourglass-half fa-2x"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="text-muted mb-1">Outstanding</h6>
                            <h4 class="mb-0 fw-bold"><?= COUNTRY_CURRENCY ?><?= number_format($stats['total_budget'] - $stats['total_paid'], 0) ?></h4>
                            <?php $outstandingPercentage = $stats['total_budget'] > 0 ? (($stats['total_budget'] - $stats['total_paid']) / $stats['total_budget']) * 100 : 0; ?>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar bg-warning" role="progressbar"
                                     style="width: <?= min($outstandingPercentage, 100) ?>%"
                                     aria-valuenow="<?= min($outstandingPercentage, 100) ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <small class="text-warning">
                                <i class="fas fa-minus-circle"></i>
                                <?= number_format($outstandingPercentage, 1) ?>% remaining
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-list text-purple me-2"></i>All Projects
                        </h5>
                        <div>
                            <a href="<?= base_url() ?>dashboard" class="btn btn-sm btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="projectsTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Project Code</th>
                                    <th>Project Name</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th>Budget</th>
                                    <th>Paid</th>
                                    <th>Outstanding</th>
                                    <th>Contractor</th>
                                    <th>Officer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = 1;
                                foreach ($projects as $key) :
                                    $procode = $key['procode'];
                                    $totalPaid = isset($fundLookup[$procode]) ? $fundLookup[$procode]['total_paid'] : 0;
                                    $outstanding = $key['budget'] - $totalPaid;
                                ?>
                                    <tr>
                                        <td><?= $x++ ?></td>
                                        <td><strong><?= $key['procode'] ?></strong></td>
                                        <td><?= $key['name'] ?></td>
                                        <td>
                                            <small class="text-muted">
                                                <?= !empty($key['llg']) ? $key['llg'] : '-' ?>
                                            </small>
                                        </td>
                                        <td><?= get_status_icon($key['status']) ?></td>
                                        <td><?= COUNTRY_CURRENCY ?><?= number_format($key['budget'], 2) ?></td>
                                        <td>
                                            <span class="badge bg-success rounded-pill">
                                                <?= COUNTRY_CURRENCY ?><?= number_format($totalPaid, 2) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php if ($outstanding > 0): ?>
                                                <span class="badge bg-warning rounded-pill text-dark">
                                                    <?= COUNTRY_CURRENCY ?><?= number_format($outstanding, 2) ?>
                                                </span>
                                            <?php elseif ($outstanding < 0): ?>
                                                <span class="badge bg-danger rounded-pill">
                                                    <?= COUNTRY_CURRENCY ?><?= number_format(abs($outstanding), 2) ?>
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary rounded-pill">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?= !empty($key['contractor_name']) ? '<small>' . $key['contractor_name'] . '</small>' : '<span class="text-muted">-</span>' ?>
                                        </td>
                                        <td>
                                            <?= !empty($key['pro_officer_name']) ? '<small>' . $key['pro_officer_name'] . '</small>' : '<span class="text-muted">-</span>' ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url() ?>open_projects/<?= $key['ucode'] ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="fw-bold">
                                    <td colspan="5" class="text-end">Totals:</td>
                                    <td><?= COUNTRY_CURRENCY ?><?= number_format($stats['total_budget'], 2) ?></td>
                                    <td>
                                        <span class="badge bg-success rounded-pill">
                                            <?= COUNTRY_CURRENCY ?><?= number_format($stats['total_paid'], 2) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning rounded-pill text-dark">
                                            <?= COUNTRY_CURRENCY ?><?= number_format($stats['total_budget'] - $stats['total_paid'], 2) ?>
                                        </span>
                                    </td>
                                    <td colspan="3"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- DataTables JS for Bootstrap 5 -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<script>
    $(document).ready(function() {
        try {
            var table = $('#projectsTable').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 25,
                "order": [[0, 'asc']],
                "columnDefs": [
                    { "orderable": false, "targets": [10] } // Disable sorting on Action column
                ],
                "buttons": [
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-success btn-sm',
                        filename: 'Projects_List_<?= date("Y-m-d_His") ?>',
                        title: 'Projects List - <?= session("orgname") ?>',
                        exportOptions: {
                            columns: ':visible:not(:last-child)' // Exclude Action column
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-info btn-sm',
                        title: 'Projects List - <?= session("orgname") ?>',
                        exportOptions: {
                            columns: ':visible:not(:last-child)' // Exclude Action column
                        }
                    },
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-columns"></i> Columns',
                        className: 'btn btn-secondary btn-sm'
                    }
                ],
                "language": {
                    "search": "_INPUT_",
                    "searchPlaceholder": "Search projects...",
                    "lengthMenu": "Show _MENU_ projects per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ projects",
                    "infoEmpty": "No projects available",
                    "infoFiltered": "(filtered from _MAX_ total projects)",
                    "zeroRecords": "No matching projects found"
                }
            });

            // Append buttons to container
            table.buttons().container().appendTo('#projectsTable_wrapper .col-md-6:eq(0)');
        } catch (error) {
            console.error('DataTable initialization error:', error);
        }
    });
</script>

<?= $this->endSection() ?>