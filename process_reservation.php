<?php
include 'session.php';
include 'sessionstrict.php';
include '../app/db.php';

if(isset($_POST['reserve'])){
$adtype = $_POST['adtype'];
$dates =  $_POST['dates']; 
$email = $usernameis;
$total = $_POST['total'];
$subtotal = $_POST['subtotal'];
$discount = $_POST['discount'];
$calendar = $_POST['calendar'];
$time_created = $_POST['time_created'];
$datesArray = explode(',', $dates);
$datesJson = json_encode($datesArray);

$checkSql = "SELECT * FROM transactions WHERE ad_type='$adtype' AND status IN ('pending', 'success') AND JSON_CONTAINS(dates, '$datesJson')";
if ($calendar == 3) {
    $checkSql .= " AND email='$email'";
}
$result = $conn->query($checkSql);

if ($result->num_rows > 0) {
    header("Location: getservices.php?service=$adtype&error=1");
    exit();
}

$sql = "INSERT INTO transactions (ad_type, dates, email, total, subtotal, discount, status) VALUES ('$adtype', '$datesJson', '$email', '$total', '$subtotal', '$discount', 'pending')";
if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    header("Location: countdown.php?trx=$last_id");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}



if(isset($_GET['cancel'])){
    $id = $_GET['cancel'];
    $sql = "UPDATE transactions SET status = 'failed' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


if(isset($_POST['unlock'])){
    $coinid = $_POST['coinid'];
    $total = $_POST['total'];
    $dates = '[""]';
    $adtype = '5';

    $sql = "INSERT INTO transactions (ad_type, dates, email, total, status, securecoinid) VALUES ('$adtype', '$dates', '$usernameis', '$total',  'pending', '$coinid')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        header("location: unlockbannerpayment.php?trx=$last_id");
    }
    else{
        header('location: unlockbanner.php?error=1');
    }
}   




if(isset($_POST['submit'])){
    $coinid = $_POST['coinid'];
    $total = $_POST['total'];
    $dates = '[""]';
    $adtype = $_POST['adtype'];
    $securename = $_POST['nameinput'];
    $secureemail = $_POST['emailinput'];

    $sql = "INSERT INTO transactions (ad_type, dates, email, total, status, securename, securemail, securecoinid) VALUES ('$adtype', '$dates', '$usernameis', '$total',  'pending', '$securename', '$secureemail', '$coinid')";
    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        header("location: unlockbannerpayment.php?trx=$last_id");
    }
    else{
        header('location: unlockbanner.php?error=1');
    }
    }
?>
