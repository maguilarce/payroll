<?php
require_once('connection.php');

$result1 = mysql_query("SELECT *
                       FROM employee
                       WHERE hired = 'y'");


$result2 = mysql_query("SELECT job_function_type
                       FROM job_function");


$result3 = mysql_query("SELECT pay_rate_type
                       FROM pay_rate");


$result4 = mysql_query("SELECT premium_rate_type
                       FROM premium_rate");


$result5 = mysql_query("SELECT daily_lump_sum_type
                       FROM daily_lump_sum_rate");


$result6 = mysql_query("SELECT status_type
                       FROM status");

                

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Bootstrap 3 Admin</title>
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
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> Admin <span class="caret"></span></a>
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
            <a href="#"><strong><i class="glyphicon glyphicon-wrench"></i> Workers</strong></a>

            <hr>

            <!--
			LEFT MENU
		<!-->
            <ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu1"><strong>Employee info</strong> <i class="glyphicon glyphicon-user"></i></a>
                    <ul class="nav nav-stacked collapse in" id="menu1">
                        <li class="active"> <a href="#">Add employee</a></li>
                        <li class="active"> <a href="#">Edit/modify employee</a></li>
                        <li class="active"> <a href="#">Delete employee</a></li>

                    </ul>
                </li>
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2"><strong>Job functions</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>

                    <ul class="nav nav-stacked collapse" id="menu2">
                        <li><a href="#">Add job function</a>
                        </li>
                        <li><a href="#">Edit/modify job function</a>
                        </li>
                        <li><a href="#">Delete job function</a>
                        </li>

                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu3"><strong>Status</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu3">
                       <li><a href="#">Add status</a>
                        </li>
                        <li><a href="#">Edit/modify status</a>
                        </li>
                        <li><a href="#">Delete status</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu4"><strong>Union trade</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu4">
                       <li><a href="#">Add union trade</a>
                        </li>
                        <li><a href="#">Edit/modify union trade</a>
                        </li>
                        <li><a href="#">Delete union trade</a>
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
                        <li class="active"> <a href="#">Add pay rate</a></li>
                        <li class="active"> <a href="#">Edit/modify pay rate</a></li>
                        <li class="active"> <a href="#">Delete pay rate</a></li>

                    </ul>
                </li>
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu6"><strong>Premium rates</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>

                    <ul class="nav nav-stacked collapse" id="menu6">
                        <li><a href="#">Add premiun rate</a>
                        </li>
                        <li><a href="#">Edit/modify premium rate</a>
                        </li>
                        <li><a href="#">Delete premium rate</a>
                        </li>

                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu7"><strong>Lumps payments</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu7">
                       <li><a href="#">Add lump payment</a>
                        </li>
                        <li><a href="#">Edit/modify lump payment</a>
                        </li>
                        <li><a href="#">Delete lump payment</a>
                        </li>
                    </ul>
                </li>
                                
            </ul>

           
            
        </div>
        <!-- /col-3 -->
        <div class="col-sm-9">


            <a href="#"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>
            <hr>

                        <!--
			CENTER MENU
		<!-->
            
            <div class="row">
                <!-- center left-->
                <div class="col-md-14">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <h2>Daily Time Sheet</h2><br />
                        <h4>Date: </h4><br />
                                
                    </div>
                    <form action="add_daily_data.php" method="post" name="daily_data">
                    <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Job Function</th>
                                    <th>Pay Rate</th>
                                    <th>Premium Rate</th>
                                    <th>Daily Lum Sum Rates</th>
                                    <th>Straight Hours</th>
                                    <th>Overtime Hours</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                   
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
                                         <select name="premium_rate" class="form-control"> 
                                         <?php
                                        while($row4 = mysql_fetch_array($result4, MYSQL_ASSOC))
                                            { 
                                                echo "<option>{$row4['premium_rate_type']}</option>";                           
                                            }  
                                        ?>  
                                         </select>
                                    </td> 
                                     
                                    <td>
                                        <select name="daily_lump_payment" class="form-control"> 
                                         <?php
                                         
                                        while($row5 = mysql_fetch_array($result5, MYSQL_ASSOC))
                                            { 
                                                echo "<option>{$row5['daily_lump_sum_type']}</option>";                           
                                            }  
                                        ?> 
                                     </select> 
                                    </td> 
                                         
                                    <td>
                                        <input name="straight" type="text" class="form-control">
                                    </td> 
                                    
                                    <td>
                                        <input name="overtime" type="text" class="form-control">
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
                                    <td>
                                        <textarea class="form-control" name="notes"></textarea>
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

<footer class="text-center">This Bootstrap 3 dashboard layout is compliments of <a href="http://www.bootply.com/85850"><strong>Bootply.com</strong></a></footer>

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