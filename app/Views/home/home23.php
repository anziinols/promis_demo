<?= $this->extend("templates/nolstemp"); ?>
<?= $this->section('content'); ?>

<section class=" container-fluid">
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Display KML and Coordinates on OpenStreetMap</title>
        <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
        <style>
            #map {
                height: 500px;
            }
        </style>
    </head>

    <body>
        <div id="map"></div>

        <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
        <!-- Include Leaflet.KML plugin -->
        <script src="https://unpkg.com/leaflet-omnivore/leaflet-omnivore.min.js"></script>

        <script>
            // Initialize Leaflet map
            var map = L.map('map').setView([-5.583301, 147.152774], 6.5); // Center map and set zoom level

            // Add OpenStreetMap tile layer
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);


            // Function to add KML layers
            function addKMLLayer(kmlURL) {
                omnivore.kml(kmlURL).addTo(map);
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
    </body>

    </html>

</section>


<?= $this->endSection() ?>