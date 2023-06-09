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
    } elseif (MaxLen($name, 35)) {
        $errors[] = ' error : name must be less than 35 chars ';
    }
    //email
    if (empty($email)) {
        $errors[] = ' error : email is required ';
    } elseif (checkEmail($email)) {
        $errors[] = ' error : email is not valid ';
    } elseif (MaxLen($email, 80)) {
        $errors[] = ' error : email length not accepted ';
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
        } elseif (CreateNewDB(DataBaseName, $conn)) {    // if no database ->  create new database 
            $_SESSION['success'] = [' New data base has been created '];
        } else {
            echo "can't create database";
            die;
        }
        // new connection to use
        $NewConn = newConn(DataBaseName);
        //2 - create USERS table  
        if (CreateUserTable('users', DataBaseName)) {
            // user table hass been created
            // I NEED TO CTERATE ALL OTHER TABLES NOW
            //CATEGORY TABLE
            CreateCatTable('category',DataBaseName);
            //PRODUCTS TABLE
            CreateProTable('products',DataBaseName);
            //
            $shaPass = sha1($password);         // hash password
            // insert data into table
            if ($NewConn) {
                if(emailexists($email,$NewConn)){
                    unset($_SESSION['success']);
                    $_SESSION['danger'] = ['error : this email extists'];
                    redirect("../pages/register.php?name=$name");
                    die;
                }

                $insertQuery = "INSERT INTO `users`
                 (`name`,`email`,`password`) VALUES ('$name','$email','$shaPass') ";
                if (mysqli_query($NewConn, $insertQuery)) {
                    // 
                    $_SESSION['success'] = ['user has been added successfully'];

                    redirect('../pages/login.php');
                } else {
                    $errors[]= 'errror : table cant insert query';
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
        redirect("../pages/register.php?name=$name&email=$email");
    }
} else {
    redirect("../index.php");
}