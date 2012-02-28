<?php

Class Template {
    private $registry;

    private $vars = array();

    function __construct($registry) {
        $this->registry = $registry;
    }

    public function __set($index, $value) {
        $this->vars[$index] = $value;
    }

    function show($name) {
        $path = SITEPATH . '/view' . '/' . $name . '.php';

        if (file_exists($path) == false) {
            throw new Exception('View invalid: ' . $path);
            return false;
        }

        //load variables for the view
        foreach ($this->vars as $key => $value) {
            $$key = $value;
        }

        include $path;
    }

}

?>
