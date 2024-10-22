<?php 
session_start();

$tareas = isset($_SESSION['tareas']) ? $_SESSION['tareas'] : [];
$pagina = isset($_GET['pagina']) ? strip_tags(trim($_GET['pagina'])) : '';
$cerrar_sesion = isset($_GET['cerrar_sesion']) ? intval($_GET['cerrar_sesion']) : 0;

if($cerrar_sesion == 1){
    // eliminar sesion
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }
    header('Location: ./index.php?success=2');
}

$sesion_cookie = isset($_COOKIE['session']) ? $_COOKIE['session'] : [];
$usuario_inicio_sesion = isset($sesion_cookie['user']) ? true : false;

print_r($_SESSION);

print_r($_COOKIE);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="">

    <title>PARCIAL_3</title>

    <!-- Bootstrap core CSS -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>

    <header>
    <div class="navbar navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">+</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="./index.php">PARCIAL_3</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="./index.php">Inicio</a></li>
            <li><a href="?tareas">Nueva Tarea</a></li>
            <?php if($usuario_inicio_sesion !== false): ?>
            <li><a href="?cerrar_sesion=1">Cerrar Sesión</a></li>    
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
    </header>

    <main>
    <div class="container">
            
            <?php if($usuario_inicio_sesion !== true): ?>
            <div class="pantalla_1">
            <div class="starter-template">
            <h1>Inicio de Sesión</h1>
            </div>

            <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                
            <div class="panel panel-default">
            <div class="panel-heading">
            <h3 class="panel-title">Formulario de acceso</h3>
            </div>
            <div class="panel-body">
                <?php
                /** MANEJO DE ERRORES DE INICIO DE SESION **/
                $mensaje = '';
                $success = isset($_GET['success']) ? intval($_GET['success']) : '';
                $error = isset($_GET['error']) ? intval($_GET['error']) : '';
                switch ($error) {
                    case 0:
                        $mensaje = "No deje ningun campo vacio";
                        break;
                    case 1:
                        $mensaje = "Usuario o contraseña son invalidos";
                        break;
                    case 2:
                        $mensaje = "";
                        break;
                    default:
                        $mensaje = "Existe un error.";
                }
                if($mensaje !== '' && $error !== ''){
                    echo sprintf('<div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> %s </div>', $mensaje);
                }
                /*** ***/
                switch ($success) {
                    case 1:
                        $mensaje = "Sesion iniciada";
                        break;
                    case 2:
                        $mensaje = "Sesion cerrada";
                        break;
                    case 2:
                        $mensaje = "";
                        break;
                }

                if($mensaje !== '' && $success !== ''){
                    echo sprintf('<div class="alert alert-success" role="alert"><span class="glyphicon glyphicon glyphicon-ok" aria-hidden="true"></span><span class="sr-only">Exito:</span> %s </div>', $mensaje);
                }
                ?>
                <form method="POST" action="login.php">

                    <div class="form-group">
                        <label for="user">Usuario</label>
                        <input type="text" id="user" name="user" class="form-control" autocomplete="off" required/>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" class="form-control" autocomplete="off" required/>
                    </div>

                    <button class="btn btn-success" type="submit">Entrar</button>

                </form>
            </div>
            </div>        

            </div>
            </div>

            </div>
            <?php endif; ?>

            <?php if($usuario_inicio_sesion !== false): ?>
            <div class="pantalla_2">
                <div class="starter-template">
                <h1>Tareas</h1>
                </div>
                <div class="">
                <div class="panel panel-default"> <div class="panel-heading">Listado de tareas</div> <div class="panel-body"><p>Tareas agregadas</p> 
                </div> 
                <table class="table">
                    <thead> 
                        <tr> 
                            <th>#</th> 
                            <th>Tarea</th> 
                            <th>Fecha limite</th> 
                        </tr> 
                        </thead> 
                        <tbody> 
                            <tr> 
                                <th scope="row">1</th> 
                                <td>---</td> 
                                <td>Otto</td> 
                            </tr> 
                                <tr> 
                                    <th scope="row">2</th> 
                                    <td>---</td> 
                                    <td>Thornton</td> 
                                </tr> 
                                <tr> 
                                    <th scope="row">3</th> 
                                    <td>---</td> 
                                    <td>the Bird</td> 
                                </tr> 
                        </tbody> 
                    </table> 
                </div>
                </div>
            </div>
            <?php endif; ?>

    </main>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  </body>
</html>
