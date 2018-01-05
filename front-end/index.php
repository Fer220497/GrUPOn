<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php
        require_once '..\back-end\funciones.php';
        ?>
        <meta charset="UTF-8">
        <title>GrUPOn</title>

        <script src="..\libs\cookieInterface.js">

        </script>
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
            <div><img alt="GrUPOn" src="..\img\logo.png" height="100"/></div>
            <h1 id="tit_cabecera">GrUPOn</h1>
            <?php
            require_once 'buscar_producto.php';
            if (!isset($_SESSION["cuenta"])) {
                ?>
                <div><a href="login.php">Login</a></div>
                <?php
            } else {
                ?>
                <div><a href="cuenta.php">Perfil</a></div>
                <?php
            }
            ?>

        </header>
        <nav id="side-nav">
            <?php
            echo menuCategorias();
            ?>
        </nav>
        <section id="body">
            <h2 id="categoria_actual"><div id="cookie"></div><script>$("#cookie").append(document.createTextNode(categorias[getCookie('categoria')]));</script></h2>
            <p>
                <?php
                desplegarPaginaPrincipal();
                ?>
            </p>
        </section>
        <footer>
            Grupo &num;2 - GrUPOn&copy;, el fruto dado por el odio hacia nosotros mismos
        </footer>
    </body>
</html>
