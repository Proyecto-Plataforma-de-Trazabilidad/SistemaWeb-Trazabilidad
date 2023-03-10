<?php
include("../conexion.php"); //$enlace es la conexion a db

//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else { //si todo funciona correctamente

    //traer los datos ajax
    if (isset($_POST['accion'])) { //validar que se mando bien la orden

        if (isset($_POST['detalle'])) { //validar que se mando bien el detalle

            $tipo = $_POST['accion'];//si la orden tare la accion RegistrarOrden Inicia xd

            if ($tipo == "registrarOrden") {
                //orden
                $dis = $_POST['idDis'];
                $prod = $_POST['idProd'];
                $numFac = $_POST['NumFac'];
                $factura = $_POST['factura'];
                $numRec = $_POST['numRec'];
                $receta = $_POST['receta'];
                $fecha = $_POST['fecha'];

                //echo ($dis . $prod . $numFac . $factura . $numRec . $receta . $fecha); IMORIMIR ORDEN

                //detalle
                $detalle=json_decode(file_get_contents($_POST['detalle']),true);
                //$tamano = count($arreglo);
                // print_r($arreglo);  //imprimir detalle


                //desabilitar el autocommit
                mysqli_autocommit($enlace, false); // Deshabilitar el autocommit
                //iniciar con la transaccion
                $enlace->begin_transaction();
                try {
                    //queryOrden                               num, idDistri, idProduc, numFact, Factura, NumReceta, Receta, fecha
                    $orden = "INSERT INTO ordenproductos VALUES (null, $dis, $prod, '$numFac', '$factura', '$numRec', '$receta', '$fecha')";
                    echo($orden);
                    //mysqli_query($enlace, $orden);

                    //ciclo con el tamaño del arreglo de detalle ordenes
                    foreach($detalle as $t){
                        //query detalle orden                      idOrden, Consecutivo, IdQuimico, tipoEnvase, Color, Cantidad Piezas
                        $detalle = "INSERT INTO detalleorden VALUES (" . $t['idOrden'] . "," . $t['consecutivo'] . "," . $t['idquimico'] . ",'" . $t['tipoEnvase'] . "','" . $t['color'] . "'," . $t['piezas'] . ")";
                        echo($detalle);
                        //mysqli_query($enlace, $detalle);                        
                        //query de actualizar numero de envases al productor
                        $productor = "UPDATE productores SET TotalPiezasOrden = TotalPiezasOrden + " . $t['piezas'] . " WHERE IdProductor = " . $prod;
                        echo($productor);
                        //mysqli_query($enlace, $productor);
                    }
                    //ejecutar transaccion
                    $enlace->commit();
                } catch (Exception $ex) {
                    $enlace->rollback();
                    // Manejar la excepción
                    echo "Error: " . $ex->getMessage();
                }
            }
        }

    }


}
//volver activar el autocommit
mysqli_autocommit($enlace, false);

//cerrar conexion
mysqli_close($enlace);



                    //ciclo con el tamaño del arreglo de detalle ordenes
                    // for($i=0; $i<$tamano; $i++){
                    //     //titulo
                    //     $titulo = each($arreglo);
                    //     //query detalle orden                      idOrden, Consecutivo, IdQuimico, tipoEnvase, Color, Cantidad Piezas
                    //     $detalle = ("INSERT INTO detalleorden VALUES ($titulo['idOrden'],null,null,'null','null',null)");
                    //     mysqli_query($enlace, $detalle);
                    //     $detalle = ("INSERT INTO detalleorden VALUES (null,null,null,'null','null',null)");
                    //     mysqli_query($enlace, $detalle);
                    //     //query de actualizar numero de envases al productor
                    //     $productor = ("UPDATE productores SET TotalPiezasOrden= TotalPiezasOrden + null WHERE IdProductor= null ");
                    //     mysqli_query($enlace, $productor);
                    // }
?>