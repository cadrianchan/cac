<?php

function __autoload($class_name) {
    $filename = strtolower($class_name) . '.class.php';
    $file = SITEPATH . '/model/' . $filename;

    if (file_exists($file) == false) {
        return false;
    }
    include ($file);
}

function sanitizeString($var) {
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return mysql_real_escape_string($var);
}

function userLogout() {
    if (isset($_SESSION['username'])) {
        $_SESSION = array();

        if (session_id() != "" || isset($_COOKIE[session_name()]))
            setcookie(session_name(), '', time() - 1000000, '/');

        session_destroy();
    }
}

?>
