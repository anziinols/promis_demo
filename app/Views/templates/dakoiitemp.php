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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/solar/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


    <!-- PWA Headers -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#ffffff">


    <title><?= $title ?></title>
</head>

<body>
    <section>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="<?= base_url() ?>">
                    <img src="<?= base_url() ?>/public/assets/system_img/dakoii-logo.png" alt="Brand Logo" width="30"
                        height="30" class="d-inline-block align-text-top">
                    <?= SYSTEM_NAME ?></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?php
                            $active = "";
                            if($menu =="dlogin"){
                                $active = "active";
                            }
                            ?>
                            <a class="nav-link <?= $active ?>" href="<?= base_url() ?>"> <i
                                    class="fas fa-arrow-alt-circle-left"></i>
                                Back </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

    </section>
    <section class=" container-fluid bg-secondary ">
        <div class="row p-2">
            <div class=" col-12 d-flex justify-content-center">
                <h4 class="text-center text-dark"> DAKOII ADMIN </h4>
            </div>

        </div>

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


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

</html>