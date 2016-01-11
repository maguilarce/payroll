<?php
require_once('connection.php');
session_start();
//this data has to be passed thru hidden inputs to the next page***********************
$project_id = $_POST['project_id'];
$project_name = $_POST['pname'];
$old_project_name = $_POST['old_project_name'];
$project_description = $_POST['pdescription'];
$general_contractor = $_POST['general_contractor'];
$in_charge_of = $_POST['in_charge_of'];
$starting_date = $_POST['starting_date'];
$completion_date = $_POST['completion_date'];
$user_au=$_POST['user_au'];
//*************************************************************************************

$selected_states = array();
$query = "SELECT * FROM jurisdiction WHERE project_name='$old_project_name'";
$result = mysql_query($query);
$i=0;

while($row = mysql_fetch_array($result,1))
{
    $selected_states[$i]=$row['state'];
    $i++;
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
                function verificar(){
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

                }
                </script> 


	</head>
	<body>

<!-- Main -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-9">
            <div class="row">
                <!-- center left-->
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <h4>Edit Project Profile - Step 2/4</h4>
                                <h6>Select or change the state(s) where the project will be developed:</h6>
                            </div>
                        </div>
         
                        
                        <form method="post" action="edit_project_profile3.php" onsubmit="return verificar(this)">
                                <div class="control-group">
                                                  
                        <?php
                            $states = "Alabama,Alaska,Arizona,Arkansas,California,Colorado,Connecticut,Delaware,Florida,Georgia,Hawaii,Idaho,Illinois,Indiana,Iowa,Kansas,Kentucky,Louisiana,Maine,Maryland,Massachusetts,Michigan,Minnesota,Mississippi,Missouri,Montana,Nebraska,Nevada,New Hampshire,New Jersey,New Mexico,New York,North Carolina,North Dakota,Ohio,Oklahoma,Oregon,Pennsylvania,Rhode Island,South Carolina,South Dakota,Tennessee,Texas,Utah,Vermont,Virginia,Washington,West Virginia,Wisconsin,Wyoming,Washington DC";
                            $state = explode(",",$states);
                            for($i=0;$i<count($state);$i++)
                            {
                                
                                $value = $state[$i];
                                if(in_array($value, $selected_states))
                                {
                                    echo "<input type='checkbox' name='states[]' value='$value'  checked='checked' / >".$value."<br />";
                                }
                                else
                                {
                                    echo "<input type='checkbox' name='states[]' value='$value' / >".$value."<br />";
                                }
                            }
                            ?>
                                </div>
                                
                                <br />
                                <button type="submit" class="btn btn-primary" >
                                    Continue to Step 3 >>
                                </button>
                                <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
                                <input type="hidden" name="pname" value="<?php echo $project_name; ?>">
                                <input type="hidden" name="pdescription" value="<?php echo $project_description; ?>">
                                <input type="hidden" name="general_contractor" value="<?php echo $general_contractor; ?>">
                                <input type="hidden" name="in_charge_of" value="<?php echo $in_charge_of; ?>">
                                <input type="hidden" name="starting_date" value="<?php echo $starting_date; ?>">
                                <input type="hidden" name="completion_date" value="<?php echo $completion_date; ?>">
                                <input type="hidden" name="old_project_name" value="<?php echo $old_project_name; ?>">
                                <input type="hidden" name="user_au" value="<?php echo $user_au; ?>">
                                
                                
                        </form>
                       
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