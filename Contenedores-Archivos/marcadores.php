<?php
    //Archivo de conexiona  la BD
    include('conexion.php');

    // Listamos las direcciones con todos sus datos (lat, lng, dirección, etc.)
    $result = mysqli_query($enlace, "SELECT * FROM contenedores");

    while ($row = mysqli_fetch_array($result)) {
        echo '["' . $row['Latitud'] . ', ' . $row['Longitud'] . '],';
    }

    /*
        include "conexion.php";
        $r="SELECT Latitud, Longitud FROM contenedores";
        $comando= mysqli_query($enlace, $r);
        while ($row = mysqli_fetch_array($comando)) {
            echo '[' . $row[0] . ', ' . $row[1] . '],';
        }
        mysqli_close($enlace);
    */
?>