<?php
require_once('connection.php');
session_start();
$project_name = $_POST['project']; 
$weekly_lump_payments=$_POST['weekly_lump_payments'];
$employee=$_POST['employee'];
$job_function=$_POST['job_function'];
$id=$_POST['id'];
$date = $_POST['date'];


$query = "UPDATE daily_timesheet
          SET processed_week='yes'
          WHERE daily_timesheet_id='$id'";
$retval = mysql_query( $query, $dbh );
    if(! $retval )
        {
            die('Could not get data: ' . mysql_error());

        }

$count = count($weekly_lump_payments);
    for ($i = 0; $i < $count; $i++) 
    {
        $wlp = $weekly_lump_payments[$i];
     
        $query = "INSERT INTO weekly_lump_payments_employees VALUES ('',week('$date'),'$employee','$job_function','$wlp')";
        $retval = mysql_query( $query, $dbh );
        if(! $retval )
        {
            die('Could not get data: ' . mysql_error());

        }
    }
    
    header('Location: add_weekly_data_table.php'); 
?>
