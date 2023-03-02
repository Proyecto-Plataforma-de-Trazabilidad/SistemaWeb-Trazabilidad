<?php

    include 'conexion.php';
    $tipo=$_POST['tipo'];

    if($tipo==null)
    {   
        cargarTabla();
    }
    
    if($tipo=="registrar")
    {
        $nom=$_POST['nom'];
        $dom=$_POST['dom'];
        $cp=$_POST['cp'];
        $muni=$_POST['muni'];
        $est=$_POST['est'];
        $tel=$_POST['tel'];
        $corr=$_POST['corr'];
        $edo=$_POST['edo'];
        $r="INSERT INTO responsablecat VALUES(NULL,'".$nom."','".$dom."','".$cp."','".$muni."','".$est."','".$tel."','".$corr."','".$edo."')";
        mysqli_query($enlace,$r);
        cargarTabla();
    }
    
    function cargarTabla()
    {
        include 'conexion.php';
        $r="SELECT idCAT, Nombre, Domicilio, Telefono, Estado FROM responsablecat";
        
        $comando=mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando)){
            echo "
            <tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                <td>".$row[2]."</td>
                <td>".$row[3]."</td>
                <td>".$row[4]."</td>
                <td><a href='ResponsablesArchivos/Consulta.php?id=".$row[0]."'><input type='button' value='Consultar' class='btn btn-primary'></td>
            </tr>
            ";
        }
        mysqli_close($enlace);
    }
    if($tipo=="actualizar"){
        include 'conexion.php';
        $r="UPDATE responsablecat SET Nombre='".$_POST['nom']."', Domicilio='".$_POST['dom']."', CP='".$_POST['cp']."', Municipio='".$_POST['muni']."',
        Edo='".$_POST['est']."', Telefono='".$_POST['tel']."', Correo='".$_POST['corr']."', Estado='".$_POST['edo']."' where IdCAT=".$_POST['id'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
    }

    if($tipo=='borrar')
    {
        include 'conexion.php';
        $r="Delete from responsablecat where IdCAT=".$_POST['id'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
        echo "<script>alert('Registro eliminado'); window.location='../ResponsableCAT.php'</script>";
    }

?>