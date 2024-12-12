<?php
session_start();
if (isset($_SESSION['username'])) {
    header('location: index.php');
    exit();
}
include '../app/db.php';
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            session_start();
            $_SESSION['username'] = $email;
            header('location: index.php');
        } else {
            header('location: auth/');
        }
    } else {
        header('location: auth/');
    }
}
else{
    header('location: auth/');
}
?>
<form action="login.php" method="POST">
    <input type="email" name="email" id="" required>
    <input type="password" name="password" required>
    <input type="submit" value="Login">
</form>