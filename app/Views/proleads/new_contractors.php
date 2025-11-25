<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Header -->
    <div class="card bg-primary text-white shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2"><i class="fas fa-user-plus me-2"></i>Register New Contractor</h2>
                    <p class="mb-0"><?= session('orgname') ?> | Add a new contractor to the system</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="<?= base_url() ?>contractors" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Back to Contractors
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Contractor Form -->
    <?= form_open('create_contractor', ['id' => 'contractorForm']) ?>
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <div class="card border-0 shadow">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-building text-primary me-2"></i>Contractor Information
                    </h5>
                </div>

                <div class="card-body px-3 px-md-4 py-4">

                    <!-- Basic Information -->
                    <div class="row">
                        <div class="col-md-12 mb-4">
                            <label for="contractorName" class="fw-bold">
                                <i class="fas fa-tag text-primary me-2"></i>Contractor Name <span class="text-danger">*</span>
                            </label>
                            <?= form_input('name', set_value('name'), ['class' => 'form-control', 'placeholder' => 'Enter contractor name', 'required' => 'required', 'id' => 'contractorName']) ?>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="category" class="fw-bold">
                                <i class="fas fa-list-alt text-primary me-2"></i>Category <span class="text-danger">*</span>
                            </label>
                            <select class="form-control" name="category" id="category" required>
                                <option value="">-- Select Category --</option>
                                <?php if (!empty($con_cat)): ?>
                                    <?php foreach ($con_cat as $cc) : ?>
                                        <option value="<?= esc($cc['value']) ?>"><?= esc($cc['item']) ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="" disabled>No categories available</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-md-12 mb-4">
                            <label for="services" class="fw-bold">
                                <i class="fas fa-tools text-primary me-2"></i>Services Provided
                            </label>
                            <?= form_textarea('services', set_value('services'), ['class' => 'form-control', 'placeholder' => 'Enter services provided by this contractor', 'rows' => '4', 'id' => 'services']) ?>
                            <small class="text-muted">List each service on a separate line for better organization</small>
                        </div>
                    </div>

                    <!-- Location Section -->
                    <div class="col-md-12 border-top pt-4 mt-3 mb-3">
                        <h5 class="fw-bold text-primary">
                            <i class="fas fa-map-marker-alt me-2"></i>Contractor Location
                        </h5>
                    </div>

                    <div class="row">
                        <div class="col-12 col-md-6 mb-4">
                            <label for="country" class="fw-bold">
                                <i class="fas fa-globe text-primary me-2"></i>Country <span class="text-danger">*</span>
                            </label>
                            <select name="country" id="country" class="form-control" required>
                                <option selected value="<?= COUNTRY_CODE ?>">Papua New Guinea</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label for="province" class="fw-bold">
                                <i class="fas fa-map text-primary me-2"></i>Province <span class="text-danger">*</span>
                            </label>
                            <select name="province" id="province" class="form-control" required>
                                <option value="">-- Select Province --</option>
                                <?php if (!empty($get_provinces)): ?>
                                    <?php foreach ($get_provinces as $prov) : ?>
                                        <option value="<?= esc($prov['provincecode']) ?>"><?= esc($prov['name']) ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="" disabled>No provinces available</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label for="district" class="fw-bold">
                                <i class="fas fa-map-signs text-primary me-2"></i>District <span class="text-danger">*</span>
                            </label>
                            <select name="district" id="district" class="form-control" required>
                                <option value="">-- Select Province First --</option>
                            </select>
                        </div>

                        <div class="col-12 col-md-6 mb-4">
                            <label for="llg" class="fw-bold">
                                <i class="fas fa-map-pin text-primary me-2"></i>LLG (Local Level Government) <span class="text-danger">*</span>
                            </label>
                            <select name="llg" id="llg" class="form-control" required>
                                <option value="">-- Select District First --</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="card-footer bg-light border-top">
                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <a href="<?= base_url() ?>contractors" class="btn btn-secondary">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg shadow">
                            <i class="fas fa-save me-2"></i>Register Contractor
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?= form_close() ?>

</div>

