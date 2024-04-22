<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/IssueBook.php';
require_once __DIR__ . '/../../models/ReturnBook.php';

// $issBookModel = new IssueBook();
// $nrIssBook = $issBookModel->getNotRetIss();
$bookModel = new ReturnBook();
$retBookDetails = $bookModel->getRetDet();
?>

<div class="container">

  <h3 class="mx-3 my-5">Recieved Books</h3>
  <div class="row mb-3">
    <div class="col-md-7">
      <label for="defaultFormControlInput" class="form-label">Filter Details</label>
      <input type="text" class="form-control" id="filterDetails1" placeholder="Filter By {Issued Id, ISBN, user Id}" aria-describedby="defaultFormControlHelp">
    </div>
    <div class="col-md-5">
      <label for="defaultFormControlInput" class="form-label">Filter By Date</label>
      <input type="text" class="form-control" id="filterDetails2" placeholder="Filter By {Issued, Returned Date}" aria-describedby="defaultFormControlHelp">
    </div>
  </div>
  <section class="content m-3">

  </section>

  <div class="card table-responsive">
    <table class="table table-bordered table-dark">
      <thead>
        <tr>
          <th>#</th>
          <th>issued id</th>
          <th>isbn</th>
          <th>user id</th>
          <th>issued date</th>
          <th>due date</th>
          <th>recieved date</th>
          <th>fine</th>
          <th>fine paid</th>
        </tr>
      </thead>
      <tbody class="table-primary">
        <?php
        foreach ($retBookDetails as $key => $rb) {
        ?>
          <tr>
            <td><?= ++$key ?></td>
            <td><?= $rb['borrowed_id'] ?></td>
            <td><?= $rb['rb_isbn'] ?></td>
            <td><?= $rb['borrower_id'] ?></td>
            <td class="text-nowrap"><?= $rb['issued_date'] ?></td>
            <td class="text-nowrap"><?= $rb['due_date'] ?></td>
            <td class="text-nowrap"><?= $rb['returned_date'] ?></td>
            <td><?= $rb['fine'] ?></td>
            <td>
              <div>
                <?php if ($rb['fine'] != 0) { ?>
                  <?php if ($rb['fine_paid'] == 0) { ?>
                    <span class="badge bg-danger">Not Paid</span>
                    <button type="button" data-id="<?= $rb['id']; ?>" class="btn btn-xs btn-primary mt-2 text-nowrap edit-book">PAY FINE</button>
                  <?php } else { ?>
                    <span class="badge bg-success">Paid</span>
                  <?php } ?>
                <?php } else { ?>
                  <span class="badge bg-dark">No Fine</span>
                <?php } ?>
              </div>
            </td>
          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<!--Update Book Modal -->
<div class="modal fade" id="editBookModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form id="edit-book-form" action="<?= url('services/ajax_functions.php') ?>" autocomplete="off" enctype="multipart/form-data">
        <input type="hidden" name="action" value="edit_ret">
        <input type="hidden" name="id" id="returned_id">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel1">Alter Book Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3 row">
            <label for="borrowed_id" class="col-md-3 col-form-label">Issued ID</label>
            <div class="col-md-9">
              <input class="form-control" name="borrowed_id" type="text" id="borrowed_id" readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="due_date" class="col-md-3 col-form-label">Due Date</label>
            <div class="col-md-9">
              <input class="form-control" name="due_date" type="text" id="due_date" readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="returned_date" class="col-md-3 col-form-label text-nowrap">Returned Date</label>
            <div class="col-md-9">
              <input class="form-control" name="returned_date" type="text" id="returned_date" readonly>
            </div>
          </div>
          <div class="mb-3 row">
            <label for="fine" class="col-md-3 col-form-label">Fine</label>
            <div class="col-md-9">
              <input class="form-control" name="fine" type="text" id="fine" readonly>
            </div>
          </div>
          <div class="mt-3 row">
            <label for="fine_paid" class="col-md-3 col-form-label">Pay Fine</label>
            <div class="col-md-9 mt-2">
              <div class="row">
                <div class="col-md-1">
                  <input style="border: 1px solid gray;" class="form-check-input" type="checkbox" id="fine_paid_checkbox">
                </div>
                <div class="col-md-4">
                  <p id="paidMsg" style="display: none; color:darkslateblue; font-size:large">Fine Paid</p>
                </div>
                <input class="form-control" name="fine_paid" id="fine_paid" type="hidden">
              </div>
            </div>
          </div>
        </div>
        <div id="additional-fields"></div>
        <div class="mb-3 mt-3">
          <div id="alert-container-edit-returned-form"></div>
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
  document.getElementById("fine_paid_checkbox").addEventListener("change", function() {
    var message = document.getElementById("paidMsg");
    var is_paid = document.getElementById("fine_paid");
    if (this.checked) {
      is_paid.value = "1";
      paidMsg.style.display = "block";

    } else {
      is_paid.value = "0";
      paidMsg.style.display = "none";
    }
  });

  $(document).ready(function() {
    // Filter issued book by (ISBN NO, TITLE, BORROWER NAME)
    $('#filterDetails1').on('input', function() {
      var searchedDetails = $(this).val().toLowerCase();

      $('tbody tr').each(function() {
        var isbn = $(this).find('td:eq(2)').text().toLowerCase();
        var issued_id = $(this).find('td:eq(1)').text().toLowerCase();
        var user_id = $(this).find('td:eq(3)').text().toLowerCase();

        if (isbn.includes(searchedDetails) || issued_id.includes(searchedDetails) || user_id.includes(searchedDetails)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });

    //filter by issued and recieved date
    $('#filterDetails2').on('input', function() {
      var searchedDetails = $(this).val().toLowerCase();

      $('tbody tr').each(function() {
        var issue_date = $(this).find('td:eq(4)').text().toLowerCase();
        var recieved_date = $(this).find('td:eq(6)').text().toLowerCase();

        if (issue_date.includes(searchedDetails) || recieved_date.includes(searchedDetails)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });

    $('.edit-book').on('click', async function() {
      var returned_id = $(this).data('id');
      await getBookById(returned_id);
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
            showAlert(response.message, response.success ? 'primary' : 'danger', 'alert-container-edit-returned-form');
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
        returned_id: id,
        action: 'get_ret'
      },
      dataType: 'json',
      success: function(response) {
        showAlert(response.message, response.success ? 'primary' : 'danger');
        if (response.success) {
          var returned_id = response.data.id;
          var borrowed_id = response.data.borrowed_id;
          var due_date = response.data.due_date;
          var returned_date = response.data.returned_date;
          var fine = response.data.fine;
          var fine_paid = response.data.fine_paid;

          $('#editBookModal #returned_id').val(returned_id);
          $('#editBookModal #borrowed_id').val(borrowed_id);
          $('#editBookModal #due_date').val(due_date);
          $('#editBookModal #returned_date').val(returned_date);
          $('#editBookModal #fine').val(fine);
          $('#editBookModal #fine_paid').val(fine_paid);
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
</script>