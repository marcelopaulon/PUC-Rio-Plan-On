<?php

require(__SITE_PATH . '/service/' . 'AvaliacaoService.php');

class AvaliacaoController extends baseController {

    public function index() 
    {
        
    }

    public function Create() 
    {
        if(!isset($_GET['cod_disciplina']))
        {
            die(json_encode(array("error" => "invalid_cod_disciplina")));
        }
        
        if(isset($_POST["id_usuario"], $_POST["dificuldade_tempo"], $_POST["dificuldade_conteudo"], $_POST["dificuldade_avaliacao"], $_POST["comentario"]))
        {
            $simCreationStatus = AvaliacaoService::create($_POST["dificuldade_tempo"], $_POST["dificuldade_conteudo"], $_POST["dificuldade_avaliacao"], $_POST["comentario"], $_POST["id_usuario"], $_GET['cod_disciplina']);
            
            if($simCreationStatus != 1)
            {
                die(json_encode(array("error" => "error")));
            }
        }
        else
        {
            die(json_encode(array("error" => "invalid_input")));
        }
    }
    
    public function Edit() 
    {   
        if(!isset($_GET['id_avaliacao']))
        {
            die(json_encode(array("error" => "id_avaliacao")));
        }
    
        if(isset($_POST["dificuldade_tempo"], $_POST["dificuldade_conteudo"], $_POST["dificuldade_avaliacao"], $_POST["comentario"]))
        {
            $avaliacaoStatus = AvaliacaoService::edit($_GET['id_avaliacao'], $_POST["dificuldade_tempo"], $_POST["dificuldade_conteudo"], $_POST["dificuldade_avaliacao"], $_POST["comentario"]);
            
            if($avaliacaoStatus != 1)
            {
                die(json_encode(array("error" => "error")));
            }
        }
        else
        {
            die(json_encode(array("error" => "invalid_input")));
        }
    }
    
    public function Delete() 
    {   
        if(!isset($_GET['id_avaliacao']))
        {
            die(json_encode(array("error" => "invalid_id_avaliacao")));
        }

        AvaliacaoService::delete($_GET['id_avaliacao']);
        
        die(json_encode(array("status" => "ok")));
    }
    
    public function GetByDisciplina() 
    {   
        if(!isset($_GET["cod_disciplina"]))
        {
            die(json_encode(array("error" => "cod_disciplina")));
        }
    
        $result = AvaliacaoService::loadDisciplinaReviews($_GET['cod_disciplina']);
        
        die(json_encode(array("status" => "ok", "result" => $result)));
    }
}