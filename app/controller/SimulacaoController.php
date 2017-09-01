<?php

require(__SITE_PATH . '/service/' . 'SimulacaoService.php');
require(__SITE_PATH . '/service/' . 'GradeService.php');

class SimulacaoController extends baseController {

    public function index() 
    {
        if(!($this->registry->user) || !($this->registry->user->id))
        {
            die(header("Location: " . __SITE_URL));
        }
        
        $simulacoes = SimulacaoService::loadUserSimulations($this->registry->user->id);
        
        foreach($simulacoes as $key => $simulacao)
        {
            $gradesTemp = GradeService::loadSimulationGrades($simulacao->id);
            $simulacoes[$key]->qtdPeriodos = count($gradesTemp);
        }
        
        $this->registry->simulacoes = $simulacoes;
        
        /*** load the list template ***/
        $this->registry->viewsToRender = array('simulacao/list');
    }

    public function Create() 
    {     
        if(!($this->registry->user) || !($this->registry->user->id))
        {
            die(header("Location: " . __SITE_URL));
        }
        
        if(isset($_POST["nome"], $_POST["curso"], $_POST["minObrig"], $_POST["minOrient"], $_POST["minDep"], $_POST["minForaDep"], $_POST["minLivres"]))
        {
            $simCreationStatus = SimulacaoService::create($this->registry->user->id, $_POST["nome"], $_POST["curso"], $_POST["minObrig"], $_POST["minOrient"], $_POST["minDep"], $_POST["minForaDep"], $_POST["minLivres"]);
            
            if($simCreationStatus != 1)
            {
                $this->registry->errorMessage = "Não foi possível criar a simulação";
            }
            else
            {
                die(header("Location: " . __SITE_URL . "/Simulacao"));
            }
        }
        /*** load the create template ***/
        $this->registry->viewsToRender = array('simulacao/create');
    }
    
    public function Edit() 
    {   
        if(!($this->registry->user) || !($this->registry->user->id))
        {
            die(header("Location: " . __SITE_URL));
        }
        
        if(!isset($_GET["id_simulacao"]))
        {
            die(header("Location: " . __SITE_URL . "/Simulacao"));
        }
    
        if(isset($_POST["nome"], $_POST["curso"], $_POST["minObrig"], $_POST["minOrient"], $_POST["minDep"], $_POST["minForaDep"], $_POST["minLivres"]))
        {
            $simCreationStatus = SimulacaoService::edit($_POST["nome"], $_POST["curso"], $_POST["minObrig"], $_POST["minOrient"], $_POST["minDep"], $_POST["minForaDep"], $_POST["minLivres"], $_GET["id_simulacao"]);
            
            if($simCreationStatus != 1)
            {
                $this->registry->errorMessage = "Não foi possível criar a simulação";
            }
            else
            {
                die(header("Location: " . __SITE_URL . "/Simulacao/View?id_simulacao=" . $_GET["id_simulacao"]));
            }
        }
        
        $simulacao = SimulacaoService::loadSimulation($_GET["id_simulacao"]);
        
        if(reset($simulacao)->id_usuario != $this->registry->user->id)
        {
            die(header("Location: " . __SITE_URL . "/Simulacao"));
        }
        
        $this->registry->simulacao = $simulacao[key($simulacao)];
        
        /*** load the create template ***/
        $this->registry->viewsToRender = array('simulacao/edit');
    }
    
    public function Delete()
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
        
        if(reset($simulacao)->id_usuario != $this->registry->user->id)
        {
            die(header("Location: " . __SITE_URL . "/Simulacao"));
        }
        
        $simDeletionStatus = SimulacaoService::delete($_GET["id_simulacao"]);
        
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
        
        if(reset($simulacao)->id_usuario != $this->registry->user->id)
        {
            die(header("Location: " . __SITE_URL . "/Simulacao"));
        }
        
        if(isset($_POST["add_disciplina"], $_POST["cod_disciplina_add"], $_POST["id_grade_add"], $_POST["tipo_disciplina_add"]))
        {
            GradeService::addDisciplina($_POST["id_grade_add"], $_POST["cod_disciplina_add"], $_POST["tipo_disciplina_add"]);
        }
        
        if(isset($_POST["remove_disciplina"], $_POST["cod_disciplina_remove"], $_POST["id_grade_remove"]))
        {
            GradeService::removeDisciplina($_POST["id_grade_remove"], $_POST["cod_disciplina_remove"]);
        }
        
        if(isset($_POST["remove_grade"], $_POST["id_grade_remove"]))
        {
            GradeService::delete($_POST["id_grade_remove"]);
        }
    
        $simulacao = SimulacaoService::loadSimulation($_GET["id_simulacao"]);
        $this->registry->simulacao = $simulacao[key($simulacao)];
        $grades = array();
        
        $gradesTemp = GradeService::loadSimulationGrades($_GET["id_simulacao"]);
        $this->registry->simulacao->qtdPeriodos = count($gradesTemp);
        
        foreach($gradesTemp as $grade)
        {
            $disciplinas = GradeService::loadGradeDisciplinas($grade->id);
            $grades[$grade->id] = array($grade, $disciplinas);
        }
        
        $this->registry->grades = $grades;
        
        /*** load the create template ***/
        $this->registry->viewsToRender = array('simulacao/view');
    }
}

