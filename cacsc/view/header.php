<?php
session_start();

$error = $user = $pass = "";
if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "") {
        $error = "Not all fields were entered! ";
    } else {
        $login = $this->registry->model->userLogin($user, $pass);
        if ($login) {
            $_SESSION['username'] = $user;
            header('Location: index.php?rt=profile');
            exit;
        } else {
            $error = "Wrong Username or Password! ";
        }
    }
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset=utf-8>
        <title>Chinatown Athletics Council</title>
        <link href="resource/css/site.css" rel="stylesheet" type="text/css" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.3/jquery.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.header img').width(200).height(230);
                $('td img').width(100).height(100);
                $('img').hide().fadeIn(2000);
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <?php
                echo <<<_END
                <br/>
                <form method='post' action='index.php?rt=index'>
                <span id='header_text'><a href='index.php?rt=index'>CHINATOWN ATHLETICS COUNCIL</a></span>
                <div id='header_login'><span id='login_err'>$error</span> Username <input type='text' maxlength='32' name='user' value='$user' /> Password <input type='password' maxlength='16' name='pass' value='$pass' />
                <input type='submit' value='Log In' id='button_login' /></div>
                <div style="clear: both;"></div>
                </form>
                <br/>
_END;
                ?>
                <!-- end .header --></div>
