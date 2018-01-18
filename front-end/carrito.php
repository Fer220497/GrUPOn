<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script></script>
        <link href='estilo.css' rel="stylesheet"/>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
        <?php
        if (isset($SESSION['tipo']) && $SESSION['tipo'] == 'cliente') {
            ?>
            <link href='estilo_login.css' rel="stylesheet"/>
            <?php
        }
        ?>
        <script src="../back-end/funciones.js"></script>
    </head>
    <body>
        <?php
        require_once '../back-end/lectura_producto.php';
        require_once '../back-end/formulario_carrito.php';
        $carrito = explode(',', $_COOKIE['carrito']);
        //echo $_COOKIE['carrito'];
        //echo print_r($carrito);
        foreach ($carrito as $id_prod) {
            echo muestraProducto($id_prod);
            echo borrarProductoCarrito($id_prod);
        }
        ?>
    </body>
</html>
