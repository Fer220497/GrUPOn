<?php
    require_once '../back-end/generacion_formularios.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro Cliente</title>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        <h2>Registro Cliente</h2>
        <?php echo formularioRegistroCliente();?>
    </body>
</html>
