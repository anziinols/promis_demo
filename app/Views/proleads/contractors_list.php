<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- DataTables CSS for Bootstrap 5 -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Header -->
    <div class="card bg-primary text-white shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2"><i class="fas fa-hard-hat me-2"></i>Contractors Management</h2>
                    <p class="mb-0"><?= session('orgname') ?> | View and manage all contractors</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="<?= base_url() ?>contractors_new" class="btn btn-light btn-lg">
                        <i class="fas fa-plus-circle me-2"></i>Add New Contractor
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contractors Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-white border-bottom">
                    <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <h5 class="mb-0 fw-bold">
                            <i class="fas fa-list-ul text-primary me-2"></i>All Contractors
                            <span class="badge bg-primary rounded-pill ms-2"><?= count($contractors) ?></span>
                        </h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="contractors">
                        <thead>
                            <tr>
                                <th><i class="fas fa-hashtag"></i> Code</th>
                                <th><i class="fas fa-building"></i> Name</th>
                                <th><i class="fas fa-tag"></i> Category</th>
                                <th><i class="fas fa-flag"></i> Status Flag</th>
                                <th class="text-center"><i class="fas fa-cog"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($contractors)): ?>
                                <?php foreach ($contractors as $con) : ?>
                                    <tr>
                                        <td>
                                            <strong class="text-primary"><?= esc($con['concode']) ?></strong>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if (!empty($con['con_logo'])): ?>
                                                    <img src="<?= base_url() . '/' . esc($con['con_logo']) ?>"
                                                         alt="Logo"
                                                         class="rounded-circle me-2"
                                                         style="width: 32px; height: 32px; object-fit: cover; border: 2px solid #e9ecef;">
                                                <?php else: ?>
                                                    <div class="bg-primary rounded-circle me-2 d-flex align-items-center justify-content-center"
                                                         style="width: 32px; height: 32px; color: white; font-weight: bold; font-size: 0.875rem;">
                                                        <?= strtoupper(substr(esc($con['name']), 0, 1)) ?>
                                                    </div>
                                                <?php endif; ?>
                                                <span class="fw-medium"><?= esc($con['name']) ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                            $categoryName = 'N/A';
                                            foreach ($con_category as $cat) :
                                                if ($cat['value'] == $con['category']) :
                                                    $categoryName = esc($cat['item']);
                                                    break;
                                                endif;
                                            endforeach;
                                            ?>
                                            <span class="badge bg-info rounded-pill"><?= $categoryName ?></span>
                                        </td>
                                        <td>
                                            <?php
                                            $flagDisplayed = false;
                                            foreach ($notices as $note) :
                                                if ($con['concode'] == $note['concode'] && !$flagDisplayed) :
                                                    echo get_notice_flags($note['notice_flag']);
                                                    $flagDisplayed = true;
                                                    break;
                                                endif;
                                            endforeach;
                                            if (!$flagDisplayed) :
                                                echo '<span class="badge bg-secondary rounded-pill">No Flag</span>';
                                            endif;
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?= base_url() ?>open_contractor/<?= esc($con['ucode']) ?>"
                                               class="btn btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <div class="text-muted">
                                            <i class="fas fa-inbox fa-3x mb-3" style="opacity: 0.3;"></i>
                                            <p>No contractors found. Click "Add New Contractor" to get started.</p>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="card-footer bg-light border-top">
                    <small class="text-muted">
                        <i class="fas fa-info-circle me-1"></i>
                        Displaying <?= count($contractors) ?> contractor<?= count($contractors) != 1 ? 's' : '' ?> in the system
                    </small>
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

<script>
    $(document).ready(function() {
        <?php if (!empty($contractors)): ?>
        // Only initialize DataTables if there are contractors
        $('#contractors').DataTable({
            responsive: true,
            pageLength: 25,
            order: [[1, 'asc']],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search contractors...",
                lengthMenu: "Show _MENU_ contractors per page",
                info: "Showing _START_ to _END_ of _TOTAL_ contractors",
                infoEmpty: "No contractors available",
                infoFiltered: "(filtered from _MAX_ total contractors)",
                paginate: {
                    first: '<i class="fas fa-angle-double-left"></i>',
                    last: '<i class="fas fa-angle-double-right"></i>',
                    next: '<i class="fas fa-angle-right"></i>',
                    previous: '<i class="fas fa-angle-left"></i>'
                }
            },
            columnDefs: [
                { targets: 4, orderable: false }
            ]
        });
        <?php endif; ?>
    });
</script>

<?= $this->endSection() ?>