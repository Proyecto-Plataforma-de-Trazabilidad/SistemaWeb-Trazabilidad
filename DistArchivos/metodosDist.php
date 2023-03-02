<?php 
    include "../conexion.php";
    $tipo_funcion=$_POST["tipo"];

    if($tipo_funcion=="combo1"){
        $r="SELECT * FROM tipocontenedor";
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando))
        {
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        }
        mysqli_close($enlace);
    }

    if($tipo_funcion==null)
    {
        cargarTabla();
    }

    function cargarTabla(){
        include "../conexion.php";
        $r="SELECT IdDistribuidor, Nombre, Domicilio, Telefono, CapacitacionBUMA, SEMARNAT, LicenciaMunicipio FROM distribuidores";
        $comando= mysqli_query($enlace, $r);
        while($row=mysqli_fetch_array($comando)){
            echo "
            <tr>
                <td>".$row[0]."</td>
                <td>".$row[1]."</td>
                <td>".$row[2]."</td>
                <td>".$row[3]."</td>
                <td><a href='DistArchivos/".$row[4]."'>Ver BUMA</a></td>
                <td><a href='DistArchivos/".$row[5]."'>Ver SEMARNAT</a></td>
                <td><a href='DistArchivos/".$row[6]."'>Ver Licencia</a></td>
                <td><a href='DistArchivos/Consulta.php?id=".$row[0]."'><input type='button' value='Consultar' class='btn btn-primary'></td>
            </tr>";
        }
        mysqli_close($enlace);
    }
    if($tipo_funcion=="actualizar"){
        include '../conexion.php';
        $r="UPDATE contenedores SET Capacidad=".$_POST['cap'].", Descripcion='".$_POST['des']."', UltimaFechaRecoleccion='".$_POST['ulti']."', LatitudLongitud='".$_POST['lat']."', InstruccionesManejo='".$_POST['man']."' where idContenedor=".$_POST['idcon'];
        $comando= mysqli_query($enlace, $r);
        mysqli_close($enlace);
    }
?>