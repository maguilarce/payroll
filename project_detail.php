<?php
require_once('connection.php');

session_start();
$project_id = $_POST['id_project'];
      
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
                    if(!confirm( "This will delete selected project profile. Are you sure?" ))
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

<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10">
        <div class="row">
                <!-- center left-->
                <div class="col-md-10">
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                        <h2>Project Detail</h2><br>
                        <h4>Date: <?php echo date("F j, Y");?></h4><br>
                                
                    </div>
                   
                   <?php
                   
                   $query = "SELECT * FROM project WHERE project_id='$project_id'";
                   $result = mysql_query($query);
                   
                   $row = mysql_fetch_array($result,MYSQL_ASSOC);
                   
                       $id = $row['project_id'];
                       $pname = $row['project_name'];
                       $query2 = "SELECT county,state FROM jurisdiction WHERE project_name='$pname'";
                       $result2 = mysql_query($query2);
                       $query3 = "SELECT employee_id FROM emp_proj WHERE project_name='$pname'";
                       $result3 = mysql_query($query3);
                       echo "<form method='post'>
                    <div class='panel panel-default'>       
                       <div class='panel-heading'>       
                        <div class='panel-title'>
                             <table><tr><td style='vertical-align:text-top'>
                                <h5><strong>Project Name: </strong>".$row['project_name']."<br></h5>
                                <h5><strong>Project Description: </strong>".$row['project_description']."<br></h5>
                                <h5><strong>General Contractor: </strong>".$row['general_contractor']."<br></h5>
                                <h5><strong>Person in charge of the project: </strong><br>".$row['in_charge_of']."</h5>
                                <h5><strong>Employees in this Project: </strong><br>";
                               while($row3 = mysql_fetch_array($result3,MYSQL_ASSOC))
                               {
                                   $query4="SELECT name FROM employee WHERE employee_id='".$row3['employee_id']."'";
                                   $result4 = mysql_query($query4);
                                   $row4=  mysql_fetch_array($result4);
                                   echo $row4['name']."<br>";
                               }
                               echo "</h5></td><td style='vertical-align:text-top'><h5><strong>&nbsp&nbsp Starting date: </strong> ".$row['starting_date']."</h5>
                                <h5><strong>&nbsp&nbsp Completion date: </strong> ".$row['completion_date']."</h5>
                                <h5><strong>&nbsp&nbsp County(ies) where project has jurisdiction: </strong><br>";
                                
                                while($row2 = mysql_fetch_array($result2,MYSQL_ASSOC))
                                {
                                    echo "&nbsp&nbsp&nbsp&nbsp".$row2['county']." - ".$row2['state']."<br/>";
                                }
                                
                               echo "</h5></td></tr></table><br>
                                <button formaction='edit_project_profile1.php' type='submit' class='btn btn-primary'><i class='glyphicon glyphicon-edit'></i>
                                    Edit
                                </button>  
                                <button formaction='delete_project.php' type='submit' class='btn btn-primary'><i class='glyphicon glyphicon-trash'></i>
                                    Delete
                                </button>
                        </div>
                    </div>
                    </div>
                     <input type='hidden' name='id' value='$id'>
                     <input type='hidden' name='project_name' value='$pname'>
                    </form>   
                       ";                       
                   
                   
                   ?>

                    </div>
              
                </div>
                <!--/col-->
                <!--/col-span-6-->

            </div>
            <!--/row-->
           
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