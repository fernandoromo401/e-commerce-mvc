<?php
class Conectar{
    public static function conexion(){
        $conexion=new mysqli("localhost", "root", "", "optica_vision");
        $conexion->query("SET NAMES 'utf8'");
        
        if ($conexion->connect_error != NULL) {
            ?>
            <script>
                alert('NO SE PUEDEN OBTENER LOS PRODUCTOS DE LA BASE DE DATOS');
                var opcion = confirm("¿Quiéres contactar con el desarrollador?");
                
                if (opcion == true) {
                document.write('<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://www.malarapublicidad.com.ar/contact.html">')
	            } else {
                    document.write('<META HTTP-EQUIV="REFRESH" CONTENT="0;URL=http://opticavision.com.ar/">')
	            }
	            document.getElementById("ejemplo").innerHTML = mensaje;
                //redirigir a web original 
            </script>
             
            <?php
        }
        
        return $conexion;
    }
}
?>