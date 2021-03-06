<?php
require_once('connection.php');
session_start();
$iduser=$_SESSION['user_id'];
$counties="";
 if(isset($_POST["project"]))
  {
   $project=$_POST["project"]; 
   $query2 = "SELECT * FROM jurisdiction WHERE project_name='$project'";
   $result2 = mysql_query($query2);
   while($row2 = mysql_fetch_array($result2, MYSQL_ASSOC))
   { $counties .= $row2['county'].' - '.$row2['state']."\n"."Operators Local Union # ".$row2['operator_local']."\n"."Teamster Local Union # ".$row2['teamster_local']."\n"."Laborer Local Union # ".$row2['laborer_local']."\n\n";
    }
    echo ltrim($counties);
    exit;
  }

$query1="SELECT * from user WHERE login='$iduser'";
$res1=  mysql_query($query1);
$row1= mysql_fetch_array($res1);
$uid= $row1['iduser'];
$u_type = $row1['type'];

if($u_type=='manager'){    
$query3 = "SELECT * FROM project WHERE user_id='$uid' and level=3";
$query4 = "SELECT * FROM project WHERE level=4";
$result3 = mysql_query($query3);
$result4 = mysql_query($query4);
}

if($u_type=='superintendent'){    
$query3 = "SELECT * FROM project WHERE user_id='$uid' and level=2";
$query4 = "SELECT * FROM project WHERE level=3 OR level=4";
$result3 = mysql_query($query3);
$result4 = mysql_query($query4);
}

if($u_type=='admin'){    
$query3 = "SELECT * FROM project WHERE user_id='$uid' and level=1";
$query4 = "SELECT * FROM project WHERE level=2 OR level=3 OR level=4";
$result3 = mysql_query($query3);
$result4 = mysql_query($query4);
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
                <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
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
                <script language="JavaScript">
                    $(document).ready(function()
                    {
                       $("#project").change(function()
                        {
                            changeFunction();
                        });
                    });

                function changeFunction()
                {
                $.ajax({
                   'type':'POST',
                   'data':$('form').serialize(),
                   'success':function(data)
                   { 
                       $("#project_description").prop("value",data); 
                   }
                   });
                }
                </script>
                <script type="text/javascript">
                   
                $(document).ready(function () {
                $('.submit').click(function (event) {
                var count = $('select option:selected').val();
                if (count == 0) {
                    alert('Must select at least one project');
                    event.preventDefault();
                    
                }
                else {

                    
                }
             });
        });
</script>
<script>
  $(function() {
    $( ".datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd'
        
    });
  });
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
                    <div class="panel-title">
                        <i class="glyphicon glyphicon-wrench pull-right"></i>
                       <h4>View Daily Time Sheet</h4><br>                        
                    </div>
                    <div class="panel-body">
                    <form id="form" name="form" method="post" action="view_daily_data_table.php" class="form form-vertical validate">                       
                                <div class="control-group">
                                    <label>Select Associated Project To Daily Time Sheet</label>
                                    <div class="controls">
                                        <select id="project" name="project" class="form-control">
                                            <option selected value="0">Select a project...</option>
                                            <?php
                                             while($row3 = mysql_fetch_array($result3, MYSQL_ASSOC))
                                             {$value = $row3['project_name']; 
                                             echo "<option value = '$value'>{$row3['project_name']}</option>";}
                                             while($row4 = mysql_fetch_array($result4, MYSQL_ASSOC))
                                             {$value = $row4['project_name']; 
                                             echo "<option value = '$value'>{$row4['project_name']}</option>";}                                            
                                            ?>

                                        </select><br/>
                                         <label>Select a date</label>
                                         <div class="controls">
                                         <input name="date" class="datepicker form-control" readonly='true' type="text" placeholder="Click to add a date">
                                            <span class="add-on"><i class="icon-th"></i></span>
                                        
                                     </div><br/>
                                        
                                    </div>
                                </div><br />
                                <div class="control-group">
                                    <label>Project Location(s)</label><br/>               
                                    <textarea rows = '10' disabled name="project_description" id="project_description" class="form-control" name="notes"><?php echo ltrim($counties); ?></textarea>
                                </div><br />
                                <div class="controls">
                                    <button id='create' type="submit" class="submit btn btn-primary">
                                    View Time Sheet
                                </button>
                            </form>
                        </div>
                        <!--/panel content-->
                    </div>
                    </div>             
                </div>
                <!--/col-span-6-->
            </div>
            <!--/row-->
            <hr> 
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>  
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- end filter and pagination -->
</body>
</html>