<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/User.php';

$sm = AppManager::getSM();
$id = $sm->getAttribute("userId");
$role = $sm->getAttribute("role");
?>

<div class="container">
    <h3 class="mx-3 my-5">My Profile</h3>
    <hr class="m-3">

    <div class="container-fluid">
        <form id="user-detail" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="edit_user">
            <div class="row mb-5">
                <div class="col-lg-4 mb-3">
                    <div class="card">
                        <div class=" text-center center">
                            <h5 class="text-center text-capitalize mt-3"><?= $role ?></h5>
                            <img src="" alt="user" id="user_image" height="180" width="140" class="d-block rounded m-3 mt-4 rounded mx-auto d-block">
                            <button type="button" class="btn btn-sm btn-dark m-2 mt-3 mb-5 edit-profile" data-id="<?= $id ?>"><i class="tf-icons bx bx-edit-alt"></i>Change DP</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-3">
                    <div class="card mb-4 h-100">
                        <a class="m-3" href="">Change Password</a>
                        <hr>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="id">User Id</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="user_id" name="id" readonly>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="username">Name</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="username" name="username">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="email">Email</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="email" id="email" name="email">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="contact_num">Phone</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="tel" id="contact_num" name="contact_num">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="address">Address</label>
                                <div class="col-md-10">
                                    <textarea class="form-control" type="text" id="address" name="address"></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label" for="nic">Nic</label>
                                <div class="col-md-10">
                                    <input class="form-control" type="text" id="nic" name="nic">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="button" id="edit-profile" data-id="<?= $id ?>" class="btn btn-dark float-end">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="additional-fields"></div>
            <div class="mb-3 mt-3">
                <div id="alert-container-edit-profile"></div>
            </div>
        </form>
    </div>
</div>


<?php
require_once('../layouts/footer.php');
?>

<script>
    $(document).ready(async function() {
        var user_id = <?php echo json_encode($id); ?>;
        await getUserById(user_id);
    });

    async function getUserById(user_id) {
        var formAction = $('#user-detail').attr('action');

        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                user_id: user_id,
                action: 'get_user'
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    var imageBaseUrl = '../../assets/upload/';
                    var adjustedUrl = imageBaseUrl + response.data.user_image;

                    $('#user-detail #user_id').val(response.data.id);
                    $('#user-detail #username').val(response.data.username);
                    $('#user-detail #email').val(response.data.email);
                    $('#user-detail #contact_num').val(response.data.contact_num);
                    $('#user-detail #address').val(response.data.address);
                    $('#user-detail #nic').val(response.data.nic);
                    $('#user-detail #user_image').attr('src', adjustedUrl);
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

    // $('.edit-profile').on('click', async function() {
    //     var user_id = $(this).data('id');
    //     var is_confirm = confirm('Are you sure, Do you want to change the details?');
    //     if (is_confirm) await editById(user_id);
    // })

    // async function editById(user_id) {
    //     var form = $('#user-detail')[0];
    //     $('#user-detail')[0].reportValidity();

    //     if (form.checkValidity()) {
    //         var formData = new FormData($('#user-detail')[0]);
    //         var formAction = $('#user-detail').attr('action');

    //         $.ajax({
    //             url: formAction,
    //             type: 'POST',
    //             data: formData,
    //             dataType: 'json',
    //             contentType: false,
    //             processData: false,
    //             success: function(response) {
    //                 showAlert(response.message, response.success ? 'success' : 'danger', 'alert-container-edit-profile');
    //                 if (response.success) {
    //                     setTimeout(function() {
    //                         location.reload();
    //                     }, 1000);
    //                 }
    //             },
    //             error: function(error) {
    //                 console.error('Error submitting the form:', error);
    //             },
    //             complete: function(response) {
    //                 console.log('Request complete:', response);
    //             }
    //         });
    //     } else {
    //         var message = ('Form is not valid. Please check your inputs. ');
    //         showAlert(message, 'danger');
    //     }
    // }

    $('#edit-profile').on('click', function() {
            var form = $('#user-detail')[0];
            $('#user-detail')[0].reportValidity();

            if (form.checkValidity()) {
                var formData = new FormData($('#user-detail')[0]);
                var formAction = $('#user-detail').attr('action');

                $.ajax({
                    url: formAction,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        showAlert(response.message, response.success ? 'primary' : 'danger', 'alert-container-edit-profile');
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
                var message = ('Form is not valid. Please check your inputs. ');
                showAlert(message, 'danger');
            }
        });
</script>