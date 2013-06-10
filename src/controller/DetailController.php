<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Warre
 * Date: 8/06/13
 * Time: 16:05
 * To change this template use File | Settings | File Templates.
 */

require_once WWW_ROOT . 'controller' . DS . 'AppController.php';
require_once 'Smarty.class.php';

class DetailController extends AppController {

    protected $action = '';
    protected $smarty;

    public function __construct(){
        parent::__construct();
    }

    public function filter(){
        switch($this->action){
            default:
                return $this->index();
            break;
        }
    }

    public function index(){

        $jsonburger = file_get_contents($this->api_url . '/burgers/'. $_GET['id']);
        $burger = json_decode($jsonburger, true);

        trace($burger);

        $this->smarty->assign('burger', $burger);
        $content = $this->smarty->fetch('pages/detail.tpl');
        $this->smarty->assign('content', $content);
    }

}