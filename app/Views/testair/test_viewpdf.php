<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View PDF in Bootstrap Modal</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
</head>
<body>

<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#pdfModal">
    View PDF
</button>

<!-- Bootstrap Modal -->
<div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pdfModalLabel">PDF Viewer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="pdfViewer"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to load PDF in the modal -->
<script>
    // Function to load and display PDF in the modal
    function loadPdfInModal(pdfUrl) {
        // Set up PDF.js
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://mozilla.github.io/pdf.js/build/pdf.worker.js';

        // Get modal and viewer elements
        const pdfModal = document.getElementById('pdfModal');
        const pdfViewer = document.getElementById('pdfViewer');

        // Clear existing PDF viewer content
        pdfViewer.innerHTML = '';

        // Open PDF using PDF.js
        pdfjsLib.getDocument(pdfUrl).promise.then(pdf => {
            // Loop through each page of the PDF
            for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                // Create a canvas element for each page
                const canvas = document.createElement('canvas');
                pdfViewer.appendChild(canvas);

                // Render the page on the canvas
                pdf.getPage(pageNum).then(page => {
                    const viewport = page.getViewport({ scale: 1.5 });
                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext);
                });
            }

            // Show the modal
            $(pdfModal).modal('show');
        });
    }

    // Attach click event to the "View PDF" button
    document.querySelector('.btn-primary').addEventListener('click', function() {
        // Replace 'path/to/your/pdf/file.pdf' with the actual URL or path to your PDF file
        loadPdfInModal('http://localhost/promis/public/myfile.pdf');
    });
</script>

<!-- Bootstrap and jQuery scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>


<?= $this->endSection(); ?>