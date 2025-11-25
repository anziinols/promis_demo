<?= $this->extend("templates/dakoiiadmin"); ?>
<?= $this->section('content'); ?>

<section class="container-fluid">
    <div class="row p-2">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-warning">
                    <i class="fa fa-edit"></i> Edit LLG
                </div>
                <?= form_open('llgs_edit/'.$llg['id']) ?>
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
                                    <option value="<?= $country['id'] ?>" <?= ($llg['country_id'] == $country['id']) ? 'selected' : '' ?>>
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
                                    <option value="<?= $province['id'] ?>" <?= ($llg['province_id'] == $province['id']) ? 'selected' : '' ?>>
                                        <?= esc($province['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="district_id">District <span class="text-danger">*</span></label>
                            <select name="district_id" id="district_id" class="form-control" required>
                                <option value="">Select District</option>
                                <?php foreach ($districts as $district) : ?>
                                    <option value="<?= $district['id'] ?>" <?= ($llg['district_id'] == $district['id']) ? 'selected' : '' ?>>
                                        <?= esc($district['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="llgcode">LLG Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="<?= esc($llg['llgcode']) ?>" readonly>
                            <small class="text-muted">LLG code cannot be changed</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">LLG Name <span class="text-danger">*</span></label>
                            <?= form_input('name', set_value('name', $llg['name']), ['class' => 'form-control', 'placeholder' => 'Enter LLG Name', 'required' => 'required']) ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url() ?>llgs" class="btn btn-secondary">CANCEL</a>
                    <button type="submit" class="btn btn-primary float-right">UPDATE LLG</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    // Function to refresh CSRF token
    function refreshToken() {
        $.ajax({
            url: '<?= base_url() ?>',
            type: 'GET',
            async: false,
            success: function() {
                // Token refreshed
            }
        });
    }

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
                    refreshToken();
                    if(response.status === 'success') {
                        var options = '<option value="">Select Province</option>';
                        $.each(response.data, function(index, province) {
                            options += '<option value="' + province.id + '">' + province.name + '</option>';
                        });
                        $('#province_id').html(options);
                        $('#district_id').html('<option value="">Select Province First</option>');
                    }
                }
            });
        } else {
            $('#province_id').html('<option value="">Select Country First</option>');
            $('#district_id').html('<option value="">Select Province First</option>');
        }
    });

    $('#province_id').change(function() {
        var province_id = $(this).val();
        
        if(province_id) {
            $.ajax({
                url: '<?= base_url() ?>locations_get_districts',
                type: 'POST',
                data: {
                    province_id: province_id,
                    <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                },
                dataType: 'json',
                success: function(response) {
                    refreshToken();
                    if(response.status === 'success') {
                        var options = '<option value="">Select District</option>';
                        $.each(response.data, function(index, district) {
                            options += '<option value="' + district.id + '">' + district.name + '</option>';
                        });
                        $('#district_id').html(options);
                    }
                }
            });
        } else {
            $('#district_id').html('<option value="">Select Province First</option>');
        }
    });
});
</script>

<?= $this->endSection() ?>

