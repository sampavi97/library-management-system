<?php
include __DIR__ . '/../../config.php';
require_once '../../helpers/AppManager.php';
require_once __DIR__ . '/../../models/Book.php';

$bookModel = new Book();
$books = $bookModel->getAll();

$bookId = $_GET['id'];
$bookDetail = $bookModel->getById($bookId);

$sm = AppManager::getSM();
$role = $sm->getAttribute("role");
?>
<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>LMS-Books</title>

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
        .borderless input {
            border: none;
        }

        textarea.borderless {
            border: none;
            outline: none;
            /* Remove the outline when focused */
        }

        .badge {
            height: 35px;
            line-height: 35px;
            padding: 0 10px;
            font-size: 14px;
            width: 250px;
            margin: 0 auto;
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
                <div class="content-wrapper mb-5 mt-4">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mt-3 mb-3">
                                    <!-- Content -->
                                    <form class="borderless" id="book-detail" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-3">
                                                <div class="row mb-3">
                                                    <img src="" alt="book" id="book_image" height="300" width="100">
                                                </div>
                                                <div class="row mb-3">
                                                    <?php if ($bookDetail['book_status'] === 'available') { ?>
                                                        <span class="badge bg-success">available</span>
                                                    <?php } else if ($bookDetail['book_status'] === 'all-issued') { ?>
                                                        <span class="badge bg-danger">All issued</span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-1"></div>
                                            <div class="col-md-7">
                                                <div class="col-xl">
                                                    <div class="card-body text-capitalize">
                                                        <div class="row">
                                                            <h1 id="title"></h1>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <p id="author"></p>
                                                        </div>
                                                        <div class="row">
                                                            <p id="bk_desc"></p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-2"><span style="color: black;" for="catogary">Catogary</span></div>
                                                            <div class="col-sm-10">
                                                                <p id="catogary"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-2"><span style="color: black;" for="publisher">Publisher</span></div>
                                                            <div class="col-sm-10">
                                                                <p id="publisher"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-2"><span style="color: black;" for="isbn">ISBN</span></div>
                                                            <div class="col-sm-10">
                                                                <p id="isbn"></p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-2"><span style="color: black;" for="available_books">Available Books</span></div>
                                                            <div class="col-sm-10">
                                                                <p id="available_books"></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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

<script>
    $(document).ready(async function() {
        var book_id = <?php echo json_encode($bookId); ?>;
        await getBookById(book_id);
    });

    async function getBookById(book_id) {
        var formAction = $('#book-detail').attr('action');

        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                book_id: book_id,
                action: 'get_book'
            },
            dataType: 'json',
            success: function(response) {
                console.log('Success:', response);
                if (response.success) {
                    // set path for book image to retrieve 
                    var imageBaseUrl = '../../assets/upload/';
                    var adjustedUrl = imageBaseUrl + response.data.book_image;

                    $('#book-detail #title').text(response.data.title);
                    $('#book-detail #isbn').text(response.data.isbn);
                    $('#book-detail #author').text(response.data.author);
                    $('#book-detail #publisher').text(response.data.publisher);
                    $('#book-detail #catogary').text(response.data.catogary)
                    $('#book-detail #quantity').text(response.data.quantity);
                    $('#book-detail #available_books').text(response.data.available_books);
                    $('#book-detail #bk_desc').text(response.data.bk_desc);
                    $('#book-detail #book_image').attr('src', adjustedUrl);
                }
            },
            error: function(error) {
                console.error('Error getting details:', error);
            },
            complete: function(response) {
                console.log('Request complete:', response);
            }
        });
    }
</script>