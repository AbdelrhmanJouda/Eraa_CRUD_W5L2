<?php
include "../functions/function.php";
include "../database/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['logedin']) && isset($_SERVER['HTTP_REFERER'])) {
    echo $_GET['id'];
    //catch user
    $id = $_GET['id'];

    //make connection
    $newConn = newConn(DataBaseName);
    //set query delete user
    $query = " DELETE FROM `category` WHERE `id` = '$id' ";
    // DELETE FROM category WHERE `category`.`id`
    if(mysqli_query($newConn,$query)){
        $_SESSION['success']=['Cat hass been deleted successfully'];
        //redirect
        redirect("../pages/category.php");
    }
} else {
    redirect("../pages/home.php");
}