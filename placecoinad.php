<?php 
include 'session.php';
include 'sessionstrict.php';
include '../app/db.php';

if(isset($_POST['date'])){
    $coinid = $_POST['coinid'];
    $date = $_POST['date'];
    $adtype = $_POST['type'];
    $addedby = $usernameis;

    
    $sql = "INSERT INTO calendar (link, date, type,  added_by, extra_asset2) VALUES ('', '$date', '$adtype',  '$addedby', '$coinid')";
    if (mysqli_query($conn, $sql)) {
        header("location: userservice.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    
}
?>