<?php

require_once(__SITE_PATH . "/service/DatabaseService.php");

class SimulacaoService extends DatabaseService
{
    public static function create($userId, $nome, $curso, $minObg, $minOrient, $minDep, $minForaDep, $minLivres)
    {
        $sql = "INSERT INTO simulacao (id_usuario, nome, curso, qtd_min_disciplinas_obrigatorias, qtd_min_eletivas_orientacao, qtd_min_eletivas_departamento, qtd_min_eletivas_fora_departamento, qtd_min_eletivas_livres, data_criacao) VALUES (?,?,?,?,?,?,?,?,NOW())";
        $data = array($userId, $nome, $curso, intval($minObg), intval($minOrient), intval($minDep), intval($minForaDep), intval($minLivres));
        
        parent::query($sql, $data);
        
        return 1;
    }
    
    public static function edit($nome, $curso, $minObg, $minOrient, $minDep, $minForaDep, $minLivres, $id_simulacao)
    {
        $sql = "UPDATE simulacao SET nome = ?, curso = ?, qtd_min_disciplinas_obrigatorias = ?, qtd_min_eletivas_orientacao = ?, qtd_min_eletivas_departamento = ?, qtd_min_eletivas_fora_departamento = ?, qtd_min_eletivas_livres = ? WHERE id_simulacao = ?";
        $data = array( $nome, $curso, intval($minObg), intval($minOrient), intval($minDep), intval($minForaDep), intval($minLivres), intval($id_simulacao));

        parent::query($sql, $data);
        
        return 1;
    }
    
    public static function delete($id_simulcao)
    {
        $sql = "DELETE FROM simulacao WHERE id_simulacao=?;";
        $data = array($id_simulcao);

        parent::query($sql, $data);
        
        return 1;
    }

    public static function loadUserSimulations($userId)
    {
        $simulacoes = array();
        
        $sql = 'SELECT id_simulacao, id_usuario, nome, curso, qtd_min_disciplinas_obrigatorias, qtd_min_eletivas_orientacao, qtd_min_eletivas_departamento, qtd_min_eletivas_fora_departamento, qtd_min_eletivas_livres, data_criacao FROM simulacao WHERE id_usuario = ? ORDER BY data_criacao';
        $data = array(intval($userId));
        
        $result = parent::query($sql, $data);
        
        $i = 0;
        
        foreach($result as $key => $value)
        {
            if(!array_key_exists($result[$i]["id_simulacao"], $simulacoes))
            {
                $simulacoes[$result[$i]["id_simulacao"]] = new Simulacao($result[$i]["id_simulacao"], $userId, $result[$i]["nome"], $result[$i]["curso"], $result[$i]["qtd_min_disciplinas_obrigatorias"]
                    , $result[$i]["qtd_min_eletivas_orientacao"], $result[$i]["qtd_min_eletivas_departamento"], $result[$i]["qtd_min_eletivas_fora_departamento"], $result[$i]["qtd_min_eletivas_livres"],
                    $result[$i]["data_criacao"], null, 0, 0, 0, 0, 0);
            }
            
            $i++;
        }
        
        $sql = 'SELECT s.id_simulacao as id_simulacao, id_usuario, s.nome as nome, curso, qtd_min_disciplinas_obrigatorias, qtd_min_eletivas_orientacao, qtd_min_eletivas_departamento, qtd_min_eletivas_fora_departamento, qtd_min_eletivas_livres, s.data_criacao as data_criacao, sum(d.qtd_creditos) as sum, gp.tipo_disciplina as tipo FROM simulacao s, disciplina d, grade g, grade_possui_disciplina gp WHERE gp.id_grade = g.id_grade AND d.cod_disciplina = gp.cod_disciplina AND g.id_simulacao = s.id_simulacao AND s.id_usuario = ? GROUP BY s.id_simulacao, gp.tipo_disciplina ORDER BY s.data_criacao';
        $data = array(intval($userId));
        
        $result = parent::query($sql, $data);
                
        $i = 0;
        
        foreach($result as $key => $value)
        {
            if(!array_key_exists($result[$i]["id_simulacao"], $simulacoes))
            {
                $simulacoes[$result[$i]["id_simulacao"]] = new Simulacao($result[$i]["id_simulacao"], $userId, $result[$i]["nome"], $result[$i]["curso"], $result[$i]["qtd_min_disciplinas_obrigatorias"]
                    , $result[$i]["qtd_min_eletivas_orientacao"], $result[$i]["qtd_min_eletivas_departamento"], $result[$i]["qtd_min_eletivas_fora_departamento"], $result[$i]["qtd_min_eletivas_livres"],
                    $result[$i]["data_criacao"], null, 0, 0, 0, 0, 0);
            }
            
            $simulacao = $simulacoes[$result[$i]["id_simulacao"]];
            
            switch($result[$i]["tipo"])
            {
                case 'R':
                    $simulacao->qtd_cred_disciplinas_obrigatorias = $result[$i]["sum"];
                    break;
                case 'O':
                    $simulacao->qtd_cred_eletivas_orientacao = $result[$i]["sum"];
                    break;
                case 'F':
                    $simulacao->qtd_cred_eletivas_fora_departamento = $result[$i]["sum"];
                    break;
                case 'L':
                    $simulacao->qtd_cred_eletivas_livres = $result[$i]["sum"];
                    break;
                case 'D':
                    $simulacao->qtd_cred_eletivas_departamento = $result[$i]["sum"];
                    break;
            }
            
            $i++;
        }
        
        return $simulacoes;
    }
    
