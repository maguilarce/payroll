<?php
require_once('connection.php');
session_start();
$project_name = $_POST['p_pname'];
$result = mysql_query("SELECT daily_timesheet_id,employee_name,employee.union_trade,job_function,pay_rate,total_day_hours,daily_timesheet.status
FROM employee INNER JOIN daily_timesheet
ON employee.name=daily_timesheet.employee_name
WHERE date = CURDATE() AND associated_project = '$project_name';");

if(mysql_num_rows($result)==0)
{
    $message="Alert: You have not yet entered any record.";
}
else
{
    $message = "";
}

$retval2 = mysql_query("SELECT county,state FROM jurisdiction WHERE project_name = '$project_name'");


$user = $_SESSION['user_id'];
$sql_n = "SELECT * FROM user where login ='$user'";
$result_n =  mysql_query($sql_n);
$row_n = mysql_fetch_array($result_n);
$signature=$row_n['f_name']." ".$row_n['l_name'];


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
                <script type="text/javascript" src="js/jQuery.print.js"></script>  
                <script type="text/javascript"> 
                    $(document).ready(function()
                  {             
                    $( ".delete" ).submit(function( event ) {
                    if(!confirm( "This will delete selected daily data. Are you sure?" ))
                        event.preventDefault();
                    });
                   });
                </script>
<script>
    function P_div4(){$(area).print(); return( false );}
    </script>
	</head>
	<body>
<!-- header -->

<!-- /Header -->

<!-- Main -->
<div id="boton_print">
  <div class="controls">
    <button type="button" class="btn btn-primary" onclick="P_div4();">Print Daily Time Sheet</button>
  </div> </div><hr>
<div id="area">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">

            <div class="row">
                <!-- center left-->
                <div class="col-md-14">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <img src="let-logo.png" /><br/>
                        <h4><strong>Daily Time Sheet - Foreman</strong></h4>
                        <table class="table table-striped table-bordered table-hover">
                            <h4>
                            <tr><td><strong>Date:</strong> <?php echo date("F j, Y");?></td></tr>
                            <tr><td><strong>Project Name: </strong><?php echo $project_name;?></td></tr>
                           
                            </h4>
                        </table>
                                
                    </div>
               
                 <h4><strong style="color: red"><?php echo  $message;?></strong></h4><br />
                    <table id="demo" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>Employee Name</th>
                                    <th>Union Trade</th>
                                    <th>Job Function</th>
                                    <th>Group</th>
                                    <th>Worked Hours</th>
                                    <th>Status</th>
                                   
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                ?>
                                <tr>
 
                                    <td>
                                        <?php echo "{$row['employee_name']}"; ?>
                                    </td>
                                                              
                                    <td>
                                        <?php echo "{$row['union_trade']}"; ?>                        
                                    </td>
                                   
                                    <td>
                                        <?php echo "{$row['job_function']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['pay_rate']}"; ?>      
                                    </td>
                                    
                                                                        
                                    <td>
                                        <?php echo "{$row['total_day_hours']}"; ?> 
                                    </td>
                                    <td>
                                        <?php echo "{$row['status']}"; ?>          
                                    </td>
                                    
                                </tr>
                                <?php                               
                                   }
                                ?>
                            </tbody>
                        </table>
                <br>        
                <label>_______________________</label><br>
                <label>&nbsp;<?php echo $signature; ?> </label>
                </div><br>
                </div>
              
                </div>
                <!--/col-->
                <!--/col-span-6-->
            </div>
            <!--/row-->
            <hr>
        </div>
        <!--/col-span-9-->
    </div>
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
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
                <!-- filter and pagination -->

<!-- end filter and pagination -->
	</body>
</html>