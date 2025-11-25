<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>

<!-- Custom Styles -->
<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    }

    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
    }

    .table thead th {
        background-color: #f8f9fa;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        color: #495057;
        border-bottom: 2px solid #dee2e6;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    .card-header h5, .card-header h6 {
        color: #495057;
    }

    .status-filter-btn {
        transition: all 0.3s ease;
    }

    .status-filter-btn:hover {
        transform: scale(1.05);
    }
</style>

<div class="container-fluid px-4 py-3">

    <!-- Page Header -->
    <div class="card bg-gradient-primary text-white shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2"><i class="fas fa-chart-bar me-2"></i><?= ucfirst($status) ?> Projects Report</h2>
                    <p class="mb-0"><?= session('orgname') ?> | Comprehensive Project Status Analysis</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <div class="d-flex justify-content-md-end align-items-center">
                        <i class="fas fa-calendar-alt me-2"></i>
                        <span><?= date('l, F j, Y') ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Filter Buttons -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="mb-2 mb-md-0">
                            <h6 class="mb-0 text-muted">
                                <i class="fas fa-filter me-2"></i>Filter by Status
                            </h6>
                        </div>
                        <div class="btn-group" role="group">
                            <a href="<?= base_url() ?>report_projects_status/all" class="btn btn-sm status-filter-btn <?= $status == 'all' ? 'btn-primary' : 'btn-outline-primary' ?>">
                                <i class="fas fa-list me-1"></i> All Projects
                            </a>
                            <a href="<?= base_url() ?>report_projects_status/active" class="btn btn-sm status-filter-btn <?= $status == 'active' ? 'btn-info' : 'btn-outline-info' ?>">
                                <i class="fas fa-play me-1"></i> Active
                            </a>
                            <a href="<?= base_url() ?>report_projects_status/completed" class="btn btn-sm status-filter-btn <?= $status == 'completed' ? 'btn-success' : 'btn-outline-success' ?>">
                                <i class="fas fa-check me-1"></i> Completed
                            </a>
                            <a href="<?= base_url() ?>report_projects_status/hold" class="btn btn-sm status-filter-btn <?= $status == 'hold' ? 'btn-warning' : 'btn-outline-warning' ?>">
                                <i class="fas fa-pause me-1"></i> On Hold
                            </a>
                        </div>
                        <div class="mt-2 mt-md-0">
                            <a href="<?= base_url() ?>report_projects_dash" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Summary Cards -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <i class="fas fa-wallet fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Budget</h6>
                            <h4 class="mb-0 fw-bold"><?= COUNTRY_CURRENCY . number_format($pro_total_budget, 2) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success text-white rounded p-3 me-3">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Paid</h6>
                            <h4 class="mb-0 fw-bold"><?= COUNTRY_CURRENCY . number_format($pro_total_paid, 2) ?></h4>
                            <small class="text-muted">
                                <?php
                                $paidPercentage = $pro_total_budget > 0 ? ($pro_total_paid / $pro_total_budget * 100) : 0;
                                echo number_format($paidPercentage, 1) . '% of budget';
                                ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning text-white rounded p-3 me-3">
                            <i class="fas fa-clock fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Outstanding</h6>
                            <h4 class="mb-0 fw-bold"><?= COUNTRY_CURRENCY . number_format($pro_total_outstanding, 2) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-danger text-white rounded p-3 me-3">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Overpaid</h6>
                            <h4 class="mb-0 fw-bold"><?= COUNTRY_CURRENCY . number_format($pro_total_overpaid, 2) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Milestones Summary -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0"><i class="fas fa-tasks me-2 text-primary"></i>Milestones Progress Overview</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                        $totalMs = count($milestones);
                        $pendingPercent = $totalMs > 0 ? ($pro_ms_pending / $totalMs * 100) : 0;
                        $completedPercent = $totalMs > 0 ? ($pro_ms_completed / $totalMs * 100) : 0;
                        $holdPercent = $totalMs > 0 ? ($pro_ms_hold / $totalMs * 100) : 0;
                        $canceledPercent = $totalMs > 0 ? ($pro_ms_canceled / $totalMs * 100) : 0;
                        ?>

                        <div class="col-lg col-md-6 mb-3 mb-lg-0">
                            <div class="text-center">
                                <div class="mb-3">
                                    <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                                         style="width: 70px; height: 70px;">
                                        <i class="fas fa-hourglass-half fa-2x"></i>
                                    </div>
                                </div>
                                <h3 class="mb-1 fw-bold text-primary"><?= $pro_ms_pending ?></h3>
                                <p class="mb-2 text-muted small">Pending</p>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-primary" role="progressbar"
                                         style="width: <?= $pendingPercent ?>%" aria-valuenow="<?= $pendingPercent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted"><?= number_format($pendingPercent, 1) ?>%</small>
                            </div>
                        </div>

                        <div class="col-lg col-md-6 mb-3 mb-lg-0">
                            <div class="text-center">
                                <div class="mb-3">
                                    <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center"
                                         style="width: 70px; height: 70px;">
                                        <i class="fas fa-check-double fa-2x"></i>
                                    </div>
                                </div>
                                <h3 class="mb-1 fw-bold text-success"><?= $pro_ms_completed ?></h3>
                                <p class="mb-2 text-muted small">Completed</p>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-success" role="progressbar"
                                         style="width: <?= $completedPercent ?>%" aria-valuenow="<?= $completedPercent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted"><?= number_format($completedPercent, 1) ?>%</small>
                            </div>
                        </div>

                        <div class="col-lg col-md-6 mb-3 mb-lg-0">
                            <div class="text-center">
                                <div class="mb-3">
                                    <div class="rounded-circle bg-warning text-white d-inline-flex align-items-center justify-content-center"
                                         style="width: 70px; height: 70px;">
                                        <i class="fas fa-pause-circle fa-2x"></i>
                                    </div>
                                </div>
                                <h3 class="mb-1 fw-bold text-warning"><?= $pro_ms_hold ?></h3>
                                <p class="mb-2 text-muted small">On Hold</p>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                         style="width: <?= $holdPercent ?>%" aria-valuenow="<?= $holdPercent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted"><?= number_format($holdPercent, 1) ?>%</small>
                            </div>
                        </div>

                        <div class="col-lg col-md-6 mb-3 mb-lg-0">
                            <div class="text-center">
                                <div class="mb-3">
                                    <div class="rounded-circle bg-danger text-white d-inline-flex align-items-center justify-content-center"
                                         style="width: 70px; height: 70px;">
                                        <i class="fas fa-times-circle fa-2x"></i>
                                    </div>
                                </div>
                                <h3 class="mb-1 fw-bold text-danger"><?= $pro_ms_canceled ?></h3>
                                <p class="mb-2 text-muted small">Canceled</p>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                         style="width: <?= $canceledPercent ?>%" aria-valuenow="<?= $canceledPercent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted"><?= number_format($canceledPercent, 1) ?>%</small>
                            </div>
                        </div>

                        <div class="col-lg col-md-6">
                            <div class="text-center">
                                <div class="mb-3">
                                    <div class="rounded-circle bg-info text-white d-inline-flex align-items-center justify-content-center"
                                         style="width: 70px; height: 70px;">
                                        <i class="fas fa-list-ol fa-2x"></i>
                                    </div>
                                </div>
                                <h3 class="mb-1 fw-bold text-info"><?= count($milestones) ?></h3>
                                <p class="mb-2 text-muted small">Total</p>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted">100%</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects List Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="mb-0">
                            <i class="fas fa-list me-2 text-primary"></i><?= ucfirst($status) ?> Projects List
                        </h5>
                        <div class="mt-2 mt-md-0">
                            <span class="badge bg-primary">
                                <i class="fas fa-folder me-1"></i><?= count($projects) ?> Project<?= count($projects) != 1 ? 's' : '' ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="projects_table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>Code</th>
                                    <th style="min-width: 200px;">Project Name</th>
                                    <th>Date</th>
                                    <th>Fund Source</th>
                                    <th class="text-end">Budget (<?= COUNTRY_CURRENCY ?>)</th>
                                    <th class="text-end">Paid (<?= COUNTRY_CURRENCY ?>)</th>
                                    <th class="text-end">Outstanding (<?= COUNTRY_CURRENCY ?>)</th>
                                    <th class="text-end">Overpaid (<?= COUNTRY_CURRENCY ?>)</th>
                                    <th>Contractor</th>
                                    <th>Project Officer</th>
                                    <th class="text-center">Milestones</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($projects)) : ?>
                                    <tr>
                                        <td colspan="14" class="text-center py-5">
                                            <div style="font-size: 3rem; color: #d1d5db; margin-bottom: 1rem;">
                                                <i class="fas fa-folder-open"></i>
                                            </div>
                                            <h5 class="text-muted">No projects found</h5>
                                            <p class="text-muted small">No projects match the selected status filter.</p>
                                        </td>
                                    </tr>
                                <?php else : ?>
                                    <?php
                                    $x = 1;
                                    foreach ($projects as $pro) :
                                        // Ensure all project fields exist to prevent undefined index errors
                                        $procode = $pro['procode'] ?? '';
                                        $proname = $pro['name'] ?? 'Unknown';
                                        $pro_date = $pro['pro_date'] ?? date('Y-m-d');
                                        $fund = $pro['fund'] ?? 'N/A';
                                        $ucode = $pro['ucode'] ?? '';
                                        $status_val = $pro['status'] ?? 'pending';

                                        // Get pre-calculated milestone data (optimized - no nested loops)
                                        $ms_data = $milestone_by_project[$procode] ?? ['pending' => 0, 'hold' => 0, 'completed' => 0, 'canceled' => 0, 'total' => 0];
                                        $ms_pending = $ms_data['pending'];
                                        $ms_hold = $ms_data['hold'];
                                        $ms_completed = $ms_data['completed'];
                                        $ms_canceled = $ms_data['canceled'];
                                        $ms_total = $ms_data['total'];

                                        // Calculate financial values
                                        $budget = checkZero($pro['budget'] ?? 0);
                                        $paid = checkZero($pro['payment_total'] ?? 0);
                                        $outstanding = max(0, $budget - $paid);
                                        $overpaid = max(0, $paid - $budget);

                                        // Get contractor and officer names
                                        $contractor_name = $pro['contractor_name'] ?? '';
                                        $pro_officer_name = $pro['pro_officer_name'] ?? '';
                                    ?>
                                        <tr>
                                            <td><?= $x++ ?></td>
                                            <td><span class="badge bg-secondary"><?= esc($procode) ?></span></td>
                                            <td><strong><?= esc($proname) ?></strong></td>
                                            <td><small><i class="far fa-calendar me-1"></i><?= dateforms($pro_date) ?></small></td>
                                            <td><span class="badge bg-primary"><?= esc(strtoupper($fund)) ?></span></td>
                                            <td class="text-end"><?= number_format($budget, 2) ?></td>
                                            <td class="text-end text-success fw-bold"><?= number_format($paid, 2) ?></td>
                                            <td class="text-end">
                                                <?php if ($outstanding > 0): ?>
                                                    <span class="text-warning fw-bold"><?= number_format($outstanding, 2) ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-end">
                                                <?php if ($overpaid > 0): ?>
                                                    <span class="text-danger fw-bold"><?= number_format($overpaid, 2) ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($contractor_name)): ?>
                                                    <small><i class="fas fa-hard-hat text-primary me-1"></i><?= esc($contractor_name) ?></small>
                                                <?php else: ?>
                                                    <small class="text-muted">Not assigned</small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($pro_officer_name)): ?>
                                                    <small><i class="fas fa-user-tie text-primary me-1"></i><?= esc($pro_officer_name) ?></small>
                                                <?php else: ?>
                                                    <small class="text-muted">Not assigned</small>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-primary" title="Pending"><?= $ms_pending ?></span>
                                                <span class="badge bg-success" title="Completed"><?= $ms_completed ?></span>
                                                <span class="badge bg-warning" title="On Hold"><?= $ms_hold ?></span>
                                                <span class="badge bg-danger" title="Canceled"><?= $ms_canceled ?></span>
                                                <span class="text-muted small"> / </span>
                                                <strong class="text-info"><?= $ms_total ?></strong>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($status_val == 'active'): ?>
                                                    <span class="badge bg-info"><i class="fas fa-play-circle me-1"></i>Active</span>
                                                <?php elseif ($status_val == 'completed'): ?>
                                                    <span class="badge bg-success"><i class="fas fa-check-circle me-1"></i>Completed</span>
                                                <?php elseif ($status_val == 'hold'): ?>
                                                    <span class="badge bg-warning"><i class="fas fa-pause-circle me-1"></i>On Hold</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary"><?= esc(ucfirst($status_val)) ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url() ?>report_projects_view/<?= esc($ucode) ?>" class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye me-1"></i>View
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- ./ col  -->
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->

