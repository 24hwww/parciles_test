<?php 
session_start(); 
$datos_predefinidos = array(
'user' => 'demo1',
'pass' => 'demo1'
);
$user = isset($_POST['user']) ? trim(strip_tags($_POST['user'])) : '';
$pass = isset($_POST['password']) ? trim(strip_tags($_POST['password'])) : '';


?>