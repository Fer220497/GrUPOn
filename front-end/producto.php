<?php session_start();?>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../back-end/funciones.js"></script>
        <title></title>
    </head>
    <body>
        <?php
        require_once '../back-end/formulario_borrar_producto.php';
        require_once '../back-end/lectura_producto.php';
            /**
             * COMO OBTENEMOS ID PRODUCTO ACTUAL?
             */
            //$_SESSION['id_producto_borrar'] = $id;
            echo muestraProducto($_COOKIE["productoVisitado"]);
            echo muestraFormularioBorrar();
            echo mostrarBotonAnadir($_COOKIE["productoVisitado"]);
        ?>
    </body>
</html>
