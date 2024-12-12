<?php
include 'session.php';
include 'sessionstrict.php';
include '../app/db.php';
if(isset($_FILES["file"])) {
    $service = $_POST['service'];
    $name = $_POST['name'];
    $coinid = $_POST['coinid'];
    $email = $_POST['email'];
    $file = $_FILES['file']['name'];
    $target_dir = "user_assets/";
    $target_file = $target_dir . basename($file);   // Check if the uploaded file is an image
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        $image_path = $target_file;
        $sql = "INSERT INTO requests (service_type, name, email, proof, status, user, coinid) VALUES ('$service', '$name', '$email', '$target_file', 'pending', '$usernameis', '$coinid')";
        if (mysqli_query($conn, $sql)) {
            header("location: success.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}