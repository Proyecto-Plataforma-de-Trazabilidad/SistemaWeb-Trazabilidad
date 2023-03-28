<?php
    include("../conexion.php");

    session_start();

    $comando = mysqli_query($enlace, "SELECT count(*) from ordenproductos");
    $row =  mysqli_fetch_column($comando) + 1;
    mysqli_free_result($comando);

    $comando = mysqli_query($enlace, "SELECT * from tipoquimico");
    while($fila = mysqli_fetch_array($comando)){
        $qumicos[] = array(
            'IdTipo' => $fila[0],
            'Concepto' => $fila[1]
        );
    }
    mysqli_free_result($comando);

    $comando = mysqli_query($enlace, "SELECT * FROM productores");
    while($fila1 = mysqli_fetch_array($comando)){
        $productores[] = array(
            'IdProductor' => $fila1[0],
            'Nombre' => $fila1[1]
        );
    }
    
    $comando = mysqli_query($enlace, "SELECT IdDistribuidor FROM distribuidores WHERE nombre = '".$_SESSION['usuario']."' ");
    $idDistribu =  mysqli_fetch_column($comando);
    mysqli_free_result($comando);

    //Mando datos al front
    $datos = json_encode(array('orden' => $row, 'usuario' => $_SESSION['usuario'], 'quimicos' => $qumicos, 'produtores' => $productores, 'IdDistri' => $idDistribu));
    echo $datos;
    
    mysqli_close($enlace);
?>