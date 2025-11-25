<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<section class=" container-fluid">
    <div class="row p-2">
        <div class=" col-md-12">

            <div class="card">
                <div class="card-header">
                    Register New Project
                </div>
                <?= form_open('new_projects') ?>
                <div class="card-body">
                   
                    <div class="row">
                        <!-- <div class="form-group col-md-4">
                           <input type="text" class=" form-control" name="roadcode" id="roadcode" readonly required placeholder="Road Code">
                        </div> -->

                        <div class="form-group col-md-6">
                            <?= form_input('name', $pro['name'], ['class' => 'form-control', 'placeholder' => 'Enter Name', 'required' => 'required']) ?>
                        </div>
                        <div class="form-group col-md-3">
                            <select name="class" id="class" class="form-control" >
                                <option value="">Select Project Mapping</option>
                                <option value="point"> Point</option>
                                <option value="route">Route</option>
                            </select>
                            
                        </div>
                        <div class="form-group col-md-3">
                            <select name="fund" id="fund" class="form-control">
                                <option value="">Select Funding Source</option>
                                <?php foreach ($select as $sel) : ?>
                                    <option value="<?= $sel['value'] ?>"><?= $sel['item'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <?= form_textarea('description', set_value('description'), ['class' => 'form-control', 'placeholder' => 'Enter Description']) ?>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="country" id="country" class="form-control">
                                <option selected value="<?= $set_country['code'] ?>"><?= $set_country['name'] ?></option>
                            </select>

                        </div>
                        <div class="form-group col-md-4">
                            <select name="province" id="province" class="form-control">
                                <option value="">Select Province</option>
                                <?php foreach ($get_provinces as $prov) : ?>
                                    <option value="<?= $prov['provincecode'] ?>"><?= $prov['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <select name="district" id="district" class="form-control">
                            </select>
                        </div>



                    </div>

                </div>
                <div class="card-footer">
                <div class=" float-left" >
                    
                <small id="emailHelp" class="form-text text-muted"><i class="fa fa-info-circle" aria-hidden="true"></i> 
                <b>Project Mapping:</b> Route for long projects like tracks, roads, waterways. Points for single gps coordinate 
                projects like buildings.</small>
                </div>
                    <!-- <a href="<?= base_url() ?>roads" class="btn btn-default">CANCEL</a> -->
                    <button type="submit" class="btn btn-primary float-right">REGISTER PROJECT</button>
                </div>
                <?= form_close() ?>
            </div>

        </div>
    </div>
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