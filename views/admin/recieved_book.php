<?php
require_once ('../layouts/header.php');
?>

<div class="container">

  <h3 class="mx-3 my-5">Recieved Book List</h3>

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
            <th>title</th>
            <th>user id</th>
            <th>user name</th>
            <th>issued by</th>
            <th>issued date</th>
            <th>due date</th>
            <th>recieved date</th>
            <th>fine</th> 
          </tr>
        </thead>
        <tbody class="table-primary">
          <tr>
          </tr>
        </tbody>
      </table>

    </div>
</div>

<?php
require_once ('../layouts/footer.php');
?>