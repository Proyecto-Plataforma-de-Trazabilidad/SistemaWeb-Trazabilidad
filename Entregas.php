<!-- Incluir menu lateral -->
<?php
include "Layout/navMenu.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/movimientos/Entregas/entregas.css">
    <title>APEJAL-Entregas</title>
</head>

<!-- Estilos de validacion de los campos esto se puede agregar a una hoja de estilo principal. (para no repetir este codigo en todos) -->
<!-- <header>
    <style>
        input:invalid {
            border-color: red;
        }

        input:valid {
            border-color: green;
        }

        select:invalid {
            border-color: red;
        }

        select:valid {
            border-color: green;
        }
    </style>
</header> -->

<body>
    <section class="titulo">
        <div>
            <h1>Entregas</h1>
        </div>
    </section>

    <section class="form-Principal">
        <form class="row g-4 container-fluid" id="frm" method="POST"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

            <div class="form-Principal-encabezado">
                <div class="form-Principal-encabezado-numero">
                    <label for="">Número de entrega: 002 </label>
                </div>
                <div>
                    <label for="fecha">Seleccionar Fecha: &nbsp;</label>
                </div>

                <div class="col-sm-2">
                    <input id="fechainput" class="form-control" type="date" />
                </div>
            </div>

            <div class="col-sm-3">
                <label for="OrdNombre" class="form-label">Tipo de recolector</label>
                <!-- debe de cargar dependiendo el inicio de seccion  -->
                <input disabled type="text" id="innombre" name="nomDistribuidor" class="form-control" maxlength="30"
                    required placeholder="Empresa, Distribuidor, CAT, Municipio">
            </div>

            <div class="col-sm-3">
                <label for="OrdNombre" class="form-label">Nombre de recolector</label>
                <!-- debe de cargar dependiendo el inicio de seccion  -->
                <input disabled type="text" id="innombre" name="nomDistribuidor" class="form-control" maxlength="30"
                    required placeholder="Nombre de Empresa, Distribuidor, CAT, Municipio">
            </div>

            <div class="col-sm-3">
                <label for="OrdNombre" class="form-label">Número de recolector</label>
                <!-- debe de cargar dependiendo el inicio de seccion  -->
                <input disabled type="text" id="innombre" name="nomDistribuidor" class="form-control" maxlength="30"
                    required placeholder="Número de recolector">
            </div>

            <div class="col-sm-3">
                <label for="formFileMultiple" class="form-label">Subir documento de entrega <small>(con
                        firmas)</small></label>
                <input class="form-control" type="file" id="formFileMultiple" multiple>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="inestado" class="form-label">Nombre de Productor</label>
                    <select name="inestado" id="inestado" class="form-select" required>
                        <option hidden>Selecciona un productor registrado</option>
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <label for="OrdFact" class="form-label">Nombre del responsable de entrega</label>
                <input type="text" id="factOrden" name="facturaOrden" class="form-control" maxlength="30"
                    pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="Escribe el nombre" required>
            </div>

            <div class="col-sm-4">
                <label for="OrdFact" class="form-label">Nombre del responsable de recepción</label>
                <input type="text" id="factOrden" name="facturaOrden" class="form-control" maxlength="30"
                    pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="Escribe el nombre" required>
            </div>
        </form>
    </section>

    <!-- Linea para separar el detalle -->
    <div>
        <hr class="divider">
        <label class="divider-titulo">Detalle de entrega: 002</label>
    </div>

    <section class="form-Detalle">
        <form class="row g-4 container-fluid" id="frm" method="POST"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

            <div class="col-sm-4">
                <div>
                    <label for="inestado" class="form-label">Tipo de Envase</label>
                    <select name="inestado" id="inestado" class="form-select" required>
                        <option hidden>Selecciona una opción</option>
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="incap" class="form-label">Número de piezas</label>
                    <input type="number" class="form-control" id="incap" maxlength="10" name="incap" required
                        placeholder="Ingrese una cantidad">
                </div>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="incap" class="form-label">Peso <small>Opcional</small> </label>
                    <input type="number" class="form-control" id="incap" maxlength="10" name="incap" required
                        placeholder="Ingrese una cantidad">
                </div>
            </div>

            <div class="col-sm-4">
                <label for="exampleFormControlTextarea1" class="form-label">Observaciones</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" required
                    placeholder="Escribe una descripción"></textarea>
            </div>

            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary button-aceptar" onclick="" name="Aceptar">Aceptar</button>
            </div>
        </form>


        <div class="form-Detalle-table">

            <table class="table table-striped" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo Envase</th>
                        <th scope="col">Número de piezas</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Eliminar</th>
                        <!-- aqui agregamos el icono y funcion de eliminar por si se equivoca en algo -->
                    </tr>
                </thead>
                <tbody id="bodyTabla">
                    <tr>
                        <th scope="col">1</th>
                        <th scope="col">Ejemplo 1</th>
                        <th scope="col">Ejemplo 1</th>
                        <th scope="col">Ejemplo 1</th>
                        <th scope="col">Ejemplo 1</th>
                        <th scope="col">X</th>
                    </tr>
                </tbody>
            </table>
            <label for="" class="form-Detalle-mensaje">Detalles de entregas</label>
            <button type="submit" class="btn btn-success button-registrar" onclick=""
                name="Registrar">Registrar</button>
        </div>
    </section>

    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script type="text/javascript" src=""></script> <!-- scrip para la funcion del la tabla detalle orden  -->
    <script src="menujs.js"></script>
    <script type="text/javascript">
        $(function () {
            $('#datepicker').datepicker();
        });

        //fecha actual en el datepicker
        var fechaInput = document.getElementById('#fechainput');
        // Obtener la fecha actual
        var fechaActual = new Date();

        // Obtener el día, mes y año en formato de dos dígitos
        var dia = ("0" + fechaActual.getDate()).slice(-2);
        var mes = ("0" + (fechaActual.getMonth() + 1)).slice(-2);
        var anio = fechaActual.getFullYear();

        // Crear una cadena con el formato (DD-MM-YYYY)
        var fechaFormateada = dia + "-" + mes + "-" + anio;

        // Establecer la fecha formateada como el valor del input type date
        fechaInput.value = fechaFormateada;
        console.log(fechaInput.value);

    </script>
</body>

</html>