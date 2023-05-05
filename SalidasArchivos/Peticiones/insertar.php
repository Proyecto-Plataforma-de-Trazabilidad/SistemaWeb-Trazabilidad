<?php
include("../../conexion.php"); //$enlace es la conexion a db

//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else { //si todo funciona correctamente

    //traer los datos ajax
    if (isset($_POST['salidas'])) { //validar que se mando bien la opcion

        //Creación de directorios

        $tipo = $_POST['salidas']['accion'];
        if ($tipo == "registrarSalidas") {
            //Extraviados
            $recolector = $_POST['salidas']['idRec'];
            $contenedor = $_POST['salidas']['Contenedor'];
            $responsable = $_POST['salidas']['Responsable'];  
            $peso = $_POST['salidas']['peso'];         
            $fecha = $_POST['salidas']['fecha'];

            //desabilitar el autocommit
            mysqli_autocommit($enlace, false); // Deshabilitar el autocommit
            //iniciar con la transaccion
            $enlace->begin_transaction();
            try {
                //querySalidas
                $registro = "INSERT INTO salidas VALUES (null, $contenedor, $recolector, '$responsable', $peso , '$fecha')";
                //echo($registro);
                mysqli_query($enlace, $registro);
                
                //ejecutar transaccion
                $enlace->commit();

                //mandar response 
                echo ("correcto");

            } catch (Exception $ex) {
                $enlace->rollback();
                // Manejar la excepción
                echo "Error: " . $ex->getMessage();
            }
        }
    }

}
//volver activar el autocommit
mysqli_autocommit($enlace, false);

//cerrar conexion
mysqli_close($enlace);

?>