<?= $this->extend("templates/dakoiiadmin"); ?>
<?= $this->section('content'); ?>

<section class="container-fluid">
    <div class="row p-2">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fa fa-plus"></i> Create New Province
                </div>
                <?= form_open('provinces_create') ?>
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

                        <div class="form-group col-md-6">
                            <label for="provincecode">Province Code <span class="text-danger">*</span></label>
                            <?= form_input('provincecode', set_value('provincecode'), ['class' => 'form-control', 'placeholder' => 'e.g., NCD', 'required' => 'required']) ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Province Name <span class="text-danger">*</span></label>
                            <?= form_input('name', set_value('name'), ['class' => 'form-control', 'placeholder' => 'e.g., National Capital District', 'required' => 'required']) ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url() ?>provinces" class="btn btn-secondary">CANCEL</a>
                    <button type="submit" class="btn btn-primary float-right">CREATE PROVINCE</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

