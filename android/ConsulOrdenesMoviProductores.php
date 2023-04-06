<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    include('database.php');
   $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'OrdenProductor':
            $nombre=$_POST['nombre'];
            
            //se rescatan y se buscan en la BD
            $query="SELECT O.IdOrden,P.Nombre AS Productor,D.Nombre AS Distribuidor, O.NumFactura,O.NumReceta FROM ordenproductos AS O INNER JOIN productores AS P ON O.IdProductor=P.IdProductor INNER JOIN distribuidores AS D ON O.IdDistribuidor=D.IdDistribuidor WHERE P.Nombre='$nombre'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
             
        break;
        case 'DetOrdProductor':
            $id=$_POST['IdOrden'];
            $query="SELECT * FROM `detalleorden` WHERE IdOrden='$id'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;  
    }
    echo json_encode($res);
    $conn = null; //Limpia la conexión
}
?>