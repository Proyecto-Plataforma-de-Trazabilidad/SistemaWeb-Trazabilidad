<?php

ob_start(); //iniciar el buffer para poder guardar la informacion html en una variable 

$currentsite = getcwd();
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- <link rel="stylesheet" href="../css/movimientos/Entregas/entregasPdf.css" /> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css" />
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script>
    <title>APEJAL-PDF</title>

    <style>
        body {
            background: #ffffff;
            width: 195mm;
            height: 279.4mm;
            border: solid;
        }

        .container-encabezado-imagen {
            text-align: center;
            width: 270px;
            height: 160px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;
        }

        .container-identificacion{
            margin-top: 0%;
        }

        .logo {
            display: inline-block;
            width: 140px;
            height: 140px;
            margin-right: 45px;
        }

        .container-encabezado-recolector {
            text-align: center;
            width: 270px;
            height: 160px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10px;

        }

        .recolector-nombre {
            text-align: center;
            font-size: .85rem;
            font-weight: bold;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .recolector-domicilio {
            text-align: center;
            font-size: .60rem;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .container-identificacion {
            clear: both;
            margin-top: 10px;
        }

        .container-identificacion-fecha {
            float: left;
            margin-left: 15px;
        }

        .container-identificacion-numero {
            float: right;
            margin-right: 15px;
        }

        .identificacion-texto {
            text-align: center;
            font-size: .90rem;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .numRecibo {
            font-weight: bold;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            color: #a91818;
        }

        /* datos productor */
        .container-productor {
            border: solid;
            border-color: darkgreen;
            border-width: 3px;
            margin-bottom: 10px;
            margin-left: 15px;
            margin-right: 25px;
            padding-bottom: 5px;
            border-end-end-radius: 10px;
            border-start-end-radius: 10px;
            padding-left: 10px;
        }

        .container-productor p {
            font-size: .90rem;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .titulo {
            font-size: 1rem;
            font-weight: bold;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .container-productor-nombre,
        .container-productor-lugar {
            margin-right: 10px;
        }

        /* tabla */
        .container-entrega {
            border: solid;
            border-color: darkgreen;
            border-width: 3px;
            margin-bottom: 10px;
            margin-left: 15px;
            margin-right: 25px;
            padding-bottom: 5px;
            border-end-end-radius: 10px;
            border-start-end-radius: 10px;
            padding-left: 10px;
        }

        .entrega-tabla {
            width: 650px;
            margin-left: auto;
            margin-right: auto;
            padding-bottom: 10px;
        }

        .tabla {
            width: 650px;
            text-align: center;
            border: solid 1px #000000;
            border-collapse: collapse;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }

        .tabla thead {
            background-color: darkgreen;
            text-align: center;
            color: #ffffff;
            font-size: .85rem
        }
    </style>
</head>

<body>
    <!-- encabezado -->
    <section class="container-encabezado">
        <!-- <div class="container-encabezado-imagen">
            <img src="{$currentsite}/sistemaWeb-Trazabilidad/Logos/AMOCALI.jpg" alt="Logo" class="logo" />
        </div> -->

        <div class="container-encabezado-recolector">
            <p class="recolector-nombre">
                CENTRO DE ACOPIO TEMPORAL ENVASES VACÍOS DE AGROQUÍMICOS Y
                AFINES
                CIUDAD GUZMAN, JALISCO
            </p>
            <p class="recolector-domicilio">
                Dirección: Carretera tonila, km 64.3 comunidad la valencia
                de san
                francisco
            </p>
        </div>

        <div class="container-encabezado-espacio"></div>
    </section>

    <!-- fecha y numero de recibo -->
    <section class="container-identificacion">
        <div class="container-identificacion-fecha">
            <p class="identificacion-texto">Fecha: 25/03/23</p>
        </div>
        <div class="container-identificacion-numero">
            <p class="identificacion-texto">
                Recibo de Entrega-Recepción: <em class="numRecibo">032723ABC</em>
            </p>
        </div>
    </section>

    <!-- datos del productor que entrega -->
    <section class="container-productor">
        <div class="container-productor-titulo">
            <h1 class="titulo">Datos del productor</h1>
        </div>

        <div class="container-productor-nombre">
            <p><strong>nombre:</strong> Julio Cesar Arriaga Mendoza</p>
            <p><strong>Tel:</strong> 3411486241</p>
        </div>

        <div class="container-productor-domicilio">
            <p>
                <strong>Domicilio:</strong> av. Cuauhtemoc #86 interior
                #32B,
                col.Centro
            </p>
        </div>

        <div class="container-productor-lugar">
            <p><strong>Municipio:</strong> Tamazula de Gordiano</p>
            <p><strong>Estado:</strong> Jalisco</p>
        </div>
    </section>

    <!-- datos de entrega -->
    <section class="container-entrega">
        <div class="entrega-titulo">
            <h1 class="titulo">Datos de entrega</h1>
        </div>
        <div class="entrega-tabla">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Tipo Envase</th>
                        <th>Piezas</th>
                        <th>Peso</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Lavable</td>
                        <td>200</td>
                        <td>27kg</td>
                        <td>Lavados y aportillados</td>
                    </tr>
                    <tr>
                        <td>No Lavable</td>
                        <td>200</td>
                        <td>27kg</td>
                        <td>Lavados y aportillados</td>
                    </tr>
                    <tr>
                        <td>Tapas</td>
                        <td>400</td>
                        <td>27kg</td>
                        <td>Lavados y aportillados</td>
                    </tr>
                    <tr>
                        <td>Lavable</td>
                        <td>200</td>
                        <td>27kg</td>
                        <td>Lavados y aportillados</td>
                    </tr>
                    <tr>
                        <td>No Lavable</td>
                        <td>200</td>
                        <td>27kg</td>
                        <td>Lavados y aportillados</td>
                    </tr>
                    <tr>
                        <td>Tapas</td>
                        <td>400</td>
                        <td>27kg</td>
                        <td>Lavados y aportillados</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- mensaje de declaracion -->
    <section class="container-declaracion">
        <div class="declaracion-mensaje">
            <p>
                DECLARO QUE LOS ENVASES ENTREGADOS ESTÁN SECOS Y SE LES
                REALIZO EL
                TRIPLE LAVADO A LOS ENVASES LAVABLES, EN CASO CONTRARIO
                CUBRIRÉ EL
                IMPORTE POR LA INCINERACIÓN CONTROLADA EN HORNOS
                AUTOMATIZADOS POR LA
                AUTORIDAD FEDERAL
            </p>
        </div>
        <div class="declaracion-firmas">
            <p><strong>Nombre:</strong>________________________________</p>
            <p><strong>Firma:</strong>_______________________</p>
        </div>
    </section>

    <!-- datos del responsable y firma -->
    <section class="container-responsables">
        <div class="responsables-titulo">
            <h1 class="titulo">Datos de Responsable</h1>
        </div>
        <div class="responsables-entrega">
            <p>_________________________________</p>
            <p>Julio cesar Arriaga Mendoza</p>
            <p>Responsable de entrega</p>
        </div>

        <div class="responsables-recepcion">
            <p>_________________________________</p>
            <p>Juan Carlos Medina Robusto</p>
            <p>Responsable de recepción</p>
        </div>
    </section>
</body>

</html>


<?php

// $html = ob_get_clean();
// //echo$html;


// require_once '../Librerias/dompdf/autoload.inc.php';
// use Dompdf\Dompdf;

// $dompdf = new Dompdf(); //crear objeto 

// //opciones para mostrar imagenes 
// $options = $dompdf->getOptions();
// $options->set(array('isRemoteEnable' => true));
// $dompdf->setOptions($options);

// //el contenido del pdf 
// $dompdf->loadHtml($html);

// //crear el archivo 
// $dompdf->setPaper(('letter'));

// //para cambiar propiedades de la hoja de pdf
// //$dompdf->setPaper('A4','landscape');

// //render 
// $dompdf->render();

// //poder trabajar el archivo           para poder descargarlo o solo abrirlo
// $dompdf->stream("archivo_.pdf", array("Attachment" => false));



?>