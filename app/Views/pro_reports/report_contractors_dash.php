<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>

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
    .bg-gradient-warning {
        background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
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
</style>

<div class="container-fluid px-4 py-3" id="printpdf">

    <!-- Page Header -->
    <div class="card bg-gradient-warning text-white shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2"><i class="fas fa-people-carry me-2"></i>Contractors Dashboard</h2>
                    <p class="mb-0"><?= session('orgname') ?> | Comprehensive Contractor Performance Analysis</p>
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

    <!-- Summary Stats Cards -->
    <div class="row mb-4">
        <!-- Total Contractors -->
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning text-white rounded p-3 me-3">
                            <i class="fas fa-hard-hat fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Contractors</h6>
                            <h4 class="mb-0 fw-bold"><?= $total_contractors ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Projects -->
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info text-white rounded p-3 me-3">
                            <i class="fas fa-project-diagram fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Projects</h6>
                            <h4 class="mb-0 fw-bold"><?= $total_projects ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Budget -->
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-success text-white rounded p-3 me-3">
                            <i class="fas fa-dollar-sign fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Budget</h6>
                            <h4 class="mb-0 fw-bold"><?= COUNTRY_CURRENCY ?><?= number_format($total_budget / 1000000, 2) ?>M</h4>
                            <small class="text-muted"><?= COUNTRY_CURRENCY ?><?= number_format($total_budget, 2, '.', ',') ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Payments -->
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Payments</h6>
                            <h4 class="mb-0 fw-bold"><?= COUNTRY_CURRENCY ?><?= number_format($total_payments / 1000000, 2) ?>M</h4>
                            <small class="text-success">
                                <i class="fas fa-arrow-up"></i>
                                <?php
                                $payment_percent = $total_budget > 0 ? ($total_payments / $total_budget * 100) : 0;
                                echo number_format($payment_percent, 1) . '%';
                                ?> of budget
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contractors Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-people-carry text-warning me-2"></i>Contractors Performance Report
                        </h5>
                        <span class="badge bg-warning text-dark"><?= count($contractors) ?> Contractors</span>
                    </div>
                </div>
                <div class="card-body px-4 py-3">
                    <div class="table-responsive">
                        <table id="contractorsTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>Contractor</th>
                                    <th class="text-center">Code</th>
                                    <th class="text-center">Projects</th>
                                    <th class="text-end">Total Budget</th>
                                    <th class="text-end">Total Payments</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Notices</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $x = 1;
                                foreach ($contractors as $con) :
                                    $stats = $contractorStats[$con['id']] ?? [
                                        'count' => 0,
                                        'budget' => 0,
                                        'payments' => 0,
                                        'active' => 0,
                                        'hold' => 0,
                                        'completed' => 0
                                    ];
                                ?>
                                <tr>
                                    <td class="fw-bold"><?= $x++ ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="bg-warning text-white rounded p-2 me-2" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-hard-hat"></i>
                                            </div>
                                            <div>
                                                <strong><?= esc($con['name']) ?></strong>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary"><?= esc($con['concode']) ?></span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-info rounded-pill" style="font-size: 0.9rem; padding: 0.4rem 0.8rem;">
                                            <?= $stats['count'] ?>
                                        </span>
                                    </td>
                                    <td class="text-end fw-bold">
                                        <?= COUNTRY_CURRENCY ?><?= number_format($stats['budget'], 2, '.', ',') ?>
                                    </td>
                                    <td class="text-end fw-bold text-success">
                                        <?= COUNTRY_CURRENCY ?><?= number_format($stats['payments'], 2, '.', ',') ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column align-items-center">
                                            <?php if ($stats['active'] > 0): ?>
                                            <span class="badge bg-primary mb-1">
                                                <i class="fas fa-circle-notch fa-spin"></i> Active: <?= $stats['active'] ?>
                                            </span>
                                            <?php endif; ?>
                                            <?php if ($stats['completed'] > 0): ?>
                                            <span class="badge bg-success mb-1">
                                                <i class="fas fa-check-circle"></i> Completed: <?= $stats['completed'] ?>
                                            </span>
                                            <?php endif; ?>
                                            <?php if ($stats['hold'] > 0): ?>
                                            <span class="badge bg-warning text-dark mb-1">
                                                <i class="fas fa-pause-circle"></i> Hold: <?= $stats['hold'] ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <?= get_notice_flags($con['notice_flag']) ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url() ?>report_contractors_view/<?= $con['ucode']; ?>"
                                           class="btn btn-sm btn-warning">
                                            <i class="fas fa-eye"></i> View
                                        </a>
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

<!-- DataTables Initialization -->
<script>
$(document).ready(function() {
    var table = $('#contractorsTable').DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "pageLength": 25,
        "order": [[1, 'asc']],
        "columnDefs": [
            { "orderable": false, "targets": [8] } // Disable sorting on Action column
        ],
        "buttons": [
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-success btn-sm',
                filename: 'Contractors_Report_<?= date("Y-m-d_His") ?>',
                title: 'Contractors Report - <?= session("orgname") ?>',
                exportOptions: {
                    columns: ':visible:not(:last-child)' // Exclude Action column
                }
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Print',
                className: 'btn btn-info btn-sm',
                title: 'Contractors Report - <?= session("orgname") ?>',
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
            "searchPlaceholder": "Search contractors...",
            "lengthMenu": "Show _MENU_ contractors per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ contractors",
            "infoEmpty": "No contractors found",
            "infoFiltered": "(filtered from _MAX_ total contractors)",
            "zeroRecords": "No matching contractors found"
        }
    });

    // Append buttons to container
    table.buttons().container().appendTo('#contractorsTable_wrapper .col-md-6:eq(0)');
});
</script>

<?= $this->endSection(); ?>
