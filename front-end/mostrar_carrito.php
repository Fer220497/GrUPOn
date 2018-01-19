<?php
session_start();
require_once '../back-end/funciones.php';

if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'empresa') {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Carrito</title>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    </head>
    <body>
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
        <main>
            <aside>
                <h2 id="categoria_actual">
                    <div id="cookie">  
                    </div>
                </h2>
                <?php echo menuCategorias(); ?>
            </aside>
            <article>
                <?php
                require_once '../back-end/lectura_carrito.php';
                require_once '../back-end/lectura_producto.php';
                require_once '../back-end/proceso_compra_terminar.php';
                if ($_COOKIE['carrito'] == '') {
                    ?><h2>No ha a&ntilde;adido nada al carrito</h2><?php
                } else {
                    echo mostrarCarrito();
                    echo opcionesCompra();
                }
                ?></article>
        </main>
    </body>
</html>
