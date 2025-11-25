<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Dakoii Admin" content="This is Dakoii Admin Interface" />
    <link rel="shortcut icon" href="<?= base_url() ?>/public/assets/system_img/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/solar/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/toastr/toastr.min.css">
    
    <!-- jQuery (full version, not slim - needed for toastr animations) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <!-- bs-custom-file-input -->
    <script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    
    <!-- Toastr JS (load only once) -->
    <script src="<?= base_url() ?>/public/assets/themes/adminlte320/plugins/toastr/toastr.min.js"></script>


    <!-- PWA Headers -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#ffffff">

    <title><?= $title ?></title>


    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>


</head>

<body>

    <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url() ?>">
                    <img src="<?= base_url() ?>/public/assets/system_img/dakoii-logo.png" alt="Brand Logo" width="30" height="30" class="d-inline-block align-text-top">
                    <?= SYSTEM_NAME ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php
                            $active = "";
                            if ($menu == "dlogin") {
                                $active = "active";
                            }
                            ?>
                            <a class="nav-link <?= $active ?>" href="<?= base_url() ?>ddash"> <i class="fas fa-tachometer-alt" aria-hidden="true"></i>
                                D-Dashboard </a>
                        </li>


                        <li class="nav-item">
                            <?php
                            $active = "";
                            if ($menu == "dlogin") {
                                $active = "active";
                            }
                            ?>
                            <a class="nav-link text-danger <?= $active ?>" href="<?= base_url() ?>dlogout">
                                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                                Logout </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

    </section>
    
    <?php $this->renderSection('content') ?>

    <footer class="footer bg-dark">
        <div class="container">
            <div class="row pt-1">
                <div class="col-lg-12">
                    <p class="text-muted text-center">&copy; 2023 <a href="https://www.dakoiims.com">Dakoii Systems</a>
                        . <?= SYSTEM_NAME ?> <?= SYSTEM_VERSION ?></p>
                </div>
            </div>
        </div>
    </footer>



</body>


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