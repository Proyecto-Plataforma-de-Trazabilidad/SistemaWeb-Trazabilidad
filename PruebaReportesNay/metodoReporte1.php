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
       
        $r="SELECT SUM(CantidadPiezas) As TotalPiezas FROM detalleorden as D INNER JOIN ordenproductos AS O on O.IdOrden=D.IdOrden where O.IdProductor='$prod'";
        $comando=mysqli_query($enlace,$r);

        echo json_encode($comando);
        
    }
    
       
    
?>