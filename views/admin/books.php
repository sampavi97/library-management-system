<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/Book.php';

$bookModel = new Book();
$books = $bookModel->getAll();

?>

<div class="container">

  <h3 class="mx-3 my-5">View All Books</h3>

  <!-- Filter by title and isbn no -->
  <section class="content m-3">
    <div class=" row gy-3 mb-3">
      <div class="col-md-7">
        <label for="defaultFormControlInput" class="form-label">Filter by book title</label>
        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Advanced Filter" aria-describedby="defaultFormControlHelp">
      </div>
      <div class="col-md-5">
        <label for="defaultFormControlInput" class="form-label">Filter by isbn no</label>
        <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Advanced Filter" aria-describedby="defaultFormControlHelp">
      </div>
    </div>
    <!-- /Filter by title and isbn no -->
    <!-- Book Display Table -->
    <div class="card">
      <table class="table table-bordered table-dark">
        <thead>
          <tr>
            <th>#</th>
            <th>qty</th>
            <th>isbn no</th>
            <th>title</th>
            <th>author</th>
            <th>catogary</th>
            <th>book status</th>
            <th>action</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          <?php
          foreach ($books as $key => $b) {
          ?>
            <tr class="table-primary">
              <td><?= ++$key ?></td>
              <td><?= $b['quantity'] ?></td>
              <td><?= $b['isbn'] ?></td>
              <td><?= $b['title'] ?></td>
              <td><?= $b['author'] ?></td>
              <td><?= $b['catogary'] ?></td>
              <td><?= $b['book_status'] ?></td>
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
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
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
              </select>
            </div>
          </div>
          <div class="row g-2 mt-2">
            <div class="col mb-3">
              <label class="form-label" for="author">Authors</label>
              <input type="text" id="author" name="author" class="form-control" required>
            </div>
            <!-- <div class="col mb-3">
              <label class="form-label" for="publisher">Publishers</label>
              <input type="text" id="publisher" name="publisher" class="form-control" required>
            </div> -->
          </div>
          <div class="row g-2 mt-2">
            <div class="col-md-4 mb-3">
              <label class="form-label" for="quantity">Quantity</label>
              <input type="text" id="quantity" name="quantity" class="form-control" required>
            </div>
            <div class="col-md-8 mb-3">
              <label for="book_status" class="form-label">Book Status</label>
              <select id="book_status" name="book_status" class="form-select" required>
                <option value="available">Available</option>
                <option value="loaned">Loaned</option>
                <option value="lost">Lost</option>
                <option value="reserve">Reserve</option>
              </select>
            </div>
          </div>
          <!-- <div class="row g-1 mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
          </div> -->

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

<?php
require_once('../layouts/footer.php');
?>

<script>
  $(document).ready(function() {

    $('.edit-book').on('click', async function() {
      var book_id = $(this).data('id');
      await getBookById(book_id);
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
        var formData = $('#edit-book-form').serialize();
        var formAction = $('#edit-book-form').attr('action');

        $.ajax({
          url: formAction,
          type: 'POST',
          data: formData,
          dataType: 'json',
          // contentType: false,
          // processData: false,
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

  });

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
          var catogary = response.data.catogary;
          var quantity = response.data.quantity;
          var book_status = response.data.book_status;

          $('#editBookModal #book_id').val(book_id);
          $('#editBookModal #title').val(title);
          $('#editBookModal #isbn').val(isbn);
          $('#editBookModal #author').val(author);
          $('#editBookModal #catogary').val(catogary);
          $('#editBookModal #quantity').val(quantity);
          $('#editBookModal #book_status').val(book_status);
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
</script>