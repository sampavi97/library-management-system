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
                                    <a class="nav-item nav-link" href="about.php">ABOUT</a>
                                    <a class="nav-item nav-link" href="dashboard.php">DASHBOARD</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-fluid" style="background-color: lightgray; width:1240px">
                        <h2 class="mt-3 mb-3" style="color: black; font-family: 'Gill Sans'">General Guidelines</h2>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9 mt-4" style="color: black;">
                                <ul>
                                    <li>
                                        <p>Members are only allowed to borrow books.</p>
                                    </li>
                                    <li>
                                        <p>Guests are restricted only to visit home, book page to view book details</p>
                                    </li>
                                    <li>
                                        <p>Borrowers are limited to borrowing a maximum of 2 books at a time. They can borrow the next book only after returning any of the borrowed ones.</p>
                                    </li>
                                    <li>
                                        <p>Books can only be borrowed for a period of 14 days.</p>
                                    </li>
                                    <li>
                                        <p>The Librarian may recall books when needed, and the borrower must return books immediately when called upon.</p>
                                    </li>
                                    <li>
                                        <p>Students should report to the issuing counter if they find any marks or damages to the books at the time of borrowing. Such a report is necessary for the books to be presumed to have been in good condition when loaned, and the borrower will be responsible and fined for any damage observed when the books are returned.</p>
                                    </li>
                                    <li>
                                        <p>The fine will be imposed as follows for the books not returned on the due dates.</p>
                                        <p>Form due date</p>
                                        <ul>
                                            <li>The fine amount per day for the first 5 days - Rs.10</li>
                                            <li>Fine amount per day after 5 days - Rs.20</li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-3 mt-4">
                                <img src="<?= asset('assets/uploads/lms-about.jpg') ?>" style="border: 2px solid gray; border-radius: 10px;" height="450" width="300" alt="lms">
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