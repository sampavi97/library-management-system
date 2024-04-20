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

  <!-- Filter by title and isbn no -->
  <section class="content m-3">
  
  </section>

  <div class="card table-responsive">
    <table class="table table-bordered table-dark">
      <thead>
        <tr>
          <th>#</th>
          <th>issued id</th>
          <th>isbn</th>
          <th>title</th>
          <th>user id</th>
          <th>user name</th>
          <th>issued date</th>
          <th>due date</th>
          <th>recieved date</th>
          <th>fine</th>
          <th>fine paid</th>
          <th>action</th>
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
            <td><?= $rb['rb_title'] ?></td>
            <td><?= $rb['borrower_id'] ?></td>
            <td><?= $rb['borrower_name'] ?></td>
            <td class="text-nowrap"><?= $rb['issued_date'] ?></td>
            <td class="text-nowrap"><?= $rb['due_date'] ?></td>
            <td class="text-nowrap"><?= $rb['returned_date'] ?></td>
            <td><?= $rb['fine'] ?></td>
            <td>
              <div>
                <?php if ($rb['fine'] != 0) {?>
                <?php if ($rb['fine_paid'] == 0) { ?>
                  <span class="badge bg-danger">Not Paid</span>
                <?php } else { ?>
                  <span class="badge bg-success">Paid</span>
                <?php } ?>
                <?php } else { ?>
                  <span class="badge bg-primary">No Fine</span>
                  <?php } ?>
              </div>
            </td>
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
</div>

<?php
require_once('../layouts/footer.php');
?>

<script>
  // $(document).ready(function() {
  //   $('#searchBook').on('input', function() {
  //     var searchedBook = $(this).val().toLowerCase();

  //     $('.notRetBook').each(function() {
  //       // $(this).find('input:nth-of-type(1)') targets the first input element inside each .display-book, which corresponds to the book title.
  //       // input:nth-of-type(1) is a CSS selector that selects the first <input> element among its siblings of the same type within its parent element.
  //       var title = $(this).find('input:nth-of-type(1)').val().toLowerCase();
  //       var isbn = $(this).find('input:nth-of-type(2)').val().toLowerCase();

  //       if (title.includes(searchedBook) || isbn.includes(searchedBook)) {
  //         $(this).show();
  //       } else {
  //         $(this).hide();
  //       }
  //     });
  //   });
  // });
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