<?php
session_start();
if($_SESSION['logged'])
{    

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

$type = $_GET['ty'];      

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
<frameset  rows="8%,88%,4%,*" frameborder="yes" border="1" framespacing="0">
  <?php if($type == 1){?>
   <frame src="top_cel.php?ty=1" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame"/>
  <?php } if($type >= 2){?>
   <frame src="top_cel.php?ty=2" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame"/>
  <?php }?> 
<frameset  cols="200,*" framebborder="yes" border="1" framespacing="0">
  <?php if($type == 1){?>
  <frame src="menu_izq_1.php" name="leftFrame" scrolling="Yes" noresize="noresize" id="leftFrame"  title="leftFrame"/>
  <frame src="dashboard2.php" name="mainFrame" id="mainFrame" title="mainFrame" />
  <?php }?>
  <?php if($type == 2){?>
  <frame src="menu_izq_2.php" name="leftFrame" scrolling="Yes" noresize="noresize" id="leftFrame"  title="leftFrame"/>
  <frame src="dashboard3.php" name="mainFrame" id="mainFrame" title="mainFrame" />
  <?php }?>
  <?php if($type == 3){?>
  <frame src="menu_izq_3.php" name="leftFrame" scrolling="Yes" noresize="noresize" id="leftFrame"  title="leftFrame"/>
  <frame src="dashboard3.php" name="mainFrame" id="mainFrame" title="mainFrame" />
  <?php }?>
  <?php if($type == 4){?>
  <frame src="menu_izq_4.php" name="leftFrame" scrolling="Yes" noresize="noresize" id="leftFrame"  title="leftFrame"/>
  <frame src="dashboard3.php" name="mainFrame" id="mainFrame" title="mainFrame" />
  <?php }?>
</frameset>  
  <frame src="down.php" name="lowFrame" scrolling="No" noresize="noresize" id="lowFrame" />
</frameset>
<body>

	
<?php } 
else{ 
header("Location: index.php");  } ?> 
</body>
</html>