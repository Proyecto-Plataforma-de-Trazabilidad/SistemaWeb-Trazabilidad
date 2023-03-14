<!-- Incluir menu lateral -->
<?php
include "../Layout/navMenu.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/movimientos/Orden/detalleOrden.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css">
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script> <!-- iconos -->
    <title>APEJAL-Ordenes</title>
</head>

<body>
    <section class="titulo">
        <div>
            <h1>Orden de productos</h1>
        </div>        
    </section>

</body>


<script type="text/javascript" src="jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="./OrdenesArchivos/funcionesOrdenes.js"></script>
<!-- scrip para la funcion del la tabla detalle orden  -->
<script type="text/javascript" src="./OrdenesArchivos/btn_Registrar.js"></script>
<!-- scrip para la funcion del boton registrar  -->
<script src="../menujs.js"></script>
<script type="text/javascript" src="./OrdenesArchivos/llenarTabla.js"></script>
<!-- <script type="text/javascript" src="./OrdenesArchivos/registrar.js"></script> -->

</html>