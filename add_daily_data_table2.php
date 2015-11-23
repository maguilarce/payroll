<?php
require_once('connection.php');
session_start();
//consulta para agregar los checkbox de premium rates y daily lump sum rates
//traer por post los datos y los arreglos de los check box
$counties="";
 if(isset($_POST["project"]))
  {
   $project=$_POST["project"]; 
   $query2 = "SELECT * FROM jurisdiction WHERE project_name='$project'";
   $result2 = mysql_query($query2);
   while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC))
   {
    
    $counties .= $row2['county'].' - '.$row2['state']."\n"."Operators Local Union # ".$row2['operator_local']."\n"."Teamster Local Union # ".$row2['teamster_local']."\n"."Laborer Local Union # ".$row2['laborer_local']."\n\n";
    }
    echo ltrim($counties);
  exit;
  }
 
 $query = "SELECT * FROM project";
 $result = mysql_query($query);

    
    


$result = mysql_query("SELECT daily_timesheet_id,date,employee_name,employee.union_trade,employee.home_local,job_function,pay_rate,pay_rate_type,total_day_hours,status,daily_notes,processed
FROM employee INNER JOIN daily_timesheet
ON employee.name=daily_timesheet.employee_name
WHERE date = CURDATE();");

if(mysql_num_rows($result)==0)
{
    $message="None daily foreman has charged today's data";
}
else
{
    $message = "";
}


$retval2 = mysql_query("SELECT county,state FROM jurisdiction WHERE project_name = '$project_name'");

      

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
                 <script language="JavaScript"> 
                    $(document).ready(function()
                  {             
                    $( ".delete" ).submit(function( event ) {
                    if(!confirm( "This will delete selected daily data. Are you sure?" ))
                        event.preventDefault();
                    });
                   });
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

	</head>
	<body>
<!-- header -->
<div id="top-nav" class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Payroll & Timesheet Application</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" role="button" data-toggle="dropdown" href="#"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['user_id']; ?> <span class="caret"></span></a>
                    <ul id="g-account-menu" class="dropdown-menu" role="menu">
                        <li><a href="#">My Profile</a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="glyphicon glyphicon-lock"></i> Logout</a></li>
            </ul>
        </div>
    </div>
    <!-- /container -->
</div>
<!-- /Header -->

<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-2">
            <!-- Left column -->
            <img src="let-logo.png" /><br/>
            <a href="#"><strong><i class="glyphicon glyphicon-wrench"></i> Workers</strong></a>

            <hr>

            <!--
			LEFT MENU
		<!-->
            <ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu1"><strong>Employee info</strong> <i class="glyphicon glyphicon-user"></i></a>
                    <ul class="nav nav-stacked collapse in" id="menu1">
                        <li class="active"> <a href="add_employee_form.php">Add new employee</a></li>
                        <li class="active"> <a href="edit_employee_table.php">Edit/modify employee</a></li>
                        <li class="active"> <a href="delete_employee_table.php">Delete employee</a></li>

                    </ul>
                </li>
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu2"><strong>Job functions</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>

                    <ul class="nav nav-stacked collapse" id="menu2">
                        <li><a href="add_job_function_table.php">Add/Modify/Delete job function</a>
                        </li>


                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu3"><strong>Status</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu3">
                       <li><a href="add_status_table.php">Add/Modify/Delete status</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu4"><strong>Union trade</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu4">
                       <li><a href="add_union_trade_table.php">Add/Modify/Delete union trade</a>
                        </li>

                    </ul>
                </li>
                
            </ul>

            <hr>

            <a href="#"><strong><i class="glyphicon glyphicon-link"></i> Rates</strong></a>

            <hr>

            <ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu5"><strong>Pay rates</strong> <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="nav nav-stacked collapse in" id="menu5">
                        <li class="active"> <a href="add_pay_rate_table.php">Add/Modify/Delete pay rate</a></li>


                    </ul>
                </li>
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu6"><strong>Premium rates</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>

                    <ul class="nav nav-stacked collapse" id="menu6">
                        <li><a href="add_premium_rate_table.php">Add/Modify/Delete premiun rate</a>
                        </li>


                    </ul>
                </li>
                <li class="nav-header">
                    <a href="#" data-toggle="collapse" data-target="#menu7"><strong>Lumps payments</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu7">
                        <li><a href="add_lump_payment_table.php">Add/Modify/Delete lump payment</a>
                        </li>

                    </ul>
                </li>
                                
            </ul>

           <hr>

            <a href="#"><strong><i class="glyphicon glyphicon-link"></i> Projects</strong></a>

            <hr>

            <ul class="nav nav-stacked">
                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#menu5"><strong>Projects</strong> <i class="glyphicon glyphicon-chevron-down"></i></a>
                    <ul class="nav nav-stacked collapse in" id="menu5">
                        <li class="active"> <a href="add_project_table.php">Add/Modify/Delete project</a></li>


                    </ul>
                </li>
                
                                
            </ul>

           
            
        </div>
        <!-- /col-3 -->
        <div class="col-sm-9">


            <a href="dashboard.php"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>
            <hr>

                        <!--
			CENTER MENU
		<!-->
            
            <div class="row">
                <!-- center left-->
                <div class="col-md-14">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <h2>Daily Time Sheet</h2><br />
                        <h4>Date: <?php echo date("F j, Y");?></h4><br />
                        <div class="control-group">
                                    <label>Associated Project</label>
                                    <div class="controls">
                                        <select id="project" name="project" class="form-control">
                                            <option selected value="0">Select a project...</option>
                                            <?php
                                            while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                             $value = $row['project_name']; 
                                             echo "<option value = '$value'>{$row['project_name']}</option>";
                                            }  
                                            ?>

                                        </select>
                                    </div>
                                </div><br />
                                <div class="control-group">
                                    <label>Project Location(s)</label><br/>
                       
                                    <h4><?php echo ltrim($counties); ?></h4>
                                    
                                </div><br />
                                
                    </div>
 <form action="add_daily_data_form.php" method="post" name="daily_data">   
                    <div class="control-group">
                            <label></label>
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    Add new register
                                </button>

                            </div>
                        </div>
 </form>
                    <h3><strong><?php echo $message;?></strong></h3><br />
                    <table id="demo" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                  
                                    <th>Employee Name</th>
                                    <th>Union Trade</th>
                                    <th>Home local #</th>
                                    <th>Job Function</th>
                                    <th>Pay Rate</th>
                                    <th>Premium Rate</th>
                                    <th>Daily Lum Sum Rates</th>
                                    <th>Worked Hours</th>
                                    <th>Status</th>
                                    <th>Notes</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
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
                                                echo "{$row1['premium_rate']}"."<br />";
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
   
                                            if($row['processed']=='yes')
                                        {   
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
                                    </td>


                                    <td>
                                        <input type="hidden" name="employee" value="<?php echo "{$row['employee_name']}"; ?>">
                                        <input type="hidden" name="job_function" value="<?php echo $row['job_function']; ?>">
                                        <input type="hidden" name="id" value="<?php echo "{$row['daily_timesheet_id']}"; ?>">
                                        <input type="hidden" name="date" value="<?php echo "{$row['date']}"; ?>">
                                        <input type="hidden" name="preview_hours" value="<?php echo $row['total_day_hours']; ?>">
                                        
                                       
                                        
                                        <button type="submit" formaction="edit_daily_data_form.php">Modify</button> <br /><br />
                                        <button type="submit" formaction="delete_daily_data_form.php">Delete</button> <br /><br />
                                        <button type="submit" formaction="process.php" class="btn btn-primary">Process </button> <br />

                            
                                    </td> 
                                    
                                    
                                
                                </tr>
                                </form>
                                
                                
                                <?php 
                                
                                
                                   }
                                ?>
                            </tbody>
                        </table>
                   
                    
                    <form action="" method="post" name="daily_data">   
                    <div class="control-group">
                            <label></label>
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    Generate Daily Time Sheet
                                </button>

                            </div>
                        </div>
                    </form>
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

<footer class="text-center">Let LLC - CopyRight © 2015 - <a href="http://www.letllc.com"><strong>www.letllc.com</strong></a></footer>

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
                <!-- filter and pagination -->
                <script data-config>
                var filtersConfig = {          
                paging: true,  
                paging_length: 20,  
                results_per_page: ['# rows per page',[20,10,8,6,4,2]],  
                rows_counter: true,  
                rows_counter_text: "Rows:",  
                display_all_text: " [ Show all ] ",
                loader: true, 
                col_0: 'select',
                col_1: 'select',
                col_2: 'select',
                col_3: 'select',
                col_4: 'select',
                col_5: 'select',
                col_6: 'select',
                col_7: 'select',
                col_8: 'select',
                col_9: 'select',
                col_10: 'select',
                col_11: 'none',
                col_12: 'none',
                       
                extensions:[
                    {

                        editable: false,
                        selection: false

                    }, {
                        name: 'sort',
                        types: [
                            'string', 'string', 'number',
                            'number', 'number', 'number',
                            'number', 'number', 'number'
                        ]
                    }
                ]
            };

            var tf = new TableFilter('demo', filtersConfig);
            tf.init();
            
</script>
<!-- end filter and pagination -->
	</body>
</html>