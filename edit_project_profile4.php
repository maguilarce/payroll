<?php

require_once('connection.php');
session_start();
$counties = $_GET['counties'];
$project_name = $_GET['pname'];
$old_project_name = $_GET['old_project_name'];
$project_description = $_GET['pdescription'];
$general_contractor = $_GET['general_contractor'];
$in_charge_of = $_GET['in_charge_of'];
$starting_date = $_GET['starting_date'];
$completion_date = $_GET['completion_date'];

    for($i=0;$i<count($counties);$i++)
    {
        $decode[$i] = urldecode($counties[$i]);
    }


$combined1 = implode("",$decode); //array to string
$combined2 = explode("*", $combined1); //string to array
$combined3 = implode(",",$combined2); //array to string
$combined4 = explode(",", $combined3); //string to array

unset($combined4[(count($combined4))-1]);

$array1 = array();
$array2 = array();
$x=0;
$y=1;

for($i=0;$i<(count($combined4)/2);$i++)
{
    $array1[$i]=$combined4[$x++];//counties
    $array2[$i]=$combined4[$y++];//states
    $x++;
    $y++;
}

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
                /*function verificar(){
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
        <div class="col-sm-9">
            <div class="row">
                <!-- center left-->
                <div class="col-md-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>Edit Project Profile - Step 4/4</h4>
                                <h6>Please input local union # that has jurisdiction in each county:</h6>
                            </div>
                        </div>
                        <form method="post" action="" >
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>State</th>
                                    <th>County</th>
                                    <th>Operator Local Union #</th>
                                    <th>Teamster Local Union #</th>
                                    <th>Laborer Local Union #</th>
                                    
                                </tr>
                            </thead>
                            
                            
                                <tbody>
                                <?php 
                                    for ($i=0;$i<count($array1);$i++)
                                    {
                                        
                                        $county = $array1[$i];
                                        $state = $array2[$i];
                                        
                                        ?>

                                    <tr>
                                    
                                        <td>
                                            <input name='state[]' type='text' value="<?php echo $state; ?>" class='form-control'readonly="readonly">

                                        </td>
                                        <td>
                                             <input name='county[]' type='text' value="<?php echo $county; ?>" class='form-control'readonly="readonly">
                                        </td>
                                        <td>
                                            <input name='group<?php echo $i; ?>[operator]' type='text' class='form-control'>
                                        </td>
                                        <td>
                                            <input name='group<?php echo $i; ?>[teamster]' type='text' class='form-control'>
                                        </td>
                                        <td>
                                            <input name='group<?php echo $i; ?>[laborer]' type='text' class='form-control'>
                                        </td>

                                    </tr>
                                    <?php
                                    }
                                     ?>
                                               
                        </tbody>
                         
                            

                        
                    </table>
                            <button formaction="edit_process_jurisdiction.php" type="submit" class="btn btn-primary">
                                    Edit Project Profile
                                </button>
                                <input type="hidden" name="pname" value="<?php echo $project_name; ?>">
                                <input type="hidden" name="pdescription" value="<?php echo $project_description; ?>">
                                <input type="hidden" name="general_contractor" value="<?php echo $general_contractor; ?>">
                                <input type="hidden" name="in_charge_of" value="<?php echo $in_charge_of; ?>">
                                <input type="hidden" name="starting_date" value="<?php echo $starting_date; ?>">
                                <input type="hidden" name="completion_date" value="<?php echo $completion_date; ?>">
                                <input type="hidden" name="old_project_name" value="<?php echo $old_project_name; ?>">
                            </form>
                        <br />

                        <!--/panel content-->
                    </div>
                    
                    <!--/panel-->                
                <!--/col-span-6-->

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



