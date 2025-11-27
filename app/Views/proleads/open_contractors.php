<?= $this->extend("templates/adminlte/admindash"); ?>
<?= $this->section('content'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $con['name'] ?></h1>
                <h5><?= $con['concode'] ?></h5>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>contractors"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Contractors List</a></li>
                    <li class="breadcrumb-item active"><?= $con['name'] ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<section class=" container-fluid">

    <div class="row p-2">
        <div class=" col-md-8">
            <div class="card">
                <div class="card-header bg-info">
                    <i class="fa fa-info-circle" aria-hidden="true"></i> Contractor Details

                    <a href="<?= base_url(); ?>edit_contractors/<?= $con['ucode'] ?>" class="btn btn-dark btn-sm float-right">Edit
                        <i class="fas fa-edit    "></i>
                    </a>

                </div>

                <div class="card-body">



                    <div class="row">

                        <div class="form-group col-md-12">
                            <div class="form-group">
                                <label for="my-input">Contractor Name</label>
                                <p><?= $con['name'] ?></p>
                            </div>
                            <div class="form-group">
                                <label for="my-input">Contractor Services</label>
                                <p>

                                    <?php
                                    $text = $con['services'];

                                    $lines = explode("\n", $text);

                                    $numberedLines = [];

                                    foreach ($lines as $i => $line) {
                                        $numberedLines[] = ($i + 1) . ". " . $line;
                                    }

                                    $numberedText = implode("\n", $numberedLines);

                                    echo nl2br($numberedText);

                                    ?>
                                </p>

                            </div>
                        </div>


                        <label class=" col-md-12 "> Contractor Location</label>
                        <div class="form-group">
                            <p><?= !empty($set_country) ? $set_country['name'] : 'N/A' ?>, <?= !empty($get_provinces) ? $get_provinces['name'] : 'N/A' ?>, <?= !empty($get_districts) ? $get_districts['name'] : 'N/A' ?>, <?= !empty($get_llgs) ? $get_llgs['name'] : 'N/A' ?>
                            </p>

                        </div>


                    </div>

                </div>

            </div>

        </div>
        <!-- ./ col -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info"> <i class="fas fa-image    "></i> Update Logo

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark btn-sm float-right" data-toggle="modal" data-target="#edit_logo">
                        Edit <i class="fas fa-edit    "></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="edit_logo" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content text-dark">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title"> <i class="fa fa-upload" aria-hidden="true"></i> Upload Logo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="update_logo_form" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group col-md-12">
                                        <div class="input-group ">
                                            <div class="custom-file ">
                                                <input type="file" class="custom-file-input " name="logo_file" id="exampleInputFile" accept="image/*" required>
                                                <label class="custom-file-label " for="exampleInputFile">Logo File</label>
                                            </div>

                                        </div>
                                        <small>Upload Logo Image</small>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id" value="<?= $con['id'] ?>">
                                    <input type="hidden" name="concode" value="<?= $con['concode'] ?>">
                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf_token">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Upload Logo</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <img class=" card-img-top" height="300" src="<?= imgcheck($con['con_logo']) ?>" alt="">

            </div>
        </div>


        <div class="col-md-5">
            <div class="card card-info">
                <div class="card-header">
                    <i class="fa fa-phone" aria-hidden="true"></i> Contact Information
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark btn-sm float-right" data-toggle="modal" data-target="#edit_contact">
                        Edit <i class="fas fa-edit    "></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="edit_contact" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content text-dark">
                                <div class="modal-header bg-dark">
                                    <h5 class="modal-title"> <i class="fa fa-phone" aria-hidden="true"></i> Edit Contacts</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="update_contacts_form">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label for="">Phones</label>
                                            <input type="text" name="phones" id="" class="form-control" value="<?= $con['phones'] ?>" placeholder="" aria-describedby="helpId">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="">Emails</label>
                                            <input type="text" name="emails" id="" class="form-control" value="<?= $con['emails'] ?>" placeholder="" aria-describedby="helpId">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Address</label>
                                            <input type="text" name="address" id="" class="form-control" value="<?= $con['address'] ?>" aria-describedby="helpId">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="">Weblinks</label>
                                            <textarea name="weblinks" id="" class=" form-control" rows="5"><?= $con['weblinks'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="id" value="<?= $con['id'] ?>" />
                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf_token">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"> Save Contacts</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <span><b>Phone:</b> <?= $con['phones'] ?></span><br>
                    <span><b>Email:</b> <?= $con['emails'] ?></span><br>
                    <span><b>Address:</b> <?= $con['address'] ?></span><br>
                    <span><b>Weblinks:</b> </span>
                    <p><?= nl2br($con['weblinks']) ?></p>
                </div>

            </div>

        </div>

        <!-- ============================== Relevant Contractor Files ============================== -->
        <div class=" col-md-7 pb-0">

            <div class="card">
                <div class="card-header bg-info">
                    <i class="fas fa-file-pdf"></i> Relevant Contractor Files

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark btn-sm float-right" data-toggle="modal" data-target="#relconfiles">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Files
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="relconfiles" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content text-dark">
                                <div class="modal-header bg-info ">
                                    <h5 class="modal-title">Upload Relevant Files</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="create_files_form" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">File Name</label>
                                        <select class="form-control" name="file_name" id="file_name">
                                            <option value="">-- File Name --</option>
                                            <option value="IPA Certificate">IPA Certificate</option>
                                            <option value="COC Certificate">COC Certificate</option>
                                            <option value="IRC Certificate">IRC Certificate</option>
                                            <option value="Company Profile">Company Profile</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="others" style="display:none;">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Others</span>
                                            </div>
                                            <input type="text" name="others" class="form-control" placeholder="Enter Other File Name">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="">
                                            <span class="" id="exampleAddon">Document Number</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Document Number" name="file_number">
                                        <small class="">IPA Number, IRC Number, COC Number etc...</small>
                                    </div>


                                    <div class="row">
                                        <div class="form-group col-md-6 mb-3">
                                            <div class="">
                                                <span class="" id="exampleAddon">Issued Date</span>
                                            </div>
                                            <input type="date" class="form-control" placeholder="Issue Date" name="issued_date">
                                            <small>IPA Issue Date, IRC Issue Date, COC etc...</small>
                                        </div>
                                        <div class="form-group col-md-6">

                                            <div class="">
                                                <span class="" id="exampleAddon">Expiry Date</span>
                                            </div>
                                            <input type="date" class="form-control" placeholder="Expiry Date" name="expiry_date">

                                            <small>IPA Expiry Date, IRC Expiry Date, COC etc...</small>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <div class="input-group ">
                                            <div class="custom-file ">
                                                <input type="file" class="custom-file-input " name="doc_file" id="doc_file_upload" accept=".pdf" required>
                                                <label class="custom-file-label " for="doc_file_upload">Document File</label>
                                            </div>
                                        </div>
                                        <small class=" text-muted">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i> Upload Document file in PDF format.
                                        </small>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="concode" value="<?= $con['concode'] ?>" />
                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf_token">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Upload File <i class="fa fa-upload" aria-hidden="true"></i></button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>File Name</th>
                                <th>File No.#</th>
                                <th>Issue</th>
                                <th>Expire</th>
                                <th>File</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1;
                            foreach ($con_files as $file) : ?>
                                <tr>
                                    <td scope="row"><?= $x++ ?></td>
                                    <td><?= $file['file_name'] ?></td>
                                    <td><?= $file['file_number'] ?></td>
                                    <td><?= dateforms($file['issued_date']) ?></td>
                                    <td><?= dateforms($file['expiry_date']) ?></td>
                                    <td>
                                        <a href="<?= base_url() ?><?= $file['file_path'] ?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                    </td>
                                    <td>

                                        <div class="margin float-right">
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-outline-primary">Action</button>
                                                <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#info<?= $file['id'] ?>">Info</a>
                                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#edit<?= $file['id'] ?>">Edit</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item bg-danger" href="#" data-toggle="modal" data-target="#delete<?= $file['id'] ?>">Delete</a>
                                                </div>
                                            </div>

                                    </td>
                                </tr>

                                <!-- Modal -->
                                <div class="modal fade" id="edit<?= $file['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info">
                                                <h5 class="modal-title"><i class="fas fa-edit    "></i> <?= $file['file_name'] ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?= form_open_multipart('update_con_files') ?>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="">File Name</label>
                                                    <select class="form-control" name="file_name" id="file_name<?= $file['id'] ?>">
                                                        <option value="<?= $file['file_name'] ?>"><?= $file['file_name'] ?></option>
                                                        <option value="IPA Certificate">IPA Certificate</option>
                                                        <option value="COC Certificate">COC Certificate</option>
                                                        <option value="IRC Certificate">IRC Certificate</option>
                                                        <option value="Company Profile">Company Profile</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="others<?= $file['id'] ?>" style="display:none;">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Others</span>
                                                        </div>
                                                        <input type="text" name="others" class="form-control" placeholder="Enter Other File Name">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <div class="">
                                                        <span class="" id="exampleAddon">Document Number</span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Document Number" name="file_number" value="<?= $file['file_number'] ?>">
                                                    <small class="">IPA Number, IRC Number, COC Number etc...</small>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-6 mb-3">
                                                        <div class="">
                                                            <span class="" id="exampleAddon">Issued Date</span>
                                                        </div>
                                                        <input type="date" class="form-control" placeholder="Issue Date" name="issued_date" value="<?= $file['issued_date'] ?>">
                                                        <small>IPA Issue Date, IRC Issue Date, COC etc...</small>
                                                    </div>
                                                    <div class="form-group col-md-6">

                                                        <div class="">
                                                            <span class="" id="exampleAddon">Expiry Date</span>
                                                        </div>
                                                        <input type="date" class="form-control" placeholder="Expiry Date" name="expiry_date" value="<?= $file['expiry_date'] ?>">

                                                        <small>IPA Expiry Date, IRC Expiry Date, COC etc...</small>
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <div class="input-group ">
                                                        <div class="custom-file ">
                                                            <input type="file" class="custom-file-input " name="doc_file" id="exampleInputFile" accept=".pdf">
                                                            <label class="custom-file-label " for="exampleInputFile">Document File</label>
                                                        </div>
                                                    </div>
                                                    <small class=" text-muted">
                                                        <i class="fa fa-info-circle" aria-hidden="true"></i> Upload Document file in PDF format.
                                                    </small>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" value="<?= $file['id'] ?>">
                                                <input type="hidden" name="concode" value="<?= $file['concode'] ?>">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal fade" id="delete<?= $file['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger">
                                                <h5 class="modal-title"><i class="fas fa-trash-alt   "></i> ARE YOU SURE YOU WANTED TO DELETE</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?= form_open_multipart('delete_con_files') ?>
                                            <div class="modal-body">
                                                <?= $file['file_number'] ?> - <?= $file['file_name'] ?>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" value="<?= $file['id'] ?>">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">YES DELETE <i class="fas fa-trash-alt    "></i></button>
                                            </div>
                                            <?= form_close() ?>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal -->
                                <div class="modal fade" id="info<?= $file['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-secondary">
                                                <h5 class="modal-title"><i class="fas fa-info-circle   "></i> Information</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    Create:
                                                    <span><?= datetimeforms($file['create_at']) ?> /<?= $file['create_org'] ?> / <?= $file['create_by'] ?> </span>
                                                </div>
                                                <div class="form-group">
                                                    Update:
                                                    <span><?= datetimeforms($file['update_at']) ?> /<?= $file['update_org'] ?> / <?= $file['update_by'] ?> </span>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>





                                <script>
                                    // On page load
                                    document.addEventListener('DOMContentLoaded', function() {

                                        // Hide others input
                                        // Get references to elements
                                        const fileNameSelect<?= $file['id'] ?> = document.querySelector('#file_name<?= $file['id'] ?>');
                                        const othersInput<?= $file['id'] ?> = document.querySelector('#others<?= $file['id'] ?>');

                                        // Add event listener for change on file name select
                                        fileNameSelect<?= $file['id'] ?>.addEventListener('change', function() {

                                            // Check if Others option selected
                                            if (this.value === 'Others') {
                                                othersInput<?= $file['id'] ?>.style.display = 'block';
                                            } else {
                                                othersInput<?= $file['id'] ?>.style.display = 'none';
                                            }

                                        });

                                    });
                                </script>


                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>


            </div>

        </div>
        <!-- ./ col -->

        <div class=" col-md-12 pb-0">

            <div class="card">
                <div class="card-header bg-info">
                    <i class="fas fa-tools"></i> Contracted Projects

                </div>

                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Project</th>
                                <th>P.Code</th>
                                <th>Budget</th>
                                <th>Org.</th>
                                <th>Status</th>
                                <th>S.Notes</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1;
                            foreach ($projects as $pro) : ?>
                                <tr>
                                    <td><?= $x++ ?></td>
                                    <td><?= $pro['name'] ?></td>
                                    <td><?= $pro['procode'] ?></td>
                                    <td><?= $pro['budget'] ?></td>
                                    <td><?= $pro['create_org'] ?></td>
                                    <td><?= $pro['status'] ?></td>
                                    <td><?= $pro['statusnotes'] ?></td>

                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>


            </div>

        </div>
        <!-- ./ col -->

        <div class=" col-md-12 pb-0">

            <div class="card">
                <div class="card-header bg-info">
                    <i class="fas fa-flag"></i> Contractor Notices
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark float-right " data-toggle="modal" data-target="#add_notice">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Create Notice
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="add_notice" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content text-dark">
                                <div class="modal-header bg-info">
                                    <h5 class="modal-title "><i class="fa fa-flag" aria-hidden="true"></i> Create Notice </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form id="create_notice_form" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-md-6 ">
                                            <label for="my-input">Flag</label>
                                            <select name="notice_flag" id="" class="form-control" required>
                                                <option value="">-- Select Flag --</option>
                                                <option value="excellent"></i>Excellent</option>
                                                <option value="good">Good</option>
                                                <option value="warning">Warning</option>
                                                <option value="banned">Banned</option>
                                                <option value="blacklist">Blacklist</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="my-input">Notice Date</label>
                                            <input type="date" class="form-control" name="notice_date" placeholder="Notice Date" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="my-input">Title</label>
                                            <input type="text" class="form-control" name="notice_title" placeholder="Notice Title" required>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="my-input">Description</label>
                                            <textarea name="notice_description" id="" cols="30" rows="10" class="form-control" placeholder="Notice Description" required></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <div class="input-group ">
                                                <div class="custom-file ">
                                                    <input type="file" class="custom-file-input " name="notice_file" id="notice_file_upload" accept=".pdf" required>
                                                    <label class="custom-file-label " for="notice_file_upload">Notice File</label>
                                                </div>
                                            </div>
                                            <small>Upload Single .pdf File</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="concode" value="<?= $con['concode'] ?>" />
                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="csrf_token">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary"> <i class="fa fa-paper-plane" aria-hidden="true"></i> Post Notice</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-body p-0 table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Flag</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Notice Date</th>
                                <th>Set Date</th>
                                <th>Org</th>
                                <th>File</th>


                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1;
                            foreach ($notices as $note) : ?>
                                <tr>
                                    <td><?= $x++ ?></td>
                                    <td><?= get_notice_flags($note['notice_flag']) ?></td>
                                    <td><?= $note['notice_title'] ?></td>
                                    <td><?= $note['notice_description'] ?></td>
                                    <td><?= dateforms($note['notice_date']) ?></td>
                                    <td><?= dateforms($note['create_at']) ?></td>
                                    <td><?= ($note['create_org']) ?></td>
                                    <td>
                                        <?php
                                        if (!empty($note['file_path'])) {
                                        ?>
                                            <a href="<?= base_url() ?><?= $note['file_path'] ?>"> <i class="fa fa-download" aria-hidden="true"></i></a>
                                        <?php
                                        }
                                        ?>
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>


                </div>


            </div>

        </div>
        <!-- ./ col -->

    </div>
    <!-- ./ row -->


</section>


</body>


<script>
    // On page load
    document.addEventListener('DOMContentLoaded', function() {

        // Hide others input
        // Get references to elements
        const fileNameSelect = document.querySelector('#file_name');
        const othersInput = document.querySelector('#others');

        // Add event listener for change on file name select
        fileNameSelect.addEventListener('change', function() {

            // Check if Others option selected
            if (this.value === 'Others') {
                othersInput.style.display = 'block';
            } else {
                othersInput.style.display = 'none';
            }

        });

    });
</script>

<script>
    // Function to refresh CSRF token
    function refreshCSRFToken() {
        $.ajax({
            url: '<?= base_url() ?>get_csrf_token',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                // Update all CSRF token fields
                $('.csrf_token').attr('name', data.csrf_token_name).val(data.csrf_token_value);
            }
        });
    }

    // Handle Update Logo Form
    $('#update_logo_form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: '<?= base_url() ?>update_con_logo',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#edit_logo').modal('hide');
                alert('Logo Uploaded Successfully!');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            },
            complete: function() {
                refreshCSRFToken();
            }
        });
    });

    // Handle Update Contacts Form
    $('#update_contacts_form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = $(this).serialize();
        
        $.ajax({
            url: '<?= base_url() ?>update_con_contacts',
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#edit_contact').modal('hide');
                alert('Contacts Updated Successfully!');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            },
            complete: function() {
                refreshCSRFToken();
            }
        });
    });

    // Handle Create Files Form
    $('#create_files_form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: '<?= base_url() ?>create_con_files',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#relconfiles').modal('hide');
                alert('File Uploaded Successfully!');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            },
            complete: function() {
                refreshCSRFToken();
            }
        });
    });

    // Handle Create Notice Form
    $('#create_notice_form').on('submit', function(e) {
        e.preventDefault();
        
        var formData = new FormData(this);
        
        $.ajax({
            url: '<?= base_url() ?>create_con_notices',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#add_notice').modal('hide');
                alert('Notice Posted Successfully!');
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error);
            },
            complete: function() {
                refreshCSRFToken();
            }
        });
    });

    // Update file input labels when files are selected
    $('.custom-file-input').on('change', function() {
        var fileName = $(this).val().split('\\').pop();
        $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
    });
</script>



<?= $this->endSection() ?>