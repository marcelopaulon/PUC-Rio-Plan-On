<?php

require(__SITE_PATH . '/service/' . 'SimulacaoService.php');
require(__SITE_PATH . '/service/' . 'GradeService.php');

class GradeController extends baseController {

    public function index() 
    {
        if(!($this->registry->user) || !($this->registry->user->id))
        {
            die(header("Location: " . __SITE_URL));
        }
        
        $this->registry->simulacoes = SimulacaoService::loadUserSimulations($this->registry->user->id);
        /*** load the list template ***/
        $this->registry->viewsToRender = array('grade/list');
    }

    public function Create() 
    {
        if(!($this->registry->user) || !($this->registry->user->id))
        {
            die(header("Location: " . __SITE_URL));
        }
        
        if(!isset($_GET["id_simulacao"]))
        {
            die(header("Location: " . __SITE_URL . "/Grade"));
        }
        
        if(isset($_POST["ano"], $_POST["semestre"]))
        {
            $simCreationStatus = GradeService::create($_GET['id_simulacao'], $_POST["ano"], $_POST["semestre"]);
            
            if($simCreationStatus != 1)
            {
                $this->registry->errorMessage = "Não foi possível criar a grade";
            }
            else
            {
                die(header("Location: " . __SITE_URL . "/Simulacao/View?id_simulacao=" . $_GET["id_simulacao"]));
            }
        }
        
        $simulacao = SimulacaoService::loadSimulation($_GET["id_simulacao"]);
        $this->registry->simulacao = $simulacao[0];
        
        /*** load the create template ***/
        $this->registry->viewsToRender = array('grade/create');
    }
    
    public function Edit() 
    {   if(!isset($_GET['id_grade']))
        {
            die(header("Location: " . __SITE_URL . "/Grade"));
        }
    
        if(isset($_POST["ano"], $_POST["semestre"]))
        {
            $simCreationStatus = GradeService::edit($_POST["ano"], $_POST["semestre"], $_GET['id_grade']);
            
            if($simCreationStatus != 1)
            {
                $this->registry->errorMessage = "Não foi possível editar a grade";
            }
        }
        
        $grade = GradeService::loadGrade($_GET["id_grade"]);
        $this->registry->grade = $grade[0];
        
        /*** load the create template ***/
        $this->registry->viewsToRender = array('grade/edit');
    }
    
    public function Delete() 
    {   
        if(!($this->registry->user) || !($this->registry->user->id))
        {
            die(header("Location: " . __SITE_URL));
        }
        
        if(!isset($_GET['id_grade']))
        {
            die(header("Location: " . __SITE_URL . "/Grade"));
        }

        GradeService::delete($_GET['id_grade']);
        
        die(header("Location: " . __SITE_URL . "/Simulacao"));
    }
    
    public function View() 
    {   
        if(!($this->registry->user) || !($this->registry->user->id))
        {
            die(header("Location: " . __SITE_URL));
        }
        
        if(!isset($_GET["id_simulacao"]))
        {
            die(header("Location: " . __SITE_URL . "/Simulacao"));
        }
    
        $simulacao = SimulacaoService::loadSimulation($_GET["id_simulacao"]);
        $this->registry->simulacao = $simulacao[0];
        
        /*** load the create template ***/
        $this->registry->viewsToRender = array('grade/view');
    }
    
    public function AddDisciplina()
    {
        if(isset($_POST["cod_disciplina_add"], $_POST["id_grade_add"]))
        {
            GradeService::addDisciplina($_POST["id_grade_add"], $_POST["cod_disciplina_add"], 'R');
            echo json_encode(array("result" => "ok"));
            return;
        }
        
        echo json_encode(array("error" => "error"));
    }
    
    public function ChangeDisciplinaTipo()
    {
        if(isset($_POST["cod_disciplina_change"], $_POST["id_grade_change"], $_POST["type"]))
        {
            GradeService::changeDisciplinaType($_POST["id_grade_change"], $_POST["cod_disciplina_change"], $_POST["type"]);
            echo json_encode(array("result" => "ok"));
            return;
        }
        
        echo json_encode(array("error" => "error"));
    }
}

