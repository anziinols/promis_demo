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
    .bg-gradient-info {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
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

<div class="container-fluid px-4 py-3">

    <!-- Page Header -->
    <div class="card bg-gradient-info text-white shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2"><i class="fas fa-user-check me-2"></i>Project Officers Dashboard</h2>
                    <p class="mb-0"><?= session('orgname') ?> | Comprehensive Officer Performance Analysis</p>
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
        <!-- Total Officers -->
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-info text-white rounded p-3 me-3">
                            <i class="fas fa-user-tie fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Officers</h6>
                            <h4 class="mb-0 fw-bold"><?= $total_officers ?></h4>
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
                        <div class="bg-primary text-white rounded p-3 me-3">
                            <i class="fas fa-project-diagram fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Projects</h6>
                            <h4 class="mb-0 fw-bold"><?= $total_projects ?></h4>
                            <small class="text-muted">Avg: <?= $total_officers > 0 ? number_format($total_projects / $total_officers, 1) : 0 ?> per officer</small>
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
                        <div class="bg-warning text-white rounded p-3 me-3">
                            <i class="fas fa-money-bill-wave fa-2x"></i>
                        </div>
                        <div>
                            <h6 class="text-muted mb-1">Total Payments</h6>
                            <h4 class="mb-0 fw-bold"><?= COUNTRY_CURRENCY ?><?= number_format($total_payments / 1000000, 2) ?>M</h4>
                            <small class="text-success">
                                <i class="fas fa-arrow-up"></i> <?= $payment_percentage ?>% of budget
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Status Overview -->
    <div class="row mb-4">
        <!-- Active Projects -->
        <div class="col-lg-4 col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center"
                             style="width: 70px; height: 70px;">
                            <i class="fas fa-spinner fa-2x"></i>
                        </div>
                    </div>
                    <h3 class="mb-1 fw-bold text-primary"><?= $projects_by_status['active'] ?></h3>
                    <p class="mb-2 text-muted">Active Projects</p>
                    <div class="progress" style="height: 8px;">
                        <?php $active_percent = $total_projects > 0 ? ($projects_by_status['active'] / $total_projects * 100) : 0; ?>
                        <div class="progress-bar bg-primary" role="progressbar"
                             style="width: <?= $active_percent ?>%"
                             aria-valuenow="<?= $active_percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted"><?= number_format($active_percent, 1) ?>%</small>
                </div>
            </div>
        </div>

        <!-- Completed Projects -->
        <div class="col-lg-4 col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-success text-white d-inline-flex align-items-center justify-content-center"
                             style="width: 70px; height: 70px;">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                    </div>
                    <h3 class="mb-1 fw-bold text-success"><?= $projects_by_status['completed'] ?></h3>
                    <p class="mb-2 text-muted">Completed Projects</p>
                    <div class="progress" style="height: 8px;">
                        <?php $completed_percent = $total_projects > 0 ? ($projects_by_status['completed'] / $total_projects * 100) : 0; ?>
                        <div class="progress-bar bg-success" role="progressbar"
                             style="width: <?= $completed_percent ?>%"
                             aria-valuenow="<?= $completed_percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted"><?= number_format($completed_percent, 1) ?>%</small>
                </div>
            </div>
        </div>

        <!-- On Hold Projects -->
        <div class="col-lg-4 col-md-4 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body text-center">
                    <div class="mb-3">
                        <div class="rounded-circle bg-warning text-white d-inline-flex align-items-center justify-content-center"
                             style="width: 70px; height: 70px;">
                            <i class="fas fa-pause-circle fa-2x"></i>
                        </div>
                    </div>
                    <h3 class="mb-1 fw-bold text-warning"><?= $projects_by_status['hold'] ?></h3>
                    <p class="mb-2 text-muted">On Hold Projects</p>
                    <div class="progress" style="height: 8px;">
                        <?php $hold_percent = $total_projects > 0 ? ($projects_by_status['hold'] / $total_projects * 100) : 0; ?>
                        <div class="progress-bar bg-warning" role="progressbar"
                             style="width: <?= $hold_percent ?>%"
                             aria-valuenow="<?= $hold_percent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-muted"><?= number_format($hold_percent, 1) ?>%</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Officers Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-user-tag text-info me-2"></i>Officers Performance Report
                        </h5>
                        <span class="badge bg-info"><?= $total_officers ?> Officers</span>
                    </div>
                </div>
                <div class="card-body px-4 py-3">
                    <div class="table-responsive">
                        <table id="officersTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>Project Officer</th>
                                    <th class="text-center" style="width: 100px;">Projects</th>
                                    <th class="text-end" style="width: 150px;">Total Budget</th>
                                    <th class="text-end" style="width: 150px;">Total Payments</th>
                                    <th class="text-end" style="width: 150px;">Outstanding</th>
                                    <th class="text-center" style="width: 120px;">Completion</th>
                                    <th style="width: 200px;">Status Distribution</th>
                                    <th class="text-center" style="width: 100px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = 1;
                                foreach ($pofficers as $off) :
                                    // Get pre-calculated stats for this officer
                                    $stats = isset($officer_stats[$off['id']]) ? $officer_stats[$off['id']] : [
                                        'count' => 0,
                                        'budget' => 0,
                                        'payments' => 0,
                                        'active' => 0,
                                        'completed' => 0,
                                        'hold' => 0
                                    ];

                                    $outstanding = $stats['budget'] - $stats['payments'];
                                    $completion_rate = $stats['count'] > 0 ? round(($stats['completed'] / $stats['count']) * 100, 1) : 0;
                                ?>
                                    <tr>
                                        <td class="fw-bold"><?= $x++ ?></td>
                                        <td>
                                            <strong class="text-dark"><?= esc($off['name']) ?></strong>
                                            <br>
                                            <small class="text-muted">
                                                <i class="fas fa-id-badge"></i> <?= esc($off['pocode']) ?>
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-info rounded-pill" style="font-size: 0.9rem; padding: 0.5rem 0.75rem;">
                                                <?= $stats['count'] ?>
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <strong><?= COUNTRY_CURRENCY ?><?= number_format($stats['budget'], 2) ?></strong>
                                        </td>
                                        <td class="text-end">
                                            <strong class="text-success">
                                                <?= COUNTRY_CURRENCY ?><?= number_format($stats['payments'], 2) ?>
                                            </strong>
                                        </td>
                                        <td class="text-end">
                                            <strong class="text-warning">
                                                <?= COUNTRY_CURRENCY ?><?= number_format($outstanding, 2) ?>
                                            </strong>
                                        </td>
                                        <td class="text-center">
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                     style="width: <?= $completion_rate ?>%;"
                                                     aria-valuenow="<?= $completion_rate ?>"
                                                     aria-valuemin="0"
                                                     aria-valuemax="100">
                                                    <?= $completion_rate ?>%
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <small>
                                                <span class="badge bg-primary" title="Active Projects">
                                                    <i class="fas fa-spinner"></i> <?= $stats['active'] ?>
                                                </span>
                                                <span class="badge bg-success" title="Completed Projects">
                                                    <i class="fas fa-check"></i> <?= $stats['completed'] ?>
                                                </span>
                                                <span class="badge bg-warning text-dark" title="On Hold Projects">
                                                    <i class="fas fa-pause"></i> <?= $stats['hold'] ?>
                                                </span>
                                            </small>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url() ?>report_pro_officers_view/<?= $off['ucode'] ?>"
                                               class="btn btn-sm btn-info"
                                               title="View Officer Details">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr class="bg-light fw-bold">
                                    <td colspan="2" class="text-end"><strong>TOTALS:</strong></td>
                                    <td class="text-center">
                                        <span class="badge bg-primary rounded-pill" style="font-size: 0.9rem; padding: 0.5rem 0.75rem;">
                                            <?= $total_projects ?>
                                        </span>
                                    </td>
                                    <td class="text-end">
                                        <strong><?= COUNTRY_CURRENCY ?><?= number_format($total_budget, 2) ?></strong>
                                    </td>
                                    <td class="text-end">
                                        <strong class="text-success"><?= COUNTRY_CURRENCY ?><?= number_format($total_payments, 2) ?></strong>
                                    </td>
                                    <td class="text-end">
                                        <strong class="text-warning"><?= COUNTRY_CURRENCY ?><?= number_format($total_outstanding, 2) ?></strong>
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
    <!-- /.row -->

    <!-- Data Visualization Section -->
    <div class="row mt-4">
        <!-- Budget vs Payments Chart -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-pie text-info me-2"></i>Budget Distribution
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="budgetChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Projects Status Chart -->
        <div class="col-md-6 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-chart-bar text-info me-2"></i>Projects by Status
                    </h5>
                </div>
                <div class="card-body">
                    <canvas id="statusChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- Initialize DataTables -->
<script>
    $(document).ready(function() {
        var table = $('#officersTable').DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "pageLength": 25,
            "order": [[2, "desc"]], // Sort by project count descending
            "columnDefs": [
                { "orderable": false, "targets": [8] } // Disable sorting on Action column
            ],
            "buttons": [
                {
                    extend: 'excel',
                    text: '<i class="fas fa-file-excel"></i> Excel',
                    className: 'btn btn-success btn-sm',
                    filename: 'Project_Officers_Report_<?= date("Y-m-d_His") ?>',
                    title: 'Project Officers Report - <?= session("orgname") ?>',
                    exportOptions: {
                        columns: ':visible:not(:last-child)' // Exclude Action column
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print"></i> Print',
                    className: 'btn btn-info btn-sm',
                    title: 'Project Officers Report - <?= session("orgname") ?>',
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
                "searchPlaceholder": "Search officers...",
                "lengthMenu": "Show _MENU_ officers per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ officers",
                "infoEmpty": "No officers found",
                "infoFiltered": "(filtered from _MAX_ total officers)",
                "zeroRecords": "No matching officers found"
            }
        });

        // Append buttons to container
        table.buttons().container().appendTo('#officersTable_wrapper .col-md-6:eq(0)');
    });

    // Budget Chart (Chart.js v3)
    const budgetCtx = document.getElementById('budgetChart').getContext('2d');
    const budgetChart = new Chart(budgetCtx, {
        type: 'doughnut',
        data: {
            labels: ['Payments Made', 'Outstanding'],
            datasets: [{
                data: [<?= $total_payments ?>, <?= $total_outstanding ?>],
                backgroundColor: [
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)'
                ],
                borderColor: [
                    'rgba(16, 185, 129, 1)',
                    'rgba(245, 158, 11, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            var label = context.label || '';
                            var value = context.parsed;
                            return label + ': <?= COUNTRY_CURRENCY ?>' + value.toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                        }
                    }
                }
            }
        }
    });

    // Status Chart (Chart.js v3)
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    const statusChart = new Chart(statusCtx, {
        type: 'bar',
        data: {
            labels: ['Active', 'Completed', 'On Hold'],
            datasets: [{
                label: 'Projects',
                data: [
                    <?= $projects_by_status['active'] ?>,
                    <?= $projects_by_status['completed'] ?>,
                    <?= $projects_by_status['hold'] ?>
                ],
                backgroundColor: [
                    'rgba(59, 130, 246, 0.8)',
                    'rgba(16, 185, 129, 0.8)',
                    'rgba(245, 158, 11, 0.8)'
                ],
                borderColor: [
                    'rgba(59, 130, 246, 1)',
                    'rgba(16, 185, 129, 1)',
                    'rgba(245, 158, 11, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Projects: ' + context.parsed.y;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>

<?= $this->endSection(); ?>
