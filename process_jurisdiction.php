<?php

require_once('connection.php');

/*$state=$_GET['state'];
$county=$_GET['county'];
$operators=$_GET['operators'];
$teamster=$_GET['teamster'];
$laborer=$_GET['laborer'];*/

$counties = $_GET['counties'];

print_r($counties);
echo "<br />";
$decode = array();
$decode2 = array();

for($i=0;$i<count($counties);$i++)
{
    echo $counties[$i]."<br />";
    $decode[$i] = urldecode($counties[$i]);
}

for($i=0;$i<count($counties);$i++)
{
    
    $decode2[$i] = urldecode($decode[$i]);
}

echo "<br />";
print_r($decode2);//ESTE ES EL Q SE VA A ENVIAR

/*$query = "INSERT INTO jurisdiction VALUES ('','','$county','$state','$operators','$laborer','$teamster','yes')";
$result = mysql_query($query);
if(! $result )
    {
     die('Could not get data: ' . mysql_error());

    }
 */
    
//header('Location: create_project_profile4.php?counties='.serialize($counties_decode)); 

