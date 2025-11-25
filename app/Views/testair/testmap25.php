<?= $this->extend("templates/testairtemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid p-2">
        <div class="row d-flex justify-content-center p-lg-5">
            <div class="col-md-12 ">

                <div class="card shadow-lg rounded-top-5 ">
                    <div class="card-header text-center">
                        Display KML Data with Features with Set Center point and Custom Zoom
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
                            // Define the KML file URL
                            const kmlUrl = "<?= $kml['filepath'] ?>";

                            // Define an array of GPS point coordinates
                            const gpsPoints = [{
                                    lat: -3.591015,
                                    lng: 143.654830
                                },
                                {
                                    lat: -3.606230,
                                    lng: 143.621853
                                },
                                {
                                    lat: -3.589732,
                                    lng: 143.641978
                                },
                                {
                                    lat: -3.592386,
                                    lng: 143.633297
                                },
                                {
                                    lat: -3.590567,
                                    lng: 143.645126
                                }
                            ];

                            // Create a new OpenLayers map instance
                            const map = new ol.Map({
                                target: "map",
                                layers: [
                                    new ol.layer.Tile({
                                        source: new ol.source.OSM()
                                    })
                                ],
                                view: new ol.View({
                                    center: ol.proj.fromLonLat([143.645126, -3.591015]),
                                    zoom: 10
                                })
                            });

                            // Create a new KML format parser
                            const kmlFormat = new ol.format.KML();

                            // Fetch the KML file
                            fetch(kmlUrl)
                                .then(response => response.text())
                                .then(kml => {
                                    // Parse the KML to a feature collection
                                    const features = kmlFormat.readFeatures(kml);

                                    // Create a vector source for the KML features
                                    const kmlVectorSource = new ol.source.Vector({
                                        features: features
                                    });

                                    // Create a vector layer for the KML features
                                    const kmlVectorLayer = new ol.layer.Vector({
                                        source: kmlVectorSource
                                    });

                                    // Add the KML vector layer to the map
                                    map.addLayer(kmlVectorLayer);
                                })
                                .catch(error => console.error(error));

                            // Create a vector source for the GPS point features
                            const gpsVectorSource = new ol.source.Vector();

                            // Create a vector layer for the GPS point features
                            const gpsVectorLayer = new ol.layer.Vector({
                                source: gpsVectorSource,
                                style: new ol.style.Style({
                                    image: new ol.style.Circle({
                                        radius: 6,
                                        fill: new ol.style.Fill({
                                            color: "blue"
                                        })
                                    })
                                })
                            });

                            // Add the GPS vector layer to the map
                            map.addLayer(gpsVectorLayer);

                            // Add the GPS points to the GPS vector source
                            gpsPoints.forEach(point => {
                                const feature = new ol.Feature({
                                    geometry: new ol.geom.Point(ol.proj.fromLonLat([point.lng, point.lat]))
                                });
                                gpsVectorSource.addFeature(feature);
                            });
                        </script>
                        
                        
                        <br>
                    <br>
                    <br>
                    <br>    
                        
                        
                    
                    <script type="text/javascript">
                            /* var map = new ol.Map({
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
                            }); */

                            var vectorSource = new ol.source.Vector({
                                url: "<?= $kml['filepath'] ?>",
                                format: new ol.format.KML()
                            });

                            var vectorLayer = new ol.layer.Vector({
                                source: vectorSource,
                                style: new ol.style.Style({
                                    stroke: new ol.style.Stroke({
                                        color: 'red',
                                        width: 5
                                    })
                                })
                            });

                           
                            map.addLayer(vectorLayer);
                        </script>

                    
                    
                        

                    </div>

                    




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