<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/IssueBook.php';

$issBookModel = new IssueBook();
$issued_books = $issBookModel->getIssDet();
?>

<div class="container">

  <h3 class="mx-3 my-5">Issued Book List</h3>

  <!-- Filter by title and isbn no -->
  <section class="content m-3">
    <div class="mb-3">
      <label for="defaultFormControlInput" class="form-label">Filter Details</label>
      <input type="text" class="form-control" id="filterDetails" placeholder="Filter By {ISBN no, Title, Borrower Name}" aria-describedby="defaultFormControlHelp">
    </div>
    <!-- /Filter by title and isbn no -->
    <div class="card table-responsive">

      <table class="table table-bordered table-dark">
        <thead>
          <tr>
            <th>issued id</th>
            <th>isbn</th>
            <th>Book Title</th>
            <th>user id</th>
            <th>user name</th>
            <th>issued date</th>
            <th>due date</th>
            <th>status</th>
            <th>on-hand books</th>
            <th>option</th>
          </tr>
        </thead>
        <tbody class="table-primary">
          <tr>
            <?php
            foreach ($issued_books as $key => $ib) {
            ?>
              <td><?= $ib['id'] ?></td>
              <td><?= $ib['book_isbn'] ?></td>
              <td><?= $ib['book_title'] ?></td>
              <td><?= $ib['user_id'] ?></td>
              <td><?= $ib['user_name'] ?></td>
              <td class="text-nowrap"><?= $ib['issued_date'] ?></td>
              <td class="text-nowrap"><?= $ib['due_date'] ?></td>
              <td>
                <div>
                  <?php if ($ib['is_recieved'] == 0) { ?>
                    <span class="badge bg-danger">Not Return</span>
                    <a href="return.php?id=<?= $ib['id'] ?>"><button type="button" id="return-book-now" class="btn btn-xs btn-primary mt-2 text-nowrap">RETURN BOOK</button></a>
                  <?php } else { ?>
                    <span class="badge bg-success">Returned</span>
                  <?php } ?>
                </div>
              </td>
              <td><?= $ib['available_books'] ?></td>
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

<?php
require_once('../layouts/footer.php');
?>

<script>
  // Filter issued book by (ISBN NO, TITLE, BORROWER NAME)
  $(document).ready(function() {

    $('#filterDetails').on('input', function() {
      var searchedDetails = $(this).val().toLowerCase();

      $('tbody tr').each(function() {
        var isbn = $(this).find('td:eq(1)').text().toLowerCase();
        var title = $(this).find('td:eq(2)').text().toLowerCase();
        var borrower = $(this).find('td:eq(4)').text().toLowerCase();
        // var issue_date = $(this).find('td:eq(7)').text().toLowerCase();

        if (isbn.includes(searchedDetails) || title.includes(searchedDetails) || borrower.includes(searchedDetails)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });

  });
</script>