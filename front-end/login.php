<?php
require '../back-end/generacion_formularios.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <script src='https://www.google.com/recaptcha/api.js'></script>
    </head>
    <body>
        <?php
        require '../back-end/generacion_formularios.php';

        echo formularioLogin();
        ?>
        ¿No est&aacute;s registrado? ¡Reg&iacute;strate aqu&iacute;!<br/>
        <button type="submit" onclick="location.href = 'registro_cliente.php'">Registro como cliente</button> <button type="submit" onclick="location.href = 'registro_empresa.php'">Registro como empresa</button>

    </body>
</html>
