<?php
require_once('connection.php');
session_start();
    $employee_id = $_POST['id'];
    $query = "SELECT *
              FROM employee 
              WHERE employee_id = '$employee_id' ";
  
    $result = mysql_query($query);
    $row = mysql_fetch_array($result, MYSQL_ASSOC);



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
                <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
                <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
                
                <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
        <div class="col-sm-3">
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
                        <li class="active"> <a href="create_project_profile1.php">Project Profiles</a></li>


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
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>Modify employee</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="edit_employee.php" method="post" class="form form-vertical">
                                <div class="control-group">
                                    <label>Name</label>
                                    <div class="controls">
                                        <input name="name" type="text" value="<?php echo "{$row['name']}"; ?>" class="form-control" placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label>License Number</label>
                                    <div class="controls">
                                        <input name="license_number" type="text" value="<?php echo "{$row['license_number']}"; ?>" class="form-control" placeholder="Enter License Number">
                                    </div>
                                 </div>   
                                 <div class="control-group">
                                    <label>SSN</label>
                                    <div class="controls">
                                        <input name="social_security_number" type="text" value="<?php echo "{$row['social_security_number']}"; ?>" class="form-control" placeholder="Enter SSN">
                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label>Address</label>
                                    <div class="controls">
                                        <input name="address" type="text" value="<?php echo "{$row['address']}"; ?>" class="form-control" placeholder="Enter Address">
                                    </div>
                                </div> 
                                <div class="control-group">
                                    <label>Phone Number</label>
                                    <div class="controls">
                                        <input name="phone_number" type="text" value="<?php echo "{$row['phone_number']}"; ?>" class="form-control" placeholder="Enter Phone Number">
                                    </div>
                                </div> 
                                <div class="control-group">
                                    <label>Email</label>
                                    <div class="controls">
                                        <input name="email" type="text" value="<?php echo "{$row['email']}"; ?>" class="form-control" placeholder="Enter email">
                                    </div>
                                </div>                                  
                                <div class="control-group">
                                    <label>Union Trade</label>
                                    <div class="controls">
                                        <select name="union_trade" class="form-control"> 
                                            <?php
                                            $query = "SELECT * from union_trade";
                                            $result = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                                if($row['union_trade']==$row1['union_trade_type'])
                                                {
                                                    echo "<option selected>{$row1['union_trade_type']}</option>";
                                                }
                                                else echo "<option>{$row1['union_trade_type']}</option>";                           
                                             
                     
                                            }  
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label>Crew</label>
                                    <div class="controls">
                                        <select name="crew" class="form-control">
                                            <?php
                                            $query = "SELECT * from crew";
                                            $result = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                                if($row['crew']==$row1['crew_type'])
                                                {
                                                    echo "<option selected>{$row1['crew_type']}</option>";
                                                }
                                                else echo "<option>{$row1['crew_type']}</option>";                           
                                             
                     
                                            }  
                                            ?>

                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label>Hiring Date: </label>
                                     <div class="controls">
                                         <?php
                                            $query = "SELECT hiring_date from employee WHERE employee_id = '$employee_id' ";
                                            $result = mysql_query($query);
                                            $row2 = mysql_fetch_array($result, MYSQL_ASSOC);
 
                                            ?>
                                         <input value="<?php echo $row2['hiring_date']; ?>" name="hiring_date" class="datepicker form-control" readonly='true' type="text" placeholder="Click to add hiring date">
                                            <span class="add-on"><i class="icon-th"></i></span>
                                        
                                     </div>
                                    
                                </div>
                                <div class="control-group">
                                    <label></label>
                                    <div class="controls">
                                        
                                        <button type="submit" class="btn btn-primary">
                                            Add employee
                                        </button>
                                        <input type="hidden" name="id" value="<?php echo "{$row['employee_id']} <br>"; ?>">
                                    </div>
                                </div>
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
                
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script>
  $(function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd'
        
    });
  });
  </script>
                
	</body>
</html>