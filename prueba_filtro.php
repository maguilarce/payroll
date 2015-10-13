<?php
require_once('connection.php');
$daily_premium_rate=$_POST['daily_premium_rate'];
    $count = count($daily_premium_rate);
    for ($i = 0; $i < $count; $i++) {
        echo $daily_premium_rate[$i]."<br />";
    }

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		
	</head>
	<body>

             
	</body>
</html>