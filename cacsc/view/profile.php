<?php

if (!isset($_SESSION['username'])) {
    die("Please log in to view this page.");
}
$user = $_SESSION['username'];

if (isset($_POST['text'])) {
    $text = $this->registry->model->updateUserInfo($user, $_POST['text']);
} else {
    $text = $this->registry->model->displayUserInfo($user);
}

if (isset($_FILES['image']['name'])) {
    $dest = "uploads/profiles/$user.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $dest);
    $supportedType = TRUE;

    switch ($_FILES['image']['type']) {
        case "image/gif": $src = imagecreatefromgif($dest);
            break;

        case "image/jpeg": $src = imagecreatefromjpeg($dest);
            break;

        case "image/png": $src = imagecreatefrompng($dest);
            break;

        default: $supportedType = FALSE;
            break;
    }

    if ($supportedType) {
        //transform to the image size we want
        list($w, $h) = getimagesize($dest);
        $max = 150;
        $tw = $w;
        $th = $h;
        if ($w > $h && $max < $w) {
            $th = $max / $w * $h;
            $tw = $max;
        } elseif ($h > $w && $max < $h) {
            $tw = $max / $h * $w;
            $th = $max;
        } elseif ($max < $w) {
            $tw = $th = $max;
        }

        $tmp = imagecreatetruecolor($tw, $th);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
        //sharpen image
        imageconvolution($tmp, array(
            array(-1, -1, -1),
            array(-1, 16, -1),
            array(-1, -1, -1)
                ), 8, 0);
        imagejpeg($tmp, $dest);
        imagedestroy($tmp);
        imagedestroy($src);
    }
}


echo $this->registry->model->showProfile($user);

echo <<<_END
<form method='post' action='index.php?rt=profile/profile' enctype='multipart/form-data'>
Enter or edit your details and/or upload an image:<br />
<textarea name='text' cols='40' rows='3'>$text</textarea><br/>
Image: <input type='file' name='image' size='14' maxlength='32' />
<input type='submit' value='Save Profile' />
</form>
_END;

?>
