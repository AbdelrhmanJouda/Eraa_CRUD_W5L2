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
    $query = "CREATE DATABASE IF NOT EXISTS `$dbName`";
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
        `textarea` VARCHAR(50) NOT NULL,        
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
    $NewConn = mysqli_connect('localhost','root','',$databaseName);
   return $NewConn; 
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
// +++++++++++++  get user name  +++++++++++++
    function GetUser($result){
     $row = mysqli_fetch_assoc($result);
     return $row;
    }
// ++++++++++++++++++++++++++++++++++++++
// +++++++++++++  Read All Users  +++++++++++++
    function GetUsers($connection){
        $query = "SELECT * FROM `users`";
        $result = mysqli_query($connection,$query);
        
        return $result;
    }
// ++++++++++++++++++++++++++++++++++++++


// +++++++++++++    +++++++++++++
// ++++++++++++++++++++++++++++++++++++++