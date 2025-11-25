<?= $this->extend("templates/testairtemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid p-2">
        <div class="row d-flex justify-content-center p-lg-5">
            <div class="col-md-12 ">

                <div class="card shadow-lg rounded-top-5 ">
                    <div class="card-header text-center">
                        TestPlanet
                    </div>
                    <div class="card-body">

                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.20.1/ol.css" type="text/css">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/ol3/3.20.1/ol.js"></script>

                        <div id="map" style="height: 100vh;"></div>

                        <script>
                            var kmlUrl = "<?= $kmlurl ?>";
                            var kmlFeatures = new ol.Collection();
                            var map;

                            // create the map
                            map = new ol.Map({
                                target: 'map',
                                layers: [
                                    new ol.layer.Tile({
                                        source: new ol.source.OSM()
                                    })
                                ],
                                view: new ol.View({
                                    center: ol.proj.fromLonLat([0, 0]),
                                    //center: ol.proj.fromLonLat([]),
                                    zoom: 5
                                })
                            });

                            // load the KML file and get the features
                            var vector = new ol.layer.Vector({
                                source: new ol.source.Vector({
                                    url: kmlUrl,
                                    format: new ol.format.KML({
                                        extractStyles: false
                                    }),
                                    projection: 'EPSG:3857'
                                })
                            });

                            vector.getSource().on('addfeature', function(event) {
                                kmlFeatures.push(event.feature);
                            });

                            map.addLayer(vector);

                            // set the center of the map to the first coordinate in the KML file
                            var centerCoord = kmlFeatures.getArray()[0].getGeometry().getCoordinates();
                            map.getView().setCenter(centerCoord);
                          

                            // set the zoom level to fit all features in the map
                            var extent = ol.extent.createEmpty();
                            kmlFeatures.forEach(function(feature) {
                                ol.extent.extend(extent, feature.getGeometry().getExtent());
                            });
                            map.getView().fit(extent, {
                                padding: [20, 20, 20, 20],
                                minResolution: 10
                            });
                        </script>


                    </div>
                    <div class="card-footer text-center">
                        <?= base_url() . "ajax" ?>
                        
                        <small>Org.Calendar Administrators Login</small>
                        <?php print_r($coordinates) ?>
                    </div>
                </div>

            </div>

        </div>
    </div>

</body>




</html>
<?= $this->endSection() ?>