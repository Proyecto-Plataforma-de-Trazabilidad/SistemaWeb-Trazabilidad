<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>


    <!-- Bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


    <style>
        .btn-primary {
            background: #285430;
            border: #285430;
        }

        .btn-primary:hover {
            background: #5F8D4E;
            border: #5F8D4E;
            font-weight: bold;
        }

        body {
            background: #285430;
            /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #285430, #5F8D4E);
            /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #285430, #5F8D4E);
            /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

        .bg {
            background-image: url(Logos/pead.jpg);
            background-position: center right;
            margin: 5px;

            background-size: cover;
        }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>




</head>

<body>

    <br><br>

    <div class="container w-50 bg-white" id="contenido">
        <div class="row">
            <div class="col bg">

            </div>
            <div class="col">
                <div class="text-end">
                    <center>
                        <br>
                        <img src="Logos/APEAJAL2.jpg" width="80" alt="logo">
                        <img src="Logos/AMOCALI.jpg" width="80" alt="logo">
                        <img src="Logos/ASICA.jpg" width="80" alt="logo">
                    </center>
                </div>

                <h2 class="fw-bold text-center py-5">Bienvenido</h2>

                <!--Login-->
                <form id="frm" method="POST" action="validar.php">
                    <div class="b-2">
                        <label for="floatingInput">Usuario</label>
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="usuario">
                    </div>

                    <div class="b-2">
                        <label for="floatingPassword">Contraseña</label>
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="contra">

                    </div>

                    <br><br>

                    <div class="d-grid">
                        <input type="submit" value="Iniciar sesión" class="w-100 btn btn-lg btn-primary">
                    </div>

                    <br><br>

                </form>


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


</body>

</html>