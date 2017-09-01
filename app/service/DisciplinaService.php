<?php

require_once(__SITE_PATH . "/service/DatabaseService.php");

class DisciplinaService extends DatabaseService
{
    public static function search($text)
    {
        $sql = 'SELECT * FROM disciplina WHERE cod_disciplina ILIKE ? OR nome ILIKE ? ORDER BY nome LIMIT 10';
        $text = '%' . $text . '%';
        $data = array($text, $text);
        
        $result = parent::query($sql, $data);
        
        $disciplinas = array();
        
        $i = 0;
        
        foreach($result as $key => $value)
        {
            $disciplina = new Disciplina($result[$i]["cod_disciplina"], $result[$i]["nome"], $result[$i]["qtd_creditos"]);
            array_push($disciplinas, $disciplina);
            $i++;
        }
        
        return $disciplinas;
    }
}

