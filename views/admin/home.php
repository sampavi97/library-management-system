<?php
include __DIR__ . '/../../config.php';
include __DIR__ . '/../../helpers/AppManager.php';
require_once __DIR__ . '/../../models/Book.php';

$sm = AppManager::getSM();
$username = $sm->getAttribute("username");
$bookModel = new Book();
$books = $bookModel->getAll();

?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>LMS-Home</title>

    <meta name="description" content="" />


    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= asset('assets/img/favicon/favicon.ico') ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= asset('assets/vendor/fonts/boxicons.css') ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= asset('assets/vendor/css/core.css') ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= asset('assets/vendor/css/theme-default.css') ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= asset('assets/css/demo.css') ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') ?>" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= asset('assets/vendor/js/helpers.js') ?>"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= asset('assets/js/config.js') ?>"></script>

    <style>
        .small-image {
        height: 500px; /* Adjust the height as needed */
        width: auto; /* Maintain aspect ratio */
    }
    .bordered-text {
        border: 2px solid rgba(211, 211, 211, 0.5); /* Border style, adjust as needed */
        padding: 5px;
        background-color: rgba(50, 50, 50, 0.5);
        color:darkslategray; /* Padding to create space between text and border */
    }
    </style>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar layout-without-menu">
        <div class="layout-container">
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <nav class="layout-navbar  navbar navbar-expand-xl navbar-detached  bg-navbar-theme  bg-dark text-white">
                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Home , Books, Contact options-->
                        <div class="container">
                            <div class="collapse navbar-collapse" id="navbar-ex-2">
                                <img src="<?= asset('assets/uploads/lms-logo.png') ?>" alt="lms-logo" height="50" width="80">
                                <h3 class="text-white mt-3">&nbsp;LMS</h3>
                                <div class="navbar-nav ms-auto">
                                    <a class="nav-item nav-link" href="home.php">HOME</a>
                                    <a class="nav-item nav-link" href="view_book.php">BOOKS</a>
                                    <a class="nav-item nav-link" href="dashboard.php">DASHBOARD</a>
                                    <a class="nav-item nav-link" href="about.php">ABOUT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row">
                            <!-- Bootstrap carousel -->
                            <div class="col-md-12">

                                <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators">
                                        <li data-bs-target="#carouselExample" data-bs-slide-to="0" class=""></li>
                                        <li data-bs-target="#carouselExample" data-bs-slide-to="1" class="active" aria-current="true"></li>
                                        <li data-bs-target="#carouselExample" data-bs-slide-to="2" class=""></li>
                                    </ol>
                                    <div class="carousel-inner">
                                        <div class="carousel-item">
                                            <img class="small-image w-100" src="<?= asset('assets/uploads/library.jpg') ?>" alt="First slide">
                                            <div class="carousel-caption d-none d-sm-block bordered-text">
                                                <h3>A library is the delivery room for the birth of ideas, a place where history comes to life.</h3>
                                                <p>Norman Cousins</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item active">
                                            <img class="small-image w-100" src="<?= asset('assets/uploads/lms-bg.jpg') ?>" alt="Second slide">
                                            <div class="carousel-caption d-none d-sm-block bordered-text">
                                                <h3>That perfect tranquillity of life, which is nowhere to be found but in retreat, a faithful friend and a good library.</h3>
                                                <p>Aphra Behn</p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img class="small-image w-100" src="<?= asset('assets/uploads/lms-bg2.jpg') ?>" alt="Third slide">
                                            <div class="carousel-caption d-none d-sm-block bordered-text">
                                                <h3>The more that you read, the more things you will know. The more that you learn, the more places you’ll go.</h3>
                                                <p>Dr. Seuss</p>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= asset('assets/vendor/libs/jquery/jquery.js') ?>"></script>
    <script src="<?= asset('assets/vendor/libs/popper/popper.js') ?>"></script>
    <script src="<?= asset('assets/vendor/js/bootstrap.js') ?>"></script>
    <script src="<?= asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') ?>"></script>

    <script src="<?= asset('assets/vendor/js/menu.js') ?>"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="<?= asset('assets/js/main.js') ?>"></script>

    <!-- Page JS -->

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>