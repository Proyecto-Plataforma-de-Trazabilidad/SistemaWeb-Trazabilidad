<!-- Incluir menu lateral -->
<?php
include "../Layout/navMenu2.php";

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/movimientos/Entregas/ConsultaEntregas.css"> <!-- estilo principal -->
    <link rel="stylesheet" href="../css/movimientos/Orden/orden.css">
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script> <!-- iconos -->
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css">

    <!-- js de tabla  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <title>Ver PDF</title>
</head>

<body>
    <section class="titulo">
        <div>
            <h1>Ver PDF</h1>
        </div>
    </section>

    <section class="filtro consultaEntrega">
        <div>   <!--!Ciudado con estas rutas relativas -->
          <iframe id="ruta" src="http://localhost/Nuevo-SistemaWeb-Trazabilidad/pdfjs-3.8.162-dist/web/viewer.html?file=http://localhost/Nuevo-SistemaWeb-Trazabilidad/No-File.pdf" frameborder="0" width="800px" height="1000px"></iframe>
        </div>
    </section>

    <script type="text/javascript">
      <?php 
        if (isset($_GET['archivo'])) {
      ?>

        let archivo = "<?php echo $_GET['archivo']; ?>";  //!Ciudado con estas rutas relativas
        let nuevaRuta = "http://localhost/Nuevo-SistemaWeb-Trazabilidad/pdfjs-3.8.162-dist/web/viewer.html?file=http://localhost/Nuevo-SistemaWeb-Trazabilidad/EntregasArchivos/Recibos/" + archivo;
        $("#ruta").attr("src", nuevaRuta);
        
      <?php 
        }
      ?>   
    
    </script>

    
    <script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../datatables.min.js"></script>
    <script type="text/javascript" src="../tablas.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../Layout/menujs.js"></script>

</body>

</html>