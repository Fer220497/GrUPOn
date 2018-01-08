<?php
session_start();
require_once '..\back-end\funciones.php';
inicializarDB();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>GrUPOn</title>
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <link href='estilo.css' rel="stylesheet"/>
        <link rel="icon" href="../img/logo.png"/>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="../back-end/funciones.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <script>
            $(document).ready(function () {
                if (getCookie('categoria') == '') {
                    setCookie('categoria', 'general', 1);
                }
                $("#cookie").append(document.createTextNode(categorias[getCookie("categoria")]));
            });
        </script>   
    </head>
    <body>
        <header>
            <div id="logo">
                <a href="index.php"><img alt="GrUPOn" src="..\img\logo.png" height="90"/></a>
            </div>
        </header>
        <nav id="h_nav">
            <?php echo "<div id='busqueda'" . formularioBusquedaProducto() . '</div>';
            echo navigation(); ?>
        </nav>
        <main>
            <aside id="sidenav">
                <h2 id="categoria_actual">
                    <div id="cookie">  
                    </div>
                </h2>
<?php echo menuCategorias(); ?>
            </aside>

            <article>
                Holi
<?php echo desplegarPaginaPrincipal(); ?>
            </article>
        </main>

        <footer>
            Grupo &num;2 - GrUPOn&copy;, el fruto dado por el odio hacia nosotros mismos
        </footer>
    </body>
</html>
