<?php
error_reporting (E_ALL ^ ​​E_NOTICE); 
error_reporting(0);
include '../conexion.php';
$nom=$_POST['innom'];
$dom=$_POST['indom'];
$cp=$_POST['incp'];
$muni=$_POST['jmr_contacto_municipio'];
$est=$_POST['jmr_contacto_estado'];
$tel=$_POST['intel'];
$corr=$_POST['incorr'];
$edo=$_POST['inestado'];

if($nom != null && $corr != null){
$r="INSERT INTO responsablecat VALUES(NULL,'".$nom."','".$dom."','".$cp."','".$muni."','".$est."','".$tel."','".$corr."','".$edo."')";
mysqli_query($enlace,$r);
}
else{
    $data= null;
}

print json_encode($data);

mysqli_close($enlace);
 ?>