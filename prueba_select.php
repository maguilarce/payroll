<?php
require_once('connection.php');
?>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script type="text/javascript"> 
    function verificar(){
        var suma = 0;
        var los_cboxes = document.getElementsByName('daily_premium_rate[]'); 
        for (var i = 0, j = los_cboxes.length; i < j; i++) {
    
        if(los_cboxes[i].checked === true){
        suma++;
        }
    }
 
    if(suma === 0){
    alert("Must select at least one Premium Rate/Daily Lump Rate. You can choose 'None'");
    return false;
    }
 
    }
    </script> 
</head>

<body>
    <form onsubmit='return verificar();' action='prueba_filtro.php' method="post">
    <?php
   
    $query = "SELECT * from premium_rate;";
    $result1 = mysql_query($query);
    while($row1 = mysql_fetch_array($result1, MYSQL_ASSOC))
    {
        $value = $row1['premium_rate_type'];
	echo "<input type='checkbox' name='daily_premium_rate[]' value='$value'/> {$row1['premium_rate_type']}<br>";

	}
    ?>
        <button type='submit'>Enviar</button>
</form>
</body>