<?php
include "Layout/navMenu.php";
?>




    <!--SweetAlert en linea-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!--SweetAlert en local por mis webos-->
    <link rel="stylesheet" href="..\plugins\Sweetalert2\sweetalert2.min.css">
    <script src="..\plugins\Sweetalert2\sweetalert2.all.min.js"></script>




<h1>Registrar Distribuidores</h1>

<form class="row g-4 container-fluid" id="frm" method="POST" action="DistArchivos/Insertar.php" onsubmit="return valdez()" enctype="multipart/form-data">

  <div class="col-sm-4">
    <label for="innom" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="innom" name="innom" maxlength="40" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" placeholder="Ingresa el nombre">
  </div>

  <div class="col-sm-4">
    <label for="inrep" class="form-label">Representante</label>
    <input type="text" class="form-control" id="inrep" name="inrep" maxlength="40" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" placeholder="Nombre del representante">
  </div>

  <div class="col-sm-4">
    <label for="indom" class="form-label">Domicilio</label>
    <input type="text" class="form-control" id="indom" name="indom" maxlength="30" placeholder="Ingresa el domicilio">
  </div>

  <div class="col-4">
    <label for="incp" class="form-label">Código Postal</label>
    <input type="text" class="form-control" id="incp" maxlength="5" name="incp" pattern="[0-9]{5}" placeholder="P.ejem. 49000">
  </div>


  <div class="col-4">
    <label for="inest" class="form-label">Estado</label>
    <input type="text" class="form-control" id="inest" name="inest" maxlength="30" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" placeholder="Ingresa el estado">
  </div>

  <div class="col-4">
    <label for="inmuni" class="form-label">Municipio</label>
    <input type="text" class="form-control" id="inmuni" name="inmuni" maxlength="40" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" placeholder="Ingresa el municipio">
  </div>

  <div class="col-4">
    <label for="inciu" class="form-label">Ciudad</label>
    <input type="text" class="form-control" id="inciu" name="inciu" maxlength="30" pattern="[A-Za-z nÑáéíóúÁÉÍÓÚ.'´_-,]{1,30}" placeholder="Ingresa la ciudad">
  </div>


  <div class="col-4">
    <label for="intel" class="form-label">Teléfono</label>
    <input type="text" class="form-control" id="intel" maxlength="10" name="intel" pattern="[0-9]{10}" placeholder="5521234567">
  </div>

  <div class="col-sm-4">
    <label for="incorr" class="form-label">Correo</label>
    <input type="text" class="form-control" id="incorr" name="incorr" maxlength="30" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#@0-_9.,-]{1,30}" placeholder="ejemplo@gmail.com">
  </div>

  <div class="col-sm-4">
    <label for="infile1" class="form-label">Capacitación BUMA</label>
    <input type="file" name="infile1" id="infile1" class="form-file">
  </div>
  <div class="col-sm-4">
    <label for="infile2" class="form-label">SEMARNAT</label>
    <input type="file" name="infile2" id="infile2" class="form-file">
  </div>
  <div class="col-sm-4">
    <label for="infile3" class="form-label">Licencia Mpio.</label>
    <input type="file" name="infile3" id="infile3" class="form-file">
  </div>

  <div class="col-8">
    <label for="ingiro" class="form-label">Actividad Giro</label>
    <textarea name="ingiro" class="form-control" id="ingiro" cols="30" rows="4" maxlength="100" required placeholder="Ingresa la actividad o giro..."></textarea>
  </div>
  <div class="col-4">
  </div>

  <div class="col-sm-3">
    <label for="inlat" class="form-label">Latitud</label>
    <input type="text" class="form-control" id="inlat" maxlength="20" name="inlat" required placeholder="Ingresa la latitud">
  </div>

  <div class="col-sm-3">
    <label for="inlon" class="form-label">Longitud</label>
    <input type="text" class="form-control" id="inlon" maxlength="20" name="inlon" required placeholder="Ingresa la longitud">
  </div>

  <div class="col-sm-4">

  </div>

  <div class="col-3">
    <button type="submit" class="btn btn-success" onclick="" name="Registrar">Registrar</button>
  </div>
  <div class="col-3">
    <a href="DistArchivos/consultaMaps.php"><button type="button" class="btn btn-primary" onclick="" name="Registrar">Ubicaciones</button></a>
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
  <h5>Distribuidores Registrados</h5>
</div>

<div class="container col-12">
  <center>
    <table class="table table-striped" id="tabla">
      <thead>
        <tr>
          <th scope="col">Id Distribuidor</th>
          <th scope="col">Nombre</th>
          <th scope="col">Representante</th>
          <th scope="col">Domicilio</th>
          <th scope="col">Ciudad</th>
          <th scope="col">Estado</th>
          <th scope="col">Teléfono</th>
          <th scope="col">Email</th>
          <th scope="col">BUMA</th>
          <th scope="col">SEMARNAT</th>
          <th scope="col">Licencia</th>
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
  function initMap() {
    let latitud = 19.7047732
    let longitud = -103.5031816;
    cordenadas = {
      lat: latitud,
      lng: longitud
    }

    generarMapa(cordenadas);

  }

  function generarMapa(coordenadas) {
    let mapa = new google.maps.Map(document.getElementById('mapa'), {
      zoom: 12,
      center: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
    });

    marcador = new google.maps.Marker({
      map: mapa,
      draggable: true,
      position: new google.maps.LatLng(coordenadas.lat, coordenadas.lng)
    });

    marcador.addListener("dragend", function(event) {
      document.getElementById("inlat").value = this.getPosition().lat();
      document.getElementById("inlon").value = this.getPosition().lng();
    })
  }

  function obtenerTamaño() {
    let ancho = document.documentElement.clientWidth;
    ancho.addListener("change", function(event) {

    })
  }
</script>
<script type="text/javascript" src="jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="datatables.min.js"></script>
<script type="text/javascript" src="DistArchivos/funcionesDist.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoIir0y0RhmeX5MIfoHdiUgxTRQ21HE4w&callback=initMap"></script>
<script src="poper\popper.min.js"></script>
<script src="Layout/menujs.js"></script>
</body>

</html>