<?php

require_once('connection.php');
session_start();

$result1 = mysql_query("SELECT *
                       FROM employee
                       WHERE hired = 'y'");


$result2 = mysql_query("SELECT job_function_type
                       FROM job_function");


$result3 = mysql_query("SELECT pay_rate_type
                       FROM pay_rate");


$result4 = mysql_query("SELECT premium_rate_type
                       FROM premium_rate");


$result5 = mysql_query("SELECT daily_lump_sum_type
                       FROM daily_lump_sum_rate");


$result6 = mysql_query("SELECT status_type
                       FROM status");

$result7 = mysql_query("SELECT project_name
                       FROM project");

                
$project_name = $_POST['project_name'];
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
                    
                    function desactivar() {
                        var los_cboxes = document.getElementsByName("daily_premium_rate[]");
                        var ot_cboxes = document.getElementsByName("daily_lump_sum_rate[]");
                        var elem = document.getElementById("pay_rate_type");
                        var prt2 = document.getElementById("prt2");
                        var nones = document.getElementById("nones");
                        var elem2 = document.getElementById("payrate").value;
                        var res = elem2.split(" ");
                        var cant = res.length;
                        elem.value = res[cant-1];
                        prt2.value = elem.value;
                        //alert("entra");
                        var j = los_cboxes.length
                        var k = ot_cboxes.length;
                        if(res[cant-1]=== "OT")
                        {   for (var i = 0; i < j; i++) 
                            {los_cboxes[0].checked = true;
                             los_cboxes[i].disabled = true;}
                             for (var l = 0; l < k; l++) 
                            {ot_cboxes[0].checked = true;
                             ot_cboxes[l].disabled = true;}
                             nones.value=1;
                         }
                         if(res[cant-1]=== "ST")
                         {  for (var i = 0; i < j; i++) 
                            { los_cboxes[0].checked = false
                              los_cboxes[i].disabled = false;   
                            }
                            for (var l = 0; l < k; l++) 
                            {ot_cboxes[0].checked = false;
                             ot_cboxes[l].disabled = false;}
                            nones.value=0;
                         }
                     }

                    
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
                <div class="col-md-14">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <h2>Add New Register - Daily Time Sheet - Superintendent</h2>
                        <h4>Date: <?php echo date("F j, Y");?> </h4>  
                    </div>
                    <form onsubmit='return verificar();' action="add_daily_data.php" method="post" name="daily_data">
                    <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Job Function</th>
                                    <th>Pay Rate</th>
                                    <th>Pay Rate Type</th>
                                    <th>Premium Rate</th>
                                    <th>Daily Lum Sum Rates</th>
                                    <th>Worked Hours</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                
                                <tr>
                                    <td><?php  ?>
                                    <select name="employee" class="form-control"> 
                                        <?php
                                        while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            { 
                                                echo "<option>{$row1['name']}</option>";                           
                                            }  
                                        ?>
                                        </select>
                                    
                                    </td>                             
                                    <td>
                                        <select name="job_function" class="form-control"> 
                                        <?php
                                        while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC))
                                            { 
                                                echo "<option>{$row2['job_function_type']}</option>";                           
                                            }  
                                        ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="payrate" name="pay_rate" class="form-control" onchange="javascript:desactivar();"> 
                                        <?php
                                        while($row3 = mysql_fetch_array($result3, MYSQL_ASSOC))
                                            { 
                                                echo "<option>{$row3['pay_rate_type']}</option>";       
                                            }  
                                        ?>
                                         </select>
                                      
                                    </td>    
                                    <td>
                                        <input type="text" id="pay_rate_type" readonly="readonly">    
                                    </td>    
                                    
                                    <td>
                                        <?php
   
                                            $query = "SELECT * from premium_rate;";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                $value = $row1['premium_rate_type'];
                                                echo "<input type='checkbox' name='daily_premium_rate[]' value='$value' /> {$row1['premium_rate_type']}<br>";

                                                }
                                            ?>
                                    </td> 
                                     
                                    <td>
                                         <?php
   
                                            $query = "SELECT * from daily_lump_sum_rate;";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                $value = $row1['daily_lump_sum_type'];
                                                echo "<input type='checkbox' name='daily_lump_sum_rate[]' value='$value'/> {$row1['daily_lump_sum_type']}<br>";

                                                }
                                            ?>
                                    </td> 
                                         
                                    <td>
                                        <input name="worked_hours" type="text" class="form-control" >
                                    </td> 
                                    
                                    
                                                                      
                                    <td>
                                         <select name="status" class="form-control"> 
                                         <?php
                                         
                                        while($row6 = mysql_fetch_array($result6, MYSQL_ASSOC))
                                            { 
                                                echo "<option>{$row6['status_type']}</option>";                           
                                            }  
                                        ?> 
                                    </td> 
                                    <td>
                                        <textarea class="form-control" name="notes"></textarea>
                                    </td>
                                
                                </tr>
          
                            </tbody>
                        </table>
                        
                        <div class="control-group">
                            <label></label>
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    Save new register
                                </button>
                                <input type="hidden" name="project_name" value="<?php echo $project_name; ?>">
                         <input type="hidden" name="nones" id="nones" value="0">
                         <input type="hidden" name="prt2"  id="prt2" value="0">
                            </div>
                        </div>
                         
                    </form>
                    <br>
                    <form action="add_daily_data_table.php" method="post">
                    <button type="submit" class="btn btn-primary glyphicon glyphicon-backward">Back</button>   
                    <input type="hidden" name="project" value="<?php echo $project_name; ?>">
                    
                        
                    </form>      
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