<?php 
session_start();
$tareas = isset($_SESSION['tareas']) ? $_SESSION['tareas'] : [];

$sesion_cookie = isset($_COOKIE['session']) ? $_COOKIE['session'] : [];
$usuario_inicio_sesion = isset($sesion_cookie['user']) ? true : false;

if($usuario_inicio_sesion !== true){
    header('Location: ./index.php?error=1');
    exit;
}

$tarea = isset($_POST['tarea']) ? trim(strip_tags($_POST['tarea'])) : '';
$fecha_limite = isset($_POST['fecha_limite']) ? trim(strip_tags($_POST['fecha_limite'])) : '';

if($tarea == '' || $fecha_limite == ''){
    header('Location: ./index.php?error=2');
    exit;
}

list($day, $month, $year, $hour, $minute) = split('[/ :]', $fecha_limite); 
$timestamp = mktime($hour, $minute, 0, $month, $day, $year);
$fecha_limite = date("r", $timestamp);
$fecha_actual = date('Y-m-d');



