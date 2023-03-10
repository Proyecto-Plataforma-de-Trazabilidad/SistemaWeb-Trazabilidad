<?php 
   
   $detalle = $_POST['detalle'];
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

?>