<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<!-- Your custom script -->


<section class="container-fluid d-print-none ">
    <div class="row p-1">
        <div class="col-12 d-flex justify-content-between">

            <h4><?= $pro['procode'] . ": " . $pro['name'] ?></h4>

            <nav class="breadcrumb">


                <a class="breadcrumb-item" href="<?= base_url() ?>po_open_project/<?= $pro['ucode'] ?>"> <i class="bi bi-chevron-left"></i> Go Back</a>
                <!-- <a class="breadcrumb-item" href="#"></a> -->
                <span class="breadcrumb-item active"><?= $pro['procode'] ?></span>
            </nav>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <span class="lead">Project Details</span>
        </div>
    </div>
</section>

<section class=" container-fluid content">
    <div class="row mt-2 mb-2">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Information

                   <!--  <a href="<?= base_url(); ?>po_details_info_edit/<?= $pro['ucode'] ?>" class="btn btn-flat float-right"> <i class=" d-print-none  fas fa-edit"></i> </a> -->

                </div>
                <div class="card-body p-0">
                    <ul class="list-group border-0">
                        <!--tips: add .list-group-flush to the .list-group to remove some borders and rounded corners-->

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Code:</b>
                            <span class=""><?= $pro['procode'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Name:</b>
                            <span class=""><?= $pro['name'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Description:</b>
                            <span class=""><?= $pro['description'] ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Loc.Address:</b>
                            <span class=""><?= $country['name'] ?>, <?= $province['name'] ?>, <?= $dist['name'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Loc.GPS:</b>
                            <span class=""><b>Lat:</b> <?= $pro['lat'] ?> <b>Lon:</b> <?= $pro['lon'] ?></span>
                        </li>

                    </ul>
                </div>
                <div class="card-footer">
                    <em>Created:

                        <span class=" float-right"> <?= datetimeforms($pro['create_at']) ?> / <?= $pro['create_by'] ?></span>
                    </em>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Details
                    <!-- <span class=" btn btn-flat d-print-none float-right"> <i class="fas fa-info-circle"></i></span> -->
                </div>
                <div class="card-body p-0">
                    <ul class="list-group border-0">
                        <!--tips: add .list-group-flush to the .list-group to remove some borders and rounded corners-->

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Budget:</b>
                            <span class=""><?= COUNTRY_CURRENCY ?> <?= number_format($pro['budget'], 2) ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Officer:</b>
                            <span class=""><?= $pro['pro_officer_name'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Contractor:</b>
                            <span class=""><?= $pro['contractor_name'] ?></span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Status:</b>
                            <span class=""><?= $pro['status'] ?></span>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <b>Pro.Status Notes:</b>
                            <span class=""><?= $pro['statusnotes'] ?></span>
                        </li>

                    </ul>
                </div>
                <div class="card-footer">
                    <em>Last Update:

                        <span class=" float-right"> <?= datetimeforms($pro['update_at']) ?> / <?= $pro['update_by'] ?></span>
                    </em>
                </div>
            </div>
            <!-- /. card -->
        </div>
        <!-- ./col -->
    </div>
    <!-- ./row -->
    <div class="row mt-2 mb-2">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Map
                    <!-- Button trigger modal -->
                    <span class=" d-print-none btn btn-flat float-right" data-toggle="modal" data-target="#setgps">
                        <i class=" fas fa-edit"></i>
                    </span>
                    <!-- Modal -->
                    <div class="modal fade" id="setgps" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h5 class="modal-title"> <i class="fas fa-map-marked-alt    "></i> GPS Coordinates</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body text-dark">

                                    <?= form_open_multipart('gps_set', ['id' => 'gps_setForm']) ?>

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


                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                    <input type="hidden" name="proucode" value="<?= $pro['ucode'] ?>">
                                    <input type="hidden" name="proid" value="<?= $pro['id'] ?>">
                                    <button type="button" class="btn btn-primary float-right" id="btn_savegps">
                                        <i class="fa fa-save" aria-hidden="true"></i> Save
                                    </button>

                                </div>
                                <?= form_close() ?>
                                <script>
                                    $(document).ready(function() {

                                        // Add keypress event listener to the form input fields
                                        $('#gps_setForm input').keypress(function(e) {
                                            if (e.which == 13) {
                                                e.preventDefault(); // Prevent the default form submission
                                                $('#btn_savegps').click(); // Trigger the AJAX function
                                            }
                                        });


                                        $('#btn_savegps').on('click', function() {

                                            //alert("Hello");

                                            // Create FormData object to store form data and files
                                            var formData = new FormData($('#gps_setForm')[0]);

                                            // Send an AJAX request
                                            $.ajax({
                                                url: "<?= base_url('gps_set'); ?>", // Update this with your controller method
                                                type: 'POST',
                                                data: formData,
                                                contentType: false,
                                                processData: false,
                                                beforeSend: function() {
                                                    // Display a loading indicator
                                                    $('#btn_savegps').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Uploading...');
                                                },
                                                success: function(response) {
                                                    // Handle the success response
                                                    console.log(response);

                                                    // Optionally, display a success message to the user
                                                    if (response.status === 'success') {
                                                        // Display a success message to the user
                                                        toastr.success(response.message);

                                                        // Reload page after 1 second
                                                        setTimeout(function() {
                                                            location.reload();
                                                        }, 1000);
                                                    } else {
                                                        // Display an error message to the user
                                                        toastr.error(response.message);

                                                        // Reload page after 1 second
                                                        setTimeout(function() {
                                                            location.reload();
                                                        }, 2000);
                                                    }

                                                },
                                                error: function(error) {
                                                    // Handle the error response
                                                    console.log(error.responseText);

                                                    // Optionally, display an error message to the user
                                                    toastr.error(response.message);
                                                }
                                            });
                                        });
                                    });
                                </script>


                            </div>
                        </div>
                    </div>
                    <!-- ./modal -->

                    <!-- =============================================================================== -->
                </div>
                <div class="card-body">
                    <!-- Map Styles -->
                    <style>
                        #map {
                            width: 100%;
                            height: 600px;
                            position: relative;
                        }
                    </style>

                    <!-- OpenLayers Library -->
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.js"></script>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/openlayers/4.6.5/ol.css" type="text/css">

                    <div id="map"></div>

                    <!-- Map Initialization Script -->
                    <script>
                        $(document).ready(function() {
                            console.log('Initializing map for project: <?= $pro['procode'] ?>');

                            // Function to get color based on project status
                            function getStatusColor(status) {
                                switch(status ? status.toLowerCase() : '') {
                                    case 'active':
                                        return 'rgba(40, 167, 69, 0.8)'; // Green
                                    case 'completed':
                                        return 'rgba(0, 123, 255, 0.8)'; // Blue
                                    case 'hold':
                                        return 'rgba(255, 193, 7, 0.8)'; // Yellow
                                    case 'canceled':
                                        return 'rgba(108, 117, 125, 0.8)'; // Gray
                                    default:
                                        return 'rgba(108, 117, 125, 0.8)'; // Default Gray
                                }
                            }

                            // Get project status and color
                            var projectStatus = '<?= strtolower($pro['status'] ?? '') ?>';
                            var statusColor = getStatusColor(projectStatus);
                            console.log('Project status: ' + projectStatus + ', Color: ' + statusColor);

                            // Create vector sources for all KML files
                            var vectorSources = [];
                            <?php if (!empty($kmls)): ?>
                                <?php foreach ($kmls as $kml): ?>
                                    <?php if (!empty($kml['filepath'])): ?>
                                        console.log('Loading KML: <?= base_url() . $kml['filepath'] ?>');
                                        vectorSources.push(
                                            new ol.source.Vector({
                                                url: "<?= base_url() . $kml['filepath'] ?>",
                                                format: new ol.format.KML({
                                                    extractStyles: false,
                                                    extractAttributes: true,
                                                }),
                                                strategy: ol.loadingstrategy.bbox,
                                            })
                                        );
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>

                            // Create vector layers from sources with status-based styling
                            var vectorLayers = [];
                            for (var i = 0; i < vectorSources.length; i++) {
                                var layer = new ol.layer.Vector({
                                    source: vectorSources[i],
                                    style: function(feature) {
                                        var geometryType = feature.getGeometry().getType();

                                        // Style for LineString (tracks/paths) - use status color
                                        if (geometryType === "LineString" || geometryType === "MultiLineString") {
                                            return new ol.style.Style({
                                                stroke: new ol.style.Stroke({
                                                    color: statusColor,
                                                    width: 3,
                                                }),
                                            });
                                        }

                                        // Style for Polygon (areas) - use status color with transparency
                                        if (geometryType === "Polygon" || geometryType === "MultiPolygon") {
                                            return new ol.style.Style({
                                                stroke: new ol.style.Stroke({
                                                    color: statusColor,
                                                    width: 2,
                                                }),
                                                fill: new ol.style.Fill({
                                                    color: statusColor.replace('0.8', '0.2'), // More transparent fill
                                                }),
                                            });
                                        }
                                    },
                                });
                                vectorLayers.push(layer);
                            }

                            // Create GPS marker if coordinates are available
                            var markerFeatures = [];
                            <?php if (!empty($pro['lon']) && !empty($pro['lat']) && $pro['lon'] != 0 && $pro['lat'] != 0): ?>
                                console.log('Adding GPS marker at: <?= $pro['lon'] ?>, <?= $pro['lat'] ?>');
                                var marker = new ol.Feature({
                                    geometry: new ol.geom.Point(
                                        ol.proj.fromLonLat([<?= $pro['lon'] ?>, <?= $pro['lat'] ?>])
                                    ),
                                    name: "<?= addslashes($pro['name']) ?>",
                                    status: projectStatus,
                                    procode: "<?= $pro['procode'] ?>",
                                    budget: "<?= COUNTRY_CURRENCY . ' ' . number_format($pro['budget'], 2) ?>",
                                });
                                markerFeatures.push(marker);
                            <?php else: ?>
                                console.warn('No valid GPS coordinates found for project');
                            <?php endif; ?>

                            var vectorPoints = new ol.source.Vector({
                                features: markerFeatures,
                            });

                            // Create marker layer with colored dot based on status
                            var vectorPointsLayer = new ol.layer.Vector({
                                source: vectorPoints,
                                style: new ol.style.Style({
                                    image: new ol.style.Circle({
                                        radius: 10,
                                        fill: new ol.style.Fill({
                                            color: statusColor,
                                        }),
                                        stroke: new ol.style.Stroke({
                                            color: '#fff',
                                            width: 3,
                                        }),
                                    }),
                                }),
                            });

                            // Determine initial map center
                            var mapCenter = [147.152774, -5.583301]; // Default PNG center
                            var mapZoom = 6;

                            <?php if (!empty($pro['lon']) && !empty($pro['lat']) && $pro['lon'] != 0 && $pro['lat'] != 0): ?>
                                mapCenter = [<?= $pro['lon'] ?>, <?= $pro['lat'] ?>];
                                mapZoom = 14;
                            <?php endif; ?>

                            // Create map
                            var map = new ol.Map({
                                layers: [
                                    new ol.layer.Tile({
                                        source: new ol.source.OSM(),
                                    }),
                                    ...vectorLayers,
                                    vectorPointsLayer,
                                ],
                                target: "map",
                                view: new ol.View({
                                    center: ol.proj.fromLonLat(mapCenter),
                                    zoom: mapZoom,
                                }),
                            });

                            // Auto-zoom to fit all features (marker + KML polygons)
                            setTimeout(function() {
                                var extent = ol.extent.createEmpty();
                                var hasFeatures = false;

                                // Include marker extent
                                if (vectorPoints.getFeatures().length > 0) {
                                    ol.extent.extend(extent, vectorPoints.getExtent());
                                    hasFeatures = true;
                                    console.log('Marker extent added');
                                }

                                // Include all KML layer extents
                                vectorLayers.forEach(function(layer, index) {
                                    var source = layer.getSource();
                                    var features = source.getFeatures();
                                    if (features.length > 0) {
                                        ol.extent.extend(extent, source.getExtent());
                                        hasFeatures = true;
                                        console.log('KML layer ' + index + ' extent added, features: ' + features.length);
                                    }
                                });

                                // Fit map to combined extent with padding
                                if (hasFeatures && !ol.extent.isEmpty(extent)) {
                                    map.getView().fit(extent, {
                                        padding: [50, 50, 50, 50], // Add 50px padding on all sides
                                        duration: 1000, // Smooth animation (1 second)
                                        maxZoom: 16 // Don't zoom in too close
                                    });
                                    console.log('Map auto-zoomed to fit all features');
                                } else {
                                    console.warn('No features found for auto-zoom');
                                }
                            }, 1500); // Wait 1.5 seconds for KML files to load

                            // Add popup overlay for marker interaction
                            var popup = document.createElement('div');
                            popup.className = 'ol-popup';
                            popup.style.cssText = 'position: absolute; background-color: white; padding: 12px; border-radius: 8px; box-shadow: 0 3px 14px rgba(0,0,0,0.4); display: none; min-width: 200px; z-index: 1000;';
                            document.body.appendChild(popup);

                            var overlay = new ol.Overlay({
                                element: popup,
                                positioning: 'bottom-center',
                                stopEvent: false,
                                offset: [0, -15]
                            });
                            map.addOverlay(overlay);

                            // Show popup on marker click
                            map.on('click', function(evt) {
                                var feature = map.forEachFeatureAtPixel(evt.pixel, function(feature) {
                                    return feature;
                                });

                                if (feature && feature.get('name')) {
                                    var coordinates = feature.getGeometry().getCoordinates();
                                    popup.innerHTML = '<div style="font-size: 13px;">' +
                                                    '<strong style="color: #333;">Project:</strong> ' + feature.get('name') + '<br>' +
                                                    '<strong style="color: #333;">Code:</strong> ' + feature.get('procode') + '<br>' +
                                                    '<strong style="color: #333;">Status:</strong> <span style="color: ' + statusColor + '; font-weight: bold;">' + feature.get('status').toUpperCase() + '</span><br>' +
                                                    '<strong style="color: #333;">Budget:</strong> ' + feature.get('budget') +
                                                    '</div>';
                                    popup.style.display = 'block';
                                    overlay.setPosition(coordinates);
                                } else {
                                    popup.style.display = 'none';
                                }
                            });

                            // Change cursor on hover
                            map.on('pointermove', function(evt) {
                                var hit = map.hasFeatureAtPixel(evt.pixel);
                                map.getTargetElement().style.cursor = hit ? 'pointer' : '';
                            });

                            console.log('Map initialized successfully');
                            console.log('Total KML layers: ' + vectorLayers.length);
                            console.log('Total markers: ' + markerFeatures.length);
                            console.log('Marker color: ' + statusColor);
                        });
                    </script>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <?php foreach ($kmls as $kml) : ?>
                            <div class="col-md-2">
                                <div class="alert alert-secondary" role="alert">
                                    <a href="<?= base_url() ?><?= $kml['filepath'] ?>"> <i class="fa fa-download" aria-hidden="true"></i> (.kml) <b>Date: </b><?= datetimeforms($kml['create_at']) ?> / <b>By: </b> <?= $kml['create_by'] ?> </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                </div>

            </div>
            <!-- ./card -->

        </div>
        <!-- ./col -->
    </div>
    <!-- ./ row -->







</section>



<?= $this->endSection() ?>