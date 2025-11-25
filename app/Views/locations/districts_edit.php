<?= $this->extend("templates/dakoiiadmin"); ?>
<?= $this->section('content'); ?>

<section class="container-fluid">
    <div class="row p-2">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-warning">
                    <i class="fa fa-edit"></i> Edit District
                </div>
                <?= form_open('districts_edit/'.$district['id']) ?>
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
                                    <option value="<?= $country['id'] ?>" <?= ($district['country_id'] == $country['id']) ? 'selected' : '' ?>>
                                        <?= esc($country['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="province_id">Province <span class="text-danger">*</span></label>
                            <select name="province_id" id="province_id" class="form-control" required>
                                <option value="">Select Province</option>
                                <?php foreach ($provinces as $province) : ?>
                                    <option value="<?= $province['id'] ?>" <?= ($district['province_id'] == $province['id']) ? 'selected' : '' ?>>
                                        <?= esc($province['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="districtcode">District Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="<?= esc($district['districtcode']) ?>" readonly>
                            <small class="text-muted">District code cannot be changed</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">District Name <span class="text-danger">*</span></label>
                            <?= form_input('name', set_value('name', $district['name']), ['class' => 'form-control', 'placeholder' => 'Enter District Name', 'required' => 'required']) ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url() ?>districts" class="btn btn-secondary">CANCEL</a>
                    <button type="submit" class="btn btn-primary float-right">UPDATE DISTRICT</button>
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

