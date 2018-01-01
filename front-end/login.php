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
    </head>
    <body>
        <?php
        require '../back-end/generacion_formularios.php';
        
        echo '<h2>Login</h2>' . formularioLogin();
        echo '<h2>Registro Cliente</h2>' . formularioRegistroCliente();
        echo '<h2>Registro Empresa</h2>' . formularioRegistroEmpresa();
        ?>
    </body>
</html>
