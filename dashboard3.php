<?php
require_once('connection.php');
function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
}

$result = mysql_query("SELECT *
FROM project");

$employees = mysql_query("SELECT name,address,phone_number,email,hiring_date,union_trade,crew 
FROM employee
WHERE hired = 'y';");
//$row = mysql_fetch_array($result, MYSQL_ASSOC);

      

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

	</head>
	<body>
<div class="container-fluid">
    <div class="row col-md-12">
        <!-- CENTER MENU -->
            <div class="row">
                <!-- center left-->
                <div class="col-md-12">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>    
                        <h2>Dashboard - Daily Superintendent</h2>
                        <h4>Today's Date: <?php echo date("F j, Y");?></h4><br/>
                    </div>
            <form action="" method="post" name="daily_data">   
                <h4><strong>Active Projects</strong></h4>
                    <table id="demo" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Project</th>
                                    <th>Description</th>
                                    <th>Starting Date</th>
                                    <th>Completion Date</th>
                                    <th>Location</th>
                                    <th>In Charge of</th>
                                             
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysql_fetch_array($result, MYSQL_ASSOC))
                                            { 
                                ?>
                                <tr>
                                    <td>
                                        <?php echo "{$row['project_name']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['project_description']}"; ?>
                                    </td>
                                     <td>
                                        <?php echo "{$row['starting_date']}"; 
                                        if(date("Y-m-d")>$row['starting_date']&&date("Y-m-d")<$row['completion_date'])
                                        {
                                            echo "<h6 style='color: green' ><strong>The project has started</strong></h6>";
                                        }
                                        if(date("Y-m-d")<$row['starting_date'])
                                        {
                                            echo "<h6 style='color: blue' ><strong>The project will start in ".dias_transcurridos(date("Y-m-d"),$row['starting_date'])." days</strong></h6>";
                                        }
                                        ?>
                                    </td>
                                     <td>
                                        <?php echo "{$row['completion_date']}"."<br/>"; 
                                        if(date("Y-m-d")>$row['completion_date'])
                                        {
                                            echo "<h6 style='color: red' ><strong>Warning: The completion date has expired</strong></h6>";
                                        }
                                       
                                        ?>
                                    </td>
                                     <td>
                                        <?php
                                        $project_name = $row['project_name'];
                                        $query = "SELECT county,state FROM jurisdiction WHERE project_name = '$project_name'";
                                        $retval = mysql_query($query);
                                        while($fila = mysql_fetch_array($retval,1))
                                        {
                                            echo $fila['county'].", ".$fila['state']."<br/>";
                                        }
                                        ?>
                                    </td>
                                     <td>
                                        <?php echo "{$row['in_charge_of']}"; ?>
                                    </td>
                                                                    
                                </tr>
                                <?php                               
                                   }
                                ?>
                            </tbody>
                        </table>
     
                     <h4><strong>Active Employees</strong></h4>
                    <table id="demo1" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Hiring Date</th>
                                    <th>Union Trade</th>
                                    <th>Crew</th>
                                             
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while($row = mysql_fetch_array($employees, MYSQL_ASSOC))
                                            { 
                                ?>
                                <tr>
                                    <td>
                                        <?php echo "{$row['name']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['address']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['phone_number']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['email']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['hiring_date']}"; ?>
                                    </td>
                                    <td>
                                        <?php echo "{$row['union_trade']}"; ?>
                                    </td>
                                     <td>
                                        <?php echo "{$row['crew']}"; ?>
                                    </td>
                                    
                                                                    
                                </tr>
                                <?php                               
                                   }
                                ?>
                            </tbody>
                        </table>
                        
                        
                   
                    </form>

                    </div>
                
              
                </div>
                
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
            var tf1 = new TableFilter('demo1', filtersConfig);
            tf1.init();
            
</script>
<!-- end filter and pagination -->
	</body>
</html>