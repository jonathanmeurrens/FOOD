<?php

require_once WWW_ROOT . 'classes' . DS . 'DatabasePDO.php';

class LocationsDAO
{
    public $pdo;

    public function __construct()
    {
        $this->pdo = DatabasePDO::getInstance();
    }

    public function getLocations()
    {
        $sql = "SELECT *
                FROM jack_tblLocations";
        $stmt = $this->pdo->prepare($sql);
        if($stmt->execute())
        {
            $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($locations)){
                return $locations;
            }
        }
        return array();
    }

    public function getLocationById($id){
        $sql = "SELECT * FROM jack_tblLocations WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(":id", $id);
        if($stmt->execute()){
            $location = $stmt->fetch();
            if(!empty($location)){
                return $location;
            }
        }
    }

}