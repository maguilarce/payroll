<?php
require_once('connection.php');

$counties = $_POST['counties'];

   $counties_decode = array();
    
    for($i=0;$i<count($counties);$i++)
    {
        $counties_decode[$i]=urldecode($counties[$i]);
    }
    
  
    $serial=urlencode(serialize($counties_decode));
       //$url=http_build_query($counties);              
        header("Location: test_datepicker.php?data=$serial");
