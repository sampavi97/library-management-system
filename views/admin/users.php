<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/User.php';

$user_id = $sm->getAttribute("userId");

$userModel = new User();
$users = $userModel->getAll();
$user = $userModel->getById($user_id);
echo "$user_id";
?>

<div class="container">

    <h3 class="mx-3 my-5">Manage Users

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-sm btn-dark float-end" data-bs-toggle="modal" data-bs-target="#addUserModal">
            <span class="tf-icons bx bx-user-plus "></span> Add User
        </button>
    </h3>

    <!-- Filter By Username AND User Role -->
    <section class="content m-3">
        <div class=" row gy-3 mb-3">
            <div class="col-md-7">
                <label for="searchByName" class="form-label">Filter by name</label>
                <input type="text" class="form-control" name="searchByName" id="searchByName" placeholder="Filter by name" aria-describedby="defaultFormControlHelp">
            </div>
            <div class="col-md-5">
                <label for="searchByRole" class="form-label">Filter by role</label>
                <select id="searchByRole" class="form-select">
                    <option value="selected">Choose role</option>
                    <option value="member">Member</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        </div>
        <!-- /Filter By Username AND User Role -->

        <div class="card">

            <div class="table-responsive">
                <table class="table table-bordered table-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User Id</th>
                            <th>User Img</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Contact No</th>
                            <th>NIC</th>
                            <th>Role</th>
                            <?php if ($role == 'admin') : ?><th>Action</th><?php endif; ?>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php
                        foreach ($users as $key => $c) {
                        ?>
                            <tr class="table-primary">
                                <td><?= ++$key ?></td>
                                <td><?= $c['id'] ?? ""; ?></td>
                                <td>
                                    <?php if (isset($c['user_image']) || !empty($c['user_image'])) : ?>
                                        <img src="<?= asset('assets/upload/' . $c['user_image']) ?>" alt="user" class="d-block rounded m-3" width="80">
                                    <?php endif; ?>
                                </td>
                                <td><?= $c['username'] ?? ""; ?></td>
                                <td><?= $c['email'] ?? ""; ?></td>
                                <td><?= $c['address'] ?? ""; ?></td>
                                <td><?= $c['contact_num'] ?? ""; ?></td>
                                <td><?= $c['nic'] ?? ""; ?></td>
                                <td><?= $c['role'] ?? ""; ?></td>
                                <?php if ($role == 'admin') : ?>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Second group">
                                            <button type="button" class="btn btn-sm btn-secondary edit-user" data-bs-toggle="tooltip" data-bs-original-title="Edit" data-id="<?= $c['id']; ?>"><i class="tf-icons bx bx-edit "></i></button>
                                            <button type="button" class="btn btn-sm btn-danger delete-user" data-bs-toggle="tooltip" data-bs-original-title="Delete" data-id="<?= $c['id']; ?>"><i class="tf-icons bx bx-trash "></i></button>
                                        </div>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>


<!--Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="add-user-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add_user">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Add User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-2 mb-3">

                        <div class="col-md-3 mb-3 mt-3">
                            <img id="previewImage" src="<?= url('assets/uploads/upload-user.png') ?>" width="110" height="140" style="border: 1px solid black;" />
                            <p id="errorMsg"></p>
                            <label for="formFile" class="form-label">Upload an image</label>
                            <input type="file" id="inputImage" name="user_image" class="form-control" accept="image/*">
                        </div>
                        <div class="col-md-9 mb-2">
                            <div class="row g-2 mb-2">
                                <label class="form-label" for="username">Name</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Your name" required>
                            </div>
                            <div class="row g-2 mb-2">
                                <label class="form-label" for="email">Email</label>
                                <div class="input-group input-group-merge">
                                    <input type="email" id="email" name="email" class="form-control" placeholder="XXXX@XXX.XXX" required>
                                </div>
                            </div>
                            <div class="row g-2 mb-2">
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select id="role" name="role" class="form-select" required>
                                        <option value="member">Member</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-0">
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="confirm_password">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-2">
                        <div class="col mb-3">
                            <label class="form-label" for="contact_num">Phone No</label>
                            <input type="number" id="contact_num" name="contact_num" class="form-control phone-mask" placeholder="07X XXX XXXX" required>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label" for="nic">NIC No</label>
                            <input type="text" id="nic" name="nic" class="form-control" placeholder="--------------" required>
                        </div>
                    </div>
                    <div class="row g-2 mb-3">
                        <label class="form-label" for="address">Address</label>
                        <textarea id="address" name="address" class="form-control" placeholder="Your address" rows="5" required></textarea>
                    </div>

                    <div id="additional-fields"></div>
                    <div class="mb-3 mt-3">
                        <div id="alert-container"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="add-now" class="btn btn-dark">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Add User Modal -->

<!--Update User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="edit-user-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit_user">
                <input type="hidden" name="id" id="user_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-1 mb-3">
                        <div class="col-md-3 mb-3 mt-4">
                            <img id="previewImage" class="usr_image" src="<?= url('assets/uploads/upload-user.png') ?>" width="110" height="140" style="border: 1px solid black;" />
                            <p id="errorMsg"></p>
                        </div>
                        <div class="col-md-9 mb-3 form-group">
                            <div class="row g-1 mt-2">
                                <label for="formFile" class="form-label">Change Image</label>
                                <input type="file" id="user_image" name="user_image" value="" class="form-control" accept="image/*">
                                <input type="hidden" id="oldimage" name="oldimage" value="<?= $user['user_image']?>" class="form-control" accept="image/*">
                            </div>
                            <div class="row g-1 mt-2">
                                <label class="form-label" for="username">Name</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Your name" required>
                            </div>
                        </div>
                    </div>
                    <div class="row g-2 mt-0">
                        <div class="col-md-7 mb-3">
                            <label class="form-label" for="email">Email</label>
                            <div class="input-group input-group-merge">
                                <input type="email" id="email" name="email" class="form-control" placeholder="XXXX@XXX.XXX" required>
                            </div>
                        </div>
                        <div class="col-md-5 mb-3">
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select id="role" name="role" class="form-select" required>
                                    <option value="member">Member</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- delete password option in update user modal
                        <div class="row g-2 mt-2">
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group">
                                <input type="password" name="password" class="form-control" id="password" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="col mb-0 form-password-toggle">
                            <label class="form-label" for="confirm_password">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="············" aria-describedby="basic-default-password2" required>
                                <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                    </div> -->
                    <div class="row g-2 mt-0">
                        <div class="col mb-3">
                            <label class="form-label" for="contact_num">Phone No</label>
                            <input type="number" id="contact_num" name="contact_num" class="form-control phone-mask" placeholder="07X XXX XXXX" required>
                        </div>
                        <div class="col mb-3">
                            <label class="form-label" for="nic">NIC No</label>
                            <input type="text" id="nic" name="nic" class="form-control" placeholder="--------------" required>
                        </div>
                    </div>
                    <div class="row g-1 mb-3">
                        <label class="form-label" for="address">Address</label>
                        <textarea id="address" name="address" class="form-control" placeholder="Your address" required></textarea>
                    </div>

                    <div id="additional-fields"></div>
                    <div class="mb-3 mt-3">
                        <div id="alert-container-edit-form"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="edit-now" class="btn btn-dark">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Update User Modal -->

<?php
require_once('../layouts/footer.php');
?>

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
                        showAlert(response.message, response.success ? 'primary' : 'danger');
                        if (response.success) {
                            $('#addUserModal').modal('hide');
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
                var message = ('Form is not valid. Please check your inputs.');
                showAlert(message, 'danger');
            }
        });

        $('.edit-user').on('click', async function() {
            var user_id = $(this).data('id');
            await getUserById(user_id);
        })

        $('.delete-user').on('click', async function() {
            var user_id = $(this).data('id');
            var is_confirm = confirm('Are you sure, Do you want to delete?');
            if (is_confirm) await deleteById(user_id);
        })

        $('#edit-now').on('click', function() {
            var form = $('#edit-user-form')[0];
            $('#edit-user-form')[0].reportValidity();

            if (form.checkValidity()) {
                var formData = new FormData($('#edit-user-form')[0]);
                var formAction = $('#edit-user-form').attr('action');

                $.ajax({
                    url: formAction,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        showAlert(response.message, response.success ? 'primary' : 'danger', 'alert-container-edit-form');
                        if (response.success) {
                            $('#editUserModal').modal('hide');
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

        // if role changed add users to admin table function

    });

    async function getUserById(id) {
        var formAction = $('#edit-user-form').attr('action');

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
                    var username = response.data.username;
                    var email = response.data.email;
                    var role = response.data.role;
                    var contact_num = response.data.contact_num;
                    var nic = response.data.nic;
                    var address = response.data.address;
                    var user_image = response.data.user_image;

                    var imageBaseUrl = '../../assets/upload/';
                    var adjustedUrl = imageBaseUrl + user_image;

                    $('#editUserModal #user_id').val(user_id);
                    $('#editUserModal #username').val(username);
                    $('#editUserModal #email').val(email);
                    $('#editUserModal #role').val(role);
                    $('#editUserModal #contact_num').val(contact_num);
                    $('#editUserModal #nic').val(nic);
                    $('#editUserModal #address').val(address);

                    $('#editUserModal .usr_image').attr('src', adjustedUrl);
                    $('#editUserModal').modal('show');
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

    async function deleteById(id) {
        var formAction = $('#edit-user-form').attr('action');

        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                user_id: id,
                action: 'delete_user',
            },
            dataType: 'json',
            success: function(response) {
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
    }
    // search by user name
    $(document).ready(function() {
        $('#searchByName').on('input', function() {
            var searchTerm = $(this).val().toLowerCase();

            $('tbody tr').each(function() {
                var username = $(this).find('td:eq(2)').text().toLowerCase(); // Index 1 for the name column

                // Check if the username contains the search term
                if (username.includes(searchTerm)) {
                    $(this).show(); // Show the row if the search term is found
                } else {
                    $(this).hide(); // Hide the row if the search term is not found
                }
            });
        });
    });

    //search by user role
    $(document).ready(function() {
        $('#searchByRole').change(function() {
            var selectedRole = $(this).val();

            $('tbody tr').filter(function() {
                var role = $(this).find('td:eq(8)').text(); // Index 6 for the role column

                // Check if the role matches the selected role or if "Choose role" is selected
                if (selectedRole === 'selected' || role === selectedRole) {
                    $(this).show(); // Show the row if the role matches the selected role or if "Choose role" is selected
                } else {
                    $(this).hide(); // Hide the row if the role does not match the selected role
                }
            });
        });
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

    const input = document.getElementById('user_image');
    input.addEventListener('change', (event) => {
        previewImage(event)
    });
</script>