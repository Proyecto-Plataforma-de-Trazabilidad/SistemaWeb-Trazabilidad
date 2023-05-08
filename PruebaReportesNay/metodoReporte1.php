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
       
       // $r="";
       // mysqli_query($enlace,$r);
       // cargarTabla();
    }
    
    
?>