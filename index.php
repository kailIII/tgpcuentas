<?php
require_once("class/class.php");
require_once("class/class_usuarios.php");

if (isset($_POST["Datos"]) AND $_POST["Datos"]==1) {
  $obj=new Usuarios();
  $obj->loguin();
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Padrón de Cuentas Oficiales</title>
    <link rel="shortcut icon" href="img/favicon.ico"/>


    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css"> body { padding-top: 70px; padding-bottom: 40px; background-color: #eee; } </style>
  </head>
  <body>
    
    <div class="container">
      <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <form class="form-signin" role="form" action="index.php" method="POST">
              <h2 class="form-signin-heading">Por favor inicie sesión</h2>
              <input type="text" name="usuario" class="form-control" placeholder="Usuario" required autofocus>
              <input type="password" name="contrasena" class="form-control" placeholder="Contraseña" required>
              <br>
              <?php
                if (isset($_GET["error"]) AND $_GET["error"]==2) {
              ?>
                <div class="alert alert-danger alert-dismissable">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <strong>El Usuario o Contraseña son erroneos.</strong>
                </div>
              <?php
                }
              ?>
              <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesión</button>
              <input type="hidden" name="Datos" value="1"/>
          </form>
          </div>
      </div>
      <br>
      <div class="row">
           <?php
              include("partes/footer.php");
            ?>
       </div>   
    </div> <!-- /container -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>