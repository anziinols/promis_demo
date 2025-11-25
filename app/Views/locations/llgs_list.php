<?= $this->extend("templates/dakoiiadmin"); ?>
<?= $this->section('content'); ?>

<section class="container-fluid">
    <div class="row pt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fa fa-building" aria-hidden="true"></i> LLGs Management
                    <a href="<?= base_url() ?>llgs_create" class="btn btn-dark btn-sm float-right">
                        <i class="fa fa-plus"></i> Add New LLG
                    </a>
                </div>
                <div class="card-body">
                    <?php if(session()->getFlashdata('success')): ?>
                        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
                    <?php endif; ?>
                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                    <?php endif; ?>

                    <table class="table table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>LLG Code</th>
                                <th>LLG Name</th>
                                <th>District</th>
                                <th>Province</th>
                                <th>Country</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1; foreach ($llgs as $llg) : ?>
                                <tr>
                                    <td><?= $x++ ?></td>
                                    <td><?= esc($llg['llgcode']) ?></td>
                                    <td><?= esc($llg['name']) ?></td>
                                    <td><?= esc($llg['district_name']) ?></td>
                                    <td><?= esc($llg['province_name']) ?></td>
                                    <td><?= esc($llg['country_name']) ?></td>
                                    <td>
                                        <a href="<?= base_url() ?>llgs_edit/<?= $llg['id'] ?>" class="btn btn-sm btn-warning">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $llg['id'] ?>" data-name="<?= esc($llg['name']) ?>">
                                            <i class="fa fa-trash"></i> Delete
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
</section>

<script>
$(document).ready(function() {
    $('.delete-btn').click(function() {
        var id = $(this).data('id');
        var name = $(this).data('name');
        
        if(confirm('Are you sure you want to delete ' + name + '?')) {
            $.ajax({
                url: '<?= base_url() ?>llgs_delete',
                type: 'POST',
                data: {
                    id: id,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                success: function(response) {
                    if(response.status === 'success') {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while deleting the LLG.');
                }
            });
        }
    });
});
</script>

<?= $this->endSection() ?>

