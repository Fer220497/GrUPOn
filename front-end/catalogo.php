<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            require_once '../back-end/formulario_borrar_catalogo.php';
            require_once '../back-end/lectura_catalago.php';
            /**
             * COMO OBTENEMOS ID CATALOGO ACTUAL?
             */
            $_SESSION['id_catalogo_borrar'] = $id;
            echo mostrarCatalogo($id);
            echo muestraFormularioBorrar();
        ?>
    </body>
</html>
