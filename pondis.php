
<?php
require_once('connection.php');
?>

<form action="prueba_select.php" method="post">
<?php
for ($i=0;$i<3;$i++)
{
?>

<input name="group<?php echo $i; ?>[operator]">
<input name="group<?php echo $i; ?>[local]">
<input name="group<?php echo $i; ?>[teamster]">
    
<?php
}
?>
<button type="submit">Enviar</button>
</form>