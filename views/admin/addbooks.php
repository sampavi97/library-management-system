<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/Book.php';

$bookModel = new Book();
$books = $bookModel->getAll();
?>

<div class="container">
    <h3 class="mx-3 my-4">Add Books</h3>
</div>
<!-- card divider -->
<hr class="m-3">

<!-- Add Book Form -->
<form id="add-book-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
    <input type="hidden" name="action" value="add_book">
    <div class="container row g-2">
        <div class="container col-md-2">
            <!-- Book Image Adding -->
            <div class="form-group">
                <img id="previewImage" src="<?= url('assets/uploads/upload-book.png') ?>" width="140" height="180" />
                <p id="errorMsg"></p>
                <input type="file" id="inputImage" name="book_image" class="form-control" accept="image/*">
            </div>
            <!-- end - Book Image Adding -->
        </div>

        <div class="container col-md-10 float-end">
            <div class="card mb-5">
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text" for="isbn">ISBN</span>
                                <input type="text" name="isbn" id="isbn" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <label class="input-group-text" for="catogary">Catogary</label>
                                <select class="form-select" id="catogary" name="catogary" required>
                                    <option selected>Select catogary</option>
                                    <option value="fiction">Fiction</option>
                                    <option value="non-fiction">Non-fiction</option>
                                    <option value="science">Science</option>
                                    <option value="history">History</option>
                                    <option value="technology">Technology</option>
                                    <option value="philosophy">Philosophy</option>
                                    <option value="thriller">Thriller</option>
                                    <option value="fantasy">Fantasy</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text" for="title">Book Title</span>
                        <input type="text" id="title" name="title" class="form-control" required>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text" for="author">Authors</span>
                                <input type="text" id="author" name="author" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="input-group">
                                <span class="input-group-text" for="publisher">Publishers</span>
                                <input type="text" id="publisher" name="publisher" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text" for="quantity">Quantity</span>
                                <input type="text" id="quantity" name="quantity" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="input-group">
                                <label class="input-group-text" for="book_status">Book Status</label>
                                <select class="form-select" id="book_status" name="book_status" required>
                                    <option value="available">Available</option>
                                    <option value="loaned">Loaned</option>
                                    <option value="lost">Lost</option>
                                    <option value="reserve">Reserve</option>
                                    <option value="not-available">Not Available</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="input-group">
                        <span class="input-group-text" for="bk_desc">Description</span>
                        <textarea class="form-control" id="bk_desc" name="bk_desc" required></textarea>
                    </div>
                </div>


                <div id="additional-fields"></div>
                <div class="mb-3 mt-3">
                    <div id="alert-container-add-book"></div>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-secondary float-end m-1" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="button" id="add-book-now" class="btn btn-dark float-end m-1">Save</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- end Add Book Form -->
<?php
require_once('../layouts/footer.php');
?>

<script>
    // adding book details
    $(document).ready(function() {
        $('#add-book-now').on('click', function() {

            var form = $('#add-book-form')[0];
            $('#add-book-form')[0].reportValidity();

            if (form.checkValidity()) {
                var formData = new FormData($('#add-book-form')[0]);
                var formAction = $('#add-book-form').attr('action');

                $.ajax({
                    url: formAction,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        showAlert(response.message, response.success ? 'primary' : 'danger', 'alert-container-add-book');
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

    const input = document.getElementById('inputImage');
    input.addEventListener('change', (event) => {
        previewImage(event)
    });
</script>