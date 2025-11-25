<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title ?></title>

  <link rel="shortcut icon" type="image/x-icon" href="<?= base_url() ?>/public/assets/system_img/favicon.ico">


  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--  <link rel="stylesheet" href="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/fontawesome-free/css/all.min.css"> -->
  <!-- fullCalendar -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/fullcalendar/main.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>/public/assets/themes/adminlte320/dist/css/adminlte.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- jQuery -->
  <script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 5 -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Toastr -->
  <script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/toastr/toastr.min.js"></script>
  <!-- jQuery UI -->
  <script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- bs-custom-file-input -->
  <script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>/public/assets/themes/adminlte320/dist/js/adminlte.min.js"></script>
  <!-- fullCalendar 2.2.5 -->
  <script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/moment/moment.min.js"></script>
  <!-- image copy canvas -->
  <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>

  <!-- AdminLTE for demo purposes -->
  <!-- <script src="<?= base_url() ?>/public/assets/themes/adminlte320/dist/js/demo.js"></script> -->
  <!-- Page specific script -->

  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php if (session()->has('error')) : ?>
      <span class="toastrDefaultError"></span>
    <?php endif; ?>
    <?php if (session()->has('success')) : ?>
      <span class="toastrDefaultSuccess"></span>
    <?php endif; ?>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?= base_url() ?>dashboard" class="nav-link"><i class=" nav-icon fa fa-tachometer-alt" aria-hidden="true"></i></a>
        </li>

      </ul>

      <ul class="navbar-nav">
        <li class="nav-item">
          <b> <?= session('orgname') ?></b>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ms-auto">


        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4 bg-dark">
      <!-- Brand Logo -->
      <a href="<?= base_url() ?>dashboard" class="brand-link bg-dark border-bottom">
        <img src="<?= imgcheck(session('orglogo')) ?>" alt="org logo" class="brand-image img-circle elevation-3">
        <span class="brand-text fw-bold text-white">
          <small><?= session('orgcode') ?></small>
        </span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex border-bottom">
          <div class="image">
            <img src="<?= base_url() ?>/public/assets/system_img/no-users-img.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="<?= base_url() ?>my_account" class="d-block text-white fw-bold">
              <?= session('name') ?>
            </a>
            <small class="text-muted">
              <i class="fas fa-circle text-success"></i> Online
            </small>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <!-- Dashboard -->
            <li class="nav-item">
              <?php $active = ($menu == "dashboard") ? "active" : ""; ?>
              <a href="<?= base_url() ?>dashboard" class="nav-link <?= $active ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Project Management
                  <?php if ($active): ?>
                  <span class="badge bg-light text-dark float-end">
                    <i class="fas fa-check"></i>
                  </span>
                  <?php endif; ?>
                </p>
              </a>
            </li>

            <!-- Divider -->
            <li class="nav-header text-light">
              REPORTS
            </li>

            <!-- General Reports Dashboard -->
            <li class="nav-item">
              <?php $active = ($menu == "reports_dashboard") ? "active" : ""; ?>
              <a href="<?= base_url() ?>reports_dashboard" class="nav-link <?= $active ?>">
                <i class="nav-icon fas fa-chart-line"></i>
                <p>
                  General Reports
                  <?php if ($active): ?>
                  <span class="badge bg-light text-dark float-end">
                    <i class="fas fa-check"></i>
                  </span>
                  <?php endif; ?>
                </p>
              </a>
            </li>

            <!-- Projects Reports -->
            <li class="nav-item">
              <?php $active = ($menu == "report_projects_status") ? "active" : ""; ?>
              <a href="<?= base_url() ?>report_projects_status/all" class="nav-link <?= $active ?>">
                <i class="nav-icon fas fa-list-alt"></i>
                <p>
                  Projects Report
                  <?php if ($active): ?>
                  <span class="badge bg-light text-dark float-end">
                    <i class="fas fa-check"></i>
                  </span>
                  <?php endif; ?>
                </p>
              </a>
            </li>

            <!-- Contractors Reports -->
            <li class="nav-item">
              <?php $active = ($menu == "report_contractors_dash") ? "active" : ""; ?>
              <a href="<?= base_url() ?>report_contractors_dash" class="nav-link <?= $active ?>">
                <i class="nav-icon fas fa-people-carry"></i>
                <p>
                  Contractors Report
                  <?php if ($active): ?>
                  <span class="badge bg-light text-dark float-end">
                    <i class="fas fa-check"></i>
                  </span>
                  <?php endif; ?>
                </p>
              </a>
            </li>

            <!-- Officers Reports -->
            <li class="nav-item">
              <?php $active = ($menu == "report_pro_officers") ? "active" : ""; ?>
              <a href="<?= base_url() ?>report_pro_officers_dash" class="nav-link <?= $active ?>">
                <i class="nav-icon fas fa-user-check"></i>
                <p>
                  Officers Report
                  <?php if ($active): ?>
                  <span class="badge bg-light text-dark float-end">
                    <i class="fas fa-check"></i>
                  </span>
                  <?php endif; ?>
                </p>
              </a>
            </li>

            <!-- Divider -->
            <li class="nav-header text-light">
              QUICK ACTIONS
            </li>

            <!-- Projects -->
            <li class="nav-item">
              <?php $active = ($menu == "projects") ? "active" : ""; ?>
              <a href="<?= base_url() ?>projects" class="nav-link <?= $active ?>">
                <i class="nav-icon fas fa-folder-open"></i>
                <p>
                  All Projects
                  <?php if ($active): ?>
                  <span class="badge bg-light text-dark float-end">
                    <i class="fas fa-check"></i>
                  </span>
                  <?php endif; ?>
                </p>
              </a>
            </li>

            <!-- New Project -->
            <li class="nav-item">
              <?php $active = ($menu == "addprojects") ? "active" : ""; ?>
              <a href="<?= base_url() ?>new_projects" class="nav-link <?= $active ?>">
                <i class="nav-icon fas fa-plus-circle"></i>
                <p>
                  New Project
                  <?php if ($active): ?>
                  <span class="badge bg-light text-dark float-end">
                    <i class="fas fa-check"></i>
                  </span>
                  <?php endif; ?>
                </p>
              </a>
            </li>

            <!-- Contractors -->
            <li class="nav-item">
              <?php $active = ($menu == "contractors") ? "active" : ""; ?>
              <a href="<?= base_url() ?>contractors" class="nav-link <?= $active ?>">
                <i class="nav-icon fas fa-hard-hat"></i>
                <p>
                  Contractors
                  <?php if ($active): ?>
                  <span class="badge bg-light text-dark float-end">
                    <i class="fas fa-check"></i>
                  </span>
                  <?php endif; ?>
                </p>
              </a>
            </li>

            <!-- Project Officers -->
            <li class="nav-item">
              <?php $active = ($menu == "project_officers") ? "active" : ""; ?>
              <a href="<?= base_url() ?>project_officers" class="nav-link <?= $active ?>">
                <i class="nav-icon fas fa-user-tie"></i>
                <p>
                  Project Officers
                  <?php if ($active): ?>
                  <span class="badge bg-light text-dark float-end">
                    <i class="fas fa-check"></i>
                  </span>
                  <?php endif; ?>
                </p>
              </a>
            </li>

            <!-- Notifications -->
            <li class="nav-item">
              <?php $active = ($menu == "notifications") ? "active" : ""; ?>
              <a href="<?= base_url() ?>notifications" class="nav-link <?= $active ?>">
                <i class="nav-icon fas fa-bell"></i>
                <p>
                  Notifications
                  <?php if ($active): ?>
                  <span class="badge bg-light text-dark float-end">
                    <i class="fas fa-check"></i>
                  </span>
                  <?php endif; ?>
                </p>
              </a>
            </li>

            <!-- Divider -->
            <li class="nav-header text-light">
              ACCOUNT
            </li>

            <!-- My Account -->
            <li class="nav-item">
              <?php $active = ($menu == "my_account") ? "active" : ""; ?>
              <a href="<?= base_url() ?>my_account" class="nav-link <?= $active ?>">
                <i class="nav-icon fas fa-user-cog"></i>
                <p>
                  My Account
                  <?php if ($active): ?>
                  <span class="badge bg-light text-dark float-end">
                    <i class="fas fa-check"></i>
                  </span>
                  <?php endif; ?>
                </p>
              </a>
            </li>

            <!-- Logout -->
            <li class="nav-item mt-3">
              <a href="<?= base_url() ?>logout" class="nav-link bg-danger">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p class="fw-bold">
                  Logout
                  <small class="d-block"><?= session('username') ?></small>
                </p>
              </a>
            </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <?= $this->renderSection('content') ?>
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b><?= SYSTEM_NAME ?></b>
      </div>
      <strong>Copyright &copy; 2023 <a href="https://www.dakoiims.com">Dakoii Systems</a>.</strong> All rights
      reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->


  <?= $this->renderSection('calendar'); ?>
