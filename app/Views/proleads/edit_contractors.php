<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">Edit Contractor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>open_contractor/<?= $con['ucode'] ?>"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Go Back</a></li>
                    <li class="breadcrumb-item active">Edit Contractor</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<section class=" container-fluid">


    <div class="row p-2">
        <div class=" col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <i class="fa fa-edit" aria-hidden="true"></i> Contractor Details
                </div>
                <?= form_open('update_contractor') ?>
                <div class="card-body">

                    <div class="row">
                        <!-- <div class="form-group col-md-4">
                           <input type="text" class=" form-control" name="roadcode" id="roadcode" readonly required placeholder="Road Code">
                        </div> -->

                        <div class="form-group col-md-12">
                            <?= form_input('name', $con['name'], ['class' => 'form-control', 'placeholder' => 'Contractor Name', 'required' => 'required']) ?>
                        </div>

                        <div class="form-group col-md-12">
                            <select class="form-control" name="category" class="form-control" required>
                                <?php foreach ($con_cat as $cc) :
                                    if ($con['category'] == $cc['value']) {
                                ?>
                                        <option selected value="<?= $cc['value'] ?>"><?= $cc['item'] ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $cc['value'] ?>"><?= $cc['item'] ?></option>
                                <?php }
                                endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <?= form_textarea('services', $con['services'], ['class' => 'form-control', 'placeholder' => 'List all the services provided by this contractor']) ?>
                            <small class=" text-muted"><i class="fa fa-info-circle" aria-hidden="true"></i> List each service on each line</small>
                        </div>

                        <label class=" col-md-12 text-muted "> Contractor Location</label>
                        <div class="form-group col-md-3">
                            <select name="country" id="country" class="form-control">
                                <option value="<?= $con['country'] ?>"><?= $con['country'] ?></option>
                            </select>

                        </div>
                        <div class="form-group col-md-3">
                            <select name="province" id="province" class="form-control">
                                <option value="">Select Province</option>
                                <?php foreach ($get_provinces as $prov) :
                                    if ($con['province'] == $prov['provincecode']) {
                                ?>
                                        <option selected value="<?= $prov['provincecode'] ?>"><?= $prov['name'] ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $prov['provincecode'] ?>"><?= $prov['name'] ?></option>
                                <?php }
                                endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="district" id="district" class="form-control">
                                <option value="<?= $con['district'] ?>"><?= $get_district['name'] ?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="llg" id="llg" class="form-control">
                                <option value="<?= $con['llg'] ?>"><?= $get_llg['name'] ?></option>
                            </select>
                        </div>

                    </div>

                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="hidden" name="id" value="<?= $con['id'] ?>">
                            <button type="submit" class="btn btn-primary float-right shadow"> <i class="fas fa-save    "></i> SAVE CHANGES</button>
                        </div>
                    </div>
                    <!--  ./row -->
                </div>
                <?= form_close() ?>

            </div>

        </div>
        <!-- ./ col -->

    </div>
    <!-- ./ row -->



</section>

</body>

<script>
    $(document).ready(function() {
        // Function to refresh CSRF token
        function refreshCSRFToken() {
            $.ajax({
                url: '<?= base_url() ?>get_csrf_token',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Store the new CSRF token for future use
                    window.csrf_token_name = data.csrf_token_name;
                    window.csrf_token_value = data.csrf_token_value;
                }
            });
        }
        
        $('#province').change(function() {
            var province_code = $(this).val();
            
            var ajaxData = {
                province_code: province_code
            };
            
            // Add CSRF token if available
            if (window.csrf_token_name && window.csrf_token_value) {
                ajaxData[window.csrf_token_name] = window.csrf_token_value;
            }

            $.ajax({
                url: '<?= base_url() ?>getaddress',
                type: 'post',
                data: ajaxData,
                dataType: 'json',
                success: function(response) {
                    var len = response.district.length;

                    $("#district").empty();
                    $("#district").append("<option value=''>Select a District</option>");

                    for (var i = 0; i < len; i++) {
                        var code = response.district[i]['districtcode'];
                        var name = response.district[i]['name'];
                        //var code = response.subcategories[i]['code'];

                        $("#district").append("<option value='" + code + "'>" + name +
                            "</option>");

                    }
                },
                complete: function() {
                    refreshCSRFToken();
                }
            });
        });



        $('#district').change(function() {
            var district_code = $(this).val();
            
            var ajaxData = {
                district_code: district_code
            };
            
            // Add CSRF token if available
            if (window.csrf_token_name && window.csrf_token_value) {
                ajaxData[window.csrf_token_name] = window.csrf_token_value;
            }

            $.ajax({
                url: '<?= base_url() ?>getaddress',
                type: 'post',
                data: ajaxData,
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    var len = response.llgs.length;
                    $("#llg").empty();
                    $("#llg").append("<option value=''>Select a LLG</option>");
                    for (var i = 0; i < len; i++) {

                        var code = response.llgs[i]['llgcode'];
                        var name = response.llgs[i]['name'];

                        $("#llg").append("<option value='" + code + "'>" + name + "</option>");
                    }
                },
                complete: function() {
                    refreshCSRFToken();
                }
            });
        });
        
        // Initialize CSRF token on page load
        refreshCSRFToken();

    });
</script>



<?= $this->endSection() ?>