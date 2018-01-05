
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
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="../back-end/libs/cookieInterface.js"></script>
    </head>
    <body>
        <h2>B&uacute;squeda de producto</h2>
        <div id="cookie">La Categoria es:</div>

        <script>
            $("#cookie").append(document.createTextNode(getCookie("categoria")));
        </script>    
        <?php
        require_once '../back-end/funciones.php';
        echo menuCategorias();
        ?>
<?php require_once '../back-end/formulario_busqueda_producto.php'; ?>

    </body>
</html>
