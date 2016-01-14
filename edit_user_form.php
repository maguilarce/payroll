<?php
require_once('connection.php');
session_start();
    $user_id = $_POST['iduser'];
    $query = "SELECT * FROM user WHERE iduser = '$user_id'";
    $result = mysql_query($query);
    $row = mysql_fetch_array($result, MYSQL_ASSOC);
    ;
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
                                <h4>Modify User</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form action="edit_user.php" method="post" class="form form-vertical">
                                <div class="control-group">
                                    <label>First Name</label>
                                    <div class="controls">
                                        <input name="first_name" type="text" value="<?php echo $row['f_name']; ?>" class="form-control" placeholder="Enter First Name" pattern="[A-Za-z]+" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label>Last Name</label>
                                    <div class="controls">
                                        <input name="last_name" type="text" value="<?php echo $row['l_name']; ?>" class="form-control" placeholder="Enter Last Name" pattern="[A-Za-z]+" required>
                                    </div>
                                </div>
                               <div class="control-group">
                                    <label>Email</label>
                                    <div class="controls">
                                        <input name="email" type="email" value="<?php echo "{$row['email']}"; ?>" class="form-control" placeholder="Enter E-Mail" required>
                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label>Login</label>
                                    <div class="controls">
                                        <input name="login" type="text" value="<?php echo "{$row['login']}"; ?>" class="form-control" placeholder="Enter Login" pattern="[A-Za-z.-]+" required>
                                    </div>
                                </div> 
                                                                 
                                <div class="control-group">
                                    <label>Union Trade</label>
                                    <div class="controls">
                                        <select name="u_type" class="form-control" id="u_type">
                                            <?php if($row['type'] == 'admin'){ ?>
                                            <option selected value="admin">Administrator</option>
                                            <?php } else { ?>
                                            <option value="admin">Administrator</option>
                                            <?php } ?>
                                            <?php if($row['type'] == 'superintendent'){ ?>
                                            <option selected value="superintendent">Weekly Superintendent</option>
                                            <?php } else { ?>
                                            <option value="superintendent">Weekly Superintendent</option>
                                            <?php } ?>
                                            <?php if($row['type'] == 'manager'){ ?>
                                            <option selected value="manager">Office Manager</option>
                                            <?php } else { ?>
                                            <option value="manager">Office Manager</option>
                                            <?php } ?>
                                            <?php if($row['type'] == 'foreman'){ ?>
                                            <option selected value="foreman">Foreman</option>
                                            <?php } else { ?>
                                            <option value="foreman">Foreman</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                
                                <div class="control-group">
                                    <label></label>
                                    <div class="controls">
                                        <button type="submit" class="btn btn-primary">Modify User </button>
                                        
                                        <input type="hidden" name="user_id" value="<?php echo "{$row['iduser']} <br>"; ?>">
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <form action="reset_pass_user.php" method="post" class="form form-vertical">
                                <div class="controls">
                                    <button type="submit" class="btn btn-primary" >Reset Password</button>    
                                        <input type="hidden" name="user_id" value="<?php echo "{$row['iduser']} <br>"; ?>">
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