<?php
session_start();

$error = $user = $pass = "";
if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "") {
        $error = "<font color='red'>Not all fields were entered!</font><br/><br/>";
    } else {
        $login = $this->registry->model->userLogin($user, $pass);
        if($login){
            $_SESSION['username'] = $user;
            header('Location: index.php?rt=profile');
            exit;
        }else{
            $error = "<font color='red'>Wrong Username or Password!</font><br/><br/>";
        }
    }
}

/* html code has to be placed after header() for page redirection */
$this->registry->template->show('header');

echo <<<_END
<form method='post' action='index.php?rt=index'> <font color='red'>$error</font>
Username <input type='text' maxlength='32' name='user' value='$user' /><br/>
Password <input type='password' maxlength='16' name='pass' value='$pass' /><br/>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<input type='submit' value='Log in' />
</form>
_END;
?>
