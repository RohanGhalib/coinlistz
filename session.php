<?php
$usernameis = 'none';
session_start();
if(isset($_SESSION['username'])){
    $usernameis = $_SESSION['username'];
}
else{
    $usernameis = 'none';
}
$date = date('Y-m-d');

?>
