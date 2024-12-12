<?php 
include 'db.php';

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $sql = 'UPDATE contact_details SET link = "' . $email . '" WHERE label = "email"';
    $conn -> query($sql);
    $conn -> close();
    header('Location: contactdetails.php');
}
if(isset($_POST['telegram'])){
    $telegram = $_POST['telegram'];
    $sql = 'UPDATE contact_details SET link = "' . $telegram . '" WHERE label = "telegram"';
    $conn -> query($sql);
    $conn -> close();
    header('Location: contactdetails.php');
}

if(isset($_POST['whatsapp'])){
    $whatsapp = $_POST['whatsapp'];
    $sql = 'UPDATE contact_details SET link = "' . $whatsapp . '" WHERE label = "whatsapp"';
    $conn -> query($sql);
    $conn -> close();
    header('Location: contactdetails.php');
}
?>