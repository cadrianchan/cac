<?php
session_start();

$error = $user = $pass = "";
if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "") {
        $error = "<span class='error'>Not all fields were entered!</span><br/><br/>";
    } else {
        $login = $this->registry->model->userLogin($user, $pass);
        if($login){
            $_SESSION['username'] = $user;
            header('Location: index.php?rt=profile');
            exit;
        }else{
            $error = "<span class='span'>Wrong Username or Password!</span><br/><br/>";
        }
    }
}

/* html code has to be placed after header() for page redirection */
$this->registry->template->show('header');

echo <<<_END
<form method='post' action='index.php?rt=index'> <span class='error'>$error</span>
Username <input type='text' maxlength='32' name='user' value='$user' /><br/>
Password <input type='password' maxlength='16' name='pass' value='$pass' /><br/>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<input type='submit' value='Log in' />
</form>
_END;
?>
