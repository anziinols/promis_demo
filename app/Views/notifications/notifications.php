<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Header -->
    <div class="card bg-primary text-white shadow mb-4">
        <div class="card-body px-3 px-md-4 py-3">
            <div class="row align-items-center flex-wrap">
                <div class="col-12 col-md-8 mb-3 mb-md-0">
                    <h2 class="mb-2"><i class="fas fa-bell me-2"></i>Notifications Management</h2>
                    <p class="mb-0">Send and manage notifications to project officers</p>
                </div>
                <div class="col-12 col-md-4 text-md-end">
                    <button type="button" class="btn btn-light btn-lg" data-bs-toggle="modal" data-bs-target="#addNotificationModal">
                        <i class="fas fa-plus me-2"></i> New Notification
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Notifications Table -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-light border-bottom d-flex flex-wrap justify-content-between align-items-center py-3">
                    <h5 class="mb-2 mb-md-0 fw-bold"><i class="fas fa-list me-2"></i>All Notifications</h5>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="<?= base_url() ?>dashboard" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table id="notificationsTable" class="table table-hover table-striped mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="px-3 py-3">#</th>
                                    <th class="px-3 py-3">Title</th>
                                    <th class="px-3 py-3">Message</th>
                                    <th class="px-3 py-3">Recipient</th>
                                    <th class="px-3 py-3">Priority</th>
                                    <th class="px-3 py-3">Status</th>
                                    <th class="px-3 py-3">Created</th>
                                    <th class="px-3 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1; ?>
                                <?php foreach ($notifications as $notification): ?>
                                    <tr>
                                        <td class="px-3 py-3"><?= $count++ ?></td>
                                        <td class="px-3 py-3 fw-bold"><?= esc($notification['title']) ?></td>
                                        <td class="px-3 py-3">
                                            <?= strlen($notification['message']) > 50 ? substr(esc($notification['message']), 0, 50) . '...' : esc($notification['message']) ?>
                                        </td>
                                        <td class="px-3 py-3">
                                            <?php if ($notification['recipient_type'] == 'all'): ?>
                                                <span class="badge bg-info">All Officers</span>
                                            <?php else: ?>
                                                <span class="badge bg-primary"><?= esc($notification['recipient_po_name']) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-3 py-3">
                                            <?php
                                            $priorityClass = 'secondary';
                                            if ($notification['priority'] == 'high') $priorityClass = 'warning';
                                            if ($notification['priority'] == 'urgent') $priorityClass = 'danger';
                                            ?>
                                            <span class="badge bg-<?= $priorityClass ?>"><?= ucfirst($notification['priority']) ?></span>
                                        </td>
                                        <td class="px-3 py-3">
                                            <?php if ($notification['status'] == 'active'): ?>
                                                <span class="badge bg-success">Active</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">Inactive</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-3 py-3">
                                            <small><?= date('M d, Y', strtotime($notification['create_at'])) ?></small><br>
                                            <small class="text-muted">by <?= esc($notification['create_by']) ?></small>
                                        </td>
                                        <td class="px-3 py-3 text-center">
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-outline-primary"
                                                        onclick="editNotification(<?= htmlspecialchars(json_encode($notification), ENT_QUOTES, 'UTF-8') ?>)"
                                                        title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <a href="<?= base_url() ?>delete_notification/<?= $notification['id'] ?>"
                                                   class="btn btn-outline-danger"
                                                   onclick="return confirm('Are you sure you want to delete this notification?')"
                                                   title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                            </div>
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

