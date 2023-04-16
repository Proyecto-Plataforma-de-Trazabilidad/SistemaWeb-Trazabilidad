<?php
    include '../conexion.php';
    error_reporting(0);
    $raz=$_POST['inraz'];
    $dom=$_POST['indom'];
    $cp=$_POST['incp'];
    $muni=$_POST['jmr_contacto_municipio'];
    $edo=$_POST['jmr_contacto_estado'];
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
                    $data="archivos subidos";//all se ha ejecutado correctamente
                }
                else{
                    $data = "server fail";//error del servidor
                }
            }
            else{
                $data = "server fail"; //Error al subir el archivo
            }
        }
        else{
            $data = "extension"; //Solo se permiten archivos con extensión específicadas
        }
    }
    else{
        $data = null; //Si el archivo no es válido
    }

    print json_encode($data);
    mysqli_close($enlace);
?>