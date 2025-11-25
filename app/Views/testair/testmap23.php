<?= $this->extend("templates/testairtemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid p-2">
        <div class="row d-flex justify-content-center p-lg-5">
            <div class="col-md-12 ">

                <div class="card shadow-lg rounded-top-5 ">
                    <div class="card-header text-center">
                        Display signle KML data with features
                    </div>
                    <div class="card-body">

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css" type="text/css"> -->

                        <!-- OpenLayers CSS -->
                        <link rel="stylesheet" href="https://openlayers.org/en/v6.4.3/css/ol.css" />

                        <!-- OpenLayers JS -->
                        <script src="https://openlayers.org/en/v6.4.3/build/ol.js"></script>

                        <div id="map" style="height: 500px"></div>
                        <script type="text/javascript">
                            var map = new ol.Map({
                                target: "map",
                                layers: [
                                    new ol.layer.Tile({
                                        source: new ol.source.OSM(),
                                    }),
                                ],
                                view: new ol.View({
                                    center: ol.proj.fromLonLat([0, 0]),
                                    zoom: 2,
                                }),
                            });

                            var vectorSource = new ol.source.Vector({
                                url: "<?= $kml['filepath'] ?>",
                                format: new ol.format.KML(),
                            });

                            var vectorLayer = new ol.layer.Vector({
                                source: vectorSource,
                                style: new ol.style.Style({
                                    stroke: new ol.style.Stroke({
                                        color: "red",
                                        width: 5,
                                    }),
                                }),
                            });

                            vectorSource.once("change", function() {
                                if (vectorSource.getState() == "ready") {
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

                    </div>

                    <br>
                    <br>
                    <br>
                    <br>




                    <div class="card-footer text-center">
                        <?= base_url() . "ajax" ?>

                        <small>Org.Calendar Administrators Login</small>

                    </div>
                </div>

            </div>

        </div>
    </div>

</body>




</html>
<?= $this->endSection() ?>