<?php

require_once 'BaseModel.php';

class ReturnBook extends BaseModel
{
    // public $rb_isbn;
    // public $rb_title;
    // public $borrower_id;
    // public $borrower_name;
    public $borrowed_id;
    public $due_date;
    public $returned_date;
    public $fine;
    public $fine_paid;
    // public $isRecieved;

    protected function getTableName()
    {
        return "returned_book";
    }

    public function getRetDet()
    {
        return $this->pm->run("SELECT ret.*, usr.username AS borrower_name, usr.id AS borrower_id, bk.title AS rb_title, bk.isbn AS rb_isbn, iss.is_recieved AS isRecieved, iss.due_date AS due_date FROM returned_book AS ret INNER JOIN issued_book AS iss ON ret.borrowed_id = iss.id INNER JOIN books AS bk ON bk.id = iss.book_id INNER JOIN users AS usr ON usr.id = iss.user_id  WHERE iss.is_recieved = 1 ORDER BY id DESC");
    }

    protected function addNewRec()
    {
        $param = array(
            ':borrowed_id' => $this->borrowed_id,
            ':due_date' => $this->due_date,
            ':returned_date' => $this->returned_date,
            ':fine' => $this->fine,
            ':fine_paid' => $this->fine_paid

        );

        $result = $this->pm->run("INSERT INTO " . $this->getTableName() . "(borrowed_id,due_date,returned_date,fine,fine_paid) VALUES(:borrowed_id, :due_date, :returned_date, :fine, :fine_paid)", $param);

        // $results = $this->pm->run("INSERT INTO " . $this->getTableName() . "(borrowed_id,due_date,returned_date,fine,fine_paid) VALUES(:borrowed_id, :due_date, :returned_date, :fine, :fine_paid) WHERE ")

        return $result;
    }

    protected function updateRec()
    {
        $param = array( 
            // ':returned_date' => $this->returned_date,
            // ':fine' => $this->fine,
            ':fine_paid' => $this->fine_paid,
            ':id' => $this->id
        );

        return $this->pm->run(
            "UPDATE returned_book 
            SET 
                -- returned_date = :returned_date,
                -- fine = :fine,
                fine_paid = :fine_paid 
            WHERE id = :id", 
            $param
        );
    }

    function addRetBook($borrowed_id, $due_date, $returned_date, $fine, $fine_paid)
    {
        $book = new ReturnBook();
        $book->borrowed_id = $borrowed_id;
        $book->due_date = $due_date;
        $book->returned_date = $returned_date;
        $book->fine = $fine;
        $book->fine_paid = $fine_paid;
        $book->addNewRec();

        if ($book) {
            return $book;
        } else {
            return false;
        }
    }

    function updateRetBook($id, $fine_paid)
    {
        $book = new ReturnBook();
        $book->id = $id;
        // $book->returned_date = $returned_date;
        // $book->fine = $fine;
        $book->fine_paid = $fine_paid;
        $book->updateRec();

        if ($book) {
            return true;
        } else {
            return false;
        }
    }

    // function returnBook()
    // {
    //     return $this->pm->run("UPDATE returned_book SET returned_date =  WHERE id = :id",)
    // }

}