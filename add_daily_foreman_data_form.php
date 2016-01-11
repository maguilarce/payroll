<?php
require_once('connection.php');
session_start();
$result1 = mysql_query("SELECT *
                       FROM employee
                       WHERE hired = 'y' AND status=1");


$result2 = mysql_query("SELECT job_function_type
                       FROM job_function");


$result3 = mysql_query("SELECT pay_rate_type
                       FROM pay_rate");



$result6 = mysql_query("SELECT status_type
                       FROM status");

$project_name = $_POST['project_name'];     


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
                <!-- /col-3 -->
        <div class="col-sm-12">
            <div class="row">
                <!-- center left-->
                <div class="col-md-14">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <h2>Add New Register - Daily Time Sheet - Foreman</h2>
                         <h4>Date: <?php echo date("F j, Y");?></h4>                      
                    </div>
                    <form action="add_daily_foreman_data.php" method="post" name="daily_data">
                    <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Job Function</th>
                                    <th>Group</th>
                                    <th>Worked Hours</th>
                                    <th>Status</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td><?php  ?>
                                    <select name="employee" class="form-control"> 
                                        <?php
                                        while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            { 
                                                echo "<option>{$row1['name']}</option>";                           
                                            }  
                                        ?>
                                        </select>
                                    
                                    </td>
                                                                       
                                  
                                    
                                    <td>
                                        <select name="job_function" class="form-control"> 
                                        <?php
                                        while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC))
                                            { 
                                                echo "<option>{$row2['job_function_type']}</option>";                           
                                            }  
                                        ?>
                                        </select>
                                    </td>      
                                    
                                    <td>
                                         <select name="pay_rate" class="form-control"> 
                                        <?php
                                        while($row3 = mysql_fetch_array($result3, MYSQL_ASSOC))
                                            { 
                                                echo "<option>{$row3['pay_rate_type']}</option>";
                                                
                                            }  
                                        ?>
                                         </select>
                                      
                                    </td>    
 
                                         
                                    <td>
                                        <input name="worked_hours" type="text" class="form-control">
                                    </td> 
                                    
                                    
                                                                      
                                    <td>
                                         <select name="status" class="form-control"> 
                                         <?php
                                         
                                        while($row6 = mysql_fetch_array($result6, MYSQL_ASSOC))
                                            { 
                                                echo "<option>{$row6['status_type']}</option>";                           
                                            }  
                                        ?> 
                                    </td> 

                                
                                </tr>
          
                            </tbody>
                        </table>
                        <div class="control-group">
                            <label></label>
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    Save new register
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="project_name" value="<?php echo $project_name;?>">
                    </form>
                    <br>
                    <form action="add_daily_foreman_data_table.php" method="post">
                    <button type="submit" class="btn btn-primary glyphicon glyphicon-backward">Back</button>   
                    <input type="hidden" name="project" value="<?php echo $project_name; ?>">
                    <input type="hidden" name="nones" value="0">
                        
                    </form>      
                    </div>
              
                </div>
                <!--/col-->
                
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
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
	</body>
</html>