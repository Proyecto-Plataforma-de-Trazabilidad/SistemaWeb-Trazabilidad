<?php
    include '../conexion.php';
    $tipo=$_POST['tipo'];

    if($tipo==null)
    {   
        cargarTabla();
    }
    
    function cargarTabla()
    {
        include '../conexion.php';
        $r="SELECT * FROM distribuidorvehiculos";
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando)){
            echo "
            <tr>
                <td>".$row[0]."</td>
                <td>".$row[2]."</td>
                <td>".$row[3]."</td>
                <td>".$row[4]."</td>
                <td>".$row[5]."</td>
                <td>".$row[6]."</td>
                <td><a href='DistVehicArchivos/".$row[7]."'>Ver SCT</a></td>
                <td><a href='DistVehicArchivos/consulta.php?id=".$row[0]."'><input type='button' value='Consultar' class='btn btn-primary'></td>
            </tr>
            ";
        }
        mysqli_close($enlace);
    }
    if($tipo=="actualizar"){
        include '../conexion.php';
        $r="UPDATE centroacopiotemporal SET NombreCentro='".$_POST['innom']."', NumRegAmbiental='".$_POST['nra2']."', InformacionAdicional='".$_POST['des']."', Domicilio='"
        .$_POST['dom']."', CodigoPostal='".$_POST['cp']."', Municipio='".$_POST['muni']."', Estado='"
        .$_POST['est']."', Telefono=".$_POST['tel'].", Correo='".$_POST['corr']."', HorarioDiasLaborales='"
        .$_POST['hor']."', Latitud='".$_POST['lat']."', Longitud='".$_POST['lon']."', PlanManejo='".$_POST['plan']."' where IdCAT=".$_POST['idcat'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
    }

?>