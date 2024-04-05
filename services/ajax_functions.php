<?php
require_once '../config.php';
require_once '../helpers/AppManager.php';
require_once '../models/Book.php';
require_once '../models/User.php';

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
            // TODO create createAdmin for admin table also as doctor ceated in ajax_functions.php
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

//Get User By username
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user']) && isset($_POST['action']) && $_POST['action'] == 'issue_user') {

    try {
        $searchedUser = $_POST['user'];
        $userModel = new User();
        $user = $userModel->getByUsername($searchedUser);
        if ($user) {
            echo json_encode(['success' => true, 'message' => "User added successfully!", 'data' => $user]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No such user found!']);
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

//Update user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_user') {
    try {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $role = $_POST['role'] == 'member' ? 'member' : 'admin';
        $contact_num = $_POST['contact_num'];
        $nic = $_POST['nic'];
        $address = $_POST['address'];

        $id = $_POST['id'];

        $image = $_FILES["user_image"];
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
        if (empty($title) || empty($isbn)) {
            echo json_encode(['success' => false, 'message' => "Required fields are missing!"]);
            exit;
        }

        if (empty($username) || empty($email)) {
            echo json_encode(['success' => false, 'message' => "Required fields are missing!"]);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => "Invalid email address"]);
            exit;
        }

        $userModel = new User();
        $updated = $userModel->updateUser($id, $username, $address, $contact_num, $nic, $role, $email, $imageFileName);
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

//Get book By Title
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book']) && isset($_POST['action']) && $_POST['action'] == 'issue_book') {

    try {
        $searchedBook = $_POST['book'];
        $bookModel = new Book();
        $book = $bookModel->getByBookTitle($searchedBook);
        if ($book) {
            echo json_encode(['success' => true, 'message' => "Book added successfully!", 'data' => $book]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No such book found!']);
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

// Update book
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
        if (empty($title) || empty($isbn)) {
            echo json_encode(['success' => false, 'message' => "Required fields are missing!"]);
            exit;
        }

        $bookModel = new Book();
        $updated = $bookModel->updateBook($id,$title,$author,$publisher,$catogary,$isbn,$quantity,$book_status,$bk_desc,$available_books,$imageFileName);
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




