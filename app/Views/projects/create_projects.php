<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<div class="container-fluid px-2 px-md-4 py-3">

    <!-- Page Header -->
    <div class="card bg-primary text-white shadow mb-4">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2 class="mb-2"><i class="fas fa-plus-circle me-2"></i>Register New Project</h2>
                    <p class="mb-0"><?= session('orgname') ?> | Create a new project in the system</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    <a href="<?= base_url() ?>projects" class="btn btn-light btn-lg">
                        <i class="fas fa-arrow-left me-2"></i>Back to Projects
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Form -->
    <div class="row">
        <div class="col-12 col-lg-10 offset-lg-1">
            <div class="card border-0 shadow">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-folder-plus text-primary me-2"></i>Project Information
                    </h5>
                </div>

                <?= form_open('new_projects', ['id' => 'projectForm']) ?>
                <div class="card-body px-3 px-md-4 py-4">
                    
                    <div class="row">
                        <!-- Project Name -->
                        <div class="col-md-12 mb-4">
                            <label for="name" class="fw-bold">
                                <i class="fas fa-file-signature text-primary me-2"></i>Project Name
                                <span class="text-danger">*</span>
                            </label>
                            <?= form_input('name', set_value('name'), [
                                'class' => 'form-control form-control-lg',
                                'placeholder' => 'Enter project name',
                                'required' => 'required',
                                'id' => 'name'
                            ]) ?>
                            <small class="text-muted">Provide a clear and descriptive project name</small>
                        </div>

                        <!-- Commence Date -->
                        <div class="col-md-6 mb-4">
                            <label for="pro_date" class="fw-bold">
                                <i class="fas fa-calendar-alt text-info me-2"></i>Commencement Date
                            </label>
                            <input type="date" class="form-control" name="pro_date" id="pro_date"
                                   value="<?= date('Y-m-d') ?>">
                            <small class="text-muted">When does the project start?</small>
                        </div>

                        <!-- Funding Source -->
                        <div class="col-md-6 mb-4">
                            <label for="fund" class="fw-bold">
                                <i class="fas fa-hand-holding-usd text-success me-2"></i>Funding Source
                            </label>
                            <select name="fund" id="fund" class="form-control">
                                <option value="">Select Funding Source</option>
                                <option value="Donor">Donor</option>
                                <option value="PIP">PIP</option>
                                <option value="Grants">Grants</option>
                            </select>
                            <small class="text-muted">Select the source of funding</small>
                        </div>

                        <!-- Project Description -->
                        <div class="col-md-12 mb-4">
                            <label for="description" class="fw-bold">
                                <i class="fas fa-align-left text-secondary me-2"></i>Project Description
                            </label>
                            <?= form_textarea('description', set_value('description'), [
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
                                <i class="fas fa-globe text-primary me-2"></i>Country <span class="text-danger">*</span>
                            </label>
                            <select name="country" id="country" class="form-control" required>
                                <option value="">Select Country</option>
                                <?php foreach ($countries as $country) : ?>
                                    <option value="<?= $country['code'] ?>"><?= $country['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- Province -->
                        <div class="col-md-3 mb-4">
                            <label for="province" class="fw-bold">
                                <i class="fas fa-map text-info me-2"></i>Province <span class="text-danger">*</span>
                            </label>
                            <select name="province" id="province" class="form-control" required>
                                <option value="">Select Province</option>
                                <?php foreach ($get_provinces as $prov) : ?>
                                    <option value="<?= $prov['provincecode'] ?>"><?= $prov['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- District -->
                        <div class="col-md-3 mb-4">
                            <label for="district" class="fw-bold">
                                <i class="fas fa-map-marked text-success me-2"></i>District <span class="text-danger">*</span>
                            </label>
                            <select name="district" id="district" class="form-control" required>
                                <option value="">Select District</option>
                            </select>
                        </div>

                        <!-- LLG -->
                        <div class="col-md-3 mb-4">
                            <label for="llg" class="fw-bold">
                                <i class="fas fa-map-pin text-dark me-2"></i>LLG <span class="text-danger">*</span>
                            </label>
                            <select name="llg" id="llg" class="form-control" required>
                                <option value="">Select LLG</option>
                            </select>
                        </div>

                    </div>

                </div>

                <div class="card-footer bg-light border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="<?= base_url() ?>projects" class="btn btn-secondary btn-lg">
                            <i class="fas fa-times me-2"></i>Cancel
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg shadow">
                            <i class="fas fa-plus-circle me-2"></i>Register Project
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
            },
            error: function() {
                $("#llg").prop('disabled', false);
                $("#llg").html("<option value=''>Error loading LLGs</option>");
                toastr.error('Failed to load LLGs');
            }
        });
    });

    // Form Validation
    $('#projectForm').on('submit', function(e) {
        var name = $('#name').val().trim();
        var province = $('#province').val();
        var district = $('#district').val();
        var llg = $('#llg').val();
        
        if (!name) {
            e.preventDefault();
            toastr.error('Please enter a project name');
            $('#name').focus();
            return false;
        }
        
        if (!province) {
            e.preventDefault();
            toastr.error('Please select a province');
            $('#province').focus();
            return false;
        }
        
        if (!district) {
            e.preventDefault();
            toastr.error('Please select a district');
            $('#district').focus();
            return false;
        }
        
        if (!llg) {
            e.preventDefault();
            toastr.error('Please select an LLG');
            $('#llg').focus();
            return false;
        }
    });

});
</script>

<?= $this->endSection() ?>