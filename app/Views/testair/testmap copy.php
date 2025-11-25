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


                        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
                        <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>


                        <div id="map" style="height: 500px;"></div>
                        <script>
                            var coordinates = <?php echo json_encode($coordinates); ?>;

                            var map = L.map('map').setView([coordinates[0][0], coordinates[0][1]], 13);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
                            }).addTo(map);

                            var polyline = L.polyline(coordinates, {
                                color: 'red'
                            }).addTo(map);

                            map.fitBounds(polyline.getBounds());
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