<?php
require_once('connection.php');

$counties = "York,
Churchill,
Clark,
Douglas,
Elko,
Esmeralda,
Eureka,
Humboldt,
Lander,
Lincoln,
Lyon,
Mineral,
Nye,
Pershing,
Storey,
Washoe,
White Pine,
Carson City";
$array = explode(",",$counties);
print_r($array);

for ($i=0;$i<count($array);$i++)
{
    $county = trim($array[$i]);
    $query = "INSERT INTO counties VALUES ('','$county','Nevada')";
    $result = mysql_query($query);
    if(! $result )
    {
        die('Could not get data: ' . mysql_error());

    }
}




?> 


