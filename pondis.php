
<?php
require_once('connection.php');

$states = array("Texas","Arizona");

 echo "<form action='prueba_select.php' method='post'>";
                                for($i=0;$i<count($states);$i++)
                                {
                                    $state = $states[$i];
                                    echo "<h3>".$state.":</h3><br />";
                                    $query = "SELECT idcounties,county FROM counties WHERE state = '$state';";
                                    $result = mysql_query($query);
                                   
                                    while($row = mysql_fetch_array($result,MYSQL_ASSOC))
                                    {
                                        $county = $row['county'];
                                        $comma = ",";
                                        $star = "*";
                                       
                                        echo "<input type = 'checkbox' name = counties[] value=".urlencode($county.$comma.$state.$star).">".$county."<br />";

                                       
                                    }
                                    

                                }
  echo "<input type='submit' value='enviar'>";
                                echo "</form><br />";
?>


    
