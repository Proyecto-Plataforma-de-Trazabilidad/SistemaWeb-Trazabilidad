<?php

include('../conexion.php');

$email = $_POST['email'];


$consulta = "SELECT * FROM usuarios where Correo = '$email'";
$resultado = mysqli_query($enlace, $consulta);

$row = mysqli_fetch_assoc($resultado);


$asunto = "Recuperar Contraseña";
$mensaje = 'Este es un correo generado automáticamente para reestablecer la constraseña de su cuenta.<br>Por favor, visite la página <a href="localhost/SistemaWeb-Trazabilidad/loggin/changepsw.php?id=' . $row['IdUsuario'] . '">Sistema de trazabilidad</a>';
$headers = "From: jesus.a.j.g@hotmail.com\r\n";

if ($row) {

    try {
        if (mail($email, $asunto, $mensaje, $headers)) {
            header("Location: ../index.php?message=ok");
        }
    } catch (Exception $e) {
        header("Location: ../index.php?message=error");
    }
} else {
    header("Location: ../index.php?message=notfound");
}

?>