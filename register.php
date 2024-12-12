<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location: index.php');
    exit();
}
include '../app/db.php';
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    // Check if the user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        header("location: auth/register.html");
    } else {
        // Insert the new user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);
        if($stmt->execute() === TRUE){
            $_SESSION['username'] = $email;
            header('Location: index.php');
        } else {
           header('location: auth/register.html');
        }
    }
    $stmt->close();
}
?>
<form action="register.php" method="POST">
    <input type="email" name="email" id="" required>
    <input type="password" name="password" required>
    <input type="submit" value="Register">
</form>