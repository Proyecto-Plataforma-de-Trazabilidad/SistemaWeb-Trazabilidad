<?php 
    session_start();

    if(isset($_POST['opcion'])){

        switch ($_POST['opcion']) {

            case 'activarNotifiaciones':
                $_SESSION["notifiStatus"] = "true";
                $datos = json_encode(array('mensaje' => 'activadas'));
                echo $datos; 
                break;
            case 'desactivarNotifiaciones':
                $_SESSION["notifiStatus"] = "false";
                $datos = json_encode(array('mensaje' => 'desactivadas'));
                echo $datos;
                break;
            default:
                # code...
                break;
        }

    }else{
        $datos = json_encode(array('idUsuario' => $_SESSION["idUsuario"], 'usuario' => $_SESSION["usuario"], 'notifiStatus'=> $_SESSION["notifiStatus"]));
        echo $datos;  
    }
?>