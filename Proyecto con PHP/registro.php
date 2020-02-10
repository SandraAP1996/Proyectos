<?php session_start();
require_once 'conexion_usuarios.php';

//COMPROBACIÓN DE ENVÍOS
if(isset($_POST['envioREG'])){
    if($_POST['usuario'] != "" && $_POST['contrasenya'] != "" && $_SESSION['cap_code'] == $_POST['captcha']){
        try{
            $consulta = $conn->prepare('INSERT INTO login (usuario,password,tipo) VALUES (:user,:pass,:tipo);');
            $consulta->bindParam(':user', $_POST['usuario']);
            $consulta->bindParam(':pass', $_POST['contrasenya']);
            $consulta->bindParam(':tipo', $_POST['tipo']);
            $consulta->execute();
            $error_msg="*Se ha introducido correctamente";
            $error=false;
        }catch( SQLException $e){
            $error_msg="*No se ha podido introducir el usuario";
            $error=true;
        }
    }else{
        $error=true;
        $error_msg="*No se ha podido introducir el usuario";
        echo "entra";
    }
}

//COMPROBACIÓN DE ENUM
$consulta = $conn->prepare("SHOW COLUMNS FROM login LIKE 'tipo';");
$consulta->execute();

$registro = $consulta->fetch();
$text = $registro['Type'];

function multiexplode ($delimiters,$string) {

    $ready = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode('enum', $ready);
    return $launch;
}

$exploded = multiexplode(array("enum","(","'",")",","," "),$text);



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
        <h1>Registro</h1>
        <form action="#" method="post">
            Nombre: <input type="text" name="nombre"><br><br>
            Email: <input type="email" name="email"><br><br>
            Usuario: <input type="text" name="usuario"><br><br>
            Contraseña: <input type="password" name="contrasenya"><br><br>
            Tipo: <select name="tipo">
            <?php  foreach($exploded as $valor):?>
            <?php if($valor != ""):?>
            <option value="<?= $valor ?>"><?= $valor ?></option>
            <?php endif?>
            <?php  endforeach?>
            </select><br><br>


            <input type="text" name="captcha" id="captcha" maxlength="6" size="6"/>
            <img src="captcha/captcha.php"/><br><br>


            <button name="envioREG" type="submit">Registrarse</button>        <span style="color: <?php if($error == false): echo "green"?><?php else: echo "red" ?><?php endif ?>"><?= @$error_msg?></span>

        </form>
        <hr>

    </body>
</html>