<?php

require_once('connection.php');
session_start();
////////////////retrieving data from controls
    $employee = $_POST['employee'];
    $job_function = $_POST['job_function'];
    $pay_rate = $_POST['pay_rate'];
    $pay_rate_type = $_POST['prt2'];
    $premium_rate = $_POST['daily_premium_rate'];//contar y mandar a la bd - es un arreglo, no una variable
    $daily_lump_sum_rate = $_POST['daily_lump_sum_rate'];//contar y mandar a la bd - es un arreglo, no una variable
    $total_hours = $_POST['worked_hours'];
    $status = $_POST['status'];
    $notes = $_POST['notes'];
    $project_name = $_POST['project_name'];
    $nones=$_POST['nones'];
    //////////inserting data into daily timesheet
    $query = "INSERT INTO daily_timesheet(date,week_number,employee_name,job_function,total_day_hours,status,pay_rate,pay_rate_type,daily_notes,associated_project,processed) VALUES (now(),week(now(),3),'$employee','$job_function','$total_hours','$status','$pay_rate','$pay_rate_type','$notes','$project_name','yes')";
    $retval = mysql_query( $query, $dbh );
    if(! $retval )
    {
     die('Could not get data: ' . mysql_error());

    }
    
    
    if($nones==0)
    {
//////////inserting data into daily premium rates
    $count = count($premium_rate);
    for ($i = 0; $i < $count; $i++)
    {
        $query = "INSERT INTO daily_premium_rate VALUES ('',week(now()),now(),'$employee','$job_function','$premium_rate[$i]','$pay_rate')";
        $retval = mysql_query( $query, $dbh );
        if(! $retval )
        {
            die('Could not set data: ' . mysql_error());
        }
//////////inserting data into daily lump sum rates
        $count = count($daily_lump_sum_rate);
        for ($i = 0; $i < $count; $i++)
        {
        $query = "INSERT INTO daily_lump_rates VALUES ('',week(now()),now(),'$employee','$job_function','$daily_lump_sum_rate[$i]','$pay_rate')";
        $retval = mysql_query( $query, $dbh );
        if(! $retval )
        {
            die('Could not set data: ' . mysql_error());
        }
        }
    
    }
    
    
    }
    if($nones==1)
    {
        $query = "INSERT INTO daily_premium_rate VALUES ('',week(now()),now(),'$employee','$job_function','none','$pay_rate')";
        $retval = mysql_query( $query, $dbh );
        if(! $retval )
        {
            die('Could not set data: ' . mysql_error());
        }
        
        $query = "INSERT INTO daily_lump_rates VALUES ('',week(now()),now(),'$employee','$job_function','none','$pay_rate')";
        $retval = mysql_query( $query, $dbh );
        if(! $retval )
        {
            die('Could not set data: ' . mysql_error());
        }
    
        
        
    }
    
    
    

    
 ////////acumulating weekly hours for each employee
    
    $query1 = "SELECT * FROM week_hours WHERE employee_name = '$employee' and week_number = week(now());";
    $row = mysql_query( $query1, $dbh );
    $num_rows = mysql_num_rows($row);
    

    if($num_rows==0){
        //Run an insert query on this table
            $query1 = "INSERT INTO week_hours VALUES ('',week(now(),3),'$employee','$total_hours')";
            $row = mysql_query( $query1, $dbh );
            if(! $row )
            {
             die('Could not get data: ' . mysql_error());
     
     
            }
    } 
    else {
            
            $query1 = "UPDATE week_hours SET total_week_hours = total_week_hours + '$total_hours' WHERE employee_name = '$employee' and week_number = week(now(),3);";
            $row = mysql_query( $query1, $dbh );
            if(! $row )
            {
             die('Could not get data: ' . mysql_error());
     
     
            }
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
        <div class="col-sm-12">                         
            <div class="row">
                <!-- center left-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>New daily data added successfully</h4>
                            </div>
                            <form action="add_daily_data_table.php" method="post">
                                <button type="submit" class="btn btn-primary">Back</button>
                                <input type="hidden" name="project" value="<?php echo $project_name; ?>">
                            </form>
                           
                        </div>
                        
                        <!--/panel content-->
                    </div>
                    <!--/panel-->                
                            <!--
			right MENU
		<!-->
          
                <!--/col-span-6-->

            </div>
            <!--/row-->

            <hr>

           
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