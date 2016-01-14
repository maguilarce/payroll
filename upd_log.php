
    <?php
    function generaLogs($usuario,$accion,$origen){
        //Definimos la hora de la accion
        $hora=str_pad(date("H:i:s"),10," "); //hhmmss;
        //Definimos el contenido de cada registro de accion por usuario.
        $usuario=strtoupper(str_pad($usuario,15," "));
        $accion=strtoupper(str_pad($accion,50," "));
        $cadena=$hora.$usuario.$accion.$origen;
        //Creamos dinamicamente el nombre del archivo por dia
        $pre="log";
        $date=date("ymd"); //aammddhhmmss
        $fileName=$pre.$date;
        //echo "$fileName";
        $f = fopen("logs/$fileName.TXT","a");
            fputs($f,$cadena."\r\n") or die("Unable to Create File");
        fclose($f);
       
    }//end generaLogs function
     
    ?>

 

