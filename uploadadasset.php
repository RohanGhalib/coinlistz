<?php 
include 'session.php';
include 'sessionstrict.php';
include '../app/db.php';

if(isset($_POST['url'])){
    $url = $_POST['url'];
    $date = $_POST['date'];
    $adtype = $_POST['type'];
    $image = $_FILES['image']['name'];
    $addedby = $usernameis;
    $target_dir = "user_assets/";
    $target_file = $target_dir . basename($image);   // Check if the uploaded file is an image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if($check !== false) {
        // File is an image
    } else {
        echo "File is not an image.";
        exit;
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image_path = $target_file;

        $sql = "INSERT INTO calendar (link, date, type, asset, added_by) VALUES ('$url', '$date', '$adtype', '$image_path', '$addedby')";
        if (mysqli_query($conn, $sql)) {
            header("location: userservice.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}


if(isset($_POST["coin"])){
    $coin = $_POST['coin'];
    $addedby = $usernameis;
    $image = $_FILES['image']['name'];
    $target_dir = "user_assets/";
    $target_file = $target_dir . basename($image);   // Check if the uploaded file is an image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if($check !== false) {
        // File is an image
    } else {
        echo "File is not an image.";
        exit;
    }

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        $image_path = $target_file;

        $sql = "UPDATE coins SET banner_link='$target_file', added_by='$addedby' WHERE coin_id='$coin'";
        if (mysqli_query($conn, $sql)) {
            header("location: userservice.php?success");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>