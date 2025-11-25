<?= $this->extend("templates/nolstemp"); ?>
<?= $this->section('content'); ?>

<section class=" container-fluid">
    <div class="row p-2">
        <div class=" col-12">

            <div class="card">

                <div class="card-body">
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css" type="text/css"> -->
                    <!-- OpenLayers CSS -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css" type="text/css"> -->

                    <!-- OpenLayers CSS -->
                    <link rel="stylesheet" href="https://openlayers.org/en/v6.4.3/css/ol.css" />
                    <!-- OpenLayers JS -->
                    <script src="https://openlayers.org/en/v6.4.3/build/ol.js"></script>

                    <div id="map" style="height: 520px"></div>
                    <script type="text/javascript">
                        // Define an array of GPS point coordinates with random titles
                        const gpsPoints = [
                            <?php foreach ($pro as $pt) : ?> {
                                    title: "<?= $pt['name'] ?>",
                                    lat: <?= $pt['lat'] ?>,
                                    lng: <?= $pt['lon'] ?>,
                                    icon: "https://img.icons8.com/ultraviolet/40/000000/marker.png"
                                },
                            <?php endforeach; ?>

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
                                center: ol.proj.fromLonLat([143.201035, -4.198582]),
                                zoom: 8.5
                            })
                        });

                        // Create a vector source for the GPS point features
                        const gpsVectorSource = new ol.source.Vector();

                        // Create a vector layer for the GPS point features
                        const gpsVectorLayer = new ol.layer.Vector({
                            source: gpsVectorSource,
                            style: new ol.style.Style({
                                image: new ol.style.Icon({
                                    anchor: [0.5, 1],
                                    src: "https://img.icons8.com/ultraviolet/40/000000/marker.png"
                                })
                            })
                        });

                        // Add the GPS vector layer to the map
                        map.addLayer(gpsVectorLayer);

                        // Add the GPS points to the GPS vector source
                        gpsPoints.forEach(point => {
                            const feature = new ol.Feature({
                                geometry: new ol.geom.Point(ol.proj.fromLonLat([point.lng, point.lat])),
                            });

                            // Set the feature's title property
                            feature.set("title", point.title);

                            // Set the feature's icon property
                            feature.setStyle(new ol.style.Style({
                                image: new ol.style.Icon({
                                    anchor: [0.5, 1],
                                    src: point.icon
                                })
                            }));

                            gpsVectorSource.addFeature(feature);
                        });

                        // Create a popup overlay
                        const popup = new ol.Overlay.Popup();

                        // Add a click event listener to the GPS vector layer
                        gpsVectorLayer.on("click", function(evt) {
                            const feature = evt.feature;
                            const title = feature.get("title");
                            const coordinate = evt.coordinate;
                            const content = `<p>${title}</p>`;
                            popup.show(coordinate, content);
                        });

                        // Add the popup overlay to the map
                        map.addOverlay(popup);
                    </script>

                    <script>
                        // Array of KML files
                        var kmlFiles = [
                            <?php foreach ($pro as $pr) : ?> "<?= $pr['kmlfile'] ?>",
                            <?php endforeach; ?>
                        ];

                        // Array of sources
                        var vectorSources = [];

                        // Iterate through the KML files and create a source for each one
                        kmlFiles.forEach(function(kmlFile) {
                            var vectorSource = new ol.source.Vector({
                                url: kmlFile,
                                format: new ol.format.KML({
                                    extractStyles: false,
                                    extractAttributes: true,
                                    defaultStyle: null,
                                    defaultAttributes: null
                                })
                            });

                            vectorSources.push(vectorSource);
                        });

                        var trackStyle = new ol.style.Style({
                            stroke: new ol.style.Stroke({
                                color: 'red',
                                width: 2
                            })
                        });

                        // Create a vector layer and add all the sources to it
                        var vectorLayer = new ol.layer.Vector({
                            source: new ol.source.Vector({
                                features: []
                            }),
                            style: function(feature) {
                                if (feature.getGeometry().getType() === 'LineString') {
                                    return trackStyle;
                                }
                            }
                        });

                        vectorSources.forEach(function(vectorSource) {
                            vectorSource.forEachFeature(function(feature) {
                                vectorLayer.getSource().addFeature(feature);
                            });
                        });

                        map.addLayer(vectorLayer);
                    </script>


                </div>
            </div>
        </div>
    </div>
</section>


</body>


<?= $this->endSection() ?>