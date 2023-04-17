<?php 
define('DataBaseName','aj_store');
const   DB_Host = 'localhost';
const   DB_User = 'root';
const   DB_Password = '';
// connection //
$conn = mysqli_connect("localhost","root",""); 
// +++++++++++++++++++ check connection +++++++++++++++++++
if(!$conn){
    die(mysqli_connect_error());
}