<?php
    require_once '../back-end/generacion_formularios.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registro Empresa</title>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        <h2>Registro Empresa</h2>
        <?php echo formularioRegistroEmpresa(); ?>
    </body>
</html>
