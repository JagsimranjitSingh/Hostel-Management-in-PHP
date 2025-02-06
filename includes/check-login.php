<?php
function check_login()
{
    // session_start(); // Ensure the session is started
    if (!isset($_SESSION['login']) || strlen($_SESSION['login']) == 0) {
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost';
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = "index.php";
        $_SESSION["login"] = ""; // Optionally initialize it to an empty string
        header("Location: http://$host$uri/$extra");
        exit(); // Stop script execution after redirect
    }
}
