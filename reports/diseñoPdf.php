<?php
include("../conexion.php"); //$enlace es la conexion a db
session_start();

ob_start(); //iniciar el buffer para poder guardar la informacion html en una variable 
$currentsite = getcwd();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />   
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script>
    <title>Reporte-PDF</title>

    <style>
        body {
            background: #ffffff;
            width: 195mm;
            height: 279.4mm;
            /* border: solid; */
        }

        .container-encabezado-imagen {
            text-align: center;
            width: 80%;
            height: 10%;
            margin-left: 16%;
            margin-right: auto;
            margin-top: 40px;
        }

        .logo {
            display: inline-block;
            width: 80px;
            height: 80px;
            margin-right: 90px;
        }

        .container-encabezado-recolector {
            text-align: center;
            width: 350px;
            height: 100px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 40px;

        }
        .recolector-nombre {
            text-align: center;
            font-size: .85rem;
            font-weight: bold;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

    </style>
</head>

<body>
    <!-- encabezado -->
    <section class="container-encabezado">
        <div class="container-encabezado-imagen">
            <img src="https://campolimpiojal.com/Logos/AMOCALI.jpg" alt="Logo" class="logo" />
            <img src="https://campolimpiojal.com/Logos/APEAJAL2.jpg" alt="Logo" class="logo" />
            <img src="https://campolimpiojal.com/Logos/ASICA.jpg" alt="Logo" class="logo" />
        </div>

        <div class="container-encabezado-recolector">
            <p class="recolector-nombre">
                Reporte de contenedores menos concurridos
            </p>
        </div>
    </section>

    canva


</body>
</html>

<?php

$html = ob_get_clean();
//echo$html;


require_once '../Librerias/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$dompdf = new Dompdf(); //crear objeto 

// //opciones para mostrar imagenes 
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnable' => true));
$dompdf->setOptions($options);

//el contenido del pdf 
$dompdf->loadHtml($html);

// //crear el archivo 
$dompdf->setPaper('letter');

// //para cambiar propiedades de la hoja de pdf
// //$dompdf->setPaper('A4','landscape');

//render 
$dompdf->render();

// //poder trabajar el archivo           para poder descargarlo o solo abrirlo
echo base64_encode($dompdf->stream("archivo_.pdf", array("Attachment" => false)));

?>