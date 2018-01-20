<?php
session_start();
require_once '../back-end/funciones.php';
if (!isset($_GET['categoria'])) {
    $_GET['categoria'] = 'general';
}
?>
<html>
    <head>
        <title>Producto</title>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCGIDi9rfr_YQw-4Mrj5yBIVrfmr__Fb10"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
        <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-flat.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="estilow3.css">
        <link rel="icon" href="../img/icono.png"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
        <script src="../back-end/funciones.js"></script>
        <script src="../back-end/libs/jquery.zoom.min.js"></script>
        <script src="../back-end/libs/map.js"></script>
        <script>
            var valueofCarrito = getCookie("carrito");
            if (valueofCarrito == "") {
                setCookie("carrito", '', 1);
            }
            $(document).ready(function () {
                $('.zoom').zoom();
            });
        </script> 
    </head>
    <body class="w3-display-container">
        <header class="w3-container w3-flat-midnight-blue">
            <div id="logo">
                <a href="index.php?categoria=general"><img alt="GrUPOn" src="..\img\logo.png" height="90"/></a>
            </div>
        </header>
        <nav class="w3-container w3-card w3-flat-wet-asphalt">
            <div class="w3-container w3-third">
            </div>
            <div class="w3-container w3-center w3-third w3-cell w3-cell-middle">
                <?php echo formularioBusquedaProducto(); ?>
            </div>
            <div class="w3-container w3-third w3-row w3-center">
                <?php echo navigation(); ?>
            </div>
        </nav>
        <main class="w3-container w3-flat-clouds">
            <aside class="w3-container w3-quarter w3-flat-belize-hole w3-card">
                <h2 class="w3-container w3-card w3-flat-wet-asphalt w3-block w3-center">
                    <?php
                    if (isset($_SESSION['tipo']) && ($_SESSION['tipo'] == 'cliente')) {
                        echo $arrayCategoriasLogged[$_GET['categoria']];
                    } else {
                        echo $arrayCategoriasNoLogged[$_GET['categoria']];
                    }
                    ?>
                </h2>
                <div class="w3-container">
                    <?php echo menuCategorias(); ?>
                </div>
            </aside>
            <article class="w3-container w3-threequarter">
                <?php
                require_once '../back-end/formulario_borrar_producto.php';
                require_once '../back-end/lectura_producto.php';
                if (!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'empresa') {
                    echo mostrarBotonAnadir($_GET['id']);
                }
                echo muestraProducto($_GET['id']);
                /* if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'empresa' && esVendedor($_GET['id'], $_SESSION['cuenta'])) {
                  echo muestraFormularioBorrar($_GET['id']);
                  } */


                if (isset($_SESSION['cuenta']) && $_SESSION['tipo'] == 'cliente' &&
                        puedeComentar($_SESSION['cuenta'], $_GET['id'])) {
                    require_once '../back-end/formulario_comentario.php';
                    echo mostrarCajaComentario();
                }
                echo mostrarComentarios($_GET['id']);
                ?></article>
        </main>
        <footer class="w3-container w3-bottom w3-flat-midnight-blue">
            Grupo &num;2 - GrUPOn&copy;, el fruto dado por el odio hacia nosotros mismos
        </footer>
    </body>
</html>