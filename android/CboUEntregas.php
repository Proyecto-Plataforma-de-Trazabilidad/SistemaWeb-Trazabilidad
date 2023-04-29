<?php
if($_SERVER['REQUEST_METHOD']=='POST'){ 
    
    include('database.php');

    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    $rol=$_POST['rol'];

    $query="SELECT  Nombre FROM usuarios WHERE 	Idtipousuario='$rol' ";
    $resultado=$conn->prepare($query);
    $resultado->execute();
    $res = $resultado->fetchAll(PDO::FETCH_ASSOC);
        
    echo json_encode($res);
    $conn = null; //Limpia la conexión
}
?>

