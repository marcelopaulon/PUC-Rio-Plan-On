<?php

require_once(__SITE_PATH . "/service/DatabaseService.php");

class AvaliacaoService extends DatabaseService
{
    public static function create($dificuldade_tempo, $dificuldade_conteudo, $dificuldade_avaliacao, $comentario, $id_usuario, $cod_disciplina)
    {
        $sql = "INSERT INTO avaliacao (dificuldade_tempo, dificuldade_conteudo, dificuldade_avaliacao, comentario, id_usuario, cod_disciplina) VALUES (?,?,?,?,?,?)";
        $data = array($dificuldade_tempo, $dificuldade_conteudo, $dificuldade_avaliacao, $comentario, $id_usuario, $cod_disciplina);
        
        parent::query($sql, $data);
        
        return 1;
    }
    
    public static function edit($id_avaliacao, $dificuldade_tempo, $dificuldade_conteudo, $dificuldade_avaliacao, $comentario)
    {
        $sql = "UPDATE avaliacao SET dificuldade_tempo = ?, dificuldade_conteudo = ?, dificuldade_avaliacao = ?, comentario = ? WHERE id_avaliacao = ?";
        $data = array($dificuldade_tempo, $dificuldade_conteudo, $dificuldade_avaliacao, $comentario, $id_avaliacao);

        parent::query($sql, $data);
        
        return 1;
    }
    
    public static function delete($id_avaliacao)
    {
        $sql = "DELETE FROM avaliacao WHERE id_avaliacao=?;";
        $data = array($id_avaliacao);

        parent::query($sql, $data);
        
        return 1;
    }

    public static function loadUserReviews($userId)
    {
        $sql = 'SELECT id_avaliacao, cod_disciplina, dificuldade_tempo, dificuldade_conteudo, dificuldade_avaliacao, comentario, data_criacao FROM avaliacao WHERE id_usuario = ? ORDER BY data_criacao';
        $data = array(intval($userId));
        
        $result = parent::query($sql, $data);
        
        $avaliacoes = array();
        
        $i = 0;
        
        foreach($result as $key => $value)
        {
            $avaliacao = new Avaliacao($result[$i]["id_avaliacao"], $userId, $result[$i]["cod_disciplina"], $result[$i]["dificuldade_tempo"], $result[$i]["dificuldade_conteudo"], $result[$i]["dificuldade_avaliacao"], $result[$i]["data_criacao"], $result[$i]["comentario"]);
            array_push($avaliacoes, $avaliacao);
            $i++;
        }
        
        return $avaliacoes;
    }
    
    public static function loadDisciplinaReviews($idDisciplina)
    {
        $sql = 'SELECT id_avaliacao, dificuldade_tempo, dificuldade_conteudo, dificuldade_avaliacao, comentario, data_criacao FROM avaliacao WHERE cod_disciplina = ? ORDER BY data_criacao';
        $data = array($idDisciplina);
        
        $result = parent::query($sql, $data);
        
        $avaliacoes = array();
        
        $i = 0;
        
        $sumDifTempo = 0;
        $sumDifConteudo = 0;
        $sumDifAvaliacao = 0;
        
        foreach($result as $key => $value)
        {
            $difTempo = intval($value["dificuldade_tempo"]);
            $difConteudo = intval($value["dificuldade_conteudo"]);
            $difAvaliacao = intval($value["dificuldade_avaliacao"]);
            
            $sumDifTempo += $difTempo;
            $sumDifConteudo += $difConteudo;
            $sumDifAvaliacao += $difAvaliacao;
            
            $avaliacao = new Avaliacao($value["id_avaliacao"], NULL, $idDisciplina, $difTempo, $difConteudo, $difAvaliacao, $value["data_criacao"], $value["comentario"]);
            array_push($avaliacoes, $avaliacao);
            $i++;
        }
        
        $dificuldade_tempo = $i > 0 ? $sumDifTempo / ($i) : 0;
        $dificuldade_conteudo = $i > 0 ? $sumDifConteudo / ($i) : 0;
        $dificuldade_avaliacao = $i > 0 ? $sumDifAvaliacao / ($i) : 0;
        $dificuldade_global = ($dificuldade_tempo + $dificuldade_conteudo + $dificuldade_avaliacao) / 3.0;
        
        $summary = new AvaliacoesSummary($dificuldade_global, $dificuldade_tempo, $dificuldade_conteudo, $dificuldade_avaliacao, $avaliacoes);
        return $summary;
    }
    
    public static function loadReview($id)
    {
        $sql = 'SELECT id_usuario, cod_disciplina, dificuldade_tempo, dificuldade_conteudo, dificuldade_avaliacao, comentario, data_criacao FROM avaliacao WHERE id_avaliacao = ?';
        $data = array(intval($id));
        
        $result = parent::query($sql, $data);
        
        $avaliacoes = array();
        
        $i = 0;
        
        foreach($result as $key => $value)
        {
            $avaliacao = new Avaliacao($id, $result[$i]["id_usuario"], $result[$i]["cod_disciplina"], $result[$i]["dificuldade_tempo"], $result[$i]["dificuldade_conteudo"], $result[$i]["dificuldade_avaliacao"], $result[$i]["data_criacao"], $result[$i]["comentario"]);
            array_push($avaliacoes, $avaliacao);
            $i++;
        }
        
        return $avaliacoes;
    }
}