    public static function loadSimulation($id)
    {
        $simulacoes = array();
        
        $sql = 'SELECT id_simulacao, id_usuario, nome, curso, qtd_min_disciplinas_obrigatorias, qtd_min_eletivas_orientacao, qtd_min_eletivas_departamento, qtd_min_eletivas_fora_departamento, qtd_min_eletivas_livres, data_criacao FROM simulacao WHERE id_simulacao = ? ORDER BY data_criacao';
        $data = array(intval($id));
        
        $result = parent::query($sql, $data);
        
        $i = 0;
        
        foreach($result as $key => $value)
        {
            if(!array_key_exists($result[$i]["id_simulacao"], $simulacoes))
            {
                $simulacoes[$result[$i]["id_simulacao"]] = new Simulacao($result[$i]["id_simulacao"], $result[$i]["id_usuario"], $result[$i]["nome"], $result[$i]["curso"], $result[$i]["qtd_min_disciplinas_obrigatorias"]
                    , $result[$i]["qtd_min_eletivas_orientacao"], $result[$i]["qtd_min_eletivas_departamento"], $result[$i]["qtd_min_eletivas_fora_departamento"], $result[$i]["qtd_min_eletivas_livres"],
                    $result[$i]["data_criacao"], null, 0, 0, 0, 0, 0);
            }
            
            $i++;
        }
        
        $sql = 'SELECT s.id_simulacao as id_simulacao, id_usuario, s.nome as nome, curso, qtd_min_disciplinas_obrigatorias, qtd_min_eletivas_orientacao, qtd_min_eletivas_departamento, qtd_min_eletivas_fora_departamento, qtd_min_eletivas_livres, s.data_criacao as data_criacao, sum(d.qtd_creditos) as sum, gp.tipo_disciplina as tipo FROM simulacao s, disciplina d, grade g, grade_possui_disciplina gp WHERE gp.id_grade = g.id_grade AND d.cod_disciplina = gp.cod_disciplina AND g.id_simulacao = s.id_simulacao AND s.id_simulacao = ? GROUP BY s.id_simulacao, gp.tipo_disciplina';
        $data = array(intval($id));
        $result = parent::query($sql, $data);
                
        $i = 0;
                            
        foreach($result as $key => $value)
        {
            if($i == 0)
            {
                if(!array_key_exists($result[$i]["id_simulacao"], $simulacoes))
                {
                    $simulacoes[$result[$i]["id_simulacao"]] = new Simulacao($result[$i]["id_simulacao"], $userId, $result[$i]["nome"], $result[$i]["curso"], $result[$i]["qtd_min_disciplinas_obrigatorias"]
                        , $result[$i]["qtd_min_eletivas_orientacao"], $result[$i]["qtd_min_eletivas_departamento"], $result[$i]["qtd_min_eletivas_fora_departamento"], $result[$i]["qtd_min_eletivas_livres"],
                        $result[$i]["data_criacao"], null, 0, 0, 0, 0, 0);
                }
            }
            
            $simulacao = $simulacoes[$result[$i]["id_simulacao"]];
            
            switch($result[$i]["tipo"])
            {
                case 'R':
                    $simulacao->qtd_cred_disciplinas_obrigatorias = $result[$i]["sum"];
                    break;
                case 'O':
                    $simulacao->qtd_cred_eletivas_orientacao = $result[$i]["sum"];
                    break;
                case 'F':
                    $simulacao->qtd_cred_eletivas_fora_departamento = $result[$i]["sum"];
                    break;
                case 'L':
                    $simulacao->qtd_cred_eletivas_livres = $result[$i]["sum"];
                    break;
                case 'D':
                    $simulacao->qtd_cred_eletivas_departamento = $result[$i]["sum"];
                    break;
            }
            
            $i++;
        }
         
        return $simulacoes;
    }
}

