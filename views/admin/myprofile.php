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
                        <div class="text-center center">
                            <h5 class="text-center text-capitalize mt-3"><?= $role ?></h5>
                            <input class="form-control" type="hidden" id="role" name="role">
                            <img src="" alt="user" id="user_image" height="180" width="140" class="d-block rounded m-3 mt-4 rounded mx-auto d-block">
                            <button type="button" class="btn btn-sm btn-dark m-2 mt-3 mb-5 edit-dp"><i class="tf-icons bx bx-edit-alt"></i>Change DP</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 mb-3">
                    <div class="card mb-4 h-100">
                        <div class="card-head mt-4">
                            <a class="m-3" href="#" data-bs-toggle="modal" data-bs-target="#modalCenter">CHANGE PASSWORD</a>
                        </div>
                        <hr>
                        <div class="card-body mt-2">
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

<!-- Change Password -->
<div class="col-lg-4 col-md-6">
    <div class="mt-3">
        <!-- Modal -->
        <div class="modal fade" id="modalCenter" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form id="chngPwdForm" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit_pwd">
                    <input type="hidden" name="id" id="user_id">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">Change Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <?php if (isset($_GET['error'])) { ?>
                                    <p class="error"><?php echo $_GET['error']; ?></p>
                                <?php } ?>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Old Password</label>
                                    <input type="text" id="nameWithTitle" class="form-control" placeholder="Old Password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">New Password</label>
                                    <input type="text" id="nameWithTitle" class="form-control" placeholder="New Password">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nameWithTitle" class="form-label">Confirm Password</label>
                                    <input type="text" id="nameWithTitle" class="form-control" placeholder="Confirm Password">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Close
                            </button>
                            <button type="button" id="edit-pwd" class="btn btn-primary">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- update DP -->
<div class="modal" id="editUserImage" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="edit-user-image" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit_user_img">
                <input type="hidden" name="id" id="user_id">
                <div class="modal-header mt-3">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit User Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-1 mb-3">
                        <div class="col-md-4 text-center center">

                            <img id="previewImage" class="us_image" src="<?= url('assets/uploads/upload-book.png') ?>" width="110" height="140" style="border: 1px solid black;" />
                            <p id="errorMsg"></p>
                            <label for="formFile" class="form-label">Change Image</label>
                            <input type="file" id="usr_image" name="user_image" value="" class="form-control" accept="image/*" size="50">
                            <input type="hidden" id="oldimage" name="oldimage" value="" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row g-1 mb-3">
                        <div class="col-md-6 align-self-end mr-auto"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button></div>
                        <div class="col-md-6 align-self-end ml-auto"><button type="button" id="edit-img-now" class="btn btn-dark">Save</button></div>
                    </div>
                </div>
            </form>
        </div>
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
                    showAlert(response.message, response.success ? 'success' : 'danger', 'alert-container-edit-profile');
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

    $('.edit-dp').on('click', async function() {
        var user_id = <?php echo json_encode($id); ?>;
        await getImgById(user_id);
    })

    async function getImgById(id) {
        var formAction = $('#edit-user-image').attr('action');

        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                user_id: id,
                action: 'get_user'
            },
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'primary' : 'danger');
                if (response.success) {
                    var user_id = response.data.id;
                    var user_image = response.data.user_image;
                    var imageBaseUrl = '../../assets/upload/';
                    var adjustedUrl = imageBaseUrl + user_image;

                    $('#editUserImage #user_id').val(user_id);
                    $('#editUserImage .us_image').attr('src', adjustedUrl);
                    $('#editUserImage').modal('show');
                }
            },
            error: function(error) {
                console.error('Error submitting the form:', error);
            },
            complete: function(response) {
                console.log('Request complete:', response);
            }
        });
    }
// Edit User Image
    $('#edit-img-now').on('click', function() {
        var form = $('#edit-user-image')[0];
        $('#edit-user-image')[0].reportValidity();

        if (form.checkValidity()) {
            var formData = new FormData($('#edit-user-image')[0]);
            var formAction = $('#edit-user-image').attr('action');

            $.ajax({
                url: formAction,
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    ;
                    if (response.success) {
                        $('#editUserImage').modal('hide');
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
            var message = ('Image is not valid. Please check your inputs. ');
            showAlert(message, 'danger');
        }
    });

    //Edit Password
    $('#edit-pwd').on('click', function() {
        var form = $('#chngPwdForm')[0];
        $('#chngPwdForm')[0].reportValidity();

        if (form.checkValidity()) {
            var formData = new FormData($('#chngPwdForm')[0]);
            var formAction = $('#chngPwdForm').attr('action');

            $.ajax({
                url: formAction,
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(response) {
                    ;
                    if (response.success) {
                        $('#modalCenter').modal('hide');
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
            var message = ('Password is not valid.');
            showAlert(message, 'danger');
        }
    });

    //preview user image after uploaded
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

    const input = document.getElementById('usr_image');
    input.addEventListener('change', (event) => {
        previewImage(event)
    });
</script>