<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Iniciar sesión</title>

    <link rel="stylesheet" href="bootstrap-5.1.3-dist/css/bootstrap.min.css">

    

    <!-- Bootstrap core CSS -->
<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="body bg-success text-center">
    
<main class="form-signin form bg-light">
  <form id="frm" method="POST" action="validar.php"> 
    <img class="mb-4" src="Logos/AMOCALI.jpg" alt="" width="132" height="117">
    <img class="mb-4" src="Logos/ASICA.jpg" alt="" width="132" height="117">
    <h1 class="h3 mb-3 fw-normal">BIENVENIDO</h1>

    <div class="form-floating">
      <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="usuario">
      <label for="floatingInput">Usuario</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="contra">
      <label for="floatingPassword">Contraseña</label>
    </div>

    <input type="submit" value="Iniciar sesión" class="w-100 btn btn-lg btn-primary">
    <br>
    
    <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
  </form>
</main>
<script type="text/javascript" src="jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="bootstrap-5.1.3-dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="methodsLogin.js"></script>
  </body>
</html>