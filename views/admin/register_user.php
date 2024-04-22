<?php
include __DIR__ . '/../../config.php';
include __DIR__ . '/../../helpers/AppManager.php';
require_once __DIR__ . '/../../models/BaseModel.php';
require_once __DIR__ . '/../../models/User.php';

?>

<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>LMS-Register</title>

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
            <div class="col-md-2"></div>
            <div class="col-md-8 mt-3">
                <form id="add-user-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="add_user">
                    <div class="card mb-4 mt-5">
                        <h3 class="card-header text-center" style="font-family: Lucida Sans Unicode;">Create Your Account</h3>
                        <div class="card-body mt-3">
                            <div class="mb-3 row">
                                <div class="col-md-4">
                                    <img id="previewImage" style="border: 2px solid gray; border-radius: 10px;" src="<?= url('assets/uploads/upload-book.png') ?>" width="140" height="180" />
                                    <p id="errorMsg"></p>
                                    <!-- <input type="file" id="user_image" name="user_image" class="form-control" accept="image/*"> -->
                                    <label for="user_image" class="custom-file-upload">
                                        <input type="file" style="display: none;" id="user_image" name="user_image" accept="image/*">
                                        <span class="badge bg-label-secondary">Choose Image</span>
                                    </label>

                                    <div class="mb-3 row mt-4">
                                        <label for="role" class="col-md-3 col-form-label">Role</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="role" type="text" value="member" id="role" readonly>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="nic" class="col-md-3 col-form-label">NIC</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="nic" type="text" placeholder="--------------" id="nic" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="mb-3 row">
                                        <label for="name" class="col-md-3 col-form-label">Name</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="username" type="text" placeholder="Your name" id="name" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="email" class="col-md-3 col-form-label">Email</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="email" type="text" placeholder="xxx@xxxx.com" id="email" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="password" class="col-md-3 col-form-label">Password</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="password" type="password" placeholder="*******" id="password" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="confirm_password" class="col-md-3 col-form-label">Confirm Password</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="confirm_password" type="password" placeholder="*******" id="confirm_password" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="contact_num" class="col-md-3 col-form-label">Phone Number</label>
                                        <div class="col-md-9">
                                            <input class="form-control" name="contact_num" type="number" placeholder="07X XXX XXXX" id="contact_num" required>
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="address" class="col-md-3 col-form-label">Address</label>
                                        <div class="col-md-9">
                                            <textarea id="address" name="address" class="form-control" placeholder="Your address ..." rows="3" required></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="additional-fields"></div>
                        <div class="row mb-1 mt-1">
                            <div id="alert-container-create-user"></div>
                        </div>

                        <div class="card-footer">
                            <button type="button" id="add-now" class="btn btn-dark text-nowrap float-end">Create Account</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-2"></div>
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
    <script>
        // Function to display a Bootstrap alert
        function showAlert(message, alertType, id = "alert-container") {
            var alertContainer = $('#' + id);
            var alert = $('<div class="alert alert-dark mb-0' + alertType + ' alert-dismissible fade show" role="alert">' + message +
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            alertContainer.html(alert);
        }
    </script>
</body>

</html>

<script>
    $(document).ready(function() {
        $('#add-now').on('click', function() {

            var form = $('#add-user-form')[0];
            $('#add-user-form')[0].reportValidity();

            if (form.checkValidity()) {
                var formData = new FormData($('#add-user-form')[0]);

                $.ajax({
                    url: $('#add-user-form').attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        showAlert(response.message, response.success ? 'success' : 'danger', 'alert-container-create-user');
                        if (response.success) {
                            setTimeout(function() {
                                window.location.href = "dashboard.php";
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
                var message = ('Form is not valid. Please check your inputs.');
                showAlert(message, 'danger');
            }
        });
    });

    // preview image after uploaded
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const element = document.getElementById('previewImage');
            element.src = reader.result;
        }
        reader.onerror = function() {
            const element = document.getElementById('errorMsg');
            element.value = "Couldn't load the image.";
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    const input = document.getElementById('user_image');
    input.addEventListener('change', (event) => {
        previewImage(event)
    });
</script>