<?php
include "../functions/function.php";
include "../database/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $errors = [];
    $id=$_GET['id'];
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
    } elseif (MaxLen($name, 35)) {
        $errors[] = ' error : name must be less than 35 chars ';
    }
    //details
    if (empty($details)) {
        $errors[] = ' error : details is required ';
    } elseif (MinLen($details, 10)) {
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
        }
        // new connection to use
        $NewConn = newConn(DataBaseName);
        //2 - Update Cat table
            // Update data into table
        if ($NewConn) {
            $UpdatetQuery = " UPDATE `category` SET `name` = '$name', `details`='$details' WHERE `id`='$id' ";
            if (mysqli_query($NewConn, $UpdatetQuery)) {
                $_SESSION['success'] = ['user has been edited successfully'];
                redirect('../pages/category.php');
            } else {
                echo 'error : cant update data';
            }
        } 
    } else {
        $_SESSION['danger'] = $errors;
        redirect("../pages/editCat.php?id=$id&name=$name&details=$details");
    }
} else {
    redirect("../index.php");
}
