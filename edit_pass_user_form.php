<?php
require_once('connection.php');
session_start();
    $user_id = $_GET['iduser'];
    $query = "SELECT * FROM user WHERE login = '$user_id' ";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    $pass = $row['password'];

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

<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-11">
            <div class="row">
                <!-- center left-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>Password Update</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="edit_pass_user.php" method="post" class="form form-vertical">
                                <div class="control-group">
                                    <label>New Password</label>
                                    <div class="controls">
                                        <input name="password_1" type="password" value="<?php echo $row['password']; ?>" class="form-control" placeholder="Enter Password">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label>Re-Type Password</label>
                                    <div class="controls">
                                        <input name="password_2" type="password" value="<?php echo $row['password']; ?>" class="form-control" placeholder="Enter Password">
                                    </div>
                                </div>
                               
                                <div class="control-group">
                                    <label></label>
                                    <div class="controls">
                                        <button type="submit" class="btn btn-primary">Update Password</button>
                                        <input type="hidden" name="user_id" value="<?php echo $row['iduser']; ?>" />
                                    </div>
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
    </div>

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