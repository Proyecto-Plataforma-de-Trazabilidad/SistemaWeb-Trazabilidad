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
        $mail->Host = 'smtp.hostinger.com';  
        $mail->SMTPAuth = true; 
        $mail->Username = 'soporte@campolimpiojal.com';
        $mail->Password = 'Y0ohg-sOth0Th_';
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587;                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('soporte@campolimpiojal.com', 'Soporte');
        $mail->addAddress($email);   //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Recuperar Password';
        $mail->Body    = '<center style="width: 100%; background-color: #f1f1f1;">
        <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
        </div>
        <div style="max-width: 600px; margin: 0 auto;" class="email-container">
            <!-- BEGIN BODY -->
          <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
              <tr>
              <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                      <tr>
                          <td class="logo" style="text-align: center; background-color: #285430">
                            <h1><a href="https://campolimpiojal.com/index.php" style="color: #fff; text-decoration: none;">Campo Limpio</a></h1>
                          </td>
                      </tr>
                  </table>
              </td>
              </tr>
              
                    <tr>
              <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
                <table>
                    <tr>
                        <td>
                            <div class="text" style="padding: 0 2.5em; text-align: center; font-size: 15px">
                                <h2>Recuperación de contraseña</h2>
                                <h3 style="font-size: 15px">Haga clic en el botón de abajo para reestablecer su contraseña.</h3>
                                <p><a href="http://campolimpiojal.com/loggin/changepsw.php?id=' . $row['IdUsuario'] . '" Style="position: relative;
        display: inline-block;
        border: 2px solid var(--paleta1);
        padding: 3px 12px;
        color: white;
        font-weight: 700;
        text-transform: uppercase;
        text-decoration: none;
        transition: color 0.2s, background 0.2s;
        margin-right: 40px;background: #285430;
        border-color: #285430;
                                  border-radius: 20%">¡Vamos allá!</a></p>
                              <p>
                                Si no solicitó ningún cambió, favor de hacer caso omiso.
                              </p>
                            </div>
                        </td>
                    </tr>
                </table>
              </td>
              </tr>
          
          </table>
      </div>
    </center>
    ';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        header("Location: ../index.php?message=ok");
    } catch (Exception $e) {
        header("Location: ../index.php?message=error");
    }
} else {
    header("Location: ../index.php?message=notfound");
}
