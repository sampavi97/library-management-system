<?php
require_once '../config.php';
require_once '../helpers/AppManager.php';
require_once '../models/Book.php';
require_once '../models/User.php';

$target_dir = "../assets/uploads/";

// CRUD Operations for User
//add user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_user') {

    try {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $address = $_POST['address'];
        $contact_num = $_POST['contact_num'];
        $nic = $_POST['nic'];
        $role = $_POST['role'];

        // TODO set uploading image setup for user and admin

        $userModel = new User();
        $created = $userModel->addUser($username, $address, $contact_num, $nic, $role, $email, $password);

        if($created) {
            // TODO create createAdmin for admin table also as doctor ceated in ajax_functions.php
            echo json_encode(['success' => true, 'message' => "User created successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to create user. May be user already exist!"]);
        }
    } catch (PDOException $e){
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
    } catch (PDOException $e){
        echo json_encode(['success' =>false, 'message' => 'Error: ' . $e->getMessage()]);
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
        $password = $_POST['password'];
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
            echo json_encode(['success' =>false, 'message' => "Invalid email address"]);
            exit;
        }

        $userModel = new User();
        $updated = $userModel->updateUser($id,$username,$address,$contact_num,$nic,$role,$email,$password);
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
        $catogary = $_POST['catogary'];
        $isbn = $_POST['isbn'];
        $quantity = $_POST['quantity'];
        $book_status = $_POST['book_status'];

        $bookModel = new Book();
        $created = $bookModel->addBook($title,$author,$catogary,$isbn,$quantity,$book_status);

        if($created) {
            echo json_encode(['success' => true, 'message' => "Book created successfully!"]);
        } else {
            echo json_encode(['success' => false, 'message' => "Failed to create book. May be book already exist!"]);
        }
    } catch (PDOException $e){
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
    } catch (PDOException $e){
        echo json_encode(['success' =>false, 'message' => 'Error: ' . $e->getMessage()]);
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

//Update book
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'edit_book') {
    try {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $catogary = $_POST['catogary'];
        $isbn = $_POST['isbn'];
        $quantity = $_POST['quantity'];
        $book_status = $_POST['book_status'];
        $id = $_POST['id'];

        if (empty($title) || empty($isbn)) {
            echo json_encode(['success' => false, 'message' => "Required fields are missing!"]);
            exit;
        }

        $bookModel = new Book();
        $updated = $bookModel->updateBook($id,$title,$author,$catogary,$isbn,$quantity,$book_status);
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

?>