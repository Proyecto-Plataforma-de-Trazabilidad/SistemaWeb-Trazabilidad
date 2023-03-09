<?php
include "../conexion.php";

if (isset($_POST['accion'])) {
    $tipo = $_POST['accion'];

    if ($tipo == "registrarOrden") {
        $dis = $_POST['idDis'];
        $prod = $_POST['idProd'];
        $numFac = $_POST['NumFac'];
        $factura=$_POST['factura'];
        $numRec = $_POST['numRec'];
        $receta= $_POST['receta'];
        $fecha = $_POST['numRec'];
    }
    echo ($dis . $prod . $numFac .$factura.  $numRec . $receta. $fecha);
}

?>