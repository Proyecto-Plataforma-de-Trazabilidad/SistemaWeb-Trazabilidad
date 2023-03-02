<?php
include "navMenu.php";
?>


  <main>
    <h1>Registrar Huertos</h1>

    <br>
    <form class="row g-4 container-fluid" id="frm" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" onsubmit="return valdez()">

      <div class="col-sm-3">
        <label for="inprod" class="form-label">Productor</label>
        <select name="inprod" id="inprod" class="form-select">

        </select>
      </div>

      <div class="col-sm-2">
        <label for="inhue" class="form-label">HUE</label>
        <input type="number" class="form-control" id="inhue" maxlength="10" name="inhue" required placeholder="Ingrese el HUE">
      </div>
      <div class="col-sm-3">
        <label for="inlat" class="form-label">Latitud</label>
        <input type="text" class="form-control" id="inlat" maxlength="10" name="inlat" required placeholder="Ingrese la latitud">
      </div>
      <div class="col-sm-3">
        <label for="inlon" class="form-label">Longitud</label>
        <input type="text" class="form-control" id="inlon" maxlength="10" name="inlon" required placeholder="Ingrese la longitud">
      </div>

      <div class="col-3">
        <button type="submit" class="btn btn-success" onclick="" name="Registrar">Registrar</button>
      </div>
      <div class="col-2">
        <a href="HuertosArchivos/consultaMaps.php"><button type="button" class="btn btn-primary" onclick="" name="Registrar">Ubicaciones</button></a>
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
      <h5>Huertos Registrados</h5>
    </div>
    <div class="container">
      <center>
        <table class="table table-striped" id="tabla">
          <thead>
            <tr>
              <th scope="col">idHuerto</th>
              <th scope="col">Productor</th>
              <th scope="col">HUE</th>
              <th scope="col">Opciones</th>

            </tr>
          </thead>
          <tbody id="bodyTabla">

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
    <script type="text/javascript" src="HuertosArchivos/funcionesHuertos.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAoIir0y0RhmeX5MIfoHdiUgxTRQ21HE4w&callback=initMap"></script>
    <script src="menujs.js"></script>
  </main>
</body>

</html>

