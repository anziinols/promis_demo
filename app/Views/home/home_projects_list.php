<?= $this->extend("templates/nolstemp"); ?>
<?= $this->section('content'); ?>

<section class="container-fluid">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>Projects List
                    </h5>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped" id="projects_list">
                            <thead class="table-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Code</th>
                                    <th>Project</th>
                                    <th>T.Payments</th>
                                    <th>Milestones</th>
                                    <th>Contractor</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1;
                                foreach ($projects as $p) : ?>
                                    <tr class="cursor-pointer" onclick="window.location='<?= base_url() ?>home_project_one_view/<?= $p['ucode'] ?>'" style="cursor: pointer;">
                                        <td><?= $count++ ?></td>
                                        <td><span class="badge bg-primary"><?= $p['procode'] ?></span></td>
                                        <td><?= $p['name'] ?></td>

                                        <td>
                                            <?= number_format($p['total_payments'], 2) ?>
                                            <?php
                                            if ($p['total_payments'] != 0 && isset($p['budget']) && $p['budget'] > 0) {
                                                $percentage = round(($p['total_payments'] / $p['budget']) * 100, 2);
                                                echo "<div class='progress mt-1' style='height: 6px;'>
                                                    <div class='progress-bar' role='progressbar' style='width: {$percentage}%;' aria-valuenow='{$percentage}' aria-valuemin='0' aria-valuemax='100'></div>
                                                </div>";
                                                echo "<small class='text-muted'>({$percentage}%)</small>";
                                            }
                                            ?>
                                        </td>

                                        <td>
                                            <?php
                                            if ($p['total_milestones'] != 0) {
                                                $percentage = round(($p['completed_milestones'] / $p['total_milestones']) * 100, 2);
                                                echo "<div class='progress' style='height: 6px;'>
                                                    <div class='progress-bar bg-success' role='progressbar' style='width: {$percentage}%;' aria-valuenow='{$percentage}' aria-valuemin='0' aria-valuemax='100'></div>
                                                </div>";
                                                echo "<small class='text-muted'>{$percentage}%</small>";
                                            } else {
                                                echo "<span class='text-muted'>No milestones</span>";
                                            }
                                            ?>
                                        </td>
                                        <td><?= $p['contractor_name'] ?></td>
                                        <td>
                                            <?php 
                                            $statusClass = 'bg-secondary';
                                            if ($p['status'] == 'Completed') $statusClass = 'bg-success';
                                            if ($p['status'] == 'In Progress') $statusClass = 'bg-primary';
                                            if ($p['status'] == 'Delayed') $statusClass = 'bg-warning';
                                            if ($p['status'] == 'Cancelled') $statusClass = 'bg-danger';
                                            ?>
                                            <span class="badge <?= $statusClass ?>"><?= $p['status'] ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- DataTables JavaScript -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Initialize DataTables with improved options
                            $('#projects_list').DataTable({
                                responsive: true,
                                pageLength: 25,
                                order: [[1, 'asc']], // Sort by project code
                                language: {
                                    search: "<i class='fas fa-search'></i> Search:",
                                    lengthMenu: "Show _MENU_ entries",
                                    info: "Showing _START_ to _END_ of _TOTAL_ projects"
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>

