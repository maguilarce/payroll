<?php

session_start();


if(!isset( $_POST['user'], $_POST['password']))
{
    $message = 'Please enter a valid username and password';
}

else
{
    
    /*** if we are here the data is valid and we can insert it into database ***/
    $user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    
    $dbh = new PDO("mysql:host=localhost;dbname=payroll", "root", "");
    
    /*** prepare query ***/
    $stmt = $dbh->prepare("SELECT * FROM user 
                    WHERE login = :user AND password = :password");
    
    /*** bind the parameters ***/
    $stmt->bindParam(':user', $user, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR, 40);
    
    /*** execute the prepared statement ***/
    $stmt->execute();

    /*** check for a result ***/
    $user_id = $stmt->fetchColumn();
    
    /*** if we have no result then fail boat ***/
        if($user_id == false)
        {
                $message = 'Login Failed';
                echo "<a href='login.php'>Back to login screen</a>";
        }
        /*** if we do have a result, all is well ***/
        else
        {
                /*** set the session user_id variable ***/
                $_SESSION['user_id'] = $user_id;
                
               if($user=='rachel')
               header("Location: dashboard.php");
               
               else if($user=='manager')
               header("Location: dashboard2.php");
               
               else if($user=='foreman')
               header("Location: dashboard3.php");
        }
}