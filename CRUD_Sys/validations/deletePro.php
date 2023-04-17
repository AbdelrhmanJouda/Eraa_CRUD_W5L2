<?php
include "../functions/function.php";
include "../database/conn.php";
session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_SESSION['logedin']) && isset($_SERVER['HTTP_REFERER'])) {
    //catch user
    $id = $_GET['id'];

    //make connection
    $newConn = newConn(DataBaseName);
    //set query delete user
    $query = " DELETE FROM `products` WHERE `id` = '$id' ";
    // DELETE FROM category WHERE `category`.`id`
    if(mysqli_query($newConn,$query)){
        $_SESSION['success']=['Product hass been deleted successfully'];
        //redirect
        redirect("../pages/products.php");
    }
} else {
    redirect("../pages/home.php");
}