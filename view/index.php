<div class="content">
    <div class="signup">
        <?php
        $error = $username = $password = $team = "";
        if (isset($_POST['username'])) {
            $username = sanitizeString($_POST['username']);
            $password = sanitizeString($_POST['password']);
            $team = sanitizeString($_POST['teamname']);

            if ($username == "" || $password == "") {
                $error = "Not all fields were entered!<br/><br/>";
            } else {
                $signup = $this->registry->model->userSignup($username, $password, $team);
                if ($signup) {
                    $error = "<h4>Account created. </h4>Please Log in.<br/>";
                } else {
                    $error = "Username already exists!<br/><br/>";
                }
            }
        }

        echo <<<_END
<form method='post' action='index.php?rt=index'>
<fieldset>
<legend>First Time User</legend>
<table>
<tr><td>Username</td><td><input type='text' maxlength='32' name='username' value='$username' /></td></tr>
<tr><td>Password</td><td><input type='password' maxlength='16' name='password' value='$password' /></td></tr>
<tr><td>Team</td><td><select name='teamname' id='teamname'>
_END;
        foreach ($teamnames as $teamname) {
            echo '<option>' . $teamname . '</option>';
        }
        echo <<<_END
</select></td></tr>
<tr><td></td><td><input type='submit' value='Signup' id='submit' /></td></tr>
</table>
</fieldset>
</form>
$error
_END;
        ?>
    <!-- end .signup --></div>
    
    <div class="logo">
        <img src='resource/images/logo.jpg' alt='logo' />
    <!-- end .logo --></div>
    
<!-- end .content --></div>
