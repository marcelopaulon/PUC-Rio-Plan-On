<?php

class HomeController extends baseController
{
    public function index() {
        if(isset($_POST["register"], $_POST["name"], $_POST["email"], $_POST["password"]))
        {
            $register = LoginService::register($_POST["name"], $_POST["email"], $_POST["password"]);
            
            if($register == -3)
            {
                $this->registry->errorMessage = "Este e-mail já está cadastrado";
            }
            
            die(header('Location: ' . __SITE_URL . '/Simulacao'));
        }
        else if(isset($_POST["login"], $_POST["email"], $_POST["password"]))
        {
            $login = LoginService::login($_POST["email"], $_POST["password"]);
            
            if($login == -2)
            {
                $this->registry->errorMessage = "Nome de usuário ou senha inválidos";
            }
            
            die(header('Location: ' . __SITE_URL . '/Simulacao'));
        }
        
        if($this->registry->authenticated)
        {
            die(header("Location: " . __SITE_URL . "/Simulacao"));
        }
        
        $this->registry->viewsToRender = array('home/index');
    }
    
    public function About() {
        $this->registry->viewsToRender = array('home/about');
    }
}