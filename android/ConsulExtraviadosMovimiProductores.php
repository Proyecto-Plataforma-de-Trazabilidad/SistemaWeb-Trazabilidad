<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{ 
    include('database.php');
    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'EProductor':
            $nombre=$_POST['nombre']; 

            $query="SELECT E.TipoEnvaseVacio,E.CantidadPiezas,E.Aclaracion,E.fecha FROM extraviados as E INNER JOIN productores  as P on E.IdProductor=P.IdProductor where P.Nombre='$nombre'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'Pproductor':
            $nombre=$_POST['nombre']; 
            $fi=$_POST['fi'];//fecha inicial
            $ff=$_POST['ff'];//fecha final


            $query="SELECT E.TipoEnvaseVacio,E.CantidadPiezas,E.Aclaracion,E.fecha FROM extraviados as E INNER JOIN productores  as P on E.IdProductor=P.IdProductor where P.Nombre='$nombre' and  E.fecha BETWEEN '$fi' and '$ff'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case'TEProductor':
            $nombre=$_POST['nombre']; 
            $e=$_POST['envase'];

            $query="SELECT E.TipoEnvaseVacio,E.CantidadPiezas,E.Aclaracion,E.fecha FROM extraviados as E INNER JOIN productores  as P on E.IdProductor=P.IdProductor where P.Nombre='$nombre' and E.TipoEnvaseVacio='$e'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
                break;
        }
        echo json_encode($res);
        $conn = null; //Limpia la conexión
}
?>