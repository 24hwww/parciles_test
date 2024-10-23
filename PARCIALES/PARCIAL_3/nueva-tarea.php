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
$fecha_limite = isset($_POST['fecha_limite']) ? trim(strip_tags($_POST['fecha_limite'])) : '';

if($tarea == '' || $fecha_limite == ''){
    header('Location: ./index.php?pagina=nueva-tarea&error=2');
    exit;
}

if (!str_contains($fecha_limite, '/')) {
    header('Location: ./index.php?pagina=nueva-tarea&error=3');
    exit;
}

$fecha_post = explode('/',$fecha_limite);

if (is_array($fecha_post) && count($fecha_post) > 0) {
    header('Location: ./index.php?pagina=nueva-tarea&error=3');
    exit;
}

$dd = isset($fecha_post[0]) ? intval($fecha_post[0]) : 0;
$mm = isset($fecha_post[1]) ? intval($fecha_post[1]) : 0;
$yyyy = isset($fecha_post[2]) ? intval($fecha_post[2]) : 0;

print_r($fecha_post);

$timestamp = mktime(0, 0, 0, $mm, $dd, $yyyy);
$fecha_limite_timestamp = date("r", $timestamp);

$fecha_actual = date('Y-m-d');
$fecha_actual_timestamp = strtotime("now");

/*if($fecha_limite_timestamp < $fecha_actual_timestamp){
    header('Location: ./index.php?pagina=nueva-tarea&error=4');
    exit;
}*/



