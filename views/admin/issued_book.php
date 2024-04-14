<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/IssueBook.php';

$issBookModel = new IssueBook();
$issued_books = $issBookModel->getAll();
?>

<div class="container">

  <h3 class="mx-3 my-5">Issued Book List</h3>

  <!-- Filter by title and isbn no -->
  <section class="content m-3">
    <div class="mb-3">
      <label for="defaultFormControlInput" class="form-label">Advanced Filter</label>
      <input type="text" class="form-control" id="defaultFormControlInput" placeholder="Advanced Filter" aria-describedby="defaultFormControlHelp">
    </div>
    <!-- /Filter by title and isbn no -->
    <div class="card table-responsive">

      <table class="table table-bordered table-dark">
        <thead>
          <tr>
            <th>#</th>
            <th>isbn</th>
            <th>Book Title</th>
            <th>borrower name</th>
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
            <td><?= ++$key ?></td>
            <td><?= $ib['isbn'] ?></td>
            <td><?= $ib['title'] ?></td>
            <td><?= $ib['username'] ?></td>
            <td><?= $ib['issued_date'] ?></td>
            <td><?= $ib['due_date'] ?></td>
            <td><?= $ib['is_recieved'] ?></td>
            <td><?= $ib['available_books'] ?></td>
              <?php if ($role == 'admin') : ?>
                <td>
                  <div class="btn-group" role="group" aria-label="Second group">
                    <button type="button" class="btn btn-sm btn-secondary edit-book" data-bs-toggle="tooltip" data-bs-original-title="Edit" data-id="<?= $ib['id']; ?>">
                      <i class="tf-icons bx bx-edit ">Edit</i>
                    </button>
                    <!-- <button type="button" class="btn btn-sm btn-danger delete-book" data-bs-toggle="tooltip" data-bs-original-title="Delete" data-id="<?= $b['id']; ?>">
                      <i class="tf-icons bx bx-trash "></i>
                    </button> -->
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