<?php

if (!isset($_SESSION['username'])) {
    die("Please log in to view this page.");
}
$user = $_SESSION['username'];

if (isset($_GET['view'])) {
    $view = sanitizeString($_GET['view']);
} else {
    $view = $user;
}

echo $this->registry->model->showProfile($user);
echo "<h3><a href='index.php?rt=profile/members&view=$view'>$view</a>'s Friends</h3>";

$friends = $this->registry->model->showFriendsAndMembers($view);

$numMutual = count($friends['mutual']);
if ($numMutual) {
    echo "<b>Mutual Friends</b><ul>";
    foreach ($friends['mutual'] as $friend) {
        echo "<li><a href='index.php?rt=profile/members&view=$friend'>$friend</a></li>";
    }
    echo "</ul>";
}

$numFollowers = count($friends['friendsFollowingOnly']);
if ($numFollowers) {
    echo "<b>Followers</b><ul>";
    foreach ($friends['friendsFollowingOnly'] as $friend) {
        echo "<li><a href='index.php?rt=profile/members&view=$friend'>$friend</a></li>";
    }
    echo "</ul>";
}

$numFollowing = count($friends['followedByOnly']);
if ($numFollowing) {
    echo "<b>Following</b><ul>";
    foreach ($friends['followedByOnly'] as $friend) {
        echo "<li><a href='index.php?rt=profile/members&view=$friend'>$friend</a></li>";
    }
    echo "</ul>";
}

if (!($numFollowers + $numFollowing + $numMutual)) {
    echo "None yet. Go ahead and add some!";
}

echo "<a href='index.php?rt=profile/members&view=$view'>View $view's messages.</a>";
?>

