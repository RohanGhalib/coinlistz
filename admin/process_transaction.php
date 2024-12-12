<?php
if(isset($_GET['return'])){
    $returnurl = $_GET['return'];
    
}else{
    $returnurl = 'transactions.php';
}
include('db.php');
if(isset($_GET['approve'])){
    $id = $_GET['approve'];
    $sql = "UPDATE transactions SET status = 'success' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        header("location: $returnurl?success=$id");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
elseif(isset($_GET["cancel"])){
    $id = $_GET["cancel"];
    $sql = "UPDATE transactions SET status = 'cancelled' WHERE id = '$id'";
    if ($conn->query($sql) === TRUE) {
        header("location: $returnurl?cancelled=$id");
    } else {
        echo "". $conn->error;
}
}
?>