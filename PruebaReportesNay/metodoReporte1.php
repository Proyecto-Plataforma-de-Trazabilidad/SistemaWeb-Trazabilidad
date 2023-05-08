<?php

    include '../conexion.php';
    $tipo=$_POST['tipo'];

    if($tipo=="combo1"){
        $r="SELECT IdProductor, Nombre FROM productores";
        $comando=mysqli_query($enlace,$r);
        while($row=mysqli_fetch_array($comando)){
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        }
    }
    
    if($tipo=="registrar")
    {
        $prod=$_POST['prod'];
       
        $r="SELECT SUM(CantidadPiezas) As TotalPiezas FROM detalleorden as DOr INNER JOIN ordenproductos AS Ord on Ord.IdOrden=DOr.IdOrden inner JOIN productores as P on Ord.IdProductor=P.IdProductor where P.Nombre='$prod'";
        $comando=mysqli_query($enlace,$r);

        echo json_encode($comando);
        
    }
    
   
       
    
?>