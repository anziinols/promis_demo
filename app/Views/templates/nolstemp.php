<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Projects Management Information System (PROMIS) - Track and manage projects efficiently" />
    <meta name="keywords" content="project management, PROMIS, tracking, milestones" />
    <meta name="author" content="Dakoii Systems" />
    <link rel="shortcut icon" href="<?= base_url() ?>/public/assets/system_img/favicon.ico" type="image/x-icon">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Custom CSS Variables -->
    <style>
        :root {
            --primary-color: #0d6efd;
            --secondary-color: #6c757d;
            --accent-color: #ffc107;
            --dark-color: #212529;
            --light-color: #f8f9fa;
            --success-color: #198754;
            --danger-color: #dc3545;
            --warning-color: #ffc107;
            --info-color: #0dcaf0;
            --body-bg: #f5f5f5;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --transition-speed: 0.3s;
        }

        body {
            background-color: var(--body-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            box-shadow: var(--card-shadow);
            transition: transform var(--transition-speed);
            border-radius: 0.5rem;
            border: none;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            transition: transform var(--transition-speed);
        }

        .navbar-brand:hover img {
            transform: scale(1.1);
        }

        .system-header {
            background: linear-gradient(135deg, var(--primary-color), #0a58ca);
            color: white;
            padding: 1rem 0;
        }

        .alert-container {
            position: relative;
            padding: 0.5rem 0;
        }

        .footer {
            background-color: var(--dark-color);
            color: var(--light-color);
            padding: 1.5rem 0;
            margin-top: 2rem;
        }
    </style>

    <title><?= $title ?></title>
</head>

<body>
    <!-- Modern Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="<?= base_url() ?>">
                <img src="<?= base_url() ?>/public/assets/system_img/system-logo.png" alt="Brand Logo" width="40" height="30" class="me-2">
                <span class="fw-bold"><?= SYSTEM_NAME ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <?php
                        $active = "";
                        if ($menu == "home") {
                            $active = "active";
                        }
                        ?>
                        <a class="nav-link <?= $active ?> px-3" href="<?= base_url() ?>">
                            <i class="fa-solid fa-house me-1"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php
                        $active = "";
                        if ($menu == "projects_list") {
                            $active = "active";
                        }
                        ?>
                        <a class="nav-link <?= $active ?> px-3" href="<?= base_url() ?>projects_list">
                            <i class="fa-solid fa-list me-1"></i> Projects List
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php
                        $active = "";
                        if ($menu == "login") {
                            $active = "active";
                        }
                        ?>
                        <a class="nav-link <?= $active ?> px-3" href="<?= base_url() ?>login">
                            <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <?php
                        $active = "";
                        if ($menu == "about") {
                            $active = "active";
                        }
                        ?>
                        <a class="nav-link <?= $active ?> px-3" href="<?= base_url() ?>about">
                            <i class="fa-solid fa-circle-info me-1"></i> About
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Alert Messages -->
    <?php if (session()->get("error")) : ?>
    <div class="alert-container">
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?= session()->get("error") ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- System Header -->
    <header class="system-header mb-4">
        <div class="container">
            <div class="row py-3">
                <div class="col-12 text-center">
                    <h2 class="fw-bold mb-0">Projects Management Information System (PROMIS)</h2>
                    <p class="lead mb-0">Track, manage, and visualize your projects efficiently</p>
                </div>
            </div>
        </div>
    </header>

    <?php $this->renderSection('content') ?>

    <!-- Modern Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-3 mb-md-0">
                    <h5 class="text-white">About <?= SYSTEM_NAME ?></h5>
                    <p class="text-white-50">A comprehensive project management system designed to track, manage, and visualize projects efficiently.</p>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <h5 class="text-white">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="<?= base_url() ?>" class="text-white-50 text-decoration-none">Home</a></li>
                        <li><a href="<?= base_url() ?>projects_list" class="text-white-50 text-decoration-none">Projects List</a></li>
                        <li><a href="<?= base_url() ?>about" class="text-white-50 text-decoration-none">About</a></li>
                        <li><a href="<?= base_url() ?>login" class="text-white-50 text-decoration-none">Login</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="text-white">Contact</h5>
                    <ul class="list-unstyled text-white-50">
                        <li><i class="fa-solid fa-envelope me-2"></i> info@dakoiims.com</li>
                        <li><i class="fa-solid fa-globe me-2"></i> www.dakoiims.com</li>
                    </ul>
                </div>
            </div>
            <hr class="my-3 bg-light">
            <div class="row">
                <div class="col-lg-12">
                    <p class="text-white-50 text-center mb-0">&copy; <?= date('Y') ?> <a href="https://www.dakoiims.com" class="text-white">Dakoii Systems</a>
                        | <?= SYSTEM_NAME ?> <?= SYSTEM_VERSION ?></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        // Enable tooltips everywhere
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl)
            })
        });
    </script>
</body>
</html>