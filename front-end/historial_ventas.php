<?php 
session_start();
require_once '../back-end/funciones.php'
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        echo historialVentas($_SESSION['cuenta']);
        ?>
    </body>
</html>
