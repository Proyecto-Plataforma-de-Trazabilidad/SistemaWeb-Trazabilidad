<?php

    include 'conexion.php';
    $tipoorigen=$_POST['intipoorigen'];
    $tipocont=$_POST['intipocont'];
    $cap=$_POST['incap'];
    $des=$_POST['indes'];
    $lat=$_POST["inlat"];
    $lon=$_POST["inlon"];
    $ulti=$_POST['inulti'];
    $manejo=$_POST['inman'];
    $status=$_POST['instatus'];
    
    $directorio = "PermisosContenedor";
    if (file_exists($directorio)) {
    
    } 
    else {
    mkdir("PermisosContenedor", true);
    }
    $permitidos=array('jpg','png','jpeg','pdf');

    if($_FILES["infile"]){
        $nombre_base=basename(($_FILES["infile"]["name"]));
        $arregloArchivo=explode(".",$nombre_base);
        $extension=strtolower(end($arregloArchivo));
        if(in_array($extension, $permitidos)){
            $r="INSERT INTO contenedores VALUES(NULL,".$tipocont.",'".$tipoorigen."',".$cap.",'".$des."',".$lat.",".$lon.",'".$ulti."','0','".$manejo."',".$status.")";
            $resultado=mysqli_query($enlace,$r);
            $lastid=mysqli_insert_id($enlace);
            $ruta="PermisosContenedor/" .$lastid.".".$extension;
            $subir_archivo=move_uploaded_file($_FILES["infile"]["tmp_name"], $ruta);
            if($subir_archivo){
                $r="UPDATE contenedores SET ReferenciaPermiso='".$ruta."' WHERE IdContenedor=".$lastid;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    echo "<script>alert('Archivo subido'); window.location='../Contenedores.php'</script>";
                }
                else{
                printf("Errormessage: %s\n" , mysqli_error($enlace));
                }
            }
        }
        else{
            echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png'); window.location='../Contenedores.php'</script>";
        }
    }
    else{
        echo "<script>alert('Seleccione un archivo!!!');</script>";
    }

?>