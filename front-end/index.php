<?php
session_start();
require_once '..\back-end\funciones.php';
?>
<!DOCTYPE html>
<html>
    <head>

        <title>GrUPOn</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
        <link rel="icon" href="img/logo.png">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
                font-family: 'Roboto', sans-serif;
            }
        </style>
        <script src="..\libs\cookieInterface.js"></script>
        <script>
            var categorias = {viajes: "Viajes",
                entretenimiento: "Entretenimiento",
                gastronomia: "Gastronomía",
                electronica: "Electrónica",
                ropa: "Ropa",
                salud_y_belleza: "Salud y belleza",
                deporte: "Deporte",
                general: ""
            };
        </script>
    </head>
    <body>
        <header>
            <header>
                <div id="logo">
                    <a href="index.php"><img alt="GrUPOn" src="..\img\logo.png" height="100"/></a>
                </div>
                <div id="banner">
                    <a href="index.php">
                    </a>
                    <h1>GrUPOn</h1>
                </div>
            </header>
            <nav>

            </nav>
            <main>
                <aside>
                    <?php
                    echo menuCategorias();
                    ?>
                </aside>

                <article>
                    <h2 id="categoria_actual"><div id="cookie"></div><script>$("#cookie").append(document.createTextNode(categorias[getCookie('categoria')]));</script></h2>
                            <?php
                            desplegarPaginaPrincipal();
                            ?>
                </article>
            </main>

            <footer>
                Grupo &num;2 - GrUPOn&copy;, el fruto dado por el odio hacia nosotros mismos
            </footer>
    </body>
</html>
