<?php
require_once ('../layouts/header.php');
?>

<div class="container">

    <h3 class="mx-3 my-5">Admin
        <!-- Button trigger modal -->
    </h3>

    <section class="content m-3">
        <div class="card">

            <div class="table-responsive text-nowrap">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>admin name</th>
                            <th>email</th>
                            <th>photo</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<?php
// publisher VARCHAR(30) NOT NULL, bk_description MEDIUMTEXT NOT NULL;
require_once ('../layouts/footer.php');
?>