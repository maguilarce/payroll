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

	</head>
	<body>

<!-- Main -->
<div class="container-fluid">
    <div class="row">
                <!-- center left-->
                <div class="col-md-10">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>Modify User</h4>
                            </div>
                        </div>
                    <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Login</th>
                                    <th>Email</th>
                                    <th>Type</th>
                                    <th colspan="2">Actions</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                $result = mysql_query("SELECT *
                                                       FROM user
                                                       ");
                                $counter = 0;
                                            while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                                ++$counter;
                              
                                ?>
                                <tr>
                                    <td><?php echo "{$row['f_name']} <br>"; ?></td>
                                    <td><?php echo "{$row['l_name']} <br>"; ?></td>      
                                    <td><?php echo "{$row['login']} <br>"; ?></td>      
                                    <td><?php echo "{$row['email']} <br>"; ?></td> 
                                    <td><?php echo "{$row['type']} <br>"; ?></td> 
                                    <td>
                                        <form action="edit_user_form.php" method="post">
                                        <input type="hidden" name="iduser" value="<?php echo "{$row['iduser']} <br>"; ?>">
                                        <button type="submit" class="btn btn-primary" title="Edit"><i class="glyphicon glyphicon-edit"></i></button>
                                        <!--<input type="submit" name="modify" value="Modify">-->
                                        </form>
                                        </td><td>
                                        <form action="delete_user_form.php" method="post">
                                        <input type="hidden" name="iduser" value="<?php echo "{$row['iduser']} <br>"; ?>">
                                        <button type="submit" class="btn btn-primary" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                                        <!--<input type="submit" name="delete" value="Delete">-->
                                        </form> 
                                    </td>
                                                         
                                </tr>
                                   <?php
                                            }
                                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
                <!--/col-->
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