<?php

    include '../conexion.php';
    $tipo=$_POST['tipo'];

    if($tipo==null)
    {   
        cargarTabla();
    }
    
    if($tipo=="registrar")
    {
        $nom=$_POST['nom'];
        $reg=$_POST["reg"];
        $dom=$_POST['dom'];
        $cp=$_POST['cp'];
        $ciu=$_POST["ciu"];
        $muni=$_POST['muni'];
        $est=$_POST['est'];
        $tel=$_POST['tel'];
        $corr=$_POST['corr'];
        $puntos=$_POST["puntos"];
        $orden=$_POST["orden"];
        $entrega=$_POST["entrega"];
        $giro=$_POST["giro"];
        
        $r="INSERT INTO productores VALUES(NULL,'".$nom."','".$reg."','".$dom."','".$cp."','".$ciu."','".$muni."','".$est."','".$tel."','".$corr."',".$puntos.",".$orden.",".$entrega.",'".$giro."')";
        mysqli_query($enlace,$r);
        cargarTabla();
    }
    
    function cargarTabla()
    {
        include '../conexion.php';
        $r="SELECT * FROM productores";
        
        $comando=mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando)){
            echo "
            <tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                <td>".$row[3]."</td>
                <td>".$row[5]."</td>
                <td>".$row[8]."</td>
                <td>".$row[9]."</td>
                <td>".$row[10]."</td>
                <td><a href='ProductoresArchivos/Consulta.php?id=".$row[0]."'><input type='button' value='Consultar' class='btn btn-primary'></td>
            </tr>
            ";
        }
        mysqli_close($enlace);
    }
    if($tipo=="actualizar"){
        include '../conexion.php';
        $id=$_POST['id'];
        $nom=$_POST['nom'];
        $reg=$_POST["reg"];
        $dom=$_POST['dom'];
        $cp=$_POST['cp'];
        $ciu=$_POST["ciu"];
        $muni=$_POST['muni'];
        $est=$_POST['est'];
        $tel=$_POST['tel'];
        $corr=$_POST['corr'];
        $puntos=$_POST["puntos"];
        $orden=$_POST["orden"];
        $entrega=$_POST["entrega"];
        $giro=$_POST["giro"];
        $r="UPDATE productores SET Nombre='".$nom."',RegistroProductor='".$reg."', Domicilio='".$dom."', CP='".$cp."', 
        Ciudad='".$ciu."', Municipio='".$muni."', Edo='".$est."', Telefono='".$tel."', Correo='".$_POST['corr']."', 
        PuntosAcumulados=".$puntos.", TotalPiezasOrden=".$orden.", TotalPiezasEntregadas=".$entrega.",
        ActividadGiro='".$giro."' WHERE IdProductor=".$id;
        $comando= mysqli_query($enlace, $r);
        if($comando){
            
        }
        else{
            echo("Errormessage: ".mysqli_error($enlace));
        }
        mysqli_close($enlace);

    }

    if($tipo=='borrar')
    {
        include '../conexion.php';
        $r="Delete from responsablecat where IdCAT=".$_POST['id'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
        echo "<script>alert('Registro eliminado'); window.location='../ResponsableCAT.php'</script>";
    }

?>