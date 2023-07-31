<?php
include("../../conexion.php"); //$enlace es la conexion a db


// //verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else { //si todo funciona correctamente

    //traer los datos ajax
    if (isset($_POST['accion'])) { //validar que se mando bien la opcion

        //Creación de directorios
    
        $tipo = $_POST['accion'];
        if ($tipo == "registrarExtraviados") {
            //Extraviados
            $prod = $_POST['idProd'];
            $tipoEnv = $_POST['tipoEnva'];
            $piezas = $_POST['numPiezas'];  
            $aclaracion = $_POST['aclaracion'];         
            $fecha = $_POST['fecha'];

            //desabilitar el autocommit
            mysqli_autocommit($enlace, false); // Deshabilitar el autocommit
            //iniciar con la transaccion
            $enlace->begin_transaction();
            try {
                //queryOrden idExtraviados, idProductor, TipoEnvaceVacio, CantidadPiezas, Aclaracion, fecha
                $registro = "INSERT INTO extraviados VALUES (null, $prod, '$tipoEnv', $piezas, '$aclaracion','$fecha')";
                //echo($registro);
                mysqli_query($enlace, $registro);
                
                //ejecutar transaccion
                $enlace->commit();

                //mandar response 
                $mensaje = array('mensaje' => 'Correcto');
                echo json_encode($mensaje);

            } catch (Exception $ex) {
                $enlace->rollback();
                // Manejar la excepción
                $mensaje = array('Error' => $ex->getMessage()); 
                echo json_encode($mensaje);
            }
        }
    }

}
//volver activar el autocommit
mysqli_autocommit($enlace, false);

//cerrar conexion
mysqli_close($enlace);

?>