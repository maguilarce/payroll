<?php
require_once('connection.php');
session_start();
/*$result = mysql_query("SELECT 
daily_timesheet_id,daily_timesheet.date, daily_timesheet.employee_name,employee.union_trade,employee.home_local,daily_timesheet.job_function,daily_timesheet.pay_rate,pay_rate.pay_rate_hourly_amount,daily_timesheet.premium_rate,premium_rate.premium_rate_amount,daily_timesheet.daily_lump_sum_rate,
daily_lump_sum_rate.daily_lump_sum_amount,daily_timesheet.total_day_hours,daily_timesheet.pay_rate_type,weekly_lump_payments.weekly_lump_payment_type,weekly_lump_payments.weekly_lump_payment_amount
FROM
daily_timesheet
INNER JOIN pay_rate ON daily_timesheet.pay_rate = pay_rate.pay_rate_type
INNER JOIN premium_rate ON daily_timesheet.premium_rate = premium_rate_type
INNER JOIN daily_lump_sum_rate ON daily_timesheet.daily_lump_sum_rate = daily_lump_sum_rate.daily_lump_sum_type
INNER JOIN weekly_lump_payments ON daily_timesheet.weekly_lump_sum_rate = weekly_lump_payments.weekly_lump_payment_type
INNER JOIN employee ON daily_timesheet.employee_name = employee.name
WHERE week_number = week(now())
ORDER BY date,employee_name,pay_rate 
");*/

