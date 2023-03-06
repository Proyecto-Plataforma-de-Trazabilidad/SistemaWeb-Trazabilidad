<!-- Incluir menu lateral -->
<?php
include "navMenu.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/movimientos/Orden/orden.css">
    <title>APEJAL-Ordenes</title>
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
            <h1>Orden de productos</h1>
        </div>
    </section>

    <section class="form-Principal">
        <form class="row g-4 container-fluid" id="frm" method="POST"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

            <div class="form-Principal-encabezado">
                <div class="form-Principal-encabezado-numero">
                    <label for="">Numero de orden: 002 </label>
                </div>
                <div>
                    <label for="startDate">Seleccionar Fecha: &nbsp;</label>
                </div>

                <div class="col-sm-2">
                    <input id="startDate" class="form-control" type="date" />
                </div>
            </div>

            <div class="col-sm-4">
                <label for="OrdNombre" class="form-label">Nombre de Distribuidor</label>
                <!-- debe de cargar dependiendo el inicio de seccion  -->
                <input disabled type="text" id="innombre" name="nomDistribuidor" class="form-control" maxlength="30"
                    required placeholder="Nombre del distribuidor">
            </div>

            <div class="col-sm-4">
                <label for="OrdFact" class="form-label">Factura</label>
                <input type="text" id="factOrden" name="facturaOrden" class="form-control" maxlength="30"
                    pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" required placeholder="Número de cédula">
            </div>

            <div class="col-sm-4">
                <label for="formFileMultiple" class="form-label">Subir Factura</label>
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
                <label for="OrdFact" class="form-label">Cédula de receta</label>
                <input type="text" id="factOrden" name="facturaOrden" class="form-control" maxlength="30"
                    pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="Número de cédula">
            </div>

            <div class="col-sm-4">
                <label for="formFileMultiple" class="form-label">Subir Receta</label>
                <input class="form-control" type="file" id="formFileMultiple" multiple>
            </div>

        </form>
    </section>

    <!-- Linea para separar el detalle -->
    <div>
        <hr class="divider">
    </div>

    <section class="form-Detalle">
        <form class="row g-4 container-fluid" id="frm" method="POST"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

            <div class="col-sm-4">
                <div>
                    <label for="inestado" class="form-label">Tipo de Químico</label>
                    <select name="inestado" id="inestado" class="form-select" required>
                        <option hidden>Selecciona un tipo</option>
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="inestado" class="form-label">Tipo de Envase</label>
                    <select name="inestado" id="inestado" class="form-select" required>
                        <option hidden>Selecciona un tipo</option>
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="inestado" class="form-label">Color</label>
                    <select name="inestado" id="inestado" class="form-select" required>
                        <option hidden>Selecciona un color</option>
                        <option value="">1</option>
                        <option value="">2</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="col-6">
                    <label for="incap" class="form-label">Capacidad de piezas</label>
                    <input type="number" class="form-control" id="incap" maxlength="10" name="incap" required
                        placeholder="Ingrese la cantidad">
                </div>            
            </div>

            <div class="col-sm-4">                            
                <button type="submit" class="btn btn-primary button-aceptar" onclick="" name="Aceptar">Aceptar</button>
            </div>
        </form>


        <div class="form-Detalle-table">
            <h6 class="form-Detalle-titulo">Detalle de orden: 001</h6>
            <table class="table table-striped" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo Químico</th>
                        <th scope="col">Tipo Envase</th>
                        <th scope="col">Color</th>
                        <th scope="col">Cantidad piezas</th>
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
                        <th scope="col">Ejemplo 1</th>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="btn btn-success button-registrar" onclick="" name="Registrar">Registrar</button>
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
    </script>
</body>

</html>