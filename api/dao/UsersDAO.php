<?php

require_once WWW_ROOT . 'classes' . DS . 'DatabasePDO.php';

class UsersDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    public function addUser($id, $post)
    {
        $sql="INSERT INTO (burger_id, sort_id, name, type_id)
              VALUES (:id, 0, :name, 5)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":name", $post["name"]);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function getUsersByBurgerById($id){
        $sql = "SELECT jack_tblUsers.burger_id, jack_tblUsers.image_url, jack_tblUsers.sort_id, jack_tblUsers.name, jack_tblUsers.layer_name, jack_tblUsers.type_id,  jack_tblLayertypes.name AS ingredient_name
                FROM jack_tblUsers
                LEFT JOIN jack_tblLayertypes ON jack_tblUsers.type_id = jack_tblLayertypes.id
                WHERE jack_tblUsers.burger_id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()){
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($users)){
                return $users;
            }
        }
        return array();
    }


}