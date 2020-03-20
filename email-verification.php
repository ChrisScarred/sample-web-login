<?php
require "functions/config.php";
session_start();

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
    $result = mysqli_query($link, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $query = "UPDATE users SET verified=1 WHERE token='$token'";

        if (mysqli_query($link, $query)) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['verified'] = true;
            echo '<script>alert("Email verified");</script>';
            header('location: index.php');
            exit(0);
        }
    } else {
        echo "User not found";
    }
} else {
    echo "Token not provided";
}