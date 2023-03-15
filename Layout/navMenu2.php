<?php
session_start();

$varses = $_SESSION['usuario'];
if ($varses == null || $varses == '') {
    echo "Primero inicie sesión";
    die();
}

include ('../conexion.php');
$consulta = "SELECT * FROM usuarios where Nombre = '$varses'";
$res = mysqli_query($enlace, $consulta);
$filas = mysqli_fetch_array($res);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APEAJAL</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="Datatables-1.11.3/css/dataTables.bootstrap5.min.css">


    <link rel="stylesheet" href="../css/menucss.css">

    
    <script src="https://kit.fontawesome.com/c65c1f4f0a.js" crossorigin="anonymous"></script>
    
</head>

<body id="body">
    <header>
        <div class="icon__menu">
            <div class="margen"></div>
            <i class="fa-sharp fa-solid fa-bars" id="btn_open"></i>
        </div>
    </header>


    <!--Menu-->
    <div class="menu__side" id="menu_side">

        <div class="name__page">
            <i class="fa-sharp fa-solid fa-user" title="Sesión"></i>
            <h4><?php echo $_SESSION['usuario']; ?></h4>
        </div>

        <div class="options__menu">

            <!--Inicio-->
            <a href="../inicio.php" aria-current="page">
                <div class="option">
                    <i class="fa-sharp fa-solid fa-house" title="Inicio"></i>
                    <h4>Inicio</h4>
                </div>
            </a>

            <!--Catálogos-->
            <a href="../Catalogos.php">
                <div class="option">
                    <i class="fa-sharp fa-solid fa-book" title="Catálogos"></i>
                    <h4>Catálogos</h4>
                </div>

                
            </a>

            <!--Movimientos-->
            <a href="../Menu-Movimientos.php">
                <div class="option">
                    <i class="fa-sharp fa-solid fa-paper-plane" title="Movimientos"></i>
                    <h4>Movimientos</h4>
                </div>
            </a>

            <!--Reportes-->
            <a href="#">
                <div class="option">
                    <i class="fa-solid fa-file-circle-check" title="Reportes"></i>
                    <h4>Reportes</h4>
                </div>
            </a>

            <!--Ayuda-->
            <a href="#">
                <div class="option">
                    <i class="fa-sharp fa-solid fa-circle-info" title="Ayuda"></i>
                    <h4>Ayuda</h4>
                </div>
            </a>

            <!--Salir-->
            <a href="../salir.php" onclick="return res()">
                <div class="option">
                    <i class="fa-sharp fa-solid fa-right-from-bracket" title="Salir"></i>
                    <h4>Salir</h4>
                </div>
            </a>

        </div>




    </div>



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

    <main>