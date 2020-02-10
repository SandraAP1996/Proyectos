<?php
session_start();
require_once 'conexion_usuarios.php';
$consulta = $conn->prepare('SELECT * FROM login WHERE usuario=:user');
$consulta->bindParam(':user',  $_SESSION['logeado']);
$consulta->execute();
$admin=false;
while ($registro = $consulta->fetch()){
    if($registro['tipo'] == "usuario"){
        $admin=false;
        header('Location: error404.php');
    }else{
        $admin=true;
        $consulta = $conn->prepare('SELECT * FROM login');
        $consulta->execute();

        $registros = [];
        while ($registro = $consulta->fetch()){
            $registros[] = $registro;
        }
    }
}






?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <head>
            <title><?php if(!@$_SESSION['logeado']): ?> WEB Privada <?php else: ?> Kimetsu no Yaiba <?php endif ?></title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
            <link rel="stylesheet" href="css/estilo.css">
        </head>
    </head>
    <body>
        <?php require_once 'cabecera-inc.php'; ?>

        <div class="container">
            <h2>Listad de Usuarios</h2>
            <p>Tabla donde muestra todos los usuarios registrados en la página:</p>            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Identificador</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php  foreach($registros as $valor):?>
                    <tr>
                        <td><?= $valor['id'] ?></td>
                        <td><?= $valor['usuario'] ?></td>
                        <td><?= $valor['tipo'] ?></td>
                    </tr>
                    <?php  endforeach?>
                </tbody>
            </table>
        </div>

    </body>
</html>