<?php

require_once('connection.php');
session_start();
$state=$_POST['state'];
$county=$_POST['county'];
$a_employees=$_POST['employees'];
$project_name = $_POST['pname'];
$project_description = $_POST['pdescription'];
$general_contractor = $_POST['general_contractor'];
$in_charge_of = $_POST['in_charge_of'];
$starting_date = $_POST['starting_date'];
$completion_date = $_POST['completion_date'];

$teamster = "teamster";
$operators = "operators";
$laborer = "laborer";

for($i=0;$i<count($state);$i++)
{
    $group = "group".$i;
    $operator = $_POST[$group]['operator'];
    $teamster = $_POST[$group]['teamster'];
    $laborer = $_POST[$group]['laborer'];

    $query = "INSERT INTO jurisdiction VALUES ('','$project_name','$county[$i]','$state[$i]','$operator','$laborer','$teamster')";
    $result = mysql_query($query,$dbh);
}

for($j=0;$j<count($a_employees);$j++)
{
    $query2 = "INSERT INTO emp_proj VALUES ('','$project_name','$a_employees[$j]')";
    $result2 = mysql_query($query2,$dbh);
    
}

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

	</head>
	<body>

<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10">
            <div class="row">
                <!-- center left-->
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>New Project Profile Created Succesfuly</h4>
                                <h4><strong>Project Name: </strong><br><?php echo $project_name; ?></h4>
                                <h4><strong>Project Description: </strong><br><?php echo $project_description; ?></h4>
                                <h4><strong>General Contractor: </strong><br><?php echo $general_contractor; ?></h4>
                                <h4><strong>Person in charge of the project: </strong><br><?php echo $in_charge_of; ?></h4>
                                <h4><strong>Employees in this Project:</strong><br> 
                                <?php
                                for($j=0;$j<count($state);$j++)
                                {   $query3="SELECT * FROM employee WHERE employee_id='".$a_employees[$j]."'";
                                    $res3= mysql_query($query3,$dbh);
                                    $row3=  mysql_fetch_array($res3);
                                    echo $row3['name']."<br>";}
                                ?>
                                </h4>
                                <h4><strong>County(ies) where the project has jurisdiction: </strong><br>
                                <?php 
                                for($i=0;$i<count($state);$i++)
                                {echo $county[$i]." - ".$state[$i]."<br>";}
                                ?>
                                </h4>
                                <h4><strong>Starting date: </strong><br /><?php echo $starting_date; ?></h4>
                                <h4><strong>Completion date: </strong><br /><?php echo $starting_date; ?></h4>
                            </div>
                            
                            <form action="project_table.php">
                                <button type="submit" class="btn btn-primary" title="Back"><i class="glyphicon glyphicon-backward"></i> Back to Projects List</button>
                                <!--<input type="submit" value="Back">-->
                            </form>
                           
                        </div>
                        
                        <!--/panel content-->
                    </div>
                    <!--/panel-->                
                <!--/col-span-6-->

            </div>
            <!--/row-->
           
        </div>
        <!--/col-span-9-->
    </div>
    </div></div>
<!-- /Main -->
<div class="modal" id="addWidgetModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Widget</h4>
            </div>
            <div class="modal-body">
                <p>Add a widget stuff here..</p>
            </div>
            <div class="modal-footer">
                <a href="#" data-dismiss="modal" class="btn">Close</a>
                <a href="#" class="btn btn-primary">Save changes</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dalog -->
</div>
<!-- /.modal -->
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>



