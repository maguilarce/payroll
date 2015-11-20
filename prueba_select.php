<?php
$date = new DateTime();
                            
$today = new DateTime(date('m/d/Y'));
                                            $week = $today->format("W");
                                            echo $week;
                                            
                                            echo date("W");