<script>
$(document).ready(function() {
    // Check if table exists and has data rows (not just the empty message)
    var $table = $('#projects_table');
    var hasData = $table.length > 0 && $table.find('tbody tr').length > 0;
    var isEmpty = $table.find('tbody tr td[colspan]').length > 0;

    // Only initialize DataTables if table has actual data rows
    if (hasData && !isEmpty) {
        try {
            // Destroy any existing DataTable instance first
            if ($.fn.DataTable.isDataTable('#projects_table')) {
                $table.DataTable().destroy();
            }

            var table = $table.DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "pageLength": 25,
                "order": [[2, "asc"]],
                "columnDefs": [
                    { "orderable": false, "targets": [13] }, // Disable sorting on Action column
                    { "width": "50px", "targets": 0 }
                ],
                "buttons": [
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel"></i> Excel',
                        className: 'btn btn-success btn-sm',
                        filename: '<?= $title ?>_<?= date("Y-m-d_His") ?>',
                        title: '<?= $title ?> - <?= session("orgname") ?>',
                        exportOptions: {
                            columns: ':visible:not(:last-child)' // Exclude Action column
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print"></i> Print',
                        className: 'btn btn-info btn-sm',
                        title: '<?= $title ?> - <?= session("orgname") ?>',
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
                    "searchPlaceholder": "Search projects..."
                }
            });

            // Append buttons to a container if needed
            table.buttons().container().appendTo('#projects_table_wrapper .col-md-6:eq(0)');
        } catch (error) {
            console.error('Error initializing DataTable:', error);
        }
    }
});
</script>

<?= $this->endSection(); ?>