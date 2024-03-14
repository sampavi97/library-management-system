<?php
require_once ('../layouts/header.php');
?>

<div class="container">
    <h3 class="mx-3 my-5">Issue Book</h3>
    <hr class="m-3">
</div>


<div class="container mt-3">
    <div class="row g-2">
        <div class="col-md-6">
            <form id="create-user-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                <div class="input-group">
                    <span class="input-group-text">Search User</span>
                    <input type="text" class="form-control">
                    <!-- Details Table of Book Borrower -->
                    <div class="container">
                        <div class="mt-3">
                            <div class=" row">
                                <div class="col-md-4" >
                                    <img src="<?= url('assets/uploads/profile-default-img-girl.png') ?>" height="150" width="150" alt="default-dp">   
                                </div>
                                <div class="col-md-8">
                                    <table class="table-sm table-border">
                                        <tr><th>user id:</th><td>Albert Cook</td></tr>
                                        <tr><th>user name:</th><td>Albert Cook</td></tr>
                                        <tr><th>email:</th><td>Albert Cook</td></tr>
                                        <tr><th>address:</th><td>Albert Cook</td></tr>
                                        <tr><th>contact no:</th><td>Albert Cook</td></tr>
                                        <tr><th>nic:</th><td>Albert Cook</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Details Table of Book Borrower -->
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <form id="create-user-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                <div class="input-group">
                    <span class="input-group-text">Search Book</span>
                    <input type="text" class="form-control">
                    <!-- Details Table of Borrowing Book -->
                    <div class="container">
                        <div class="mt-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="<?= url('assets/uploads/default-book-dp.png') ?>" height="150" width="150" alt="default-dp">
                                </div>
                                <div class="col-md-8">
                                    <table class="table-sm table-border"> 
                                        <tr><th>book id</th><td>Alb</td></tr>
                                        <tr><th>title</th><td>Alb</td></tr>
                                        <tr><th>isbn no</th><td>Alb</td></tr>
                                        <tr><th>author</th><td>Alb</td></tr>
                                        <tr><th>catogary</th><td>Alb</td></tr>
                                        <tr><th>book status</th><td>Alb</td></tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Details Table of Borrowing Book -->
                </div>
            </form>
        </div>
    </div>
</div>



<?php
require_once ('../layouts/footer.php');
?>