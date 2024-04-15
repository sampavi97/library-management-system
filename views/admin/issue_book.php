<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/IssueBook.php';
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../models/Book.php';

$issBookModel = new IssueBook();
$issbook = $issBookModel->getAll();

$userModel = new User();
$bookModel = new Book();

$users = $_SESSION['users'] ?? null;
$books = $_SESSION['books'] ?? null;

if (isset($_POST['submitBook'])) {
    $book = $_POST['book'];
    $books = $bookModel->getByBookTitle($book);
    $_SESSION['books'] = $books;

    if (!$books) {
        $bookNotFound = true;
    }
}

if (isset($_POST['submitUser'])) {
    $borrower = $_POST['user'];
    $users = $userModel->getByUsername($borrower);
    $_SESSION['users'] = $users;

    if (!$users) {
        $userNotFound = true;
    }
}
?>

<div class="container">
    <h3 class="mx-3 my-4">Issue Book</h3>
</div>
<hr class="m-3">

<div class="container mt-1">
    <form method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" size="50" id="user" name="user">
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="search user" name="submitUser" class="btn btn-outline-secondary">
                    </div>
                </div>
                <!-- No User Found Alert -->
                <?php if (isset($userNotFound) && $userNotFound) : ?>
                    <div class="alert alert-danger mt-2" role="alert">
                        No such user found.
                    </div>
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" class="form-control" size="50" id="book" name="book">
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="search book" name="submitBook" class="btn btn-outline-secondary">
                    </div>
                </div>

                <!-- No Book Found Alert -->
                <?php if (isset($bookNotFound) && $bookNotFound) : ?>
                    <div class="alert alert-danger mt-2" role="alert">
                        No such book found.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <form id="issue-book-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="issue_form">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3 mt-3">
                        <?php if ($users && isset($users['user_image'])) : ?>
                            <img style="border: 1px solid black;" id="user_image" src="<?php echo '../../assets/upload/' . $users['user_image']; ?>" height="150" width="100" alt="User Image">
                        <?php else : ?>
                            <img style="border: 1px solid black;" id="book_image" src="<?= url('assets/uploads/upload-book.png') ?>" height="150" width="100" alt="book Image">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-9 mt-3">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" for="id">User Id:</span>
                            <input type="text" class="form-control" id="user_id" name="user_id" size="50" value="<?php echo isset($users['id']) ? $users['id'] : ''; ?>" readonly>
                        </div>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" for="username">Name:</span>
                            <input type="text" class="form-control" id="username" name="username" size="50" value="<?php echo isset($users['username']) ? $users['username'] : ''; ?>" readonly>
                        </div>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" for="nic">NIC:</span>
                            <input type="text" class="form-control" id="nic" name="nic" size="50" value="<?php echo isset($users['nic']) ? $users['nic'] : ''; ?>" readonly>
                        </div>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" for="email">Email:</span>
                            <input type="text" class="form-control" id="email" name="email" size="50" value="<?php echo isset($users['email']) ? $users['email'] : ''; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-3 mt-3">
                        <?php if ($books && isset($books['book_image'])) : ?>
                            <img style="border: 1px solid black;" id="book_image" src="<?php echo '../../assets/upload/' . $books['book_image']; ?>" height="150" width="100" alt="book Image">
                        <?php else : ?>
                            <img style="border: 1px solid black;" id="book_image" src="<?= url('assets/uploads/upload-book.png') ?>" height="150" width="100" alt="book Image">
                        <?php endif; ?>
                    </div>

                    <div class="col-md-9 mt-3">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" for="id">Book Id:</span>
                            <input type="text" class="form-control" id="book_id" name="book_id" size="50" value="<?php echo isset($books['id']) ? $books['id'] : ''; ?>" readonly>
                        </div>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" for="username">Title:</span>
                            <input type="text" class="form-control" id="title" name="title" size="50" value="<?php echo isset($books['title']) ? $books['title'] : ''; ?>" readonly>
                        </div>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" for="nic">ISBN:</span>
                            <input type="text" class="form-control" id="isbn" name="isbn" size="50" value="<?php echo isset($books['isbn']) ? $books['isbn'] : ''; ?>" readonly>
                        </div>
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" for="available_books">Available Books:</span>
                            <input type="text" class="form-control" id="available_books" name="available_books" size="50" value="<?php echo isset($books['available_books']) ? $books['available_books'] : ''; ?>" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="additional-fields"></div>
            <div class="mb-3 mt-3">
                <div id="alert-container-issue-book"></div>
            </div>
        </div>
        <div class="mb-3 row mt-4">
            <div class="col-md-4 mt-3">
                <label for="html5-date-input" class="col-form-label" for="issue_date">Issue Date</label>
                <div class="col-md-10">
                    <input class="form-control" type="date" placeholder="yyyy-mm-dd" name="issued_date" id="issued_date">
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <label for="html5-date-input" class="col-form-label" for="due_date">Due Date</label>
                <div class="col-md-10">
                    <input class="form-control" type="date" placeholder="yyyy-mm-dd" name="due_date" id="due_date">
                </div>
            </div>
            <div class="col-md-2 mt-5">
                <button type="button" id="issue-book-now" class="btn btn-dark">Issue Book</button>
            </div>
        </div>
    </form>
</div>


<?php
require_once('../layouts/footer.php');
?>

<script>
    $(document).ready(function() {
        $('#issue-book-now').on('click', function() {

            var form = $('#issue-book-form')[0];
            $('#issue-book-form')[0].reportValidity();

            if (form.checkValidity()) {
                var formData = new FormData($('#issue-book-form')[0]);
                var formAction = $('#issue-book-form').attr('action');

                $.ajax({
                    url: formAction,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        showAlert(response.message, response.success ? 'primary' : 'danger', 'alert-container-issue-book');
                        if (response.success) {
                            setTimeout(function() {
                                location.reload();
                                //session_reset();
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