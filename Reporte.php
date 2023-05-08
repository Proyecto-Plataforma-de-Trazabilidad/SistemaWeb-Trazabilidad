<?php
include "Layout/navMenu.php";
include 'conexion.php';
$r = "SELECT * FROM usuarios where Correo = '$varses'";
$res = mysqli_query($enlace, $r);
$filas = mysqli_fetch_array($res);
?>

<script type="text/javascript" src="jquery-3.6.0.min.js"></script>

    <h1>Reporte De Total Piezas Productor Por Período</h1>
    <br>
    
    <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return valdez()">

      <div class="col-sm-3">
        <label for="inprod" class="form-label">Productor</label>
        <select name="inprod" id="inprod" class="form-select">

        </select>
      </div>


      <div class="col-3">
        <button type="submit" class="btn btn-success" onclick="" name="Registrar">Registrar</button>
      </div>
      

    </form>


    <br><br>
    

    <script>
       
    function obtenerTamaño() {
      let ancho = document.documentElement.clientWidth;
      ancho.addListener("change", function(event) {

      })
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
      if (rol == 2 || rol == 4) {
        $(function() {
          $('#frm').hide();
        });
      }
    </script>

    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script type="text/javascript" src="PruebaReportesNay/funcionReporte1.js"></script>
    <script src="Layout/menujs.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>


  </main>
</body>

</html>

