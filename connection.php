<?php
require_once('dbconfig.php');

#  Check database to host connection 
if(!function_exists('mysql_connect'))
{
    echo 'PHP cannot find the mysql extension. MySQL is required for run. Aborting.';
    exit();
}

$dbh = @mysql_connect($server, $user, $password)
or die('Error: Database to host connection: '.mysql_error());

mysql_select_db($db, $dbh)
or die('Error: Select database: '.mysql_error());
?>