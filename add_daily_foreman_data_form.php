<?php
require_once('connection.php');
session_start();
$result1 = mysql_query("SELECT *
                       FROM employee
                       WHERE hired = 'y'");


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
<!-- header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Payroll & Timesheet Application</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['user_id']; ?> <span class="caret"></span></a>
                    <ul id="g-account-menu" class="dropdown-menu" role="menu">
                        <li><a href="#">My Profile</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <!-- Left column -->
            <img src="let-logo.png" /><br/>
            <a href="#"><strong><i class="glyphicon glyphicon-wrench"></i> Workers</strong></a>

            <hr>

            <!--
			LEFT MENU
		<!-->
            <ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu1"><strong>Employee info</strong> <i class="glyphicon glyphicon-user"></i></a>
                    <ul class="nav nav-stacked collapse in" id="menu1">
                        <li class="active"> <a href="add_employee_form.php">Add new employee</a></li>
                        <li class="active"> <a href="edit_employee_table.php">Edit/modify employee</a></li>
                        <li class="active"> <a href="delete_employee_table.php">Delete employee</a></li>

                    </ul>
                </li>
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2"><strong>Job functions</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>

                    <ul class="nav nav-stacked collapse" id="menu2">
                        <li><a href="add_job_function_table.php">Add/Modify/Delete job function</a>
                        </li>


                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu3"><strong>Status</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu3">
                       <li><a href="add_status_table.php">Add/Modify/Delete status</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu4"><strong>Union trade</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu4">
                       <li><a href="add_union_trade_table.php">Add/Modify/Delete union trade</a>
                        </li>

                    </ul>
                </li>
                
            </ul>

            <hr>

            <a href="#"><strong><i class="glyphicon glyphicon-link"></i> Rates</strong></a>

            <hr>

            <ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu5"><strong>Pay rates</strong> <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="nav nav-stacked collapse in" id="menu5">
                        <li class="active"> <a href="add_pay_rate_table.php">Add/Modify/Delete pay rate</a></li>


                    </ul>
                </li>
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu6"><strong>Premium rates</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>

                    <ul class="nav nav-stacked collapse" id="menu6">
                        <li><a href="add_premium_rate_table.php">Add/Modify/Delete premiun rate</a>
                        </li>


                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu7"><strong>Lumps payments</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu7">
                        <li><a href="add_lump_payment_table.php">Add/Modify/Delete lump payment</a>
                        </li>

                    </ul>
                </li>
                                
            </ul>

           <hr>

            <a href="#"><strong><i class="glyphicon glyphicon-link"></i> Projects</strong></a>

            <hr>

            <ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu5"><strong>Projects</strong> <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="nav nav-stacked collapse in" id="menu5">
                        <li class="active"> <a href="add_project_table.php">Add/Modify/Delete project</a></li>


                    </ul>
                </li>
                
                                
            </ul>

           
            
        </div>
        <!-- /col-3 -->
        <div class="col-sm-9">


            <a href="dashboard.php"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>
            <hr>

                        <!--
			CENTER MENU
		<!-->
            
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
                        <input type="hidden" name="project_name" value="<?php echo $_POST['project_name'];?>"
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

<footer class="text-center">Let LLC - CopyRight © 2015 - <a href="http://www.letllc.com"><strong>www.letllc.com</strong></a></footer>

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