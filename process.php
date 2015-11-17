<?php
require_once('connection.php');

//$project_name = $_POST['project'];
$daily_premium_rate=$_POST['daily_premium_rate'];
$daily_sum_rates=$_POST['daily_sum_rates'];
$employee=$_POST['employee'];
$job_function=$_POST['job_function'];
$id=$_POST['id'];
$date = $_POST['date'];


$query = "UPDATE daily_timesheet
          SET processed='yes'
          WHERE daily_timesheet_id='$id'";
$retval = mysql_query( $query, $dbh );
    if(! $retval )
        {
            die('Could not get data: ' . mysql_error());

        }


$count = count($daily_premium_rate);
    for ($i = 0; $i < $count; $i++) 
    {
        $dpr = $daily_premium_rate[$i];
     
        $query = "INSERT INTO daily_premium_rate VALUES ('',week('$date'),'$date','$employee','$job_function','$dpr')";
        $retval = mysql_query( $query, $dbh );
        if(! $retval )
        {
            die('Could not get data: ' . mysql_error());

        }
    }
    
  $count = count($daily_sum_rates);
    for ($i = 0; $i < $count; $i++) 
    {
        $dsr = $daily_sum_rates[$i];
       
       $query = "INSERT INTO daily_lump_rates VALUES ('',week('$date'),'$date','$employee','$job_function','$dsr')";
        $retval = mysql_query( $query, $dbh );
        if(! $retval )
        {
            die('Could not get data: ' . mysql_error());

        }
        
    }

    
    
header('Location: add_daily_data_table.php'); 
?>

