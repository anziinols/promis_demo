<?= $this->extend("templates/testairtemp"); ?>
<?= $this->section('content'); ?>

<body>
  <div class="container-fluid p-2">
    <div class="row d-flex justify-content-center p-lg-5">
      <div class="col-md-12 ">

        <div class="card shadow-lg rounded-top-5 ">
          <div class="card-header text-center">
            Display Single KML Data with features and Other GPS Points on and zoomed out Map of
            East Sepik Province
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
              /* // Define an array of GPS point coordinates
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
                            ]; */

              // Define an array of GPS point coordinates with random titles
              const gpsPoints = [{
                  title: "Point A",
                  lat: -3.591015,
                  lng: 143.654830,
                  icon: "https://img.icons8.com/ultraviolet/40/000000/marker.png"
                },
                {
                  title: "Point B",
                  lat: -3.606230,
                  lng: 143.621853,
                  icon: "https://img.icons8.com/ultraviolet/40/000000/marker.png"
                },
                {
                  title: "Point C",
                  lat: -3.589732,
                  lng: 143.641978,
                  icon: "https://img.icons8.com/ultraviolet/40/000000/marker.png"
                },
                {
                  title: "Point D",
                  lat: -3.592386,
                  lng: 143.633297,
                  icon: "https://img.icons8.com/ultraviolet/40/000000/marker.png"
                },
                {
                  title: "Point E",
                  lat: -3.590567,
                  lng: 143.645126,
                  icon: "https://img.icons8.com/ultraviolet/40/000000/marker.png"
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

              /*  var vectorSource = new ol.source.Vector({
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

               
               map.addLayer(vectorLayer); */
            </script>


            <script>
              var vectorSource = new ol.source.Vector({
                url: "<?= $kml['filepath'] ?>",
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

              /* vectorSource.once('change', function() {
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
              }); */

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