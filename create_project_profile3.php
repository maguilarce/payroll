<?php

require_once('connection.php');
session_start();
//this data has to be passed thru hidden inputs to the next page***********************
$project_name = $_POST['pname'];
$project_description = $_POST['pdescription'];
$general_contractor = $_POST['general_contractor'];
$in_charge_of = $_POST['in_charge_of'];
$states = $_POST['states'];
$starting_date = $_POST['starting_date'];
$completion_date = $_POST['completion_date'];
$user_id=$_POST['user_aut'];
$level=$_POST['level'];

$query = "INSERT INTO project VALUES ('','$project_name','$project_description','$general_contractor','$in_charge_of','$starting_date','$completion_date','$user_id','$level')";
$result = mysql_query($query);
if(! $result )
  {
    die('Could not get data: ' . mysql_error());

  }

//*************************************************************************************
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
               /* function verificar(){
                    var suma = 0;
                    var los_cboxes = document.getElementsByName('states[]'); 
                    for (var i = 0, j = los_cboxes.length; i < j; i++) {

                    if(los_cboxes[i].checked === true){
                    suma++;
                    }
                }

                if(suma === 0){
                alert("Must select at least one state");
                return false;
                }

                }*/
                </script> 


	</head>
	<body>
<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <!-- center left-->
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>Create Project Profile - Step 3/4</h4>
                                <h6>Select the county or counties where the project will be developed:</h6>
                            </div>
                        </div>
         
                        
                        <form method="GET" action="create_project_profile4.php" >
                                <div class="control-group">
                                    <table>
                                        <tr>
                                            
                                        </tr>
                                    </table>
                        <?php
                            for($i=0;$i<count($states);$i++)
                                {
                                   $state = $states[$i]." ";
                                   $query = "SELECT idcounties,county FROM counties WHERE state = '$state';";
                                   $result = mysql_query($query);
                                   if($i == 0){echo "<table><tr><td style='vertical-align:text-top'>";}
                                   if($i>0){echo "<td style='vertical-align:text-top' >";}
                                   echo "<h3 style='margin:10px'>".$state." </h3><br />";
                                    while($row = mysql_fetch_array($result,MYSQL_ASSOC))
                                    {
                                        $county = $row['county'];
                                        $comma = ",";
                                        $star = "*";  
                                        //echo "<input type = 'checkbox' name = counties[] value=".urlencode($county.$comma.$state.$star).">".$county."<br />";
                                        echo "<input type = 'checkbox' name = counties[] value=".urlencode($county.$comma.$state.$star).">"." ".$county." "."<br />";
                                    }
                                    echo "</td>";

                                }
                                echo "</tr></table>";
                            ?>
                                </div>
                                
                                <br />
                                                               <?php
                                for($i=0;$i<count($states);$i++)
                                {
                                    $state = $states[$i];
                                    echo "<input type='hidden' name=states[] value='$state' />";
                                }
                                    
                                    ?>
                                
                                <input type="hidden" name="pname" value="<?php echo $project_name; ?>">
                                <input type="hidden" name="pdescription" value="<?php echo $project_description; ?>">
                                <input type="hidden" name="general_contractor" value="<?php echo $general_contractor; ?>">
                                <input type="hidden" name="in_charge_of" value="<?php echo $in_charge_of; ?>">
                                <input type="hidden" name="starting_date" value="<?php echo $starting_date; ?>">
                                <input type="hidden" name="completion_date" value="<?php echo $completion_date; ?>">
                                
                                <button type="submit" class="btn btn-primary" >
                                    Continue to Step 4 >>
                                </button>
                                
                        </form>
                       
                        <!--/panel content-->
                    </div>
                    <!--/panel-->                
            </div>
            <!--/row-->
        </div>
        <!--/col-span-9-->
    </div>
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




