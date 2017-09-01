<?php

require_once(__SITE_PATH . "/service/DatabaseService.php");
require_once(__SITE_PATH . "/service/AvaliacaoService.php");

class GradeService extends DatabaseService
{
    public static function create($id_simulacao, $ano, $semestre)
    {
        $sql = "INSERT INTO grade (id_simulacao, ano, semestre, data_criacao) VALUES (?,?,?,NOW())";
        $data = array($id_simulacao, $ano, $semestre);
        
        parent::query($sql, $data);
        
        return 1;
    }
    
    public static function edit($ano, $semestre, $id_grade)
    {
        $sql = "UPDATE grade SET ano = ?, semestre = ? WHERE id_grade = ?";
        $data = array($ano, $semestre, $id_grade);

        parent::query($sql, $data);
        
        return 1;
    }
    
    public static function delete($id_grade)
    {
        $sql = "DELETE FROM grade_possui_disciplina WHERE id_grade=?";
        $data = array($id_grade);
        
        parent::query($sql, $data);
        
        $sql = "DELETE FROM grade WHERE id_grade=?;";
        $data = array($id_grade);

        parent::query($sql, $data);
        
        return 1;
    }

    public static function loadSimulationGrades($simulationId)
    {
        $sql = 'SELECT id_grade, id_simulacao, ano, semestre, data_criacao, conta_creditos_grade(id_grade) as creds FROM grade WHERE id_simulacao = ? ORDER BY ano, semestre';
        $data = array(intval($simulationId));
        
        $result = parent::query($sql, $data);
        
        $grades = array();
        
        $i = 0;
        
        foreach($result as $key => $value)
        {
            $grade = new Grade($result[$i]["id_grade"], $result[$i]["id_simulacao"], $result[$i]["ano"], $result[$i]["semestre"], $result[$i]["data_criacao"], $result[$i]["creds"]);
            array_push($grades, $grade);
            $i++;
        }
        
        return $grades;
    }
    
    public static function loadGradeDisciplinas($gradeId)
    {
        $sql = 'SELECT cod_disciplina, nome, qtd_creditos, tipo_disciplina FROM grade_possui_disciplina NATURAL INNER JOIN disciplina WHERE id_grade = ? ORDER BY nome';
        $data = array(intval($gradeId));
        
        $result = parent::query($sql, $data);
        
        $disciplinas = array();
        
        $i = 0;
        
        foreach($result as $key => $value)
        {
            $codDisciplina = $result[$i]["cod_disciplina"];
            $reviewSummary = AvaliacaoService::loadDisciplinaReviews($codDisciplina);
            $disciplina = new Disciplina($codDisciplina, $result[$i]["nome"], $result[$i]["qtd_creditos"], $result[$i]["tipo_disciplina"], $reviewSummary);
            
            array_push($disciplinas, $disciplina);
            $i++;
        }
        
        return $disciplinas;
    }
    
    public static function loadGrade($gradeId)
    {
        $sql = 'SELECT id_grade, id_simulacao, ano, semestre, data_criacao FROM grade WHERE id_grade = ?';
        $data = array(intval($gradeId));
        
        $result = parent::query($sql, $data);
        
        $grades = array();
        
        $i = 0;
        
        foreach($result as $key => $value)
        {
            $grade = new Grade($result[$i]["id_grade"], $result[$i]["id_simulacao"], $result[$i]["ano"], $result[$i]["semestre"], $result[$i]["data_criacao"]);
            array_push($grades, $grade);
            $i++;
        }
        
        return $grades;
    }
    
    public static function addDisciplina($id_grade, $cod_disciplina, $tipo_disciplina)
    {
        $sql = 'SELECT cod_disciplina FROM grade_possui_disciplina WHERE id_grade = ? AND cod_disciplina = ?';
        $data = array($id_grade, $cod_disciplina);
                
        $result = parent::query($sql, $data);
        
        if(count($result) > 0) 
        {
            die("Erro-Disciplina-Duplicada-Grade");
        }
        
        $sql = "INSERT INTO grade_possui_disciplina (id_grade, cod_disciplina, tipo_disciplina) VALUES (?,?,?)";
        $data = array($id_grade, $cod_disciplina, $tipo_disciplina);
        
        parent::query($sql, $data);
        
        return 1;
    }
    
    public static function changeDisciplinaType($id_grade, $cod_disciplina, $tipo_disciplina)
    {        
        $sql = "UPDATE grade_possui_disciplina SET tipo_disciplina=? WHERE id_grade=? AND cod_disciplina=?";
        $data = array($tipo_disciplina, $id_grade, $cod_disciplina);
        
        parent::query($sql, $data);
        
        return 1;
    }
    
    public static function removeDisciplina($id_grade, $cod_disciplina)
    {
        $sql = "DELETE FROM grade_possui_disciplina WHERE id_grade=? AND cod_disciplina=?";
        $data = array($id_grade, $cod_disciplina);
        
        parent::query($sql, $data);
        
        return 1;
    }
}

