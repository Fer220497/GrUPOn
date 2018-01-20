
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
        <meta charset="UTF-8">
        <title>B&uacute;squeda</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"/>
        <link href='estilo.css' rel="stylesheet"/>
        <?php
        if (isset($SESSION['tipo']) && $SESSION['tipo'] == 'cliente') {
            ?>
            <link href='estilo_login.css' rel="stylesheet"/>
            <?php
        }
        ?>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
        <script src="../back-end/funciones.js"></script>
    </head>
    <body class="w3-display-container">
        <?php require_once '../back-end/formulario_busqueda_producto.php'; echo menuCategorias();?>

    </body>
</html>
