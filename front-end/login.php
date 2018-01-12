<?php
session_start();
require_once '..\back-end\funciones.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <link href='estilo.css' rel="stylesheet"/>
        <?php
        if (isset($SESSION['tipo']) && $SESSION['tipo'] == 'cliente') {
            ?>
            <link href='estilo_login.css' rel="stylesheet"/>
            <?php
        }
        ?>
        <link rel="icon" href="img/logo.png"/>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="../back-end/funciones.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <script>
            $(document).ready(function () {
                $("#cookie").append(document.createTextNode(categorias[getCookie("categoria")]));
            });
        </script>   
    </head>
    <body>
        <header>
            <header>
                <div id="logo">
                    <a href="index.php?categoria=general"><img alt="GrUPOn" src="..\img\logo.png" height="100"/></a>
                </div>
            </header>
            <main>
                <article><!--AQUI IRA TODO EL MAIN -->
                    <?php require_once '../back-end/formulario_login.php'; echo formularioLogin(); ?>
                    &iquest;No est&aacute;s registrado? ¡Reg&iacute;strate aqu&iacute;!<br/>
                    <button type="submit" onclick="location.href = 'registro_cliente.php'">Registro como cliente</button>
                    <button type="submit" onclick="location.href = 'registro_empresa.php'">Registro como empresa</button>

                </article><!--AQUI IRA TODO EL MAIN -->
            </main>

            <footer>
                Grupo &num;2 - GrUPOn&copy;, el fruto dado por el odio hacia nosotros mismos
            </footer>
    </body>
</html>
