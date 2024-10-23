<?php 
session_start();
$tareas = isset($_SESSION['tareas']) ? $_SESSION['tareas'] : [];

$sesion_cookie = isset($_COOKIE['session']) ? $_COOKIE['session'] : [];
$usuario_inicio_sesion = isset($sesion_cookie['user']) ? true : false;

if($usuario_inicio_sesion !== true){
    header('Location: ./index.php?pagina=nueva-tarea&error=1');
    exit;
}

$tarea = isset($_POST['tarea']) ? trim(strip_tags($_POST['tarea'])) : '';
$fecha_limite = isset($_POST['fecha_limite']) ? trim($_POST['fecha_limite']) : '';

if($tarea == '' || $fecha_limite == ''){
    header('Location: ./index.php?pagina=nueva-tarea&error=2');
    exit;
}

if (!str_contains($fecha_limite, '/')) {
    header('Location: ./index.php?pagina=nueva-tarea&error=3');
    exit;
}

$fecha_post = explode('/',$fecha_limite);
print_r($fecha_post);