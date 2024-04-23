<?php
include __DIR__ . '/../../config.php';
?>
<!DOCTYPE html>
<html lang="en" class="light-style" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>LMS-front-page</title>

    <meta name="description" content="" />

    <style>
        #border-style2 {
            border: 2px;
            padding: 20px;
            width: 320px;
            height: 430px;
            position: relative;
        }
        #border-style {
            border-radius: 25px;
            border: 2px solid cadetblue;
            padding: 20px;
            width: 280px;
            height: 350px;
            position: absolute;
        }
        img:hover {
            box-shadow: 0 0 3px 2px rgba(0, 140, 186, 0.6);
        }
        .font-style{
            font-family: 'Lucida Sans Unicode';
            font-size: 30px;
        }


    </style>

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
    <!-- Content -->
    <div class="container-fluid">

        <div class="container">
            <div class="row m-5">
                <h1 class="text-center font-style">Select User Type</h1>
                <div class="col-lg-2"></div>
                <div class="col-lg-4 mt-3" id="border-style2">
                    <a href="login.php"><img id="border-style" src="<?= asset('assets/uploads/admin-type-login.png') ?>" alt="user-member"></a> 
                    <div class="text-center font-style">User</div>
                </div>
                <div class="col-lg-4 mt-3" id="border-style2">
                    <a class="text-center" href="<?= url('views/admin/home.php') ?>"><img id="border-style" src="<?= asset('assets/uploads/guest-type-login.png') ?>" alt="user-guest"></a>
                    <div class="text-center font-style">Guest</div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </div>


    <!-- / Content -->

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
