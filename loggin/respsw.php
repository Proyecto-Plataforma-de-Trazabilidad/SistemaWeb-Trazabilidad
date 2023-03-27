<?php

    include_once('../conexion.php');

    $id = $_POST['id'];
    $nuevapsw = $_POST['nuevapsw'];
    $reppsw = $_POST['reppsw'];

    


    if ($nuevapsw == $reppsw) {
        $consulta = "UPDATE usuarios set Contrasena= MD5('$nuevapsw') where IdUsuario = $id";
        $resultado = mysqli_query($enlace, $consulta);
        header('Location: ../index.php?message=success_psw');
        
    } else{
        $data = null;
    }

    print json_encode($data);

?>