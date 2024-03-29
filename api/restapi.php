<?php

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
$app->put('/burgers/:id', 'updateBurger');
$app->post('/burgers/:id/serve', 'serveBurger');
$app->post('/burgers', 'addBurger');

$app->get('/burgers/:id/users', 'getUsersByBurgerId');
$app->post('/burgers/:id/users', 'insertUserForBurgerId');

$app->get('/locations', 'getLocations');
$app->get('/locations/:id', 'getLocationById');

$app->delete('/users/:id','deleteUser');

$app->get('/checkip', 'checkIp');
$app->get('/findburger', 'getBurgerByName');
$app->get('/burgersdone', 'getFinishedBurgers');

$app->run();

function getBurgers(){
    $burgersDAO = new BurgersDAO();
    echo json_encode($burgersDAO->getBurgers());
}

function getBurgerById($id){
    $burgersDAO = new BurgersDAO();
    echo json_encode($burgersDAO->getBurgerById($id));
}

function checkIp(){
    $get = Slim::getInstance()->request()->get();
    $usersDAO = new UsersDAO();
    $result = $usersDAO->checkIp($get['ip'], $get['id']);
    if($result){
        echo json_encode('hasvoted');
    }else{
        $result2 =$usersDAO->addIp($get['ip'], $get['id']);
        if($result2){
            $burgersDAO = new BurgersDAO();
            echo json_encode($burgersDAO->updateBurgerRating($get['id']));
        }
    }
}

function getUsersByBurgerId($id){
    $usersDAO = new UsersDAO();
    echo json_encode($usersDAO->getUsersByBurgerById($id));
}

function insertUserForBurgerId($id){
    $post = Slim::getInstance()->request()->post();
    $usersDAO = new UsersDAO();

    $file_name = uniqid(rand(), false) . '.jpeg';
    $user_id = $usersDAO->insertUserForBurgerId($id, $post,$file_name);

    if($user_id)
    {
        $target_path = "../images/layers/";
        $target_path .=$file_name;
        if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
            echo json_encode(array("success"=>"layer added","user_id"=>$user_id));
            die();
        }
        else{
            // delete user from db
        }
    }
    echo json_encode(array("error"=>"could not save layer"));
}

function getBurgerByName(){
    $get = Slim::getInstance()->request()->get();
    $burgersDAO = new BurgersDAO();
    echo json_encode($burgersDAO->getBurgerByName($get['str']));
}

function getFinishedBurgers(){
    $burgersDAO = new BurgersDAO();
    echo json_encode($burgersDAO->getFinishedBurgers());
}

function updateBurgerRating($id){
    $burgersDAO = new BurgersDAO();
    echo json_encode($burgersDAO->updateBurgerRating($id));
}

function serveBurger($id){

    $target_path = "../images/burgers/";
    $target_path .=$_FILES['uploadedfile']['name'];
    if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
        $post = Slim::getInstance()->request()->post();
        $burgersDAO = new BurgersDAO();
        // users = souschefs, chef name is stored in the burger table, the type of bread NOT stored in db, image of whole burger is enough, no need to store bread info
        echo json_encode(array("result"=>$burgersDAO->serveBurger($id,$post,$_FILES['uploadedfile']['name'])));
        die();
    }
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


function deleteUser($id){
    $usersDAO = new UsersDAO();
    echo json_encode(array("result"=>$usersDAO->deleteUser($id)));
}


// HELPER FUNCTIONS

function  makeFileName($size=6, $path="/", $extension=".gif"){
    //if you give a path, don't forget the slash at end

    //$root = $_SERVER["DOCUMENT_ROOT"];
    $name = rand(0, str_repeat(9, $size));
    $name = $path.str_pad($name, 8,  0, STR_PAD_LEFT).$extension;
    while(is_file($name)){
        makeFileName();
    }
    return $path.$name;
}
