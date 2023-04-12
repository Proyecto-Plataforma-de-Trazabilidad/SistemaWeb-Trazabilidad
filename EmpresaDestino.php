<?php
include "Layout/navMenu.php";
include 'conexion.php';
$r = "SELECT * FROM usuarios where Correo = '$varses'";
$res = mysqli_query($enlace, $r);
$filas = mysqli_fetch_array($res);
?>
<script type="text/javascript" src="jquery-3.6.0.min.js"></script>


<div class="container">
  <h1>Empresas Destino</h1>
</div>
<br>
      <form class="row g-4 container-fluid" id="frm" method="POST" action="DestinoArchivos/Insertar.php" onsubmit="return valdez()" enctype="multipart/form-data">

        <div class="col-sm-4">
            <label for="inraz" class="form-label">Razón Social</label>
            <input type="text" id="inraz" name="inraz" class="form-control" maxlength="40"  placeholder="Ingrese la Razón social">
        </div>

        <div class="col-sm-4">
            <label for="indom" class="form-label">Domicilio</label>
            <input type="text" id="indom" name="indom" class="form-control" maxlength="40"  placeholder="Ingrese el domicilio">
        </div>

        <div class="col-4">
            <label for="incp" class="form-label">Código Postal</label>
            <input type="number" id="incp" name="incp" class="form-control" maxlength="5"  placeholder="p.ej. 49000">
        </div>

        <div class="col-4">
            <label for="inmuni" class="form-label">Municipio</label>
            <input type="text" id="inmuni" name="inmuni" class="form-control" maxlength="40"  placeholder="Ingrese el municipio">
        </div>

        <div class="col-4">
            <label for="inedo" class="form-label">Estado</label>
            <input type="text" id="inedo" name="inedo" class="form-control" maxlength="40"  placeholder="Ingrese el estado">
        </div>

        <div class="col-sm-4">
            <label for="intel" class="form-label">Teléfono</label>
            <input type="number" id="intel" name="intel" class="form-control" maxlength="14"  placeholder="p.ej. 5521234567">
        </div>

        <div class="col-sm-4">
            <label for="incorr" class="form-label">Correo</label>
            <input type="text" id="incorr" name="incorr" class="form-control" maxlength="40"  placeholder="p.ej. ejemplo@gmail.com">
        </div>

        <div class="col-sm-8">
            <label for="inputDom" class="form-label">SEMARNAT</label>
            <input type="file" name="infile" id="infile" class="form-file">
        </div>

        <div class="col-sm-4">
            <label for="inlat" class="form-label">Latitud</label>
            <input type="text" class="form-control" id="inlat" maxlength="10" name="inlat"  placeholder="Ingrese la latitud">
        </div>

        <div class="col-sm-4">
           <label for="inlon" class="form-label">Longitud</label>
           <input type="text" class="form-control" id="inlon" maxlength="10" name="inlon"  placeholder="Ingrese la longitud">
        </div>
        <div class="col-sm-4">            
        </div>         

        <div class="col-3">
          <button type="submit" class="btn btn-success" onclick="" name="Registrar">Registrar</button>
        </div>
        <div class="col-3">
          <a href="DestinoArchivos/consultaMaps.php"><button type="button" class="btn btn-primary" onclick="" name="Registrar">Ubicaciones</button></a>
        </div>

        <div class="row g-4 container-fluid">
          <div class="col-md-12">
              <div id="mapa" style="width: 100%; height: 500px">

              </div>
          </div>
        </div>
      </form>
      

      <br><br>
      <div class="container text-center">
        <h5>Empresas Destino Registradas</h5>
      </div>
      <div class="container">
        <center>
        <table class="table table-striped" id="tabla">
            <thead>
                <tr>
                    <th scope="col">idDestino</th>
                    <th scope="col">Razón Social</th>
                    <th scope="col">Domicilio</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Correo</th>
                    <th scope="col">SEMARNAT</th>
                    <th scope="col">Opciones</th>
                </tr>
            </thead>
            <tbody id="bodyTabla">
                
        </table>
        </center>
      </div>
      <br>
       <script>
        function valdez()
        {
            let tel=document.getElementById("intel").value;
            let cp=document.getElementById("incp").value;
            if(tel.length<10 || tel.length>10){
              alert("El campo Telefono, debe ser de 10 digitos");
              return false;
            }
            if(cp.length<5 || cp.length>5){
              alert("El campo Código postal, debe ser de 5 digitos");
              return false;
            }
            return 0;
        }
        function initMap(){
          let latitud=19.7047732
          let longitud=-103.5031816;
          cordenadas={lat:latitud, lng:longitud}

          generarMapa(cordenadas);

        }
        function generarMapa(coordenadas){
          let mapa=new google.maps.Map(document.getElementById('mapa'),{
            zoom: 12,
            center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
          });

          marcador = new google.maps.Marker({
            map: mapa,
            draggable: true,
            position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
          });

          marcador.addListener("dragend", function(event){
            document.getElementById("inlat").value=this.getPosition().lat();
            document.getElementById("inlon").value=this.getPosition().lng();
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
      if (rol == 2 || rol == 3 || rol == 4 || rol == 11) {
        $(function() {
          $('#frm').hide();
        });
      }
    </script>    

    <script type="text/javascript" src="jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="datatables.min.js"></script>
    <script type="text/javascript" src="DestinoArchivos/funcionesDestino.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoIir0y0RhmeX5MIfoHdiUgxTRQ21HE4w&callback=initMap"></script>
    <script src="Layout/menujs.js"></script>
</body>
</html>