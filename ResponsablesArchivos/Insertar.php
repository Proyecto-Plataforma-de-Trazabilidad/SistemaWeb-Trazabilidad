<?php
$nom=$_POST['nom'];
$dom=$_POST['dom'];
$cp=$_POST['cp'];
$muni=$_POST['jmr_contacto_municipio'];
$est=$_POST['jmr_contacto_estado'];
$tel=$_POST['tel'];
$corr=$_POST['corr'];
$edo=$_POST['edo'];
if($nom != null && $corr != null){
$r="INSERT INTO responsablecat VALUES(NULL,'".$nom."','".$dom."','".$cp."','".$muni."','".$est."','".$tel."','".$corr."','".$edo."')";
mysqli_query($enlace,$r);
cargarTabla();
}
else{
    $data= null;
}

print json_encode($data);

mysqli_close($enlace);
 ?>