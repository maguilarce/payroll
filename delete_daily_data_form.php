<?php
require_once('connection.php');
session_start();
    $project_name = $_POST['project'];  
    $pay_rate = $_POST['pay_rate']; 
    $daily_timesheet_id = $_POST['id'];
    $query = "DELETE FROM daily_timesheet WHERE daily_timesheet_id = '$daily_timesheet_id' ";
    $retval = mysql_query( $query, $dbh );
    if(! $retval )
    {
     die('Could not get data: ' . mysql_error());
    }
    
    
   $preview_hours = $_POST['preview_hours'];
   $employee = $_POST['employee'];
   $job_function = $_POST['job_function'];
   $date = $_POST['date'];
   
 //******************************************************************************************************************************************************************  
//deleting daily premium rates

    $query = "DELETE FROM daily_premium_rate WHERE date = '$date' AND employee = '$employee' AND job_function = '$job_function' AND pay_rate = '$pay_rate' ";
    $result1 = mysql_query($query);
    if(! $result1 )
        {
            die('Could not get data: ' . mysql_error());
        }
   
   //deleting daily lump rates
   
   $query = "DELETE FROM daily_lump_rates WHERE date = '$date' AND employee = '$employee' AND job_function = '$job_function' AND pay_rate = '$pay_rate'";
    $result1 = mysql_query($query);
    if(! $result1 )
        {
            die('Could not get data: ' . mysql_error());
        }
   
 ////******************************************************************************************************************************************************************  
    ////////acumulating weekly hours for each employee
    
    $query1 = "SELECT * FROM week_hours WHERE employee_name = '$employee' and week_number = week(now(),3);";
    $row = mysql_query( $query1, $dbh );
    $num_rows = mysql_num_rows($row);
    

    if($num_rows>0){
        $query1 = "UPDATE week_hours SET total_week_hours = total_week_hours - '$preview_hours' WHERE employee_name = '$employee' and week_number = week(now(),3);";
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
        <div class="col-sm-9">
            <div class="row">
                <!-- center left-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>Daily register deleted successfully</h4>
                            </div>
                            <form name="delete_form" action="add_daily_data_table.php" method="post">
                                <input type="submit" value="Back">
                                <input type="hidden" name='project' value="<?php echo $project_name;?>">
                            </form>
                           
                        </div>
                        
                        <!--/panel content-->
                    </div>
                    <!--/panel-->                
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