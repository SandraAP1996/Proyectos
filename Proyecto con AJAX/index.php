<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Documento sin título</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="js/actividad4ej2.js"></script>

        <style>
            body{
                width: 80%;
                margin: 0 auto 3em;
            } 
            #formulario .colIzq {
                display: inline-block;
                width: 10em;
                height: 1.4em;
            }
            section {
                margin: 0 auto;
            }
            #usuarios {
                margin: 5em 0;	
            }
            tr:nth-child(odd) {
                background-color: antiquewhite;
            }
            tr:nth-child(even) {
                background-color: burlywood;
            }
            tr:nth-child(1) {
                background-color: cornflowerblue;
            }
            td, th {
                padding: .2em .8em;
            }
            .separador {
                background-color: white;
            }
            #errorUser img, #errorMail img {
                height: 24px;
                display: none;
            }
            .mensaje {
                display: none;
            }
        </style>
    </head>

    <body>

        <h2>Registrate</h2>
        <form id="formulario" method="post">
            <div class="form-group row">
                <label for="user" class="col-1 col-form-label pr-0">Usuario</label>
                <div class="col-7 pr-0">
                    <input type="text" name="user" id="user" placeholder="Introduce tu nombre de usuario" class="form-control">
                </div>
                <div class="col-4 pr-0" id="errorUser">
                    <img src="img/correcto.png" alt="correcto">
                    <img src="img/error.png" alt="error">
                    <span class="mensaje">El usuario ya existe</span>
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-1 col-form-label pr-0">Email</label>
                <div class="col-7 pr-0">
                    <input type="text" name="email" id="email" placeholder="Introduce tu email" class="form-control">
                </div>
                <div class="col-4 pr-0" id="errorMail">
                    <img src="img/correcto.png" alt="correcto">
                    <img src="img/error.png" alt="error">
                    <span class="mensaje">El email ya existe</span>
                </div>
            </div>

            <div class="form-group row">
                <input type="submit" value="Registro" class="btn btn-primary col-8">
            </div>
            <div class="form-group row">
                <input type="reset" value="Borrar" class="btn btn-danger col-8">
            </div>
        </form>

        <article id="usuarios">
            <h4>Contenido de la tabla usuarios para poder realizar pruebas</h4>
            <?php
            $dsn = 'mysql:dbname=registro;host=127.0.0.1;charset=UTF8';
            $usuario = 'registro';
            $contraseña = 'registro';

            try {
                $conexion = new PDO($dsn, $usuario, $contraseña);
            } catch (PDOException $e) {
                echo 'Falló la conexión: ' . $e->getMessage();
            }

            $sql = 'SELECT * FROM usuarios;';
            $usuarios = $conexion->query($sql);

            echo '<table>';
            echo '<tr><th>usuario</th><th>email</th><th class="separador"></th><th>usuario</th><th>email</th></tr>';
            $contador = 0;
            foreach ($usuarios as $row) {
                if($contador == 0) {
                    echo '<tr>';
                }
                echo '<td>'. $row['user'] .'</td><td>'. $row['email'] .'</td>';
                if($contador == 1) {
                    echo '</tr>';
                    $contador = 0;
                } else {
                    echo '<td class="separador"></td>';
                    $contador++;
                }
            }
            echo '</table>'
            ?>
        </article>

    </body>
</html>