<script>
    $(document).ready(function() {

        // Function to refresh CSRF token after AJAX calls
        function refreshCSRFToken() {
            $.ajax({
                url: '<?= base_url() ?>get_csrf_token',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.hash) {
                        $('input[name="<?= csrf_token() ?>"]').val(response.hash);
                    }
                },
                error: function(xhr, status, error) {
                    console.log('CSRF token refresh failed:', error);
                }
            });
        }

        // Province Change Handler - Load Districts
        $('#province').change(function() {
            var province_code = $(this).val();
            
            // Clear dependent dropdowns
            $("#district").html('<option value="">-- Loading Districts... --</option>');
            $("#llg").html('<option value="">-- Select District First --</option>');
            
            if (!province_code) {
                $("#district").html('<option value="">-- Select Province First --</option>');
                return;
            }

            $.ajax({
                url: '<?= base_url() ?>getaddress',
                type: 'POST',
                data: {
                    province_code: province_code,
                    <?= csrf_token() ?>: $('input[name="<?= csrf_token() ?>"]').val()
                },
                dataType: 'json',
                success: function(response) {
                    $("#district").empty();
                    $("#district").append('<option value="">-- Select a District --</option>');

                    if (response.district && response.district.length > 0) {
                        $.each(response.district, function(index, item) {
                            $("#district").append(
                                '<option value="' + item.districtcode + '">' + 
                                item.name + '</option>'
                            );
                        });
                    } else {
                        $("#district").append('<option value="">No districts available</option>');
                    }
                    
                    // Refresh CSRF token
                    refreshCSRFToken();
                },
                error: function(xhr, status, error) {
                    console.error('Error loading districts:', error);
                    $("#district").html('<option value="">-- Error loading districts --</option>');
                    toastr.error('Failed to load districts. Please try again.');
                }
            });
        });

        // District Change Handler - Load LLGs
        $('#district').change(function() {
            var district_code = $(this).val();
            
            // Clear LLG dropdown
            $("#llg").html('<option value="">-- Loading LLGs... --</option>');
            
            if (!district_code) {
                $("#llg").html('<option value="">-- Select District First --</option>');
                return;
            }

            $.ajax({
                url: '<?= base_url() ?>getaddress',
                type: 'POST',
                data: {
                    district_code: district_code,
                    <?= csrf_token() ?>: $('input[name="<?= csrf_token() ?>"]').val()
                },
                dataType: 'json',
                success: function(response) {
                    $("#llg").empty();
                    $("#llg").append('<option value="">-- Select a LLG --</option>');
                    
                    if (response.llgs && response.llgs.length > 0) {
                        $.each(response.llgs, function(index, item) {
                            $("#llg").append(
                                '<option value="' + item.llgcode + '">' + 
                                item.name + '</option>'
                            );
                        });
                    } else {
                        $("#llg").append('<option value="">No LLGs available</option>');
                    }
                    
                    // Refresh CSRF token
                    refreshCSRFToken();
                },
                error: function(xhr, status, error) {
                    console.error('Error loading LLGs:', error);
                    $("#llg").html('<option value="">-- Error loading LLGs --</option>');
                    toastr.error('Failed to load LLGs. Please try again.');
                }
            });
        });

        // Form Validation
        $('#contractorForm').on('submit', function(e) {
            var isValid = true;
            var errorMessage = '';

            // Validate contractor name
            if ($('#contractorName').val().trim() === '') {
                isValid = false;
                errorMessage += 'Contractor name is required.<br>';
            }

            // Validate category
            if ($('#category').val() === '') {
                isValid = false;
                errorMessage += 'Category is required.<br>';
            }

            // Validate location fields
            if ($('#province').val() === '') {
                isValid = false;
                errorMessage += 'Province is required.<br>';
            }

            if ($('#district').val() === '') {
                isValid = false;
                errorMessage += 'District is required.<br>';
            }

            if ($('#llg').val() === '') {
                isValid = false;
                errorMessage += 'LLG is required.<br>';
            }

            if (!isValid) {
                e.preventDefault();
                toastr.error(errorMessage);
                return false;
            }

            // Show loading state
            $(this).find('button[type="submit"]').prop('disabled', true).html(
                '<i class="fas fa-spinner fa-spin"></i> Registering...'
            );
        });

    });
</script>

<?= $this->endSection() ?>