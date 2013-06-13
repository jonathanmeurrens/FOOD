<?php

require_once WWW_ROOT . 'classes' . DS . 'DatabasePDO.php';

class BurgersDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    public function getBurgers()
    {
        $sql = "SELECT * 
                FROM jack_tblBurgers
                WHERE jack_tblBurgers.is_served = 1
                ORDER BY jack_tblBurgers.rating DESC";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute())
        {
            $burgers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($burgers)){
                return $burgers;
            }
        }
        return array();
    }

    public function getBurgerById($id){
        $sql = "SELECT jack_tblBurgers.*, jack_tblUsers.image_url AS ingredient_image, jack_tblUsers.sort_id, jack_tblUsers.name, jack_tblLayertypes.name AS ingredient_name
                FROM jack_tblBurgers
                RIGHT JOIN jack_tblUsers ON jack_tblBurgers.id = jack_tblUsers.burger_id
                LEFT JOIN jack_tblLayertypes ON jack_tblUsers.type_id = jack_tblLayertypes.id
                WHERE jack_tblBurgers.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()){
            $burgers = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($burgers)){
                return $burgers;
            }
        }
        return array();
    }

    public function updateBurgerRating($id){
        $sql = "UPDATE jack_tblBurgers
                SET rating = rating +1
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function serveBurger($id, $post, $fileName){
        $sql = "UPDATE jack_tblBurgers
                SET is_served =  1, chef_name=:chef_name, name=:name, image_url=:image_url
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->bindValue(":chef_name", $post["chef_name"]);
        $stmt->bindValue(":name", $post["name"]);
        $stmt->bindValue(":image_url", $fileName);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function addBurger(){
        $sql = "INSERT INTO jack_tblBurgers (is_served)
                VALUES (0)";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute()){
            $result = $this->pdo->lastInsertId();
            return $result;
        }else{
            return 0;
        }
    }



}