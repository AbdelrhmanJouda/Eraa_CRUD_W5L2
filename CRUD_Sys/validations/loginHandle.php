<?php
include "../functions/function.php";
include "../database/conn.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER['HTTP_REFERER'])) {
    $errors = [];
    $shaPass = '';
    // ================sanitization=================
    foreach ($_POST as $key => $value) {
        $$key = sanitizeData($value);
    }
    // ================Validations=================
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
    // =============================================
    // =================if no error====================
    if (empty($errors)) {
        //check if data exists
        //check if table exists
        //make connection with database

        
        if(newConn(DataBaseName)){
        $NewConn = newConn(DataBaseName);
        // select all data from table
       $result = LogQuery($email,$password,$NewConn);
       $row = GetUser($result);
       if($row){
            $_SESSION['user'] = $row;
            $_SESSION['success']=['welcome'];
            $_SESSION['logedin']=true;
            redirect("../pages/home.php");
            mysqli_free_result($result);
            mysqli_close($NewConn);
        }else{
                $_SESSION['danger']=['email or password not match'];
                redirect('../pages/login.php');
        }
        } else{
            $_SESSION['danger']= ['make a register to start using th app'];
            redirect("../pages/register.php");
        }
    


    } else {
        $_SESSION['danger'] = $errors;
        redirect('../pages/login.php');
    }
} else {
    redirect("../index.php");
}