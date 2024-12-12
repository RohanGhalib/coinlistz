<?php
include "db.php";
if(isset($_GET["audit"])){
    $trxid = $_GET["trxid"];
    $id = $_GET["audit"];
    $adder = $_GET["adder"];
    $sql = "UPDATE coins SET audited = '1', added_by = '$adder' WHERE coin_id= '$id'";
    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE transactions SET status = 'fulfilled' WHERE id = '$trxid'";
        if ($conn->query($sql) === TRUE) {
            header("location: requests.php");
        } else {
            echo "Error updating record: {$conn->error}";
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if(isset($_GET["auditfree"])){
    $trxid = $_GET["trxid"];
    $id = $_GET["auditfree"];
    $adder = $_GET["adder"];
    $sql = "UPDATE coins SET audited = '1', added_by = '$adder' WHERE coin_id= '$id'";
    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE requests SET status = 'fulfilled' WHERE id = '$trxid'";
        if ($conn->query($sql) === TRUE) {
            header("location: requests.php");
        } else {
            echo "Error updating record: {$conn->error}";
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
}



if(isset($_GET["kyc"])){
    $trxid = $_GET["trxid"];
    $id = $_GET["kyc"];
    $adder = $_GET["adder"];
    $sql = "UPDATE coins SET kyc = '1' , added_by = '$adder' WHERE coin_id= '$id'";
    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE transactions SET status = 'fulfilled' WHERE id = '$trxid'";
        if ($conn->query($sql) === TRUE) {
            header("location: requests.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


if(isset($_GET["kycfree"])){
    $trxid = $_GET["trxid"];
    $id = $_GET["kycfree"];
    $adder = $_GET["adder"];
    $sql = "UPDATE coins SET kyc = '1' , added_by = '$adder' WHERE coin_id= '$id'";
    if ($conn->query($sql) === TRUE) {
        $sql = "UPDATE requests SET status = 'fulfilled' WHERE id = '$trxid'";
        if ($conn->query($sql) === TRUE) {
            header("location: requests.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
if(isset($_GET["fulfill"])){
    $trxid = $_GET["fulfill"];
    $sql = "UPDATE transactions SET status = 'fulfilled' WHERE id = '$trxid'";
    if ($conn->query($sql) === TRUE) {
        header("location: requests.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}