
<?php
require_once('connection.php');

 $query = "SELECT * FROM jurisdiction";
 $result = mysql_query($query);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
           
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
                <script type="text/javascript">
                function val() {
                    d = document.getElementById("edad").value;
                    alert(d);
                }
                    
                </script>
                <?php
                    $variablephp = "<script> document.write(d) </script>";
                    echo "d = $variablephp";
                ?>
        </head>
        <body>
            <select onchange="val(this)" class="ejemplo3" name="edad" id="edad">
    <option value="1-10">1-10</option>
    <option value="10-20">10-20</option>
    <option value="20-30">20-30</option>
    <option value="30-40">30-40</option>
    <option value="40-50">40-50</option>
    <option value="50+">50+</option>
</select>
 

        </body>
</html>