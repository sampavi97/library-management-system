<?php
include __DIR__ . '/../../config.php';
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
                                    <a class="nav-item nav-link" href="">HOME</a>
                                    <a class="nav-item nav-link" href="">BOOKS</a>
                                    <a class="nav-item nav-link" href="">ABOUT</a>
                                    <a class="nav-item nav-link" href="">CONTACT</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card mb-4">
                            <div class="card-body">
                                <!-- Custom content with heading -->
                                <div class="mt-3 mb-3">
                                    <div class="row">
                                        <div class="col-lg-3 mb-3 mb-md-0">
                                            <div class="list-group list-group-item-dark">
                                                <a class="list-group-item list-group-item-action text-center active" id="list-home-list" data-bs-toggle="list" href="#list-home">ALL BOOKS</a>
                                                <a class="list-group-item list-group-item-action text-center" id="list-profile-list" data-bs-toggle="list" href="#list-profile">FICTION</a>
                                                <a class="list-group-item list-group-item-action text-center" id="list-messages-list" data-bs-toggle="list" href="#list-messages">NON-FICTION</a>
                                                <a class="list-group-item list-group-item-action text-center" id="list-settings-list" data-bs-toggle="list" href="#list-settings">SCIENCE</a>
                                                <a class="list-group-item list-group-item-action text-center" id="list-settings-list" data-bs-toggle="list" href="#list-settings">HISTORY</a>
                                                <a class="list-group-item list-group-item-action text-center" id="list-settings-list" data-bs-toggle="list" href="#list-settings">TECHNOLOGY</a>
                                                <a class="list-group-item list-group-item-action text-center" id="list-settings-list" data-bs-toggle="list" href="#list-settings">PHILOSOPHY</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row tab-content p-0" id="list-home">
                                                <!-- class =  col-md-3 col-12 -->
                                                <div class="col-md-3 mt-1">
                                                    Oat cake chocolate cake pudding bear claw liquorice gingerbread
                                                    icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer
                                                    gummi bears fruitcake.
                                                </div>
                                                <div class="col-md-3 mt-1">
                                                    Oat cake chocolate cake pudding bear claw liquorice gingerbread
                                                    icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer
                                                    gummi bears fruitcake.
                                                </div>
                                                <div class="col-md-3 mt-1">
                                                    Oat cake chocolate cake pudding bear claw liquorice gingerbread
                                                    icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer
                                                    gummi bears fruitcake.
                                                </div>
                                                <div class="col-md-3 mt-1">
                                                    Oat cake chocolate cake pudding bear claw liquorice gingerbread
                                                    icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer
                                                    gummi bears fruitcake.
                                                </div>
                                                <div class="col-md-3 mt-1">
                                                    Oat cake chocolate cake pudding bear claw liquorice gingerbread
                                                    icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer
                                                    gummi bears fruitcake.
                                                </div>
                                                <div class="col-md-3 mt-1">
                                                    Oat cake chocolate cake pudding bear claw liquorice gingerbread
                                                    icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer
                                                    gummi bears fruitcake.
                                                </div>
                                                <div class="col-md-3 mt-1">
                                                    Oat cake chocolate cake pudding bear claw liquorice gingerbread
                                                    icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer
                                                    gummi bears fruitcake.
                                                </div>
                                                <div class="col-md-3 mt-1">
                                                    Oat cake chocolate cake pudding bear claw liquorice gingerbread
                                                    icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer
                                                    gummi bears fruitcake.
                                                </div>
                                                <div class="col-md-3 mt-1">
                                                    Oat cake chocolate cake pudding bear claw liquorice gingerbread
                                                    icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer
                                                    gummi bears fruitcake.
                                                </div>
                                                <div class="col-md-3 mt-1">
                                                    Oat cake chocolate cake pudding bear claw liquorice gingerbread
                                                    icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer
                                                    gummi bears fruitcake.
                                                </div>
                                                <div class="col-md-3 mt-1">
                                                    Oat cake chocolate cake pudding bear claw liquorice gingerbread
                                                    icing sugar plum brownie. Toffee cookie apple pie cheesecake bear claw sugar plum wafer
                                                    gummi bears fruitcake.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Custom content with heading -->
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->


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