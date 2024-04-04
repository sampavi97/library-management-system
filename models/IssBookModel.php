<?php

require_once 'BaseModel.php';

class IssBookModel extends BaseModel
{
    public $book_id;
    public $user_id;
    public $issued_date;
    public $due_date;
    public $bk_title;
    public $user_name;
    public $recieved_date;
    public $fine;
    public $fine_paid;
    public $nic;
    public $isbn;

    protected function getTableName()
    {
        return "issued_book";
    }

    public function getById($id)
    {
        $param = array(':id' => $id);
        return $this->pm->run(
            "SELECT *, bk.title AS bk_title, bk.isbn AS isbn, us.username AS user_name, us.nic AS nic, iss.id AS ID FROM issued_book AS iss 
            JOIN books AS bk ON bk.id = iss.book_id 
            JOIN users AS us ON us.id = iss.user_id 
            WHERE iss.id = id",
            $param,
            true
        );
    }

    //Method to retrieve record by its id or book title from the associated table
    public function getByIdOrBookTitle($id, $bktitle)
    {
        if(!empty($id)) {
            $condition = "id = :id";
            $param = array(':id' => $id);
        } elseif (!empty($bktitle)) {
            $condition = "bktitle = :bktitle";
            $param = array(':bktitle' => $bktitle);
        } else {
            return null;
        }

        return $this->pm->run("SELECT * FROM " . $this->getTableName() . " WHERE $condition", $param, true);
    }

    public function getByIdAndBookTitle($id, $bktitle)
    {

        if (!empty($id) && !empty($bktitle)) {
            $condition = "id = :id AND bktitle = :bktitle";
            $param = array(':id' => $id, ':bktitle' => $bktitle);
        } else {
            return null;
        }


        return $this->pm->run("SELECT * FROM " . $this->getTableName() . " WHERE $condition", $param, true);
    }

    protected function addNewRec()
    {
        $param = array(
            ':book_id' => $this->book_id,
            ':user_id' => $this->user_id,
            ':issued_date' => $this->issued_date,
            ':due_date' => $this->due_date,
            ':bk_title' => $this->bk_title,
            ':user_name' => $this->user_name,
            ':recieved_date' => $this->recieved_date,
            ':fine' => $this->fine,
            ':fine_paid' => $this->fine_paid,
            ':nic' => $this->nic,
            ':isbn' => $this->isbn
        );

        // $results = $this->pm->run("INSERT INTO " . $this->getTableName() . "(title,author,publisher,catogary,isbn,quantity,book_status,bk_desc,book_image,available_books) VALUES(:title, :author, :publisher, :catogary, :isbn, :quantity, :book_status, :bk_desc,:book_image,:available_books)", $param);
        $result = $this->pm->insertAndGetLastRowId("INSERT INTO issued_book(title,author,publisher,catogary,isbn,quantity,book_status,bk_desc,book_image,available_books)
            VALUES(:title, :author, :publisher, :catogary, :isbn, :quantity, :book_status, :bk_desc,:book_image,:available_books)", $param);

        return $result;
    }

    protected function updateRec()
    {
        $params = array(
            ':book_id' => $this->book_id,
            ':user_id' => $this->user_id,
            ':issued_date' => $this->issued_date,
            ':due_date' => $this->due_date,
            ':bk_title' => $this->bk_title,
            ':user_name' => $this->user_name,
            ':recieved_date' => $this->recieved_date,
            ':fine' => $this->fine,
            ':fine_paid' => $this->fine_paid,
            ':nic' => $this->nic,
            ':isbn' => $this->isbn,
            ':id' => $this->id
        );

        return $this->pm->run(
            "UPDATE issued_book
            SET 
                book_id = :book_id, 
                user_id = :user_id, 
                issued_date = :issued_date, 
                due_date = :due_date, 
                bk_title = :bk_title, 
                user_name = :user_name, 
                recieved_date = :recieved_date, 
                fine = :fine, 
                fine_paid = :fine_paid, 
                isbn = :isbn, 
                nic = :nic
            WHERE id = :id",
            $params
        );
    }

    // function addIssBook($book_id,$user_id,$issued_date,$due_date,$bk_title,$user_name,$recieved_date,$fine,$fine_paid,$isbn,$nic)
    // {

    //     $book = new IssBookModel();
    //     $book->book_id = $book_id;
    //     $book->user_id = $user_id;
    //     $book->issued_date = $issued_date;
    //     $book->due_date = $due_date;
    //     $book->bk_title = $bk_title;
    //     $book->user_name = $user_name;
    //     $book->recieved_date = $recieved_date;
    //     $book->fine = $fine;
    //     $book->fine_paid = $fine_paid;
    //     $book->isbn = $isbn;
    //     $book->nic = $nic;
    //     $book->addNewRec();

    //     if($book) {
    //         return $book;
    //     } else {
    //         return false;
    //     }
    // }

    // function updateIssBook($id,$book_id,$user_id,$issued_date,$due_date,$bk_title,$user_name,$recieved_date,$fine,$fine_paid,$isbn,$nic)
    // {

    //     $book = new IssBookModel();
    //     $book->id = $id;
    //     $book->book_id = $book_id;
    //     $book->user_id = $user_id;
    //     $book->issued_date = $issued_date;
    //     $book->due_date = $due_date;
    //     $book->bk_title = $bk_title;
    //     $book->user_name = $user_name;
    //     $book->recieved_date = $recieved_date;
    //     $book->fine = $fine;
    //     $book->fine_paid = $fine_paid;
    //     $book->isbn = $isbn;
    //     $book->nic = $nic;
    //     $book->updateRec();

    //     if($book) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // function deleteIssBook($id)
    // {
    //     $book = new IssBookModel();
    //     $book->deleteRec($id);

    //     if($book) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    public function getAllWithUserAndTitle()
    {
        return $this->pm->run("SELECT iss.*, bk.title AS bk_title, usr.username AS user_name FROM issued_book AS iss INNER JOIN users AS usr ON iss.user_id = usr.id INNER JOIN books AS bk ON bk.id = iss.book_id ORDER BY id DESC");
    }

    public function getAllWithUserAndTitleByUserId($user_id)
    {
        $param = array(':user_id' => $user_id);
        return $this->pm->run(
            "SELECT iss.*, bk.title AS bk_title, usr.username AS user_name FROM issued_book AS iss INNER JOIN users AS usr ON iss.user_id = usr.id INNER JOIN books AS bk ON bk.id = iss.book_id WHERE usr.id = :user_id ORDER BY id DESC", $param
        );
    }
}
?>