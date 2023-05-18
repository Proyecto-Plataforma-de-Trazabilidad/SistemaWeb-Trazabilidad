<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{ 
    include('database.php');
    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    switch($_POST['opcion']){
        //Reporte Envases mas ordenados
        case '1':
$query = "SELECT TipoEnvase, SUM(CantidadPiezas) as Total from detalleorden GROUP BY TipoEnvase order by Total DESC";
$resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
//Reportes importantes 
//Reporte de tendencias: un reporte donde muestre información del uso o porcentajes de los envases ordenados, usados, entregados y extraviados X fecha
//Reporte de envases más ordenados
//Reporte de distribuidores más concurridos 
//Reporte de contenedores más concurridos 
//Reporte de productores con más ordenes 
//Reporte de municipios con menos entregas
//Reporte de distribuidores con menos entregas
//Reporte de contenedores con menos salidas 


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
}