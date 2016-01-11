    <?php
require_once('connection.php');

session_start();
$project_name = $_POST['project']; 
$result = mysql_query("SELECT 
daily_timesheet_id,
daily_timesheet.date,
daily_timesheet.employee_name,
daily_timesheet.processed_week,
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
WHERE week_number = week(now(),3) AND associated_project = '$project_name'
ORDER BY employee_name");


if(mysql_num_rows($result)==0)
{
    $message="Alert: You have not yet entered any record.";
}
else
{
    $message = "";
}

$retval2 = mysql_query("SELECT * FROM jurisdiction WHERE project_name = '$project_name'");

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
                <script type="text/javascript" src="js/jQuery.print.js"></script>
                 <script language="JavaScript"> 
                   /* $(document).ready(function()
                  {
                    
                    $( ".delete" ).submit(function( event ) {
                    if(!confirm( "This will delete selected daily data. Are you sure?" ))
                        event.preventDefault();
                    });
                   });*/
                    function eliminar(){
                        
                        if(!confirm( "This will delete selected data. Are you sure?" ))
                        event.preventDefault();
                }
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
    <script>
    function P_div4(){  $(p2).print(); return( false );}
    
    </script>
        

	</head>
	<body>
<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10">
            <div class="row">
                <!-- center left-->
                <div class="col-md-12">
                    <div class="panel-title" name="p2">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <h4><strong>Weekly Time Sheet</strong></h4>
                        <table class="table table-striped table-bordered table-hover">
                            <h4>
                            <tr><td><strong>Date:</strong> <?php echo date("F j, Y");?></td></tr>
                            <tr><td><strong>Project Name: </strong><?php echo $project_name;?></td></tr>
                            <tr><td><strong>Pay Period: </strong><?php
                            $date = new DateTime();
                            $first = $date->setISODate(date('Y'), date('W'), "1")->format('m/d/Y');
                            $last = $date->setISODate(date('Y'),date('W'), "7")->format('m/d/Y'); 
                            echo "From ".$first." to ".$last;
                            ?></td></tr>
                            <tr><td><strong>Project Location(s): </strong><?php
                            $i=1;
                            while($row2 = mysql_fetch_array($retval2,1))
                            {
                               echo "<tr><td>".$i++.")".$row2['county'].", ".$row2['state']." ---> <strong>Operators Local Union #:</strong> ".$row2['operator_local']."<strong> / Teamster Local Union #: </strong>".$row2['teamster_local']." <strong> / Laborer Local Union #: </strong>".$row2['laborer_local']."</td></tr>";
                            }
                            ?>
                                    </td></tr>
                            </h4>
                        </table>
                                                        
                    </div>
                    <h4><strong style="color: red"><?php echo  $message;?></strong></h4><br />
                    <table id="demo" class="table table-striped table-bordered table-hover">
                            <thead>
                                
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
                                        $date = $row['date'];
                                        $totalh = 0;
                                    
                                ?>
                                <form method="post" name="daily_data">
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
                                        $pay_rate = $row['pay_rate'];
                                      
                                        $query = mysql_query("SELECT 
                                            daily_premium_rate.premium_rate AS premium ,premium_rate.premium_rate_amount AS amount
                                            FROM 
                                            daily_premium_rate
                                            INNER JOIN premium_rate ON daily_premium_rate.premium_rate = premium_rate.premium_rate_type
                                            WHERE
                                            daily_premium_rate.employee = '$emp' and daily_premium_rate.job_function = '$job_f' and week = week(now(),3) and daily_premium_rate.date = '$dat' and pay_rate = '$pay_rate'");
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
                                            daily_premium_rate.employee = '$emp' and daily_premium_rate.job_function = '$job_f' and week = week(now(),3) and daily_premium_rate.date = '$dat' and pay_rate = '$pay_rate'");
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
                                            daily_lump_rates.employee = '$emp' and daily_lump_rates.job_function = '$job_f' and week = week(now(),3) and daily_lump_rates.date = '$dat' and pay_rate = '$pay_rate'");
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
                                            daily_lump_rates.employee = '$emp' and daily_lump_rates.job_function = '$job_f' and week = week(now(),3) and daily_lump_rates.date = '$dat' and pay_rate = '$pay_rate'");
                                        while ($row1 = mysql_fetch_array($query, MYSQL_ASSOC))
                                        {
                                            echo "$"."{$row1['amount']}"."<br /><br /><br />";
                                        }
                                        ?>
                                    </td>
                                     <td>
                                       
                                           
                                        <?php
                                        
                                       if($row['processed_week']=='yes')
                                        {   
                                           $button = "disabled";
                                            $query = "SELECT weekly_lump_payment FROM weekly_lump_payments_employees WHERE employee='$employee_name' AND job_function = '$job_function' AND week = week('$date',3) and pay_rate = '$pay_rate';";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                echo "-"."{$row1['weekly_lump_payment']}"."<br /><br />";
                                            }
                                        }    
                                        else
                                        {
                                            $button = "";
                                            $query = "SELECT * from weekly_lump_payments;";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {

                                                $value = $row1['weekly_lump_payment_type'];
                                                echo "<input type='checkbox' name='weekly_lump_payments[]' value='$value' / > {$row1['weekly_lump_payment_type']}<br>";

                                            }
                                        }                     
                                             
                     
                                         
                                        
         
                                        ?>
                                         </td>
                                    
                                    <td>
                                        <!--
                                            MONDAY
                                        <!-->
                                        <?php
                                        
                                        
                                        $sql = mysql_query("SELECT employee_name,total_day_hours
                                                            FROM daily_timesheet
                                                            WHERE week_number=week(now(),3) AND weekday(date)=0 AND daily_timesheet_id = '$id' ");

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
                                                            WHERE week_number=week(now(),3) AND weekday(date)=1 AND daily_timesheet_id = '$id' ");

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
                                                            WHERE week_number=week(now(),3) AND weekday(date)=2 AND daily_timesheet_id = '$id' ");

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
                                                            WHERE week_number=week(now(),3) AND weekday(date)=3 AND daily_timesheet_id = '$id' ");

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
                                                            WHERE week_number=week(now(),3) AND weekday(date)=4 AND daily_timesheet_id = '$id' ");

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
                                                            WHERE week_number=week(now(),3) AND weekday(date)=5  AND daily_timesheet_id = '$id' ");

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
                                                            WHERE week_number=week(now(),3) AND weekday(date)=6  AND daily_timesheet_id = '$id' ");

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
                                    
                                      

                                            
                                        <button type="submit" formaction="edit_weekly_data_form.php" class="btn btn-primary">Modify</button> <br /><br />
                                        <button onclick="eliminar();" type="submit" formaction="delete_weekly_data_form.php" class="btn btn-primary">Delete</button> <br /><br />
                                        <button type="submit" formaction="process_week2.php" class="btn btn-primary" <?php echo $button; ?> >Process </button> <br />
                                        <input type="hidden" name="project" value="<?php echo $project_name; ?>">
                                    </td> 
                                    

                                
                                </tr>
                                <input type="hidden" name="id" value="<?php echo "{$row['daily_timesheet_id']}"; ?>">
                                <input type="hidden" name="employee" value="<?php echo "{$row['employee_name']}"; ?>">
                                <input type="hidden" name="date" value="<?php echo "{$row['date']}"; ?>">
                                <input type="hidden" name="preview_hours" value="<?php echo $row['total_day_hours']; ?>">
                                <input type="hidden" name="job_function" value="<?php echo $row['job_function']; ?>">
                                <input type="hidden" name="pay_rate" value="<?php echo $row['pay_rate']; ?>">
                                </form>
                                <?php  

                                
                                   }
                                ?>
                            </tbody>
                        </table>
   
                            <label></label>
                            <div class="controls">
                                <form action="add_weekly_data_table_print.php" target="_blank" method="POST">
                                 <input type="hidden" name="project" value="<?php echo $project_name; ?>">   
                                  <button type="submit" class="btn btn-primary">
                                    Generate and Print Weekly Time Sheet
                                  </button>
                                </form>
                            </div>
                            <div class="controls">
                                <form action="create_weekly_timesheet_superintendent1.php" method="post">
                    <button type="submit" class="btn btn-primary glyphicon glyphicon-backward">Back</button>   
                    </form>
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

                                
                                   //echo $menweeklyhours;
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
                col_20: 'none',


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