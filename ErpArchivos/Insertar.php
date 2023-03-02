<?php
    include '../conexion.php';
    $nom=$_POST['innom'];
    $dom=$_POST['indom'];
    $tel=$_POST['intel'];
    $cp=$_POST['incp'];
    $lat=$_POST["inlat"];
    $lon=$_POST["inlon"];
    $muni=$_POST['inmuni'];
    $edo=$_POST['inest'];
    $corr=$_POST['incorr'];
    $giro=$_POST['ingiro'];
    $res=$_POST['inres'];
    
    $directorio = "SEMARNATERP";
    $directorio2 = "PermisosERP";
    if (file_exists($directorio)) {

    } 
    else {
    mkdir("SEMARNATERP", true);
    }
    if (file_exists($directorio2)) {

    } 
    else {
    mkdir("PermisosERP", true);
    }
    $permitidos=array('jpg','png','jpeg','pdf');

    if($_FILES["infile1"]["tmp_name"] && $_FILES["infile2"]["tmp_name"]){

        $nombre_base=basename(($_FILES["infile1"]["name"]));
        $arregloArchivo=explode(".",$nombre_base);
        $extension=strtolower(end($arregloArchivo));

        $nombre_base2=basename(($_FILES["infile2"]["name"]));
        $arregloArchivo2=explode(".",$nombre_base2);
        $extension2=strtolower(end($arregloArchivo2));
        if(in_array($extension, $permitidos)){
            $r="INSERT INTO empresarecolectoraprivada VALUES(NULL,'0','".$nom."','".$dom."','".$tel."','".$cp."','".$muni."','".$edo."','".$corr."','".$lat."','".$lon."','".$giro."','0','".$res."')";
            $resultado=mysqli_query($enlace,$r);
            $lastid=mysqli_insert_id($enlace);
            $ruta1="SEMARNATERP/" .$lastid.".".$extension2;
            $ruta2="PermisosERP/" .$lastid.".".$extension;
            $subir_archivo=move_uploaded_file($_FILES["infile1"]["tmp_name"], $ruta2);
            $subir_archivo2=move_uploaded_file($_FILES["infile2"]["tmp_name"], $ruta1);
            if($subir_archivo && $subir_archivo2){
                $r="UPDATE empresarecolectoraprivada SET Permiso='".$ruta2."', SEMARNAT='".$ruta1."' WHERE IdERP=".$lastid;
                $resultado=mysqli_query($enlace,$r);
                if($resultado){
                    echo "<script>alert('Archivo subido'); window.location='../EmpresaRecPrivada.php'</script>";
                }
                else{
                    printf("Errormessage: %s\n" , mysqli_error($enlace));
                }
            }
            else{
                echo("Error al subir el archivo");
            }
        }
        else{
            echo "<script>alert('Solo se permiten archivos con extensión .pdf .jpg .jpeg .png'); window.location='../EmpresaRecPrivada.php'</script>";
        }   
    }
    else{
        echo "<script>alert('Seleccione los archivos'); window.location='../EmpresaRecPrivada.php'</script>";
    }

?>