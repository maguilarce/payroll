<?php
require_once('connection.php');
session_start();
$user_id = $_POST['iduser'];
$query = "SELECT login FROM user WHERE iduser = '$user_id' ";
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
                <!-- date picker css -->
                <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
                <link href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
                 <!-- date picker bootstrap -->
                <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

	</head>
	<body>
    <!-- /container -->

<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <div class="row">
                <!-- center left-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>User Delete Confirmation</h4>
                            </div>
                            <hr>
                              <label>Are you Sure you want to delete this User?  </label>
                                                               
                            <div> 
                                
                                        
                                        <h4><?php echo $row['login']; ?></h4><br>
                                        <table size="100">  
                                            <tr>
                                                <td align="left">
                                                <form name="delete_user" action="user_deleted.php" method="post">
                                                    <input name="user_id" type="hidden" value="<?php echo $user_id;?>">
                                                    <button type="submit" class="btn btn-primary glyphicon glyphicon-trash"> Yes</button>
                                                    <label>    </label>
                                                </form> 
                                                </td>
                                                <td align="right">      
                                                <form name="cancel_delete" action="edit_user_table.php" method="post">
                                                    <button type="submit" class="btn btn-primary glyphicon glyphicon-zoom-out"> No</button>                           
                                                </form>
                                                </td>    
                                            </tr>
                                </table>
                            </div>
                              
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
	</body>
</html>