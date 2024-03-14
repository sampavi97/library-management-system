<?php

require_once 'BaseModel.php';

class User extends BaseModel
{
    public $username;
    public $address;
    public $contact_num;
    public $nic;
    public $role;
    private $email;
    private $password;

    protected function getTableName()
    {
        return "users";
    }

    protected function addNewRec()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        $param = array(
            ':username' => $this->username,
            ':address' => $this->address,
            ':contact_num' => $this->contact_num,
            ':nic' => $this->nic,
            ':role' => $this->role,
            ':email' => $this->email,
            ':password' =>$this->password
        );

        return $this->pm->run("INSERT INTO " . $this->getTableName() . "(username,address,contact_num,nic,role,email,password) values(:username, :address, :contact_num, :nic, :role, :email, :password)", $param);
    }

    protected function updateRec()
    {
        $existingUser = $this->getUserByUsernameOrEmailWithId($this->username, $this->email, $this->id);
        if ($existingUser) {
            return false;
        }

        if (!empty($this->password)) {
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }

        $param = array(
            ':username' => $this->username,
            ':address' => $this->address,
            ':contact_num' => $this->contact_num,
            ':nic' => $this->nic,
            ':role' => $this->role,
            ':email' => $this->email,
            ':password' => $this->password,
            ':id' => $this->id
        );
        return $this->pm->run(
            "UPDATE " . $this->getTableName() . " 
            SET
                username = :username,
                address = :address,
                contact_num = :contact_num,
                nic = :nic,
                role = :role,
                email = :email,
                password = :password
            WHERE id = :id",
            $param
        );
    }

    public function getUserByUsernameOrEmailWithId($username, $email, $excludeUserId = null)
    {
        $param = array(':username' => $username, ':email' => $email);

        $query = "SELECT * FROM " . $this->getTableName() . " 
                  WHERE (username = :username OR email = :email)";

        if ($excludeUserId !== null) {
            $query .= " AND id != :excludeUserId";
            $param[':excludeUserId'] = $excludeUserId;
        }

        $result = $this->pm->run($query, $param);

        return $result; // Return the user if found, or false if not found
    }

    function addUser($username, $address, $contact_num, $nic, $role, $email, $password)
    {
        $userModel = new User();

        $existingUser = $userModel->getUserByUsernameOrEmail($username, $email);
        if ($existingUser) {
            return false;
        }

        $user = new User();
        $user->username = $username;
        $user->address = $address;
        $user->contact_num = $contact_num;
        $user->nic = $nic;
        $user->role = $role;
        $user->email = $email;
        $user->password = $password;
        $user->addNewRec();

        if($user) {
            return $user;
        } else {
            return false;
        }
    }

    function updateUser($id,$username,$address,$contact_num,$nic,$role,$email,$password)
    {
        $userModel = new User();
        $existingUser = $userModel->getUserByUsernameOrEmailWithId($username,$email,$id);

        if($existingUser) {
            return false;
        }

        $user = new User();
        $user->id = $id;
        $user->username = $username;
        $user->address = $address;
        $user->contact_num = $contact_num;
        $user->nic = $nic;
        $user->role = $role;
        $user->email = $email;
        $user->password = $password;
        $user->updateRec();

        if($user) {
            return true;
        } else {
            return false;
        }
    }

    public function getUserByUsernameOrEmail($username, $email)
    {
        $param = array(
            ':username' => $username,
            ':email' => $email
        );

        $sql = "SELECT * FROM " . $this->getTableName() . " WHERE username = :username OR email = :email";
        $result = $this->pm->run($sql, $param);

        if(!empty($result)) {
            $user = $result[0];
            return $user;
        } else {
            return null;
        }
    }

    function deleteUser($id)
    {
        $user = new User();
        $user->deleteRec($id);

        if ($user) {
            return true;
        } else {
            return false;
        }
    }

    public function getLastInsertedUserId()
    {
        $result = $this->pm->run('SELECT MAX(id) as lastInsertedId FROM users', null, true);
        return $result['lastInsertedId'] ?? 100;
    }
}


