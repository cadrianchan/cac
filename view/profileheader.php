<!DOCTYPE html>

<html>
    <head>
        <title>Chinatown Athletics Council</title>
        <meta charset=utf-8>
        <link href="resource/css/site.css" rel="stylesheet" type="text/css" />
    </head>
    <body>

        <?php
        if (isset($_SESSION['username'])) {
            $user = $_SESSION['username'];

            echo "<html><head></head><body>";

            echo "<a href='index.php?rt=profile/index'>Home</a> |
	  <a href='index.php?rt=profile/members'>Members</a> |
          <a href='index.php?rt=profile/friends'>Friends</a> |
	  <a href='index.php?rt=profile/messages'>Messages</a> |
          <a href='index.php?rt=profile/profile'>Profile</a> |
	  <a href='index.php?rt=profile/logout'>Log out</a><br/>
          <h3><b>Welcome, $user!</b></h3><br/><br/>";
        } else {
            echo "<a href='index.php?rt=index'>Login</a> |
		 <a href='index.php?rt=index/signup'>Sign up</a><br/><br/>";
        }
        ?>
