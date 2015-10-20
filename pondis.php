<!DOCTYPE html>
<html lang="en">
    <body>
<?php
require_once('connection.php');
 $query = "SELECT * FROM daily_premium_rate WHERE date = '2015-10-19' AND employee = 'Meltrozo, Rosa' AND job_function = 'DRIVER' ";
                                        $result1 = mysql_query($query);
                                        while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                $selected[]=$row1['premium_rate'];
                                            }
                                            echo "selected:";
                                            print_r($selected);
                                            echo '<br />';
                                            
                                            $query = "SELECT * from premium_rate;";
                                            $result1 = mysql_query($query);
                                            while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
                                            {
                                                
                                                $values[]=$row1['premium_rate_type'];
                                               
                                            }
                                            echo "values:";
                                            print_r($values);
                                            
                                            echo '<br />';
                                            ?> <form method="post"> <?php
                                            for($i=0;$i<count($values);$i++)
                                            {
                                                $value = $values[$i];
                                                if(in_array($values[$i],$selected))
                                                {
                                                    
                                                    echo "<input type='checkbox' name='daily_premium_rate[]' value='$value' checked='checked' / > $value<br>";
                                                }
                                                else
                                                    echo "<input type='checkbox' name='daily_premium_rate[]' value='$value' / > $value<br>";
                                            }
                                            echo '<br />';
                                            echo '<br />';
                                            
                                            
                                            
?>


    
                                               <button type="submit" formaction="pagina.php">Ir</button>
</form>
    </body>
</html>