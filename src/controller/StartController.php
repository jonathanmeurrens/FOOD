<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Warre
 * Date: 7/06/13
 * Time: 00:17
 * To change this template use File | Settings | File Templates.
 */

    require_once WWW_ROOT . 'controller' . DS . 'AppController.php';
    require_once 'Smarty.class.php';

class StartController extends AppController {
    protected $action = '';
    protected $smarty;

    public function __construct(){
        parent:: __construct();
    }

    public function filter(){
        switch($this->action){
            default:
                return $this->index();
            break;
        }
    }

    public function index(){
        $content = $this->smarty->fetch('pages/start.tpl');
        $this->smarty->assign('content', $content);
    }
}