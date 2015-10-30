<?php

$data = $_GET['data'];

$counties_decode = unserialize(urldecode($data));

 print_r($counties_decode);

/*for($i=0;$i<count($data);$i++)
{
    $counties_decode[$i]=urldecode($data[$i]);
}

 print_r($counties_decode);*/