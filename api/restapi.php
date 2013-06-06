<?php

//header('Content-Type: application/json');

/*
 * Modereren van commentso op nieuwsartikels
Slechts 1 artikel om het simpel te houden
de client ziet alle comments die goedgekeurd zijn
de admin ziet gewoon alle comments met de niet goedgekeurde bovenaan
Via een timer ziet de client nu en dan een update

Client: Select where approved = true
Client: insert comment
Admin: update set to approved
Admin: select all
 */

define('WWW_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('DS', DIRECTORY_SEPARATOR);


require_once WWW_ROOT . 'includes' . DS . 'functions.php';
require_once WWW_ROOT . 'classes' . DS . 'Config.php';

require_once WWW_ROOT . 'dao' . DS . 'BurgersDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'LocationsDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'UsersDAO.php';


require_once 'Slim' . DS . 'Slim.php';

$app = new Slim();

$app->get('/burgers', 'getBurgers');
$app->get('/burgers/:id', 'getBurgerById');
$app->put('/burgers/:id', 'updateBurgerRating');
$app->post('/burgers', 'addBurger');

$app->get('/burgers/:id/users', 'getUsersByBurgerId');

$app->get('/locations', 'getLocations');
$app->get('/locations/:id', 'getLocationById');

$app->run();

function getBurgers(){
    $burgersDAO = new BurgersDAO();
    echo json_encode($burgersDAO->getBurgers());
}

function getBurgerById($id){
    $burgersDAO = new BurgersDAO();
    echo json_encode($burgersDAO->getBurgerById($id));
}

function getUsersByBurgerId($id){
    $usersDAO = new UsersDAO();
    echo json_encode($usersDAO->getUsersByBurgerById($id));
}

function updateBurgerRating($id){
    $burgersDAO = new BurgersDAO();
    echo json_encode($burgersDAO->updateBurgerRating($id));
}

function addBurger(){
    $post = Slim::getInstance()->request()->post();
    $burgersDAO = new BurgersDAO();
    $result = $burgersDAO->addBurger();
    //echo json_encode($result);
    echo json_encode(array("result"=>$result));
    /*if(!empty($result)){
        // create a user for the chef
        $usersDAO = new UsersDAO();
        $result2 = $usersDAO->addUser($result, $post);
        if($result2){
            //Burger_id wordt teruggegeven
            echo json_encode($result);
        }
    }*/
}

function getLocations(){
    $locationsDAO = new LocationsDAO();
    echo json_encode($locationsDAO->getLocations());
}

function getLocationsById($id){
    $locationsDAO = new LocationsDAO();
    echo json_encode($locationsDAO->getLocationById($id));
}

