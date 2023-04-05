<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    include('database.php');
   $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'OrdenProductor':
            $nombre=$_POST['nombre'];
            
            //se rescatan y se buscan en la BD
            $query="select O.IdOrden,P.Nombre,D.Nombre, O.NumFactura,O.NumReceta from ordenproductos as O inner join distribuidores as D on  O.IdDistribuidor=D.IdDistribuidor INNER join productores as P on O.IdProductor=P.IdProductor where P.Nombre='$nombre'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
          
            $res = $resultado->fetchAll(PDO::FETCH_BOTH);
             
        break;
        //case '':
        //break;  
    }
    echo json_encode($res);
    $conn = null; //Limpia la conexión
}
?>