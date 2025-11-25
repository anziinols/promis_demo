<?= $this->extend('templates/adminlte/admindash') ?>

<?= $this->section('content') ?>
<!-- links -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>



<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><b><?= $off['name'] ?></b> Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>report_pro_officers_dash"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Go Back</a></li>
                    <li class="breadcrumb-item active"> Projects Dashboard</li>
                    <!-- <li class="breadcrumb-item active"> <button onclick="generatePDF()" class="btn btn-default btn-flat btn-sm float-right"> <i class="fa fa-download" aria-hidden="true"></i> PDF</button></li> -->
                    <li class="breadcrumb-item active"> <button onclick="printCard('printpdf')" class=" btn btn-default btn-sm float-right d-print-block"> <i class="fa fa-print" aria-hidden="true"></i> </button></li>
                    <li class="breadcrumb-item active"> <button onclick="copyToImageHD('printpdf')" class=" btn btn-default btn-sm float-right d-print-block"> <i class="fa fa-copy" aria-hidden="true"></i> </button></li>

                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<div class="container-fluid mt-1" id="printpdf">

    <div class="row">
        <div class="col-md-12">
            <div class="card bg-dark ">
                <!--tips: add .text-center,.text-right to the .card to change card text alignment-->
                <div class="card-header p-1">
                    <a href="<?= base_url() ?>report_pro_officers_dash" class=" btn btn-light text-dark"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Go Back</a>
                    <span class=" float-right btn btn-dark"><b><?= $off['pocode'] ?> | <?= $off['name'] ?></b> Dashboard</span>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <h5 class="float-left">Summary Report</h5>
            <div class="float-right"><?= session('orgname') ?></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card" id="myprojects">
                <div class="card-header bg-info">
                    My Projects
                    <button onclick="printCard('myprojects')" class=" btn btn-dark btn-sm float-right d-print-none"> <i class="fa fa-print" aria-hidden="true"></i> </button>
                    <button onclick="printTable('myprojects_tbl','My Projects')" class=" btn btn-default btn-sm float-right d-print-none"> <i class="fa fa-print" aria-hidden="true"></i> </button>
                    <button onclick="copyToImageHD('myprojects')" class=" btn btn-default btn-sm float-right d-print-none"> <i class="fa fa-copy" aria-hidden="true"></i> </button>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table" id="myprojects_table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>P.Code</th>
                                <th>Project</th>
                                <th>Budget</th>
                                <th>T.Payments</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1;
                            foreach ($myprojects as $mp) : ?>
                                <tr>
                                    <td scope="row"><?= $x++ ?></td>
                                    <td scope="row"><?= $mp['procode'] ?></td>
                                    <td scope="row"><?= $mp['name'] ?></td>
                                    <td><?= number_format(checkZero($mp['budget']), 2) ?></td>
                                    <td><?= number_format(checkZero($mp['payment_total']), 2, '.', ',') ?></td>
                                    <td><?= $mp['status'] ?></td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-bodyp-0-->
                <div class="card-footer">
                    <small> <b>PO:</b> <?= $off['pocode'] ?> - <?= $off['name'] ?></small>
                    <small class=" float-right"><?= session('orgname') ?></small>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->

    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="card" id="otherprojects">
                <div class="card-header bg-secondary">
                    Other Projects
                    <button onclick="printCard('otherprojects')" class=" btn btn-dark btn-sm float-right d-print-none"> <i class="fa fa-print" aria-hidden="true"></i> </button>
                    <button onclick="printTable('otherprojects_tbl','Other Projects')" class=" btn btn-default btn-sm float-right d-print-none"> <i class="fa fa-print" aria-hidden="true"></i> </button>
                    <button onclick="copyToImageHD('otherprojects')" class=" btn btn-default btn-sm float-right d-print-none"> <i class="fa fa-copy" aria-hidden="true"></i> </button>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table" id="othernotices_tbl">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>P.Code</th>
                                <th>Project</th>
                                <th>Budget</th>
                                <th>T.Payments</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $x = 1;
                            foreach ($projects as $mp) : ?>
                                <tr>
                                    <td scope="row"><?= $x++ ?></td>
                                    <td scope="row"><?= $mp['procode'] ?></td>
                                    <td scope="row"><?= $mp['name'] ?></td>
                                    <td><?= number_format(checkZero($mp['budget']), 2) ?></td>
                                    <td><?= number_format(checkZero($mp['payment_total']), 2, '.') ?></td>
                                    <td><?= $mp['status'] ?></td>
                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>
                </div>
                <!-- /.card-bodyp-0-->
                <div class="card-footer">
                    <small><b>PO:</b><?= $off['pocode'] ?> - <?= $off['name'] ?></small>
                    <small class=" float-right"><?= session('orgname') ?></small>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->



    <script>
        function generatePDF() {

            // Options
            var opt = {
                margin: 0.5,
                filename: '<?= $title ?>.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1.98
                },
                html2canvas: {
                    dpi: 200,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A3',
                    orientation: 'landscape'
                }
            };

            // New Promise-based usage:
            // html2pdf().set(opt).from('document.body').save();

            // Get the <ul> element
            const list = document.querySelector('#printpdf');

            // Generate PDF from <ul> only  
            html2pdf().from(list).save();

        }
    </script>





</div>




<?= $this->endSection(); ?>