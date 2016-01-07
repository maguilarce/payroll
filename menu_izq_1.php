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
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu1"><strong>Employee Info</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu1">
                        <li> <a href="add_employee_form.php" target="mainFrame">Add New Employee</a></li>
                        <li> <a href="edit_employee_table.php" target="mainFrame">Modify/Delete Employee</a></li>
                        <!--<li class="active"> <a href="delete_employee_table.php" target="mainFrame">Delete employee</a></li>-->
                    </ul>
                </li>
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2"><strong>Job functions</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu2">
                        <li><a href="add_job_function_table.php" target="mainFrame">Add/Modify/Delete<br>Job Function</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu3"><strong>Status</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu3">
                       <li><a href="add_status_table.php" target="mainFrame">Add/Modify/Delete<br>Status</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu4"><strong>Union trade</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu4">
                        <li><a href="add_union_trade_table.php" target="mainFrame">Add/Modify/Delete<br>Union Trade</a>
                        </li>

                    </ul>
                </li>
                
            </ul>
            <br>
            <a href="#"><strong><i class="glyphicon glyphicon-link"></i> Rates</strong></a>
            <br>
            <ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu5"><strong>Pay rates</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu5">
                        <li > <a href="add_pay_rate_table.php" target="mainFrame">Add/Modify/Delete pay rate</a></li>
                    </ul>
                </li>
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu6"><strong>Premium rates</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>

                    <ul class="nav nav-stacked collapse" id="menu6">
                        <li><a href="add_premium_rate_table.php" target="mainFrame">Add/Modify/Delete premiun rate</a>
                        </li>
                    </ul>
                </li>
                 <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu7"><strong>Lump Sum Payments</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu7">
                        <li><a href="add_lump_payment_table.php" target="mainFrame">Add/Modify/Delete Daily lump sum payment</a>
                        </li>
                        <li><a href="add_weekly_lump_payment_table.php" target="mainFrame">Add/Modify/Delete Weekly lump sum payment</a>
                        </li>
                    </ul>
                </li>
            </ul>

           <br>

            <a href="#"><strong><i class="glyphicon glyphicon-link"></i> Projects</strong></a>

            <br>

            <ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu8"><strong>Projects</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu8">
                        <li> <a href="create_project_profile1.php" target="mainFrame">Project Profiles</a></li>
                        <li> <a href="project_table.php" target="mainFrame">Current Projects</a></li>
                    </ul>
                </li>
                
                                
            </ul>
            <br>
            <a href="#"><strong><i class="glyphicon glyphicon-link"></i> Users</strong></a>
            <br>
            <ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu9"><strong>Users Options</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu9">
                        <li> <a href="add_user_form.php" target="mainFrame">Create User</a></li>
                        <li> <a href="edit_user_table.php" target="mainFrame">Edit/Delete User</a></li>

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
</body> </html>     