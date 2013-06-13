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

class ListController extends AppController {

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

        if(isset($_GET['ajax']) && $_GET['ajax'] == 'true'){
            $burgersjson = file_get_contents($this->api_url . '/burgers');
            $burgers = json_decode($burgersjson, true);
            $this->smarty->assign('burgers', $burgers);

            echo $this->smarty->fetch('pages/list.tpl');
            //echo $this->smarty->assign('content', $content);
            exit;
        }

        $burgersjson = file_get_contents($this->api_url . '/burgers');
        $burgers = json_decode($burgersjson, true);
        $this->smarty->assign('burgers', $burgers);

        $content = $this->smarty->fetch('pages/list.tpl');
        $this->smarty->assign('content', $content);
    }

}