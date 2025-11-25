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
                <h5 class="text-center">Project Funding</h5>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12">

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary justify-content-end float-right m-1" data-toggle="modal" data-target="#addfunds" hover>
                    <i class=" fa fa-plus-circle" aria-hidden="true"></i> Add Project Payments
                </button>

                <!-- Modal upload files -->
                <div class="modal fade" id="addfunds" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"> <i class="fa fa-upload" aria-hidden="true"></i> Upload Project Files</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?= form_open_multipart('addpayments', ['id' => 'addpaymentsForm']) ?>
                            <div class="modal-body text-dark">
                                <div class="">
                                    <div class="form-group">
                                        <label for="inputName" class="">Amount</label>
                                        <input type="number" step=".01" class="form-control" name="amount" id="inputName" placeholder="0000.00" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputName" class="">Payment Date</label>
                                        <input type="date" class="form-control" name="paymentdate" id="inputName" placeholder="Date" required>
                                    </div>

                                    <div class="form-group">
                                        <textarea id="my-textarea" class="form-control" name="description" placeholder="Enter Description" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="file_payment" id="file_payment" accept=".pdf" required>
                                                <label class="custom-file-label" for="file_payment">Choose File...</label>
                                            </div>
                                        </div>

                                        <script>
                                            // Add an event listener to the file input element
                                            document.getElementById('file_payment').addEventListener('change', function() {
                                                // Get the name of the selected file
                                                var fileName = this.files[0].name;
                                                // Update the label text with the file name
                                                var label = document.querySelector('.custom-file-label');
                                                label.textContent = fileName;
                                            });
                                        </script>
                                        <small class=" text-muted">
                                            Upload the files for this payment
                                        </small>


                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" id="btnAddPayments" class="btn btn-primary">Add Payment</button>
                            </div>
                            </form>


                            <script>
                                $(document).ready(function() {

                                    // Add keypress event listener to the form input fields
                                    $('#addpaymentsForm input').keypress(function(e) {
                                        if (e.which == 13) {
                                            e.preventDefault(); // Prevent the default form submission
                                            $('#btnAddPayments').click(); // Trigger the AJAX function
                                        }
                                    });



                                    $('#btnAddPayments').on('click', function() {

                                        // Check if a file is selected
                                        var fileInput = $('#file_payment');
                                        if (fileInput.get(0).files.length === 0) {
                                            // Display an error message for file selection
                                            toastr.error('Please select a file.');
                                            return;
                                        }

                                        // Check if the selected file has the correct extension (.pdf)
                                        var allowedExtensions = /(\.pdf)$/i;
                                        if (!allowedExtensions.exec(fileInput.val())) {
                                            // Display an error message for file type
                                            toastr.error('Please select a PDF file.');
                                            return;
                                        }


                                        // Create FormData object to store form data and files
                                        var formData = new FormData($('#addpaymentsForm')[0]);

                                        // Send an AJAX request
                                        $.ajax({
                                            url: "<?= base_url('addpayments'); ?>", // Update this with your controller method
                                            type: 'POST',
                                            data: formData,
                                            contentType: false,
                                            processData: false,
                                            beforeSend: function() {
                                                // Display a loading indicator
                                                $('#btnAddPayments').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Uploading...');
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




            </div>

        </div>


        <div class="row mb-2 ">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">Payments</div>
                    <div class="card-body">
                        <table class="table table-light table-hover">
                            <thead class="bg-primary">
                                <tr>
                                    <th>#</th>
                                    <th>Amount(<?= COUNTRY_CURRENCY ?>)</th>
                                    <th>P.Date</th>
                                    <th>Notes</th>
                                    <th class="">File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total = array();
                                $x = 1;
                                foreach ($fund as $fd) : ?>
                                    <tr>
                                        <td><?= $x++ ?></td>
                                        <td data-toggle="tooltip" data-placement="top" title="<?= $fd['description'] ?>"><?= $total[] = number_format($fd['amount'], 2) ?></td>
                                        <td><?= dateforms($fd['paymentdate']) ?></td>
                                        <td><?= ($fd['description']) ?></td>
                                        <td class=" d-flex justify-content-between">
                                            <a class=" text-dark" href="<?= base_url() . $fd['filepath'] ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                            <a class=" text-dark" href="#" data-toggle="modal" data-target="#editfund<?= $fd['id'] ?>"><i class="fas fa-edit" aria-hidden="true"></i></a>
                                            <a class=" text-dark" href="#" data-toggle="modal" data-target="#infofund<?= $fd['id'] ?>"><i class="fas fa-info-circle" aria-hidden="true"></i></a>
                                        </td>
                                        <!-- Modal -->
                                        <div class="modal fade" id="editfund<?= $fd['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title"> <i class="fas fa-edit"></i> Edit Payment</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <?= form_open_multipart('editpayments', ['id' => 'editpaymentsForm' . $fd['id']]) ?>
                                                    <div class="modal-body">

                                                        <div class="form-group ">
                                                            <label for="inputName" class="col-sm-1-12 col-form-label">Amount</label>
                                                            <input type="number" step=".01" class="form-control" name="amount" id="inputName" placeholder="0000.00" required value="<?= $fd['amount'] ?>">
                                                        </div>

                                                        <div class="form-group ">
                                                            <label for="inputName" class="col-sm-1-12 col-form-label">Payment Date</label>
                                                            <input type="date" class="form-control" name="paymentdate" id="inputName" placeholder="Date" required value="<?= $fd['paymentdate'] ?>">
                                                        </div>

                                                        <div class="form-group ">
                                                            <textarea id="my-textarea" class="form-control" name="description" placeholder="Enter Description" rows="3" required><?= $fd['description'] ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputFile">Upload Payment Files</label>
                                                            <div class="input-group">
                                                                <div class="custom-file">
                                                                    <input type="file" class="custom-file-input" name="file_payment" id="exampleInputFile" accept=".pdf">
                                                                    <label class="custom-file-label" for="exampleInputFile">Choose
                                                                        file...</label>
                                                                </div>
                                                            </div>
                                                            <small class=" text-muted">
                                                                Upload the files for this payment
                                                            </small>
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between ">
                                                        <span class=" float-left">
                                                            <small class=" float-left"><b>Create:</b> <?= datetimeforms($fd['create_at']) ?> | <?= $fd['create_by'] ?></small><br>
                                                            <small><b>Update:</b> <?= datetimeforms($fd['update_at']) ?> | <?= $fd['update_by'] ?></small>
                                                        </span>
                                                        <div>
                                                            <input type="hidden" name="procode" value="<?= $pro['procode'] ?>">
                                                            <input type="hidden" name="payid" value="<?= $fd['id'] ?>">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary" id="btnsEditPayments<?= $fd['id'] ?>"> Update Payment</button>
                                                        </div>

                                                    </div>
                                                    </form>

                                                    <script>
                                                        $(document).ready(function() {

                                                            // Add keypress event listener to the form input fields
                                                            $('#editpaymentsForm<?= $fd['id'] ?> input').keypress(function(e) {
                                                                if (e.which == 13) {
                                                                    e.preventDefault(); // Prevent the default form submission
                                                                    $('#btnsEditPayments<?= $fd['id'] ?>').click(); // Trigger the AJAX function
                                                                }
                                                            });


                                                            $('#btnsEditPayments<?= $fd['id'] ?>').on('click', function() {
                                                                // Create FormData object to store form data and files
                                                                var formData = new FormData($('#editpaymentsForm<?= $fd['id'] ?>')[0]);

                                                                // Send an AJAX request
                                                                $.ajax({
                                                                    url: "<?= base_url('editpayments'); ?>", // Update this with your controller method
                                                                    type: 'POST',
                                                                    data: formData,
                                                                    contentType: false,
                                                                    processData: false,
                                                                    beforeSend: function() {
                                                                        // Display a loading indicator
                                                                        $('#btnsEditPayments<?= $fd['id'] ?>').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
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
                                                                            }, 1000);
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
                                        <!-- ./ modal -->

                                        <!-- Modal -->
                                        <div class="modal fade" id="infofund<?= $fd['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title"> <i class="fas fa-info-circle"></i> Info Payment</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-between ">
                                                        <span class=" float-left">
                                                            <small class=" float-left"><b>Create:</b> <?= datetimeforms($fd['create_at']) ?> | <?= $fd['create_by'] ?></small><br>
                                                            <small><b>Update:</b> <?= datetimeforms($fd['update_at']) ?> | <?= $fd['update_by'] ?></small>
                                                        </span>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ./ modal -->

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>

                        </table>

                    </div>
                    <div class="card-footer">
                        <b>Totals</b>
                        <address>
                            <?php $paid = array();
                            $x = 1;
                            foreach ($fund as $fd) : ?>
                                <?php (($paid[] = $fd['amount'])) ?>
                            <?php endforeach; ?>
                            Budgeted: <span class=" float-right"><?= COUNTRY_CURRENCY ?> <?= number_format($pro['budget'], 2) ?></span> <br>
                            Paid: <span class=" float-right"><?= COUNTRY_CURRENCY ?> <?= number_format($yetto = array_sum($paid), 2) ?></span> <br>

                            <b> Outstanding: <span class=" float-right"><?= COUNTRY_CURRENCY ?> <?= number_format(($pro['budget'] - $yetto), 2) ?></span></b>

                        </address>
                    </div>
                </div>

            </div>

        </div>












    </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
</body>



</html>
<?= $this->endSection() ?>