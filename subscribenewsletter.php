<?php
if(isset($_POST["email"])){
    $email = $_POST["email"];
    $sql = "INSERT INTO newsletter (email) VALUES ('$email')";
    $result = $conn -> query($sql);
}
    if($conn -> query($sql) === TRUE){
        header("location: index.php");
}
else{
    header('location: index.php');
}