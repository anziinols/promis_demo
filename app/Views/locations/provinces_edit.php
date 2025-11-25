<?= $this->extend("templates/dakoiiadmin"); ?>
<?= $this->section('content'); ?>

<section class="container-fluid">
    <div class="row p-2">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-warning">
                    <i class="fa fa-edit"></i> Edit Province
                </div>
                <?= form_open('provinces_edit/'.$province['id']) ?>
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
                                    <option value="<?= $country['id'] ?>" <?= ($province['country_id'] == $country['id']) ? 'selected' : '' ?>>
                                        <?= esc($country['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="provincecode">Province Code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="<?= esc($province['provincecode']) ?>" readonly>
                            <small class="text-muted">Province code cannot be changed</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Province Name <span class="text-danger">*</span></label>
                            <?= form_input('name', set_value('name', $province['name']), ['class' => 'form-control', 'placeholder' => 'Enter Province Name', 'required' => 'required']) ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url() ?>provinces" class="btn btn-secondary">CANCEL</a>
                    <button type="submit" class="btn btn-primary float-right">UPDATE PROVINCE</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

