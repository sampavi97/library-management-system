<?php

require_once 'BaseModel.php';

class Book extends BaseModel
{
    public $title;
    public $author;
    public $publisher;
    public $catogary;
    public $isbn;
    public $quantity;
    public $book_status;
    public $bk_desc;
    public $bk_image;

    protected function getTableName()
    {
        return "books";
    }

    protected function addNewRec()
    {
        $param = array(
            ':title' => $this->title,
            ':author' => $this->author,
            ':publisher' => $this->publisher,
            ':catogary' => $this->catogary,
            ':isbn' => $this->isbn,
            ':quantity' => $this->quantity,
            ':book_status' => $this->book_status,
            ':bk_desc' => $this->bk_desc,
            ':bk_image' => $this->bk_image
        );

        return $this->pm->run("INSERT INTO " . $this->getTableName() . "(title,author,publisher,catogary,isbn,quantity,book_status,bk_desc,book_image) values(:title, :author, :publisher, :catogary, :isbn, :quantity, :book_status, :bk_desc,:bk_image)", $param);
    }

    protected function updateRec()
    {
        $existingBook = $this->getBookByTitleOrISBNWithId($this->title,$this->isbn,$this->id);
        if($existingBook) {
            return false;
        }

        $param = array(
            ':title' => $this->title,
            ':author' => $this->author,
            ':publisher' => $this->publisher,
            ':catogary' => $this->catogary,
            ':isbn' => $this->isbn,
            ':quantity' => $this->quantity,
            ':book_status' => $this->book_status,
            ':bk_desc' => $this->bk_desc,
            ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . "
            SET
                title = :title,
                author = :author,
                publisher = :publisher,
                catogary = :catogary,
                isbn = :isbn,
                quantity = :quantity,
                book_status = :book_status,
                bk_desc = :bk_desc
                WHERE id = :id" ,
                $param
        );
    }

    public function getBookByTitleOrISBNWithId($title, $isbn, $excludeBookId = null)
    {
        $param = array(':title' => $title,':isbn' => $isbn);

        $query = "SELECT * FROM " . $this->getTableName() . " WHERE (title = :title OR isbn = :isbn)";

        if ($excludeBookId !== null) {
            $query .= " AND id != :excludeBookId";
            $param[':excludeBookId'] = $excludeBookId;
        }

        $result = $this->pm->run($query, $param);

        return $result;
    }

    function addBook($title,$author,$publisher,$catogary,$isbn,$quantity,$book_status,$bk_desc,$bk_image)
    {
        $bookModel = new Book();
        $existingBook = $bookModel->getBookByTitleOrISBN($title,$isbn);
        if($existingBook) {
            return false;
        }

        $book = new Book();
        $book->title = $title;
        $book->author = $author;
        $book->publisher = $publisher;
        $book->catogary = $catogary;
        $book->isbn = $isbn;
        $book->quantity = $quantity;
        $book->book_status = $book_status;
        $book->bk_desc = $bk_desc;
        $book->bk_image = $bk_image;
        $book->addNewRec();

        if($book) {
            return $book;
        } else {
            return false;
        }
    }

    function updateBook($id,$title,$author,$publisher,$catogary,$isbn,$quantity,$book_status,$bk_desc)
    {
        $bookModel = new Book();
        $existingBook = $bookModel->getBookByTitleOrISBNWithId($title,$isbn,$id);

        if($existingBook) {
            return false;
        }

        $book = new Book();
        $book->id = $id;
        $book->title = $title;
        $book->author = $author;
        $book->publisher = $publisher;
        $book->catogary = $catogary;
        $book->isbn = $isbn;
        $book->quantity = $quantity;
        $book->book_status = $book_status;
        $book->bk_desc = $bk_desc;
        $book->updateRec();

        if($book) {
            return true;
        } else {
            return false;
        }
    }

    public function getBookByTitleOrISBN($title,$isbn)
    {
        $param = array(
            ':title' => $title,
            ':isbn' => $isbn
        );

        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE title = :title OR isbn = :isbn";
        $result = $this->pm->run($sql,$param);

        if(!empty($result)) {
            $book = $result[0];
            return $book;
        } else {
            return null;
        }
    }

    function deleteBook($id)
    {
        $book = new Book();
        $book->deleteRec($id);

        if($book) {
            return true;
        } else {
            return false;
        }
    }

    public function getLastInsertedBookId()
    {
        $result = $this->pm->run('SELECT MAX(id) as lastInsertedId FROM books', null, true);
        return $result['lastInsertedId'] ?? 100;
    }

}

?>