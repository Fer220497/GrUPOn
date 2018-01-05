<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="../back-end/funciones.js"></script>
        <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCGIDi9rfr_YQw-4Mrj5yBIVrfmr__Fb10"></script>
        <script src="../back-end/libs/map.js"></script>
        <title></title>
        <style>#map-canvas{
                height: 500px;
                width: 500px;
            }
            </style>
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
        echo muestraFormularioBorrar($_COOKIE["productoVisitado"]);
        echo mostrarBotonAnadir($_COOKIE["productoVisitado"]);
        ?>
    </body>
</html>
