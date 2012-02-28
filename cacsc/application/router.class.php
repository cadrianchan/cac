<?php

class router {

    private $registry;
    private $path;
    private $args = array();
    public $file;
    public $controller;
    public $action;

    function __construct($registry) {
        $this->registry = $registry;
    }

    function setPath($path) {
        if (is_dir($path) == false) {
            throw new Exception('Path invalid: ' . $path);
        }
        $this->path = $path;
    }

    public function loader() {

        $this->getController();

        if (is_readable($this->file) == false) {
            $this->file = $this->path . '/error404.php';
            $this->controller = 'error404';
        }

        //including the controller
        include $this->file;

        //creating the new instance
        $class = $this->controller . 'Controller';
        $controller = new $class($this->registry);

        if (is_callable(array($controller, $this->action)) == false) {
            $action = 'index';
        } else {
            $action = $this->action;
        }

        $controller->$action();
    }

    private function getController() {
        $route = (isset($_GET['rt'])) ? $_GET['rt'] : '';

        if (isset($route)) {
            $parts = explode('/', $route);
            $this->controller = $parts[0];
            if (isset($parts[1])) {
                $this->action = $parts[1];
            }
        } else {
            $route = 'index';
        }

        if (empty($this->controller)) {
            $this->controller = 'index';
        }

        if (empty($this->action)) {
            $this->action = 'index';
        }

        //set this file path
        $this->file = $this->path . '/' . $this->controller . 'Controller.php';
    }

}

?>
