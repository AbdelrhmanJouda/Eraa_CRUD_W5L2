<?php
include "../functions/function.php";
include "../database/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $shaPass = '';
    // ================sanitization=================
    foreach ($_POST as $key => $value) {
        $$key = sanitizeData($value);
    }
    // ================Validations=================
    //name
    if (empty($name)) {
        $errors[] = ' error : name is required ';
    } elseif (MinLen($name, 2)) {
        $errors[] = ' error : name must be more than 3 char ';
    } elseif (MaxLen($name, 10)) {
        $errors[] = ' error : name must be less than 35 chars ';
    }
    //details
    if (empty($details)) {
        $errors[] = ' error : details is required ';
    } elseif (MinLen($details, 3)) {
        $errors[] = ' error : details must be more than 3 char ';
    } elseif (MaxLen($details, 35)) {
        $errors[] = ' error : details must be less than 35 chars ';
    }
    
    // =============================================
    // =================if no error====================

    if (empty($errors)) {
        
        //1 - check connection
        if (!$conn) {
            echo "error check connection";
            die(mysqli_connect_error());
        } elseif (CreateNewDB(DataBaseName, $conn)) {    // if no database ->  create new database 
            $_SESSION['success'] = [' New data base has been created '];
        } else {
            echo "can't create database";
            die;
        }
        // new connection to use
        $NewConn = newConn(DataBaseName);
        //2 - create Category table
        if (CreateCatTable('category', DataBaseName)) {
            // category table hass been created
            // insert data into table
            if ($NewConn) {
                $insertQuery = "INSERT INTO `category`
                 (`name`,`details`) VALUES ('$name','$details') ";
                if (mysqli_query($NewConn, $insertQuery)) {
                    $_SESSION['success'] = ['Category has been added successfully'];
                    redirect('../pages/category.php');
                }
            }
        }
    } else {
        $_SESSION['danger'] = $errors;
        redirect("../pages/addcategory.php?name=$name&details=$details");
    }
} else {
    redirect("../index.php");
}
