<?php

if (!isset($_SESSION['username'])) {
    die("Please log in to view this page.");
}
$user = $_SESSION['username'];

echo $this->registry->model->showProfile($user);
echo "<a href='index.php?rt=profile/messages&view=$user'>Messages</a><br />";
echo "<a href='index.php?rt=profile/friends&view=$user'>Friends</a><br />";

?>
