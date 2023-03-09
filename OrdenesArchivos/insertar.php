<?php
    include("../conexion.php");//$enlace es la conexion a db

    //verificar conexion 
    if($enlace->connect_error){
        //mandar mensaje y salir 
        die("Conexion fallida: ".$enlace->connect_error);
    }
    else{ //si todo funciona correctamente

        //desabilitar el autocommit
        mysqli_autocommit($enlace, false); // Deshabilitar el autocommit
        //iniciar con la transaccion  
        $enlace->begin_transaction();
        try{
            //queryOrden                               num, idDistri, idProduc, numFact, Factura, NumReceta, Receta, fecha 
            $orden=("INSERT INTO ordenproductos VALUES (null, null, null, 'null', 'null', 'null', 'null', 'Null')");
            mysqli_query($enlace,$orden);

            //ciclo con el tamaño del arreglo de detalle ordenes 
            //for($i=0; $i<$variable.length; i++){}

            //query detalle orden                      idOrden, Consecutivo, IdQuimico, tipoEnvase, Color, Cantidad Piezas
            $detalle=("INSERT INTO detalleorden VALUES (null,null,null,'null','null',null)");
            mysqli_query($enlace,$detalle);
            $detalle=("INSERT INTO detalleorden VALUES (null,null,null,'null','null',null)");
            mysqli_query($enlace,$detalle);
            //query de actualizar numero de envases al productor 
            $productor=("UPDATE productores SET TotalPiezasOrden= TotalPiezasOrden + null WHERE IdProductor= null ");
            mysqli_query($enlace,$productor);

            //ejecutar transaccion 
            $enlace->commit();
        }
        catch(Exception $ex){
            $enlace->rollback();
            // Manejar la excepción
            echo "Error: " . $ex->getMessage();
        }
    }
    //volver activar el autocommit
    mysqli_autocommit($enlace, false);

    //cerrar conexion 
    mysqli_close($enlace);
?>