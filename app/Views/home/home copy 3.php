<?= $this->extend("templates/nolstemp"); ?>
<?= $this->section('content'); ?>

<section class=" container-fluid">

    <div class="row mt-1">
        <div class="col-12">
            <div class="card card-success card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link text-bold active " id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Projects Map <i class="fas fa-map-marked" aria-hidden="true"></i> </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-bold" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false">Projects List <i class="fas fa-list" aria-hidden="true"></i> </a>
                        </li>

                       <!--  <li class="nav-item">
                            <a class="nav-link text-bold" id="custom-tabs-one-events-tab" data-toggle="pill" href="#custom-tabs-one-events" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="true">Project Search <i class="fa fa-search" aria-hidden="true"></i> </a>
                        </li> -->

                    </ul>
                </div>
                <div class="card-body p-0">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active " id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">

                                        <div class="card-body p-0 ">
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css" type="text/css">
                                            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script> <!-- Update Bootstrap JS -->
                                            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script> <!-- Update Bootstrap JS -->

                                            <style>
                                                #map {
                                                    height: 700px;
                                                    width: 100%;
                                                }
                                            </style>
                                            <div id="map"></div>
                                            <div id="popup" style="display:none;"></div> <!-- Add this line -->
                                            <script>
                                                var vectorSources = [
                                                    new ol.source.Vector({
                                                        url: '<?= base_url() ?>public/uploads/gps_files/kmlwwkto.kml',
                                                        format: new ol.format.KML({
                                                            extractStyles: false,
                                                            extractAttributes: true
                                                        }),
                                                        strategy: ol.loadingstrategy.bbox // Only load visible features
                                                    }),
                                                    new ol.source.Vector({
                                                        url: 'kmlwwk.kml',
                                                        format: new ol.format.KML({
                                                            extractStyles: false,
                                                            extractAttributes: true
                                                        }),
                                                        strategy: ol.loadingstrategy.bbox // Only load visible features
                                                    }),
                                                    new ol.source.Vector({
                                                        url: 'kmlwwkto.kml',
                                                        format: new ol.format.KML({
                                                            extractStyles: false,
                                                            extractAttributes: true
                                                        }),
                                                        strategy: ol.loadingstrategy.bbox // Only load visible features
                                                    }),
                                                    new ol.source.Vector({
                                                        url: 'kmlsda.kml',
                                                        format: new ol.format.KML({
                                                            extractStyles: false,
                                                            extractAttributes: true
                                                        }),
                                                        strategy: ol.loadingstrategy.bbox // Only load visible features
                                                    }),
                                                    // add more VectorSource objects as needed
                                                ];
                                                var vectorLayers = [];
                                                for (var i = 0; i < vectorSources.length; i++) {
                                                    var layer = new ol.layer.Vector({
                                                        source: vectorSources[i],
                                                        style: function(feature) {
                                                            // Only display tracks
                                                            if (feature.getGeometry().getType() === 'LineString') {
                                                                return new ol.style.Style({
                                                                    stroke: new ol.style.Stroke({
                                                                        color: 'red',
                                                                        width: 2
                                                                    })
                                                                });
                                                            }
                                                        }
                                                    });
                                                    vectorLayers.push(layer);
                                                }
                                                var marker1 = new ol.Feature({
                                                    geometry: new ol.geom.Point(ol.proj.fromLonLat([143.576287, -3.553425])),
                                                    name: 'Marker 1',
                                                    description: 'This is the first marker',
                                                    url: 'https://govhrm.wanspeen.com',
                                                    link: 'View'
                                                });
                                                var marker2 = new ol.Feature({
                                                    geometry: new ol.geom.Point(ol.proj.fromLonLat([143.695600, -3.563359])),
                                                    name: 'Marker 2',
                                                    description: 'This is the second marker',
                                                    url: 'https://example.com',
                                                    link: 'More...'
                                                });
                                                var marker3 = new ol.Feature({
                                                    geometry: new ol.geom.Point(ol.proj.fromLonLat([143.634997, -3.604654])),
                                                    name: 'Marker 3',
                                                    description: 'This is the third marker',
                                                    url: 'https://www.dakoiims.com',
                                                    link: 'View'
                                                });
                                                var vectorPoints = new ol.source.Vector({
                                                    features: [marker1, marker2, marker3]
                                                });
                                                var vectorPointsLayer = new ol.layer.Vector({
                                                    source: vectorPoints,
                                                    style: new ol.style.Style({
                                                        image: new ol.style.Icon({
                                                            src: '<?= base_url() ?>public/assets/system_img/marker-map.png',
                                                            // size:[20,20]
                                                        })
                                                    })
                                                });
                                                var map = new ol.Map({
                                                    layers: [
                                                        new ol.layer.Tile({
                                                            source: new ol.source.OSM()
                                                        }),
                                                        // add all VectorLayer objects to the layers array
                                                        ...vectorLayers,
                                                        vectorPointsLayer
                                                    ],
                                                    target: 'map',
                                                    view: new ol.View({
                                                        center: ol.proj.fromLonLat([143.627099, -3.551542]),
                                                        zoom: 9
                                                    })
                                                });
                                                var element = document.getElementById('popup');
                                                var popup = new ol.Overlay({
                                                    element: element,
                                                    positioning: 'bottom-center',
                                                    stopEvent: false,
                                                    offset: [0, -20]
                                                });
                                                map.addOverlay(popup);
                                                // display popup on click
                                                map.on('click', function(evt) {
                                                    var feature = map.forEachFeatureAtPixel(evt.pixel,
                                                        function(feature) {
                                                            return feature;
                                                        });
                                                    if (feature) {
                                                        var coordinates = feature.getGeometry().getCoordinates();
                                                        popup.setPosition(coordinates);
                                                        $(element).show(); // Move this line up
                                                        $(element).popover({
                                                            placement: 'top',
                                                            html: true,
                                                            content: feature.get('name') + '<br>' + feature.get('description') + '<br><a href="' + feature.get('url') + '">' + feature.get('link') + '</a>'
                                                        });
                                                        $(element).popover('show');
                                                    } else {
                                                        $(element).popover('dispose');
                                                        $(element).hide(); // Add this line
                                                    }
                                                });
                                                // change mouse cursor when over marker
                                                map.on('pointermove', function(e) {
                                                    if (e.dragging) {
                                                        $(element).popover('dispose');
                                                        $(element).hide(); // Add this line
                                                        return;
                                                    }
                                                    var pixel = map.getEventPixel(e.originalEvent);
                                                    var hit = map.hasFeatureAtPixel(pixel);
                                                    document.getElementById('map').style.cursor = hit ? 'pointer' : '';
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./row -->
                        </div>

                        <div class="tab-pane fade table-responsive-md" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table class="table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Code</th>
                                                <th>Project</th>
                                                <th>T.Payments</th>
                                                <th>Milestones</th>
                                                <th>Contractor</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $count = 1;
                                            foreach ($pro as $p) : ?>
                                                <tr onclick="window.location='<?= base_url() ?>home_project_one_view/<?= $p['ucode'] ?>' " >
                                                    <td><?= $count++ ?></td>
                                                    <td><?= $p['procode'] ?></td>
                                                    <td><?= $p['name'] ?></td>

                                                    <?php $amount = array();
                                                    foreach ($payments as $pay) {
                                                        if ($pay['procode'] == $p['procode']) {
                                                            $amount[] = $pay['amount'];
                                                        }
                                                    } ?>

                                                    <td><?= number_format(array_sum($amount), 2) ?>
                                                        <?php
                                                            if (array_sum($amount) != 0) {
                                                                echo "( ". round(number_format((array_sum($amount) / ($p['budget'])) * 100,0),2) . "% )";
                                                            } 
                                                            ?>
                                                    </td>

                                                    <?php $allmiles = $compmiles = array();
                                                    foreach ($milestones as $ms) {
                                                        if ($ms['procode'] == $p['procode']) {
                                                            $allmiles[] = $ms['milestones'];

                                                            if ($ms['checked'] == 'completed') {
                                                                $compmiles[] = $ms['milestones'];
                                                            }
                                                        }
                                                    } ?>

                                                    <td>
                                                        <?php
                                                        if (count($allmiles) != 0) {
                                                            echo round((count($compmiles) / count($allmiles)) * 100,2) . "%";
                                                        } else {
                                                            echo 0;
                                                        }

                                                        ?>
                                                    </td>
                                                    <td><?= $p['contractor_name'] ?></td>
                                                    <td><?= $p['status'] ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- ./row timeline -->
                        <!-- <div class="tab-pane fade " id="custom-tabs-one-events" role="tabpanel" aria-labelledby="custom-tabs-one-events-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    This is tab Sero
                                </div>
                            </div>
                        </div> -->
                        <!-- ./tab -->
                    </div>

                </div>
            </div>
            <!-- /.card -->
















        </div>
    </div>

    <div class="row p-2">
        <div class=" col-12">


        </div>
    </div>
</section>


</body>


<?= $this->endSection() ?>