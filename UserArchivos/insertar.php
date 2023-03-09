<?php
    include '../conexion.php';

        $roluser = $_POST['tipUser'];
        $nombre = $_POST['nom'];
        $psw = $_POST['cont'];
        $mail = $_POST['email'];

        $r = "INSERT INTO usuarios values('', '".$roluser."','".$nombre."', '".$psw."', '".$mail."' )";
        mysqli_query($enlace, $r);

?>