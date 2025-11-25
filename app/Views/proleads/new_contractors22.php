<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">Register New Contractor</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>contractors"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Contract List</a></li>
                    <li class="breadcrumb-item active">New Contractor</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<section class=" container-fluid">

    <?= form_open('create_contractor') ?>
    <div class="row p-2">
        <div class=" col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <i class="fa fa-bookmark" aria-hidden="true"></i> Contractor Details
                </div>

                <div class="card-body">

                    <div class="row">
                        <!-- <div class="form-group col-md-4">
                           <input type="text" class=" form-control" name="roadcode" id="roadcode" readonly required placeholder="Road Code">
                        </div> -->

                        <div class="form-group col-md-12">
                            <?= form_input('name', set_value('name'), ['class' => 'form-control', 'placeholder' => 'Contractor Name', 'required' => 'required']) ?>
                        </div>
                        
                        <div class="form-group col-md-12">
                          <select class="form-control" name="category" class="form-control" required>
                            <option value="">Select Category</option>
                            <?php foreach($con_cat as $cc): ?>
                            <option value="<?= $cc['value'] ?>"><?= $cc['item'] ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>

                        <div class="form-group col-md-12">
                            <?= form_textarea('services', set_value('services'), ['class' => 'form-control', 'placeholder' => 'List all the services provided by this contractor']) ?>
                            <small class=" text-muted"><i class="fa fa-info-circle" aria-hidden="true"></i> List each service on each line</small>
                        </div>

                        <label class=" col-md-12 text-muted "> Contractor Location</label>
                        <div class="form-group col-md-3">
                            <select name="country" id="country" class="form-control">
                                <option selected value="<?= $set_country['code'] ?>"><?= $set_country['name'] ?></option>
                            </select>

                        </div>
                        <div class="form-group col-md-3">
                            <select name="province" id="province" class="form-control">
                                <option value="">Select Province</option>
                                <?php foreach ($get_provinces as $prov) : ?>
                                    <option value="<?= $prov['provincecode'] ?>"><?= $prov['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="district" id="district" class="form-control">
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="district" id="district" class="form-control">
                            </select>
                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- ./ col -->

        <div class=" col-md-6 pb-0">

            <div class="card">
                <div class="card-header bg-dark">
                    <i class="fas fa-file-pdf"></i> Contractor Files
                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="form-group col-md-6">
                            <input type="text" name="ipanumber" class=" form-control" placeholder="IPA Certificate Number" required>
                        </div>
                        <div class="form-group col-md-6">

                            <input type="date" name="ipadate" class=" form-control" placeholder="IPA Expiry Date" required>
                            <small class=" text-muted"> <i class="fa fa-clock" aria-hidden="true"></i> IPA Expiry Date</small>
                        </div>

                        <div class="form-group col-md-12">
                            <div class="input-group ">
                                <div class="custom-file ">
                                    <input type="file" class="custom-file-input " name="file_ipa" id="exampleInputFile" accept=".pdf" required>
                                    <label class="custom-file-label " for="exampleInputFile">IPA Certificate file...</label>
                                </div>
                            </div>
                            <small class=" text-muted">
                                <i class="fa fa-info-circle" aria-hidden="true"></i> Upload IPA Certificate in PDF format.
                            </small>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="text" name="ircnumber" class=" form-control" placeholder="IRC Certificate Number" required>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file_irc" id="exampleInputFile" accept=".pdf" required>
                                    <label class="custom-file-label" for="exampleInputFile">IRC Certificate file...</label>
                                </div>
                            </div>
                            <small class=" text-muted">
                                <i class="fa fa-info-circle" aria-hidden="true"></i> Upload IRC Certificate in PDF format.
                            </small>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="text" name="cocnumber" class=" form-control" placeholder="COC Certificate Number">
                        </div>

                        <div class="form-group col-md-6">

                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file_coc" id="exampleInputFile" accept=".pdf">
                                    <label class="custom-file-label" for="exampleInputFile"> COC Certificate file...</label>
                                </div>
                            </div>
                            <small class=" text-muted">
                                <i class="fa fa-info-circle" aria-hidden="true"></i> Upload COC Certificate in PDF format.
                            </small>
                        </div>

                        <div class="form-group col-md-6">
                            <input type="date" name="profiledate" max="<?= date('Y-m-d') ?>" class=" form-control" placeholder="Profile Date" required>
                            <small class=" text-muted"> <i class="fa fa-clock" aria-hidden="true"></i> Profile Date</small>
                        </div>
                        <div class="form-group col-md-6">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="file_profile" id="exampleInputFile" accept=".pdf" required>
                                    <label class="custom-file-label" for="exampleInputFile">Company Profile file...</label>
                                </div>
                            </div>
                            <small class=" text-muted">
                                <i class="fa fa-info-circle" aria-hidden="true"></i> Upload Company Profile in PDF format.
                            </small>
                        </div>

                    </div>

                </div>


            </div>

        </div>
        <!-- ./ col -->

    </div>
    <!-- ./ row -->
    <div class="row">
        <div class="col-md-12 pt-0 pb-4">
            <button type="submit" class="btn btn-dark btn-lg float-right shadow">REGISTER NEW CONTRACTOR</button>
        </div>
    </div>
    <!--  ./row -->
    <?= form_close() ?>


</section>


</body>


<script>
    $(document).ready(function() {
        $('#province').change(function() {
            var province_code = $(this).val();

            $.ajax({
                url: '<?= base_url() ?>getaddress',
                type: 'post',
                data: {
                    province_code: province_code
                },
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
                }
            });
        });
    });
</script>



<?= $this->endSection() ?>