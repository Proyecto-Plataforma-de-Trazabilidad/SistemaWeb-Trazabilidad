<?php
$host_name="127.0.0.1";
$host_user="u517350403_admindb";
$host_password="Te-k3li-L!";
$database="u517350403_campolimpiojal";

try {
    $conn = new PDO('mysql:host='.$host_name.';dbname='.$database,$host_user,$host_password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión realizada Satisfactoriamente";
    }catch(PDOException $e)
    {
    echo "La conexión ha fallado: " . $e->getMessage();
    }
    
    $conn = null;
?>
