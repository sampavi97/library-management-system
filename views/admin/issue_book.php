<?php
require_once('../layouts/header.php');
require_once __DIR__ . '/../../models/User.php';

$userModel = new User();
$users = $userModel->getAll();

?>

<div class="container">
    <h3 class="mx-3 my-4">Issue Book</h3>
    <hr class="m-3">
</div>

<div class="container mt-1">
    <div class="row g-2">
        <div class="col-lg-6">

            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search user by Name" id="searchUser" name="searchUser">
                <button class="btn btn-dark" for="searchUser" type="button" id="button_searchUser">Search</button>
            </div>
            <!-- Details form of Borrowing Book -->
            <form id="issue-user-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                <div class="mt-3 m-1">
                    <div class="row">
                        <div class="col-md-3">
                            <img style="border: 1px solid black;" src="<?= url('assets/uploads/profile-default-img-girl.png') ?>" height="150" width="100" alt="default-dp">
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" for="id">User Id:</span>
                                <input type="text" class="form-control" id="id" name="id" size="50">
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" for="username">Name:</span>
                                <input type="text" class="form-control" id="username" name="username" size="50">
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" for="nic">NIC:</span>
                                <input type="text" class="form-control" id="nic" name="nic" size="50">
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" for="email">Email:</span>
                                <input type="text" class="form-control" id="email" name="email" size="50">
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" for="contact_num">Contact No:</span>
                                <input type="text" class="form-control" id="contact_num" name="contact_nunm" size="50">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Details Table of Borrowing Book -->
            </form>
        </div>
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search book by Title" id="searchBook" name="searchBook">
                <button class="btn btn-dark" for="searchBook" type="button" id="button-searchBook">Search</button>
            </div>
            <!-- Details Table of Borrowing Book -->
            <form id="issue-book-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                <div class="mt-3 m-1">
                    <div class="row">
                        <div class="col-md-3">
                            <img style="border: 1px solid black;" name="book_image" id="book_image" src="<?= url('assets/uploads/default-book-dp.png') ?>" height="150" width="100" alt="default-dp">
                        </div>
                        <div class="col-md-9">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" for="id">Book Id:</span>
                                <input type="text" class="form-control" id="id" name="id" size="50">
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" for="isbn">ISBN No:</span>
                                <input type="text" class="form-control" id="isbn" name="isbn" size="50">
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" for="title">Title:</span>
                                <input type="text" class="form-control" id="title" name="title" size="50">
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" for="author">Author:</span>
                                <input type="text" class="form-control" id="author" name="author" size="50">
                            </div>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" for="publisher">Publisher:</span>
                                <input type="text" class="form-control" id="publisher" name="publisher" size="50">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Details Table of Borrowing Book -->
            </form>
        </div>
    </div>
    
    <!-- Details of Date of Issueing Books -->
    <form action="">
        <div class="row mt-5">
            <div class="col-lg-4">
                <div class="input-group">
                    <span class="input-group-text" for="iss_date">Issue Date</span>
                    <input type="date" id="iss_date" name="iss_date" class="form-control" placeholder="YYYY-MM-DD">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="input-group">
                    <span class="input-group-text" for="due_date">Due Date</span>
                    <input type="date" id="due_date" name="due_date" class="form-control" placeholder="YYYY-MM-DD">
                </div>
            </div>
            <div class="col-lg-2">
                <div class="input-group">
                    <button type="button" class="btn btn-dark">Issue Book</button>
                </div>
            </div>
        </div>
    </form>
</div>
</div>

<?php
require_once('../layouts/footer.php');
?>

<script>
    $(document).ready(function() {
        $('#button_searchUser').on('click', async function() {
            var user = $('#searchUser').val();
            await getUserByName(user);
        })

        $('#button-searchBook').on('click', async function() {
            var book = $('#searchBook').val();
            await getBookByTitle(book);
        })
    });

    //getting user details by username input
    async function getUserByName(user) {
        $.ajax({
            url: $('#issue-user-form').attr('action'),
            method: 'POST',
            data: {
                user: user,
                action: 'issue_user'
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#issue-user-form #id').val(response.data.id);
                    $('#issue-user-form #username').val(response.data.username);
                    $('#issue-user-form #nic').val(response.data.nic);
                    $('#issue-user-form #email').val(response.data.email);
                    $('#issue-user-form #contact_num').val(response.data.contact_num);
                }
            },
            error: function(error) {
                console.error('Error getting user details:', error);
            },
            complete: function(response) {
                console.log('Request complete:', response);
            }
        });
    }

    //getting book details by title input
    async function getBookByTitle(book) {
        $.ajax({
            url: $('#issue-book-form').attr('action'),
            method: 'POST',
            data: {
                book: book,
                action: 'issue_book'
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#issue-book-form #id').val(response.data.id);
                    $('#issue-book-form #book_image').val(response.data.book_image);
                    $('#issue-book-form #isbn').val(response.data.isbn);
                    $('#issue-book-form #title').val(response.data.title);
                    $('#issue-book-form #author').val(response.data.author);
                    $('#issue-book-form #publisher').val(response.data.publisher);
                }
            },
            error: function(error) {
                console.error('Error getting book details:', error);
            },
            complete: function(response) {
                console.log('Request complete:', response);
            }
        });
    }

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

    const startDateInput = document.getElementById('iss_date');
        const endDateInput = document.getElementById('due_date');

        // Function to calculate end date based on start date
        function calculateEndDate(startDate) {
            const endDate = new Date(startDate);
            endDate.setDate(endDate.getDate() + 14); // Adding 14 days
            return endDate; // Format as YYYY-MM-DD
        }

        // Event listener for change on start date input
        startDateInput.addEventListener('change', function() {
            const startDate = this.value; // Get value of start date input
            const endDate = calculateEndDate(startDate); // Calculate end date
            endDateInput.value = endDate; // Set value of end date input
        });
        
</script>