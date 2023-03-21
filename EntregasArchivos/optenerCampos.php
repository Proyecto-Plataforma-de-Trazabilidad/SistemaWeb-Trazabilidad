<?php
include("../conexion.php");
//verificar conexion
if ($enlace->connect_error) {
    //mandar mensaje y salir
    die("Conexion fallida: " . $enlace->connect_error);
} else { //si todo funciona correctamente

    session_start();

    $comando = mysqli_query($enlace, "SELECT count(*) from entregas");
    $entrega =  mysqli_fetch_column($comando) + 1;
    
    mysqli_free_result($comando);

    $comando = mysqli_query($enlace, "SELECT T.Descripcion FROM usuarios as U inner join tipousuario as T on U.IdtipoUsuario = T.Idtipousuario where U.Nombre = '".$_SESSION['usuario']."'");
    $tipo =  mysqli_fetch_column($comando);
    mysqli_free_result($comando);

    $comando = mysqli_query($enlace, "SELECT * FROM productores");
    while($fila1 = mysqli_fetch_array($comando)){
        $productores[] = array(
            'IdProductor' => $fila1[0],
            'Nombre' => $fila1[1]
        );
    }

    $datos = json_encode(array('entrega' => $entrega, 'tipo'=> $tipo, 'produtores' => $productores));
    echo $datos;
    
    mysqli_close($enlace);
}

?>