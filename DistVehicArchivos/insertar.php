<?php

    include '../conexion.php';
    $con=$_POST['incon'];
    $des=$_POST['indes'];
    $tipo=$_POST['intipo'];
    $cap=$_POST['incap'];
    $marca=$_POST['inmarca'];
    $placa=$_POST['inplaca'];
    
    $directorio = "SCTDistribuidor";
    if (file_exists($directorio)) {
    
    } 
    else {
    mkdir("SCTDistribuidor", true);
    }
    $permitidos=array('jpg','png','jpeg','pdf');
    
    if($_FILES["infile"]["tmp_name"]){
        $nombre_base=basename(($_FILES["infile"]["name"]));
        $arregloArchivo=explode(".",$nombre_base);
        $extension=strtolower(end($arregloArchivo));
        if(in_array($extension, $permitidos)){
            $r="INSERT INTO distribuidorvehiculos VALUES(NULL,".$con.",'".$des."','".$tipo."',".$cap.",'".$marca."','".$placa."')";
            $resultado=mysqli_query($enlace,$r);
            $lastid=mysqli_insert_id($enlace);
            $nombre_base=basename(($_FILES["infile"]["name"]));
            $ruta="SCTDistribuidor/" .$con."".$lastid.".".$extension;
            $subir_archivo=move_uploaded_file($_FILES["infile"]["tmp_name"], $ruta);
            if($subir_archivo){
                $r="UPDATE distribuidorvehiculos SET SCT='".$ruta."' WHERE IdDistribuidor=".$lastid;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    echo "<script>alert('Archivo subido'); window.location='../DistVehiculos.php'</script>";
                }
                else{
                    printf("Errormessage: %s\n" , mysqli_error($enlace));
                }
            }
            else{
                echo "<script>alert('Error al subir archivo'); window.location='../DistVehiculos.php'</script>";
            }
        }
        else{
            echo "<script>alert('Solo se permiten archivos de formato: pdf, jpg, jpeg, png')</script>";
        }
    }
    else{
        echo "<script>alert('Seleccione un archivo valido');</script>";
    }

?>