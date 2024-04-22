<?php

require_once 'BaseModel.php';

class IssueBook extends BaseModel
{
    public $book_id;
    public $user_id;
    public $issued_date;
    public $due_date;
    // public $book_title;
    // public $book_isbn;
    // public $user_name;
    // public $available_books;
    public $is_recieved;

    protected function getTableName()
    {
        return "issued_book";
    }

    // get issue book details
    public function getIssDet()
    {
        return $this->pm->run("SELECT iss.*, usr.username AS user_name, usr.id AS user_id, bk.available_books AS available_books, bk.title AS book_title, bk.isbn AS book_isbn FROM issued_book AS iss INNER JOIN  users AS usr ON iss.user_id = usr.id INNER JOIN books AS bk ON bk.id = iss.book_id WHERE iss.is_recieved = 0 ORDER BY id DESC");
    }

    //get details of issued book details which is not return
    public function getNotRetIss()
    {
        return $this->pm->run("SELECT iss.*, bk.title AS book_title, bk.isbn AS book_isbn FROM issued_book AS iss INNER JOIN books AS bk ON bk.id = iss.book_id WHERE iss.is_recieved = 0 ");
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

        return $result;
    }

    protected function updateAvailableBook()
    {
        $result = $this->pm->run("UPDATE books AS bk INNER JOIN issued_book AS iss ON bk.id = iss.book_id SET bk.available_books = CASE WHEN bk.available_books > 0 THEN bk.available_books - 1 ELSE 0 END WHERE iss.is_recieved = 0");

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
        $book->updateAvailableBook();

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

}
