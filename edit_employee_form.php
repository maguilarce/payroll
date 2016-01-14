<?php
require_once('connection.php');
session_start();
    $employee_id = $_POST['id'];
    $query = "SELECT *
              FROM employee 
              WHERE employee_id = '$employee_id' ";
  
    $result = mysql_query($query);
    $row = mysql_fetch_array($result, MYSQL_ASSOC);

    $name = explode(',',$row['name']);
    $last_name = $name[0];
    $first_name = $name[1];
    


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
        <div class="col-sm-9">
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
                                    <label>First Name</label>
                                    <div class="controls">
                                        <input name="first_name" type="text" value="<?php echo $first_name; ?>" class="form-control" placeholder="Enter First Name" pattern="[A-Za-z]+" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label>Last Name</label>
                                    <div class="controls">
                                        <input name="last_name" type="text" value="<?php echo $last_name; ?>" class="form-control" placeholder="Enter Last Name" pattern="[A-Za-z]+" required>
                                    </div>
                                </div>
                               <div class="control-group">
                                    <label>SSN</label>
                                    <div class="controls">
                                        <input name="social_security_number" type="text" value="<?php echo "{$row['social_security_number']}"; ?>" class="form-control" placeholder="Enter SSN" pattern="[0-9]{3}[-]{1}[0-9]{2}[-]{1}[0-9]{4}" required>
                                    </div>
                                </div>
                                 <div class="control-group">
                                    <label>Address</label>
                                    <div class="controls">
                                        <input name="address" type="text" value="<?php echo "{$row['address']}"; ?>" class="form-control" placeholder="Enter Address" pattern="[A-Za-z0-9.-#()]+" required>
                                    </div>
                                </div> 
                                <div class="control-group">
                                    <label>Phone Number</label>
                                    <div class="controls">
                                        <input name="phone_number" type="text" value="<?php echo "{$row['phone_number']}"; ?>" class="form-control" placeholder="Enter Phone Number" pattern="[0-9()-]+" required>
                                    </div>
                                </div> 
                                <div class="control-group">
                                    <label>Email</label>
                                    <div class="controls">
                                        <input name="email" type="email" value="<?php echo "{$row['email']}"; ?>" class="form-control" placeholder="Enter email">
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
                                    <label>Home local #</label>
                                    <div class="controls">
                                        <input id="home_local" name="home_local" type="text" class="form-control" value="<?php echo "{$row['home_local']}";?>">
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
                                    <label>Status: </label>
                                     <div class="controls">
                                         <select name="st_emp" class="form-control">
                                            <?php
                                                if($row['status']==1)
                                                {echo "<option selected value='1'>Active</option><option value='0'>Inactive</option>";}
                                                if($row['status']==0){ echo "<option selected value='1'>Active</option><option value='0'>Inactive</option>";}
                                            ?>

                                        </select>
                                     </div>
                                </div>
                                <div class="control-group">
                                    <label></label>
                                    <div class="controls">
                                        
                                        <button type="submit" class="btn btn-primary">
                                            Modify employee
                                        </button>
                                        <input type="hidden" name="id" value="<?php echo "{$row['employee_id']} <br>"; ?>">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--/panel content-->
                    </div>
                    <!--/panel-->                
            </div>
            <!--/row-->

            <hr>
                
           
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