<?php
require_once('connection.php');
session_start();
    $project_name = $_POST['project'];
    $id = $_POST['id'];
    $new_job_function = $_POST['job_function'];
    $old_jf = $_POST['old_jf'];
    $date = $_POST['date'];
    $new_pay_rate = $_POST['pay_rate'];
    $new_pay_rate_type = $_POST['nprt'];
    $new_total_hours = $_POST['worked_hours'];
    $new_status = $_POST['status'];
    $new_notes = $_POST['notes'];
    $preview_hours = $_POST['preview_hours'];
    $employee = $_POST['employee'];
  
//update daily worker data
    $query = "UPDATE daily_timesheet
              SET job_function='$new_job_function',
                  pay_rate='$new_pay_rate',
                  pay_rate_type='$new_pay_rate_type',
                  total_day_hours = '$new_total_hours',
                  status='$new_status',
                  daily_notes='$new_notes'
              WHERE daily_timesheet_id=' $id'";
    
    
    $retval = mysql_query( $query, $dbh );
    if(! $retval )
    {
     die('Could not get data: ' . mysql_error());
    }
    


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
    //updating accumalated hours
    $query1 = "UPDATE week_hours SET total_week_hours = total_week_hours - '$preview_hours'+'$new_total_hours' WHERE employee_name = '$employee' and week_number = week(now(),3);";
    $row = mysql_query( $query1, $dbh );
    if(! $row )
        {
        die('Could not get data: ' . mysql_error());
        
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
                                <h4>Register modified successfully</h4>
                            </div>
                            <form action="add_daily_foreman_data_table.php" method="post">
                               <div class="controls">
                                        <button type="submit" class="btn btn-primary">
                                            Back
                                        </button>
                                    </div>
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