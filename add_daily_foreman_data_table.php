<?php
require_once('connection.php');
session_start();
$project_name = $_POST['project'];
$result = mysql_query("SELECT daily_timesheet_id,employee_name,employee.union_trade,job_function,pay_rate,total_day_hours,daily_timesheet.status
FROM employee INNER JOIN daily_timesheet
ON employee.name=daily_timesheet.employee_name
WHERE date = CURDATE() AND associated_project = '$project_name';");

if(mysql_num_rows($result)==0)
{
    $message="Alert: You have not yet entered any record.";
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
                  <script type="text/javascript"> 
                    $(document).ready(function()
                  {             
                    $( ".delete" ).submit(function( event ) {
                    if(!confirm( "This will delete selected daily data. Are you sure?" ))
                        event.preventDefault();
                    });
                   });
                </script>

	</head>
	<body>
<!-- header -->

<!-- /Header -->

<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">

            <div class="row">
                <!-- center left-->
                <div class="col-md-14">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <h4><strong>Daily Time Sheet - Foreman</strong></h4>
                        <table class="table table-striped table-bordered table-hover">
                            <h4>
                            <tr><td><strong>Date:</strong> <?php echo date("F j, Y");?></td></tr>
                            <tr><td><strong>Project Name: </strong><?php echo $project_name;?></td></tr>
                           
                            </h4>
                        </table>
                                
                    </div>
               
                 <h4><strong style="color: red"><?php echo  $message;?></strong></h4><br />
                    <table id="demo" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>

                                    <th>Employee Name</th>
                                    <th>Union Trade</th>
                                    <th>Job Function</th>
                                    <th>Group</th>
                                    <th>Worked Hours</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                ?>
                                <tr>
 
                                    <td>
                                        <?php echo "{$row['employee_name']}"; ?>
                                    </td>
                                                              
                                    <td>
                                        <?php echo "{$row['union_trade']}"; ?>                        
                                    </td>
                                   
                                    <td>
                                        <?php echo "{$row['job_function']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['pay_rate']}"; ?>      
                                    </td>
                                    
                                                                        
                                    <td>
                                        <?php echo "{$row['total_day_hours']}"; ?> 
                                    </td>
                                    <td>
                                        <?php echo "{$row['status']}"; ?>          
                                    </td>



                                    <td>
                                        <form action="edit_daily_foreman_data_form.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo "{$row['daily_timesheet_id']}"; ?>">
                                            <input type="hidden" name="project" value="<?php echo $project_name; ?>">
                                            <button type="submit" class="btn btn-primary" title="Edit"><i class="glyphicon glyphicon-edit"></i></button>
                                            <!--<input type="submit" name="modify" value="Modify">-->
                                        </form>
                                        <br />
                                        <form class="delete" id="delete" action="delete_daily_foreman_data_form.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo "{$row['daily_timesheet_id']}"; ?>">
                                            <input type="hidden" name="employee" value="<?php echo "{$row['employee_name']}"; ?>">
                                            <input type="hidden" name="preview_hours" value="<?php echo $row['total_day_hours']; ?>">
                                            <input type="hidden" name="project" value="<?php echo $project_name; ?>">
                                            <button type="submit" class="btn btn-primary" title="Delete"><i class="glyphicon glyphicon-trash"></i></button>
                                            <!--<input type="submit" name="delete" value="Delete">-->
                                        </form>
                                    </td> 
                                    

                                
                                </tr>
                                <?php                               
                                   }
                                ?>
                            </tbody>
                        </table>
                   
                    </form>
                    
                    <table><tr>
                            <td><form action="add_daily_foreman_data_form.php" method="post" name="daily_data">   
                    <div class="control-group">
                            <label></label>
                            <div class="controls">
                                <button type="submit" class="btn btn-primary">
                                    Add new register
                                </button>

                            </div>
                        </div>
                        <input type="hidden" name="project_name" value="<?php echo $project_name; ?>">
                                </form>
                            
                            </td>
                            
                            <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                            <td> 
                            <form action="add_daily_foreman_data_table_print.php" method="post" name="daily_data" target="_blank">   
                            <div class="controls">
                                <input type="hidden" name="p_pname" value="<?php echo $project_name; ?>">
                                <button type="submit" class="btn btn-primary">
                                    Generate and Print Daily Time Sheet
                                </button>
                            </div>                        
                            </form></td>
                        </tr></table>
                    </div>
              
                        
                    </form>      
                </div>
                <!--/col-->
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
                col_3: 'none',
                col_4: 'none',
                col_5: 'select',
                col_6: 'none',

                       
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