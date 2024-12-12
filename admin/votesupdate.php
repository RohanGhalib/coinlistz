<?php
include 'db.php';
if(isset($_GET['votes'])){
    $votes = $_GET['votes'];
    $coinid = $_GET['coinid'];
    $sql = "UPDATE coins SET votes = $votes WHERE coin_id = $coinid";
    if ($conn->query($sql) === TRUE) {
        header('location: allcoins.php');
    } else {
        echo '<div class="alert alert-danger" role="alert">
        Error updating votes: ' . $conn->error.'
      </div>';
    }
}