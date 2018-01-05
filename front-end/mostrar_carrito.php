<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../back-end/funciones.js"></script>
    </head>
    <body>
        <?php
       require_once '../back-end/lectura_carrito.php';
       require_once '../back-end/lectura_producto.php';
        echo mostrarCarrito();
       
        ?>
    </body>
</html>
