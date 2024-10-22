<?php 
session_start();
session_start();
$usuario_inicio_sesion = isset($_SESSION['user']) ? true : false;
$tareas = isset($_SESSION['tareas']) ? $_SESSION['tareas'] : [];

$tarea = isset($_POST['tarea']) ? trim(strip_tags($_POST['tarea'])) : '';
$fecha_limite = isset($_POST['fecha_limite']) ? trim($_POST['fecha_limite']) : date();

