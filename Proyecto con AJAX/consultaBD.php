<?php
$dsn = 'mysql:dbname=registro;host=127.0.0.1;charset=UTF8';
$usuario = 'registro';
$contraseña = 'registro';
$json='';
try {
    $conexion = new PDO($dsn, $usuario, $contraseña);
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}

$stmt = $conexion->prepare("SELECT COUNT(*) FROM usuarios WHERE ".$_POST['atributo']."='".$_POST['valor']."';");
$stmt->execute();
$count = $stmt->fetchColumn();

if($count == 1){
    $json = array("estado" => "true");
}else {

    $json = array("estado"=>"false");
}

echo json_encode($json);


?>