</body>

<script>
  $('.toastrDefaultSuccess').show(function() {
    toastr.success('<?= session('success') ?>')
    // toastr.success('Cook Liks')
  });
  $('.toastrDefaultError').show(function() {
    toastr.error('<?= session('error') ?>')
  });
</script>

<script>
  function copyToImageHD($element_id) {
    var table = document.getElementById($element_id);

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
        toastr.info('Image Copied')
      }).catch(function(err) {
        toastr.error('Error copying Image')
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

<script>
  function printTable(tbl_id, tbl_title, additionalStyles = '', orientation = 'landscape') {
    var table = document.getElementById(tbl_id);

    var printWindow = window.open("", "_blank");

    printWindow.document.write('<html><head><title>' + tbl_title + '</title>');
    printWindow.document.write('<h5>' + tbl_title + '</h5>');
    printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
    // printWindow.document.write('<style>td, th {border: 1px solid black; padding: 8px; word-wrap: break-word; } ' + additionalStyles + "</style></head><body>");
    printWindow.document.write('<style>@page { size: ' + orientation + '; } td, th { border: 1px solid black; padding: 8px; word-wrap: break-word;} ' + additionalStyles + '</style></head><body>');
    printWindow.document.write('<div class="row">');
    printWindow.document.write('<div class=" col-md-12">');
    printWindow.document.write('<div class="container mt-4 print-table">' + table.outerHTML + '</div>');
    printWindow.document.write('</div>');
    printWindow.document.write('</div>');
    printWindow.document.write('</body></html>');

    printWindow.focus();
    printWindow.print();
    printWindow.close();
  }
</script>

<script>
  function printCard(cardId) {
    var cardToPrint = document.getElementById(cardId);

    // Create a new window for printing
    var printWindow = window.open("", "_blank");

    // Write the card HTML to the print window
    printWindow.document.write('<html><head><title>Printed</title>');
    printWindow.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
    //printWindow.document.write('<link rel="stylesheet" href="<?= base_url() ?>/public/assets/themes/adminlte320/dist/css/adminlte.min.css">');
    printWindow.document.write('<style>@page { size: landscape; }</style></head><body>');
    printWindow.document.write('<div class="container mt-4 print-card">' + cardToPrint.outerHTML + '</div>');
    printWindow.document.write('<footer> <?= date('d-M-Y H:i:s') ?> | <?= session('name') ?>  | <?= base_url() ?> </footer>');
    printWindow.document.write('</body></html>');

    // Focus on the print window
    printWindow.focus();

    // Automatically trigger the print dialog
    printWindow.print();

    // Close the print window after printing
    printWindow.close();
  }
</script>





</html>