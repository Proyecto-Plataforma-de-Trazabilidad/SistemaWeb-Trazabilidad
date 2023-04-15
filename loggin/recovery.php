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



if ($row > 0) {

    try {
        $mail = new PHPMailer(true);
        //Server settings
        $mail->CharSet = "UTF-8";
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.ionos.mx';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'support@sacnej.com';                     //SMTP username
        $mail->Password   = 'Y0ohg-sOth0Th_';                       //SMTP password
        $mail->SMTPSecure = 'tls';                                  //Enable implicit TLS encryption
        $mail->Port       = 587;                                   //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('support@sacnej.com', 'Soporte');
        $mail->addAddress($email);   //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperar Password';
        $mail->Body    = '<center>
                            <div class="wave" style="height: 150px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M-0.84,151.48 C149.99,150.00 271.49,-49.98 501.97,82.41 L500.00,0.00 L0.00,0.00 Z" style="stroke: none; fill: #285430;"></path></svg></div>
                            <h1>Campo Limpio</h1>
                            <br>
                            <p style="font-size:20px;
                                    justify-content: center;
                                    padding: 20px;">Este es un correo generado automáticamente para reestablecer la constraseña de su cuenta.</p>
                            <br>
                            <a href="http://campolimpiojal.com/loggin/changepsw.php?id=' . $row['IdUsuario'] . '">
                            <button style="background: #285430;
                                    color: #fff;
                                    max-width: 200px;
                                    cursor: pointer;
                                    margin-bottom: 20px;
                                    font-weight: 600px;
                                    font-weight: bold;
                                    padding: 20px;
                                    border-radius: 20%;
                                    font-size: 20px">Recuperar</button>
                            </a>
                        
                            <div class="wave2" style="height: 150px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #285430;"></path></svg></div>
                        </center>';
        $mail->AltBody = 'Abrir el correo desde una PC';

        $mail->send();

        header("Location: ../index.php?message=ok");
    } catch (Exception $e) {
        header("Location: ../index.php?message=error");
    }
} else {
    header("Location: ../index.php?message=notfound");
}
