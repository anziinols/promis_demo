<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12 d-flex justify-content-between">

                <h4><?= $pro['procode'] . "-" . $pro['name'] ?></h4>
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="<?= base_url() ?>po_open_project/<?= $pro['ucode'] ?>"> <i class="bi bi-chevron-left"></i> Go Back</a>
                    <span class="breadcrumb-item active">Events</span>
                </nav>
            </div>

        </div>

        <div class="row pb-2">
            <div class="col-md-12">
                <h5 class="text-center">Events During Project Life</h5>
            </div>
        </div>

        <div class="row mb-2 d-flex justify-content-center">
            <div class="col-md-12">
                <div class="card card-outline">
                    <?= form_open_multipart('add_proevents') ?>
                    <div class="card-body text-dark">
                        <div class="form-group">
                            <textarea id="my-textarea" class="form-control" name="event" placeholder="Event Description" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <input type="date" name="eventdate" id="" class="form-control" required>
                            <small class=" text-muted">
                                <i class="fa fa-info-circle" aria-hidden="true"></i> Date Event Occurred
                            </small>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="eventfiles[]" id="exampleInputFile" multiple>
                                    <label class="custom-file-label" for="exampleInputFile">Choose Files...</label>
                                </div>
                            </div>
                            <small class=" text-muted">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                                Upload files of this event
                            </small>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                        <button type="submit" class="btn btn-primary align-self-end"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Post Event</button>
                    </div>
                    </form>
                </div>
                <!-- ./card -->
            </div>
        </div>
        <?php foreach ($proevents as $pv) : ?>
            <div class="row mb-2  d-flex justify-content-center">

                <div class=" col-md-12">
                    <div class="card ">
                        <div class="card-body">

                            <div class="card-title"> <b class=""><?= dateforms($pv['eventdate']) ?></b> <?= $pv['event'] ?> </div>
                            <hr>
                            <?php foreach ($evfiles as $evf) :
                                if ($pv['id'] == $evf['event_id']) :
                            ?>
                                    <a href="<?= base_url() ?><?= $evf['filepath'] ?>">
                                        <figure class="figure">
                                            <img class="figure-img img-thumbnail" src="<?= imgfilecheck($evf['filepath']) ?>" height="100" width="100" alt="">
                                            <figcaption class="figure-caption text-center"> (.<?= getfileExtension($evf['filepath']) ?>)</figcaption>
                                        </figure>
                                    </a>
                            <?php
                                endif;
                            endforeach; ?>

                        </div>
                        <div class="card-footer">
                            <small><em>Create: <span class=" float-right"><?= datetimeforms($pv['create_at']) ?> <b><?= $pv['create_by'] ?></b></span> </em></small>
                        </div>
                    </div>

                </div>

            </div>
        <?php endforeach; ?>











    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>



</html>
<?= $this->endSection() ?>