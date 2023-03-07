<?php
    include 'conexion.php';
    $tipo=$_POST['tipo'];


    if($tipo==null)
    {   
        cargarTabla();
    }
    
    if($tipo=='combo1'){
        
        $r="SELECT * FROM responsablecat";
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando))
        {
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        }
        mysqli_close($enlace);
    }


    
    if($tipo=="registrar")
    {
        $res=$_POST['res'];
        $nom=$_POST['nom'];
        $nra=$_POST['nra'];
        $des=$_POST['des'];
        $dom=$_POST['dom'];
        $cp=$_POST['cp'];
        $muni=$_POST['muni'];
        $est=$_POST['est'];
        $tel=$_POST['tel'];
        $corr=$_POST['corr'];
        $hor=$_POST['hor'];
        $lat=$_POST['lat'];
        $lon=$_POST['lon'];
        $plan=$_POST['plan'];
        echo("Paso por aqui php");
        $r="INSERT INTO centroacopiotemporal VALUES('null',".$res.",'".$nom."',".$nra.",'".$des."','".$dom."','".$cp."','".$muni."','".$est."',
        '".$tel."','".$corr."','".$hor."','".$lat."','".$lon."','".$plan."')";
        mysqli_query($enlace,$r);
        
        cargarTabla();
    }

    
    
    function cargarTabla()
    {
        include '../conexion.php';
        $r="SELECT IdCat, NombreCentro, NumRegAmbiental, Domicilio, Municipio, Telefono, HorarioDiasLaborales FROM centroacopiotemporal";
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando)){
            echo "
            <tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                <td>".$row[2]."</td>
                <td>".$row[3]."</td>
                <td>".$row[4]."</td>
                <td>".$row[5]."</td>
                <td>".$row[6]."</td>
                <td><a href='Cat-Archivos/Consulta.php?id=".$row[0]."'><input type='button' value='Consultar' class='btn btn-primary'></td>
            </tr>";
        }
        mysqli_close($enlace);
    }
    if($tipo=="actualizar"){
        include 'conexion.php';
        
        $r="UPDATE centroacopiotemporal SET NombreCentro='".$_POST['nom']."', NumRegAmbiental='".$_POST['nra']."', InformacionAdicional='".$_POST['info']."', Domicilio='"
        .$_POST['dom']."', CP='".$_POST['cp']."', Municipio='".$_POST['muni']."', Estado='"
        .$_POST['est']."', Telefono='".$_POST['tel']."', Correo='".$_POST['corr']."', HorarioDiasLaborales='"
        .$_POST['hor']."', Latitud='".$_POST['lat']."', Longitud='".$_POST['lon']."', PlanManejo='".$_POST['plan']."' where IdCAT=".$_POST['idcat'];
        $comando= mysqli_query($enlace, $r);        
        printf("Errormessage: %s\n" , mysqli_error($enlace));
        mysqli_close($enlace);
    }

    if($tipo=='borrar')
    {
        include 'conexion.php';
        $r="Delete from Cat where idCAT=".$_POST['idcat'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
    }
    

?>