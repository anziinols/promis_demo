<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $road['name'] ?></h1>
                <h5><?= $road['roadcode'] ?></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>roads"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Roads</a></li>
                    <li class="breadcrumb-item active"><?= $road['name'] ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row d-flex justify-content-center">
            <?php if (session()->has('error')) : ?>
                <div class="alert alert-default-danger">
                    <?php echo session('error'); ?>
                </div>
            <?php endif; ?>

            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success">
                    <?php echo session('success'); ?>
                </div>
            <?php endif; ?>

        </div>
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class=" container-fluid">

    <div class="row p-2">

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    Road Information
                    <a name="" id="" class="btn btn-flat float-right" href="#" role="button"><i class="fa fa-pen"></i></a>
                </div>
                <div class="card-body">
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-6 invoice-col">
                            <b>Name:</b> <?= $road['name'] ?><br>
                            <b>Code:</b> <?= $road['roadcode'] ?><br>
                            <b>Class:</b> <?= $road['class'] ?><br>
                            <b>Length:</b> <?= $road['length'] ?><br>
                            <b>No.Lanes:</b> <?= $road['num_lanes'] ?>
                        </div>
                        <!-- /.col -->

                        <div class="col-sm-6 invoice-col">
                            <b>Loc.Address</b>
                            <address>
                                <?= $road['country'] ?><br>
                                <?= $road['province'] ?><br>
                                <?= $road['district'] ?><br>
                            </address>
                        </div>
                        <!-- /.col -->

                        <!-- /.col -->
                        <div class="col-sm-12 invoice-col">
                            <b>Description</b>
                            <p><?= $road['description'] ?></p>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </div>

            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    KML Files
                    <a name="" id="" class="btn btn-flat float-right" href="#" role="button"><i class="fa fa-pen"></i></a>
                </div>
                <div class="card-body">

                </div>
                <div class="card-footer">
                    Footer
                </div>
            </div>
        </div>


        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    Base Files and Map


                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-flat float-right" data-toggle="modal" data-target="#basefile">
                        <i class="fa fa-pen    "></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="basefile" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-danger">
                                    <h5 class="modal-title">Road Base File for <?= $road['name'] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <?= form_open_multipart('basefile_upload') ?>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Upload KML Files</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="file_basekml" id="exampleInputFile" accept=".kml">
                                                <label class="custom-file-label" for="exampleInputFile">Choose .kml
                                                    file...</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button type="submit" class="input-group-text">
                                                    <i class="fa fa-upload" aria-hidden="true"></i> Upload
                                                </button>
                                            </div>
                                        </div>
                                        <small class=" text-danger d-flex justify-content-center "> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Uploading a
                                            new file will replace the current file and make changes to the map.
                                            <br> Are you sure you want to change the base road map for
                                            <?= $road['name'] ?> road?</small>
                                    </div>
                                    <input type="hidden" name="roadcode" value="<?= $road['roadcode'] ?>">
                                    <input type="hidden" name="roadid" value="<?= $road['id'] ?>">
                                    <?= form_close() ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <!-- 
                    extracting kml file into map
                 -->
                 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css" type="text/css">

                        <div id="map" class="map"></div>
                        <script type="text/javascript">
                            var map = new ol.Map({
                                target: 'map',
                                layers: [
                                    new ol.layer.Tile({
                                        source: new ol.source.OSM()
                                    })
                                ],
                                view: new ol.View({
                                    center: ol.proj.fromLonLat([0, 0]),
                                    zoom: 18
                                })
                            });

                            var vectorSource = new ol.source.Vector({
                                url: "<?= $kml['filepath'] ?>",
                                format: new ol.format.KML()
                            });

                            var vectorLayer = new ol.layer.Vector({
                                source: vectorSource
                            });

                            vectorSource.once('change', function() {
                                if (vectorSource.getState() == 'ready') {
                                    var extent = vectorSource.getExtent();
                                    var firstFeature = vectorSource.getFeatures()[0];
                                    if (firstFeature) {
                                        var firstGeometry = firstFeature.getGeometry();
                                        if (firstGeometry) {
                                            var firstCoordinate = firstGeometry.getFirstCoordinate();
                                            if (firstCoordinate) {
                                                map.getView().setCenter(firstCoordinate);
                                            }
                                        }
                                    }
                                    map.getView().fit(extent, map.getSize());
                                }
                            });

                            map.addLayer(vectorLayer);
                        </script>

                    <!-- 
                        End extract kml files to Map
                     -->

                </div>
                <div class="card-footer p-0">
                    <ul class="list-group">
                        <?php foreach ($basefileall as $key) : ?>
                            <li class="list-group-item"><?= $key['name'] ?>
                            <small class=" float-right"><b>Upload:</b> <?= datetimeforms($key['create_at']) ?></small><br>
                            <small class=" float-right"><b>By:</b> <?= ($key['create_by']) ?></small>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Features
                    <a name="" id="" class="btn btn-flat float-right" href="#" role="button"><i class="fa fa-pen"></i></a>
                </div>
                <div class="card-body">

                </div>
                <div class="card-footer">
                    Footer
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Bridges
                    <a name="" id="" class="btn btn-flat float-right" href="#" role="button"><i class="fa fa-pen"></i></a>
                </div>
                <div class="card-body">

                </div>
                <div class="card-footer">
                    Footer
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    Reports
                    <a name="" id="" class="btn btn-flat float-right" href="#" role="button"><i class="fa fa-pen"></i></a>
                </div>
                <div class="card-body">

                </div>
                <div class="card-footer">
                    Footer
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Projects
                    <a name="" id="" class="btn btn-flat float-right" href="#" role="button"><i class="fa fa-pen"></i></a>
                </div>
                <div class="card-body">

                </div>
                <div class="card-footer">
                    Footer
                </div>
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