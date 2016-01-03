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
		<link href="css/styles.css" rel="stylesheet">
                <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
                <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
                <script language="JavaScript"> 
                    $(document).ready(function()
                  {             
                    $( ".delete" ).submit(function( event ) {
                    if(!confirm( "Delete pay rate?" ))
                        event.preventDefault();
                    });
                   });
                </script>
	</head>
	<body>
            
<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <!-- /col-3 -->
        <div class="col-sm-12">

            <div class="row">
                <!-- center left-->
                <div class="col-md-6">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>Available pay rates:</h4>
                    </div>
          
                    <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Pay group</th>
                                    <th>Type</th>
                                    <th>Rate</th>
                                    <th  colspan="2">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                $result = mysql_query("SELECT *
                                                       FROM pay_rate");
                                $counter = 0;
                                            while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                                ++$counter;
                              
                                ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo "{$row['pay_rate_type']} <br>"; ?></td>
                                    <td><?php echo "{$row['type']} <br>"; ?></td>
                                    <td><?php echo "$"."{$row['pay_rate_hourly_amount']} <br>"; ?></td>
                                    <td>
                                        <form id="modify" action="edit_pay_rate_form.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo "{$row['pay_rate_id']}"; ?>">
                                            <button type="submit" class="btn btn-primary" title="Edit"><i class="glyphicon glyphicon-edit"></i></button>
                                            <!--<input name="modify_status" type="submit" value="Modify">-->
                                        </form>
                                    </td>
                                    <td>
                                        <form class="delete" action="delete_pay_rate_form.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo "{$row['pay_rate_id']}"; ?>">
                                            <button type="submit" class="btn btn-primary" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                                            <!--<input  type="submit" value="Delete">-->              
                                        </form>
                                    </td>
                                    
                                
                                </tr>
                                   <?php
                                            }
                                        ?>
                            </tbody>
                        </table>
                    
                         <div class="panel-body">
                             <form action="add_pay_rate_form.php" class="form form-vertical" method="post">
                                
                                <div class="control-group">
                                    <label>New pay group name:</label>
                                    <div class="controls">
                                        <input name="new_pay_rate_name" type="text" class="form-control" placeholder="Enter new pay group name">
                                        
                                    </div>
                                    <br />
                                     <label>New pay group type:</label>
                                    <div class="controls">
                                        <select name="new_pay_rate_type" class="form-control">
                                           
                                                
                                             <option>ST</option>
                                             <option>OT</option>
                     
                                         

                                        </select>
                                        
                                    </div>
                                    <br />
                                    <label>New pay rate group: $</label>
                                    <div class="controls">
                                        <input name="new_pay_rate" type="text" class="form-control" placeholder="Enter amount">
                                        
                                    </div>
                                    <br />
                                    <div class="controls">
                                        <button type="submit" class="btn btn-primary">
                                            Add new pay rate group
                                        </button>
                                    </div>
                                </div>
                            </form>
                         </div>
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