<?php
    include '../conexion.php';

        $roluser = $_POST['tipUser'];
        $nombre = $_POST['nom'];
        $psw = $_POST['cont'];
        $Email = $_POST['Email'];

        $r = "INSERT INTO usuarios values(null, '".$roluser."','".$nombre."', '".$psw."', '".$Email."' )";
        mysqli_query($enlace, $r);

        echo "<script>window.location='../rusers.php'</script>";

?>