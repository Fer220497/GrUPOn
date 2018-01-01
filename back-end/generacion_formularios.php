<?php

/**
 * Función que genera un HTML con un array de errores 
 * (el array de errores debe contener unicamente strings)
 * @param string $error
 * @return string
 */
function muestraErrores($error) {
    $bloqueHTML = '<div class="error"><h1>Se han producido los siguientes errores:</h1><ul>';
    foreach ($error as $err) {
        $bloqueHTML .= "<li>$err</li>";
    }
    $bloqueHTML .= '</ul></div>';
    return $bloqueHTML;
}

/**
 * Esta funcion genera un login en forma de string
 * @return string
 */


function formularioLogin() {

    $form = ' <form action="" method="post">' .
            ' Correo: <input type="text" name="correo" >' .
            ' Contraseña: <input type="password" name="contraseña" >' .
            ' <input type="submit" name="login" value="Enviar">' .
            ' </form>';
    return $form;
}

/*
 * Esta funcion genera un login en forma de string
 */

function formularioRegistroEmpresa() {

    $form = '<form action="" method="post"><p>' .
            'Correo: <input type="text" name="correo" ><p>' .
            'Contraseña: <input type="password" name="contraseña" ><p>' .
            'Confirmar Contraseña: <input type="password" name="contraseña_confirmar" ><p>' .
            'Nombre Empresa: <input type="text" name="nombre_empresa"><p>' .
            'NIF : <input type="text" name="nif_empresa"><p>' .
            'Web Empresa: <input type="text" name="web_empresa" > <p>' .
            'Cuenta Bancaria: <input type="number" name="cuenta_bancaria" ><p>' .
            'Telefono: <input type="number" name="telefono_empresa"><p>' .
            'Correo Electronico: <input type="email" name="mail_empresa"> <p>' .
            'Comunidad Autonoma: <select>' .
            '<option value="andalucia">Andalucia</option>' .
            '<option value="catalunya">Catalu&ntilde;a</option>' .
            '<option value="galicia">Galicia </option>' .
            '<option value="castilla y León">Castilla y Le&oacute;n </option>' .
            '<option value="pais_vasco">Pa&iacute;s Vasco</option>' .
            '<option value="canarias">Canarias</option>' .
            '<option value="valencia">Valencia</option>' .
            '<option value="madrid">Madrid</option>' .
            '<option value="castilla_la_mancha">Castilla La Mancha </option>' .
            '<option value="murcia">Murcia</option>' .
            '<option value="aragon">Arag&oacute;n</option>' .
            '<option value="islas_baleares">Islas Baleares</option>' .
            '<option value="extremadura">Extremadura</option>' .
            '<option value="asturias">Asturias</option>' .
            '<option value="navarra">Navarra</option>' .
            '<option value="cantabria">Cantabria</option>' .
            '<option value="la_rioja">La Rioja</option>' .
            '<option value="melilla"> Melilla</option>' .
            '<option value="ceuta">Ceuta</option>' .
            '</select><p>' .
            '<input type="submit" name="login" value="Enviar">' .
            '</form>';
    return $form;
}

function formularioRegistroCliente() {

    $form = '<form action="" method="post"><p>' .
            'Correo: <input type="text" name="correo" ><p>' .
            'Contraseña: <input type="password" name="contraseña" ><p>' .
            'Confirmar Contraseña: <input type="password" name="contraseña_confirmar" ><p>' .
            'Nombre: <input type="text" name="nombre_cliente"><p>' .
            'Apellidos: <input type="text" name="apellidos_cliente"> <p>';

    return $form;
}

?>