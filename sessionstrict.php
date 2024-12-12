<?php
if (isset($usernameis) && $usernameis === 'none') {
    header('Location: login.php');
    exit();
}
?>