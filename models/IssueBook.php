<?php

require_once 'BaseModel.php';

class IssueBook extends BaseModel
{
    public $book_id;
    public $user_id;
    public $issued_date;
    public $due_date;
    public $book_title;
    public $book_isbn;
    public $user_name;
    public $available_books;
    public $is_recieved;

    protected function getTableName()
    {
        return "issued_book";
    }

    public function getIssDet()
    {
        return $this->pm->run("SELECT iss.*, usr.username AS user_name, bk.available_books AS available_books, bk.title AS book_title, bk.isbn AS book_isbn FROM issued_book AS iss INNER JOIN  users AS usr ON iss.user_id = usr.id INNER JOIN books AS bk ON bk.id = iss.book_id order by id desc");
    }

    protected function addNewRec()
    {
        $param = array(
            ':book_id' => $this->book_id,
            ':user_id' => $this->user_id,
            ':issued_date' => $this->issued_date,
            ':due_date' => $this->due_date,
            ':is_recieved' => $this->is_recieved
        );

        $result = $this->pm->run("INSERT INTO " . $this->getTableName() . "(book_id,user_id,issued_date,due_date,is_recieved) VALUES(:book_id, :user_id, :issued_date, :due_date, :is_recieved)", $param);
        // $result = $this->pm->insertAndGetLastRowId("INSERT INTO issued_book(book_id,user_id,issued_date,due_date,is_recieved)
        //     VALUES(:book_id, :user_id, :issued_date, :due_date, :is_recieved)", $param);

        return $result;
    }

    protected function updateRec()
    {
        $params = array(
            ':book_id' => $this->book_id,
            ':user_id' => $this->user_id,
            ':issued_date' => $this->issued_date,
            ':due_date' => $this->due_date,
            ':is_recieved' => $this->is_recieved,
            ':id' => $this->id
        );

        return $this->pm->run(
            "UPDATE issued_book
            SET 
                book_id = :book_id, 
                user_id = :user_id, 
                issued_date = :issued_date, 
                due_date = :due_date, 
                is_recieved = :is_recieved 
            WHERE id = :id",
            $params
        );
    }

    function addIssBook($book_id, $user_id, $issued_date, $due_date, $is_recieved)
    {

        $book = new IssueBook();
        $book->book_id = $book_id;
        $book->user_id = $user_id;
        $book->issued_date = $issued_date;
        $book->due_date = $due_date;
        $book->is_recieved = $is_recieved;
        $book->addNewRec();

        if ($book) {
            return $book;
        } else {
            return false;
        }
    }

    function updateIssBook($id, $book_id, $user_id, $issued_date, $due_date, $is_recieved)
    {

        $book = new IssueBook();
        $book->id = $id;
        $book->book_id = $book_id;
        $book->user_id = $user_id;
        $book->issued_date = $issued_date;
        $book->due_date = $due_date;
        $book->is_recieved = $is_recieved;
        $book->updateRec();

        if ($book) {
            return true;
        } else {
            return false;
        }
    }

    // public function getAllWithUserAndTitle()
    // {
    //     return $this->pm->run("SELECT iss.*, bk.title AS bk_title, usr.username AS user_name FROM issued_book AS iss INNER JOIN users AS usr ON iss.user_id = usr.id INNER JOIN books AS bk ON bk.id = iss.book_id ORDER BY id DESC");
    // }

    // public function getAllWithUserAndTitleByUserId($user_id)
    // {
    //     $param = array(':user_id' => $user_id);
    //     return $this->pm->run(
    //         "SELECT iss.*, bk.title AS bk_title, usr.username AS user_name FROM issued_book AS iss INNER JOIN users AS usr ON iss.user_id = usr.id INNER JOIN books AS bk ON bk.id = iss.book_id WHERE usr.id = :user_id ORDER BY id DESC", $param
    //     );
    // }

    public function issueBook($book_id, $user_id)
    {
        // Get the current date
        $current_date = date("Y-m-d");

        // Prepare the SQL query to insert a new record
        $sql = "INSERT INTO issued_book (book_id, user_id, issue_date) VALUES (:book_id, :user_id, :issue_date)";

        // Bind parameters and execute the query
        $params = array(':book_id' => $book_id, ':user_id' => $user_id, ':issue_date' => $current_date);
        return $this->pm->run($sql, $params, false);
    }
}
