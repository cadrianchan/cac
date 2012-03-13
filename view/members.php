<?php

if (!isset($_SESSION['username'])) {
    die("Please log in to view this page.");
}
$user = $_SESSION['username'];

if (isset($_GET['view'])) {
    $view = sanitizeString($_GET['view']);
    echo $this->registry->model->showProfile($view);
    echo "<a href='index.php?rt=profile/messages&view=$view'>Messages</a><br />";
    die("<a href='index.php?rt=profile/friends&view=$view'>Friends</a><br />");
}

if (isset($_GET['add'])) {
    $add = sanitizeString($_GET['add']);
    $this->registry->model->follow($user, $add);
} elseif (isset($_GET['remove'])) {
    $remove = sanitizeString($_GET['remove']);
    $this->registry->model->unfollow($user, $remove);
}

echo "<b>Members</b>";

$members = $this->registry->model->showFriendsAndMembers($user);

echo "<table><tbody>";
foreach($members['mutual'] as $member) {
    echo "<tr><td><img src='uploads/profiles/" . $member . ".jpg' width='50' height='50'></td><td><a href='index.php?rt=profile/members&view=$member'>$member</a>" . " &harr; mutual friend ";
    echo "[<a href='index.php?rt=profile/members&remove=" . $member . "'>Unfollow</a>]</td></tr>";
}

foreach($members['friendsFollowingOnly'] as $member) {
    echo "<tr><td><img src='uploads/profiles/" . $member . ".jpg' width='50' height='50'></td><td><a href='index.php?rt=profile/members&view=$member'>$member</a>" . " &rarr; follows you ";
    echo "[<a href='index.php?rt=profile/members&add=" . $member . "'>Be Friends</a>]</td></tr>";
}

foreach($members['followedByOnly'] as $member) {
    echo "<tr><td><img src='uploads/profiles/" . $member . ".jpg' width='50' height='50'></td><td><a href='index.php?rt=profile/members&view=$member'>$member</a>" . " &larr; you're following ";
    echo "[<a href='index.php?rt=profile/members&remove=" . $member . "'>Unfollow</a>]</td></tr>";
}

foreach($members['nonFriends'] as $member) {
    echo "<tr><td><img src='uploads/profiles/" . $member . ".jpg' width='50' height='50'></td><td><a href='index.php?rt=profile/members&view=$member'>$member</a>" . " &larr; ";
    echo "[<a href='index.php?rt=profile/members&add=" . $member . "'>Follow</a>]</td></tr>";
}
echo "</tbody></table>";

?>
