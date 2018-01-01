<?php
require '../back-end/generacion_formularios.php';

echo formularioLogin();

?>

<html>
    ¿No est&aacute;s registrado? ¡Reg&iacute;strate aqu&iacute;!<br/>
    <button type="submit" onclick="location.href='registro_cliente.php'">Registro como cliente</button> <button type="submit" onclick="location.href='registro_empresa.php'">Registro como empresa</button>
</html>