<?php
include "../functions/function.php";
include "../database/conn.php";
session_start();

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
    }elseif(!is_numeric($price)){
        $errors[] = 'error : price should be number';
    }
    //stock
    if (empty($stock)) {
        $errors[] = ' error : stock is required ';
    } elseif (MaxLen($stock, 6)) {
        $errors[] = ' error : stock must be less than 6 chars ';
    }elseif(!is_numeric($stock)){
        $errors[] = 'error : stock should be number';
    }
    //category
    
    //user
   
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
            // products table hass been created
            // insert data into table
            if ($NewConn) {
                $insertQuery = "INSERT INTO `products`(`name`,`price`,`stock`,`category_id`,`user_id`) 
                VALUES ('$name','$price','$stock','$category_id','$user_id') ";
                if (mysqli_query($NewConn, $insertQuery)) {
                    $_SESSION['success'] = ['product has been added successfully'];
                    redirect('../pages/products.php');
                }
            }
    } else { 
        $_SESSION['danger'] = $errors;
        redirect("../pages/addProduct.php?name=$name&price=$price");
    }
} else {
    redirect("../index.php");
}