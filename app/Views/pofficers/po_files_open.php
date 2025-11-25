<?= $this->extend("templates/nolsadmintemp"); ?>
<?= $this->section('content'); ?>

<body>
    <div class="container-fluid">
        <div class="row p-1">
            <div class="col-12 d-flex justify-content-between">

                <h4><?= $pro['procode'] . "-" . $pro['name'] ?></h4>

                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="<?= base_url() ?>/po_open_project/<?= $pro['ucode'] ?>"> <i class="bi bi-chevron-left"></i> Go Back</a>
                    <span class="breadcrumb-item active">Files</span>
                </nav>

            </div>

        </div>

        <div class="row pb-2">
            <div class="col-md-12">
                <h5 class="text-center">Project Documents</h5>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary justify-content-end float-right m-1" data-toggle="modal" data-target="#addprodocs" hover>
                    <i class=" fa fa-upload" aria-hidden="true"></i> Upload Project Files
                </button>

                <!-- Modal upload files -->
                <div class="modal fade" id="addprodocs" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"> <i class="fa fa-upload" aria-hidden="true"></i> Upload Project Files</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?= form_open_multipart('prodocs_upload', ['id' => 'uploadFileForm']) ?>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="exampleInputFile">File Title</label>
                                    <div class="input-group">
                                        <input type="text" name="name" id="fileName" placeholder="File Title" class=" form-control" required>
                                    </div>
                                    <label for="exampleInputFile">Upload Project Files</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="prodocs" id="exampleInputFile" required>
                                            <label class="custom-file-label" for="exampleInputFile">Choose File
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">

                                <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                <input type="hidden" name="proid" value="<?= $pro['id'] ?>">

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="btnUploadFile" class="btn btn-primary"> <i class="fa fa-upload" aria-hidden="true"></i> Upload</button>
                            </div>
                            <?= form_close(); ?>
                        </div>
                    </div>
                </div>
                <!-- ./modal -->




            </div>

        </div>


        <div class="row mb-2 ">
            <div class="col-md-12">
                <h2>Files</h2>
            </div>
            <?php foreach ($prodocs as $file) : ?>
                <div class="col-md-2 p-2">
                    <div class="card  p-0">
                        <div class="card-header">
                            <?= $file['name'] ?>
                        </div>
                        <img class=" card-img-top" height="200" src="<?= imgfilecheck($file['filepath']) ?>" alt="">

                        <div class="card-footer d-flex justify-content-between">
                            <a href="<?= base_url($file['filepath']) ?>" class=""> <i class="fa fa-download" aria-hidden="true"></i>
                            (.<?= getfileExtension($file['filepath']) ?>)
                            </a>

                            <!-- Button trigger modal -->
                            <a href="#" class=" text-danger" data-toggle="modal" data-target="#del<?= $file['id'] ?> "> <i class="fas fa-trash-alt" aria-hidden="true"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="del<?= $file['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title text-light"> <i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Your aboout this delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <img class="card-img-top" src="<?= imgfilecheck($file['filepath']) ?>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-3 border-danger">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-danger"> <i class="fa fa-times-circle" aria-hidden="true"></i> Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./modal -->

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>












    </div>
    </div>

    <script>
        $(document).ready(function() {

            // Function to refresh CSRF token
            function refreshCSRFToken() {
                $.ajax({
                    url: "<?= base_url('get_csrf_token'); ?>",
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Update the CSRF token in the form
                        $('input[name="<?= csrf_token() ?>"]').val(response.hash);
                    },
                    error: function() {
                        console.log('Failed to refresh CSRF token');
                    }
                });
            }

            // Update file name label when file is selected
            $('#exampleInputFile').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').html(fileName);
            });

            // Handle file upload via AJAX
            $('#btnUploadFile').on('click', function(e) {
                e.preventDefault();

                // Validate form fields
                var fileName = $('#fileName').val();
                var fileInput = $('#exampleInputFile')[0].files[0];

                if (!fileName) {
                    toastr.error('Please enter a file title');
                    return;
                }

                if (!fileInput) {
                    toastr.error('Please select a file to upload');
                    return;
                }

                // Create FormData object
                var formData = new FormData($('#uploadFileForm')[0]);

                // Disable button and show loading
                $('#btnUploadFile').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Uploading...');

                // Send AJAX request
                $.ajax({
                    url: "<?= base_url('prodocs_upload'); ?>",
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        // Re-enable button
                        $('#btnUploadFile').prop('disabled', false).html('<i class="fa fa-upload"></i> Upload');

                        if (response.status === 'success') {
                            // Show success message with toastr
                            toastr.success(response.message);

                            // Reset form
                            $('#uploadFileForm')[0].reset();
                            $('#exampleInputFile').next('.custom-file-label').html('Choose File');

                            // Close modal using Bootstrap 4 method
                            $('#addprodocs').modal('hide');

                            // Refresh CSRF token
                            refreshCSRFToken();

                            // Reload page to show uploaded file
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else {
                            toastr.error(response.message || 'Upload failed');
                            // Refresh CSRF token even on failure
                            refreshCSRFToken();
                        }
                    },
                    error: function(xhr, status, error) {
                        // Re-enable button
                        $('#btnUploadFile').prop('disabled', false).html('<i class="fa fa-upload"></i> Upload');
                        
                        toastr.error('Error uploading file. Please try again.');
                        console.log('Error:', error);
                        console.log('XHR:', xhr);
                        
                        // Refresh CSRF token after error
                        refreshCSRFToken();
                    }
                });
            });

            // Allow Enter key to trigger upload
            $('#fileName').on('keypress', function(e) {
                if (e.which == 13) {
                    e.preventDefault();
                    $('#btnUploadFile').click();
                }
            });

        });
    </script>

<?= $this->endSection() ?>