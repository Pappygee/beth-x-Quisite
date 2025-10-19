<?php
session_start();

$stored_username = "admin";
$stored_password = "admin123";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if($username === $stored_username && $password === $stored_password){
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit();
    } else {
        header("Location: login.html?error=1");
        exit();
    }
}
?>