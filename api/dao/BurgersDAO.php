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
                FROM jack_tblBurgers";
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
        $sql = "SELECT jack_tblBurgers . * , jack_tblUsers.isChef, jack_tblUsers.imageURL, jack_tblUsers.sort_id, jack_tblUsers.name AS username, jack_tblLayertypes.name AS layername
                FROM jack_tblBurgers
                RIGHT JOIN jack_tblUsers ON jack_tblBurgers.id = jack_tblUsers.burger_id
                LEFT JOIN jack_tblLayertypes ON jack_tblUsers.type_id = jack_tblLayertypes.id
                WHERE jack_tblBurgers.id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()){
            $burger = $stmt->fetch();
            if(!empty($burger)){
                return $burger;
            }
        }
        return array();
    }

    //Jibber jabber

    public function updateBurgerRating($id){
        $sql = "UPDATE jack_tblBurgers
                SET rating = rating +1
                WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()){
            return true;
        }
        return array();
    }

    public function addBurger(){
        $sql = "INSERT INTO jack_tblBurgers (isServed)
                VALUES (0)";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute()){
            $result = $this->pdo->lastInsertId();
        }else{
            return "";
        }
    }



}