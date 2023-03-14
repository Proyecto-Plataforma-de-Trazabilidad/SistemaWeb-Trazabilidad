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
    <link rel="stylesheet" href="../css/movimientos/Orden/ConsultaOrden.css"> <!-- estilo principal -->
    <link rel="stylesheet" href="../bootstrap-5.1.3-dist/css/bootstrap.min.css"> <!-- estilo boostrap -->
    <link rel="stylesheet" href="../menucss.css"> <!-- estilo menu lateral -->
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script> <!-- iconos -->
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <!-- js de tabla  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <title>APEJAL-Consulta Ordenes</title>
</head>

<body>
    <section class="titulo">
        <div>
            <h1>Consulta de Ordenes</h1>
        </div>
    </section>

    <section class="filtro">
        <form class="row g-4 container-fluid" id="frmConsulta" method="POST"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

            <div class="col-sm-2">
                <div>
                    <label for="inestado" class="form-label">Nom. Distribuidor</label>
                    <select name="inestado" id="tipoQuimi" class="form-select" disabled>
                        <option hidden>Selecciona un tipo</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-2">
                <div>
                    <label for="inestado" class="form-label">Nom. Productor</label>
                    <select name="inestado" id="tipoQuimi" class="form-select" >
                        <option hidden>Selecciona un tipo</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-2">
                <div>
                    <label for="incap" class="form-label">Factura</label>
                    <input type="text" id="factOrden" name="facturaOrden" class="form-control" maxlength="30"
                        pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" required placeholder="Número de cédula">
                </div>
            </div>

            <div class="col-sm-2">
                <div>
                    <label for="incap" class="form-label">Cédula Receta</label>
                    <input type="text" id="factOrden" name="facturaOrden" class="form-control" maxlength="30"
                        pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" required placeholder="Número de cédula">
                </div>
            </div>

            <div class="col-sm-2">
                <div>
                    <label for="incap" class="form-label">Fecha</label>
                    <input id="fecha" class="form-control" type="date" required />
                </div>
            </div>

            <div class="col-sm-2 button-buscar"> <!--Agrega el detalle a la tabla-->
                <div class="">
                    <button id="aceptar" type="button" class="btn btn-outline-dark" name="Aceptar"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
        </form>
    </section>

    <section class="Orden-tabla">
        <h3>Ordenes</h3>
        <div class="form-Orden-table">
            <table class="table table-striped" id="orden">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Distribuidor</th>
                        <th scope="col">Factura</th>
                        <th scope="col">Archivo Factura</th>
                        <th scope="col">Cédula Receta</th>
                        <th scope="col">Archivo Receta</th>
                        <th scope="col">Productor</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Mostrar detalle</th>
                        <th scope="col">Editar</th>
                        <!-- aqui agregamos el icono y funcion de eliminar por si se equivoca en algo -->
                    </tr>
                </thead>
                <tbody id="bodyTabla1">
                    
                </tbody>
            </table>
        </div>
    </section>

    <!-- Linea para separar el detalle -->
    <!-- <div>
        <hr class="divider">
    </div> -->

    <section class="detalle-tabla">
        <h3>Detalle Orden</h3>
        <div class="form-Detalle-table">

            <table class="table table-striped" id="detalle">
                <thead>
                    <tr>
                        <th scope="col">Número de Orden</th>
                        <th scope="col">Número Consecutivo</th>
                        <th scope="col">Tipo Químico</th>
                        <th scope="col">Tipo Envase</th>
                        <th scope="col">Color</th>
                        <th scope="col">Piezas</th>
                        <th scope="col">Editar</th>
                        <!-- aqui agregamos el icono y funcion de eliminar por si se equivoca en algo -->
                    </tr>
                </thead>
                <tbody id="bodyTabla2">

                </tbody>
            </table>
        </div>
    </section>

</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<!-- jquery para traer los datos con ajax y json -->
<script type="text/javascript" src="../jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../menujs.js"></script>


<!-- buscador de las tablas -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#orden').DataTable();
        windows.location.reload();
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#detalle').DataTable();
        windows.location.reload();
    });
</script>



</html>