<?php
session_start();

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

        <div class="container" style="margin-top:30px">
            <div class="container text-center"> 
                <?php if(!@$_SESSION['logeado']): ?> 
                <img src="img/topsecret.png">
                <?php else: ?>
                <h3>Personajes</h3><br>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="well">
                            <img class="perfil" src="img/prot-perf.webp">
                            <h2>Tanjirou Kamado</h2>
                            <p>El protagonista de serie, un joven amable por naturaleza con mucha determinación y que no se rinde una vez tiene una meta que alcanzar. También tiene un sentido del olfato muy desarrollado. Se convirtió en un asesino de demonios tras un largo entrenamiento con Sakonji Urokodaki.Actualmente se encuentra muerto a causa de la sangre de Muzan.</p>
                        </div>
                        <div class="well">
                            <img src="img/sister-per.gif">
                            <h2>Nezuko Kamado </h2>
                            <p>La hermana pequeña de Tanjirou y la única superviviente de su familia tras el ataque de Muzan, aunque se convirtió en demonio. Sin embargo, retiene sus recuerdos y sentimientos hacia su hermano, quien la retiene de sus impulsos demoníacos. Habiéndose vuelto sensible a la luz del sol, su hermano la transporta en una caja de madera durante sus viajes.</p>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="well datos">
                            <img src="img/amo-per.gif">
                            <h2>Zenitsu Agatsuma</h2>
                            <p>Es un asesino de demonios y compañero de viaje de Tanjirou. Zenitsu tiene una personalidad cobarde debido a su baja autoestima, pero aun así desea estar a la altura de las expectativas de los demás, a pesar de estar constantemente asustado, llorando y siempre huyendo. Su sentido del oído está altamente desarrollado hasta el punto de poder escuchar cosas que nadie más puede. Él dice que quiere vivir una vida modesta donde pueda ser útil para alguien. Se convierte en una persona completamente diferente cuando se duerme durante una pelea.</p>
                        </div>
                        <div class="well datos">
                            <img src="img/jabali-per.gif">
                            <h2>Inosuke Hashibira</h2>
                            <p>Es un asesino de demonios y compañero de viaje de Tanjirou que lleva una máscara de jabalí. Vivió la mayor parte de su vida en el bosque donde luchó con animales y demonios. Es un espadachín hábil que usa dos espadas para luchar.</p>
                        </div>
                    </div>
                </div>
                <?php endif ?>

            </div><br>

        </div>
        <?php if(@$_SESSION['logeado']): ?> 
        <img src="img/prota.gif" class="ultimo">
        <img src="img/sister.gif" class="ultimo">
        <img src="img/amo.gif" class="ultimo">
        <img src="img/jabali.gif" class="ultimo">
        <?php endif ?>

    </body>
</html>
