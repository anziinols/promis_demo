<?= $this->extend("templates/dakoiiadmin"); ?>
<?= $this->section('content'); ?>

<section class="container-fluid">
    <div class="row p-2">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fa fa-plus"></i> Create New District
                </div>
                <?= form_open('districts_create') ?>
                <div class="card-body">
                    <?php if (isset($validation)) : ?>
                        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="country_id">Country <span class="text-danger">*</span></label>
                            <select name="country_id" id="country_id" class="form-control" required>
                                <option value="">Select Country</option>
                                <?php foreach ($countries as $country) : ?>
                                    <option value="<?= $country['id'] ?>"><?= esc($country['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="province_id">Province <span class="text-danger">*</span></label>
                            <select name="province_id" id="province_id" class="form-control" required>
                                <option value="">Select Province First</option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="districtcode">District Code <span class="text-danger">*</span></label>
                            <?= form_input('districtcode', set_value('districtcode'), ['class' => 'form-control', 'placeholder' => 'e.g., POM', 'required' => 'required']) ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">District Name <span class="text-danger">*</span></label>
                            <?= form_input('name', set_value('name'), ['class' => 'form-control', 'placeholder' => 'e.g., Port Moresby', 'required' => 'required']) ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url() ?>districts" class="btn btn-secondary">CANCEL</a>
                    <button type="submit" class="btn btn-primary float-right">CREATE DISTRICT</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $('#country_id').change(function() {
        var country_id = $(this).val();
        
        if(country_id) {
            $.ajax({
                url: '<?= base_url() ?>locations_get_provinces',
                type: 'POST',
                data: {
                    country_id: country_id,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: function(response) {
                    if(response.status === 'success') {
                        var options = '<option value="">Select Province</option>';
                        $.each(response.data, function(index, province) {
                            options += '<option value="' + province.id + '">' + province.name + '</option>';
                        });
                        $('#province_id').html(options);
                    }
                }
            });
        } else {
            $('#province_id').html('<option value="">Select Country First</option>');
        }
    });
});
</script>

<?= $this->endSection() ?>

