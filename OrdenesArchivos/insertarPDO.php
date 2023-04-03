<?php
    include("../conexion.php");

    $db = new PDO("mysql:host={$host};dbname={$baseDeDatos};port={$puerto}", $usuario, $contrasena);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //desabilitar el autocommit
    $db->setAttribute(PDO::ATTR_AUTOCOMMIT, false);

    //conexion en PDO 
    try {
        //traer las 2 peticiones de ajax (orden en un arreglo y detalles en otro)
        
        
        $db->beginTransaction(); //iniciar la transaccion 
        //hacer la transacción (registrar orden, detalle orden , acumular piezas orden a productor)
        try{            
            //queryOrden                               num, idDistri, idProduc, numFact, Factura, NumReceta, Receta  
            $orden=("INSERT INTO ordenproductos VALUES (null, null, null, 'null', 'null', 'null', 'null')");
            $db->query($orden);
            //ciclo con el tamaño del arreglo de detalle ordenes 
            //for($i=0; $i<$variable.length; i++){}
            //query detalle orden                      consecutivo, idOrden, IdQuimico, tipoEnvase, Color, Cantidad Piezas
            $detalle=("INSERT INTO detalleorden VALUES (null,null,null,'null','null',null)");
            $db->query($detalle);
            //query de actualizar numero de envases al productor 
            $productor=("UPDATE productores SET TotalPiezasOrden= TotalPiezasOrden + null WHERE IdProductor= null ");
            $db->query($productor);

            //ejecutar transaccion 
            $db->commit();

            //mensaje en consola para verificar que si se realizo correctamente
            echo("Transaccion correcta xd");
        }
        catch(PDOException $ex){
            echo $ex-> getMessage();
            $db->rollback();
        }
    } catch (PDOException $exception){
        die("Connection error: " . $exception->getMessage());
    }

    //cerrar conexion
    $db= null;
?>

