<?php
    include "navMenu.php";
?>

<header>
<style>
        input:invalid{
            border-color: red;
            
        }

        
        input:valid {
            border-color: green;
        }  

        select:invalid{
            border-color: red;
        }

        select:valid{
            border-color: green;
        }
    </style>
</header>

<br><br>
<div class="container">
  <h1>Registrar Productores</h1>
</div>
<br>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return 0">

        <div class="col-sm-4">
          <label for="innom" class="form-label">Nombre</label>
          <input type="text" class="form-control" id="innom"  name="innom" maxlength="40" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,40}" required placeholder="Ingresa el nombre">
        </div>

        <div class="col-sm-4">
          <label for="inreg" class="form-label">RegistroProductor</label>
          <input type="text" class="form-control" id="inreg"  name="inreg" maxlength="15" pattern="[1-9A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" required placeholder="Ingresa el registro">
        </div>

        <div class="col-4">
          <label for="indom" class="form-label">Domicilio</label>
          <input type="text" class="form-control" id="indom"  name="indom" maxlength="30" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" required placeholder="Ingresa el domicilio">
        </div>

        <div class="col-4">
            <label for="incp" class="form-label">Código Postal</label>
            <input type="text" class="form-control" id="incp" maxlength="5" name="incp" pattern="[0-9]{5}" required placeholder="p.ej. 49000">
        </div>

        <div class="col-4">
          <label for="inciu" class="form-label">Ciudad</label>
          <input type="text" class="form-control" id="inciu"  name="inciu" maxlength="30" required placeholder="Ingresa la ciudad">
        </div>

        <div class="col-4">
          <label for="inmuni" class="form-label">Municipio</label>
          <input type="text" class="form-control" id="inmuni"  name="inmuni" maxlength="40" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,40}" required placeholder="Ingresa el municipio">
        </div>

        <div class="col-4">
          <label for="inest" class="form-label">Estado</label>
          <input type="text" class="form-control" id="inest"  name="inest" maxlength="30" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" required placeholder="Ingresa el estado">
        </div>

        <div class="col-4">
            <label for="intel" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="intel" maxlength="14" name="intel" pattern="[0-9]{10}" required placeholder="5521234567">
        </div>

        <div class="col-sm-4">
          <label for="incorr" class="form-label">Correo</label>
          <input type="text" class="form-control" id="incorr"  name="incorr" maxlength="60" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#@0-_9.,-]{1,30}" required placeholder="ejemplo@gmail.com">
        </div>

        <div class="col-4">
          <label for="inpuntos" class="form-label">Puntos Acumulados</label>
          <input type="text" class="form-control" id="inpuntos"  name="inpuntos" maxlength="20" pattern="[0-9]{1,10}" required placeholder="Ingresa los puntos">
        </div>

        <div class="col-4">
          <label for="inorden" class="form-label">Total Piezas Orden</label>
          <input type="text" class="form-control" id="inorden"  name="inorden" maxlength="11" required placeholder="Ingresa num. de piezas">
        </div>
        
        <div class="col-4">
          <label for="inentrega" class="form-label">Total Piezas Entregadas</label>
          <input type="text" class="form-control" id="inentrega"  name="inentrega" maxlength="11" required placeholder="Ingresa num. de piezas">
        </div>

        <div class="col-sm-6">
            <label for="ingiro" class="form-label">Actividad Giro</label>
            <textarea name="ingiro" id="ingiro" cols="30" rows="4" class="form-control" placeholder="Ingresa la actividad o el giro..."></textarea>
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-success" onclick="" name="Registrar">Registrar</button>
        </div>

      </form>
      

      <br><br>
      <div class="container text-center">
        <h5>Productores Registrados</h5>
      </div>
      <div class="container col-12">
        <center>
        <table class="table table-striped" id="tabla">
            <thead>
                <tr>
                    <th scope="col">idProductor</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Puntos acumulados</th>
                    <th scope="col">Opciones</th>
                </tr>
              </thead>
            <tbody id="bodyTabla">

            </tbody>
        </table>
        </center>
      </div>
      <br>
       
    </script>
      <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script type="text/javascript" src="ProductoresArchivos/funcionesProd.js"></script>
    <script src="menujs.js"></script>
      
</body>
</html>