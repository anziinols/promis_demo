<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print and Copy Table Image HD</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
</head>

<body>

   <div class="row">
    <div class="col-md-12">
    <div class="card card-outline card-info " id="mycard">
        <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
        <div class="card-header">
            Header
        </div>
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="btn btn-primary">Card button</a>


            <!-- Your Bootstrap table -->
            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Header 1</th>
                        <th>Header 2</th>
                        <th>Header 3</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Data 1-1</td>
                        <td>Data 1-2</td>
                        <td>Data 1-3</td>
                    </tr>
                    <tr>
                        <td>Data 2-1</td>
                        <td>Data 2-2</td>
                        <td>Data 2-3</td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>

        </div>
        <div class="card-footer text-muted">
            Footer
        </div>
    </div>

    </div>
   </div>
    <!-- Button to trigger printing and copying -->
    <button onclick="printAndCopyTableToImageHD()">Print and Copy Table to Image HD</button>

    <script>
        function printAndCopyTableToImageHD() {
            var table = document.getElementById('mycard');

            // Use html2canvas to capture the table as an image
            html2canvas(table, {
                scale: 2, // Set the scale factor for HD
                logging: true,
            }).then(function(canvas) {
                // Convert the canvas to a data URL
                var dataUrl = canvas.toDataURL();

                // Create a blob from the data URL
                var blob = dataURLToBlob(dataUrl);

                // Copy the blob to the clipboard
                navigator.clipboard.write([
                    new ClipboardItem({
                        "image/png": blob
                    })
                ]).then(function() {
                    alert('Table image copied to clipboard!');
                }).catch(function(err) {
                    console.error('Error copying to clipboard:', err);
                });
            });
        }

        // Function to convert data URL to Blob
        function dataURLToBlob(dataURL) {
            var byteString = atob(dataURL.split(',')[1]);
            var mimeString = dataURL.split(',')[0].split(':')[1].split(';')[0];

            var ab = new ArrayBuffer(byteString.length);
            var ia = new Uint8Array(ab);

            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }

            return new Blob([ab], {
                type: mimeString
            });
        }
    </script>

</body>

</html>




<?= $this->endSection(); ?>