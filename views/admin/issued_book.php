<?php
require_once('../layouts/header.php');
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
            <th>borrower name</th>
            <th>issued date</th>
            <th>due date</th>
            <th>action</th>
            <th>recieved date</th>
            <th>fine</th>
            <th>fine paid</th>
            <th>option</th>
          </tr>
        </thead>
        <tbody class="table-primary">
          <tr>
            <!-- <td>
                tooltip 
                <button type="button" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="top" data-bs-html="true" title="" data-bs-original-title="<i class='bx bx-bell bx-xs' ></i> <span>Tooltip on top</span>">
                    Top
                    </button>
                tooltip
                <div class="btn-group" role="group" aria-label="Second group">
                    <button type="button" class="btn btn-sm btn-secondary">
                        <i class="tf-icons bx bx-edit "></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger">
                        <i class="tf-icons bx bx-trash "></i>
                    </button>
                </div>
            </td> -->
          </tr>



        </tbody>
      </table>

    </div>
</div>

<?php
require_once('../layouts/footer.php');
?>