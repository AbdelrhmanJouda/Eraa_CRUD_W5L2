<?php
include "../functions/function.php";
include "../database/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['logedin']) && isset($_SERVER['HTTP_REFERER'])) {
    echo $_GET['email'];
    //catch user
    $email = $_GET['email'];

    //make connection
    $newConn = newConn(DataBaseName);
    //set query delete user
    $query = " DELETE FROM `users` WHERE `email` = '$email' ";
    if(mysqli_query($newConn,$query)){
        $_SESSION['success']=['user hass been deleted successfully'];
        //redirect
        redirect("../pages/users.php");
    }
} else {
    redirect("../pages/home.php");
}