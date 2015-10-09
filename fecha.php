<?php
require_once('connection.php');
//function week_date(date('W'), date('Y'))
    $date = new DateTime();
    $first = $date->setISODate(date('Y'), date('W'), "1")->format('m-d-Y');
    $last = $date->setISODate(date('Y'),date('W'), "7")->format('m-d-Y'); 
    
    
        
     
     $result = mysql_query("SELECT daily_timesheet_id,total_day_hours
                                                             FROM daily_timesheet
                                                             WHERE week_number=week(now()) AND weekday(date)=2 AND daily_timesheet_id = 75",$dbh);
    if (!$result) { // add this check.
    die('Invalid query: ' . mysql_error());
}
                                        $monday = mysql_fetch_array($result,MYSQL_ASSOC);
                                        echo '<br />';
                                        echo "{$monday['total_day_hours']}";
                                        ?>
