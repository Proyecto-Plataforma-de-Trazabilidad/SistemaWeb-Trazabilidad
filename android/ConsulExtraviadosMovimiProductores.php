<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{ 
    include('database.php');
    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'EProductor':
            //$nombre=$_POST['nombre']; 
            $query="SELECT E.TipoEnvaseVacio,E.CantidadPiezas,E.Aclaracion,E.fecha FROM extraviados as E INNER JOIN productores  as P on E.IdProductor=P.IdProductor where P.Nombre='Naylea'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        }
        echo json_encode($res);
        $conn = null; //Limpia la conexión
}
?>