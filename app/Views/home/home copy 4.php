<?= $this->extend("templates/nolstemp"); ?>
<?= $this->section('content'); ?>

<section class=" container-fluid">

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

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
                                            <!-- Include Leaflet CSS -->
                                            <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="" />
                                            <!-- Include Leaflet.awesome-markers CSS -->
                                            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.css" />

                                            <!-- Include Leaflet CSS -->
                                            <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="" />
                                            <!-- Include Leaflet.KML plugin -->
                                            <script src="https://unpkg.com/leaflet-omnivore/leaflet-omnivore.min.js"></script>
                                            <style>
                                                #map {
                                                    height: 700px;
                                                }
                                            </style>

                                            <!-- Map container -->
                                            <div id="map"></div>

                                            <!-- Include Leaflet JavaScript -->
                                            <script src="https://unpkg.com/leaflet/dist/leaflet.js" crossorigin=""></script>
                                            <!-- Include Leaflet.awesome-markers JavaScript -->
                                            <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.awesome-markers/2.0.2/leaflet.awesome-markers.min.js"></script>


                                            <!-- Initialize Leaflet map -->
                                            <script>
                                                // Initialize Leaflet map
                                                var map = L.map('map').setView([-5.583301, 147.152774], 6.5); // Center map and set zoom level

                                                // Add OpenStreetMap tile layer
                                                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                                                }).addTo(map);


                                                // Function to add KML layers
                                                function addKMLLayer(kmlURL) {
                                                    omnivore.kml(kmlURL, null, L.geoJSON(null, {
                                                        style: {
                                                            color: 'red' // Change the color to red
                                                        }
                                                    })).addTo(map);
                                                }

                                                // Function to add coordinates markers
                                                function addMarkers(coordinates) {
                                                    coordinates.forEach(coord => {
                                                        L.marker(coord).addTo(map);
                                                    });
                                                }
                                                
                                                

                                                // Example usage:
                                                <?php foreach ($pro as $p) : ?>
                                                    // Add KML files
                                                    addKMLLayer('<?= base_url() . $p['kmlfile']; ?>');
                                                <?php endforeach ?>
                                                // Add coordinates
                                                var coordinates = [
                                                    <?php foreach ($pro as $p) : ?>[<?= $p['gps'] ?>],
                                                    <?php endforeach ?>
                                                    // Add more coordinates as needed
                                                ];
                                                addMarkers(coordinates);
                                            </script>

                                        </div>
                                        <!-- ./card-body -->
                                    </div>
                                </div>
                            </div>
                            <!-- ./row -->
                        </div>

                        <div class="tab-pane fade table-responsive-md" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table class="table text-nowrap" id="projects_list">
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
                                                <tr onclick="window.location='<?= base_url() ?>home_project_one_view/<?= $p['ucode'] ?>' ">
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
                                                            echo "( " . round(number_format((array_sum($amount) / ($p['budget'])) * 100, 0), 2) . "% )";
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
                                                            echo round((count($compmiles) / count($allmiles)) * 100, 2) . "%";
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

                                    <!-- Include jQuery -->
                                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                    <!-- Include DataTables JavaScript -->
                                    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
                                    <script>
                                        $(document).ready(function() {
                                            // Initialize DataTables
                                            $('#projects_list').DataTable();
                                        });
                                    </script>

                                </div>
                            </div>
                        </div>

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