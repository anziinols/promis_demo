<?= $this->extend("templates/nolstemp"); ?>
<?= $this->section('content'); ?>

<section class="container-fluid">

    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-map-marked-alt me-2"></i>Projects Map
                    </h5>
                </div>
                <div class="card-body p-3">
                    <!-- Include Leaflet CSS -->
                    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="" />
                    <!-- Include Leaflet.KML plugin -->
                    <script src="https://unpkg.com/leaflet-omnivore/leaflet-omnivore.min.js"></script>
                    
                    <style>
                        #map {
                            height: 700px;
                            border-radius: 0.5rem;
                            box-shadow: var(--card-shadow);
                        }
                        /* Custom dot marker style */
                        .project-marker {
                            border-radius: 50%;
                            cursor: pointer;
                        }
                        .project-marker:hover {
                            opacity: 0.8;
                        }
                    </style>

                    <!-- Map container with shadow and rounded corners -->
                    <div id="map" class="mb-3"></div>

                    <!-- Include Leaflet JavaScript -->
                    <script src="https://unpkg.com/leaflet/dist/leaflet.js" crossorigin=""></script>

                    <!-- Initialize Leaflet map -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            // Initialize Leaflet map
                            const map = L.map('map').setView([-5.583301, 147.152774], 6.5); // Default center

                            // Add OpenStreetMap tile layer with improved styling
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                                maxZoom: 19
                            }).addTo(map);

                            // Create a feature group to hold all layers for bounds calculation
                            const allLayers = L.featureGroup().addTo(map);
                            let kmlLayersToLoad = 0;
                            let kmlLayersLoaded = 0;

                            // Function to fit map bounds after all layers are loaded
                            function fitMapBounds() {
                                if (allLayers.getLayers().length > 0) {
                                    map.fitBounds(allLayers.getBounds(), {
                                        padding: [50, 50],  // Add padding around the bounds
                                        maxZoom: 15         // Don't zoom in too close
                                    });
                                }
                            }

                            // Function to get color based on project status
                            function getStatusColor(status) {
                                switch(status ? status.toLowerCase() : '') {
                                    case 'active':
                                        return '#28a745'; // Green
                                    case 'completed':
                                        return '#007bff'; // Blue
                                    case 'hold':
                                        return '#ffc107'; // Yellow/Amber
                                    case 'canceled':
                                        return '#6c757d'; // Gray
                                    default:
                                        return '#6c757d'; // Gray (default)
                                }
                            }

                            // Function to add KML layers with improved styling and popup
                            function addKMLLayer(kmlURL, project) {
                                kmlLayersToLoad++;
                                const statusColor = getStatusColor(project.status);
                                const kmlLayer = omnivore.kml(kmlURL, null, L.geoJSON(null, {
                                    style: {
                                        color: statusColor,
                                        weight: 3,
                                        opacity: 0.7,
                                        fillOpacity: 0.4
                                    },
                                    onEachFeature: function(feature, layer) {
                                        // Bind popup to each KML feature
                                        layer.bindPopup(`
                                            <div style="min-width: 200px;">
                                                <h6 class="mb-2"><strong>${project.name}</strong></h6>
                                                <p class="mb-1"><strong>Code:</strong> ${project.procode}</p>
                                                <p class="mb-1"><small class="text-muted">KML Path/Boundary</small></p>
                                                <a href="<?= base_url() ?>home_project_one_view/${project.ucode}" class="btn btn-sm btn-primary mt-2">
                                                    <i class="fas fa-eye"></i> View Details
                                                </a>
                                            </div>
                                        `);
                                        
                                        // Add hover effect for KML paths
                                        layer.on('mouseover', function() {
                                            this.setStyle({
                                                weight: 5,
                                                opacity: 1
                                            });
                                        });
                                        
                                        layer.on('mouseout', function() {
                                            this.setStyle({
                                                weight: 3,
                                                opacity: 0.7
                                            });
                                        });
                                    }
                                }))
                                .on('ready', function() {
                                    allLayers.addLayer(kmlLayer);
                                    kmlLayersLoaded++;
                                    // When all KML layers are loaded, fit bounds
                                    if (kmlLayersLoaded === kmlLayersToLoad) {
                                        fitMapBounds();
                                    }
                                })
                                .on('error', function() {
                                    kmlLayersLoaded++;
                                    // Continue even if a KML fails to load
                                    if (kmlLayersLoaded === kmlLayersToLoad) {
                                        fitMapBounds();
                                    }
                                })
                                .addTo(map);
                            }

                            // Function to add coordinates markers with dot style and popup
                            function addMarkers(projects) {
                                projects.forEach(project => {
                                    if (project.lat && project.lon) {
                                        // Get color based on project status
                                        const statusColor = getStatusColor(project.status);

                                        // Create a circle marker (dot)
                                        const marker = L.circleMarker([project.lat, project.lon], {
                                            radius: 8,               // Size of the dot
                                            fillColor: statusColor,  // Status-based fill color
                                            color: statusColor,      // Border same as fill
                                            weight: 1,               // Minimal border
                                            opacity: 1,
                                            fillOpacity: 1,
                                            className: 'project-marker'
                                        }).addTo(map);

                                        // Add marker to feature group for bounds calculation
                                        allLayers.addLayer(marker);

                                        // Add popup with project information
                                        marker.bindPopup(`
                                            <div style="min-width: 200px;">
                                                <h6 class="mb-2"><strong>${project.name}</strong></h6>
                                                <p class="mb-1"><strong>Code:</strong> ${project.procode}</p>
                                                <a href="<?= base_url() ?>home_project_one_view/${project.ucode}" class="btn btn-sm btn-primary mt-2">
                                                    <i class="fas fa-eye"></i> View Details
                                                </a>
                                            </div>
                                        `);
                                    }
                                });
                            }

                            // Projects data
                            const projects = [
                                <?php foreach ($pro as $p) : ?>
                                {
                                    ucode: '<?= $p['ucode'] ?>',
                                    procode: '<?= $p['procode'] ?>',
                                    name: '<?= addslashes($p['name']) ?>',
                                    lat: <?= !empty($p['lat']) ? $p['lat'] : 'null' ?>,
                                    lon: <?= !empty($p['lon']) ? $p['lon'] : 'null' ?>,
                                    kmlfile: '<?= $p['kmlfile'] ?>',
                                    status: '<?= $p['status'] ?? '' ?>'
                                },
                                <?php endforeach ?>
                            ];

                            // Add markers first
                            addMarkers(projects);

                            // Add KML files with project information
                            projects.forEach(project => {
                                if (project.kmlfile) {
                                    addKMLLayer('<?= base_url() ?>' + project.kmlfile, project);
                                }
                            });

                            // If no KML files, fit bounds immediately
                            if (kmlLayersToLoad === 0) {
                                fitMapBounds();
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

</section>

<?= $this->endSection() ?>