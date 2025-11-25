<?= $this->extend("templates/dakoiiadmin"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid p-2 ">

        <div class="row p-1">
            <div class="col-md-4 ">

                <div class="card ">
                    <div class="card-header">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        Add Dakoii Users
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modelId">
                            New Dakoii User
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Create User</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?= form_open('dadduser') ?>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="user_name">Name:</label>
                                            <input type="text" class="form-control" id="user_name" name="name" placeholder="Enter your name" required>
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
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary float-right">Create User</button>
                                    </div>
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal -->

                    </div>
                    <div class="card-body">

                        <table class="table table-light">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dusers as $ur) : ?>
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
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>


                    </div>

                </div>

            </div>

            <div class="col-md-8 ">

                <div class="card bg-info ">
                    <div class="card-header text-dark bg-primary">
                        <i class=" fas fa-briefcase"></i>
                        ORGANIZATIONS
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#addorg">
                            New Organization
                        </button>


                        <!-- Modal -->
                        <div class="modal fade" id="addorg" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary">
                                        <h5 class="modal-title"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Create Organization</h5>
                                        <button type="button" class="close text-dark" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?= form_open_multipart('daddorg') ?>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="org_name" class=" text-light">Organization Name:</label>
                                            <input type="text" class="form-control" id="org_name" name="name" placeholder="Enter organization name" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="username" class=" text-light">Description:</label>
                                            <?= form_textarea('description', set_value('description'), ['class' => 'form-control', 'placeholder' => 'Enter Description']) ?>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputFile" class=" text-light">Organization Logo</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="org_logo" id="exampleInputFile" accept="image/*">
                                                    <label class="custom-file-label" for="exampleInputFile">Choose Logo</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer bg-dark">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary float-right">Create Organization</button>
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
                                    <th>#</th>
                                    <th>OrgCode</th>
                                    <th>Name</th>
                                    <th>AddLock</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = 1;
                                foreach ($org as $ur) : ?>
                                    <tr>
                                        <td>
                                            <?= $x++ ?>
                                        </td>
                                        <td>
                                            <?= $ur['orgcode'] ?>
                                        </td>
                                        <td>
                                            <?= $ur['name'] ?>
                                        </td>
                                        <td>
                                            <?= ucwords($ur['loc_level_locked']) ?> /
                                            <?= $ur['loc_code_locked'] ?> /
                                            <?= ucwords($ur['loc_name_locked']) ?>
                                        </td>
                                        <td>
                                            <?= $ur['is_active'] ?>
                                        </td>
                                        <td>
                                            <a href="<?= base_url() ?>dopen_org/<?= $ur['orgcode'] ?>" >Open</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>


                    </div>

                </div>

            </div>

        </div>

        <!-- Locations Management Section -->
        <div class="row p-1 mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                        LOCATIONS MANAGEMENT
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- Countries Card -->
                            <div class="col-md-3 mb-3">
                                <div class="card border-primary">
                                    <div class="card-header bg-primary text-white text-center">
                                        <i class="fa fa-globe fa-2x"></i>
                                        <h5 class="mt-2">Countries</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <p class="text-muted">Manage countries in the system</p>
                                        <a href="<?= base_url() ?>countries" class="btn btn-primary btn-block">
                                            <i class="fa fa-list"></i> View Countries
                                        </a>
                                        <a href="<?= base_url() ?>countries_create" class="btn btn-outline-primary btn-block">
                                            <i class="fa fa-plus"></i> Add Country
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Provinces Card -->
                            <div class="col-md-3 mb-3">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white text-center">
                                        <i class="fa fa-map-marker fa-2x"></i>
                                        <h5 class="mt-2">Provinces</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <p class="text-muted">Manage provinces and states</p>
                                        <a href="<?= base_url() ?>provinces" class="btn btn-info btn-block">
                                            <i class="fa fa-list"></i> View Provinces
                                        </a>
                                        <a href="<?= base_url() ?>provinces_create" class="btn btn-outline-info btn-block">
                                            <i class="fa fa-plus"></i> Add Province
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Districts Card -->
                            <div class="col-md-3 mb-3">
                                <div class="card border-warning">
                                    <div class="card-header bg-warning text-dark text-center">
                                        <i class="fa fa-map fa-2x"></i>
                                        <h5 class="mt-2">Districts</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <p class="text-muted">Manage districts and regions</p>
                                        <a href="<?= base_url() ?>districts" class="btn btn-warning btn-block">
                                            <i class="fa fa-list"></i> View Districts
                                        </a>
                                        <a href="<?= base_url() ?>districts_create" class="btn btn-outline-warning btn-block">
                                            <i class="fa fa-plus"></i> Add District
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- LLGs Card -->
                            <div class="col-md-3 mb-3">
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white text-center">
                                        <i class="fa fa-building fa-2x"></i>
                                        <h5 class="mt-2">LLGs</h5>
                                    </div>
                                    <div class="card-body text-center">
                                        <p class="text-muted">Manage Local Level Governments</p>
                                        <a href="<?= base_url() ?>llgs" class="btn btn-danger btn-block">
                                            <i class="fa fa-list"></i> View LLGs
                                        </a>
                                        <a href="<?= base_url() ?>llgs_create" class="btn btn-outline-danger btn-block">
                                            <i class="fa fa-plus"></i> Add LLG
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>



</html>
<?= $this->endSection() ?>