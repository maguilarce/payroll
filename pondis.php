<?php
require_once('connection.php');
$query = "SELECT * from premium_rate;";
$result1 = mysql_query($query);

while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
    {

        $value[] = $row1['premium_rate_type'];
        

    }
    print_r($value);
?>
