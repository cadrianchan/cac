<?php

define('SITEPATH', realpath(dirname(__FILE__)));

/* including files for utility classes */
include_once SITEPATH . '/application/' . 'controller_base.class.php';
include_once SITEPATH . '/application/' . 'registry.class.php';
include_once SITEPATH . '/application/' . 'router.class.php';
include_once SITEPATH . '/application/' . 'template.class.php';

//autoload classes used by the model
include_once 'includes/init.php';

//store all core objects into one central object
$registry = new registry();

//using __set magic method in registry class
$registry->router = new router($registry);
$registry->router->setPath(SITEPATH . '/controller');
$registry->model = new model($registry);
$registry->template = new template($registry);

$registry->router->loader();

?>
