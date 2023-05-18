<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{ 
    include('database.php');
    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    switch($_POST['opcion']){
        //Reporte Envases mas ordenados1
        case '1':
        $query = "SELECT TipoEnvase, SUM(CantidadPiezas) as Total from detalleorden GROUP BY TipoEnvase order by Total DESC";
        $resultado=$conn->prepare($query);
        $resultado->execute();
        $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
//Reporte de distribuidores más concurridos 2
//Reporte de contenedores más concurridos 3
//Reporte de productores con más ordenes 4
case '4':
    $query = "SELECT P.Nombre, count(*) as Total from productores as P INNER JOIN ordenproductos as OP on P.IdProductor = OP.IdProductor GROUP by P.Nombre Order By DESC";
    $resultado=$conn->prepare($query);
    $resultado->execute();
    $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
//Reporte de municipios con menos entregas 5
case '5':   
    $query = "SELECT U.Nombre, count(*) as total from entregas as E inner JOIN usuarios as U on E.IdUsuario = U.IdUsuario where U.Idtipousuario=4 GROUP by U.Nombre Order BY total ASC";
    $resultado=$conn->prepare($query);
    $resultado->execute();
    $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
//Reporte de distribuidores con menos entregas 6
case '6':   
    $query = "SELECT U.Nombre, count(*) as total from entregas as E inner JOIN usuarios as U on E.IdUsuario = U.IdUsuario where U.Idtipousuario=3 GROUP by U.Nombre Order BY total ASC";
    $resultado=$conn->prepare($query);
    $resultado->execute();
    $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
    break;
//Reporte de contenedores con menos salidas 7


//Productor 
//Reporte de todas las entregas por productor 
//Reporte de todos los extraviados por productor 
//Reporte de distribuidores por productor (si un productor compra en varios distribuidores)


//Distribuidores 
//Reporte de ordenes generadas por productor 
//Reporte de entregas (envases vacíos recibidos ) por distribuidor 
//Reporte de salidas (limpieza de contenedores) por distribuidor 
//Reporte de salidas (limpieza de contenedores) General X fecha


//Municipio 
//Reporte de entregas (envases vacíos recibidos ) por municipio 
//Reporte de entregas (envases vacíos recibidos ) General X fechas 
//Reporte de salidas (limpieza de contenedores) por municipio 
//Reporte de salidas (limpieza de contenedores) General X fecha


//Empresa Privada Recolectora
//Reporte de entregas (envases vacíos recibidos ) por EPR 
//Reporte de entregas (envases vacíos recibidos ) General X fechas 


//Contenedores 
//Reporte de contenedores sin capacidad (ósea llenos)
//Reporte de contenedores sin capacidad (ósea llenos) X municipio
//Reporte de contenedores con fecha de ultima recolección mayor a X tiempo (1 mes o mas de un mes sin limpiar)
//Reporte de contenedores con más movimiento (que se repitan mas en las salidas
}
echo json_encode($res);
        $conn = null; //Limpia la conexión
}