<?php
//CONEXIÓN a l BD 'usuarios' con el usuario 'root'
$servidor = 'localhost';
$basededatos = 'mysql:host=localhost;dbname=usuarios';
$usuario = 'root';
$contraseña = '';

try {
    $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    $conn = new PDO($basededatos, $usuario, $contraseña, $opciones);
} catch (PDOException $e) {
    $error= 'Falló la conexión: ' . $e->getMessage();
}


?>