<?php

define('WWW_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('DS', DIRECTORY_SEPARATOR);

session_start();

require WWW_ROOT . 'includes'. DS . 'functions.php';

$page = '';

if(isset($_GET['page']) && !empty($_GET['page'])){
    $page = $_GET['page'];
}

$controller = NULL;



switch($page){
    default:
    case 'start':
        require_once WWW_ROOT . 'controller' . DS . 'StartController.php';
        $controller = new StartController();
    break;

    case 'list':
        require_once WWW_ROOT . 'controller'. DS . 'ListController.php';
        $controller = new ListController();
    break;

    case 'detail':
        require_once WWW_ROOT . 'controller' . DS . 'DetailController.php';
        $controller = new DetailController();
    break;

    case 'store':
        require_once WWW_ROOT . 'controller' . DS . 'StoreController.php';
        $controller = new StoreController();
    break;

}

$controller->filter();
$controller->render();