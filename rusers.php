<?php
    include('Layout/navMenu.php')
?>

    <h2>Registrar Nuevo Usuario</h2>
    <br>

    <form class="row g-4 container-fluid" action="">

        <div class="col-sm-4">
        <label for="tipUser" class="form-label">Tipo Usuario</label>
        <select name="tipUser" id="tipUser" class="form-select">

        </select>
        </div>

        <div class="col-sm-4">
          <label for="nom" class="form-label">Nombra</label>
          <input type="text" class="form-control" id="nom"  name="nom" maxlength="40" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" required placeholder="Ingresa el nombre">
        </div>

        <div class="col-sm-4">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" maxlength="50" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#@0-_9.,-]{1,30}" placeholder="Ingresa el email">
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-success" onclick="" name="Registrar">Registrar</button>
        </div>
    </form>

    <br><br>

    <!--Tabla para mostrar los usuarios registrados-->
    <div class="container text-center">
        <h5>Productores Registrados</h5>
    </div>

    <div class="container col-12">
        <center>
            <table class="table table-striped" id="tabla">
                <thead>
                    <tr>
                        <th scope="col">Id Usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Rol</th>
                        
                    </tr>
                </thead>

                <tbody id="bodyTabla">

                </tbody>

            </table>
        </center>
    </div>


<script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script type="text/javascript" src="UserArchivos/funcionesUser.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoIir0y0RhmeX5MIfoHdiUgxTRQ21HE4w&callback=initMap"></script>
    <script src="menujs.js"></script>
</body>
</html>