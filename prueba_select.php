<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            $('.weekly_payment').click(function(event)
            {
                //Obtiene valor de el select que activa el usuario
                //alert($(this).val());
                $(this).next().val($(this).val());
            });
        });
    </script>
</head>

<body>
<form>
    <select class="weekly_payment">
        <option>Selecciona</option>
        <option>Valor 1</option>
        <option>Valor 2</option>
        <option>Valor 3</option>
        <option>Valor 4</option>
    </select>

    <input type="text" id="holl" size="11" readonly="">
</form>
</body>