<?php
session_start();
if($_SESSION['logged'])
{    

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Let LLC Time Sheet App</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">		
		<link href="css/styles.css" rel="stylesheet">
                <link href="css/bootstrap.min.css" rel="stylesheet">
                <!-- date picker css -->
                <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
                 <!-- date picker bootstrap -->
                <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
                 <!-- filter and pagination -->
                <script type="text/javascript" language="javascript" src="js/tablefilter.js"></script>         
                <link href="css/style/tablefilter.css" rel="stylesheet">
                <link href="css/style/colsVisibility.css" rel="stylesheet">
                <link href="css/style/filtersVisibility.css" rel="stylesheet">
                <!--end filter and pagination -->
              	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

	</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <!-- Left column -->
            <img src="let-logo.png" /><br/>
            <a href="#"><strong><i class="glyphicon glyphicon-wrench"></i>Workers</strong></a>
            <br>
            <ul class="nav nav-stacked">                
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu1"><strong>Options</strong> <i class="glyphicon glyphicon-user"></i></a>
                    <ul class="nav nav-stacked collapse in" id="menu1">      
                         <li class="active"> <a href="create_daily_timesheet_superintendent1.php" target="mainFrame">Office Manager<br>Daily Timesheets</a></li>
                        <li class="active"> <a href="create_daily_timesheet_foreman.php" target="mainFrame">Foreman <br> Daily Timesheets</a></li>                    
                    </ul>
                </li>
            </ul>
        </div>
    </div></div>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
 
  <?php } 
else{ 
header("Location: index.php");  } ?>     
    
</body>
</html>
            
        
