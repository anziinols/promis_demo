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
                        <div class="card-header bg-secondary">
                            Funds

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-flat btn-dark float-right" data-toggle="modal" data-target="#addfund">
                                <i class="fas fa-plus-circle"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="addfund" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark">
                                            <h5 class="modal-title"> <i class="fas fa-dollar-sign    "></i> Add Payment</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?= form_open_multipart('addpayments') ?>
                                        <div class="modal-body text-dark">
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="inputName" class="">Amount</label>
                                                    <input type="number" step=".01" class="form-control" name="amount" id="inputName" placeholder="0000.00" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="inputName" class="">Payment Date</label>
                                                    <input type="date" class="form-control" name="paymentdate" id="inputName" placeholder="Date" required>
                                                </div>

                                                <div class="form-group">
                                                    <textarea id="my-textarea" class="form-control" name="description" placeholder="Enter Description" rows="3" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">Upload Payment Files</label>
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" class="custom-file-input" name="file_payment" id="exampleInputFile" required>
                                                            <label class="custom-file-label" for="exampleInputFile">Choose
                                                                file...</label>
                                                        </div>
                                                    </div>
                                                    <small class=" text-muted">
                                                        Upload the files for this payment
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-dark">Add Payment</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- ./ modal -->

                        </div>
                        <div class="card-body p-0">

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-light table-hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Amount(<?= COUNTRY_CURRENCY ?>)</th>
                                                <th>P.Date</th>
                                                <th>Notes</th>
                                                <th>File</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = array();
                                            $x = 1;
                                            foreach ($fund as $fd) : ?>
                                                <tr data-toggle="modal" data-target="#editfund<?= $fd['id'] ?>">
                                                    <td><?= $x++ ?></td>
                                                    <td data-toggle="tooltip" data-placement="top" title="<?= $fd['description'] ?>"><?= $total[] = number_format($fd['amount'], 2) ?></td>
                                                    <td><?= dateforms($fd['paymentdate']) ?></td>
                                                    <td><?= ($fd['description']) ?></td>
                                                    <td> <a class=" btn btn-flat text-dark" href="<?= $fd['filepath'] ?>"><i class="fa fa-download" aria-hidden="true"></i></a></td>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="editfund<?= $fd['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-secondary">
                                                                    <h5 class="modal-title"> <i class="fas fa-edit"></i> Edit Payment</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <?= form_open_multipart('editpayments') ?>
                                                                <div class="modal-body">

                                                                    <div class="form-group ">
                                                                        <label for="inputName" class="col-sm-1-12 col-form-label">Amount</label>
                                                                        <input type="number" step=".01" class="form-control" name="amount" id="inputName" placeholder="0000.00" required value="<?= $fd['amount'] ?>">
                                                                    </div>

                                                                    <div class="form-group ">
                                                                        <label for="inputName" class="col-sm-1-12 col-form-label">Payment Date</label>
                                                                        <input type="date" class="form-control" name="paymentdate" id="inputName" placeholder="Date" required value="<?= $fd['paymentdate'] ?>">
                                                                    </div>

                                                                    <div class="form-group ">
                                                                        <textarea id="my-textarea" class="form-control" name="description" placeholder="Enter Description" rows="3" required><?= $fd['description'] ?></textarea>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleInputFile">Upload Payment Files</label>
                                                                        <div class="input-group">
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input" name="file_payment" id="exampleInputFile">
                                                                                <label class="custom-file-label" for="exampleInputFile">Choose
                                                                                    file...</label>
                                                                            </div>
                                                                        </div>
                                                                        <small class=" text-muted">
                                                                            Upload the files for this payment
                                                                        </small>
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer d-flex justify-content-between ">
                                                                    <span class=" float-left">
                                                                        <small class=" float-left"><b>Create:</b> <?= datetimeforms($fd['create_at']) ?> | <?= $fd['create_by'] ?></small><br>
                                                                        <small><b>Update:</b> <?= datetimeforms($fd['update_at']) ?> | <?= $fd['update_by'] ?></small>
                                                                    </span>
                                                                    <div>
                                                                        <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                                                        <input type="hidden" name="payid" value="<?= $fd['id'] ?>">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-dark">Update Payment</button>
                                                                    </div>

                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- ./ modal -->
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <b>Totals</b>
                            <address>
                                <?php $paid = array();
                                $x = 1;
                                foreach ($fund as $fd) : ?>
                                    <?php (($paid[] = $fd['amount'])) ?>
                                <?php endforeach; ?>
                                Budgeted: <span class=" float-right"><?= COUNTRY_CURRENCY ?> <?= number_format($pro['budget'], 2) ?></span> <br>
                                Paid: <span class=" float-right"><?= COUNTRY_CURRENCY ?> <?= number_format($yetto = array_sum($paid), 2) ?></span> <br>

                                <b> Outstanding: <span class=" float-right"><?= COUNTRY_CURRENCY ?> <?= number_format(($pro['budget'] - $yetto), 2) ?></span></b>

                            </address>
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
                                    <li class="list-group-item" data-toggle="modal" data-target="#editprodocs<?= $pd['id'] ?>">
                                        <?= $pd['name'] ?>

                                        <a href="<?= $pd['filepath'] ?>" class="btn btn-outline-dark float-right">
                                            <i class="fa fa-download" aria-hidden="true"></i>(.<?= getfileExtension($pd['filepath']) ?>)
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

                            <div id="map"></div>

                            <!-- Add this line -->
                            <script>
                                var vectorSources = [
                                    new ol.source.Vector({
                                        url: "<?= base_url() . $pro['kmlfile'] ?>",
                                        format: new ol.format.KML({
                                            extractStyles: false,
                                            extractAttributes: true,
                                        }),
                                        strategy: ol.loadingstrategy.bbox, // Only load visible features
                                    }),
                                    // add more VectorSource objects as needed
                                ];
                                var vectorLayers = [];
                                for (var i = 0; i < vectorSources.length; i++) {
                                    var layer = new ol.layer.Vector({
                                        source: vectorSources[i],
                                        style: function(feature) {
                                            // Only display tracks
                                            if (feature.getGeometry().getType() === "LineString") {
                                                return new ol.style.Style({
                                                    stroke: new ol.style.Stroke({
                                                        color: "red",
                                                        width: 2,
                                                    }),
                                                });
                                            }
                                        },
                                    });
                                    vectorLayers.push(layer);
                                }
                                var marker1 = new ol.Feature({
                                    geometry: new ol.geom.Point(
                                        ol.proj.fromLonLat([<?= $pro['lon'] ?>, <?= $pro['lat'] ?>])
                                    ),
                                    name: "Marker 1",
                                    description: "This is the first marker",
                                    url: "https://govhrm.wanspeen.com",
                                    link: "View",
                                });

                                var vectorPoints = new ol.source.Vector({
                                    features: [marker1],
                                });
                                var vectorPointsLayer = new ol.layer.Vector({
                                    source: vectorPoints,
                                    style: new ol.style.Style({
                                        image: new ol.style.Icon({
                                            src: "<?= base_url() ?>public/assets/system_img/marker-map.png",
                                            // size:[20,20]
                                        }),
                                    }),
                                });
                                var map = new ol.Map({
                                    layers: [
                                        new ol.layer.Tile({
                                            source: new ol.source.OSM(),
                                        }),
                                        // add all VectorLayer objects to the layers array
                                        ...vectorLayers,
                                        vectorPointsLayer,
                                    ],
                                    target: "map",
                                    view: new ol.View({
                                        center: ol.proj.fromLonLat([<?= $pro['lon'] ?>, <?= $pro['lat'] ?>]),
                                        zoom: 12,
                                    }),
                                });
                                var element = document.getElementById("popup");
                                var popup = new ol.Overlay({
                                    element: element,
                                    positioning: "bottom-center",
                                    stopEvent: false,
                                    offset: [0, -20],
                                });
                            </script>






























                            <!-- 
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
                            </script> -->

                            <?php

                            use Predis\Command\Redis\EXISTS;

                            if (!empty($pro['kmlfile'])) :
                            ?>
                                <!-- <script>
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
                                </script> -->

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



                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            Events
                        </div>
                        <div class="card-body">
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

                                                                }
                                                            endif;
                                                        endforeach; ?>
                                                    </div>
                                                </div>
                                                <!-- ./ timeline body -->
                                                <div class="timeline-footer d-flex justify-content-between">
                                                    <span class=" float-left"><small>
                                                            <b>Updated: </b><?= datetimeforms($ev['update_at']) ?> | <?= $ev['update_by'] ?>
                                                        </small></span>

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
                </div>
                <!-- ./col events -->


            </div>
            <!-- /. first half row -->
        </div>
        <!-- ./ 1st main half split col -->

        <!-- 2nd main half split col  -->
        <div class="col-md-5">
            <div class="row">

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

                <!-- ================== phases and milestones -->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary ">
                            Phases and Milestones
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-flat btn-dark float-right" data-toggle="modal" data-target="#addphases">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Create Phase
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="addphases" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-dark ">
                                            <h5 class="modal-title"> <i class="fa fa-plus-circle" aria-hidden="true"></i> Create Phase</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?= form_open('add_phases') ?>
                                        <div class="modal-body">
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <?= form_input('phases', set_value('phases'), ['class' => 'form-control form-control-border', 'placeholder' => 'Enter Phase Title', 'required' => 'required']) ?>
                                                    </label>
                                                </div>
                                                <div class="input-group-append">
                                                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                                    <button type="submit" class="btn btn-dark float-right">Add Phase</button>
                                                </div>
                                            </div>
                                        </div>

                                        <?= form_close() ?>
                                    </div>
                                </div>
                            </div>
                            <!-- ./ modal -->
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group">
                                <?php foreach ($phases as $ph) : ?>
                                    <li class="list-group-item bg-dark ">
                                        <div class=" float-left font-weight-bolder">
                                            <a class=" text-light" href="<?= base_url() ?>open_prophases/<?= $ph['ucode'] ?>">
                                                <strong class=" float-left align-bottom"><?= $ph['phases'] ?></strong>
                                            </a>
                                        </div>
                                        <a class=" btn btn-flat float-right text-light" href="<?= base_url() ?>open_prophases/<?= $ph['ucode'] ?>">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-flat float-right text-light" data-toggle="modal" data-target="#edit<?= $ph['id'] ?>">
                                            <i class="fas fa-pen"></i>
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="edit<?= $ph['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-dark">
                                                        <h5 class="modal-title"><i class="fas fa-edit    "></i> Edit Phase</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <?= form_open('edit_phases') ?>
                                                    <div class="modal-body">
                                                        <div class="input-group">
                                                            <div class="custom-file">
                                                                <?= form_input('phases', $ph['phases'], ['class' => 'form-control form-control-border', 'placeholder' => 'Enter Phase Title', 'required' => 'required']) ?>
                                                                </label>
                                                            </div>
                                                            <div class="input-group-append">
                                                                <input type="hidden" name="phid" value="<?= $ph['id'] ?>">
                                                                <button type="submit" class="btn btn-dark float-right">Save Changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?= form_close() ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item p-0">

                                        <ul class="list-group">
                                            <?php foreach ($milestones as $ms) :
                                                if ($ms['phase_id'] == $ph['id']) {
                                            ?>
                                                    <li class="list-group-item "><?= $ms['milestones'] ?></li>
                                                <?php
                                                }
                                                ?>

                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php endforeach; ?>
                            </ul>

                        </div>

                    </div>
                </div>
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