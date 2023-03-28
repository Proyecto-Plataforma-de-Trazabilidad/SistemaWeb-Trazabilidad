<?php
    include '../conexion.php';

    $nombre = $_POST['innom'];
    $Email = $_POST['incorr'];
    $roluser = $_POST['tipousuario'];

    //funcion que genera contraseñas aleatorias
    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];}
    return $randomString;}

    $psw = generateRandomString();

    $r = "INSERT INTO usuarios values(null, '".$roluser."','".$nombre."', MD5('".$psw."'), '".$Email."' )";

    echo $r;
?>