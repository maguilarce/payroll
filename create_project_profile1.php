<?php
require_once('connection.php');
session_start();

$query = "SELECT * from user";
$result = mysql_query($query);


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
                <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    


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
                                <h4>Create Project Profile - Step 1/4</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="create_project_profile2.php" class="form form-vertical">
                                <div class="control-group">
                                    <label>Project Name:</label>
                                    <div class="controls">
                                        <input id="pname" name="pname" type="text" class="form-control" placeholder="Enter Project Name">
                                    </div>
                                </div><br />
                                <div class="control-group">
                                    <label>Project Description:</label>
                                    <div class="controls">
                                        <input id="pdescription" name="pdescription" type="text" class="form-control" placeholder="Describe the project briefly">
                                    </div>
                                </div><br />
                                
                               
                                 <div class="control-group">
                                    <label>General Contractor: </label>
                                    <div class="controls">
                                        <input id="general_contractor" name="general_contractor" type="text" class="form-control" placeholder="Enter General Contractor of this project">
                                    </div>
                                </div><br />
                                 <div class="control-group">
                                    <label>Person in charge of this project: </label>
                                    <div class="controls">
                                        <input id="in_charge_of" name="in_charge_of" type="text" class="form-control" placeholder="Enter Person in charge of this project">
                                    </div><br />
                                </div> 
                                <div class="control-group">
                                    <label>Authorized User Associated to this Project: </label>
                                    <div class="controls">
                                        <select name="user_au" class="form-control">
                                            <option value=""
                                            <?php
                                            while($row1 =  mysql_fetch_array($result,MYSQL_ASSOC))                                            
                                            { 
                                                echo "<option value=".$row1['iduser'].">{$row1['l_name']},{$row1['f_name']}</option>";}
                                           ?>
                                                    
                                        </select>
                                        
                                    </div><br>
                                </div> 
                                
                                <div class="control-group">
                                    <label>Project Starting Date: </label>
                                     <div class="controls">
                                         <input name="starting_date" class="datepicker form-control" readonly='true' type="text" placeholder="Click to add starting date">
                                            <span class="add-on"><i class="icon-th"></i></span>
                                        
                                     </div>
                                    
                                </div><br />
                                <div class="control-group">
                                    <label>Project Completion Date: </label>
                                     <div class="controls">
                                         <input name="completion_date" class="datepicker form-control" readonly='true' type="text" placeholder="Click to add completion date">
                                            <span class="add-on"><i class="icon-th"></i></span>
                                        
                                     </div>
                                    
                                </div><br />
                              
                                
                                
                                <button type="submit" class="btn btn-primary">
                                    Continue to Step 2 >>
                                </button>
                        </form>
                        </div>
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

                
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script>
  $(function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd'
        
    });
  });
  </script>
	</body>
</html>