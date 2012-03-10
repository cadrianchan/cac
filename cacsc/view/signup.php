<?php

$error = $user = $pass = $team = "";
if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);
    $team = sanitizeString($_POST['teamname']);

    if ($user == "" || $pass == "") {
        $error = "<span class='error'>Not all fields were entered!</span><br/><br/>";
    } else {
        $signup = $this->registry->model->userSignup($user, $pass, $team);
        if($signup){
           echo "<h4>Account created. </h4>Please Log in.<br/>";
        }else{
            echo "<span class='error'>Username already exists!</span><br/><br/>";
        }
    }
}

echo <<<_END
<form method='post' action='index.php?rt=index/signup'> <span class='error'>$error</span>
Username <input type='text' maxlength='32' name='user' value='$user' /><br/>
Password <input type='password' maxlength='16' name='pass' value='$pass' /><br/>
Team <select name='teamname'>
_END;
foreach($teamnames as $teamname){
    echo '<option>' . $teamname . '</option>';
}
echo <<<_END
</select>
&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
<input type='submit' value='Signup' />
</form>
_END;
?>
