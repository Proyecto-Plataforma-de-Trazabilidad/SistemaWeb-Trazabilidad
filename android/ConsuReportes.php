<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{ 
    include('database.php');
    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    
    switch($_POST['opcion']){
        case 'RepGCat':
            $query="select count(*) as Total_CATs from `centroacopiotemporal`";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepECat':
            $query="select Estado,count(Estado)as TotalE from centroacopiotemporal GROUP BY Estado";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepMCat':
            $muni=$_POST['muni'];
            $query="select Municipio,count(Municipio)as TotalM from centroacopiotemporal where Estado='$muni' GROUP BY Municipio;";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepGD':
            $query="select count(*) as TotalD from `distribuidores`";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepED':
            $query="select Edo,count(Edo)as TotalE from distribuidores GROUP BY Edo";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepED':
            $muni=$_POST['muni'];
            $query="select Municipio,count(Municipio)as TotalM from distribuidores where Edo='$muni' GROUP BY Municipio;";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
    }
        echo json_encode($res);
        $conn = null; //Limpia la conexión
}
?>