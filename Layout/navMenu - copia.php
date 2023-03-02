    <?php
    session_start();

    $varses = $_SESSION['usuario'];
    if ($varses == null || $varses == '') {
      echo "Primero inicie sesión";
      die();
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="Datatables-1.11.3/css/dataTables.bootstrap5.min.css">
      <title>Document</title>
    </head>

    <body class="body bg-light">
      <nav class="navbar navbar-expand-lg navbar-light bg-success">
        <div class="container-fluid">
          <a class="navbar-brand text-light" href="inicio.php">Aplicacion WEB</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active text-light" aria-current="page" href="inicio.php">Inicio</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Catálagos
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <?php
                  if ($_SESSION['usuario'] == "Admin_ASICA") {
                    echo "
                          <li><a class='dropdown-item' href='Cat.php'>Centro de Acopio Temporal</a></li>
                          <li><a class='dropdown-item' href='Distribuidores.php'>Distribuidores</a></li>
                          <li><a class='dropdown-item' href='Productores.php'>Productores</a></li>
                          <li><a class='dropdown-item' href='Huertos.php'>Huertos</a></li>
                          <li><a class='dropdown-item' href='TipoQuimico.php'>Tipo Químico</a></li>
                          <li><a class='dropdown-item' href='Municipio.php'>Municipio</a></li>";
                  } else {
                    echo "
                      <li><a class='dropdown-item' href='Cat.php'>Centro de Acopio Temporal</a></li>
                      <li><a class='dropdown-item' href='Contenedores.php'>Contenedores</a></li>
                      <li><a class='dropdown-item' href='Distribuidores.php'>Distribuidores</a></li>
                      <li><a class='dropdown-item' href='EmpresaRecPrivada.php'>Empresa Recolectora Privada</a></li>
                      <li><a class='dropdown-item' href='Municipio.php'>Municipio</a></li>
                      <li><a class='dropdown-item' href='Productores.php'>Productores</a></li>
                      <li><a class='dropdown-item' href='ResponsableCAT.php'>Responsable CAT</a></li>
                      <li><a class='dropdown-item' href='EmpresaDestino.php'>Empresa Destino</a></li>
                      <li><a class='dropdown-item' href='Huertos.php'>Huertos</a></li>
                      <li><a class='dropdown-item' href='ErpVehiculos.php'>ERP Vehículos</a></li>
                      <li><a class='dropdown-item' href='DistVehiculos.php'>Distribuidores Vehículos</a></li>
                      <li><a class='dropdown-item' href='TiposCont.php'>Tipo Contenedor</a></li>
                      <li><a class='dropdown-item' href='MuniVehiculos.php'>Vehículos Municipio</a></li>
                      <li><a class='dropdown-item' href='TipoQuimico.php'>Tipo Químico</a></li>
                      <li><hr class='dropdown-divider'></li>";
                  }
                  ?>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Movimientos
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                  <li>
                    <hr class="dropdown-divider">
                  </li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle text-light" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Reportes
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">

                  <li>
                    <hr class="dropdown-divider">
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link active text-light " aria-current="page" href="#">Ayuda</a>
              </li>
            </ul>
            <form class="d-flex">
              <p class="text-light"><?php echo $_SESSION['usuario']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</p>
              <a href="salir.php"><input type="button" value="Salir" onclick="return res()" class="btn btn-primary"></a>
            </form>
          </div>
        </div>
      </nav>


      <script>
        function res() {
          var respuesta = confirm("¿Seguro que quieres salir?");
          if (respuesta = true) {
            return true;
          } else {
            return false;
          }
        }

        
      </script>