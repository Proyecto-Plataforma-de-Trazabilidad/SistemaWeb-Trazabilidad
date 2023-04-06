<?php
include "Layout/navMenu.php";
include 'conexion.php';
$r = "SELECT * FROM usuarios where Correo = '$varses'";
$res = mysqli_query($enlace, $r);
$filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="jquery-3.6.0.min.js"></script>

    <!--SweetAlert en linea-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!--SweetAlert en local por mis webos-->
    <link rel="stylesheet" href="..\plugins\Sweetalert2\sweetalert2.min.css">
    <script src="..\plugins\Sweetalert2\sweetalert2.all.min.js"></script>
    <!--Combos responsivos-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<div class="container">
  <h1>Responsable del CAT</h1>
</div>
<br>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" onsubmit="return 0">

        <div class="col-sm-4">
            <label for="innom" class="form-label">Nombre</label>
            <input type="text" id="innom" name="innom" class="form-control" maxlength="30" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" placeholder="Ingresa el nombre">
        </div>

        <div class="col-sm-4">
            <label for="indom" class="form-label">Domicilio</label>
            <input type="text" id="indom" name="indom" class="form-control" maxlength="30" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-]{1,30}" placeholder="Ingresa el dimicilio">
        </div>

        <div class="col-4">
            <label for="incp" class="form-label">Código Postal</label>
            <input type="text" id="incp" name="incp" class="form-control" maxlength="5" pattern="[0-9]{5}"  placeholder="49000">
        </div>

        <div class="col-4">
            <label for="inest" class="form-label" >Estado</label>
            <br>
            <select id="jmr_contacto_estado" name="jmr_contacto_estado" class="js-example-basic-multiple" id="Estado" multiple="multiple"><option>Selecciona tu estado</option></select>
        </div>
  
        <script>
                $(document).ready(function () {
                $('#jmr_contacto_estado').select2();
                });
        </script>


        <div class="col-4">
               <label for="inmuni" class="form-label">Municipio</label>
               <br>
               <select id="jmr_contacto_municipio" name="jmr_contacto_municipio" class="js-example-basic-multiple" id="Estado" multiple="multiple"><option>Selecciona tu municipio</option></select>
        </div>

        <script>
                $(document).ready(function () {
                $('#jmr_contacto_municipio').select2();
                });
        </script>

        <div class="col-sm-4">
            <label for="intel" class="form-label">Teléfono</label>
            <input type="text" id="intel" name="intel" class="form-control" maxlength="14" pattern="[0-9]{10}"  placeholder="5521234567">
        </div>

        <div class="col-sm-4">
            <label for="incorr" class="form-label">Correo</label>
            <input type="text" id="incorr" name="incorr" class="form-control" maxlength="30" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#@0-_9.,-]{1,30}" placeholder="ejemplo@gmail.com">
        </div>

        <div class="col-4">
            <label for="inestado" class="form-label">Estado</label>
            <select name="inestado" id="inestado" class="form-select">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
            </select>
        </div>

        <div class="col-12">
          <button type="submit" class="btn btn-success" onclick="" name="Registrar">Registrar</button>
        </div>
        
      </form>
      

      <br><br>
      <div class="container text-center">
        <h5>Responsables Registrados</h5>
      </div>
      <div class="container">
        <center>
        <table class="table table-striped" id="tabla">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">CP</th>
                    <th scope="col">Municipio</th>
                    <th scope="col">Entidad Federativa</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Email</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="bodyTabla">
            </tbody>
        </table>
        </center>
      </div>
      <br>
       <script>
        function valdez()
        {
            let cp=document.getElementById("incp").value;
            let tel=document.getElementById("intel").value;
            if(cp.length<5 || cp.length>5){
                alert("El campo: Código postal, debe ser de 5 digitos");
                return false;
            }
            if(tel.length<10 || cp.length>10){
                alert("El campo: Código postal, debe ser de 10 digitos");
                return false;
            }
            return 0;
        }
    </script>

    <!--Código PHP para obtener el IDtiporol del usuario que inició sesión-->
  <?php
  $rol = $filas['Idtipousuario'];
  ?>
  
  <!--Código de JS para mandar a una variable de js el valor de una variable php-->
  <script type="text/javascript">
      var rol = "<?php echo $rol; ?>";

      //Si el id del rol obtenido, únicamente puede consultar -> ocultar el formulario
      if (rol == 4 || rol == 6) {
        $(function(){
          $('#frm').hide();
        });
      } 
  </script>

      <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script type="text/javascript" src="ResponsablesArchivos/funcionesRes.js"></script>
    <script src="Layout/menujs.js"></script>
    <script src="poper\popper.min.js"></script>
      
</body>
</html>