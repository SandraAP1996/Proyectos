
<?php
require_once 'conexion_usuarios.php';

$consulta = $conn->prepare('SELECT * FROM login WHERE usuario=:user');
$consulta->bindParam(':user',  $_SESSION['logeado']);
$consulta->execute();
$admin=false;
while ($registro = $consulta->fetch()){
    if($registro['tipo'] == "usuario"){
        $admin=false;
    }else{
        $admin=true;
    }
}


if(isset($_GET['borrar'])){
    session_destroy();
    header('Location:'.$_SERVER['PHP_SELF']);
}


?>



<div class="jumbotron text-center portada" style="margin-bottom:0">
    <div>
        <?php if(!@$_SESSION['logeado']): ?> 
        <h1>WEB Privada</h1>
        <p>Registrate y descubre!</p> 
        <?php else: ?>
        <h1>Kimetsu no Yaiba</h1>
        <p>De fan para FANS!</p> 
        <?php endif ?>
    </div>
</div>

<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>                        
            </button>
            <a class="navbar-brand" href="ej5-logueo.php">Principal</a>
            <?php if($admin): ?> 
            <a class="navbar-brand" href="listado_usuarios.php">Usuarios</a>
            <?php endif ?> 

        </div>
        <div class="collapse navbar-collapse" id="myNavbar">

            <ul class="nav navbar-nav navbar-right">
               
                <?php if(!isset($_SESSION['logeado'])): ?><li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li> <?php else: ?>
                
                <li><a href="?borrar"><span class="glyphicon glyphicon-log-in"></span> Cerrar Sesión</a></li>
                <?php endif ?>
                
            </ul>
        </div>
    </div>
</nav>
