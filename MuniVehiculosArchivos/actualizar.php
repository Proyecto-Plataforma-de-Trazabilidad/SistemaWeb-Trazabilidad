<?php

    include '../conexion.php';
    $id=$_POST['inid'];
    $con=$_POST['incon'];
    $des=$_POST['indes'];
    $tipo=$_POST['intipo'];
    $cap=$_POST['incap'];
    $marca=$_POST['inmarca'];
    $placa=$_POST['inplaca'];
    
    $permitidos=array('jpg','png','jpeg','pdf');
    
    if($_FILES["infile"]["tmp_name"]){
        $nombre_base=basename(($_FILES["infile"]["name"]));
        $arregloArchivo=explode(".",$nombre_base);
        $extension=strtolower(end($arregloArchivo));
        if(in_array($extension, $permitidos)){
            $r="SELECT SCT FROM municipiovehiculos WHERE IdMunicipio=$id";
            $resultado=mysqli_query($enlace,$r);
            $row=mysqli_fetch_array($resultado);
            $sct=$row[0];
            $ruta="SCTMunicipio/" .$con."".$id.".".$extension;
            if(file_exists($sct)){
                unlink($sct);
            }
            $subir_archivo=move_uploaded_file($_FILES["infile"]["tmp_name"], $ruta);
            if($subir_archivo){
                $r="UPDATE municipiovehiculos SET Consecutivo=".$con.", Descripcion='".$des."', TipoVehiculo='".$tipo."', Capacidad=".$cap.", Marca='".$marca."', Placa='".$placa."', SCT='".$ruta."' WHERE Consecutivo=".$con;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    echo "<script>alert('Archivo subido'); window.location='../MuniVehiculos.php'</script>";
                }
                else{
                    printf("Errormessage: %s\n" , mysqli_error($enlace));
                }
            }
            else{
                echo "<script>alert('Error al subir archivo'); window.location='../MuniVehiculos.php'</script>";
            }
        }
        else{
            echo "<script>alert('Solo se permiten archivos de formato: pdf, jpg, jpeg, png')</script>";
        }
    }
    else{
        $r="UPDATE municipiovehiculos SET Consecutivo=".$con.", Descripcion='".$des."', TipoVehiculo='".$tipo."', Capacidad=".$cap.", Marca='".$marca."', Placa='".$placa."' WHERE Consecutivo=".$con;
        $resultado=mysqli_query($enlace,$r);
        if($resultado){
            echo "<script>window.location='../MuniVehiculos.php'</script>";
        }
        else{
            printf("Errormessage: %s\n" , mysqli_error($enlace));
        }
    }

?>