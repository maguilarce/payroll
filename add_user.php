<?php
require_once('connection.php');
session_start();
   
    $name = $_POST['fname'];
    $lname = $_POST['lname'];
    $login = $_POST['login'];
    $password = 123456;
    $email = $_POST['email'];
    $type = $_POST['usertype'];
    
    //echo $login;
    $query_p="SELECT * FROM user where login='$login'" ;
    $res=mysql_query($query_p,$dbh);
    $row=  mysql_fetch_array($res);
    //echo $query_p;
    if(!$row)
    {
        $query = "INSERT INTO user (f_name,l_name,email,login,password,type)
              VALUES ('$name','$lname','$email','$login','$password','$type')";
        $retval = mysql_query( $query, $dbh);
        if(!$retval )
            { die('Could not get data: ' . mysql_error());}
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
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <i class="glyphicon glyphicon-wrench pull-right"></i>
                                <?php if(!$row){ ?>
                                <h4>User added satisfactorily</h4> <?php } ?>
                                <?php if($row){ ?>
                                <h4>User already exist, try a diferent login</h4> <?php } ?>
                            </div>
                            <form name="add_user" action="add_user_form.php" target="mainFrame">
                               <div class="controls">
                                        <button type="submit" class="btn btn-primary">
                                            Back
                                        </button>
                               </div>
                            </form>
                           
                        </div>
                        
                        <!--/panel content-->
                    </div>
                    <!--/panel-->                
                         
                <!--/col-span-6-->

            </div>
            <!--/row-->

            <hr>

           
        </div>
        <!--/col-span-9-->
        </div></div>
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
	</body>
</html>