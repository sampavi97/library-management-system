<?php

abstract class BaseModel
{
    protected $pm;

    public $id;

    public function __construct()
    {
        $this->pm = AppManager::getPM();
    }
    
    abstract protected function getTableName();
    abstract protected function addNewRec();
    abstract protected function updateRec();

    public function getAll()
    {
        return $this->pm->run("SELECT * FROM " . $this->getTableName());
    }

    public function getById($id)
    {
        $param = array(':id' => $id);
        return $this->pm->run("SELECT * FROM " . $this->getTableName() . " WHERE id = :id", $param, true);
    }
    public function getByUsername($username)
    {
        $param = array(':username' => $username);
        return $this->pm->run("SELECT * FROM " . $this->getTableName() . " WHERE username = :username", $param, true);
    }
    public function getByIsbn($isbn)
    {
        $param = array(':isbn' => $isbn);
        return $this->pm->run("SELECT * FROM " . $this->getTableName() . " WHERE isbn = :isbn", $param, true);
    }
    public function getByBookTitle($title)
    {
        $param = array(':title' => $title);
        return $this->pm->run("SELECT * FROM " . $this->getTableName() . " WHERE title = :title", $param, true);
    }

    public function getAllByColumnValue($column,$value)
    {
        return $this->pm->run("SELECT * FROM " . $this->getTableName() . "WHERE $column = $value");
    }

    public function save()
    {
        if (isset($this->id) && $this->id > 0) {
            return $this->updateRec();
        } else {
            return $this->addNewRec();
        }
    }

    public function deleteRec($id)
    {
        $param = array(':id' => $id);
        return $this->pm->run("DELETE FROM " . $this->getTableName() . " WHERE id = :id", $param);
    }

    public function getTot()
    {
        return $this->pm->run("SELECT COUNT(*) AS total_rows FROM " . $this->getTableName());
        
    }
}