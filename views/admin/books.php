<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/Book.php';

$bookModel = new Book();
$books = $bookModel->getAll();

?>

<div class="container">

  <h3 class="mx-3 my-5">View All Books
  <button type="button" class="btn btn-sm btn-dark float-end" href="home.php">View Home Books</button>
  </h3>
  <hr class="m-3">

  <!-- Filter Book -->
  <section class="content m-3">
    <div class=" row gy-3 mb-3">
      <!-- Search book by {isbn no, title, author, publisher} -->
      <div class="col-md-7">
        <label for="searchBook" class="form-label">Search Book</label>
        <input type="text" class="form-control" name="searchBook" id="searchBook" placeholder="Search book by {isbn no, title, author, publisher}" aria-describedby="defaultFormControlHelp">
      </div>
      <!-- Filter Book By Catogary -->
      <div class="col-md-5">
        <label for="filterByCatogary" class="form-label">Filter By Catogary</label>
        <select id="filterByCatogary" name="filterByCatogary" class="form-select">
          <option value="selected">Select catogary</option>
          <option value="fiction">Fiction</option>
          <option value="non-fiction">Non-Fiction</option>
          <option value="language">Language</option>
          <option value="science">Science</option>
          <option value="history">History</option>
          <option value="technology">Technology</option>
          <option value="philosophy">Philosophy</option>
          <option value="thriller">Thriller</option>
          <option value="fantasy">Fantasy</option>
        </select>
      </div>
    </div>
    <!-- /Filter Book -->

    <!-- Book Display Table -->
    <div class="card">
      <div class="table-responsive">
        <table class="table table-bordered table-dark">
          <thead>
            <tr>
              <th>#</th>
              <th>book id</th>
              <th>isbn no</th>
              <th>book img</th>
              <th>title</th>
              <th>qty</th>
              <th>available books</th>
              <th>author</th>
              <th>publisher</th>
              <th>catogary</th>
              <th>book status</th>
              <?php if ($role == 'admin') : ?><th>action</th><?php endif; ?>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            <?php
            foreach ($books as $key => $b) {
            ?>
              <tr class="table-primary">
                <td><?= ++$key ?></td>
                <td><?= $b['id'] ?></td>
                <td><?= $b['isbn'] ?></td>
                <td>
                  <?php if (isset($b['book_image']) || !empty($b['book_image'])) : ?>
                    <img src="<?= asset('assets/upload/' . $b['book_image']) ?>" alt="book" class="d-block rounded m-3" width="80">
                  <?php endif; ?>
                </td>
                <td><?= $b['title'] ?></td>
                <td><?= $b['quantity'] ?></td>
                <td><?= $b['available_books'] ?></td>
                <td><?= $b['author'] ?></td>
                <td><?= $b['publisher'] ?></td>
                <td><?= $b['catogary'] ?></td>
                <td><?= $b['book_status'] ?></td>
                <?php if ($role == 'admin') : ?>
                  <td>
                    <div class="btn-group" role="group" aria-label="Second group">
                      <button type="button" class="btn btn-sm btn-secondary edit-book" data-bs-toggle="tooltip" data-bs-original-title="Edit" data-id="<?= $b['id']; ?>">
                        <i class="tf-icons bx bx-edit "></i>
                      </button>
                      <button type="button" class="btn btn-sm btn-danger delete-book" data-bs-toggle="tooltip" data-bs-original-title="Delete" data-id="<?= $b['id']; ?>">
                        <i class="tf-icons bx bx-trash "></i>
                      </button>
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
    <!-- end Book Display Table -->
  </section>
</div>

<!--Update Book Modal -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="edit-book-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="action" value="edit_book">
        <input type="hidden" name="id" id="book_id">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Alter Book Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-1 mb-3">
            <div class="col-md-3 mb-3 mt-4">
              <img class="bk_image" src="<?= url('assets/uploads/upload-book.png') ?>" width="110" height="140" style="border: 2px solid gray;" />
              <button type="button" class="btn btn-sm btn-secondary edit-book-img" data-bs-toggle="tooltip" data-bs-original-title="Edit Image"><i class="tf-icons bx bx-edit "></i></button>
            </div>
            <div class="col-md-9 mb-3 form-group mt-4">
              <div class="row g-1">
                <label class="form-label" for="author">Authors</label>
                <input type="text" id="author" name="author" class="form-control" required>
              </div>
              <div class="row g-1">
                <label class="form-label" for="publisher">Publishers</label>
                <input type="text" id="publisher" name="publisher" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="row g-1 mb-3">
            <label class="form-label" for="title">Book Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
          </div>
          <div class="row g-2 mt-2">
            <div class="col-md-4 mb-3">
              <label class="form-label" for="isbn">ISBN</label>
              <input type="text" id="isbn" name="isbn" class="form-control" required>
            </div>
            <div class="col-md-8 mb-3">
              <label for="catogary" class="form-label">Catogary</label>
              <select id="catogary" name="catogary" class="form-select" required>
                <option selected>Select catogary</option>
                <option value="fiction">Fiction</option>
                <option value="non-fiction">Non-fiction</option>
                <option value="language">Language</option>
                <option value="science">Science</option>
                <option value="history">History</option>
                <option value="technology">Technology</option>
                <option value="philosophy">Philosophy</option>
                <option value="thriller">Thriller</option>
                <option value="fantasy">Fantasy</option>
              </select>
            </div>
          </div>
          <div class="row g-2 mt-2">
            <div class="col-md-3 mb-3">
              <label class="form-label" for="quantity">Quantity</label>
              <input type="text" id="quantity" name="quantity" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
              <label class="form-label" for="available_books">Available Books</label>
              <input type="text" id="available_books" name="available_books" class="form-control" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="book_status" class="form-label">Book Status</label>
              <select id="book_status" name="book_status" class="form-select" required>
                <option value="available">Available</option>
                <option value="loaned">Loaned</option>
                <option value="lost">Lost</option>
                <option value="reserve">Reserve</option>
                <option value="not-available">Not Available</option>
              </select>
            </div>
          </div>
          <div class="row g-1 mb-3">
            <label class="form-label" for="bk_desc">Description</label>
            <textarea id="bk_desc" name="bk_desc" class="form-control" required></textarea>
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
          <button type="button" id="edit-book-now" class="btn btn-dark">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end Update Book Modal -->

<!-- Update Book Image -->
<div class="modal" id="editBookImage" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="edit-book-image" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit_book_img">
                <input type="hidden" name="id" id="book_id">
                <div class="modal-header mt-3">
                    <h5 class="modal-title" id="exampleModalLabel1">Edit Book Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-1 mb-3">
                        <div class="col-md-4 text-center center">
                            <!-- book image -->
                            <img id="previewImage" class="bk_image" src="<?= url('assets/uploads/upload-book.png') ?>" width="110" height="140" style="border: 2px solid gray;" />
                            <p id="errorMsg"></p>
                            <label for="formFile" class="form-label">Change Image</label>
                            <input type="file" id="book_image" name="book_image" value="" class="form-control" accept="image/*" size="50">
                            <input type="hidden" id="oldimage" name="oldimage" value="" class="form-control" accept="image/*">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row g-1 mb-3">
                        <div class="col-md-6"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button></div>
                        <div class="col-md-6"><button type="button" id="edit-img-now" class="btn btn-dark">Save</button></div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Update Book Image -->

<?php
require_once('../layouts/footer.php');
?>

<script>
  $(document).ready(function() {

    $('.edit-book').on('click', async function() {
      var book_id = $(this).data('id');
      await getBookById(book_id);
    })

    $('.edit-book-img').on('click', async function() {
            var book_id = $('#book_id').val();
            await getImgById(book_id);
        })

    $('.delete-book').on('click', async function() {
      var book_id = $(this).data('id');
      var is_confirm = confirm('Are you sure, Do you want to delete?');
      if (is_confirm) await deleteById(book_id);
    })

    $('#edit-book-now').on('click', function() {
      var form = $('#edit-book-form')[0];
      $('#edit-book-form')[0].reportValidity();

      if (form.checkValidity()) {
        var formData = new FormData($('#edit-book-form')[0]);
        var formAction = $('#edit-book-form').attr('action');

        $.ajax({
          url: formAction,
          type: 'POST',
          data: formData,
          dataType: 'json',
          contentType: false,
          processData: false,
          success: function(response) {
            showAlert(response.message, response.success ? 'primary' : 'danger', 'alert-container-edit-book');
            if (response.success) {
              $('#editBookModal').modal('hide');
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

    $('#edit-img-now').on('click', function() {
            var form = $('#edit-book-image')[0];
            $('#edit-book-image')[0].reportValidity();

            if (form.checkValidity()) {
                var formData = new FormData($('#edit-book-image')[0]);
                var formAction = $('#edit-book-image').attr('action');

                $.ajax({
                    url: formAction,
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {;
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
  });

  async function getImgById(id) {
        var formAction = $('#edit-book-image').attr('action');

        $.ajax({
            url: formAction,
            type: 'GET',
            data: {
                book_id: id,
                action: 'get_book'
            },
            dataType: 'json',
            success: function(response) {
                showAlert(response.message, response.success ? 'primary' : 'danger');
                if (response.success) {
                    var book_id = response.data.id;
                    var book_image = response.data.book_image;
                    var imageBaseUrl = '../../assets/upload/';
                    var adjustedUrl = imageBaseUrl + book_image;

                    $('#editBookImage #book_id').val(book_id);
                    $('#editBookImage .bk_image').attr('src', adjustedUrl);
                    $('#editBookImage').modal('show');
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

  async function getBookById(id) {
    var formAction = $('#edit-book-form').attr('action');

    $.ajax({
      url: formAction,
      type: 'GET',
      data: {
        book_id: id,
        action: 'get_book'
      },
      dataType: 'json',
      success: function(response) {
        showAlert(response.message, response.success ? 'primary' : 'danger');
        if (response.success) {
          var book_id = response.data.id;
          var title = response.data.title;
          var isbn = response.data.isbn;
          var author = response.data.author;
          var publisher = response.data.publisher;
          var catogary = response.data.catogary;
          var quantity = response.data.quantity;
          var available_books = response.data.available_books;
          var book_status = response.data.book_status;
          var bk_desc = response.data.bk_desc;
          var book_image = response.data.book_image;

          var imageBaseUrl = '../../assets/upload/';
          var adjustedUrl = imageBaseUrl + book_image;

          $('#editBookModal #book_id').val(book_id);
          $('#editBookModal #title').val(title);
          $('#editBookModal #isbn').val(isbn);
          $('#editBookModal #author').val(author);
          $('#editBookModal #publisher').val(publisher);
          $('#editBookModal #catogary option[value="' + catogary + '"]').prop('selected', true);
          $('#editBookModal #quantity').val(quantity);
          $('#editBookModal #available_books').val(available_books);
          $('#editBookModal #book_status option[value="' + book_status + '"]').prop('selected', true);
          $('#editBookModal #bk_desc').val(bk_desc);
          
          // display uploaded image of book while clicking edit button
          $('#editBookModal .bk_image').attr('src', adjustedUrl);
          $('#editBookModal').modal('show');
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
    var formAction = $('#edit-book-form').attr('action');

    $.ajax({
      url: formAction,
      type: 'GET',
      data: {
        book_id: id,
        action: 'delete_book',
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

  // filter book with various catogaries 
  $(document).ready(function() {
    $('#filterByCatogary').change(function() {
      var selectedCat = $(this).val();

      $('tbody tr').filter(function() {
        var cat = $(this).find('td:eq(9)').text();

        if (selectedCat === 'selected' || cat === selectedCat) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });
  });

  //filter book by isbn, title, author, publisher
  $(document).ready(function() {
    $('#searchBook').on('input', function() {
      var searchedBook = $(this).val().toLowerCase();

      $('tbody tr').each(function() {
        var book_id = $(this).find('td:eq(1)').text().toLowerCase();
        var isbn = $(this).find('td:eq(2)').text().toLowerCase();
        var title = $(this).find('td:eq(4)').text().toLowerCase();
        var author = $(this).find('td:eq(7)').text().toLowerCase();
        var publisher = $(this).find('td:eq(8)').text().toLowerCase();

        if (book_id.includes(searchedBook) || isbn.includes(searchedBook) || title.includes(searchedBook) || author.includes(searchedBook) || publisher.includes(searchedBook)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });
  });

  // preview book image after uploaded
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

    const input = document.getElementById('book_image');
    input.addEventListener('change', (event) => {
        previewImage(event)
    });
    
</script>