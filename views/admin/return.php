<?php
include __DIR__ . '/../../config.php';
include __DIR__ . '/../../helpers/AppManager.php';
require_once __DIR__ . '/../../models/BaseModel.php';
require_once __DIR__ . '/../../models/IssueBook.php';
require_once __DIR__ . '/../../models/ReturnBook.php';

$bookId = $_GET['id'];
$issBookModel = new IssueBook();
$issBookDet = $issBookModel->getById($bookId);

// echo $issBookDet['book_id'] . "<br>";
// echo $issBookDet['user_id'] . "<br>";
// echo $issBookDet['due_date'] . "<br>";
// echo $issBookDet['id'] . "<br>";

$today = date("y-m-d");
$timestamp = strtotime($today);
$date = date("Y-m-d", $timestamp);

$dueDate = $issBookDet['due_date'];
$currentDate = new DateTime($date);
$dueDateTime = new DateTime($dueDate);

$interval = $dueDateTime->diff($currentDate);
$daysDifference = $interval->format('%r%a'); // %r for sign (+/-)

// echo "The difference: " . $daysDifference . "<br>";

// Fine Amount Calculation
$fineAmount = 20;
$fineAmtoverFive = 10;
if (0 < $daysDifference && $daysDifference <= 5) {
    $bkFine = ($fineAmount * $daysDifference);
} else if ($daysDifference > 5) {
    $bkFine = ($fineAmount * 5) + ($fineAmtoverFive * ($daysDifference - 5));
} else {
    $bkFine = "No Fine";
}
// End - Fine Amount Calculation
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

    <div class="container mt-1">
            <div class="row g-1">
                <div class="col-md-3"></div>
                    <div class="col-md-6 mt-3">
                        <form id="return-book-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                        <input type="hidden" name="action" value="return_form">
                            <div class="card mb-4 mt-5">
                                <h4 class="card-header">Return Book</h4>
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="borrowed_id" class="col-md-3 col-form-label">Issued ID</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="borrowed_id" type="text" value="<?= $issBookDet['id'] ?>" id="borrowed_id" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="due_date" class="col-md-3 col-form-label">Due Date</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="due_date" type="text" value="<?= $issBookDet['due_date'] ?>" id="due_date" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="returned_date" class="col-md-3 col-form-label text-nowrap">Returned Date</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="returned_date" type="text" value="<?= $date ?>" id="returned_date" readonly>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="fine" class="col-md-3 col-form-label">Fine</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="fine" type="text" value="<?= $bkFine ?>" id="fine" readonly>
                                        </div>
                                    </div>
                                    <div class="mt-3 row">
                                        <label for="fine_paid" class="col-md-3 col-form-label">Pay Fine</label>
                                        <div class="col-md-9 mt-2">
                                            <div class="row">
                                                <div class="col-md-1">
                                                <input style="border: 1px solid gray;" class="form-check-input" type="checkbox" id="fine_paid_checkbox">
                                                </div>
                                                <div class="col-md-4"><p id="paidMsg" style="display: none; color:darkslateblue; font-size:large">Fine Paid</p></div>
                                                <input class="form-control" name="fine_paid" id="fine_paid" type="hidden" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="additional-fields"></div>
                                <div class="row mb-2 mt-2">
                                    <div id="alert-container-return-book"></div>
                                </div>

                                <div class="card-footer">
                                    <button type="button" id="return-book-now" class="btn btn-dark text-nowrap float-end">Return Book</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
            </div>
    </div>

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
    document.getElementById("fine_paid_checkbox").addEventListener("change", function() {
        var message = document.getElementById("paidMsg");
        var is_paid = document.getElementById("fine_paid");
        if (this.checked) {
            is_paid.value = "1";
            paidMsg.style.display = "block";

        } else {
            is_paid.value = "0";
            paidMsg.style.display = "none";
        }
    });

    $(document).ready(function() {
        $('#return-book-now').on('click', function() {

            var form = $('#return-book-form')[0];
            $('#return-book-form')[0].reportValidity();

            if (form.checkValidity()) {
                var formData = new FormData($('#return-book-form')[0]);
                var formAction = $('#return-book-form').attr('action');

                $.ajax({
                    url: formAction,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        showAlert(response.message, response.success ? 'success' : 'danger', 'alert-container-return-book');
                        if (response.success) {
                            setTimeout(function() {
                                location.reload();
                            }, 1000);

                        }
                    },
                    error: function(error) {
                        console.error('Error submitting the form:', error);
                    },
                    complete: function(response) {
                        console.log('Request complete:', response);
                    }
                });
            } else {
                var message = ('Form is not valid.');
                showAlert(message, 'danger');
            }
        });
    });
</script>