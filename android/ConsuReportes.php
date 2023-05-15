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
        case 'RepMD':
            $muni=$_POST['muni'];
            $query="select Municipio,count(Municipio)as TotalM from distribuidores where Edo='$muni' GROUP BY Municipio;";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepVD':
            $query="select D.Nombre,count(*)as TotalVD from distribuidorvehiculos as VD inner join distribuidores as D on D.IdDistribuidor=VD.IdDistribuidor GROUP BY VD.IdDistribuidor";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepGP':
            $query="select count(*) as TotalP from  `productores`";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepEP':
            $query="select Edo,count(Edo)as TotalE from productores GROUP BY Edo";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'RepMP':
            $muni=$_POST['muni'];
            $query="select Municipio,count(Municipio)as TotalM from productores where Edo='$muni' GROUP BY Municipio";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'Rep2P':
            $query="SELECT Nombre,PuntosAcumulados as Puntos,TotalPiezasOrden as Orden,TotalPiezasEntregadas as Entregas,(TotalPiezasOrden-TotalPiezasEntregadas) As SaldoPiezas FROM `productores` GROUP by Nombre";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;  
        case 'Rep1H':
            $query="select p.Nombre,count(*) as TotalH FROM `huertos` as h INNER join productores as p on h.IdProductor=p.IdProductor group by p.IdProductor";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;  
        case 'Rep1EERP':
            $query="SELECT Edo,count(Edo) as TotalE FROM `empresarecolectoraprivada` GROUP by Edo;";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;  
        case 'Rep1MERP':
            $edo=$_POST['edo'];
            $query="select Municipio,count(Municipio)as TotalM from empresarecolectoraprivada where Edo='$edo' GROUP BY Municipio";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break;  
        case 'Rep1VERP':
            $query="SELECT ERP.Nombre,count(*) as TotalVE FROM `erpvehiculos` as VE INNER JOIN empresarecolectoraprivada as ERP on VE.IdERP=ERP.IdERP GROUP by ERP.IdERP";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break; 
        case 'Rep1Co':
            $ori=$_POST['ori'];
            $tc=$_POST['tc'];
            $query="select C.IdContenedor,C.Capacidad,C.CapacidadStatus,(C.Capacidad-C.CapacidadStatus)as EspacioD from contenedores as C inner join tipocontenedor as T on C.IdTipoCont=T.idTipoCont where C.Origen='$ori' and T.Concepto='$tc'";
            $resultado=$conn->prepare($query);
            $resultado->execute();
            $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
            break; 
    }
        echo json_encode($res);
        $conn = null; //Limpia la conexión
}
?>