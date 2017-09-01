<?php

require_once(__SITE_PATH . "/service/DatabaseService.php");

class UserService extends DatabaseService
{
    public static function loadUser($id)
    {
        $sql = 'SELECT nome, email, cod_sessao, data_criacao FROM usuario WHERE "id_usuario" = ?';
        $data = array(intval($id));
        
        $result = parent::query($sql, $data);
        
        $user = new Usuario($id, $result[0]["nome"], $result[0]["email"], NULL, $result[0]["cod_sessao"], $result[0]["data_criacao"]);
        
        return $user;
    }
    
}