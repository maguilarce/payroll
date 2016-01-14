<?php
require_once('connection.php');
session_start();
    $query = "SELECT union_trade_type FROM union_trade";
    $retval = mysql_query( $query, $dbh );
    if(! $retval )
    {
     die('Could not get data: ' . mysql_error());
    }
    
    $query2 = "SELECT crew_type FROM crew";
    $retval2 = mysql_query( $query2, $dbh );
    if(! $retval2 )
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
                                <h4>Add new employee</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="add_employee.php" class="form form-vertical">
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
                                    <label>SSN</label>
                                    <div class="controls">
                                        <input name="social_security_number" tyaaape="text" class="form-control" placeholder="Enter SSN (000-00-0000)" pattern="[0-9]{3}[-]{1}[0-9]{2}[-]{1}[0-9]{4}" required>
                                    </div>
                                </div><br />
                                 <div class="control-group">
                                    <label>Address</label>
                                    <div class="controls">
                                        <input name="address" type="text" class="form-control" placeholder="Enter Address" pattern="[A-Za-z0-9.-#()]+" required>
                                    </div><br />
                                </div> 
                                <div class="control-group">
                                    <label>Phone Number</label>
                                    <div class="controls">
                                        <input name="phone_number" type="text" class="form-control" placeholder="Enter Phone Number" pattern="[0-9()-]+" required>
                                    </div><br />
                                </div> 
                                <div class="control-group">
                                    <label>Email</label>
                                    <div class="controls">
                                        <input name="email" type="email" class="form-control" placeholder="Enter email" required>
                                    </div><br />
                                </div>                                  
                                <div class="control-group">
                                    <label>Union Trade</label>
                                    <div class="controls">
                                        <select name="union_trade" class="form-control">
                                            <?php
                                            while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
                                            { 
                                                
                                             echo "<option>{$row['union_trade_type']}</option>";
                     
                                            }  
                                            ?>

                                        </select>
                                    </div>
                                </div><br />
                        <div class="control-group">
                                    <label>Home local #</label>
                                    <div class="controls">
                                        <input id="home_local" name="home_local" type="text" class="form-control" placeholder="Enter Home Local #" pattern="[0-9.-()]" required>
                                    </div><br />
                                <div class="control-group">
                                    <label>Crew</label>
                                    <div class="controls">
                                        <select name="crew" class="form-control">
                                            <?php
                                            
                                            while($row2 = mysql_fetch_array($retval2, MYSQL_ASSOC))
                                            { 
                                                
                                             echo "<option>{$row2['crew_type']}</option>";
                     
                                            }  
                                            ?>

                                        </select>
                                    </div>
                                </div><br />
                                <div class="control-group">
                                    <label>Hiring Date: </label>
                                     <div class="controls">
                                         <input name="hiring_date" class="datepicker form-control" readonly='true' type="text" placeholder="Click to add hiring date">
                                            <span class="add-on"><i class="icon-th"></i></span>
                                        
                                     </div>
                                    
                                </div><br>
                                
                                <div class="control-group">
                                    <label></label>
                                    <div class="controls">
                                        <button type="submit" class="btn btn-primary">
                                            Add employee
                                        </button>
                                    </div>
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