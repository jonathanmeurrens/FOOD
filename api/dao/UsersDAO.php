<?php

require_once WWW_ROOT . 'classes' . DS . 'DatabasePDO.php';

class UsersDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    public function addUser($id, $username)
    {
        $sql="INSERT INTO (burger_id, sort_id, name, type_id)
              VALUES (:id, 0, :username, 5)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":username", $username);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }


}