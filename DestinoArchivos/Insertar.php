<?php
    include '../conexion.php';

    $raz=$_POST['inraz'];
    $dom=$_POST['indom'];
    $cp=$_POST['incp'];
    $muni=$_POST['inmuni'];
    $edo=$_POST['inedo'];
    $tel=$_POST['intel'];
    $corr=$_POST['incorr'];
    $lat=$_POST["inlat"];
    $lon=$_POST["inlon"];
    
    $directorio = "SEMARNATEmpresaDest";

    if (!file_exists($directorio)) {
        mkdir("SEMARNATEmpresaDest", true);
    }

    $permitidos=array('jpg','png','jpeg','pdf');

    if($_FILES["infile"]){
        $nombre_base=basename(($_FILES["infile"]["name"]));
        $arregloArchivo=explode(".",$nombre_base);
        $extension=strtolower(end($arregloArchivo));
        if(in_array($extension, $permitidos)){
            $r="INSERT INTO empresadestino VALUES(NULL,'".$raz."','0','".$dom."','".$cp."','".$muni."','".$edo."','".$tel."','".$corr."',".$lat.",".$lon.")";
            $resultado=mysqli_query($enlace,$r);
            $lastid=mysqli_insert_id($enlace);

            $ruta="SEMARNATEmpresaDest/" .$lastid.".".$extension;
            $subir_archivo=move_uploaded_file($_FILES["infile"]["tmp_name"], $ruta);
            if($subir_archivo){
                $r="UPDATE empresadestino SET SEMARNAT='".$ruta."' WHERE IdDestino=".$lastid;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    echo "<script>alert('Archivo subido'); window.location='../EmpresaDestino.php'</script>";
                }
                else{
                    printf("Errormessage: %s\n" , mysqli_error($enlace));
                }
            }
            else{
                echo "<script>alert('Error al subir el archivo'); window.location='../EmpresaDestino.php'</script>";
            }
        }
        else{
            echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png'); window.location='../EmpresaDestino.php'</script>";
        }
    }
    else{
        echo "<script>alert('Seleccione un archivo'); window.location='../EmpresaDestino.php'</script>";
    }
?>