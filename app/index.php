<?php

/*** define the site path constant ***/
$site_path = realpath(dirname(__FILE__));
define ('__SITE_PATH', $site_path);

define ('__SITE_URL', "http://" . $_SERVER['SERVER_NAME'] ); //. ':8888');

require(__SITE_PATH . "/lib/layout.php");
require(__SITE_PATH . "/lib/session.php");

/*** error reporting on ***/
error_reporting(E_ALL);

/*** include the controller class ***/
require(__SITE_PATH . '/application/' . 'controller_base.php');

/*** include the registry class ***/
require(__SITE_PATH . '/application/' . 'registry.php');

/*** include the router class ***/
require(__SITE_PATH . '/application/' . 'router.php');

/*** include the template class ***/
require(__SITE_PATH . '/application/' . 'template.php');

/*** include the login service class ***/
require(__SITE_PATH . '/service/' . 'LoginService.php');

/*** include the user service class ***/
require(__SITE_PATH . '/service/' . 'UserService.php');

/*** auto load model classes ***/
function __autoload($class_name) {
    $filename = strtolower($class_name) . '.php';
    $file = __SITE_PATH . '/model/' . $filename;

    if (file_exists($file) == false)
    {
        return false;
    }
    require ($file);
}

/*** a new registry object ***/
$registry = new Registry();

/*** load the router ***/
$registry->router = new Router($registry);

/*** set the path to the controllers directory ***/
$registry->router->setPath (__SITE_PATH . '/controller');

$registry->template = new Template($registry);

if(isset($_COOKIE["sessao"], $_COOKIE["id_usuario"]))
{
    $sessionCheck = LoginService::checkSession($_COOKIE["id_usuario"], $_COOKIE["sessao"]);
    if($sessionCheck)
    {
        $registry->authenticated = true;
        $registry->user = UserService::loadUser($_COOKIE["id_usuario"]);
    }
    else
    {
        $registry->errorMessage = "Sessão expirada! Faça login novamente";   
    }
}

$registry->router->loader();

if(!isset($registry->ajax) && !$registry->ajax)
{
    renderHeader();
}

$registry->router->render();

if(!isset($registry->ajax) && !$registry->ajax) 
{
    renderFooter();
}
