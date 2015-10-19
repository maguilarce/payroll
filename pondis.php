<?php
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Let LLC Time Sheet App</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		

                 
                 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
                 <script language="JavaScript"> 
                    $(document).ready(function()
                  {             
                   $('.btn-1').click(function(e){
                       
                         document.getElementsByClassName('form1').action = "http://www.google.com";
                         document.getElementsByClassName('form1').submit();
                        });
                    $('.btn-2').click(function(e){
                         document.getElementsByClassName('form1').action = "http://www.yahoo.com";
                         document.getElementsByClassName('form1').submit();
                        });    
                         $('.btn-3').click(function(e){
                         document.getElementsByClassName('form1').action = "http://www.msn.com";
                         document.getElementsByClassName('form1').submit();
                        });
                   });
                </script>

	</head>
	<body>
        
            <?php for ($i = 0;$i<5;$i++)
            {
            
            ?>
            <form method="post">
                <?php $value = "sexo";?>
                <input name="prueba" type="hidden" value="<?php echo $value; ?>">
                <button type="submit" formaction="link.php">Mandar valor a LINK</button>
                <button type="submit" formaction="pagina.php">Mandar valor a PAGINA</button>

                
            </form>
            <?php } ?>
        </body>
</html>