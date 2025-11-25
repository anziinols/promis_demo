<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $pro['name'] ?></h1>
                <h5><?= $pro['procode'] ?></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>projects"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Projects </a></li>
                    <li class="breadcrumb-item active"> <?= $pro['name'] ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class=" container-fluid">
    <div class="row p-2">

        <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->

        <div class=" col-md-12">

            <div class="card shadow-lg ">

                <?= form_open_multipart('add_proevents') ?>
                <div class="card-body">

                    <div class="row">

                        <div class="form-group col-md-12">
                            <textarea name="event" class=" form-control form-control-border" id="" rows="4" placeholder="Enter Event Brief" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label></label>
                            <input type="date" name="eventdate" max="<?= date('Y-m-d') ?>" class=" form-control form-control-border" placeholder="From" required>

                        </div>

                        <div class="form-group col-md-12 ">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="eventfiles[]" id="exampleInputFile" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">Choose Event Files
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="card-footer">
                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                    <input type="hidden" name="proid" value="<?= $pro['id'] ?>">
                    <button type="submit" class="btn btn-dark float-right"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Event</button>
                </div>

                <?= form_close() ?>
            </div>

        </div>
        <!-- ./col -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <i class="fas fa-calendar-check"></i> <h5 class=" float-right" >Event List</h5> 
                </div>
                <div class="card-body p-0">

                    <!-- ================================================ -->

                    <div class="row p-2 ">
                        <div class="col-md-12">

                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">

                                    <?php foreach ($events as $ev) : ?>
                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            <span class="bg-secondary">
                                                <?= dateforms($ev['eventdate']) ?>
                                            </span>
                                        </div>
                                        <!-- /.timeline-label -->
                                        <!-- timeline item -->
                                        <div>
                                            <i class="fas fa-calendar-check bg-primary"></i>

                                            <div class="timeline-item">
                                                <span class="time"><i class="far fa-clock"></i> <?= datetimeforms($ev['create_at']) ?> </span>

                                                <h3 class="timeline-header"><a href="#"><?= $ev['create_by'] ?></a> posted</h3>

                                                <div class="timeline-body">
                                                    <p><?= $ev['event'] ?></p>
                                                    <div class="row">
                                                        <?php $x = 0;
                                                        foreach ($eventfiles as $ef) :
                                                            if ($ef['event_id'] == $ev['id']) :
                                                        ?>

                                                                <?php
                                                                // Get the file extension
                                                                $file_ext = pathinfo($ef['filepath'], PATHINFO_EXTENSION);

                                                                // Check if the file is an image
                                                                if (!in_array(strtolower($file_ext), array('jpg', 'jpeg', 'png', 'gif'))) {


                                                                    // Display the image in an image tag
                                                                ?>

                                                                    <div class="">
                                                                        <a class=" btn btn-app" href="<?= base_url() ?><?= $ef['filepath'] ?>"> <i class="fa fa-download" aria-hidden="true"></i>
                                                                            <?= $ef['id'] . "(." . $file_ext . ")" ?>
                                                                        </a>
                                                                    </div>

                                                        <?php
                                                                }

                                                            endif;
                                                        endforeach; ?>
                                                    </div>
                                                    <div class="row">
                                                        <?php $x = 0;
                                                        foreach ($eventfiles as $ef) :
                                                            if ($ef['event_id'] == $ev['id']) :
                                                        ?>

                                                                <?php
                                                                // Get the file extension
                                                                $file_ext = pathinfo($ef['filepath'], PATHINFO_EXTENSION);

                                                                // Check if the file is an image
                                                                if (in_array(strtolower($file_ext), array('jpg', 'jpeg', 'png', 'gif'))) {
                                                                    // Display the image in an image tag
                                                                ?>

                                                                    <img class="img img-fluid img-bordered" src="<?= base_url() ?><?= $ef['filepath'] ?>" width="25%" alt="ev-pic">

                                                                <?php

                                                                } //else {
                                                                // Provide a download link
                                                                ?>
                                                                <!--    <a class=" btn btn-app" href="<?= base_url() ?><?= $ef['filepath'] ?>"> <i class="fa fa-download" aria-hidden="true"></i>
                                                                        <?= $ef['id'] . "(." . $file_ext . ")" ?>
                                                                    </a> -->
                                                                <?php
                                                                // }
                                                                ?>

                                                        <?php
                                                            endif;
                                                        endforeach; ?>
                                                    </div>
                                                </div>
                                                <!-- ./ timeline body -->
                                                <div class="timeline-footer d-flex justify-content-between">
                                                    <span class=" float-left"><small>
                                                            <b>Updated: </b><?= datetimeforms($ev['update_at']) ?> | <?= $ev['update_by'] ?>
                                                        </small></span>
                                                    <button class=" btn btn-sm btn-flat" data-toggle="modal" data-target="#ms<?= $ev['id'] ?>"> <i class="fas fa-pen    "></i></button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="ms<?= $ev['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-dark">
                                                                    <h5 class="modal-title"><i class="fa fa-edit"></i> <?= $ev['event'] ?></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <?= form_open('edit_proevents') ?>
                                                                <div class="modal-body">
                                                                    <div class="row">

                                                                        <div class="form-group col-md-12">
                                                                            <label>Event</label>
                                                                            <textarea name="event" class=" form-control" id="" rows="4" placeholder="Enter Event Brief" required><?= $ev['event'] ?></textarea>
                                                                        </div>
                                                                        <div class="form-group col-md-12">
                                                                            <label>Date</label>
                                                                            <input type="date" name="eventdate" max="<?= date('Y-m-d') ?>" class=" form-control" placeholder="From" value="<?= $ev['eventdate'] ?>">
                                                                        </div>

                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-between">
                                                                    <span class=" float-left"><small>
                                                                            <b>Created: </b><?= datetimeforms($ev['create_at']) ?> | <?= $ev['create_by'] ?><br>
                                                                            <b>Updated: </b><?= datetimeforms($ev['update_at']) ?> | <?= $ev['update_by'] ?><br>
                                                                        </small></span>
                                                                    <div>
                                                                        <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                                                        <input type="hidden" name="evid" value="<?= $ev['id'] ?>">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-dark">Save Changes</button>
                                                                    </div>

                                                                </div>
                                                                <?= form_close() ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /. modal -->

                                                </div>
                                            </div>
                                        </div>
                                        <!-- END timeline item -->

                                    <?php endforeach; ?>


                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->


                        </div>
                    </div>

                    <!-- ------------------------------------------------ -->

                </div>

            </div>
        </div>
    </div>
</section>


</body>



<?= $this->endSection() ?>