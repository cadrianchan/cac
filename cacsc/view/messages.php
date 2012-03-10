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

if (isset($_POST['text'])) {
    $this->registry->model->postMsg($user, $view, $_POST['pm'], $_POST['text']);
}

if (isset($_GET['erase'])) {
    $this->registry->model->deleteMsg($_GET['erase'], $user);
}

echo $this->registry->model->showProfile($user);
echo "<h3><a href='index.php?rt=profile/messages&view=$view'>$view</a>'s Messages</h3>";

echo <<<_END
<form method='post' action='index.php?rt=profile/messages&view=$view'>
Wall message:<br/>
<textarea name='text' cols='50' rows='5'></textarea><br/>
Public<input type='radio' name='pm' value='0' checked='checked' />
Private<input type='radio' name='pm' value='1' />
<input type='submit' value='Submit' /></form>
_END;

$messages = $this->registry->model->showMsg($view);

if (count($messages)) {
    foreach ($messages as $message) {
        if ($message['pm'] == 0 || $message['auth'] == $user || $message['recip'] == $user) {
            echo date('M jS y g:sa: ', $message['time']) . "<a href='index.php?rt=profile/messages&view=";
            echo $message['auth'] . "'>" . $message['auth'] . "</a> ";
            if ($message['pm'] == 0) {
                echo "wrote: &quot;" . $message['message'] . "&quot; ";
            } else {
                echo "whispered: <span class='whisper'>&quot;" . $message['message'] . "&quot;</span> ";
            }
            if ($message['recip'] == $user) {
                echo "[<a href='index.php?rt=profile/messages&view=$view&erase=" . $message['id'] . "'>erase</a>]";
            }
            echo "<br>";
        }
    }
} else {
    echo "No messages yet.<br/><br/>";
}
?>
