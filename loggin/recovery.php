<?php

include('../conexion.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

$email = $_POST['email'];


$consulta = "SELECT * FROM usuarios where Correo = '$email'";
$resultado = mysqli_query($enlace, $consulta);

$row = mysqli_fetch_assoc($resultado);


$asunto = "Recuperar Contraseña";
$mensaje = 'Este es un correo generado automáticamente para reestablecer la constraseña de su cuenta.<br>Por favor, visite la página <a href="localhost/SistemaWeb-Trazabilidad/loggin/changepsw.php?id=' . $row['IdUsuario'] . '">Sistema de trazabilidad</a>';
$headers = "From: jesus.a.j.g@hotmail.com\r\n";

if ($row > 0) {

    try {
        //Server settings                     //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'sistematrazabilidad3@outlook.com';                     //SMTP username
        $mail->Password   = 'Sistematrazabilidad_3';                               //SMTP password
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('sistematrazabilidad3@outlook.com', 'Sistema Trazabilidad');
        $mail->addAddress('alejustogar3@gmail.com');     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperar Contraseña';
        $mail->Body    = 'Este es un correo generado automáticamente para reestablecer la constraseña de su cuenta.<br>Por favor, visite la página <a href="localhost/SistemaWeb-Trazabilidad/loggin/changepsw.php?id=' . $row['IdUsuario'] . '">Sistema de trazabilidad</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        header("Location: ../index.php?message=ok");
    } catch (Exception $e) {
        header("Location: ../index.php?message=error");
    }
} else {
    header("Location: ../index.php?message=notfound");
}
