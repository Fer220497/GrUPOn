<?php
session_start();
require_once '../back-end/funciones.php';

if (!isset($_SESSION['cuenta']) || $_SESSION['tipo'] != 'empresa') {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Registro e</title>
        <!--NECESARIOS-->  <!--NO NECESARIOS-->
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <link href='estilo.css' rel="stylesheet"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
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
                    <a href="index.php?categoria=general"><img alt="GrUPOn" src="..\img\logo.png" height="90"/></a>
                </div>
            </header>
            <nav>
                <?php
                echo formularioBusquedaProducto();
                echo navigation();
                ?>
            </nav>
            <main>
                <aside>
                    <h2 id="categoria_actual">
                        <div id="cookie">  
                        </div>
                    </h2>
                    <?php echo menuCategorias(); ?>
                </aside>
                <!--AQUI IRA TODO EL MAIN -->
                <article>
                    <h2>Creaci&oacute;n Catalogo</h2>
                    <?php require_once '../back-end/formulario_creacion_catalogo.php'; ?>

                </article>
                <!--AQUI IRA TODO EL MAIN -->
            </main>

            <footer>
                Grupo &num;2 - GrUPOn&copy;, el fruto dado por el odio hacia nosotros mismos
            </footer>
    </body>
</html>
