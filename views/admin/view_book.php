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

                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="mt-3 mb-3">
                                    <div class="row">
                                        <!-- filter book By Catogary -->
                                        <div class="col-lg-3 mb-3 mb-md-0">
                                            <div id="filterByCatogary" class="list-group list-group-item-dark">
                                                <a class="list-group-item list-group-item-action text-center active" value="selected" data-bs-toggle="list" href="#">ALL BOOKS</a>
                                                <a class="list-group-item list-group-item-action text-center" id="fiction" value="fiction" data-bs-toggle="list" href="#">FICTION</a>
                                                <a class="list-group-item list-group-item-action text-center" id="nonFiction" value="non-fiction" data-bs-toggle="list" href="#">NON-FICTION</a>
                                                <a class="list-group-item list-group-item-action text-center" id="science" value="science" data-bs-toggle="list" href="#">SCIENCE</a>
                                                <a class="list-group-item list-group-item-action text-center" id="history" value="history" data-bs-toggle="list" href="#">HISTORY</a>
                                                <a class="list-group-item list-group-item-action text-center" id="technology" value="technology" data-bs-toggle="list" href="#">TECHNOLOGY</a>
                                                <a class="list-group-item list-group-item-action text-center" id="philosophy" value="philosophy" data-bs-toggle="list" href="#">PHILOSOPHY</a>
                                                <a class="list-group-item list-group-item-action text-center" id="thriller" value="thriller" data-bs-toggle="list" href="#">THRILLER</a>
                                                <a class="list-group-item list-group-item-action text-center" id="fantasy" value="fantasy" data-bs-toggle="list" href="#">FANTASY</a>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <!-- filter book By Title | Author | Publisher -->
                                            <div class="row">
                                                <input type="text" class="form-control" id="searchBook" style="line-height: 55px;" placeholder="Type and Search Book By { Title | Author | Publisher }">
                                            </div>
                                            <div class="row tab-content p-0 mt-3" id="list-home">
                                                <?php
                                                foreach ($books as $key => $b) {
                                                ?>
                                                    <div class="display-book card col-md-2 mt-1 align-items-center">
                                                        <input type="hidden" value="<?= $b['title'] ?>">
                                                        <input type="hidden" value="<?= $b['author'] ?>">
                                                        <input type="hidden" value="<?= $b['publisher'] ?>">
                                                        <input type="hidden" value="<?= $b['catogary'] ?>">
                                                        <?php if (isset($b['book_image']) || !empty($b['book_image'])) : ?>
                                                            <a class="view-book" href="book_detail.php?id=<?= $b['id'] ?>">
                                                                <img src="<?= asset('assets/upload/' . $b['book_image']) ?>" alt="book" class="d-block rounded m-3 view-book" width="130" height="180">
                                                            </a>
                                                        <?php else : ?>
                                                            <a class="view-book" href="book_detail.php?id=<?= $b['id'] ?>">
                                                                <img src="<?= asset('assets/img/avatars/upload-book.png') ?>" alt="book" class="d-block rounded m-3 view-book" width="130" height="180">
                                                            </a>
                                                        <?php endif; ?>

                                                        <!-- book status badges -->
                                                        <?php if ($b['book_status'] === 'available') { ?>
                                                            <span class="badge bg-success">available</span>
                                                        <?php } else if ($b['book_status'] === 'reserve') { ?>
                                                            <span class="badge bg-warning">reserve</span>
                                                        <?php } else if ($b['book_status'] === 'lost') { ?>
                                                            <span class="badge bg-danger">lost</span>
                                                        <?php } else if ($b['book_status'] === 'loaned') { ?>
                                                            <span class="badge bg-info">All issued</span>
                                                        <?php } else if ($b['book_status'] === 'not-available') { ?>
                                                            <span class="badge bg-info">Not Available</span>
                                                        <?php } ?>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
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
    // Filter Book By Title, Author, Publisher
    $(document).ready(function() {
        $('#searchBook').on('input', function() {
            var searchedBook = $(this).val().toLowerCase();

            $('.display-book').each(function() {
                // $(this).find('input:nth-of-type(1)') targets the first input element inside each .display-book, which corresponds to the book title.
                // input:nth-of-type(1) is a CSS selector that selects the first <input> element among its siblings of the same type within its parent element.
                var title = $(this).find('input:nth-of-type(1)').val().toLowerCase();
                var author = $(this).find('input:nth-of-type(2)').val().toLowerCase();
                var publisher = $(this).find('input:nth-of-type(3)').val().toLowerCase();

                if (title.includes(searchedBook) || author.includes(searchedBook) || publisher.includes(searchedBook)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });

    // filter book with various catogaries 
    $(document).ready(function() {
        $('#filterByCatogary a').on('click', function() {
            var selectedCat = $(this).attr('value');

            $('.display-book').filter(function() {
                var cat = $(this).find('input:nth-of-type(4)').val().toLowerCase();

                if (selectedCat === 'selected' || cat === selectedCat) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    });
</script>