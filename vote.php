<?php
include 'session.php';
include 'sessionstrict.php';
include '../app/db.php';

if(isset($_GET['id'])){

    $id = $_GET['id'];
    $sql = "UPDATE coins SET votes = votes+1 WHERE coin_id = '$id'";
    if($conn->query($sql) === TRUE){
        $sql2 = "INSERT INTO votes (coin_id, username) VALUES ('$id', '$usernameis')";
        if($conn->query($sql2) === TRUE){
            header("location: index.php");
        }
        else{
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
else{
    header("location: index.php");
}
?>