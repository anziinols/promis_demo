<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12 d-flex justify-content-between">

                <h4><?= $pro['procode'] . "-" . $pro['name'] ?></h4>

                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="<?= base_url() ?>/po_phases/<?= $pro['ucode'] ?>"> Go Back</a>
                    <span class="breadcrumb-item active">Phases</span>
                    <span class="breadcrumb-item active">Milestones</span>
                </nav>

            </div>

        </div>

        <div class="row pb-2">
            <div class="col-md-12">
                <h5 class="text-center">MILESTONES</h5>
            </div>
        </div>
        <div class="row pb-2">
            <div class="col-md-12">
                <div class="card">
                    <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                    <div class="card-header bg-primary lead">
                        <span class="text-light float-left"><?= $milestones['milestones'] ?></span>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary justify-content-end float-right m-1" data-toggle="modal" data-target="#notes" hover>
                                        <i class=" fas fa-sticky-note" aria-hidden="true"></i> Notes
                                    </button>
                                </div>

                                <div class="">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary justify-content-end float-right m-1" data-toggle="modal" data-target="#addmilefile" hover>
                                        <i class=" fa fa-upload" aria-hidden="true"></i> Upload Milestone Files
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p><?= nl2br($milestones['notes']) ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php foreach ($milefiles as $file) : ?>
                                        <div class="card m-1 col-md-2">
                                            <div class="card-body p-0 ">
                                                <img src="<?= imgfilecheck($file['filepath']) ?>" class="img img-fluid" alt="">
                                            </div>
                                            <div class="card-footer text-muted text-center">
                                                <a href="<?= base_url() ?>" class=" btn btn-primary btn-sm"> <i class="fa fa-download" aria-hidden="true"></i> Download </a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>

                                </div>


                            </div>

                        </div>
                        <!-- ./row -->

                        <!-- Modal notes -->
                        <div class="modal fade" id="notes" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> <i class="fas fa-feather-alt    "></i> Notes</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?= form_open_multipart('milestone_notes') ?>
                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="my-textarea">Description</label>
                                            <textarea id="my-textarea" class="form-control" name="milenotes" rows="3" placeholder="Write something here"><?= $milestones['notes'] ?></textarea>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="ms_id" value="<?= $milestones['id'] ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <!-- ./modal -->

                        <!-- Modal upload files -->
                        <div class="modal fade" id="addmilefile" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"> <i class="fa fa-upload" aria-hidden="true"></i> Upload Milestone Files</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <?= form_open_multipart('milestone_files') ?>
                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label for="formFileMultiple" class="form-label">Multiple files Upload</label>
                                            <input class="form-control" name="milefiles[]" type="file" id="formFileMultiple" multiple>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" name="ms_id" value="<?= $milestones['id'] ?>">
                                        <input type="hidden" name="ph_id" value="<?= $phases['id'] ?>">
                                        <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"> <i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
                                    </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <!-- ./modal -->

                    </div>
                    <!-- ./card -->

                </div>
            </div>
        </div>
    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>



</html>
<?= $this->endSection() ?>