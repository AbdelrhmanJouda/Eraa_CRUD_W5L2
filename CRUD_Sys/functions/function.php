<?php 
// +++++++++++++  redirect  +++++++++++++
function redirect($path){
  return  header("location:$path");
}
// ++++++++++++++++++++++++++++++++++++++

// +++++++++++++  sanitize value  +++++++++++++
function sanitizeData($value){
    return trim(htmlentities(htmlspecialchars($value)));
}
// ++++++++++++++++++++++++++++++++++++++

// +++++++++++++  validations  +++++++++++++
    //name //email //password //conf_password
    // max // min
    function MaxLen($input,$length){
        if(strlen($input) > $length){
            return true;
        }return false;
    }
    function MinLen($input,$length){
        if(strlen($input) < $length){
            return true;
        }return false;
    }
    // if not email
    function CheckEmail($email){
        if(!filter_var($email,FILTER_VALIDATE_EMAIL,FILTER_SANITIZE_EMAIL)){
            return true;
        }return false;
    }

//+++++++++++++++++++ create database if not exists +++++++++++++++++++
function CreateNewDB($dbName,$connection){
    $query = "CREATE DATABASE IF NOT EXISTS `$dbName` CHARACTER SET UTF8 COLLATE utf8_general_ci";
if(mysqli_query($connection,$query)){
    return true ;
}else {
    return  false;
}
}
//+++++++++++++++++++  +++++++++++++++++++
//+++++++++++++++++++ create user table if not exists +++++++++++++++++++
function CreateUserTable($TableName,$DatabaseName){
    $dbConn = mysqli_connect("localhost","root","",$DatabaseName);
    $query = "CREATE TABLE IF NOT EXISTS `$TableName`(
        `id` INT(6) AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(30) NOT NULL,
        `email` VARCHAR(50) NOT NULL,
        `password` VARCHAR(100) NOT NULL
        
    );";
if(mysqli_query($dbConn,$query)){
    return true ;
}else {
    return  false;
}
}
//+++++++++++++++++++  +++++++++++++++++++
//+++++++++++++++++++ create CATegory table if not exists +++++++++++++++++++
function CreateCatTable($TableName,$DatabaseName){
    $dbConn = mysqli_connect("localhost","root","",$DatabaseName);
    $query = "CREATE TABLE IF NOT EXISTS `$TableName`(
        `id` INT(6) AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(30) NOT NULL,
        `details` VARCHAR(50) NOT NULL,
        `Date_Time` DATETIME DEFAULT CURRENT_TIMESTAMP  
    );";
if(mysqli_query($dbConn,$query)){
    return true ;
}else {
    return  false;
}
}
//++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++ create PRODUCTS table if not exists +++++++++++++++++++
function CreateProTable($TableName,$DatabaseName){
    $dbConn = mysqli_connect("localhost","root","",$DatabaseName);
    $query = "CREATE TABLE IF NOT EXISTS `$TableName`(
        `id` INT(6) AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(30) NOT NULL,
        `price` DECIMAL (6,2) NOT NULL,
        `stock` BOOLEAN NOT NULL,
        `category_id` INT,
        `user_id` INT,
        `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
        `updated_at`  TIMESTAMP,
        FOREIGN KEY(`category_id`) REFERENCES category(`id`),
        FOREIGN KEY(`user_id`) REFERENCES users(`id`)
    );";
if(mysqli_query($dbConn,$query)){
    return true ;
}else {
    return  false;
}
}
//++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++ New connection +++++++++++++++++++
function newConn($databaseName){
    $conn= mysqli_connect('localhost','root','');
    if($conn){
        $query = " SHOW DATABASES LIKE '$databaseName' ";
        $result = mysqli_query($conn,$query);
        $row = mysqli_num_rows($result);
        if($row > 0){
            $NewConn = mysqli_connect('localhost','root','',$databaseName);
           return $NewConn; 
        }
    }return false;
}
//++++++++++++++++++++++++++++++++++++++
//+++++++++++++++++++Insert INTO Table +++++++++++++++++++


// ++++++++++++++++++++++++++++++++++++++
// +++++++++++++  Login query  +++++++++++++
    function LogQuery($email,$password,$newConn,){
        $shaPass = sha1($password);
        $selectQuery = "SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$shaPass' ";
        return mysqli_query($newConn,$selectQuery);
    }
// ++++++++++++++++++++++++++++++++++++++
// +++++++++++++  get user name  +++++++++++++?????
    function GetUser($result){
     $row = mysqli_fetch_assoc($result);
     return $row;
    }

// ++++++++++++++++++++++++++++++++++++++
// +++++++++++++  Read All Users  +++++++++++++
    function GetUsers($connection){
        $query = "SELECT * FROM  `users`";
        $result = mysqli_query($connection,$query);
        
        return $result;
    }
// ++++++++++++++++++++++++++++++++++++++
// +++++++++++++  Read All Categories  +++++++++++++
    function GetCats($connection){
        $query = "SELECT * FROM  `category`";
        $result = mysqli_query($connection,$query);
        return $result;
    }
// ++++++++++++++++++++++++++++++++++++++
// +++++++++++++  Read All Pros  +++++++++++++
    function GetPros($connection){
        $query = "SELECT * FROM  `products`";
        $result = mysqli_query($connection,$query);
        return $result;
    }
// ++++++++++++++++++++++++++++++++++++++


// +++++++++++++    +++++++++++++
// ++++++++++++++++++++++++++++++++++++++