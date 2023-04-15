<?php
include "../functions/function.php";
include "../database/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    $errors = [];
    $shaPass = '';
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
    //password
    if (empty($password)) {
        $errors[] = ' error : password is required ';
    } elseif (MinLen($password, 6)) {
        $errors[] = ' error : password must be more than 3 char ';
    } elseif (MaxLen($password, 20)) {
        $errors[] = ' error : password must be less than 20 chars ';
    }
    // conf_password
    if ($password !== $Conf_password) {
        $errors[] = ' error : confirm password not the same';
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
        //2 - Update USERS table  
            $shaPass = sha1($password);         // hash password
            // Update data into table
        if ($NewConn) {
            $UpdatetQuery = " UPDATE `users` SET `name` = '$name', `password`='$shaPass' WHERE `id`='$id' ";
            if (mysqli_query($NewConn, $UpdatetQuery)) {
                $_SESSION['success'] = ['user has been edited successfully'];
                redirect('../pages/users.php');
            } else {
                echo 'error : cant update data';
            }
        } 
    } else {
        $_SESSION['danger'] = $errors;

        redirect("../pages/editUser.php?id=$id&name=$name");
    }
} else {
    redirect("../index.php");
}
