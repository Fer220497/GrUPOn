<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script>
    </head>
    <body>
        <?php
        require_once '../back-end/lectura_producto.php';
        require_once '../back-end/formulario_carrito.php';
        $carrito = explode(',',$_COOKIE['carrito']);
        echo $_COOKIE['carrito'];
        echo print_r($carrito);
        foreach($carrito as $id_prod){
            echo muestraProducto($id_prod);
            echo borrarProductoCarrito($id_prod);
        }
        ?>
    </body>
</html>
