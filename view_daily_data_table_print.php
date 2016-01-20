<?php
require_once('connection.php');
session_start();
$date = $_POST['p_date']; 
$union = $_POST['p_union']; 
$project_name = $_POST['p_pname']; 

$result = mysql_query("SELECT daily_timesheet_id,date,employee_name,employee.union_trade,employee.home_local,job_function,pay_rate,pay_rate_type,total_day_hours,daily_timesheet.status,daily_notes,processed
FROM employee INNER JOIN daily_timesheet
ON employee.name=daily_timesheet.employee_name
WHERE date = '$date' AND associated_project = '$project_name';");

$user = $_SESSION['user_id'];
$sql_n = "SELECT * FROM user where login ='$user'";
$result_n =  mysql_query($sql_n);
$row_n = mysql_fetch_array($result_n);
$signature=$row_n['f_name']." ".$row_n['l_name'];

if(mysql_num_rows($result)==0)
{
    $message="Alert: You have not yet entered any record.";
}
else
{
    $message = "";
}

$retval2 = mysql_query("SELECT * FROM jurisdiction WHERE project_name = '$project_name'");

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
                 <!-- filter and pagination -->
                <script type="text/javascript" language="javascript" src="js/tablefilter.js"></script>         
                <link href="css/style/tablefilter.css" rel="stylesheet">
                <link href="css/style/colsVisibility.css" rel="stylesheet">
                <link href="css/style/filtersVisibility.css" rel="stylesheet">
                <!--end filter and pagination -->
                <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                <script type="text/javascript" src="js/jQuery.print.js"></script>
                <script language="JavaScript"> 

                    function eliminar(){
                        
                        if(!confirm( "This will delete selected daily data. Are you sure?" ))
                        event.preventDefault();
                }
                </script>
                <script type="text/javascript"> 
                function verificar(){
                    var suma = 0;
                    var los_cboxes = document.getElementsByName('daily_premium_rate[]'); 
                    for (var i = 0, j = los_cboxes.length; i < j; i++) {

                    if(los_cboxes[i].checked === true){
                    suma++;
                    }
                }

                if(suma === 0){
                alert("Must select at least one Premium Rate/Daily Lump Rate. You can choose 'None'");
                return false;
                }

                }
                </script> 
    <script>
        function P_div4(){$(area).print(); return( false );}
        
    </script>
	</head>
	<body>

<!-- Main -->
<div id="boton_print">
  <div class="controls">
    <button type="button" class="btn btn-primary" onclick="P_div4();">Print Daily Time Sheet</button>
  </div> </div><hr>
<div id="area">
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <div class="row">
                <!-- center left-->
                <div class="col-md-14">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <img src="let-logo.png" /><br/>
                        <h4><strong>Daily Time Sheet - Superintendent</strong></h4>
                        <table class="table table-striped table-bordered table-hover">
                            <h4>
                            <tr><td><strong>Date:</strong> <?php echo date($date);?></td></tr>
                            <tr><td><strong>Project Name: </strong><?php echo $project_name;?></td></tr>
                            <tr><td><strong>Project Location(s): </strong></td></tr><?php

                            $i=1;
                            while($row2 = mysql_fetch_array($retval2,1))
                            {
                               echo "<tr><td>".$i++.")".$row2['county'].", ".$row2['state']." ---> <strong>Operators Local Union #:</strong> ".$row2['operator_local']."<strong> / Teamster Local Union #: </strong>".$row2['teamster_local']." <strong> / Laborer Local Union #: </strong>".$row2['laborer_local']."</td></tr>";
                            }
                            ?>
                            </h4>
                        </table>
                                
                    </div>
 
                    <h4><strong style="color: red"><?php echo  $message;?></strong></h4><br />
                    <table id="demo" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                  
                                    <th>Employee Name</th>
                                    <th>Union Trade</th>
                                    <th>Home local #</th>
                                    <th>Job Function</th>
                                    <th>Pay Rate</th>
                                    <th>Premium Rate</th>
                                    <th>Daily Lump Sum Rates</th>
                                    <th>Worked Hours</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                    
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysql_fetch_array($result, MYSQL_ASSOC))                                            { 
                                ?>
                           <form action="" method="post">
                                <tr>
                                    <td>
                                        <?php echo "{$row['employee_name']}"; ?>
                                    </td>
                                                              
                                    <td>
                                        <?php echo "{$row['union_trade']}"; ?>                        
                                    </td>
                                    <td>
                                        <?php echo "{$row['home_local']}"; ?>                        
                                    </td>
                                    <td>
                                        <?php echo "{$row['job_function']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['pay_rate']}"; ?>      
                                    </td>
                                    <td>       
                                        <?php
                                        
                                            $employee = $row['employee_name'];
                                            $job_function =  $row['job_function'];
                                            $date = $row['date'];
                                            
                                        if($row['processed']=='yes')
                                        {   

                                            $query = "SELECT premium_rate FROM daily_premium_rate WHERE employee='$employee' AND job_function = '$job_function' AND date = '$date';";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                echo "{$row1['premium_rate']}"."<br>";
                                            }
                                        }    
                                        else
                                        {
                                            $query = "SELECT * from premium_rate;";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {

                                                $value = $row1['premium_rate_type'];
                                                echo "<input type='checkbox' name='daily_premium_rate[]' value='$value' / > {$row1['premium_rate_type']}<br>";

                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($row['processed']=='yes'){
                                            $button = "disabled";
                                            $employee = $row['employee_name'];
                                            $job_function =  $row['job_function'];
                                            $date = $row['date'];
                                            $query = "SELECT daily_lump_rate FROM daily_lump_rates WHERE employee='$employee' AND job_function = '$job_function' AND date = '$date';";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                echo "{$row1['daily_lump_rate']}"."<br />";
                                            }
                                        }    
                                        else
                                        {
                                            $button = "";
                                            $query = "SELECT * from daily_lump_sum_rate;";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                $value = $row1['daily_lump_sum_type'];
                                                echo "<input type='checkbox' name='daily_sum_rates[]' value='$value' / > {$row1['daily_lump_sum_type']}<br>";
                                            }
                                        }
                                            ?>
                                    </td>
                                    <td>
                                        <?php
                                        echo "{$row['total_day_hours']}";
                                        ?>
                                    </td>

                                    <td>
                                        <?php echo "{$row['status']}"; ?>          
                                    </td>
                                    <td>
                                <?php echo "{$row['daily_notes']}"; ?>  
                                    </td>             </tr>
                                <?php }?>
                            </tbody>
                        </table>
                <br>        
                    <label>______________________</label><br>
                    <label>&nbsp;<?php echo $signature; ?></label>
                </div>
                </div>
                <!--/col-->
                <!--/col-span-6-->
            </div>
            <!--/row-->
            <hr>
        </div>
        <!--/col-span-9-->
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
		<script src="js/bootstrap.min.js"></script>
		<script src="js/scripts.js"></script>
                <!-- filter and pagination -->
                
<!-- end filter and pagination -->
</body>
</html>