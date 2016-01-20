<?php

session_start();
require_once('connection.php');
include "upd_log.php";

if(!isset( $_POST['user'], $_POST['password']))
{
    $message = 'Please enter a valid username and password';
}

else
{
    
    /*** if we are here the data is valid and we can insert it into database ***/
    $user = filter_var($_POST['user'], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    
    /*
    $dbh = new PDO("mysql:host=localhost;dbname=payroll", "root", "");  
    // prepare query //
    $stmt = $dbh->prepare("SELECT * FROM user WHERE login = :user AND password = :password");
    // bind the parameters //
    $stmt->bindParam(':user', $user, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR, 40);
    // execute the prepared statement ///
    $stmt->execute();
    // check for a result //
    $user_id = $stmt->fetchColumn();
     */
     
    $sql = "SELECT * FROM user WHERE login = '$user' AND password ='$password'";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $user_id = $row[0];
    $user_type = $row[6];
    //if we have no result then fail boat //
        if($user_id == false)
        {
                echo 'Login Failed<br/>';
                echo "<a href='index_cel.php'>Back to login screen</a>";
                 $accion="MOBILE LOGIN FAILED ";
                 $origen=$_SERVER['REMOTE_ADDR'];
                 generaLogs($user,$accion,$origen);
        }
        /*** if we do have a result, all is well ***/
        else
        {
                /*** set the session user_id variable ***/
               $_SESSION['user_id'] = $user;
               $_SESSION['logged'] = 1;
               $accion="MOBILE LOGIN ";
               $origen=$_SERVER['REMOTE_ADDR'];
               generaLogs($user,$accion,$origen);
               if($user_type =='admin')
               header("Location: dashboard_cel.php?ty=1");
               else if($user_type == 'manager')
               header("Location: dashboard_cel.php?ty=2");
               else if($user_type == 'foreman')
               header("Location: dashboard_cel.php?ty=3");
               else if($user_type == 'superintendent')
               header("Location: dashboard_cel.php?ty=4");
               else 
                echo "Login Failed<br/><a href='index.php'>Back to login screen</a>";
        }
}