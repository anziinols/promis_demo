<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">

            <div class="col-sm-6">
                <h1 class="m-0"><?= $pro['name'] ?></h1>
                <h5>SETTINGS</h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>projects"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Projects</a></li>
                    <li class="breadcrumb-item active"><?= $pro['name'] ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class=" container-fluid">

    <div class="row p-2">

        <!-- main half split -->
        <div class="col-md-7">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            Project Information
                            <a name="" id="" class="btn btn-flat float-right" href="<?= base_url() ?>edit_projects/<?= $pro['procode'] ?>" role="button"><i class="fa fa-pen"></i></a>
                        </div>
                        <div class="card-body">
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-6 invoice-col">
                                    <b>Name:</b> <?= $pro['name'] ?><br>
                                    <b>ProCode:</b> <?= $pro['procode'] ?><br>
                                    <b>Fund:</b> <?= $pro['fund'] ?><br>
                                    <b>Mapping:</b> <?= $pro['mapping'] ?>
                                </div>
                                <!-- /.col -->

                                <div class="col-sm-6 invoice-col">
                                    <b>Loc.Address</b>
                                    <address>
                                        <?= $pro['country'] ?><br>
                                        <?= $pro['province'] ?><br>
                                        <?= $pro['district'] ?><br>
                                    </address>

                                </div>
                                <!-- /.col -->

                                <!-- /.col -->
                                <div class="col-sm-12 invoice-col">
                                    <b>Description</b>
                                    <p><?= $pro['description'] ?></p>
                                </div>
                                <!-- /.col -->

                            </div>
                            <!-- /.row -->

                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12">

                                    <span for="">Status:</span>
                                    <strong><?= strtoupper($pro['status']) ?></strong>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-flat float-right" data-toggle="modal" data-target="#prostatus">
                                        <i class="fa fa-pen" aria-hidden="true"></i>
                                    </button>



                                    <!-- Modal -->
                                    <div class="modal fade" id="prostatus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-dark">
                                                    <h5 class="modal-title"> <i class="fa fa-check-square" aria-hidden="true"></i> Project Status</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">

                                                    <?= form_open_multipart('pro_status') ?>

                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label class=" text-dark">Project Status</label>
                                                            <select class="form-control" name="status" id="">
                                                                <option selected value="<?= $pro['status'] ?>"><?= ucfirst($pro['status']) ?></option>
                                                                <option value="active">Active</option>
                                                                <option value="hold">Hold</option>
                                                                <option value="completed">Completed</option>
                                                                <option value="canceled">Canceled</option>
                                                            </select>
                                                        </div>

                                                    </div>

                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label for="my-textarea">Notes</label>
                                                            <textarea id="my-textarea" class="form-control" name="statusnotes" rows="3" required><?= $pro['statusnotes'] ?></textarea>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                                    <input type="hidden" name="proid" value="<?= $pro['id'] ?>">
                                                    <button type="submit" class="btn btn-dark float-right">
                                                        <i class="fa fa-save" aria-hidden="true"></i> Save
                                                    </button>
                                                    <?= form_close() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./modal -->
                                </div>
                                <!-- ./col  -->
                            </div>
                            <!-- ./row -->
                            <div class="row">
                                <div class="col-md-12">
                                    <p class=" text-muted"><?= $pro['statusnotes'] ?></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /. col -->


                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary ">
                            <span class=" float-left">Map (<?= $pro['gps'] ?>)</span>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-flat btn-dark btn-outline-light float-right" data-toggle="modal" data-target="#setgps">
                                <i class=" fa fa-map-marker-alt"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="setgps" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header  bg-dark">
                                            <h5 class="modal-title"> <i class="fas fa-map-marked-alt    "></i> GPS Coordinates</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body text-dark">

                                            <?= form_open_multipart('gps_set') ?>

                                            <div class="form-group">
                                                <label for="exampleInputFile">Latitude</label>
                                                <input type="text" class=" form-control" name="lat" placeholder="-3.3455" value="<?= $pro['lat'] ?>">

                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputFile">Longitude</label>
                                                <input type="text" class=" form-control" name="lon" placeholder="123.3455" value="<?= $pro['lon'] ?>">

                                            </div>


                                            <div class="form-group">
                                                <label for="exampleInputFile">Upload KML Files</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="file_basekml" id="exampleInputFile" accept=".kml">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose .kml
                                                            file...</label>
                                                    </div>
                                                </div>
                                                <small class=" text-muted">
                                                    Upload .KML if available
                                                </small>
                                            </div>

                                            <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                            <input type="hidden" name="proid" value="<?= $pro['id'] ?>">
                                            <button type="submit" class="btn btn-dark float-right">
                                                <i class="fa fa-save" aria-hidden="true"></i> Save
                                            </button>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./modal -->

                            <!-- =============================================================================== -->

                        </div>
                        <div class="card-body">

                            <!-- 
                    extracting kml file into map
                 -->
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css" type="text/css">

                            <div id="map" class="map"></div>



                            <script>
                                // GPS coordinates to display on map
                                var gpsCoord = ol.proj.fromLonLat([<?= $pro['lon'] ?>, <?= $pro['lat'] ?>]);

                                // Create a new map with OpenLayers
                                var map = new ol.Map({
                                    target: 'map',
                                    layers: [
                                        new ol.layer.Tile({
                                            source: new ol.source.OSM()
                                        })
                                    ],
                                    view: new ol.View({
                                        center: gpsCoord,
                                        zoom: 12
                                    })
                                });

                                // Create a new marker at the GPS coordinates
                                var marker = new ol.Feature({
                                    geometry: new ol.geom.Point(gpsCoord),
                                    name: 'GPS location'
                                });

                                // Create a new layer to hold the marker
                                var vectorLayer = new ol.layer.Vector({
                                    source: new ol.source.Vector({
                                        features: [marker]
                                    }),
                                    style: new ol.style.Style({
                                        image: new ol.style.Icon({
                                            anchor: [0.5, 46],
                                            anchorXUnits: 'fraction',
                                            anchorYUnits: 'pixels',
                                            src: 'https://openlayers.org/en/latest/examples/data/icon.png'
                                        })
                                    })
                                });

                                // Add the marker layer to the map
                                map.addLayer(vectorLayer);
                            </script>

                            <?php

                            use Predis\Command\Redis\EXISTS;

                            if (!empty($pro['kmlfile'])) :
                            ?>
                                <script>
                                    var vectorSource = new ol.source.Vector({
                                        url: "<?= $pro['kmlfile'] ?>",
                                        format: new ol.format.KML({
                                            extractStyles: false,
                                            extractAttributes: true,
                                            defaultStyle: null,
                                            defaultAttributes: null
                                        })
                                    });

                                    var trackStyle = new ol.style.Style({
                                        stroke: new ol.style.Stroke({
                                            color: 'red',
                                            width: 2
                                        })
                                    });

                                    var vectorLayer = new ol.layer.Vector({
                                        source: vectorSource,
                                        style: function(feature) {
                                            if (feature.getGeometry().getType() === 'LineString') {
                                                return trackStyle;
                                            }
                                        }
                                    });

                                    map.addLayer(vectorLayer);
                                </script>

                            <?php
                            endif;
                            ?>
                            <!-- 
                        End extract kml files to Map
                     -->


                        </div>
                        <div class="card-footer p-2">
                            <small class=" float-left"><b>Update:</b> <?= datetimeforms($pro['create_at']) ?></small>
                            <small class=" float-right"><b>By:</b> <?= ($pro['create_by']) ?></small>
                        </div>
                    </div>
                </div>
                <!-- ./ col -->




            </div>
            <!-- /. first half row -->
        </div>
        <!-- ./ 1st main half split col -->

        <!-- 2nd main half split col  -->
        <div class="col-md-5">
            <div class="row">
                <!-- ================== contractor -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary ">
                            Contractor
                            <!-- Button trigger modal -->
                            <span class=" float-right" data-toggle="modal" data-target="#edit_contractor">
                                <i class="fas fa-pen  text-light   "></i>
                            </span>

                            <!-- Modal -->
                            <div class="modal fade" id="edit_contractor" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title">Edit Contractor</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?= form_open("set_project_contractor") ?>
                                        <div class="modal-body ">
                                            <div class="form-group">
                                                <label for=""></label>
                                                <select class="form-control" name="contractor" id="">
                                                    <option selected value="<?= $pro['contractor_id'] ?>"><b><?= $pro['contractor_name'] ?></b></option>
                                                    <?php foreach ($contractors as $ct) : ?>
                                                        <option value="<?= $ct['id'] ?>"><?= $ct['concode'] ?>|<?= $ct['name'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="pro_id" value="<?= $pro['id'] ?>">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark">Save</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <label for="">Contactor</label>
                            <span class=" float-right"><?= $pro['contractor_code'] ?> - <?= $pro['contractor_name'] ?></span>
                        </div>

                    </div>
                </div>

                <!-- ================== project officer -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary ">
                            Project Officer
                            <!-- Button trigger modal -->
                            <span class=" float-right" data-toggle="modal" data-target="#edit_pro_officer">
                                <i class="fas fa-pen  text-light   "></i>
                            </span>

                            <!-- Modal -->
                            <div class="modal fade" id="edit_pro_officer" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title">Edit Project Officer</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?= form_open("set_project_officers") ?>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for=""></label>
                                                <select class="form-control" name="project_officers" id="">
                                                    <option selected value="<?= $pro['pro_officer_id'] ?>"><b><?= $pro['pro_officer_name'] ?></b></option>
                                                    <?php foreach ($pro_officers as $po) : ?>
                                                        <option value="<?= $po['id'] ?>"><?= $po['name'] ?> | <?= $po['username'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="pro_id" value="<?= $pro['id'] ?>">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark">Save</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <label for="">Project Officer</label>
                            <span class=" float-right"><?= $pro['pro_officer_name'] ?></span>
                        </div>

                    </div>
                </div>


                <!-- ================== Budgeted -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary ">
                            Budget

                            <!-- Button trigger modal -->
                            <span class="float-right" data-toggle="modal" data-target="#edit_project_budget">
                                <i class="fas fa-pen   text-light  "></i>
                            </span>

                            <!-- Modal -->
                            <div class="modal fade" id="edit_project_budget" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark ">
                                            <h5 class="modal-title">Edit Budget</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?= form_open("edit_project_budget") ?>
                                        <div class="modal-body text-dark">
                                            <div class="form-group">
                                                <label for="">Budget Amount</label>
                                                <input class="form-control" type="number" step=".01" min="0" name="budget" id="" value="<?= $pro['budget'] ?>" placeholder="Amount" required>
                                                <small id="helpId" class="form-text text-muted">Enter budget amount you wanted to change</small>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="pro_id" value="<?= $pro['id'] ?>">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark">Save</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <label>Budget: </label><span class=" float-right"> <?= COUNTRY_CURRENCY ?> <?= number_format($pro['budget'], 2) ?></span>
                        </div>

                    </div>
                </div>
                <!-- ./col -->

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary ">
                            Project Documents
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-flat btn-dark float-right" data-toggle="modal" data-target="#prodocs">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="prodocs" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title"> <i class="fas fa-upload    "></i> Upload Project Documents</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body text-dark">

                                            <?= form_open_multipart('prodocs_upload') ?>

                                            <div class="form-group">
                                                <label for="exampleInputFile">File Title</label>
                                                <div class="input-group">
                                                    <input type="text" name="name" placeholder="File Title" class=" form-control" required>
                                                </div>

                                                <label for="exampleInputFile">Upload Project Files</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="prodocs" id="exampleInputFile" required>
                                                        <label class="custom-file-label" for="exampleInputFile">Choose Documents
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                            <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                            <input type="hidden" name="proid" value="<?= $pro['id'] ?>">
                                            <button type="submit" class="btn btn-dark float-right">
                                                <i class="fa fa-save" aria-hidden="true"></i> Save
                                            </button>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./modal -->
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group">
                                <?php foreach ($prodocs as $pd) : ?>
                                    <li class="list-group-item">
                                        <?= $pd['name'] ?>(.<?= getfileExtension($pd['filepath']) ?>)
                                        <button class="btn btn-flat float-right" data-toggle="modal" data-target="#editprodocs<?= $pd['id'] ?>"> <i class="fas fa-pen    "></i></button>
                                        <a href="<?= $pd['filepath'] ?>" class="btn btn-flat float-right">
                                            <i class="fa fa-download" aria-hidden="true"></i>
                                        </a>
                                    </li>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editprodocs<?= $pd['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-dark">
                                                    <h5 class="modal-title"> <i class="fas fa-edit    "></i> Project Documents</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body text-dark">

                                                    <?= form_open_multipart('prodocs_edit') ?>

                                                    <div class="form-group">
                                                        <label for="exampleInputFile">File Title</label>
                                                        <div class="input-group">
                                                            <input type="text" name="name" placeholder="File Title" class=" form-control" value="<?= $pd['name'] ?>" required>
                                                        </div>

                                                        <label for="exampleInputFile">Project Files</label>
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" name="prodocs" id="exampleInputFile">
                                                                <label class="custom-file-label" for="exampleInputFile">Choose Documents
                                                                </label>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                                    <input type="hidden" name="pdid" value="<?= $pd['id'] ?>">
                                                    <button type="submit" class="btn btn-dark float-right">
                                                        <i class="fa fa-save" aria-hidden="true"></i> Save
                                                    </button>
                                                    <?= form_close() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./modal -->

                                <?php endforeach; ?>
                            </ul>
                        </div>

                    </div>
                </div>
                <!-- ./ col -->

                <!-- ./col -->

            </div>
        </div>
        <!-- ./ 2nd main half split col -->

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