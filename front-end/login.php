<?php
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="../back-end/funciones.js"></script>
    </head>
    <body>
        <h2>Login</h2>
        <?php require_once '../back-end/formulario_login.php'; ?>
        &iquest;No est&aacute;s registrado? ¡Reg&iacute;strate aqu&iacute;!<br/>
        <button type="submit" onclick="location.href = 'registro_cliente.php'">Registro como cliente</button> <button type="submit" onclick="location.href = 'registro_empresa.php'">Registro como empresa</button>

    </body>
</html>
