<?php
include "../functions/function.php";
include "../database/conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
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
    //price
    if (empty($price)) {
        $errors[] = ' error : price is required ';
    } elseif (MinLen($price, 2)) {
        $errors[] = ' error : price must be more than 3 char ';
    } elseif (MaxLen($price, 6)) {
        $errors[] = ' error : price must be less than 6 chars ';
    }
    //stock
    if (empty($stock)) {
        $errors[] = ' error : stock is required ';
    } elseif (MinLen($stock, 2)) {
        $errors[] = ' error : stock must be more than 3 char ';
    } elseif (MaxLen($stock, 6)) {
        $errors[] = ' error : stock must be less than 6 chars ';
    }
    //category
    if (empty($category)) {
        $errors[] = ' error : category is required ';
    } elseif (MinLen($category, 2)) {
        $errors[] = ' error : category must be more than 3 char ';
    } elseif (MaxLen($category, 35)) {
        $errors[] = ' error : category must be less than 35 chars ';
    }
    //user
    if (empty($user)) {
        $errors[] = ' error : user is required ';
    } elseif (MinLen($user, 2)) {
        $errors[] = ' error : user must be more than 3 char ';
    } elseif (MaxLen($user, 35)) {
        $errors[] = ' error : user must be less than 35 chars ';
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
        //2 - create Products table  
        if (CreateProTable('products', DataBaseName)) {
            // user table hass been created
            $shaPass = sha1($password);         // hash password
            // insert data into table
            if ($NewConn) {
                $insertQuery = "INSERT INTO `products`
                 (`name`,`email`,`password`) VALUES ('$name','$email','$shaPass') ";
                if (mysqli_query($NewConn, $insertQuery)) {
                    $_SESSION['success'] = ['user has been added successfully'];
                    unset($_SESSION['old']);
                    redirect('../pages/login.php');
                } else {
                    echo 'errror : table cant insert query';
                }
            } else {
                echo 'error connection';
            }
        } else {
            echo "faild to create table";
            die(mysqli_connect_error());
        }
    } else {
        $_SESSION['danger'] = $errors;
        $_SESSION['old'] = ["$name", "$email"];
        redirect('../pages/register.php');
    }
} else {
    redirect("../index.php");
}
