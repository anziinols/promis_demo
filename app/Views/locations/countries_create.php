<?= $this->extend("templates/dakoiiadmin"); ?>
<?= $this->section('content'); ?>

<section class="container-fluid">
    <div class="row p-2">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <i class="fa fa-plus"></i> Create New Country
                </div>
                <?= form_open('countries_create') ?>
                <div class="card-body">
                    <?php if (isset($validation)) : ?>
                        <div class="alert alert-danger"><?= $validation->listErrors() ?></div>
                    <?php endif; ?>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="code">Country Code <span class="text-danger">*</span></label>
                            <?= form_input('code', set_value('code'), ['class' => 'form-control', 'placeholder' => 'e.g., PNG', 'required' => 'required']) ?>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name">Country Name <span class="text-danger">*</span></label>
                            <?= form_input('name', set_value('name'), ['class' => 'form-control', 'placeholder' => 'e.g., Papua New Guinea', 'required' => 'required']) ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url() ?>countries" class="btn btn-secondary">CANCEL</a>
                    <button type="submit" class="btn btn-primary float-right">CREATE COUNTRY</button>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</section>

<?= $this->endSection() ?>

