<?php 
     @session_start();
     session_destroy();
     //header("Location: index.php");      
     
?>
<html>
<script language="javascript" type="text/javascript">
top.document.location.href="index.php";
</script> 
    
    
</html>