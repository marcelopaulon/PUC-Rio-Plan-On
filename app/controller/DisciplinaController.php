<?php

require(__SITE_PATH . '/service/' . 'SimulacaoService.php');
require(__SITE_PATH . '/service/' . 'DisciplinaService.php');

class DisciplinaController extends baseController {

    public function index() 
    {
        
    }

    public function Search() 
    {
        if(!isset($_GET["text"]))
        {
            die(json_encode(array("error" => "invalid_search")));
        }
        
        echo json_encode(array("result" => DisciplinaService::search($_GET["text"])));
    }
}