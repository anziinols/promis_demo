<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="shortcut icon" href="<?= base_url() ?>/public/assets/system_img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.17.1/themes/materialize/bootstrap-table-materialize.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/flatly/bootstrap.min.css"  crossorigin="anonymous"> -->
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>


    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/united/bootstrap.min.css">
    <!-- fontaweseom -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- bootstrap icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" crossorigin="anonymous">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <!-- bs-custom-file-input -->
    <script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>


    <title><?= $title ?></title>
</head>

<body>
    <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <?= session('orgname') ?>
                </a>

               
            </div>
        </nav>

    </section>

    <section class="container">
        <div class="row pt-2 ">
            <div class="col-md-12">
                Hi, <b> <?= session('name') ?></b>
            </div>
        </div>
    </section>

    <?php $this->renderSection('content') ?>

    <footer class="footer bg-dark">
        <div class="container">
            <div class="row pt-2">
                <div class="col-lg-12">
                    <p class="text-muted text-center">&copy; 2023 <a href="https://www.dakoiims.com">Dakoii Systems</a>
                        . <?= SYSTEM_NAME ?> <?= SYSTEM_VERSION ?></p>
                </div>
            </div>
        </div>
    </footer>



</body>


<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // Configure toastr options
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    // Show toastr messages
    $(document).ready(function() {
        <?php if (session()->has('success')): ?>
            toastr.success('<?= session('success') ?>');
        <?php endif; ?>

        <?php if (session()->has('error')): ?>
            toastr.error('<?= session('error') ?>');
        <?php endif; ?>
    });
</script>

</html>