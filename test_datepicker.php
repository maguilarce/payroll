<!DOCTYPE html>
<html lang="en">
	<head>
		
   <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
 
        </head>
	<body>
            <p>Date: <input type="text" id="datepicker" readonly='true'></p>
        </body>
</html>
 <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script>
  $(function() {
    $( "#datepicker" ).datepicker({
        dateFormat: 'yy-mm-dd'
        
    });
  });
  </script>