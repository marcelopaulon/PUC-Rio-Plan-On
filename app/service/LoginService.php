<?php

require_once(__SITE_PATH . "/service/DatabaseService.php");
require_once(__SITE_PATH . "/lib/phpass.php");

class LoginService extends DatabaseService
{
    const host = "localhost";
    
    public static function login($email, $password)
    {
        $sql = "SELECT id_usuario, senha FROM usuario WHERE email=?";
        $data = array($email);
        
        $result = parent::query($sql, $data);
        
        if(count($result) > 0)
        {
            $ph = new PasswordHash(8, false);
            
            if($ph->CheckPassword($password, $result[0]["senha"]))
            {
                $idUsuario = $result[0]["id_usuario"];
                
                $sql = "UPDATE usuario SET cod_sessao=? WHERE id_usuario=?";
                $session = md5(uniqid(rand(), true));
                $data = array($session, $idUsuario);
                
                $loginResult = parent::query($sql, $data);
                
                setcookie("id_usuario", $idUsuario, time()+360000, "/", self::host, 0);
                setcookie("sessao", $session, time()+360000, "/", self::host, 0);
                
                
            }
            else
            {
                return -2;
            }
        }
        else
        {
            return -2;
        }
    }
    
    public static function logout()
    {
        if (isset($_COOKIE['id_usuario'])) 
        {
            unset($_COOKIE['id_usuario']);;
            setcookie('id_usuario', null, -1, '/', self::host);
        }
        
        if (isset($_COOKIE['sessao'])) 
        {
            unset($_COOKIE['sessao']);;
            setcookie('sessao', null, -1, '/', self::host);
        }
    }
    
    private static function emailExists($email)
    {
        $sql = "SELECT 1 FROM usuario WHERE email=?";
        $data = array($email);
        
        $result = parent::query($sql, $data);
        
        if(count($result) > 0)
        {
            return true;
        }
        
        return false;
    }
    
    public static function checkSession($id, $session)
    {
        $sql = "SELECT cod_sessao FROM usuario WHERE id_usuario=?";
        $data = array($id);
        
        $result = parent::query($sql, $data);
        
        if(count($result) > 0)
        {
            if(trim($result[0]["cod_sessao"]) == trim($session))
            {
                return true;
            }
        }
        
        return false;
    }
    
    public static function register($name, $email, $password)
    {
        if(self::emailExists($email))
        {
            return -3;
        }
        
        $ph = new PasswordHash(8, false);
            
        $sql = "INSERT INTO usuario (nome, email, senha, data_criacao) VALUES (?,?,?, NOW())";
        $data = array($name, $email, $ph->HashPassword($password));
        
        parent::query($sql, $data);
        
        return self::login($email, $password);
    }
}