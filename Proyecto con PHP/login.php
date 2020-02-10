<?php
session_start();
require_once 'conexion_usuarios.php';
$error_log='';

if(isset($_POST['envioLOG'])){
    if($_POST['usuario'] != "" && $_POST['password'] != ""){
        $consulta = $conn->prepare('SELECT * FROM login WHERE usuario=:user and password=:pass');
        $consulta->bindParam(':user', $_POST['usuario']);
        $consulta->bindParam(':pass', $_POST['password']);
        $consulta->execute();
        $result = $consulta->fetchColumn(0);
        if ($result) {
            $_SESSION['logeado']=$_POST['usuario'];
            header('Location: ej5-logueo.php');
        } else {
            $_SESSION['logeado']="";
            $error_log='    El usuario introducido no existe';
        }
    }

}


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php if(!@$_SESSION['logeado']): ?> WEB Privada <?php else: ?> Kimetsu no Yaiba <?php endif ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/estilo.css">
    </head>
    <body>
        <?php require_once 'cabecera-inc.php'; ?>
        <h1>Login</h1>

        <form action="#" method="post">
            Usuario: <input type="text" name="usuario"><br><br>
            Contraseña: <input type="password" name="password"><br><br>

            <button type="submit" name="envioLOG">Enviar</button>       <a href="registro.php">¿Aún no estas registrado?</a> 
            <?php if($error_log != ""): ?> <span  class="alert alert-danger" > <?= $error_log ?> </span> <?php endif ?> 
        </form>
        
        <hr>

    </body>
</html>