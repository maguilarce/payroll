<?php
require_once('connection.php');
session_start();
$id = $_POST['id'];
$project_name = $_POST['project'];
$result = mysql_query("SELECT *
                       FROM daily_timesheet
                       WHERE daily_timesheet_id = '$id'");
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
                        var elem2 = document.getElementById("payrate").value;
                        var nones = document.getElementsByName("nones");
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
        <div class="col-sm-11">
            <div class="row">
                <!-- center left-->
                <div class="col-md-12">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <h4><strong>Daily Time Sheet - Superintendent</strong></h4>
                        <table class="table table-striped table-bordered table-hover">
                            <h4>
                            <tr><td><strong>Date:</strong> <?php echo date("F j, Y");?></td></tr>
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
                    <form action="add_daily_data_form1.php" method="post" name="daily_data">
                    <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Employee Name</th>
                                    <th>Job Function</th>
                                    <th>Pay Rate</th>
                                    <th>Pay Rate Type</th>
                                    <th>Premium Rate</th>
                                    <th>Daily Lump Sum Rate</th>
                                    <th>Worked Hours</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                
                               <tr>
                                    <td>
                                        <select readonly="readonly" name="employee" class="form-control"> 
                                        <?php
                                        $row = mysql_fetch_array($result, MYSQL_ASSOC);
                                                echo "<option>{$row['employee_name']}</option>";                           
                                        ?>
                                        </select>
                                    
                                    </td>
                                    
                                                                     
                                    <td>
                                        <select name="job_function" class="form-control"> 
                                      
                                        <?php
                                            $query = "SELECT job_function_type from job_function;";
                                            $result = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                                if($row['job_function']==$row1['job_function_type'])
                                                {
                                                    echo "<option selected>{$row1['job_function_type']}</option>";
                                                }
                                                else echo "<option>{$row1['job_function_type']}</option>";                           
                                             
                     
                                            }  
                                   
                                        ?>
                                        </select>
                                    </td>      
                                    
                                    <td>
                                         <select id="payrate" name="pay_rate" class="form-control" onchange="javascript:desactivar();">
                                        <?php
                                   
                                            $query = "SELECT pay_rate_type from pay_rate;";
                                            $result = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                                if($row['pay_rate']==$row1['pay_rate_type'])
                                                {
                                                    echo "<option selected>{$row1['pay_rate_type']}</option>";
                                                }
                                                else echo "<option>{$row1['pay_rate_type']}</option>";                           
                                             
                     
                                            }  
                                   
                                        ?>
                                         </select>
                                    </td>  
                                        <td>
                                            <?php
                                            $query = "SELECT pay_rate_type from daily_timesheet WHERE daily_timesheet_id = '$id';";
                                            $result = mysql_query($query);
                                            $row1 = mysql_fetch_array($result, MYSQL_ASSOC);
                                            $prt = $row1['pay_rate_type'];
                                            echo "<input type='text' id='pay_rate_type' value='$prt' readonly='reandonly'>";    
                                              
                                        ?>
                             
                                        </td>
                                    <td>
                                        
                                        <?php
                                        //SHOW THE DAILY PREMIUM RATES SELECTED AND NOT SELECTED
                                        $employee = $row['employee_name'];
                                        $date = $row['date'];
                                        $job_function = $row['job_function'];
                                        $values = array();
                                        $selected = array();
                                        
                                        $query = "SELECT * FROM daily_premium_rate WHERE date = '$date' AND employee = '$employee' AND job_function = '$job_function'";
                                        $result1 = mysql_query($query);
                                        while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                $selected[]=$row1['premium_rate'];
                                            }
                                        
                                        
                                        
                                        $query = "SELECT * from premium_rate;";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                
                                                $values[]=$row1['premium_rate_type'];
                                                /*$value = $row1['premium_rate_type'];
                                                echo "<input type='checkbox' name='daily_premium_rate[]' value='$value' / > {$row1['premium_rate_type']}<br>";*/

                                            }
                                            
                                            for($i=0;$i<count($values);$i++)
                                            {
                                                $value = $values[$i];
                                                if(in_array($values[$i],$selected))
                                                {
                                                    
                                                    echo "<input type='checkbox' name='daily_premium_rate[]' value='$value' checked='checked' / > $value<br>";
                                                }
                                                else
                                                    echo "<input type='checkbox' name='daily_premium_rate[]' value='$value' / > $value<br>";
                                            }
                                        ?>
                                        
                                    </td>
                                    <td>
                                        
                                        <?php
                                        //SHOW THE DAILY LUMP SUM RATES SELECTED AND NOT SELECTED
                                        $values1 = array();
                                        $selected1 = array();
                                        $query = "SELECT * FROM daily_lump_rates WHERE date = '$date' AND employee = '$employee' AND job_function = '$job_function' ";
                                        $result1 = mysql_query($query);
                                        while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                $selected1[]=$row1['daily_lump_rate'];
                                            }
                                        
                                        
                                        
                                        $query = "SELECT * from daily_lump_sum_rate;";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                
                                                $values1[]=$row1['daily_lump_sum_type'];
                                                /*$value = $row1['premium_rate_type'];
                                                echo "<input type='checkbox' name='daily_premium_rate[]' value='$value' / > {$row1['premium_rate_type']}<br>";*/

                                            }
                                            
                                            for($i=0;$i<count($values1);$i++)
                                            {
                                                $value = $values1[$i];
                                                if(in_array($values1[$i],$selected1))
                                                {
                                                    
                                                    echo "<input type='checkbox' name='daily_lump_sum_rate[]' value='$value' checked='checked' / > $value<br>";
                                                }
                                                else
                                                    echo "<input type='checkbox' name='daily_lump_sum_rate[]' value='$value' / > $value<br>";
                                            }
                                        
                                        ?>
                                        
                                    </td>
                                    
                                   
                                         <?php
                                         $hours = 0;
                                         $query = "SELECT total_day_hours from daily_timesheet WHERE daily_timesheet_id = '$id';";
                                         $result = mysql_query($query);
                                         $row1 = mysql_fetch_array($result, MYSQL_ASSOC);
                                         $hours = $row1['total_day_hours'];
                                         ?>
                                    <td>
                                        <input value="<?php echo $hours; ?>" name="worked_hours" type="text" class="form-control">
                                    </td> 
                                    
                                                                      
                                    <td>
                                         <select name="status" class="form-control"> 
                                         <?php
                                         
                                       $query = "SELECT status_type from status;";
                                         $result = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                                if($row['status']==$row1['status_type'])
                                                {
                                                    echo "<option selected>{$row1['status_type']}</option>";
                                                }
                                                else echo "<option>{$row1['status_type']}</option>";                           
                                             
                     
                                            }  
                                        ?> 
                                    </td> 
                                    <td>
                                        <textarea value="<?php echo "{$row['daily_notes']}"; ?>" class="form-control" name="notes"><?php echo "{$row['daily_notes']}"; ?></textarea>
                                    </td>
                                
                                </tr>
          
                            </tbody>
                        </table>
                        <div class="control-group">
                            <label></label>
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    Modify register
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="project" value="<?php echo $project_name; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="preview_hours" value="<?php echo $row['total_day_hours']; ?>">
                        <input type="hidden" name="date" value="<?php echo $row['date']; ?>">
                        <input type="hidden" name="old_jf" value="<?php echo $row['job_function']; ?>">
                        <input type="hidden" name="old_pr" value="<?php echo $row['pay_rate']; ?>">
                         <input type="hidden" name="nones"  id="nones" value="0">
                         <input type="hidden" name="prt2"  id="prt2" value="0">
                        
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

            <hr>

           
        </div>
        <!--/col-span-9-->
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