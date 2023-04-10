<?php
session_start();
unset($_SESSION['logedin']);
unset($_SESSION['old']);
session_destroy();
header('location:../pages/login.php');
?>