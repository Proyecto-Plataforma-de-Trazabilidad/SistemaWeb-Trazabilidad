<?php
include "navMenu.php";
?>

<head>
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

    #mapa {
      height: 50vh;
    }
  </style>
</head>

<br><br>
<div class="container">
  <h1>Registrar Contenedores</h1>
</div>
<br>
<form class="row g-4 container-fluid" id="frm" method="POST" action="Contenedores-Archivos/insertar.php" onsubmit="return valdez()" enctype="multipart/form-data">

  <div class="col-md-2">
    <label for="intipocont" class="form-label">Tipo de contenedor</label>
    <select name="intipocont" id="intipocont" class="form-select">

    </select>
  </div>

  <div class="col-md-2">
    <label for="intipoorigen" class="form-label">Tipo de origen</label>
    <select name="intipoorigen" id="intipoorigen" class="form-select">
      <option value="Amocalli">Amocalli</option>
      <option value="Distribuidor">Dist.</option>
      <option value="CAT">CAT</option>
      <option value="Recicladora">Recicladora</option>
      <option value="Municipio">Municipio</option>
      <option value="Empresa">Empresa</option>
    </select>
  </div>

  <div class="col-4">
    <label for="incap" class="form-label">Capacidad (Kg)</label>
    <input type="text" class="form-control" id="incap" maxlength="10" name="incap" pattern="[0-9]{0-30}" required placeholder="Ingresa la capacidad">
  </div>
  <div class="col-4">
    <label for="instatus" class="form-label">Capacidad status</label>
    <input type="text" class="form-control" id="instatus" maxlength="10" name="instatus"  pattern="[0-9]{0-30}" required placeholder="Capacidad actual">
  </div>

  <div class="col-4">
    <label for="indes" class="form-label">Descripción</label>
    <input type="text" class="form-control" id="indes" name="indes" maxlength="30" pattern="[A-Za-z ñÑáéíóúÁÉÍÓÚ#0-9.,-_]{1,30}" required placeholder="Ingresa la descripcion">
  </div>

  <div class="col-sm-4">
    <label for="inulti" class="form-label">Última recolección</label>
    <input type="date" class="form-control" id="inulti" name="inulti" maxlength="12" required>
  </div>

  <div class="col-sm-4">
    <label for="infile" class="form-label">Referencia o permiso</label>
    <input type="file" name="infile" id="infile" class="form-file">
  </div>


  <div class="col-12">
    <label for="inman" class="form-label">Instrucciones de manejo</label>
    <textarea name="inman" id="inman" cols="30" rows="4" class="form-control" required placeholder="Escribe las instrucciones"></textarea>
  </div>

  <div class="col-sm-4">
    <label for="inlat" class="form-label">Latitud</label>
    <input type="text" class="form-control" id="inlat" name="inlat" maxlength="60" required placeholder="Ingresa la longitud">
  </div>

  <div class="col-sm-4">
    <label for="inlon" class="form-label">Longitud</label>
    <input type="text" class="form-control" id="inlon" name="inlon" maxlength="60" required placeholder="Ingresa la latitud">
  </div>
  <div class="col-sm-4">

  </div>

  <div class="col-3">
    <button type="submit" class="btn btn-success" onclick="" name="Registrar">Registrar</button>
  </div>
  <div class="col-3">
    <a href="Contenedores-Archivos/ConsultaMaps.php"><button type="button" class="btn btn-primary" onclick="" name="Registrar">Ubicaciones</button></a>
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
  <h5>Contenedores Registrados</h5>
</div>
<div class="container-fluid">
  <center>
    <table class="table table-striped" id="tabla">
      <thead>
        <tr>
          <th scope="col">idContenedor</th>
          <th scope="col">Tipo</th>
          <th scope="col">Capacidad</th>
          <th scope="col">Descripción</th>
          <th scope="col">Última recolección</th>
          <th scope="col">Permiso</th>
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
<script type="text/javascript" src="Contenedores-Archivos/funcionesCont.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoIir0y0RhmeX5MIfoHdiUgxTRQ21HE4w&callback=initMap"></script>
<script src="menujs.js"></script>
</body>

</html>