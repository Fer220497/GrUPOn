<?php session_start();?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once '../back-end/formulario_borrar_producto.php';
        require_once '../back-end/lectura_producto.php';
            /**
             * COMO OBTENEMOS ID PRODUCTO ACTUAL?
             */
            $_SESSION['id_producto_borrar'] = $id;
            echo muestraProducto($id);
            echo muestraFormularioBorrar();
        ?>
    </body>
</html>
