<?php
require_once '../config.php';
require_once '../helpers/AppManager.php';
require_once '../models/Book.php';
require_once '../models/User.php';
require_once '../models/IssueBook.php';
require_once '../models/ReturnBook.php';

$target_dir = "../assets/upload/";

// CRUD Operations for User
//ADD USER
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_user') {

    try {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $contact_num = $_POST['contact_num'];
        $nic = $_POST['nic'];
        $role = $_POST['role'];
        //add user image
        $image = $_FILES["user_image"];
        $imageFileName = null;

        //check if file is uploaded
        if (isset($image) && !empty($image)) {
            //check if there are errors
            if ($image["error"] > 0) {
                echo "Error uploading file: " . $image["error"];
            } else {
                //check if file is an image
                if (getimagesize($image["tmp_name"]) !== false) {
                    //Check file size
                    if ($image["size"] < 500000) { //500kb limit
                        //Generate unique filename
                        $new_filename = uniqid() . "." . pathinfo($image["name"])["extension"];

                        //Move uploaded file to target directory
                        if (move_uploaded_file($image["tmp_name"], $target_dir . $new_filename)) {
                            $imageFileName = $new_filename;
                        } else {
                            echo json_encode(['success' => false, 'message' => "Error moving uploaded file."]);
                            exit;
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => "File size is too large."]);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => "Uploaded file is not an image."]);
                    exit;
                }
            }
        }

        $userModel = new User();
        $created = $userModel->addUser($username, $address, $contact_num, $nic, $role, $email, $password, $imageFileName);

        if ($created) {
            echo json_encode(['success' => true, 'message' => "User created successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to create user. May be user already exist!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Get User By Id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_id']) && isset($_GET['action']) && $_GET['action'] == 'get_user') {

    try {
        $user_id = $_GET['user_id'];
        $userModel = new User();
        $user = $userModel->getById($user_id);
        if ($user) {
            echo json_encode(['success' => true, 'message' => "User created successfully!", 'data' => $user]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create user. May be user already exist!']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Delete By User Id
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['user_id']) && isset($_GET['action']) &&  $_GET['action'] == 'delete_user') {

    try {
        $user_id = $_GET['user_id'];
        $userModel = new User();
        $deleted = $userModel->deleteUser($user_id);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => "User deleted successfully!", 'data' => $deleted]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete user.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Update User Details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_user') {
    try {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'] == 'member' ? 'member' : 'admin';
        $contact_num = $_POST['contact_num'];
        $nic = $_POST['nic'];
        $address = $_POST['address'];

        $id = $_POST['id'];

        if (empty($username) || empty($email)) {
            echo json_encode(['success' => false, 'message' => "Required fields are missing!"]);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => "Invalid email address"]);
            exit;
        }

        $userModel = new User();
        $updated = $userModel->updateUser($id, $username, $address, $contact_num, $nic, $role, $email);
        if ($updated) {
            echo json_encode(['success' => true, 'message' => "User updated successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to update user. May be user already exist!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Update User Password
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_pwd') {
    try {
        $password = $_POST['password'];

        $id = $_POST['id'];

        $userModel = new User();
        $updated = $userModel->updatePassword($id, $password);
        if ($updated) {
            echo json_encode(['success' => true, 'message' => "Password changed successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to change password!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}
//Update User Image
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_user_img') {
    try {
        $id = $_POST['id'];

        $image = $_FILES["user_image"];
        $oldimage = $_POST['oldimage'];
        $imageFileName = null;

        if (!empty($image)) {
            $update_filename = $_FILES["user_image"];
        } else {
            $update_filename = $oldimage;
        }

        //check if file is uploaded
        if (isset($update_filename) && !empty($update_filename)) {
            //check if there are errors
            if ($update_filename["error"] > 0) {
                echo "Error uploading file: " . $update_filename["error"];
            } else {
                //check if file is an image
                if (getimagesize($update_filename["tmp_name"]) !== false) {
                    //Check file size
                    if ($update_filename["size"] < 500000) { //500kb limit
                        //Generate unique filename
                        $new_filename = uniqid() . "." . pathinfo($update_filename["name"])["extension"];

                        //Move uploaded file to target directory
                        if (move_uploaded_file($update_filename["tmp_name"], $target_dir . $new_filename)) {
                            $imageFileName = $new_filename;
                        } else {
                            echo json_encode(['success' => false, 'message' => "Error moving uploaded file."]);
                            exit;
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => "File size is too large."]);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => "Uploaded file is not an image."]);
                    exit;
                }
            }
        }

        $userModel = new User();
        $updated = $userModel->updateUserImage($id, $imageFileName);
        if ($updated) {
            echo json_encode(['success' => true, 'message' => "User updated successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to update user. May be user already exist!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}


// CRUD Operations for Book
//add book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_book') {

    try {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $catogary = $_POST['catogary'];
        $isbn = $_POST['isbn'];
        $quantity = $_POST['quantity'];
        $book_status = $_POST['book_status'];
        $bk_desc = $_POST['bk_desc'];
        $available_books = $_POST['quantity'];
        //add book image
        $image = $_FILES["book_image"];
        $imageFileName = null;

        // Check if file is uploaded
        if (isset($image) && !empty($image)) {
            // Check if there are errors
            if ($image["error"] > 0) {
                echo "Error uploading file: " . $image["error"];
            } else {
                // Check if file is an image
                if (getimagesize($image["tmp_name"]) !== false) {
                    // Check file size (optional)
                    if ($image["size"] < 500000) { // 500kb limit
                        // Generate unique filename
                        $new_filename = uniqid() . "." . pathinfo($image["name"])["extension"];

                        // Move uploaded file to target directory
                        if (move_uploaded_file($image["tmp_name"], $target_dir . $new_filename)) {
                            $imageFileName = $new_filename;
                        } else {
                            echo json_encode(['success' => false, 'message' => "Error moving uploaded file."]);
                            exit;
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => "File size is too large."]);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => "Uploaded file is not an image."]);
                    exit;
                }
            }
        }

        $bookModel = new Book();
        $created = $bookModel->addBook($title, $author, $publisher, $catogary, $isbn, $quantity, $book_status, $bk_desc, $imageFileName, $available_books);

        if ($created) {
            echo json_encode(['success' => true, 'message' => "Book created successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to create book. May be book already exist!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Get book By Id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['book_id']) && isset($_GET['action']) && $_GET['action'] == 'get_book') {

    try {
        $book_id = $_GET['book_id'];
        $bookModel = new Book();
        $book = $bookModel->getById($book_id);
        if ($book) {
            echo json_encode(['success' => true, 'message' => "Book created successfully!", 'data' => $book]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to create book. May be book already exist!']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Delete book by Id
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['book_id']) && isset($_GET['action']) &&  $_GET['action'] == 'delete_book') {

    try {
        $book_id = $_GET['book_id'];
        $bookModel = new Book();
        $deleted = $bookModel->deleteBook($book_id);

        if ($deleted) {
            echo json_encode(['success' => true, 'message' => "Book deleted successfully!", 'data' => $deleted]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete book.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

// Update book details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_book') {
    try {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $catogary = $_POST['catogary'];
        $isbn = $_POST['isbn'];
        $quantity = $_POST['quantity'];
        $book_status = $_POST['book_status'];
        $bk_desc = $_POST['bk_desc'];
        $available_books = $_POST['available_books'];

        $id = $_POST['id'];

        if (empty($title) || empty($isbn)) {
            echo json_encode(['success' => false, 'message' => "Required fields are missing!"]);
            exit;
        }

        $bookModel = new Book();
        $updated = $bookModel->updateBook($id,$title,$author,$publisher,$catogary,$isbn,$quantity,$book_status,$bk_desc,$available_books);
        if ($updated) {
            echo json_encode(['success' => true, 'message' => "Book updated successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to update book. May be book already exist!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

// Update Book Image
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_book_img') {
    try {
        $id = $_POST['id'];

        $image = $_FILES["book_image"];
        $oldimage = $_POST['oldimage'];
        $imageFileName = null;

        if (!empty($image)) {
            $update_filename = $_FILES["book_image"];
        } else {
            $update_filename = $oldimage;
        }

        // Check if file is uploaded
        if (isset($update_filename) && !empty($update_filename)) {
            // Check if there are errors
            if ($update_filename["error"] > 0) {
                echo "Error uploading file: " . $update_filename["error"];
            } else {
                // Check if file is an image
                if (getimagesize($update_filename["tmp_name"]) !== false) {
                    // Check file size (optional)
                    if ($update_filename["size"] < 500000) { // 500kb limit
                        // Generate unique filename
                        $new_filename = uniqid() . "." . pathinfo($update_filename["name"])["extension"];

                        // Move uploaded file to target directory
                        if (move_uploaded_file($update_filename["tmp_name"], $target_dir . $new_filename)) {
                            $imageFileName = $new_filename;
                        } else {
                            echo json_encode(['success' => false, 'message' => "Error moving uploaded file."]);
                            exit;
                        }
                    } else {
                        echo json_encode(['success' => false, 'message' => "File size is too large."]);
                        exit;
                    }
                } else {
                    echo json_encode(['success' => false, 'message' => "Uploaded file is not an image."]);
                    exit;
                }
            }
        }

        $bookModel = new Book();
        $updated = $bookModel->updateBookImage($id,$imageFileName);
        if ($updated) {
            echo json_encode(['success' => true, 'message' => "Book updated successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to update book. May be book already exist!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//issue book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'issue_form') {

    try {
        $book_id = $_POST['book_id'];
        $user_id = $_POST['user_id'];
        $issued_date = $_POST['issued_date'];
        $due_date = $_POST['due_date'];

        $issbookModel = new IssueBook();
        $created = $issbookModel->addIssBook($book_id, $user_id, $issued_date, $due_date, $is_recieved = 0);

        if ($created) {
            echo json_encode(['success' => true, 'message' => "Book Issued successfully!"]);
            
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to issue book!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//return book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'return_form') {

    try {
        $borrowed_id = $_POST['borrowed_id'];
        $due_date = $_POST['due_date'];
        $returned_date = $_POST['returned_date'];
        $fine = $_POST['fine'];
        $fine_paid = $_POST['fine_paid'];

        $retbookModel = new ReturnBook();
        $returned = $retbookModel->addRetBook($borrowed_id, $due_date, $returned_date, $fine, $fine_paid);

        if ($returned) {
            echo json_encode(['success' => true, 'message' => "Book Returned successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to return book!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

//Get returned book By Id
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['returned_id']) && isset($_GET['action']) && $_GET['action'] == 'get_ret') {

    try {
        $returned_id = $_GET['returned_id'];
        $bookModel = new ReturnBook();
        $book = $bookModel->getById($returned_id);
        if ($book) {
            echo json_encode(['success' => true, 'message' => "Book data returned successfully!", 'data' => $book]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to update book!']);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}

// Update returned book details
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_ret') {
    try {
        $fine_paid = $_POST['fine_paid'];
        $id = $_POST['id'];

        $bookModel = new ReturnBook();
        $updated = $bookModel->updateRetBook($id,$fine_paid);
        if ($updated) {
            echo json_encode(['success' => true, 'message' => "Returned book updated successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to update return book. May be book already exist!"]);
        }
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
    exit;
}