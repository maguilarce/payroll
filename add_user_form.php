<?php
require_once('connection.php');
session_start();
   
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
                <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    
                
	</head>
	<body>
<!-- header -->

<!-- /Header -->

<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-md-11 center-block"><br>
            <div class="row center-block" >
                <!-- center left-->
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>Add New User</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="add_user.php" class="form form-vertical">
                                <div class="control-group">
                                    <label>First Name</label>
                                    <div class="controls">
                                        <input id="fname" name="fname" type="text" class="form-control" placeholder="Enter First Name" pattern="[A-Za-z]+" required>
                                    </div>
                                </div><br />
                                <div class="control-group">
                                    <label>Last Name</label>
                                    <div class="controls">
                                        <input id="lname" name="lname" type="text" class="form-control" placeholder="Enter Last Name" pattern="[A-Za-z]+" required>
                                    </div>
                                </div><br />
                                
                               
                                 <div class="control-group">
                                    <label>Login</label>
                                    <div class="controls">
                                        <input name="login" type="text" class="form-control" placeholder="Enter Login" pattern="[A-Za-z0-9.-]+" requiredrequired>
                                    </div>
                                </div><br />
                                <div class="control-group">
                                    <label>Email</label>
                                    <div class="controls">
                                        <input name="email" type="email" class="form-control" placeholder="Enter email" required >
                                    </div><br />
                                </div>                                  
                                <div class="control-group">
                                    <label>Type of User</label>
                                    <div class="controls">
                                        <select name="usertype" class="form-control">
                                            <option value="admin">Administrator</option>
                                            <option value="superintendent">Weekly Superintendent</option>
                                            <option value="manager">Office Manager</option>
                                            <option value="foreman">Foreman</option>
                                        </select>
                                    </div>
                                </div><br>
                                
                                
                        <div class="control-group">
                                    <label></label>
                                    <div class="controls">
                                        <button type="submit" class="btn btn-primary">
                                            Add User
                                        </button>
                                    </div>
                        </div>
                        <h6>Every User will be created with default password "123456" it must by changed by the user when starts to work with the page in the top options</h6>
                        <br>             
                        </div>
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