<!-- Add Notification Modal -->
<div class="modal fade" id="addNotificationModal" tabindex="-1" aria-labelledby="addNotificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="addNotificationModalLabel">
                    <i class="fas fa-bell me-2"></i>Create New Notification
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url() ?>add_notification" method="post" id="addNotificationForm">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add_title" class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="add_title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="add_message" class="form-label fw-bold">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="add_message" name="message" rows="5" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="add_recipient_type" class="form-label fw-bold">Send To <span class="text-danger">*</span></label>
                        <select class="form-select" id="add_recipient_type" name="recipient_type" required onchange="toggleAddRecipient()">
                            <option value="all">All Project Officers</option>
                            <option value="specific">Specific Project Officer</option>
                        </select>
                    </div>

                    <div class="mb-3" id="add_recipient_po_div" style="display: none;">
                        <label for="add_recipient_po_id" class="form-label fw-bold">Select Project Officer</label>
                        <select class="form-select" id="add_recipient_po_id" name="recipient_po_id">
                            <option value="">-- Select Officer --</option>
                            <?php
                            $project_officersModel = new \App\Models\project_officersModel();
                            $project_officers = $project_officersModel->where('orgcode', session('orgcode'))->where('status', 'active')->orderBy('name', 'asc')->find();
                            foreach ($project_officers as $officer): ?>
                                <option value="<?= $officer['id'] ?>"><?= esc($officer['name']) ?> (<?= esc($officer['pocode']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="add_priority" class="form-label fw-bold">Priority <span class="text-danger">*</span></label>
                        <select class="form-select" id="add_priority" name="priority" required>
                            <option value="normal" selected>Normal</option>
                            <option value="low">Low</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>Send Notification
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Notification Modal -->
<div class="modal fade" id="editNotificationModal" tabindex="-1" aria-labelledby="editNotificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title" id="editNotificationModalLabel">
                    <i class="fas fa-edit me-2"></i>Edit Notification
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url() ?>update_notification" method="post" id="editNotificationForm">
                <?= csrf_field() ?>
                <input type="hidden" id="edit_id" name="id">
                <input type="hidden" id="edit_ucode" name="ucode">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_title" class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_title" name="title" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit_message" class="form-label fw-bold">Message <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="edit_message" name="message" rows="5" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit_recipient_type" class="form-label fw-bold">Send To <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit_recipient_type" name="recipient_type" required onchange="toggleEditRecipient()">
                            <option value="all">All Project Officers</option>
                            <option value="specific">Specific Project Officer</option>
                        </select>
                    </div>

                    <div class="mb-3" id="edit_recipient_po_div" style="display: none;">
                        <label for="edit_recipient_po_id" class="form-label fw-bold">Select Project Officer</label>
                        <select class="form-select" id="edit_recipient_po_id" name="recipient_po_id">
                            <option value="">-- Select Officer --</option>
                            <?php foreach ($project_officers as $officer): ?>
                                <option value="<?= $officer['id'] ?>"><?= esc($officer['name']) ?> (<?= esc($officer['pocode']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_priority" class="form-label fw-bold">Priority <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit_priority" name="priority" required>
                            <option value="normal">Normal</option>
                            <option value="low">Low</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit_status" class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select class="form-select" id="edit_status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancel
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-save me-2"></i>Update Notification
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#notificationsTable').DataTable({
            "pageLength": 25,
            "order": [[6, "desc"]],
            "language": {
                "search": "Search notifications:",
                "lengthMenu": "Show _MENU_ notifications per page",
                "info": "Showing _START_ to _END_ of _TOTAL_ notifications",
                "infoEmpty": "No notifications available",
                "infoFiltered": "(filtered from _MAX_ total notifications)"
            }
        });
    });

    function toggleAddRecipient() {
        const recipientType = document.getElementById('add_recipient_type').value;
        const recipientDiv = document.getElementById('add_recipient_po_div');
        const recipientSelect = document.getElementById('add_recipient_po_id');

        if (recipientType === 'specific') {
            recipientDiv.style.display = 'block';
            recipientSelect.required = true;
        } else {
            recipientDiv.style.display = 'none';
            recipientSelect.required = false;
            recipientSelect.value = '';
        }
    }

    function toggleEditRecipient() {
        const recipientType = document.getElementById('edit_recipient_type').value;
        const recipientDiv = document.getElementById('edit_recipient_po_div');
        const recipientSelect = document.getElementById('edit_recipient_po_id');

        if (recipientType === 'specific') {
            recipientDiv.style.display = 'block';
            recipientSelect.required = true;
        } else {
            recipientDiv.style.display = 'none';
            recipientSelect.required = false;
            recipientSelect.value = '';
        }
    }

    function editNotification(notification) {
        document.getElementById('edit_id').value = notification.id;
        document.getElementById('edit_ucode').value = notification.ucode;
        document.getElementById('edit_title').value = notification.title;
        document.getElementById('edit_message').value = notification.message;
        document.getElementById('edit_recipient_type').value = notification.recipient_type;
        document.getElementById('edit_priority').value = notification.priority;
        document.getElementById('edit_status').value = notification.status;

        if (notification.recipient_type === 'specific') {
            document.getElementById('edit_recipient_po_div').style.display = 'block';
            document.getElementById('edit_recipient_po_id').value = notification.recipient_po_id;
            document.getElementById('edit_recipient_po_id').required = true;
        } else {
            document.getElementById('edit_recipient_po_div').style.display = 'none';
            document.getElementById('edit_recipient_po_id').required = false;
        }

        var editModal = new bootstrap.Modal(document.getElementById('editNotificationModal'));
        editModal.show();
    }

    // Refresh CSRF token after form submission
    $('#addNotificationForm, #editNotificationForm').on('submit', function() {
        $.ajax({
            url: '<?= base_url() ?>get_csrf_token',
            type: 'GET',
            success: function(data) {
                $('input[name="<?= csrf_token() ?>"]').val(data.csrf_token_value);
            }
        });
    });
</script>

<?= $this->endSection() ?>

