<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMmailer\PHPMailer\SMTP;
    require '../PHPMailer/Exception.php';
    require '../PHPMailer/PHPMailer.php';
    require '../PHPMailer/SMTP.php';
        
    include('../conexion.php');
    $email = $_POST['email'];
    
    $consulta = "SELECT * FROM usuarios where Correo = '$email'";
    $resultado = mysqli_query($enlace, $consulta);

    $row = mysqli_fetch_assoc($resultado);

    if($filas=mysqli_num_rows($resultado) > 1){
        //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'sistematrazabilidad003@outlook.com';                     //SMTP username
        $mail->Password   = 'apeajal123';                               //SMTP password
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('sistematrazabilidad003@outlook.com', 'Alejandro');
        $mail->addAddress('jesus.a.j.g@hotmail.com', 'Usuario de Prueba');     //Add a recipient
        $mail->isHTML(true);                                  
        $mail->Subject = 'Prueba';
        $mail->Body    = 'Este es un correo generado automáticamente para reestablecer la constraseña de su cuenta.<br>
                            Por favor, visite la página <a href="localhost/SistemaWeb-Trazabilidad/loggin/changepsw.php?id='.$row[0].'">Sistema de trazabilidad</a>';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

            

    }else{

    }
