<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Warre
 * Date: 7/06/13
 * Time: 00:00
 * To change this template use File | Settings | File Templates.
 */

    require_once('Smarty.class.php');

class AppController {
    protected $action = '';
    protected $smarty;
    protected $api_url;

    public function  __construct()
    {
        if(!empty($_GET['action']))
        {
            $this->action = $_GET['action'];
        }

        $this->api_url = 'http://localhost/FOOD/api';
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir('smarty_templates');
        $this->smarty->setCompileDir('smarty_compile');
        $this->smarty->muteExpectedErrors();

        $header = $this->smarty->fetch('parts/header-part.tpl');
        $this->smarty->assign('header', $header);

    }

    public function filter(){}

    public function render(){
        $this->smarty->display('index.tpl');
    }
}