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
                <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
                <script src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
                <script language="JavaScript"> 
                    $(document).ready(function()
                  {             
                    $( ".delete" ).submit(function( event ) {
                    if(!confirm( "Delete union trade?" ))
                        event.preventDefault();
                    });
                   });
                </script>
	</head>
	<body>
            
<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <div class="row">
                <!-- center left-->
                <div class="col-md-6">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>Available union trades</h4>
                    </div>
          
                    <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Union trade</th>
                                    <th  colspan="2">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                
                                $result = mysql_query("SELECT *
                                                       FROM union_trade");
                                $counter = 0;
                                            while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                                ++$counter;
                              
                                ?>
                                <tr>
                                    <td><?php echo $counter; ?></td>
                                    <td><?php echo "{$row['union_trade_type']} <br>"; ?></td>
                                    <td>
                                        <form id="modify" action="edit_union_trade_form.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo "{$row['union_trade_id']}"; ?>">
                                          <button type="submit" class="btn btn-primary" title="Edit"><i class="glyphicon glyphicon-edit"></i></button>
                                            <!--<input name="modify_union_trade" type="submit" value="Modify">-->
                                        </form>
                                    </td>
                                    <td>
                                        <form class="delete" action="delete_union_trade_form.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo "{$row['union_trade_id']}"; ?>">
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
                             <form action="add_union_trade_form.php" class="form form-vertical" method="post">
                                <div class="control-group">
                                    <label>New union trade name:</label>
                                    <div class="controls">
                                        <input name="new_union_trade" type="text" class="form-control" placeholder="Enter new union trade">
                                        
                                    </div>
                                    <br />
                                    <div class="controls">
                                        <button type="submit" class="btn btn-primary">
                                            Add new union trade
                                        </button>
                                    </div>
                                </div>
                            </form>
                         </div>
                    </div>
              
                </div>
                <!--/col-->
            </div>
            <!--/row-->
           
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