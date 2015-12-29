<?php
require_once('connection.php');
session_start();
    $daily_lump_sum_rate_id = $_POST['id'];
    $query = "SELECT * FROM daily_lump_sum_rate WHERE daily_lump_sum_rate_id = '$daily_lump_sum_rate_id'";
    $retval = mysql_query( $query, $dbh );
    $row = mysql_fetch_array($retval);
    if(! $retval )
    {
     die('Could not get data: ' . mysql_error());
    }
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
                    $( "#delete" ).submit(function( event ) {
                    if(!confirm( "Delete job function?" ))
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
                                <h4>Modify lump payment rate</h4>
                    </div>
          
                                     
                         <div class="panel-body">
                             <form action="add_lump_payment_form1.php" class="form form-vertical" method="post">
                                 <input name="id" type="hidden" value="<?php echo $row[0]; ?>">
                                <div class="control-group">
                                    <label>Edit lump payment name:</label>
                                    <div class="controls">
                                        <input name="new_lump_payment_name" value="<?php echo $row[1]; ?>" type="text" class="form-control" >                                         
                                    </div>
                                    <br/>
                                    <label>Edit lump payment amount:</label>
                                    <div class="controls">
                                        <input name="new_lump_payment_amount" value="<?php echo $row[2]; ?>" type="text" class="form-control" >
                                 
                                        
                                    </div>
                                    <br />
                                    <div class="controls">
                                        <button type="submit" class="btn btn-primary">
                                            Modify
                                        </button>
                                    </div>
                                </div>
                            </form>
                         </div>
                    </div>
              
                </div>
                <!--/col-->

            </div>
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