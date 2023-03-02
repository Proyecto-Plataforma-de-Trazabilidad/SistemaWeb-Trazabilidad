<?php

    include '../conexion.php';
    $res=$_POST['inres'];
    $nom=$_POST['innom'];
    $dom=$_POST['indom'];
    $cp=$_POST['incp'];
    $est=$_POST['inest'];
    $tel=$_POST['intel'];
    $corr=$_POST['incorr'];
    $lat=$_POST['inlat'];
    $lon=$_POST['inlon'];
    
    $directorio = "SEMARNATMunicipio";
    if (file_exists($directorio)) {
    
    } 
    else {
    mkdir("SEMARNATMunicipio", true);
    }
    $permitidos=array('jpg','png','jpeg','pdf');
    
    if($_FILES["infile"]){
        $nombre_base=basename(($_FILES["infile"]["name"]));
        $arregloArchivo=explode(".",$nombre_base);
        $extension=strtolower(end($arregloArchivo));
        if(in_array($extension, $permitidos)){
            $r="INSERT INTO municipio VALUES('null','".$nom."','".$dom."','".$tel."','".$cp."','".$est."','".$corr."','".$lat."','".$lon."','".$res."','0')";
            $resultado=mysqli_query($enlace,$r);
            $lastid=mysqli_insert_id($enlace);

            $ruta="SEMARNATMunicipio/".$lastid.".".$extension;
            $subir_archivo=move_uploaded_file($_FILES["infile"]["tmp_name"], $ruta);
            if($subir_archivo){
                $r="UPDATE municipio SET SEMARNAT='".$ruta."' WHERE IdMunicipio=".$lastid;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    echo "<script>alert('Archivo subido'); window.location='../Municipio.php'</script>";
                }
                else{
                    printf("Errormessage: %s\n" , mysqli_error($enlace));
                }
            }
            else{
                echo "<script>alert('Error al subir archivo');</script>";;
            }
        }
        else{
            echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png');</script>";
        }
    }
    else{
        echo "<script>alert('Seleccione un archivo!!!');</script>";
    }

?>