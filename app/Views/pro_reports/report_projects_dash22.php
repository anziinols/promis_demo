<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>



<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0">Project Officers</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>dashboard"><i class="fa fa-tachometer-alt" aria-hidden="true"></i></a></li>
                    <li class="breadcrumb-item active">Project Officers</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class=" container-fluid">

    <div class="row pt-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class=" float-left">Project Officers</h5>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark float-right" data-toggle="modal" data-target="#add_project_officers">
                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="add_project_officers" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <h5 class="modal-title"> <i class="fa fa-plus-circle" aria-hidden="true"></i> New Project Officer </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?= form_open('add_project_officers') ?>
                                <div class="modal-body text-dark">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="">Name</label>
                                            <input type="text" name="name" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                                            <small id="helpId" class="text-muted">Enter Full Name</small>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="">Username</label>
                                            <input type="text" name="username" id="" class="form-control" placeholder="" aria-describedby="helpId" pattern="^\S+$" title="No spaces allowed" required>
                                            <small id="helpId" class="text-muted">Enter username with no spaces</small>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="">Password</label>
                                            <input type="password" name="password" id="" class="form-control" placeholder="" aria-describedby="helpId" required>
                                            <small id="helpId" class="text-muted">Enter Password</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark">Add Project Officer</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group">
                        <?php foreach ($pro_officers as $po) :
                            $bg = "";
                            if ($po['status'] == "deactive") {
                                $bg = " text-muted";
                            }
                        ?>
                            <li class="list-group-item <?= $bg ?> "><?= $po['name'] ?> / <?= $po['username'] ?>
                                <span class=" badge badge-secondary"><?= $po['status'] ?></span>
                                <!-- Button trigger modal -->
                                <span class=" btn btn-secondary btn-sm float-right" data-toggle="modal" data-target="#edit<?= $po['id'] ?>">
                                    <i class="fas fa-pen    "></i>
                                </span>
                                <!-- Button trigger modal -->
                                <span class=" btn btn-secondary btn-sm float-right" data-toggle="modal" data-target="#pwd<?= $po['id'] ?>">
                                    <i class="fa fa-lock" aria-hidden="true"></i> pwd
                                </span>

                                <!-- Modal -->
                                <div class="modal fade" id="pwd<?= $po['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-dark">
                                                <h5 class="modal-title">Change Password</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?= form_open('edit_password_project_officers') ?>
                                            <div class="modal-body">
                                                <label>Name: </label> <span><?= $po['name'] ?></span>
                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                    <input type="password" class="form-control" name="password" id="" aria-describedby="helpId" placeholder="" required>
                                                    <small id="helpId" class="form-text text-muted">Enter Password</small>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" value="<?= $po['id'] ?>">
                                                <input type="hidden" name="name" value="<?= $po['name'] ?>">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Change Password</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./modal -->



                                <!-- Modal -->
                                <div class="modal fade" id="edit<?= $po['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-dark">
                                                <h5 class="modal-title">Edit</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?= form_open('edit_project_officers') ?>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" value="<?= $po['name'] ?>" required>
                                                    <small id="helpId" class="form-text text-muted">Edit Name</small>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Status</label>
                                                    <select class="form-control" name="status" id="">
                                                        <option selected value="<?= $po['status'] ?>"><?= ucfirst($po['status']) ?></option>
                                                        <option value="active">Active</option>
                                                        <option value="deactive">Deactive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" value="<?= $po['id'] ?>">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Save</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </li>
                        <?php endforeach; ?>

                    </ul>
                </div>

            </div>
            <!-- ./card -->
        </div>
    </div>


</section>




</body>


<?= $this->endSection() ?>