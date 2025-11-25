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

            <div class="card">

                <?= form_open_multipart('add_proevents') ?>
                <div class="card-body">

                    <div class="row">

                        <div class="form-group col-md-12">
                            <?= form_input('event', set_value('event'), ['class' => 'form-control form-control-border', 'placeholder' => 'Enter Event', 'required' => 'required']) ?>
                        </div>
                        <div class="form-group col-md-12">
                            <label></label>
                            <input type="date" name="eventdate" class=" form-control form-control-border" placeholder="From">

                        </div>

                        <div class="form-group col-md-12 ">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="eventfiles[]" id="exampleInputFile" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">Choose Documents
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-12">
                            <button type="submit" class="btn btn-dark float-right"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Event</button>
                        </div>

                    </div>
                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                    <input type="hidden" name="proid" value="<?= $pro['id'] ?>">
                </div>

                <?= form_close() ?>
            </div>

        </div>
        <!-- ./col -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <i class="fas fa-calendar-check"></i> Event List
                </div>
                <div class="card-body p-0">
                    
                <!-- ================================================ -->
                
                <div class="row p-2 ">
                    <div class="col-md-12">
                      
                       <!-- Post -->
                       <div class="post clearfix">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Sarah Ross</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Sent you a message - 3 days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.
                      </p>

                      <form class="form-horizontal">
                        <div class="input-group input-group-sm mb-0">
                          <input class="form-control form-control-sm" placeholder="Response">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-danger">Send</button>
                          </div>
                        </div>
                      </form>
                    </div>
                    <!-- /.post -->
                    
                 <!-- Post -->
                 <div class="post">
                      <div class="user-block">
                        <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                        <span class="username">
                          <a href="#">Adam Jones</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                        <span class="description">Posted 5 photos - 5 days ago</span>
                      </div>
                      <!-- /.user-block -->
                      <div class="row mb-3">
                        <div class="col-sm-6">
                          <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-6">
                          <div class="row">
                            <div class="col-sm-6">
                              <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                              <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                              <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                              <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                            </div>
                            <!-- /.col -->
                          </div>
                          <!-- /.row -->
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <p>
                        <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                        <span class="float-right">
                          <a href="#" class="link-black text-sm">
                            <i class="far fa-comments mr-1"></i> Comments (5)
                          </a>
                        </span>
                      </p>

                      <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                    </div>
                    <!-- /.post -->
                
                    </div>
                </div>
                
                <!-- ------------------------------------------------ -->
                
                    <ul class="list-group">
                        <?php foreach ($events as $ev) : ?>

                            <!-- li trigger modal -->
                            <li class="list-group-item " data-toggle="modal" data-target="#ms<?= $ev['id'] ?>">
                                <b><?= $ev['event'] ?></b>
                                <span class=" float-right"><b>Date :</b><?= dateforms($ev['eventdate']) ?> <b></span>
                            </li>
                            <li class="list-group-item ">
                                <?php foreach ($eventfiles as $ef) : ?>

                                    <?php
                                    // Get the file extension
                                    $file_ext = pathinfo($ef['filepath'], PATHINFO_EXTENSION);

                                    // Check if the file is an image
                                    if (in_array(strtolower($file_ext), array('jpg', 'jpeg', 'png', 'gif'))) {
                                        // Display the image in an image tag
                                        ?>
                                        <img src="<?= base_url() ?><?= $ef['filepath'] ?>" alt="" width="300px" height="300px" class=" img img-thumbnail">
                                        <?php
                                    } else {
                                        // Provide a download link
                                    ?>
                                        <a class=" btn btn-app" href="<?= base_url() ?><?= $ef['filepath'] ?>"> <i class="fa fa-download" aria-hidden="true"></i>
                                            <?= $ef['id'] ?>
                                        </a>
                                    <?php
                                    }
                                    ?>


                                <?php endforeach; ?>

                            </li>

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
                                        <?= form_open('edit_event') ?>
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="form-group col-md-12">
                                                    <label>Event</label>
                                                    <?= form_input('event', $ev['event'], ['class' => 'form-control', 'placeholder' => 'Enter Event', 'required' => 'required']) ?>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Date</label>
                                                    <input type="date" name="eventdate" class=" form-control" placeholder="From" value="<?= $ev['eventdate'] ?>">
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
                                                <input type="hidden" name="mlid" value="<?= $ev['id'] ?>">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark">Save</button>
                                            </div>

                                        </div>
                                        <?= form_close() ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </ul>
                </div>

            </div>
        </div>
    </div>
</section>


</body>



<?= $this->endSection() ?>