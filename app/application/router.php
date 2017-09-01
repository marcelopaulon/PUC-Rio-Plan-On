<?php

class Router {
    /*
    * @the registry
    */
    private $registry;

    /*
    * @the controller path
    */
    private $path;

    public $file;

    public $controller;

    public $action;

    function __construct($registry) {
           $this->registry = $registry;
    }
    
    /**
    *
    * @set controller directory path
    *
    * @param string $path
    *
    * @return void
    *
    */
    function setPath($path) {

           /*** check if path i sa directory ***/
           if (is_dir($path) == false)
           {
                   throw new Exception ('Invalid controller path: `' . $path . '`');
           }
           /*** set the path ***/
           $this->path = $path;
    }
    
    /**
    *
    * @get the controller
    *
    * @access private
    *
    * @return void
    *
    */
    private function getController() {

           /*** get the route from the url ***/
           $route = (empty($_GET['rt'])) ? '' : $_GET['rt'];

           if (empty($route))
           {
                   $route = 'index';
           }
           else
           {
                   /*** get the parts of the route ***/
                   $parts = explode('/', $route);
                   $this->controller = $parts[0];
                   if(isset( $parts[1]))
                   {
                           $this->action = $parts[1];
                   }
           }

           if (empty($this->controller))
           {
                   $this->controller = 'Home';
           }

           /*** Get action ***/
           if (empty($this->action))
           {
                   $this->action = 'index';
           }

           /*** set the file path ***/
           $this->file = $this->path .'/'. $this->controller . 'Controller.php';
           
           $this->registry->controller = $this->controller;
           $this->registry->action = $this->action;
    }

    /**
    *
    * @load the controller
    *
    * @access public
    *
    * @return void
    *
    */
    public function loader()
    {
        /*** check the route ***/
        $this->getController();

        /*** if the file is not there diaf ***/
        if (is_readable($this->file) == false)
        {
                echo $this->file;
                die ('404 Not Found');
        }

        /*** include the controller ***/
        include $this->file;

        /*** a new controller class instance ***/
        $class = $this->controller . 'Controller';
        $controller = new $class($this->registry);

        /*** check if the action is callable ***/
        if (is_callable(array($controller, $this->action)) == false)
        {
                $action = 'index';
        }
        else
        {
                $action = $this->action;
        }
        
        if($this->controller != "Home" && !$this->registry->authenticated)
        {
            die(header('Location: ' . __SITE_URL . '/Home'));
        }
        
        $arr = array('Disciplina', 'Avaliacao', 'Grade/AddDisciplina');
        if(in_array($this->controller, $arr) || in_array($this->controller . '/' . $this->action, $arr))
        {
            $this->registry->ajax = true;        
        }
        
        /*** run the action ***/
        $controller->$action();
    }
    
    public function render()
    {
        if(!isset($this->registry->ajax) && !$this->registry->ajax)
        {
            echo '<body><div class="container">';
        
            if($this->registry->authenticated)
            {
                $this->registry->template->show('common/menu');
            }
        }
        
        $viewsToRender = $this->registry->viewsToRender;
        $viewCount = count($viewsToRender);
        
        for($i = 0; $i < $viewCount; $i++)
        {
            $this->registry->template->show($viewsToRender[$i]);
        }
        
        if(!isset($this->registry->ajax) && !$this->registry->ajax)
        {
            echo '</div></body>';
        }
    }
}