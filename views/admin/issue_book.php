<?php
require_once('../layouts/header.php');
?>

<div class="container">
    <h3 class="mx-3 my-4">Issue Book</h3>
    <hr class="m-3">
</div>

<div class="container mt-1">
    <div class="row g-2">
        <div class="col-lg-6">
            <form id="create-user-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                <div class="input-group">
                    <span class="input-group-text">Search Book</span>
                    <input type="text" class="form-control">
                    <!-- Details form of Borrowing Book -->
                    <div class="mt-3 m-1">
                        <div class="row">
                            <div class="col-md-3">
                                <img style="border: 1px solid black;" src="<?= url('assets/uploads/profile-default-img-girl.png') ?>" height="150" width="100" alt="default-dp">
                            </div>
                            <div class="col-md-9">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">User Id:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Name:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Email:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Address:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Phone No:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">NIC:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Details Table of Borrowing Book -->
                </div>
            </form>
        </div>
        <div class="col-lg-6">
            <form id="create-user-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                <div class="input-group">
                    <span class="input-group-text">Search Book</span>
                    <input type="text" class="form-control">
                    <!-- Details Table of Borrowing Book -->
                    <div class="mt-3 m-1">
                        <div class="row">
                            <div class="col-md-3">
                                <img style="border: 1px solid black;" src="<?= url('assets/uploads/default-book-dp.png') ?>" height="150" width="100" alt="default-dp">
                            </div>
                            <div class="col-md-9">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Book Id:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Title:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">ISBN No:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Author:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Catogary:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">Book Status:</span>
                                    <input type="text" class="form-control" size="50">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Details Table of Borrowing Book -->
                </div>
            </form>
        </div>
    </div>
    <form action="">
    <div class="row mt-5">
        <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-text">Issue Date</span>
            <input type="text" class="form-control">
        </div>
        </div>
        <div class="col-lg-4">
        <div class="input-group">
            <span class="input-group-text">Due Date</span>
            <input type="text" class="form-control">
        </div>
        </div>
        <div class="col-lg-2">
        <div class="input-group">
            <button type="button" class="btn btn-dark">Issue Book</button>
        </div>
        </div>
    </div>
    </form>
</div>
</div>



<?php
require_once('../layouts/footer.php');
?>