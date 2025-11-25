<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Header -->
    <div class="card bg-primary text-white shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2"><i class="fas fa-edit me-2"></i><?= $pro['name'] ?></h2>
                    <p class="mb-0"><strong>Project Code:</strong> <?= $pro['procode'] ?></p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="<?= base_url() ?>open_projects/<?= $pro['ucode'] ?>" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Back to Project
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i><?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i><?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <!-- Edit Project Form -->
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <div class="card border-0 shadow">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-folder-open text-primary me-2"></i>Edit Project Information
                    </h5>
                </div>

                <?= form_open('', ['id' => 'editProjectForm']) ?>
                <div class="card-body px-3 px-md-4 py-4">

                    <div class="row">
                        <!-- Project Name -->
                        <div class="col-md-8 mb-4">
                            <label for="name" class="fw-bold">
                                <i class="fas fa-file-signature text-primary me-2"></i>Project Name
                                <span class="text-danger">*</span>
                            </label>
                            <?= form_input('name', $pro['name'], [
                                'class' => 'form-control form-control-lg',
                                'placeholder' => 'Enter project name',
                                'required' => 'required',
                                'id' => 'name'
                            ]) ?>
                            <small class="text-muted">Provide a clear and descriptive project name</small>
                        </div>

                        <!-- Commence Date -->
                        <div class="col-md-4 mb-4">
                            <label for="pro_date" class="fw-bold">
                                <i class="fas fa-calendar-alt text-info me-2"></i>Commencement Date
                            </label>
                            <input type="date" class="form-control" name="pro_date" id="pro_date"
                                   value="<?= $pro['pro_date'] ?>">
                            <small class="text-muted">When does the project start?</small>
                        </div>

                        <!-- Project Site -->
                        <div class="col-md-12 mb-4">
                            <label for="pro_site" class="fw-bold">
                                <i class="fas fa-map-marker-alt text-warning me-2"></i>Project Site
                            </label>
                            <input type="text" class="form-control" name="pro_site" id="pro_site"
                                   placeholder="Enter project site location" value="<?= $pro['pro_site'] ?>">
                            <small class="text-muted">Specify the physical location of the project</small>
                        </div>

                        <!-- Project Description -->
                        <div class="col-md-12 mb-4">
                            <label for="description" class="fw-bold">
                                <i class="fas fa-align-left text-secondary me-2"></i>Project Description
                            </label>
                            <?= form_textarea('description', $pro['description'], [
                                'class' => 'form-control',
                                'placeholder' => 'Provide detailed project description, objectives, and expected outcomes...',
                                'rows' => '4',
                                'id' => 'description'
                            ]) ?>
                            <small class="text-muted">Describe the project scope, objectives, and deliverables</small>
                        </div>

                        <!-- Location Divider -->
                        <div class="col-md-12 border-top pt-4 mt-3 mb-3">
                            <h5 class="fw-bold text-primary">
                                <i class="fas fa-map-marker-alt me-2"></i>Project Location
                            </h5>
                        </div>

                        <!-- Country -->
                        <div class="col-md-3 mb-4">
                            <label for="country" class="fw-bold">
                                <i class="fas fa-globe text-primary me-2"></i>Country
                            </label>
                            <select name="country" id="country" class="form-control">
                                <option value="">Select Country</option>
                                <?php foreach ($countries as $country) : ?>
                                    <option value="<?= $country['code'] ?>" <?= ($pro['country'] == $country['code']) ? 'selected' : '' ?>>
                                        <?= $country['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-muted">Select country</small>
                        </div>

                        <!-- Province -->
                        <div class="col-md-3 mb-4">
                            <label for="province" class="fw-bold">
                                <i class="fas fa-map text-info me-2"></i>Province
                            </label>
                            <select name="province" id="province" class="form-control">
                                <option value="">Select Province</option>
                                <?php foreach ($get_provinces as $prov) : ?>
                                    <option value="<?= $prov['provincecode'] ?>" <?= ($pro['province'] == $prov['provincecode']) ? 'selected' : '' ?>>
                                        <?= $prov['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-muted">Select province</small>
                        </div>

                        <!-- District -->
                        <div class="col-md-3 mb-4">
                            <label for="district" class="fw-bold">
                                <i class="fas fa-map-marked text-success me-2"></i>District
                            </label>
                            <select name="district" id="district" class="form-control">
                                <?php if (!empty($get_district)) : ?>
                                    <option selected value="<?= $pro['district'] ?>"><?= $get_district['name'] ?></option>
                                <?php else : ?>
                                    <option value="">Select District</option>
                                <?php endif; ?>
                            </select>
                            <small class="text-muted">Select district</small>
                        </div>

                        <!-- LLG -->
                        <div class="col-md-3 mb-4">
                            <label for="llg" class="fw-bold">
                                <i class="fas fa-map-pin text-danger me-2"></i>LLG
                            </label>
                            <select name="llg" id="llg" class="form-control">
                                <?php if (!empty($pro['llg']) && !empty($get_llg)) : ?>
                                    <option selected value="<?= $pro['llg'] ?>"><?= $get_llg['name'] ?></option>
                                <?php else : ?>
                                    <option value="">Select LLG</option>
                                <?php endif; ?>
                            </select>
                            <small class="text-muted">Select LLG (optional)</small>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?= base_url() ?>open_projects/<?= $pro['ucode'] ?>" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <input type="hidden" name="proid" value="<?= $pro['id'] ?>">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>


<script>
$(document).ready(function() {

    // Function to refresh CSRF token
    function refreshToken() {
        $.ajax({
            url: '<?= base_url() ?>refresh-token',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.token) {
                    $('input[name="<?= csrf_token() ?>"]').val(response.token);
                }
            }
        });
    }

    // Country Change Handler
    $('#country').change(function() {
        var country_id = $(this).find(':selected').data('id');

        if (!country_id) {
            $("#province").html("<option value=''>Select Province</option>");
            $("#district").html("<option value=''>Select District</option>");
            $("#llg").html("<option value=''>Select LLG</option>");
            return;
        }

        // Show loading state
        $("#province").prop('disabled', true);
        $("#district").html("<option value=''>Select District</option>").prop('disabled', true);
        $("#llg").html("<option value=''>Select LLG</option>").prop('disabled', true);

        $.ajax({
            url: '<?= base_url() ?>getaddress',
            type: 'post',
            data: {
                country_id: country_id,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function(response) {
                $("#province").prop('disabled', false);

                if (response.province && response.province.length > 0) {
                    var options = "<option value=''>Select Province</option>";

                    response.province.forEach(function(province) {
                        options += "<option value='" + province.provincecode + "'>" +
                                   province.name + "</option>";
                    });

                    $("#province").html(options);
                } else {
                    $("#province").html("<option value=''>No provinces available</option>");
                }

                // Refresh CSRF token after AJAX call
                refreshToken();
            },
            error: function() {
                $("#province").prop('disabled', false);
                $("#province").html("<option value=''>Error loading provinces</option>");
                toastr.error('Failed to load provinces');
            }
        });
    });

    // Province Change Handler
    $('#province').change(function() {
        var province_code = $(this).val();

        if (!province_code) {
            $("#district").html("<option value=''>Select District</option>");
            $("#llg").html("<option value=''>Select LLG</option>");
            return;
        }

        // Show loading state
        $("#district").prop('disabled', true);
        $("#llg").html("<option value=''>Select LLG</option>").prop('disabled', true);

        $.ajax({
            url: '<?= base_url() ?>getaddress',
            type: 'post',
            data: {
                province_code: province_code,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function(response) {
                $("#district").prop('disabled', false);

                if (response.district && response.district.length > 0) {
                    var options = "<option value=''>Select District</option>";

                    response.district.forEach(function(district) {
                        options += "<option value='" + district.districtcode + "'>" +
                                   district.name + "</option>";
                    });

                    $("#district").html(options);
                } else {
                    $("#district").html("<option value=''>No districts available</option>");
                }

                // Refresh CSRF token after AJAX call
                refreshToken();
            },
            error: function() {
                $("#district").prop('disabled', false);
                $("#district").html("<option value=''>Error loading districts</option>");
                toastr.error('Failed to load districts');
            }
        });
    });

    // District Change Handler
    $('#district').change(function() {
        var district_code = $(this).val();

        if (!district_code) {
            $("#llg").html("<option value=''>Select LLG</option>");
            return;
        }

        // Show loading state
        $("#llg").prop('disabled', true);

        $.ajax({
            url: '<?= base_url() ?>getaddress',
            type: 'post',
            data: {
                district_code: district_code,
                <?= csrf_token() ?>: '<?= csrf_hash() ?>'
            },
            dataType: 'json',
            success: function(response) {
                $("#llg").prop('disabled', false);

                if (response.llgs && response.llgs.length > 0) {
                    var options = "<option value=''>Select LLG</option>";

                    response.llgs.forEach(function(llg) {
                        options += "<option value='" + llg.llgcode + "'>" +
                                   llg.name + "</option>";
                    });

                    $("#llg").html(options);
                } else {
                    $("#llg").html("<option value=''>No LLGs available</option>");
                }

                // Refresh CSRF token after AJAX call
                refreshToken();
            },
            error: function() {
                $("#llg").prop('disabled', false);
                $("#llg").html("<option value=''>Error loading LLGs</option>");
                toastr.error('Failed to load LLGs');
            }
        });
    });

    // Form submission handler
    $('#editProjectForm').on('submit', function(e) {
        // Show loading state on submit button
        var submitBtn = $(this).find('button[type="submit"]');
        var originalText = submitBtn.html();
        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin me-2"></i>Saving...');

        // Allow form to submit normally
        // The disabled state will be reset on page reload
    });
});
</script>

<?= $this->endSection() ?>