<?php
    require '../back-end/generacion_formularios.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        <?php
        
        
        echo '<h2>Login</h2>' . formularioLogin();
        echo '<h2>Registro Cliente</h2>' . formularioRegistroCliente();
        echo '<h2>Registro Empresa</h2>' . formularioRegistroEmpresa();
        ?>
    </body>
</html>
