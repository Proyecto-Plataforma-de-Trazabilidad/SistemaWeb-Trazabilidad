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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css">
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script> <!-- iconos -->
    
</head>

<body>
    <section class="titulo">
        <div>
            <h1>Entregas</h1>
        </div>
        <div>            
            <button type="button" class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i> &nbsp;Consultar</button>
        </div>
    </section>

    <section class="form-Principal">
        <form class="row g-4 container-fluid" id="frmEntrega" method="POST"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

            <div class="form-Principal-encabezado">
                <div class="form-Principal-encabezado-numero">
                    <label id="numEntrega" data-numEntrega="">Número de entrega: 000 </label>
                </div>
                <div>
                    <label for="fecha">Seleccionar Fecha: &nbsp;</label>
                </div>

                <div class="col-sm-2">
                    <input id="fecha" class="form-control" type="date" required/>
                </div>
            </div>

            <div class="col-sm-4">
                <label for="OrdNombre" class="form-label">Tipo de recolector</label>
                <!-- debe de cargar dependiendo el inicio de seccion  -->
                <input disabled type="text" id="tipoRecol" name="tipoDistribuidor" class="form-control" maxlength="30"
                    required placeholder="Empresa, Distribuidor, CAT, Municipio" data-tipoRecolector="">
            </div>

            <div class="col-sm-4">
                <label for="OrdNombre" class="form-label">Nombre de recolector</label>
                <!-- debe de cargar dependiendo el inicio de seccion  -->
                <input disabled type="text" id="nomRecol" name="nomRecol" class="form-control" maxlength="30"
                    required placeholder="Nombre de Empresa, Distribuidor, CAT, Municipio" data-nomRecolector="">
            </div>

            <!-- <div class="col-sm-3">
                <label for="OrdNombre" class="form-label">Número de recolector</label>
                <input disabled type="text" id="innombre" name="nomDistribuidor" class="form-control" maxlength="30"
                    required placeholder="Número de recolector">
            </div>

            <div class="col-sm-3">
                <label for="formFileMultiple" class="form-label">Subir documento de entrega <small>(con
                        firmas)</small></label>
                <input class="form-control" type="file" id="formFileMultiple" multiple>
            </div> -->

            <div class="col-sm-4">
                <div>
                    <label for="inestado" class="form-label">Nombre de Productor</label>
                    <select name="nomProdu" id="nomProdu" class="form-select" required>
                        <option hidden>Selecciona un productor registrado</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <label for="OrdFact" class="form-label">Nombre del responsable de entrega</label>
                <input type="text" id="nomResEntrega" name="nomResEntrega" class="form-control" maxlength="30"
                    pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="Escribe el nombre" required>
            </div>

            <div class="col-sm-4">
                <label for="OrdFact" class="form-label">Nombre del responsable de recepción</label>
                <input type="text" id="nomResRecep" name="nomResRecep" class="form-control" maxlength="30"
                    pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="Escribe el nombre" required>
            </div>
        </form>
    </section>

    <!-- Linea para separar el detalle -->
    <div>
        <hr class="divider">
        <label class="divider-titulo" id="numDetalle" >Detalle de entrega: 001</label>
    </div>

    <section class="form-Detalle">
        <form class="row g-4 container-fluid" id="frm" method="POST"
            action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return 0">

            <div class="col-sm-4">
                <div>
                    <label for="inestado" class="form-label">Tipo de Envase</label>
                    <select name="tipoEnva" id="tipoEnva" class="form-select" required>
                        <option hidden>Selecciona una opción</option>
                        <option value="Rígidos lavable">Rígidos lavable</option>
                        <option value="Rígidos no lavable">Rígidos no lavable</option>
                        <option value="Flexible">Flexible</option>
                        <option value="Tapas">Cubetas</option>
                        <option value="Tapas">Cartón</option>
                        <option value="Tapas">Tambos</option>
                        <option value="Tapas">Metal</option>
                    </select>
                </div>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="incap" class="form-label">Cantidad de piezas</label>
                    <input type="number" class="form-control" id="cantiPza" maxlength="10" name="cantiPza" required
                        placeholder="Ingrese una cantidad">
                </div>
            </div>

            <div class="col-sm-4">
                <div>
                    <label for="incap" class="form-label">Peso <small>(Opcional)</small> </label>
                    <input type="number" class="form-control" id="peso" maxlength="10" name="peso" 
                        placeholder="Ingrese una cantidad">
                </div>
            </div>

            <div class="col-sm-4">
                <label for="exampleFormControlTextarea1" class="form-label">Observaciones</label>
                <textarea class="form-control" id="observa" rows="3" required
                    placeholder="Escribe una descripción"></textarea>
            </div>

            <div class="col-sm-4">
                <button type="button" id="aceptar" class="btn btn-primary button-aceptar"  name="Aceptar">Aceptar</button>
            </div>
        </form>


        <div class="form-Detalle-table">

            <table class="table table-striped" id="detalle">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tipo Envase</th>
                        <th scope="col">Cantidad de piezas</th>
                        <th scope="col">Peso</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Eliminar</th>
                        <!-- aqui agregamos el icono y funcion de eliminar por si se equivoca en algo -->
                    </tr>
                </thead>
                <tbody id="bodyTabla">

                </tbody>
            </table>
            <label for="" class="form-Detalle-mensaje">Detalles de entregas</label>
            <button type="submit" id="registrar" class="btn btn-success button-registrar" name="Registrar" form="frmEntrega">Registrar</button>
        </div>
    </section>
    
    <script>
        //fecha del sistema 
        const inputFecha= document.getElementById('fecha');
        const hoy = new Date().toISOString().slice(0,10);
        inputFecha.value=hoy;
    </script>

    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="./EntregasArchivos/llenarCampos.js"></script> <!-- scrip para llenar los campos del form  -->
    <script type="text/javascript" src="./EntregasArchivos/llenarDetalle.js"></script> <!-- scrip para llenar los campos del form  -->
    <script type="text/javascript" src="./EntregasArchivos/btnRegistrar.js"></script>

    <script src="Layout/menujs.js"></script>
    

</body>

</html>