$result = mysql_query("SELECT 
daily_timesheet_id,
daily_timesheet.date,
daily_timesheet.employee_name,
employee.union_trade,
employee.home_local,
daily_timesheet.job_function,
daily_timesheet.pay_rate,
pay_rate.pay_rate_hourly_amount,
daily_timesheet.total_day_hours,
daily_timesheet.pay_rate_type

FROM
daily_timesheet
INNER JOIN pay_rate ON daily_timesheet.pay_rate = pay_rate.pay_rate_type

INNER JOIN employee ON daily_timesheet.employee_name = employee.name
WHERE week_number = week(now())
ORDER BY employee_name");

//$row = mysql_fetch_array($result, MYSQL_ASSOC);ORDER BY date,employee_name,pay_rate

      $query = mysql_query("SELECT total_week_hours FROM week_hours");
      $row1 = mysql_fetch_array($query, MYSQL_ASSOC);

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
                 		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                <script type="text/javascript" language="javascript" src="js/tablefilter.js"></script>         
                <link href="css/style/tablefilter.css" rel="stylesheet">
                <link href="css/style/colsVisibility.css" rel="stylesheet">
                <link href="css/style/filtersVisibility.css" rel="stylesheet">
                <!--end filter and pagination -->
                 <script language="JavaScript"> 
                    $(document).ready(function()
                  {             
                    $( "#delete" ).submit(function( event ) {
                    if(!confirm( "This will delete selected daily data. Are you sure?" ))
                        event.preventDefault();
                    });
                   });
                </script>
                <script type="text/javascript">
        $(document).ready(function()
        {
            $('.weekly_payment').click(function(event)
            {
                //Obtiene valor de el select que activa el usuario
                //alert($(this).val());
                $(this).next().val($(this).val());
            });
        });
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
        <div class="col-sm-1">
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
                    <a href="#" data-toggle="collapse" data-target="#menu7"><strong>Lump Sum Payments</strong> <i class="glyphicon glyphicon-chevron-right"></i></a>
                    <ul class="nav nav-stacked collapse" id="menu7">
                         <li><a href="add_lump_payment_table.php">Add/Modify/Delete Daily lump sum payment</a>
                        </li>
                        <li><a href="add_weekly_lump_payment_table.php">Add/Modify/Delete Weekly lump sum payment</a>
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
                        <li class="active"> <a href="create_project_profile1.php">Project Profiles</a></li>


                    </ul>
                </li>
                
                                
            </ul>

           
            
        </div>
        <!-- /col-3 -->
        <div class="col-sm-10">


            <a href="dashboard.php"><strong><i class="glyphicon glyphicon-dashboard"></i> My Dashboard</strong></a>
            <hr>

                        <!--
			CENTER MENU
		<!-->
            
            <div class="row">
                <!-- center left-->
                <div class="col-md-18">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <h2>Weekly Time Sheet</h2><br />
                        <h4>Today's Date: <?php echo date("F j, Y");
                        ?></h4>
                        <h4> Pay Period: 
                        <?php 
                         $date = new DateTime();
                         $first = $date->setISODate(date('Y'), date('W'), "1")->format('m/d/Y');
                         $last = $date->setISODate(date('Y'),date('W'), "7")->format('m/d/Y'); 
                        echo "From ".$first." to ".$last; ?>
                        </h4>
                                
                    </div>
  
                    <table id="demo" class="table table-striped table-bordered table-hover">
                            <thead>
                                <form method="post" name="daily_data">
                                <tr>
                                    <th>Date</th>
                                    <th>Employee Name</th>
                                    <th>Union Trade</th>
                                    <th>Home Local #</th>
                                    <th>Job Function</th>
                                    <th>Pay Rate</th>
                                    <th>Pay Rate Amount</th>
                                    <th>Premium Rate</th>
                                     <th>Premium Rate Amount</th>
                                    <th>Daily Lum Sum Rate</th>
                                    <th>Daily Lum Sum Rate Amount</th>
                                    <th>Weekly Lum Sum Rate</th>
                                    <th>Monday</th>
                                    <th>Tuesday</th>
                                    <th>Wednesday</th>
                                    <th>Thursday</th>
                                    <th>Friday</th>
                                    <th>Saturday</th>
                                    <th>Sunday</th>
                                    <th>Total Week Hours</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $menweeklyhours=0;
                                while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                    $job_function = $row['job_function'];
                                        $employee_name = $row['employee_name'];
                                        $pay_rate_type = $row['pay_rate_type'];
                                    $id = $row['daily_timesheet_id'];
                                    $totalh = 0;
                                    
                                ?>
                                <tr>
                                 
                                    <td>
                                        <?php echo "{$row['date']}"; ?>
                                    </td>
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
                                        <?php echo "$"."{$row['pay_rate_hourly_amount']}"; ?>      
                                    </td>
                                    <td>       
                                        <?php 
                                        //consulta a la tabla daily_premium_rate
                                        $job_f = $row['job_function'];
                                        $emp = $row['employee_name'];
                                        $dat=$row['date'];
                                        
                                      
                                        $query = mysql_query("SELECT 
                                            daily_premium_rate.premium_rate AS premium ,premium_rate.premium_rate_amount AS amount
                                            FROM 
                                            daily_premium_rate
                                            INNER JOIN premium_rate ON daily_premium_rate.premium_rate = premium_rate.premium_rate_type
                                            WHERE
                                            daily_premium_rate.employee = '$emp' and daily_premium_rate.job_function = '$job_f' and week = week(now()) and daily_premium_rate.date = '$dat'");
                                        while ($row1 = mysql_fetch_array($query, MYSQL_ASSOC))
                                        {
                                            echo "{$row1['premium']}"."<br /><br />";
                                        }
                                        
                                        ?>
                                    </td>
                                    <td>       
                                        <?php 
                                          //query for amount premium rate
                                         $query = mysql_query("SELECT 
                                            daily_premium_rate.premium_rate AS premium ,premium_rate.premium_rate_amount AS amount
                                            FROM 
                                            daily_premium_rate
                                            INNER JOIN premium_rate ON daily_premium_rate.premium_rate = premium_rate.premium_rate_type
                                            WHERE
                                            daily_premium_rate.employee = '$emp' and daily_premium_rate.job_function = '$job_f' and week = week(now()) and daily_premium_rate.date = '$dat'");
                                        while ($row1 = mysql_fetch_array($query, MYSQL_ASSOC))
                                        {
                                            echo "$"."{$row1['amount']}"."<br /><br /><br />";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        //consulta a la tabla daily_lump_rates
                                        $query = mysql_query("SELECT 
                                            daily_lump_rates.daily_lump_rate AS lump, daily_lump_sum_rate.daily_lump_sum_amount AS amount
                                            FROM 
                                            daily_lump_rates
                                            INNER JOIN daily_lump_sum_rate ON daily_lump_rates.daily_lump_rate = daily_lump_sum_rate.daily_lump_sum_type
                                            WHERE
                                            daily_lump_rates.employee = '$emp' and daily_lump_rates.job_function = '$job_f' and week = week(now()) and daily_lump_rates.date = '$dat'");
                                        while ($row1 = mysql_fetch_array($query, MYSQL_ASSOC))
                                        {
                                            echo "{$row1['lump']}"."<br /><br />";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php 
                                        //
                                        $query = mysql_query("SELECT 
                                            daily_lump_rates.daily_lump_rate AS lump, daily_lump_sum_rate.daily_lump_sum_amount AS amount
                                            FROM 
                                            daily_lump_rates
                                            INNER JOIN daily_lump_sum_rate ON daily_lump_rates.daily_lump_rate = daily_lump_sum_rate.daily_lump_sum_type
                                            WHERE
                                            daily_lump_rates.employee = '$emp' and daily_lump_rates.job_function = '$job_f' and week = week(now()) and daily_lump_rates.date = '$dat'");
                                        while ($row1 = mysql_fetch_array($query, MYSQL_ASSOC))
                                        {
                                            echo "$"."{$row1['amount']}"."<br /><br /><br />";
                                        }
                                        ?>
                                    </td>
                                     <td>
                                       <select name="weekly_payment1" class="form-control weekly_payment"> 
                                           
                                        <?php
                                        
                                        $query = "SELECT * from weekly_lump_payments;";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            { 
                                                $value = $row1['weekly_lump_payment_amount'];
                                                if($row['weekly_lump_payment_type']==$row1['weekly_lump_payment_type'])
                                                {
                                                    echo "<option value='$$value' selected>{$row1['weekly_lump_payment_type']}</option>";
                                                }
                                                else echo "<option value='$$value'>{$row1['weekly_lump_payment_type']}</option>";                           
                                             
                     
                                            }  
                                        
         
                                        ?>
                                        </select>

                                         <input value='<?php echo "$"."{$row['weekly_lump_payment_amount']}"; ?>' name="weekly_payment2" type="text" class="form-control" readonly="">
                                    </td>
                                    
                                    <td>
                                        <!--
                                            MONDAY
                                        <!-->
                                        <?php
                                        
                                        
                                        $sql = mysql_query("SELECT employee_name,total_day_hours
                                                            FROM daily_timesheet
                                                            WHERE week_number=week(now()) AND weekday(date)=0 AND daily_timesheet_id = '$id' ");

                                        $monday = mysql_fetch_array($sql, MYSQL_ASSOC);
                                     
                                        echo "{$monday['total_day_hours']}";
                                        $totalh+=$monday['total_day_hours'];
                                        ?>
                                    </td>
                                     <td>
                                        <!--
                                            TUESDAY
                                        <!-->
                                         <?php
                                        
                                        $sql = mysql_query("SELECT employee_name,total_day_hours
                                                            FROM daily_timesheet
                                                            WHERE week_number=week(now()) AND weekday(date)=1 AND daily_timesheet_id = '$id' ");

                                        $monday = mysql_fetch_array($sql, MYSQL_ASSOC);
                                     
                                        echo "{$monday['total_day_hours']}";
                                        $totalh+=$monday['total_day_hours'];
                                        ?>
                                    </td>

                                     <td>
                                        <!--
                                            WEDNESDAY
                                        <!-->
                                         <?php
                                        
                                        $sql = mysql_query("SELECT employee_name,total_day_hours
                                                            FROM daily_timesheet
                                                            WHERE week_number=week(now()) AND weekday(date)=2 AND daily_timesheet_id = '$id' ");

                                        $monday = mysql_fetch_array($sql, MYSQL_ASSOC);
                                     
                                        echo "{$monday['total_day_hours']}";
                                        $totalh+=$monday['total_day_hours'];
                                        ?>
                                    </td>
                                     <td>
                                        <!--
                                            THURSDAY
                                        <!-->
                                         <?php
                                        
                                        $sql = mysql_query("SELECT employee_name,total_day_hours
                                                            FROM daily_timesheet
                                                            WHERE week_number=week(now()) AND weekday(date)=3 AND daily_timesheet_id = '$id' ");

                                        $monday = mysql_fetch_array($sql, MYSQL_ASSOC);
                                     
                                        echo "{$monday['total_day_hours']}";
                                        $totalh+=$monday['total_day_hours'];
                                        ?>
                                    </td>
                                     <td>
                                        <!--
                                            FRIDAY
                                        <!-->
                                         <?php
                                        
                                        $sql = mysql_query("SELECT employee_name,total_day_hours
                                                            FROM daily_timesheet
                                                            WHERE week_number=week(now()) AND weekday(date)=4 AND daily_timesheet_id = '$id' ");

                                        $monday = mysql_fetch_array($sql, MYSQL_ASSOC);
                                     
                                        echo "{$monday['total_day_hours']}";
                                        $totalh+=$monday['total_day_hours'];
                                        ?>
                                    </td>
                                     <td>
                                        <!--
                                            SATURDAY
                                        <!-->
                                         <?php
                                        
                                        $sql = mysql_query("SELECT employee_name,total_day_hours
                                                            FROM daily_timesheet
                                                            WHERE week_number=week(now()) AND weekday(date)=5  AND daily_timesheet_id = '$id' ");

                                        $monday = mysql_fetch_array($sql, MYSQL_ASSOC);
                                     
                                        echo "{$monday['total_day_hours']}";
                                        $totalh+=$monday['total_day_hours'];
                                        ?>
                                    </td>
                                    <td>
                                        <!--
                                            SUNDAY
                                        <!-->
                                         <?php
                                        
                                        $sql = mysql_query("SELECT employee_name,total_day_hours
                                                            FROM daily_timesheet
                                                            WHERE week_number=week(now()) AND weekday(date)=6  AND daily_timesheet_id = '$id' ");

                                        $monday = mysql_fetch_array($sql, MYSQL_ASSOC);
                                     
                                        echo "{$monday['total_day_hours']}";
                                        $totalh+=$monday['total_day_hours'];
                                        ?>
                                    </td>

                                    
                                    <td>
                                        <?php echo $totalh; 
                                        $menweeklyhours+=$totalh;
                                        ?>
                                    </td>

            

                                    <td>
                                    
                                      
                                            <input type="hidden" name="id" value="<?php echo "{$row['daily_timesheet_id']}"; ?>">
                                            <input type="hidden" name="employee" value="<?php echo "{$row['employee_name']}"; ?>">
                                            <input type="hidden" name="preview_hours" value="<?php echo $row['total_day_hours']; ?>">
                                            
                                        <button type="submit" formaction="">Modify</button> <br /><br />
                                        <button type="submit" formaction="">Delete</button> <br /><br />
                                        <button type="submit" formaction="" class="btn btn-primary">Process </button> <br />
                                    </td> 
                                    

                                
                                </tr>
                                <?php  

                                
                                   }
                                ?>
                            </tbody>
                        </table>
   
                            <label></label>
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    Generate Weekly Time Sheet
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo "{$row['daily_timesheet_id']}"; ?>">
                    </form>
                      <!--
                                   <form action="add_weekly_data.php" method="post" name="daily_data">   
                    <div class="control-group">
                            <label></label>
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    Generate Weekly Time Sheet
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo "{$row['daily_timesheet_id']}"; ?>">
                    </form>
                      
                      <!-->
                    <?php  

                                
                                   echo $menweeklyhours;
                                ?>
     
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
                col_5: 'none',
                col_6: 'none',
                col_7: 'none',
                col_8: 'none',
                col_9: 'none',
                col_10: 'none',
                col_11: 'none',
                col_12: 'none',
                col_13: 'none',
                col_14: 'none',
                col_15: 'none',
                col_16: 'none',
                col_17: 'none',
                col_18: 'none',
                col_19: 'none',


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