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
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>projects"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Roads</a></li>
                    <li class="breadcrumb-item active"><?= $pro['name'] ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class=" container-fluid">

    <div class="row p-2">

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    Project Information
                    <a name="" id="" class="btn btn-flat float-right" href="#" role="button"><i class="fa fa-pen"></i></a>
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
                        <div class="col-sm-7 invoice-col">
                            <b>Description</b>
                            <p><?= $pro['description'] ?></p>
                        </div>

                        <!-- /.col -->
                        <div class="col-sm-5 invoice-col">

                            <b>Budget</b>
                            <address>
                                <?php $paid = array();
                                $x = 1;
                                foreach ($fund as $fd) : ?>
                                    <?php (($paid[] = $fd['amount'])) ?>
                                <?php endforeach; ?>
                                Budgeted: <span class=" float-right" ><?= COUNTRY_CURRENCY ?> <?= number_format($pro['budget'],2) ?></span> <br>
                                Paid: <span class=" float-right" ><?= COUNTRY_CURRENCY ?> <?= number_format($yetto = array_sum($paid),2) ?></span> <br>
                                
                              <b>  Yetto: <span class=" float-right" ><?= COUNTRY_CURRENCY ?> <?= number_format(($pro['budget'] - $yetto),2) ?></span></b>
                                
                            </address>
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
                    Funding

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-flat float-right" data-toggle="modal" data-target="#addfund">
                        <i class="fas fa-pen"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addfund" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Payment</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <?= form_open_multipart('addpayments') ?>
                                <div class="modal-body">
                                    <div class="">

                                        <div class="form-group row">

                                            <div class="form-group col-md-12">
                                                <label for="inputName" class="col-sm-1-12 col-form-label">Amount</label>
                                                <input type="number" step=".01" class="form-control" name="amount" id="inputName" placeholder="Amount">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label for="inputName" class="col-sm-1-12 col-form-label">Payment Date</label>
                                                <input type="date" class="form-control" name="paymentdate" id="inputName" placeholder="Date">
                                            </div>

                                            <div class="form-group col-md-12">
                                                <?= form_textarea('description', set_value('description'), ['class' => 'form-control', 'placeholder' => 'Enter Description']) ?>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-body p-0">
                    <table class="table table-light">
                        <thead class="thead-dark">
                            <tr>
                                <th>#</th>
                                <th>Amount</th>
                                <th>P.Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = array();
                            $x = 1;
                            foreach ($fund as $fd) : ?>
                                <tr>
                                    <td><?= $x++ ?></td>
                                    <td><?= $total[] = ($fd['amount']) ?></td>
                                    <td><?= dateforms($fd['paymentdate']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>
                </div>
                <div class="card-footer">
                    <b>Total Payment: <?= COUNTRY_CURRENCY ?> </b> <b class=" float-right"><?= number_format(array_sum($total), 2) ?> </b>
                </div>
            </div>
        </div>


        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    Map


                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-flat float-right" data-toggle="modal" data-target="#basefile">
                        <i class="fa fa-pen    "></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="basefile" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header  bg-danger">
                                    <h5 class="modal-title">Road Base File for <?= $pro['name'] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">

                                    <?= form_open_multipart('gps_upload') ?>
                                    <div class="form-group">
                                        <label for="exampleInputFile">GPS Coordinates</label>
                                        <input type="text" class=" form-control" name="gps" placeholder="123.3455,-34.4543" value="<?= $pro['gps'] ?>">
                                        <small class=" text-muted">
                                            Enter GPS Coordinates
                                        </small>
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
                                    <button type="submit" class="btn btn-primary float-right">
                                        <i class="fa fa-save" aria-hidden="true"></i> Save
                                    </button>
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

                    <?php

                    use Predis\Command\Redis\EXISTS;

                    if (!empty($kml['kmlfile']) && file_exists($kml['kmlfile'])) :
                    ?>
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
                                url: "<?= $pro['kmlfile'] ?>",
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
                    <?php
                    endif;
                    ?>
                    <!-- 
                        End extract kml files to Map
                     -->

                    <script>
                        // Wewak town coordinates
                        var wewak = ol.proj.fromLonLat([<?= $pro['gps'] ?>]);

                        // Create a marker feature with the coordinates
                        var marker = new ol.Feature({
                            geometry: new ol.geom.Point(wewak)
                        });

                        // Create an icon style for the marker
                        var iconStyle = new ol.style.Style({
                            image: new ol.style.Icon({
                                anchor: [0.5, 1],
                                src: 'https://openlayers.org/en/v4.6.5/examples/data/icon.png'
                            })
                        });

                        // Set the style for the marker feature
                        marker.setStyle(iconStyle);

                        // Create a vector layer with the marker feature
                        var vectorLayer = new ol.layer.Vector({
                            source: new ol.source.Vector({
                                features: [marker]
                            })
                        });

                        // Create the map with an OpenStreetMap layer and the vector layer
                        var map = new ol.Map({
                            target: 'map',
                            layers: [
                                new ol.layer.Tile({
                                    source: new ol.source.OSM()
                                }),
                                vectorLayer
                            ],
                            view: new ol.View({
                                center: wewak,
                                zoom: 12
                            })
                        });
                    </script>

                </div>
                <div class="card-footer p-2">
                    <small class=" float-left"><b>Update:</b> <?= datetimeforms($pro['create_at']) ?></small>
                    <small class=" float-right"><b>By:</b> <?= ($pro['create_by']) ?></small>
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