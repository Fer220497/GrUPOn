<?php
session_start();
require_once '../back-end/funciones.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Carrito</title>
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <link href='estilo.css' rel="stylesheet"/>
        <link rel="icon" href="img/logo.png"/>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <script src="../back-end/funciones.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> 
    </head>
    <body>
        <header>
            <header>
                <div id="logo">
                    <a href="index.php"><img alt="GrUPOn" src="..\img\logo.png" height="100"/></a>
                </div>
                <div id="titulo">
                    <a href="index.php">
                        <h1>GrUPOn</h1>
                    </a>
                    
                </div>
            </header>
            <nav>
                <?php echo navigation(); ?>
            </nav>
        <?php
        require_once '../back-end/lectura_carrito.php';
        require_once '../back-end/lectura_producto.php';
        require_once '../back-end/proceso_compra_terminar.php';
        if($_COOKIE['carrito'] == ''){
            ?><h2>No ha a&ntilde;adido nada al carrito</h2><?php
        }else{
            echo mostrarCarrito();
            echo opcionesCompra();
        }
        ?>
    </body>
</html>
