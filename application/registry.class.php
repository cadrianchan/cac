<?php //store all core objects into one central object, eliminate use of global vars

Class Registry{
    private $vars = array();

    public function __set($index, $value) {
        $this->vars[$index] = $value;
    }

    public function __get($index) {
        return $this->vars[$index];
    }

}

?>
