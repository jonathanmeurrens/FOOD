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
        $sql="INSERT INTO jack_tblUsers (burger_id, name, type_id)
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
        $sql = "SELECT jack_tblUsers.id, jack_tblUsers.burger_id, jack_tblUsers.image_url, jack_tblUsers.name, jack_tblUsers.layer_name, jack_tblUsers.type_id,  jack_tblLayertypes.name AS ingredient_name
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
            else{
                return array();
            }
        }
        return $stmt->errorInfo();
    }

    public function insertUserForBurgerId($id, $post, $image_url){
        $sql="INSERT INTO jack_tblUsers (burger_id , name, type_id, layer_name, image_url)
              VALUES (:burger_id, :name, :type_id, :layer_name, :image_url)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":burger_id", $id);
        $stmt->bindValue(":name", $post["name"]);
        $stmt->bindValue(":type_id", $post["layer_id"]);
        $stmt->bindValue(":layer_name", $post["layer_name"]);
        $stmt->bindValue(":image_url", $image_url);
        if($stmt->execute()){
            return $this->pdo->lastInsertId();
        }else{
            return false;
        }
    }

    public function deleteUser($id){
        $sql="DELETE FROM jack_tblUsers WHERE id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function checkIp($ip, $id){
        $sql = "SELECT * FROM jack_tblVoters WHERE ip = :ip AND burger_id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':ip', $ip);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        if($stmt->rowCount() == 1){
            return true;
        }else{
            return false;
        }
    }

    public function addIp($ip, $id){
        $sql = "INSERT INTO jack_tblVoters (ip, burger_id)
                VALUES (:ip, :id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':ip', $ip);
        $stmt->bindValue(':id', $id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }


}