<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<section class="container-fluid d-print-none ">
    <div class="row p-1">
        <div class="col-12 d-flex justify-content-between">
            <h4><?= $pro['procode'] . ": " . $pro['name'] ?></h4>
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="<?= base_url() ?>po_details/<?= $pro['ucode'] ?>"> <i class="bi bi-chevron-left"></i> Go Back</a>
                <!-- <a class="breadcrumb-item" href="#"></a> -->
                <span class="breadcrumb-item active"><?= $pro['procode'] ?></span>
            </nav>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <span class="lead"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Details Information</span>

        </div>
    </div>
</section>

<section class=" container-fluid content">
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card">
                <?= form_open('project_details_info_update') ?>
                <div class="card-header">
                    <i class="fa fa-edit" aria-hidden="true"></i> Information
                    <button type="submit" class="btn btn-primary float-right"><i class="fas fa-save    "></i> Save</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <input type="text" name="procode" class=" form-control" value="<?= $pro['procode'] ?>" id="" readonly>
                        </div>

                        <div class="form-group col-md-12">
                            <?= form_input('name', $pro['name'], ['class' => 'form-control', 'placeholder' => 'Project Name', 'required' => 'required', 'style' => 'background-color:#e8edea']) ?>
                        </div>

                        <div class="form-group col-md-12">
                            <?= form_textarea('description', $pro['description'], ['class' => 'form-control', 'placeholder' => 'Project Description', 'style' => 'background-color:#e8edea']) ?>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="country" id="country" class="form-control" style="background-color: #e8edea;">
                                <option selected value="<?= $set_country['code'] ?>"><?= $set_country['name'] ?></option>
                            </select>

                        </div>
                        <div class="form-group col-md-3">
                            <select name="province" id="province" class="form-control" style="background-color: #e8edea;">
                                <option value="">Select Province</option>
                                <?php foreach ($get_provinces as $prov) :
                                    if ($prov['provincecode'] == $pro['province']) {
                                ?>
                                        <option selected="selected" value="<?= $prov['provincecode'] ?>"><?= $prov['name'] ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?= $prov['provincecode'] ?>"><?= $prov['name'] ?></option>
                                    <?php
                                    }
                                    ?>

                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="district" id="district" class="form-control" style="background-color: #e8edea;">

                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="llg" id="llg" class="form-control" style="background-color: #e8edea;">

                            </select>
                        </div>



                    </div>

                </div>
                <div class="card-footer">
                    <em>Last Updated:
                        <span class=" float-right"> <?= datetimeforms($pro['update_at']) ?> / <?= $pro['update_by'] ?></span>
                    </em>
                </div>
                <?= form_close() ?>
            </div>
        </div>

    </div>



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


    <script>
        $(document).ready(function() {

            // Get selected province and district on page load
            var selectedProvince = $('#province').val();
            var selectedDistrict = '<?= $pro['district'] ?>';

            // Load districts for selected province
            if (selectedProvince) {

                $.ajax({
                    url: '<?= base_url() ?>getaddress',
                    type: 'post',
                    data: {
                        province_code: selectedProvince
                    },
                    dataType: 'json',
                    success: function(response) {

                        var districts = '';

                        for (var i = 0; i < response.district.length; i++) {

                            var code = response.district[i]['districtcode'];
                            var name = response.district[i]['name'];

                            if (code == selectedDistrict) {
                                districts += '<option value="' + code + '" selected>' + name + '</option>';
                            } else {
                                districts += '<option value="' + code + '">' + name + '</option>';
                            }

                        }

                        $("#district").html(districts);

                    }
                });

            }

        });
    </script>




</section>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

<?= $this->endSection() ?>