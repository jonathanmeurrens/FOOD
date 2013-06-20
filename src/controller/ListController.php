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

        if(isset($_GET['ajax']) && $_GET['ajax'] == 'done'){
            $context = stream_context_create(array("http"=>array("header"=>"Connection: close \r\n")));
            $burgersjson = file_get_contents($this->api_url . '/burgersdone' ,false,$context);
            $burgers = json_decode($burgersjson, true);
            $this->smarty->assign('burgers', $burgers);
            $this->smarty->assign('finished', true);
            echo $this->smarty->fetch('parts/list-part.tpl');
            exit;
        }

        if(isset($_GET['ajax']) && $_GET['ajax'] == 'search'){
            if(!empty($_GET['str'])){
                $context = stream_context_create(array("http"=>array("header"=>"Connection: close \r\n")));
                $burgersjson = file_get_contents($this->api_url . '/findburger?str=' . $_GET['str'],false,$context);
                if($burgersjson != 'false'){
                    $burgers = json_decode($burgersjson, true);
                    $this->smarty->assign('burgers', $burgers);

                    echo $this->smarty->fetch('parts/list-part.tpl');
                    exit;
                }else{
                    echo 'no_records';
                    exit;
                }

            }else{
                echo 'leeg';
                exit;
            }
        }

        if(isset($_GET['ajax']) && $_GET['ajax'] == 'true'){
            $context = stream_context_create(array("http"=>array("header"=>"Connection: close \r\n")));
            $burgersjson = file_get_contents($this->api_url . '/burgers',false,$context);
            $burgers = json_decode($burgersjson, true);

            $context = stream_context_create(array("http"=>array("header"=>"Connection: close \r\n")));
            $bestburgerjson = file_get_contents($this->api_url . '/burgers/' . $burgers[0]['id'],false,$context);
            $bestburger = json_decode($bestburgerjson, true);

/*            $ipjson = file_get_contents('http://smart-ip.net/geoip-json?callback=?',false,$context);
            $ip = json_decode($ipjson);

            $context = stream_context_create(array("http"=>array("header"=>"Connection: close \r\n")));
            $votedjson = file_get_contents($this->api_url . '/checkip?ip=' . $ip . '&id=' . $burgers[0]['id'], false, $context);
            if(json_decode($votedjson) == 'hasvoted'){
                $this->smarty->assign('voted', true);
            }*/

            $names = '';
            foreach($bestburger as $burger){
                $names .= $burger['user_name'] . ', ';
            }
            $names = substr($names, 0, -2);

            $this->smarty->assign('burgernames', $names);
            $this->smarty->assign('burgers', $burgers);

            echo $this->smarty->fetch('pages/list.tpl');
            exit;
        }

        $context = stream_context_create(array("http"=>array("header"=>"Connection: close \r\n")));
        $burgersjson = file_get_contents($this->api_url . '/burgers',false,$context);
        $burgers = json_decode($burgersjson, true);

        $context = stream_context_create(array("http"=>array("header"=>"Connection: close \r\n")));
        $bestburgerjson = file_get_contents($this->api_url . '/burgers/' . $burgers[0]['id'],false,$context);
        $bestburger = json_decode($bestburgerjson, true);

        $names = '';
        foreach($bestburger as $burger){
            $names .= $burger['user_name'] . ', ';
        }
        $names = substr($names, 0, -2);

        $this->smarty->assign('burgernames', $names);
        $this->smarty->assign('burgers', $burgers);

        $content = $this->smarty->fetch('pages/list.tpl');
        $this->smarty->assign('content', $content);
    }

}