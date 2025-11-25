<?= $this->extend("templates/dakoiiadmin"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid p-2 ">
        <div class="row p-1" class="">
            <div class=" col-md-11">
                <a href="<?= base_url() ?>ddash" class="float-right"> <i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>
            </div>
            <div class="col-md-12">
                <?php if (session()->has('error')) : ?>
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-triangle    "></i> <?= session('error') ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->has('success')) : ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check"></i> <?= session('success') ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h5 class="card-title text-dark float-left"> <i class="fas fa-image    "></i> Logo</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#edit_logo">
                            Edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="edit_logo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-dark">
                                        <h5 class="modal-title">Change logo</h5>
                                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?= form_open_multipart('dakoii_update_org_logo') ?>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputFile" class=" text-light">Upload Logo</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="org_logo" id="exampleInputFile" accept="image/*">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose Logo</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="org_id" value="<?= $org['id'] ?>">
                                        <input type="hidden" name="org_code" value="<?= $org['orgcode'] ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-upload" aria-hidden="true"></i> Upload Logo</button>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                        <!-- /. end modal -->
                    </div>
                    <img class="card-img-top" src="<?= imgcheck($org['orglogo']) ?>" alt="">
                </div>

            </div>

            <div class="col-md-8 ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-dark">
                                <h5 class="card-title float-left"> <i class="fa fa-info-circle" aria-hidden="true"></i> Organization Details</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#edit">
                                    Edit
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title"> <i class="fa fa-edit" aria-hidden="true"></i> Edit Organization</h5>
                                                <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?= form_open_multipart('deditorg') ?>
                                            <div class="modal-body">

                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="name" class=" text-light">Organization Code:</label>
                                                            <input type="text" class="form-control text-dark" id="name" name="orgcode" value="<?= $org['orgcode'] ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">

                                                        <div class="form-group">
                                                            <label for="name" class=" text-light">Organization Name:</label>
                                                            <input type="text" class="form-control" id="name" name="name" value="<?= $org['name'] ?>" placeholder="Enter organization name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="username" class=" text-light">Description:</label>
                                                            <?= form_textarea('description', $org['description'], ['class' => 'form-control', 'placeholder' => 'Enter Description', 'value' => 'Default Description']) ?>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group ">
                                                            <label for="my-select">Organization Status</label>
                                                            <select id="my-select" class="form-control" name="status">
                                                                <option value="">-- Select Option --</option>
                                                                <option value="active">Active</option>
                                                                <option value="deactive">Deactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" value="<?= $org['id'] ?>">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary float-right">Save Changes</button>
                                            </div>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.modal -->


                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><?= $org['orgcode'] ?> | <?= $org['name'] ?>  <span class="label label-info float-right"> |<?= ucwords($org['is_active']) ?></span> </h4>
                                <hr class=" bg-secondary">
                                <h6 class="card-subtitle text-muted"><?= nl2br($org['description']) ?></h6>
                            </div>


                        </div>
                        <!-- /.card -->

                    </div>
                    <!--./ col -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary text-dark">
                                <h5 class=" card-title float-left "><i class="fa fa-address-book" aria-hidden="true"></i> Address and Contacts</h5>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#edit_address">
                                    Edit
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="edit_address" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title"> <i class="fa fa-address-book" aria-hidden="true"></i> Address and Contacts</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?= form_open('dakoii_update_org_address') ?>
                                            <div class="modal-body text-light">
                                                <div class="row">
                                                    <div class="form-group col-md-12">

                                                        <input type="text" name="address" id="" class="form-control" placeholder="Address" value="<?= $org['address'] ?>">
                                                    </div>
                                                    <div class="form-group  col-md-6 ">

                                                        <input type="text" name="phones" id="" class="form-control" placeholder="Phones" value="<?= $org['phones'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <input type="text" name="emails" id="" class="form-control" placeholder="Email Addresses" value="<?= $org['emails'] ?>">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="">Country</label>
                                                        <select class="form-control" name="country_code" id="country_address" required>
                                                            <option value="">--Select Country--</option>
                                                            <?php if (!empty($countries)): ?>
                                                                <?php foreach ($countries as $country): ?>
                                                                    <option value="<?= $country['code'] ?>"
                                                                        <?= (!empty($org['country_code']) && $org['country_code'] == $country['code']) ? 'selected' : '' ?>>
                                                                        <?= $country['name'] ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            <?php else: ?>
                                                                <option value="">--No Countries Found--</option>
                                                            <?php endif; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="">Province</label>
                                                        <select class="form-control" name="province_code" id="province" required>
                                                            <option value="">--Select Province--</option>
                                                            <?php foreach ($get_provinces as $province) : ?>
                                                                <option value="<?= $province['provincecode'] ?>"><?= $province['provincecode'] ?>|<?= $province['name'] ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="">District</label>
                                                        <select class="form-control" name="district_code" id="district" required>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="">LLG</label>
                                                        <select class="form-control" name="llg_code" id="llg" required>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="org_code" value="<?= $org['orgcode'] ?>">
                                                <input type="hidden" name="org_id" value="<?= $org['id'] ?>">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <label>Address:</label>
                                <span class="card-text"><?= $org['address'] ?></span><br>
                                <label>Phones:</label>
                                <span class="card-text"><?= $org['phones'] ?></span><br>
                                <label>Emails:</label>
                                <span class="card-text"><?= $org['emails'] ?></span><br>
                                <span>
                                    <?= $org['country_name'] ?>, <?= $org['province_name'] ?>, <?= $org['district_name'] ?>, <?= $org['llg_name'] ?>
                                </span>
                            </div>

                        </div>
                    </div>
                    <!--./col -->

                </div>
                <!-- /.row -->


            </div>
            <!-- ./ col -->


        </div>
        <!-- /. row -->

        <div class="row">
            <div class="col-md-4 ">
                <div class="card bg-info ">
                    <div class="card-header text-dark bg-primary">
                        <i class="fas fa-user-cog    "></i>
                        System Administrators
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#sysadmin">
                            New Admin
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="sysadmin" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content bg-info">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title">Create System Admin</h5>
                                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?= form_open_multipart('daddadmin') ?>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username">Username:</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter a username" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="role">Role:</label>
                                            <select class="form-control" id="role" name="role" required>
                                                <option value="user" selected>User</option>
                                                <option value="moderator">Moderator</option>
                                                <option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">
                                                <label class="form-check-label" for="is_active">Active</label>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer bg-dark">
                                        <input type="hidden" name="orgcode" value="<?= $org['orgcode'] ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary float-right">Create Admin</button>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal -->

                    </div>
                    <div class="card-body p-0">


                        <table class="table table-light">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($admins as $ur) : ?>
                                    <tr>
                                        <td>
                                            <?= $ur['name'] ?>
                                        </td>
                                        <td>
                                            <?= $ur['username'] ?>
                                        </td>
                                        <td>
                                            <?= $ur['role'] ?>
                                        </td>
                                        <td>
                                            <?= $ur['is_active'] ?>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#edit_org_admin<?= $ur['id'] ?>">
                                                <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="edit_org_admin<?= $ur['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content bg-primary text-dark">
                                                        <div class="modal-header bg-dark text-light">
                                                            <h5 class="modal-title">Edit System Admin</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <?= form_open_multipart('dakoii_update_org_admin') ?>
                                                        <div class="modal-body ">
                                                            <div class="form-group">
                                                                <label for="name">Name:</label>
                                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required value="<?= $ur['name'] ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="password">Password:</label>
                                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter New password">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="role">Role:</label>
                                                                <select class="form-control" id="role" name="role" required>
                                                                    <option value="<?= $ur['role'] ?>" selected><?= ucwords($ur['role']) ?></option>
                                                                    <option value="user">User</option>
                                                                    <option value="moderator">Moderator</option>
                                                                    <option value="admin">Admin</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="form-check">
                                                                    <?php
                                                                    $checked = "";
                                                                    if ($ur['is_active'] == "1") {
                                                                        $checked = 'checked';
                                                                    }
                                                                    ?>
                                                                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="<?= $ur['is_active'] ?>" <?= $checked ?>>
                                                                    <label class="form-check-label" for="is_active">Active</label>

                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer bg-dark">
                                                            <input type="hidden" name="orgcode" value="<?= $org['orgcode'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary float-right">Save Changes</button>
                                                        </div>
                                                        <?= form_close() ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.modal -->
                                        </td>
                                    <?php endforeach; ?>
                            </tbody>

                        </table>


                    </div>

                </div>

            </div>
            <!-- /. col -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-dark">
                        <h5 class=" card-title float-left "> <i class="fa fa-map-marker-alt" aria-hidden="true"></i> <i class="fa fa-lock" aria-hidden="true"></i> Location Lock</h5>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#edit_location_lock">
                            Edit
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="edit_location_lock" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title"> <i class="fa fa-lock" aria-hidden="true"></i> Location Lock</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?= form_open('dakoii_update_org_location_lock') ?>
                                    <div class="modal-body text-light">
                                        <div class="form-group">
                                            <label for="">Country</label>
                                            <select class="form-control" name="country_code" id="country_lock">
                                                <option value="">--Select Country--</option>
                                                <?php if (!empty($countries)): ?>
                                                    <?php foreach ($countries as $country): ?>
                                                        <option value="<?= $country['code'] ?>"><?= $country['name'] ?></option>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <option value="">--No Countries Found--</option>
                                                <?php endif; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Province</label>
                                            <select class="form-control" name="province_code" id="province2">
                                                <option value="">--Select Province--</option>
                                                <?php foreach ($get_provinces as $province) : ?>
                                                    <option value="<?= $province['provincecode'] ?>"><?= $province['provincecode'] ?>|<?= $province['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">District</label>
                                            <select class="form-control" name="district_code" id="district2">
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">LLG</label>
                                            <select class="form-control" name="llg_code" id="llg2">
                                            </select>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="org_code" value="<?= $org['orgcode'] ?>">
                                        <input type="hidden" name="org_id" value="<?= $org['id'] ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <span class=""> <i class="fa fa-map-marker-alt" aria-hidden="true"></i></span> |
                        <?php if (!empty($org['is_locationlocked'])) : ?>

                            <span class=""><b>Level:</b> <?= ucfirst($org['loc_level_locked']) ?></span> |
                            <span class=""><b>Code:</b> <?= $org['loc_code_locked'] ?></span> |
                            <span class=""><b>Name:</b> <?= $org['loc_name_locked'] ?></span>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger btn-sm float-right " data-toggle="modal" data-target="#remove_lock">
                                <i class="fa fa-times-circle" aria-hidden="true"></i> Remove
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="remove_lock" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content text-dark">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> You are about to remove the Location Lock</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?= form_open('dakoii_remove_org_location_lock') ?>
                                        <div class="modal-footer">
                                            <input type="hidden" name="org_id" value="<?= $org['id'] ?>">
                                            <input type="hidden" name="org_code" value="<?= $org['orgcode'] ?>">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger"> <i class="fa fa-times" aria-hidden="true"></i> Remove</button>
                                        </div>
                                        <?= form_close() ?>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!--./col -->

        </div>

    </div>



    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>

<!-- address one -->
<script>
    // When the document is ready
    $(document).ready(function() {
        // Function to load districts based on the selected province
        $('#province').change(function() {
            var provinceCode = $(this).val(); // Get the selected province code

            // Clear existing options in district and LLG select elements
            $('#district').empty().append('<option value="">--Select District--</option>');
            $('#llg').empty().append('<option value="">--Select LLG--</option>');

            // If a province is selected
            if (provinceCode !== '') {
                // AJAX request to fetch districts based on the selected province
                $.ajax({
                    url: "<?= base_url('getaddress') ?>", // Replace with correct URL
                    method: 'POST',
                    data: {
                        province_code: provinceCode
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log("District Comeback");
                        console.log(response);
                        // Populate district select element with fetched districts
                        $.each(response.district, function(index, district) {
                            $('#district').append('<option value="' + district.districtcode + '">' + district.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching districts: ' + error);
                    }
                });
            } else {
                console.log('No province selected');
            }
        });


        // Function to load LLGs based on the selected district
        $('#district').change(function() {
            var districtCode = $(this).val(); // Get the selected district code

            // Clear existing options in LLG select element
            $('#llg').empty().append('<option value="">--Select LLG--</option>');

            // If a district is selected
            if (districtCode !== '') {
                // AJAX request to fetch LLGs based on the selected district
                $.ajax({
                    url: "<?= base_url('getaddress') ?>", // Replace with correct URL
                    method: 'POST',
                    data: {
                        district_code: districtCode
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log("LLGs Comeback");
                        console.log(response);
                        // Populate LLG select element with fetched LLGs
                        $.each(response.llgs, function(index, llg) {
                            $('#llg').append('<option value="' + llg.llgcode + '">' + llg.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching LLGs: ' + error);
                    }
                });
            }
        });

    });
</script>

<!-- address two - Location Lock -->
<script>
    // When the document is ready
    $(document).ready(function() {
        // Handle country change for Location Lock
        $('#country_lock').change(function() {
            var countryCode = $(this).val(); // Get the selected country code

            // Clear existing options in province, district and LLG select elements
            $('#province2').empty().append('<option value="">--Select Province--</option>');
            $('#district2').empty().append('<option value="">--Select District--</option>');
            $('#llg2').empty().append('<option value="">--Select LLG--</option>');

            // If a country is selected
            if (countryCode !== '') {
                // AJAX request to fetch provinces based on the selected country
                $.ajax({
                    url: "<?= base_url('get_provinces_by_country') ?>",
                    method: 'POST',
                    data: {
                        country_code: countryCode,
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log("Provinces Comeback");
                        console.log(response);
                        // Populate province select element with fetched provinces
                        if (response.provinces && response.provinces.length > 0) {
                            $.each(response.provinces, function(index, province) {
                                $('#province2').append('<option value="' + province.provincecode + '">' + province.provincecode + '|' + province.name + '</option>');
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching provinces: ' + error);
                    }
                });
            } else {
                console.log('No country selected');
            }
        });

        // Function to load districts based on the selected province
        $('#province2').change(function() {
            var provinceCode = $(this).val(); // Get the selected province code

            // Clear existing options in district and LLG select elements
            $('#district2').empty().append('<option value="">--Select District--</option>');
            $('#llg2').empty().append('<option value="">--Select LLG--</option>');

            // If a province is selected
            if (provinceCode !== '') {
                // AJAX request to fetch districts based on the selected province
                $.ajax({
                    url: "<?= base_url('getaddress') ?>", // Replace with correct URL
                    method: 'POST',
                    data: {
                        province_code: provinceCode,
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log("District Comeback");
                        console.log(response);
                        // Populate district select element with fetched districts
                        $.each(response.district, function(index, district) {
                            $('#district2').append('<option value="' + district.districtcode + '">' + district.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching districts: ' + error);
                    }
                });
            } else {
                console.log('No province selected');
            }
        });


        // Function to load LLGs based on the selected district
        $('#district2').change(function() {
            var districtCode = $(this).val(); // Get the selected district code

            // Clear existing options in LLG select element
            $('#llg2').empty().append('<option value="">--Select LLG--</option>');

            // If a district is selected
            if (districtCode !== '') {
                // AJAX request to fetch LLGs based on the selected district
                $.ajax({
                    url: "<?= base_url('getaddress') ?>", // Replace with correct URL
                    method: 'POST',
                    data: {
                        district_code: districtCode,
                        <?= csrf_token() ?>: '<?= csrf_hash() ?>'
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log("LLGs Comeback");
                        console.log(response);
                        // Populate LLG select element with fetched LLGs
                        $.each(response.llgs, function(index, llg) {
                            $('#llg2').append('<option value="' + llg.llgcode + '">' + llg.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching LLGs: ' + error);
                    }
                });
            }
        });

    });
</script>



</html>
<?= $this->endSection() ?>